<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('order');
        $this->load->model('cart');
        $this->load->model('product');
        $this->load->library('stripegateway');
    }

    /*
        DOCU:  If the user is not admin it will redirect to products page
               else it will go to order dashboard page. 
        OWNER: Jhones
    */
    public function dashboard(){
        $user = $this->get_user();
        if($user['is_admin'] == 1){
            $this->load->view('admin/orders_dashboard');
        }
        else{
            redirect('products');
        }
    }

    /*
        DOCU:  This function is used through ajax and will render 
               all the list of orders with search and pagination.
        OWNER: Jhones
    */
    public function index_html(){

        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $input = $this->input->get();

        $this->order->search($input);
        $link_count = $this->order->paginate($page, 5);
        $orders = $this->order->get_all();
        
        $view_data = array(
            'orders'     => $orders,
            'link_count' => $link_count,
            'page'       => $page,
            'csrf'       => $this->generate_csrf()
        );

        $this->load->view('partials/admin/orders', $view_data);
    }

    /*
        DOCU:  This function will render the order details page and
               that displays the individual order with their products, 
               shipping and billing info.
        OWNER: Jhones
    */
    public function show($id){

        $order_products = $this->order->get_item_orders($id);
        $order = $this->order->get_by_id($id);

        $view_data = array(
                        'order_products' => $order_products,
                        'order'          => $order
                    );
        $this->load->view('admin/order_detail', $view_data);
    }

    /*
        DOCU:  This function will trigger if the order form is submitted
               from user. It will submit the order from all the products
               in the cart of the user.
        OWNER: Jhones
    */
    public function create(){
        $user = $this->get_user(true, 'user');

        $cart_count = $this->cart->cart_count($user['id']);

        if(!$cart_count){
            $this->session->set_flashdata('error_msg', "Cart is empty.");
            redirect('/carts');
            exit();
        }

        if($this->form_validation->run('order') === FALSE){
            $this->session->set_flashdata('error_msg', "Fields cannot be empty.");
            redirect('carts');
            exit();
        }

        $cart = $this->cart->get_all($user['id']);
        $cart_inventory = $this->cart->inventory_check($cart);

        if($cart_inventory !== TRUE){
            $this->session->set_flashdata('error_msg', implode("\n", $cart_inventory));
            redirect('carts');
            exit();
        }

        $input = $this->input->post(NULL, TRUE);
        $order_id = $this->order->add_order($input);

        $this->product->decrement_quantities($cart);

        if($order_id){
            //stripe
            $total = 0;
            foreach($cart as $item){
                $total += $item['price'] * $item['quantity'];
            }
            // + 50 for shipping fee
            $total += 50;
            $stripe_res = $this->stripegateway->checkout($input, $total, $this->input->post('stripeToken'));
            //end stripe

            $this->order->add_order_product($order_id, $cart);
            $this->order->add_order_billing($order_id, $input, $stripe_res['id']);
            $this->order->add_order_shipping($order_id, $input);

            $this->product->decrement_quantities($cart);

            $this->cart->reset_cart($user['id']);
            redirect('orders/order_success');
        }
        else{
        $this->session->set_flashdata('error_msg', "There is an error submitting your order.");
        redirect('carts');
        }

    }

    /*
        DOCU:  This function is triggered by ajax. It will call if status 
               select was changed and it will update the status of the order.
        OWNER: Jhones
    */
    public function ajax_update($id){
        $is_success = false;

        if($this->form_validation->run('update_status') === FALSE){
            $result = validation_errors();
        }
        else{
            $status = $this->input->post('status');
        
            if($this->order->update_status($id, $status)){
                $is_success = true;
                $result = "Order status updated.";
            }
            else{
                $result = "There is an error while updating the status of an order.";
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
        DOCU:  This function is triggered by ajax. It will generate
               new csrf token.
        OWNER: Jhones
    */
    public function ajax_generate_csrf(){

        $output = array(
            'csrf'       => $this->generate_csrf()
        );

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($output));
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
               If redirect set to true it will redirect based on 
               the role of the user.
        OWNER: Jhones
    */
    private function get_user($redirect = false, $type = 'user'){
        $user_id = $this->session->userdata('user_id');
        $is_admin = $this->session->userdata('is_admin');

        if($user_id === NULL){
            redirect('/login');
        }   
        else if($type == 'user' && $redirect == true){
            if($is_admin == 1){
                redirect('/dashboard/orders');
            }
        }
        else if($type == 'admin' && $redirect == true){
            if($is_admin == 0){
                redirect('/products');
            }
        }
        
        return array(
            'id'       => $user_id,
            'is_admin' => $is_admin
        );
    }
    
    /*
        DOCU:  This function will return regenerated csrf.
        OWNER: Jhones
    */
    private function generate_csrf(){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        return $csrf;
    }

}
