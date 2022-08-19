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

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($categories));
    }
}