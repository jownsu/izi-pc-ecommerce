<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('product');
        $this->load->model('cart');
        $this->load->model('category');
    }

    /*
        DOCU: This function is the default controller. If the user
              is not logged in, it will redirect to login page. If
              the user is admin it will redirect to dashboard else
              it will redirect to products page.
        OWNER: Jhones
    */
	public function index(){
        $user = $this->get_user();
        if($user['is_admin'] == 1){
            redirect('dashboard/orders');
        }
        else{
            redirect('products/all_products');
        }
    }

    /*
        DOCU: This function will render products screen that shows
              all the products.
        OWNER: Jhones
    */
    public function all_products(){
        $user = $this->get_user(true);

        $view_data = array(
                        'categories' => $this->category->get_all(),
                        'cart_count' => $this->cart->cart_count($user['id'])
                    );

        $this->load->view('product/products', $view_data);
    }

    /*
        DOCU: This function will render the products dashboard in admin side.
              If the user is not admin it will redirect to products page.
        OWNER: Jhones
    */
    public function dashboard(){
        $this->get_user(true, 'admin');
        $this->load->view('admin/products_dashboard');
    }

    /*
        DOCU: This function will render the product based on passed ID.
              It will also show 5 products with similar categories.
        OWNER: Jhones
    */
    public function show($id){
        $user = $this->get_user(true);
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $product = $this->product->get_by_id($id);
        $product['images'] = json_decode($product['images']);

        $search_info = array(
            'category' => $product['category_id'],
            'limit'    => 5
        );

        $this->product->search($search_info);
        $similar_products = $this->product->get_all();

        $view_data  = array(
                        'product'          => $product,
                        'cart_count'       => $this->cart->cart_count($user['id']),
                        'similar_products' => $similar_products,
                        'csrf'             => $this->generate_csrf(),
                        'success_msg'      => $this->session->flashdata('success_msg'),
                        'error_msg'        => $this->session->flashdata('error_msg')
                    );

        $this->load->view('product/product', $view_data);
    }

    /*
        DOCU: This function is called when form is submitted through ajax. 
              It search through products and paginate it. If page is 
              undefined the default value is 1.
        OWNER: Jhones
    */
	public function index_html(){
        $user = $this->get_user();
        $page = $this->input->get('page') ? $this->input->get('page') : 1;

        $item_per_page = $this->input->get('item_per_page') ? $this->input->get('item_per_page') : 15;
        $input = $this->input->get();

        $this->product->search($input);

        $link_count = $this->product->paginate($page, $item_per_page);
        $products = $this->product->get_all();

        $view_data = array(
                        'products'   => $products, 
                        'link_count' => $link_count,
                        'page'       => $page
                    );

        if($user['is_admin'] == 1){
            $this->load->view('partials/admin/products', $view_data);
        }
        else{
            $this->load->view('partials/product/products', $view_data);
        }
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
    public function generate_csrf(){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        return $csrf;
    }
}
