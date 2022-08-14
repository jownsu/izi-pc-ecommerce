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

    /* 
        DOCU: This function will validate the input of register. 
              If there is no error it will return true else it will
              return all the errors.
        OWNER: Jhones
    */
    public function validate_register_form(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("first_name", "First name", "trim|required|min_length[2]");
        $this->form_validation->set_rules("last_name", "Last name", "trim|required|min_length[2]");
        $this->form_validation->set_rules(
                                        "email", 
                                        "Email", 
                                        "trim|required|valid_email|is_unique[users.email]", 
                                        array("is_unique" => "Email is already taken")
                                    );
        $this->form_validation->set_rules("contact_no", "Contact number", "trim|required|numeric");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm password", "trim|required|matches[password]");

        if($this->form_validation->run() === FALSE){
            return validation_errors("<p class='alert-error'>", "</p>");
        }

        return TRUE;
    }

    /* 
        DOCU: This function will validate the input of log in. 
              If there is no error it will return true else it will
              return all the errors.
        OWNER: Jhones
    */
    public function validate_login_form(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");

        if($this->form_validation->run() === FALSE){
            return validation_errors("<p class='alert-error'>", "</p>");
        }

        return TRUE;
    }

    /* 
        DOCU: This function will validate the input of edit profile form. 
              If there is no error it will return true else it will
              return all the errors.
        OWNER: Jhones
    */
    public function validate_edit_profile_form(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                                        "email", 
                                        "Email", 
                                        "trim|required|valid_email|is_unique[users.email]", 
                                        array("is_unique" => "Email is already taken")
                                    );
        $this->form_validation->set_rules("first_name", "First name", "trim|required");
        $this->form_validation->set_rules("last_name", "Last name", "trim|required");

        if($this->form_validation->run() === FALSE){
            return validation_errors("<p class='alert-error'>", "</p>");
        }

        return TRUE;
    }

    /* 
        DOCU: This function will validate the input of edit password form. 
              If there is no error it will return true else it will
              return all the errors.
        OWNER: Jhones
    */
    public function validate_edit_password_form(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("old_password", "Old password", "trim|required");
        $this->form_validation->set_rules("new_password", "New password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm password", "trim|required|matches[new_password]");

        if($this->form_validation->run() === FALSE){
            return validation_errors("<p class='alert-error'>", "</p>");
        }

        return TRUE;
    }
}

?>