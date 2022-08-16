<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('cart');
        $this->load->library('form_validation');
    }

    /*
        DOCU:  This function will render the cart page with all the list of
               products in the cart of the user.
        OWNER: Jhones
    */
	public function index(){
        $user_id = $this->get_user();

        $view_data = array(
            'cart'               => $this->cart->get_all($user_id),
            'error_msg'          => $this->session->flashdata('error_msg'),
            'shipping_error_msg' => $this->session->flashdata('shipping_error_msg'),
            'billing_error_msg'  => $this->session->flashdata('billing_error_msg'),
            'csrf'               => $this->generate_csrf()
        );

		$this->load->view('product/cart', $view_data);
	}

    /*
        DOCU:  This function will trigger if buy button is pressed in
               single product page. If the product is not already in the cart
               it will add the product to the cart else it will just increment.
        OWNER: Jhones
    */
    public function add_to_cart(){
        $user_id = $this->get_user();

        $add_count = false;
        $is_success = false;
        
        if($this->form_validation->run('add_to_cart') === FALSE){
            $result = validation_errors();
        }
        else{
            $input = $this->input->post(null, TRUE);

            if($this->cart->is_product_exists($user_id, $input['product_id'])){
                $this->cart->increment_cart($user_id, $input);
                $result = "Product updated in cart";
            }else{
                $this->cart->add_to_cart($user_id, $input);
                $result = "Product added to cart";
                $add_count = true;
            }
            $is_success = true;
        }

        $output = array(
            'message'    => $result,
            'is_success' => $is_success,
            'add_count'  => $add_count,
            'csrf'       => $this->generate_csrf()
        );

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($output));
    }

    /*
        DOCU:  This function will trigger if delete button in cart 
               page is pressed. It will just remove the product in the
               cart.
        OWNER: Jhones
    */
    public function remove_cart(){
        $user_id = $this->get_user();
        $is_success = false;
        
        if($this->form_validation->run('remove_cart') === FALSE){
            $result = validation_errors();
        }
        else{
            $cart_id = $this->input->post('cart_id');

            if($this->cart->remove_to_cart($user_id, $cart_id)){
                $is_success = true;
                $result = "Product removed from cart";
            }
            else{
                $result = "There is an error while deleting the product in cart";
            }
        }

        $output = array(
            'message'    => $result,
            'is_success' => $is_success,
            'csrf'       => $this->generate_csrf()
        );

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($output));
    }

    /*
        DOCU:  This function will trigger if update button was pressed in 
               the cart page. It will update the quantity of the product in 
               the cart of the user. 
        OWNER: Jhones
    */
    public function update_cart(){
        $user_id = $this->get_user();
        $is_success = false;
        
        if($this->form_validation->run('update_cart') === FALSE){
            $result = validation_errors();
        }
        else{
            $input = $this->input->post(NULL, TRUE);

            if($this->cart->update_cart($user_id, $input)){
                $is_success = true;
                $result = "Quantity updated";
            }
            else{
                $result = "There is an error in server";
            }
        }

        $output = array(
            'message'    => $result,
            'is_success' => $is_success,
            'csrf'       => $this->generate_csrf()
        );

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($output));
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

    /*
        DOCU:  This function will return regenerated csrf.
        OWNER: Jhones
    */
    public function generate_csrf(){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        return $csrf;
    }

}
