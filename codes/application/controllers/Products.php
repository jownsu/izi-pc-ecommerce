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
        DOCU: This function will redirect to login page if 
              the user is not logged in. Else it will render the
              home page.
        OWNER: Jhones
    */
	public function index(){
        $user_id = $this->get_user();

        echo "<h1>This is Home Page</h1>";
    }

    /*
        DOCU: This function will render products screen that shows
              all the products.
        OWNER: Jhones
    */
    public function all_products(){
        $user_id = $this->get_user();

        $view_data = array(
                        'categories' => $this->category->get_all(),
                        'cart_count' => $this->cart->cart_count($user_id)
                    );

        $this->load->view('product/products', $view_data);
    }

    /*
        DOCU: This function will render the product based on passed ID.
              It will also show 5 products with similar categories.
        OWNER: Jhones
    */
    public function show($id){
        $user_id = $this->get_user();
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $product = $this->product->get_by_id($id);

        $search_info = array(
            'category' => $product['category_id'],
            'limit'    => 5
        );

        $this->product->search($search_info);
        $similar_products = $this->product->get_all();

        $view_data  = array(
                        'product'          => $product,
                        'cart_count'       => $this->cart->cart_count($user_id),
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
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $input = $this->input->get();

        $this->product->search($input);

        $link_count = $this->product->paginate($page);
        $products = $this->product->get_all();

        $view_data = array(
                        'products'   => $products, 
                        'link_count' => $link_count,
                        'page'       => $page
                    );

		$this->load->view('partials/product/products', $view_data);
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
        if($user_id === NULL){
            redirect('/login');
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
