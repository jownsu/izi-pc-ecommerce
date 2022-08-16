<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('order');
        $this->load->model('cart');
        // $this->load->library('stripegateway');
    }

    /*
        DOCU:  This function will render the dashboard of orders
        OWNER: Jhones
    */
    public function dashboard(){
        $this->load->view('admin/orders_dashboard');
    }

    /*
        DOCU:  This function will trigger if the order form is submitted
               from user.
        OWNER: Jhones
    */
    public function create(){
        $user_id = $this->get_user();

        $cart_count = $this->cart->cart_count($user_id);

        if(!$cart_count){
            $this->session->set_flashdata('error_msg', "Cart is empty.");
            redirect('/carts');
            exit();
        }

        // $result = $this->order->validate();

        if($this->form_validation->run('order') === FALSE){
            $this->session->set_flashdata('error_msg', "Fields cannot be empty.");
            redirect('carts');
            exit();
        }

        $input = $this->input->post(NULL, TRUE);
        $cart = $this->cart->get_all($user_id);
        $order_id = $this->order->add_order($input);

        if($order_id){
            //stripe
            // $total = 0;
            // foreach($cart as $item){
            //     $total += $item['price'] * $item['quantity'];
            // }
            // $msg = $this->stripegateway->checkout($input, $total);
            //end stripe

            $this->order->add_order_product($order_id, $cart);
            $this->order->add_order_billing($order_id, $input);
            $this->order->add_order_shipping($order_id, $input);

            $this->cart->reset_cart($user_id);
            redirect('orders/order_success');
    }

        $this->session->set_flashdata('error_msg', "There is an error submitting your order.");
        redirect('carts');
    }

    /*
        DOCU:  This function will render the order success page.
        OWNER: Jhones
    */
    public function order_success(){
        $this->load->view('product/order_success');
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
