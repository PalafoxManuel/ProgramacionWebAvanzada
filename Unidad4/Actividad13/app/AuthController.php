<?php 
session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); 

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'access':
                $authController = new AuthController();

                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['password']);
                $authController->login($email, $password);
                break;
        }
    }
}

class AuthController
{
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

        curl_close($curl);
        
        $responseData = json_decode($response, true);
        if (isset($responseData['success']) && $responseData['success'] == true) {
            $_SESSION['user_id'] = $responseData['data']['id'];
            echo "Login exitoso. Bienvenido, " . htmlspecialchars($email) . "!";
        } else {
            echo "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    }
}
?>
