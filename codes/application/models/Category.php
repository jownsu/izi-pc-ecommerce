<?php

class Category extends CI_Model{

    /*
        DOCU:  This function will get all the categories
               with total count of products within it.
        OWNER: Jhones    
    */
    public function get_all(){
        $query = "SELECT categories.id, categories.name, COUNT(*) as total_product 
                    FROM categories 
                    INNER JOIN products ON products.category_id = categories.id
                    GROUP BY categories.id";
        return $this->db->query($query)->result_array();
    }

}

?>