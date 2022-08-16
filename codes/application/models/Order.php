<?php

class Order extends CI_Model{
    
    /*
        DOCU:   This function will return all the orders with the
                rows of order_id, name, date, address, total, and status.
        OWNDER: Jhones
    */
    function get_all_orders(){
        $query = "SELECT orders.id, 
                            CONCAT(billing.first_name, ' ', billing.last_name) as name, 
                            DATE_FORMAT(orders.updated_at, '%m/%d/%Y') as date, 
                            billing.address, 
                            SUM(order_product.price * order_product.quantity) as total,
                            orders.status
                    FROM orders
                    INNER JOIN billing ON orders.id = billing.order_id
                    INNER JOIN order_product ON orders.id = order_product.order_id
                    GROUP BY orders.id";

        return $this->db->query($query)->result_array();
    }

    /*
        DOCU:  This function will get the order with their products
        OWNER: Jhones
    */
    function get_item_orders($id){
        $query = "SELECT id, product_name, price, quantity
                    FROM order_product
                    WHERE order_id = ?";
        return $this->db->query($query, array($id))->result_array();
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
    function add_order_billing($order_id, $input){
        $query = "INSERT INTO billing (order_id, first_name, last_name, address, address_2, city, state, zipcode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $values = array(
            $this->security->xss_clean($order_id),
            $this->security->xss_clean($input['b_first_name']),
            $this->security->xss_clean($input['b_last_name']),
            $this->security->xss_clean($input['b_address1']),
            $this->security->xss_clean($input['b_address2']),
            $this->security->xss_clean($input['b_city']),
            $this->security->xss_clean($input['b_state']),
            $this->security->xss_clean($input['b_zipcode'])
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
}

?>