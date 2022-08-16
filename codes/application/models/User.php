<?php

class User extends CI_Model{

    /*
        DOCU: This function will fetch user by email and return it
        OWNER: Jhones
    */
    public function find_user_by_email($email){
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
        return $this->db->query($query, $this->security->xss_clean($email))->row_array();
    }

    /*
        DOCU: This function will fetch admin by email and return it
        OWNER: Jhones
    */
    public function find_admin_by_email($email){
        $query = "SELECT * FROM users WHERE email = ? AND is_admin = 1 LIMIT 1";
        return $this->db->query($query, $this->security->xss_clean($email))->row_array();
    }

    /*
        DOCU: This function will fetch user by email and return it
        OWNER: Jhones
    */
    public function find_user_by_id($id){
        $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
        return $this->db->query($query, $this->security->xss_clean($id))->row_array();
    }

    /*
        DOCU: This function will check if the table users has record
        OWNER: Jhones
    */
    public function has_user_record(){
        $query = "SELECT id FROM users LIMIT 1";
        if($this->db->query($query)->row_array()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /*
        DOCU: This function will return true if the input password 
               and password in database will match else it will return false
        OWNER: Jhones

    */
    public function password_match($input_password, $user){
        if(md5($input_password . '' . $user['salt']) === $user['password']){
            return TRUE;
        }
        return FALSE;
    }

    /*
        DOCU: This function will create user and save it to database
        OWNER: Jhones
    */
    public function create_user($input){
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $encrypted_password = md5($this->security->xss_clean($input['password']) . '' . $salt);
        $query = "INSERT INTO users (first_name, last_name, email, is_admin, password, salt, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $values = array(
                            $this->security->xss_clean($input['first_name']),  
                            $this->security->xss_clean($input['last_name']),  
                            $this->security->xss_clean($input['email']),
                            $this->security->xss_clean($input['is_admin']),
                            $encrypted_password, 
                            $salt
                        );
        return $this->db->query($query, $values);
    }

    /*
        DOCU: This function will update the information of the selected user.
        OWNER: Jhones
    */
    public function update_profile_info($user_id, $input){
        $query = "UPDATE users SET email = ?, first_name = ?, last_name = ?, updated_at = NOW() WHERE id = ?";
        $values = array(
                    $this->security->xss_clean($input['email']),
                    $this->security->xss_clean($input['first_name']),
                    $this->security->xss_clean($input['last_name']),
                    $this->security->xss_clean($user_id)
                );
        return $this->db->query($query, $values);
    }

    /*
        DOCU: This function will update the password of the selected user.
        OWNER: Jhones
    */
    public function update_password($user_id, $password){
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $encrypted_password = md5($this->security->xss_clean($password) . '' . $salt);

        $query = "UPDATE users SET password = ?, salt = ?, updated_at = NOW() WHERE id = ?";
        $values = array($encrypted_password, $salt, $user_id);
        return $this->db->query($query, $values);
    }
}

?>