<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('product');
        $this->load->model('cart');
        $this->load->model('category');
        $this->load->library('form_validation');
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
                        'categories' => $this->category->get_all_with_count(),
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
        $view_data = array( 
                        'csrf'        => $this->generate_csrf(), 
                        'success_msg' => $this->session->flashdata('success_msg'),
                        'error_msg'   => $this->session->flashdata('error_msg')
                    );
        $this->load->view('admin/products_dashboard', $view_data);
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
        DOCU: This function will render the product based on passed ID.
              It will also show 5 products with similar categories.
        OWNER: Jhones
    */
    public function ajax_show($id){
        $product = $this->product->get_by_id($id);
        $product['images'] = json_decode($product['images']);

        $output = array(
            'product' => $product,
            'csrf'    => $this->generate_csrf()
        );

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($output));
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
        DOCU:  This function will trigger if the add/edit product form is submitted.
               If product_id is existed it will update the product else it will
               create one.
        OWNER: Jhones
    */
    public function save(){
        if($this->form_validation->run('add_product') === FALSE){
            $this->session->set_flashdata('error_msg', validation_errors());
        }
        else if (empty($this->input->post('category_id')) && empty($this->input->post('add_category'))){
            $this->session->set_flashdata('error_msg', "Category is required");
        }
        else{
            if(!empty($input['product_id'])){
                $this->update_product();
            }else{
                $this->create_product();
            }
        }
        redirect('dashboard/products');
    }

    /*
        DOCU:  This function will trigger if the delete product form is submitted.
               It will delete a product.
        OWNER: Jhones
    */
    public function delete(){
        if($this->form_validation->run('delete_product') === FALSE){
            $this->session->set_flashdata('error_msg', validation_errors());
        }
        else{
            $product_id = $this->input->post('product_id');
        
            $this->product->delete($product_id);
            $this->session->set_flashdata('success_msg', 'Product deleted.');
        }
        redirect('dashboard/products');
    }

    /*
        DOCU:  This function will create a product
        OWNER: Jhones
    */
    private function create_product(){
        $input = $this->input->post(NULL, TRUE);

        $input['images'] = $this->upload_images($_FILES);
        if(!empty($input['add_category'])){
            $category_id = $this->category->create($input['add_category']);
            $input['category_id'] = $category_id;
        }
        $this->product->create($input);
        $this->session->set_flashdata('success_msg', 'Product added.');
    }
    
    /*
        DOCU:  This function will update a product
        OWNER: Jhones
    */
    private function update_product(){
        $input = $this->input->post(NULL, TRUE);

        if(!empty($_FILES['images']['name'][0])){
            $input['images'] = $this->upload_images($_FILES);
        }
        if(!empty($input['add_category'])){
            $category_id = $this->category->create($input['add_category']);
            $input['category_id'] = $category_id;
        }
        $this->product->update($input);
        $this->session->set_flashdata('success_msg', 'Product updated.');
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

    /*
        DOCU:  This function will upload the images in the ./public/images folder.
        OWNER: Jhones
    */
    private function upload_images($file){
        $data = [];
        $count = count($file['images']['name']);
        for($i=0;$i<$count;$i++){
      
            if(!empty($file['images']['name'][$i])){
                $_FILES['image']['name']     = $file['images']['name'][$i];
                $_FILES['image']['type']     = $file['images']['type'][$i];
                $_FILES['image']['tmp_name'] = $file['images']['tmp_name'][$i];
                $_FILES['image']['error']    = $file['images']['error'][$i];
                $_FILES['image']['size']     = $file['images']['size'][$i];

                $config = array(
                    'upload_path'   => "./public/images",
                    'allowed_types' => "jpg|jpeg|png|gif",
                    'max_size'      => '2048000',
                    'file_name'     => $file['images']['name'][$i], 
                );
            
                $this->load->library('upload',$config); 
            
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data[] = $filename;
                }
            }
        }
        return !empty($data) ? $data : array('placeholder.png');
    }
}
