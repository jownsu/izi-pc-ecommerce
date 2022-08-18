<?php

class Order extends CI_Model{

    private $query = "";
    private $where = "";
    private $limit = "";
    private $values = array();
    
    /*
        DOCU:   This function will return all the orders with the
                rows of order_id, name, date, address, total, and status.
        OWNDER: Jhones
    */
    function get_all(){
        $select = "SELECT orders.id, 
                        CONCAT(billing.first_name, ' ', billing.last_name) as name, 
                        DATE_FORMAT(orders.updated_at, '%m/%d/%Y') as date, 
                        billing.address, 
                        SUM(order_product.price * order_product.quantity) as total,
                        orders.status
                    FROM orders
                    INNER JOIN billing ON orders.id = billing.order_id
                    INNER JOIN order_product ON orders.id = order_product.order_id ";

        $test = $select . $this->query . $this->where . 'GROUP BY orders.id ' . $this->limit . ' ORDER BY orders.updated_at' ;
        return $this->db->query($select . $this->query . $this->where . 'GROUP BY orders.id ORDER BY orders.updated_at DESC ' . $this->limit, $this->values)->result_array();
    }

    /*
        DOCU: This function will setup up the query based on the given input. 
        OWNER: Jhones
    */
    public function search($input){
        if(!empty($input['search'])){
            $this->name($input['search']);
        }

        if(!empty($input['search'] && is_numeric($input['search']))){
            $this->order_id($input['search']);
        }

        if(!empty($input['status']) && $input['status'] != ''){
            $this->status($input['status']);
        }
    }

    /*
        DOCU: This query function will append WHERE statement
              to search for a specified pattern by first name or last name.
        OWNER: Jhones
    */
    public function name($name = ''){
        $this->or_where('( billing.first_name LIKE ? OR billing. last_name LIKE ?) ');
        $this->values[] = '%' . $this->security->xss_clean($name) . '%';   
        $this->values[] = '%' . $this->security->xss_clean($name) . '%';   
    }
    
    /*
        DOCU: This query function will append WHERE statement
              to search for a specified order id.
        OWNER: Jhones
    */
    public function order_id($order_id){
        $this->or_where('orders.id = ?');
        $this->values[] = $this->security->xss_clean($order_id);   
    }

    /*
        DOCU: This query function will append WHRE statement
              to search for a specified status.
        OWNER: Jhones
    */
    public function status($status){
        $this->and_where('orders.status = ? ');
        $this->values[] = $this->security->xss_clean($status);   
    }

    /*
        DOCU: This function will apply LIMIT and OFFSET statement to the query.
              It will apply pagination to the query and it will return the total pages of the pagination. 
              This function must be called before the get_all().
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
        // return $this->db->query($select . $this->query . $this->where . 'GROUP BY orders.id ' . $this->limit, $this->values)->result_array();

        $select = "SELECT DISTINCT COUNT(*) OVER() as count FROM orders 
                INNER JOIN billing ON orders.id = billing.order_id
                INNER JOIN order_product ON orders.id = order_product.order_id ";

        return $this->db->query($select . $this->query . $this->where . 'GROUP BY orders.id ', $this->values)->row_array()['count'] ?? 0;
    }

    /*
        DOCU:  This function will get the order with their products
        OWNER: Jhones
    */
    function get_item_orders($id){
        $query = "SELECT id, product_name, price, quantity
                    FROM order_product
                    WHERE order_id = ?";
        $values = array($this->security->xss_clean($id));
        
        return $this->db->query($query, $values)->result_array();
    }

    /*
        DOCU:   This function will return single orders with their 
                shipping and billing values.
        OWNDER: Jhones
    */
    public function get_by_id($id){
        $query = "SELECT orders.id, 
                        orders.status,
                        CONCAT(shipping.first_name, ' ', shipping.last_name) as s_name, 
                        shipping.address as s_address, 
                        shipping.city as s_city,
                        shipping.state as s_state,
                        shipping.zipcode as s_zipcode,
                        CONCAT(billing.first_name, ' ', billing.last_name) as b_name, 
                        billing.address as b_address, 
                        billing.city as b_city,
                        billing.state as b_state,
                        billing.zipcode as b_zipcode
                FROM orders 
                INNER JOIN billing ON orders.id = billing.order_id
                INNER JOIN shipping ON orders.id = shipping.order_id
                WHERE orders.id = ? ";

        $values = array($this->security->xss_clean($id));

        return $this->db->query($query, $values)->row_array();
    }

    /*
        DOCU:  This function will create an order and return its inserted ID
        OWNER: Jhones
    */
    function add_order($input){
        $query = "INSERT INTO orders (status, created_at, updated_at) VALUES (?, NOW(), NOW())";
        $values = array(1);
        $this->db->query($query, $values);
        return $this->db->insert_id();
    }

    /*
        DOCU:  This function will create record in billing with relation
               to the order.
        OWNER: Jhones
    */
    function add_order_billing($order_id, $input, $transac_id){
        $query = "INSERT INTO billing (order_id, first_name, last_name, address, address_2, city, state, zipcode, transaction_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $values = array(
            $this->security->xss_clean($order_id),
            $this->security->xss_clean($input['b_first_name']),
            $this->security->xss_clean($input['b_last_name']),
            $this->security->xss_clean($input['b_address1']),
            $this->security->xss_clean($input['b_address2']),
            $this->security->xss_clean($input['b_city']),
            $this->security->xss_clean($input['b_state']),
            $this->security->xss_clean($input['b_zipcode']),
            $this->security->xss_clean($transac_id)
        );

        return $this->db->query($query, $values);
    }

    /*
        DOCU:  This function will create record in shipping with relation
               to the order.
        OWNER: Jhones
    */
    function add_order_shipping($order_id, $input){
        $query = "INSERT INTO shipping (order_id, first_name, last_name, address, address_2, city, state, zipcode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $values = array(
            $this->security->xss_clean($order_id),
            $this->security->xss_clean($input['s_first_name']),
            $this->security->xss_clean($input['s_last_name']),
            $this->security->xss_clean($input['s_address1']),
            $this->security->xss_clean($input['s_address2']),
            $this->security->xss_clean($input['s_city']),
            $this->security->xss_clean($input['s_state']),
            $this->security->xss_clean($input['s_zipcode'])
        );

        return $this->db->query($query, $values);
    }
    
    /*
        DOCU:  This function will store all products in a specific order 
               with their product_name, quantity and price.
        OWNER: Jhones
    */
    function add_order_product($order_id, $cart){
        $query = "INSERT INTO order_product (order_id, product_name, quantity, price, created_at, updated_at) VALUES ";
        $values = array();

        $i = 0;
        $length = count($cart);
        foreach($cart as $val){
  
            $values[] = $this->security->xss_clean($order_id);
            $values[] = $this->security->xss_clean($val['name']);
            $values[] = $this->security->xss_clean($val['quantity']);
            $values[] = $this->security->xss_clean($val['price']);

            $query .= "(?, ?, ?, ?, NOW(), NOW())";
            if($i < $length - 1){
                $query .= ', ';
            }
            $i++;
        }
        
        return $this->db->query($query, $values);
    }

    public function update_status($order_id, $status){
        $query = "UPDATE orders SET status = ? WHERE id = ?";
        $values = array(
                    $this->security->xss_clean($status),
                    $this->security->xss_clean($order_id)
        );

        return $this->db->query($query, $values);
    }
    
    /*
        DOCU: This function will setup up where property.
        OWNER: Jhones
    */
    private function and_where($query){
        $this->where .= empty($this->where) ? 'WHERE ' : 'AND ';
        $this->where .= $query . ' ';
    }

    /*
        DOCU: This function will setup up where property.
        OWNER: Jhones
    */
    private function or_where($query){
        $this->where .= empty($this->where) ? 'WHERE ' : 'OR ';
        $this->where .= $query . ' ';
    }
}

?>