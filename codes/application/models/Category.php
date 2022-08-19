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

    /*
        DOCU:  This function will delete a category
        OWNER: Jhones    
    */
    public function delete($id){
        $query = "DELETE FROM categories WHERE id = ?";
        $values = array($this->security->xss_clean($id));
        return $this->db->query($query, $values);
    }

    /*
        DOCU:  This function will update a category
        OWNER: Jhones    
    */
    public function update($input){
        $query = "UPDATE categories SET name = ? WHERE id = ?";
        $values = array(
                    $this->security->xss_clean($input['category_name']),
                    $this->security->xss_clean($input['category_id'])
                );
        return $this->db->query($query, $values);
    }

}

?>