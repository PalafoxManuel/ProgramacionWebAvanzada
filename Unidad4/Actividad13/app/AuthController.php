<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'access') {
        $authController = new AuthController();
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $authController->login($email, $password);
    }
}

class AuthController {
    public function login($email = null, $password = null) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array('email' => $email, 'password' => $password)),
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);
        
        if ($response === false) {
            $_SESSION['login_error'] = "Error en la conexión: " . curl_error($curl);
            header("Location: ../login.php");
            exit();
        }

        curl_close($curl);
        
        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] == 2) {
            $_SESSION['user_id'] = $responseData['data']['id'];
            $_SESSION['user_name'] = $responseData['data']['name'];
            $_SESSION['user_token'] = $responseData['data']['token'];
            $_SESSION['user_data'] = $responseData['data'];

            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Credenciales incorrectas. Inténtalo de nuevo.";
            unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_token'], $_SESSION['user_data']);
            header("Location: ../login.php");
            exit();
        }
    }
}
?>
