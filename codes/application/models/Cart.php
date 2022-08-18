<?php

class Cart extends CI_Model{

    /*
        DOCU:  This function will get all the Cart with the 
               info of pruducts. The rows are id, product_id, 
               name, quantity, inventory and price.
        OWNER: Jhones    
    */
    public function get_all($user_id){
        $query = "SELECT carts.id, carts.product_id, products.name, carts.quantity, products.price, products.inventory, products.sold  
                    FROM carts 
                    INNER JOIN products ON carts.product_id = products.id 
                    WHERE user_id = ?";
        $values = array($this->security->xss_clean($user_id));
        return $this->db->query($query, $values)->result_array();
    }

    /*
        DOCU:  This function will check if the product exists in 
               the users cart. If it exists it will return the id of it
               else it will return null.
        OWNER: Jhones    
    */
    public function is_product_exists($user_id, $product_id){
        $query = "SELECT id 
                    FROM carts as cart_count 
                    WHERE user_id = ? AND product_id = ?";
        $values = array(
                    $this->security->xss_clean($user_id),
                    $this->security->xss_clean($product_id)
        );

        return $this->db->query($query, $values)->row_array();
    }

    /*
        DOCU:  This function will increment the quantity of product
               in the cart of the user based on the input.
        OWNER: Jhones    
    */
    public function increment_cart($user_id, $input){
        $query = "UPDATE carts 
                    SET quantity = quantity + ?, 
                        updated_at = NOW() 
                    WHERE user_id = ? AND product_id = ?";

        $values = array(
            $this->security->xss_clean($input['quantity']),
            $this->security->xss_clean($user_id), 
            $this->security->xss_clean($input['product_id'])
        );

        return $this->db->query($query, $values);
    }

    /*
        DOCU:  This function will update the quantity of product
               in the cart of the user based on the input.
        OWNER: Jhones    
    */
    public function update_cart($user_id, $input){
        $query = "UPDATE carts 
                    SET quantity = ?, 
                        updated_at = NOW() 
                    WHERE user_id = ? AND id = ?";

        $values = array(
            $this->security->xss_clean($input['quantity']),
            $this->security->xss_clean($user_id), 
            $this->security->xss_clean($input['cart_id'])
        );

        return $this->db->query($query, $values);
    }

    /*
        DOCU:  This function will add product to the cart of 
               the user.
        OWNER: Jhones    
    */
    public function add_to_cart($user_id, $input){
        $query = "INSERT INTO carts (user_id, product_id, quantity, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";

        $values = array(
            $this->security->xss_clean($user_id), 
            $this->security->xss_clean($input['product_id']), 
            $this->security->xss_clean($input['quantity'])
        );

        return $this->db->query($query, $values);
    }

    /*
        DOCU:  This function will count all the products in the 
               cart of the user.
        OWNER: Jhones    
    */
    public function cart_count($user_id){
        $query = "SELECT COUNT(*) as cart_count FROM carts WHERE user_id = ?";
        $values = array($this->security->xss_clean($user_id));
        return $this->db->query($query, $values)->row_array()['cart_count'];
    }

    /*
        DOCU:  This function will remove the product in the 
               cart of the user.
        OWNER: Jhones    
    */
    public function remove_to_cart($user_id, $cart_id){
        $query = "DELETE FROM carts WHERE user_id = ? AND id = ?";
        $values = array(
                        $this->security->xss_clean($user_id),
                        $this->security->xss_clean($cart_id)
        );
        return $this->db->query($query, $values);
    }

    /*
        DOCU:  This function will delete all the product in 
               the cart of the user.
        OWNER: Jhones    
    */
    public function reset_cart($user_id){
        $query = "DELETE FROM carts WHERE user_id = ?";
        $values = array($this->security->xss_clean($user_id));
        return $this->db->query($query, $values);
    }

    public function inventory_check($cart){
        $err = array();
        foreach($cart as $val){
            if($val['quantity'] > $val['inventory']){
                $err[] = "You can buy only maximum of {$val['inventory']} pcs. in {$val['name']}";
            }
        }
        return !empty($err) ? $err : TRUE;
    }
}

?>