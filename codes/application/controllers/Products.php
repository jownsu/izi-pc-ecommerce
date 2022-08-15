<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('product');
        $this->load->model('category');
    }

    /*
        DOCU: This function will redirect to login page if 
              the user is not logged in. Else it will render the
              home page.
        OWNER: Jhones
    */
	public function index(){
        if($this->session->userdata('user_id') === NULL){
            redirect('/login');
            exit();
        }

        echo "<h1>This is Home Page</h1>";
    }

    /*
        DOCU: This function will render products screen that shows
              all the products.
        OWNER: Jhones
    */

    public function all_products(){
        $categories = $this->category->get_all();
        $view_data = array( 'categories' => $categories );
        $this->load->view('product/products', $view_data);
    }

    public function show($id){
        $page = $this->input->get('page') ? $this->input->get('page') : 1;

        $product = $this->product->get_by_id($id);

        $this->product->search(array(
                                'category' => $product['category_id'],
                                'limit' => 5
                            ));
        $products = $this->product->get_all();

        $view_data  = array(
                        'product'         => $product,
                        'similar_products' => $products,
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

		$htmlResponse = $this->load->view('partials/product/products', $view_data, true);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array(
                'html_response' => $htmlResponse,
            )));
	}
}
