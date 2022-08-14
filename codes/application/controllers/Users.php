<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user');
    }

    /* 
        DOCU: This function will redirect to products if the 
              session of user is set else it will render the
              login page.
        OWNER: Jhones
    */
    public function login(){
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
        DOCU: This function will trigger if login button was clicked.
              It will validate the form and if it has error it will redirect
              back to the login page else it will redirect to products 
              with session set.
        OWNER: Jhones
    */
    public function process_login(){
        $result = $this->user->validate_login_form();

        if($result !== TRUE){
            $this->session->set_flashdata('error_msg', $result);
            redirect('login');
            exit();
        }

        $form_input = $this->input->post(NULL, TRUE);
        $user = $this->user->find_user_by_email($form_input['email']);
        $match = $this->user->password_match($form_input['password'], $user);

        if($match === FALSE){
            $this->session->set_flashdata('error_msg', "<p class='alert-error'>Invalid Credentials</p>");
            redirect('login');
            exit();
        }

        $user_session = array(
                        'user_id'   => $user['id'], 
                        'user'      => $user['first_name'] . ' ' . $user['last_name'],
                        'is_admin'  => $user['is_admin'],
        );

        $this->session->set_userdata($user_session);
        redirect('products');
    }

    /* 
        DOCU: This function will trigger if sign in button was clicked.
                It will validate the form and if it has error it will redirect back 
                to the registration page else it will redirect to <>.
        OWNER: Jhones
    */
    public function process_register(){
        $result = $this->user->validate_register_form();

        if($result !== TRUE){
            $this->session->set_flashdata('error_msg', $result);
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
        DOCU: This funtion will destroy all session and redirect
              to the login page.
        OWNER: Jhones
    */
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
}
