<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user');
        $this->load->library('form_validation');
    }

    /* 
        DOCU: This function will redirect to products if the 
              session of user is set else it will render the
              login page.
        OWNER: Jhones
    */
    public function login(){
        if($this->session->userdata('user_id') !== NULL){
            if($this->session->userdata('is_admin') == 1){
                redirect('dashboard/products');
                exit();
            }
            else{
                redirect('products');
                exit();
            }
        }

        $view_data = array(
                        'error_msg' => $this->session->flashdata('error_msg'), 
                        'csrf'      => array(
                                            'name' => $this->security->get_csrf_token_name(),
                                            'hash' => $this->security->get_csrf_hash()
                                        )
                    );
        
        $this->load->view('login_register/login', $view_data);
	}

    /*
        DOCU: This function will redirect to products if the
              session of user is set else it will render the
              register page.
        OWNER: Jhones
    */
	public function register(){
        if($this->session->userdata('user_id') !== NULL){
            redirect('products');
            exit();
        }

        $view_data = array(
            'error_msg' => $this->session->flashdata('error_msg'),
            'csrf'      => array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash()
                            )
        );

        $this->load->view('login_register/registration', $view_data);
	}

    /* 
        DOCU: This function will redirect to products if the 
              session of user is set else it will render the
              admin login page.
        OWNER: Jhones
    */
    public function admin(){
        if($this->session->userdata('user_id') !== NULL){
            if($this->session->userdata('is_admin') == 1){
                redirect('dashboard/products');
                exit();
            }
            else{
                redirect('products');
                exit();
            }
        }

        $view_data = array(
                        'error_msg' => $this->session->flashdata('error_msg'), 
                        'csrf'      => array(
                                            'name' => $this->security->get_csrf_token_name(),
                                            'hash' => $this->security->get_csrf_hash()
                                        )
                    );
        
        $this->load->view('login_register/admin_login', $view_data);
	}

    /*
        DOCU: This function will trigger if login button was clicked.
              It will validate the form and if it has error it will redirect
              back to the login page else it will redirect to products 
              with session set.
        OWNER: Jhones
    */
    public function process_login(){

        if($this->form_validation->run('login') === FALSE){
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('login');
            exit();
        }

        $form_input = $this->input->post(NULL, TRUE);
        $user = $this->user->find_user_by_email($form_input['email']);
        $match = $this->user->password_match($form_input['password'], $user);

        if($match === FALSE){
            $this->session->set_flashdata('error_msg', "Invalid Credentials");
            redirect('login');
            exit();
        }

        $user_session = array(
                        'user_id'   => $user['id'], 
                        'user'      => $user['first_name'] . ' ' . $user['last_name'],
                        'is_admin'  => $user['is_admin']
        );

        $this->session->set_userdata($user_session);
        redirect('products');
    }

    /* 
        DOCU:   This function will trigger if sign in button was clicked.
                It will validate the form and if it has error it will redirect back 
                to the registration page else it will redirect to product page.
        OWNER: Jhones
    */
    public function process_register(){

        if($this->form_validation->run('register') === FALSE){
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('register');
            exit();
        }

        $form_input = $this->input->post(NULL, TRUE); 

        if($this->user->has_user_record() === TRUE){
            $form_input['is_admin'] = 0;
        }else{
            $form_input['is_admin'] = 1;
        }

        if($this->user->create_user($form_input)){
            $user = $this->user->find_user_by_email($form_input['email']);
            $this->session->set_userdata(array(
                                                'user_id'   => $user['id'], 
                                                'user'      => $user['first_name'] . ' ' . $user['last_name'],
                                                'is_admin'  => $user['is_admin']
                                            ));
            redirect('products');
            exit();
        }

        redirect('register');
    }

    /*
        DOCU: This function will trigger if login button was clicked.
              It will validate the form and if it has error it will redirect
              back to the admin login page else it will redirect to dashboard 
              with session set.
        OWNER: Jhones
    */
    public function process_admin_login(){
        if($this->form_validation->run('login') === FALSE){
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('admin');
            exit();
        }

        $form_input = $this->input->post(NULL, TRUE);
        $user = $this->user->find_admin_by_email($form_input['email']);
        $match = $this->user->password_match($form_input['password'], $user);

        if($match === FALSE){
            $this->session->set_flashdata('error_msg', "Invalid Credentials");
            redirect('admin');
            exit();
        }

        $user_session = array(
                        'user_id'   => $user['id'], 
                        'user'      => $user['first_name'] . ' ' . $user['last_name'],
                        'is_admin'  => $user['is_admin'],
        );

        $this->session->set_userdata($user_session);
        redirect('dashboard/orders');
    }

    /* 
        DOCU: This funtion will destroy all session and redirect
              to the login page.
        OWNER: Jhones
    */
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }

    /****************************/
    /* HELPER FUNCTIONS        */
    /***************************/

    /*
        DOCU:  This function will get the user_id from session.
               If there is no user_id it wil redirect to login. 
        OWNER: Jhones
    */
    private function get_user(){
        $user_id = $this->session->userdata('user_id');
        $is_admin = $this->session->userdata('is_admin');

        if($user_id === NULL){
            redirect('/login');
            exit();
        }
        else if ($is_admin == 1){
            redirect('/dashboard/orders');
            exit();
        }
        
        return $user_id;
    }
}
