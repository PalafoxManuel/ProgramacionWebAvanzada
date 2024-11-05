<?php 

include_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['action'])) {
    $authController = new AuthController();
    
    switch ($_POST['action']) {
        case 'access':
            if (isset($_POST['global_token'], $_SESSION['global_token']) && $_POST['global_token'] === $_SESSION['global_token']) {
                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['password']);
                $authController->login($email, $password);
            } else {
                die('Solicitud no válida: Token de seguridad no coincide.');
            }
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            die('Acción no válida.');
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
            CURLOPT_POSTFIELDS => array(
                'email' => $email,
                'password' => $password
            ),
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data->name)) {
            $_SESSION['user_data'] = $response->data;
            $_SESSION['user_id'] = $response->data->id;
            header('Location: ' . BASE_PATH . 'home');
            exit();
        } else {
            $_SESSION['login_error'] = "Credenciales incorrectas. Inténtalo de nuevo.";
            header('Location: ' . BASE_PATH . 'login');
            exit();
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: " . BASE_PATH . "login"); 
        exit();
    }
}
?>
