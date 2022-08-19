<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('category');
    }

    /*
        DOCU:  This function will return all the categories.
        OWNER: Jhones
    */
    public function index_html(){
        $categories = $this->category->get_all();
        $view_data = array(
                        'categories' => $categories,
                        'csrf'       => $this->generate_csrf()
                    );
        $this->load->view('partials/admin/categories', $view_data);
        // $this->output->set_content_type('application/json');
        // $this->output->set_output(json_encode($categories));
    }

    /*
        DOCU:  This function will return all the categories.
        OWNER: Jhones
    */
    public function delete(){
        $category_id = $this->input->post('category_id');
        if($this->category->delete($category_id)){
            $this->session->set_flashdata('success_msg', 'Category deleted');
        }else{
            $this->session->set_flashdata('error_msg', 'There is an error while deleting the category');
        }

        redirect('dashboard/products');
    }

    /*
        DOCU:  This function will update the category.
        OWNER: Jhones
    */
    public function update(){

        $input = $this->input->post(NULL, TRUE);

        if($this->category->update($input)){
            $this->session->set_flashdata('success_msg', 'Category updated');
        }else{
            $this->session->set_flashdata('error_msg', 'There is an error while updating the category');
        }

        redirect('dashboard/products');
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