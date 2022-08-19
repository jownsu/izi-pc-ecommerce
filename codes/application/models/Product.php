<?php

class Product extends CI_Model{

    private $query = "";
    private $where = "";
    private $order_by = "";
    private $limit = "";
    private $values = array();

    public $img_path = 'public/images/';

    /*
        DOCU: This function will return the fetched value.
              This must be called last after all the query functions.
              This is the rows that will return.
              id, name, price, image
        OWNER: Jhones
    */
    public function get_all(){
        $select = "SELECT id, name, price, inventory ,sold, JSON_EXTRACT(images, '$[0]') AS image FROM products ";
        return $this->db->query($select . $this->query . $this->where . $this->order_by . $this->limit , $this->values)->result_array();
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
        $this->and_where('category_id = ?');
        $this->values[] = $this->security->xss_clean($cat_id);
    }
    
    /*
        DOCU: This function append to the order by query to sort by 
              price and receives an argument whether it is sorted by 
              ascending or descending. The default value is ASC
        OWNER: Jhones
    */
    private function order_by_price($sort = 'ASC'){
        $this->order_by .= "ORDER BY price ";
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

        if(!empty($input['limit'])){
            $this->limit = "LIMIT " . $input['limit'];
        }

        if(!empty($input['category'])){
            $this->category($input['category']);
        }

        if(!empty($input['order'])){
            $this->order_by_price($input['order']);
        }else{
            $this->order_by = "ORDER BY created_at DESC ";
        }
    }

    /*
        DOCU: This function will apply LIMIT and OFFSET statement to the query.
              It will apply pagination to the query and it will return the total pages of the pagination. This function must be called before the get_all()
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
        DOCU: This helper function will setup up where property.
        OWNER: Jhones
    */
    private function and_where($query){
        $this->where .= empty($this->where) ? 'WHERE ' : 'AND ';
        $this->where .= $query . ' ';
    }

    /*
        DOCU: This function will get the product by ID.
              The rows that will return are id, name, description,
              price, category_id and images.
        OWNER: Jhones
    */
    public function get_by_id($id){
        $query = "SELECT id, name, description, price, category_id, images
                    FROM products 
                    WHERE id = ?
                    LIMIT 1";

        $values = array($this->security->xss_clean($id));

        return $this->db->query($query, $values)->row_array();
    }

    /*
        DOCU: This function will decrement the quantites of all product
              in the cart.
        OWNER: Jhones
    */
    public function decrement_quantities($cart){
        foreach($cart as $val){
            $query = "UPDATE products SET inventory = ?, sold = ? WHERE id = ?";
            $values = array();

            $values[] = $this->security->xss_clean($val['inventory'] - $val['quantity']);
            $values[] = $this->security->xss_clean($val['sold'] + $val['quantity']);
            $values[] = $this->security->xss_clean($val['product_id']);

            $this->db->query($query, $values);
        }  
    }

    /*
        DOCU: This function will get the product by ID.
              The rows that will return are id, name, description,
              price, category_id, sub_images, main_image
        OWNER: Jhones
    */
    public function create($input){
        $query = "INSERT INTO products (category_id, name, description, inventory, price, images, created_at) 
                VALUES(?, ?, ?, ?, ?, ?, NOW())";

        $values = array(
            $this->security->xss_clean($input['category_id']),
            $this->security->xss_clean($input['name']),
            $this->security->xss_clean($input['description']),
            $this->security->xss_clean($input['inventory']),
            $this->security->xss_clean($input['price']),
            $this->security->xss_clean(json_encode($input['images']))
        );

        return$this->db->query($query, $values);
    }

    /*
        DOCU: This function will delete a product
        OWNER: Jhones
    */
    public function delete($product_id){
        $query = "DELETE FROM products WHERE id = ?";
        $values = array($this->security->xss_clean($product_id));
        return $this->db->query($query, $values);
    }
}

?>