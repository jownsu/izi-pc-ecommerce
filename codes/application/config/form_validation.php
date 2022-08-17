<?php

$config = array(

    'login' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    ),

    'register' => array(
        array(
            'field' => 'first_name',
            'label' => 'First name',
            'rules' => 'trim|required|min_length[2]'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last name',
            'rules' => 'trim|required|min_length[2]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email ',
            'rules' => 'trim|required|valid_email|is_unique[users.email]',
            "errors" => [
                'is_unique' => 'Email is already taken.',
            ],
        ),
        array(
            'field' => 'contact_no',
            'label' => 'Contact number',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm password',
            'rules' => 'trim|required|matches[password]'
        )
    ),

    'add_to_cart' => array(
        array(
            'field' => 'quantity',
            'label' => 'Quantiy',
            'rules' => 'trim|required|numeric|greater_than[0]'
        ),
        array(
            'field' => 'product_id',
            'label' => 'Product ID',
            'rules' => 'trim|required|numeric'
        )
    ),

    'remove_cart' => array(
        array(
            'field' => 'cart_id',
            'label' => 'Cart ID',
            'rules' => 'trim|required|numeric'
        )
    ),

    'update_cart' => array(
        array(
            'field' => 'cart_id',
            'label' => 'Cart ID',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'quantity',
            'label' => 'Quantity',
            'rules' => 'trim|required|numeric|greater_than[0]'
        )
    ),

    'update_status' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|numeric'
        )
    ),

    'order' => array(
        array(
                'field' => 'b_first_name',
                'label' => 'First name',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 'b_last_name',
                'label' => 'Last name',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 'b_address1',
                'label' => 'Address',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 'b_address2',
                'label' => 'Address 2',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 'b_city',
                'label' => 'City',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 'b_state',
                'label' => 'State',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 'b_zipcode',
                'label' => 'Zipcode',
                'rules' => 'trim|required|numeric'
        ),
        array(
                'field' => 's_first_name',
                'label' => 'First name',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 's_last_name',
                'label' => 'Last name',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 's_address1',
                'label' => 'Address',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 's_address2',
                'label' => 'Address 2',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 's_city',
                'label' => 'City',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 's_state',
                'label' => 'State',
                'rules' => 'trim|required'
        ),
        array(
                'field' => 's_zipcode',
                'label' => 'Zipcode',
                'rules' => 'trim|required|numeric'
        )
    )
);