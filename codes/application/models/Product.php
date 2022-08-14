<?php

class Product extends CI_Model{

    private $select = "SELECT products.id as id, products.name, products.price, images.image 
                        FROM products 
                        INNER JOIN images ON products.id = images.product_id ";
    private $query = "";
    private $where = "";
    private $order_by = "";
    private $limit = "";
    private $values = array();

    public $img_path = 'public/images/';

    /*
        DOCU: This function will return the fetched value.
              This must be called last after all the query functions.
        OWNER: Jhones
    */
    public function get_all(){
        $this->and_where('images.main = 1');
        return $this->db->query($this->final_query(), $this->values)->result_array();
    }

    /*
        DOCU: This query function will append WHERE statement
              to search for a specified pattern by name.
        OWNER: Jhones
    */
    public function name($name = ''){
        $this->and_where('name LIKE ?');
        $this->values[] = '%' . $this->security->xss_clean($name) . '%';   
    }

    /*
        DOCU: This query function will append WHERE statement
              to filter the products by category id.
        OWNER: Jhones
    */
    public function category($cat_id){
        $this->and_where('products.category_id = ?');
        $this->values[] = $this->security->xss_clean($cat_id);
    }
    
    /*
        DOCU: This function append to the order by query to sort by 
              price and receives an argument whether it is sorted by 
              ascending or descending. The default value is ASC
        OWNER: Jhones
    */
    private function order_by($sort = 'ASC'){
        $this->order_by .= "ORDER BY products.price ";
        $this->order_by .= $sort == 'DESC' ? 'DESC ' : 'ASC ';
    }

    /*
        DOCU: This function will setup up the query based on the given input. 
        OWNER: Jhones
    */
    public function search($input){

        if(!empty($input['name'])){
            $this->name($input['name']);
        }else{
            $this->name('');
        }

        if(!empty($input['category'])){
            $this->category($input['category']);
        }

        if(!empty($input['order'])){
            $this->order_by($input['order']);
        }else{
            $this->order_by('ASC');
        }
    }

    /*
        DOCU: This function will apply LIMIT and OFFSET statement to the query.
              It will apply pagination to the query and it will return the total pages of
              the pagination. This function must be called before the get_all()
        OWNER: Jhones
    */
    public function paginate($page = 1, $item_per_page = 15){
        $offset = ($page - 1) * ($item_per_page);
        $total_count = $this->count_all();
        $this->limit = "LIMIT $item_per_page OFFSET $offset ";
        return ceil($total_count / $item_per_page);
    }

    /*
        DOCU: This function will count the current query. This is called 
              inside the paginate function that used to calculate the total
              pages of pagination.
        OWNER: Jhones
    */
    private function count_all(){
        return $this->db->query("SELECT COUNT(*) as count FROM products " . $this->query . $this->where, $this->values)->row_array()['count'];
    }

    /*
        DOCU: This helper function will concatenate all the query properties
              and return it.
        OWNER: Jhones
    */
    private function final_query(){
        return $this->select . $this->query . $this->where . $this->order_by . $this->limit;
    }
    
    /*
        DOCU: This helper function will setup up where property.
        OWNER: Jhones
    */
    private function and_where($query){
        $this->where .= empty($this->where) ? 'WHERE ' : 'AND ';
        $this->where .= $query . ' ';
    }

}

?>