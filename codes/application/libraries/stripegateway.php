<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include('../vendor/autoload.php');

class Stripegateway{
    
    public function __construct(){

        $stripe = array(
                "secret_key" => 'sk_test_51LR7TyLMi8lskCf07fBzJmbKvY6AZvd11k6Ol4AiGTHwDruEVW4pPEgETJzCxEE2IylmsiP9zVC32jypgWAhvis700UwqAJbZT',
                "public_key" => "pk_test_51LR7TyLMi8lskCf0T5e38yZieuztVferAImUPmMnOmCr1C91Q0VMmlOyKTaEAiIvmiBg303U4U09j5bBF2W1fzxo00PWToSkqh"
        );
        \Stripe\Stripe::setApiKey($stripe["secret_key"]);
    }

    public function checkout($data, $amount, $token){
        $response = "";
        try {
            $response = \Stripe\Charge::create(array(
                                    'amount'      => $amount * 100,
                                    'currency'    => 'php',
                                    'source'      => $token,
                                    'description' => "Name: {$data['b_first_name']} {$data['b_last_name']}  Address: {$data['b_address1']}"
                                ));
        } catch (Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }
}
?>