<?php

class Category extends CI_Model{

    /*
        DOCU:  This function will get all the categories
               with total count of products within it.
        OWNER: Jhones    
    */
    public function get_all_with_count(){
        $query = "SELECT categories.id, categories.name, COUNT(*) as total_product 
                    FROM categories 
                    INNER JOIN products ON products.category_id = categories.id
                    GROUP BY categories.id";
        return $this->db->query($query)->result_array();
    }

    /*
        DOCU:  This function will get all the categories
               with total count of products within it.
        OWNER: Jhones    
    */
    public function get_all(){
        $query = "SELECT categories.id, categories.name FROM categories GROUP BY categories.id";
        return $this->db->query($query)->result_array();
    }
    /*
        DOCU:  This function will create a category
        OWNER: Jhones    
    */
    public function create($name){
        $query = "INSERT INTO categories (name) VALUES (?)";
        $values = array($this->security->xss_clean($name));
        $this->db->query($query, $values);
        return $this->db->insert_id();
    }

}

?>