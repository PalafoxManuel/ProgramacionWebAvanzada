<?php
session_start();

class ProductController {
    public function getProducts() {
        if (!isset($_SESSION['user_token'])) {
            header("Location: login.php");
            exit();
        }

        $token = $_SESSION['user_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        
        if ($response === false) {
            return [];
        }

        curl_close($curl);
        
        return json_decode($response, true);
    }
}
?>
