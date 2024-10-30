<?php
session_start();

if (isset($_GET['slug'])) {
    $productSlug = $_GET['slug'];

    function getProductDetails($slug) {
        if (!isset($_SESSION['user_token'])) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
            exit();
        }

        $token = $_SESSION['user_token']; 

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
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
            curl_close($curl);
            function getProductDetails($slug) {
                if (!isset($_SESSION['user_token'])) {
                    header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
                    exit();
                }
            
                $token = $_SESSION['user_token'];
            
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
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
            
                // Verificar errores de cURL
                if ($response === false) {
                    $error = curl_error($curl);
                    curl_close($curl);
                    echo '<div class="alert alert-danger">Error de conexión a la API: ' . htmlspecialchars($error) . '</div>';
                    exit();
                }
            
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
            
                // Verificar si la respuesta es exitosa (código HTTP 200)
                if ($httpCode !== 200) {
                    echo '<div class="alert alert-danger">Error en la solicitud a la API. Código de respuesta: ' . $httpCode . '</div>';
                    exit();
                }
            
                $decodedResponse = json_decode($response, true);
            
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo '<div class="alert alert-danger">Error al decodificar la respuesta de la API.</div>';
                    exit();
                }
            
                return $decodedResponse;
            }
                 echo '<div class="alert alert-danger">Error de conexión a la API.</div>';
            exit();
        }

        curl_close($curl);
        return json_decode($response, true);
    }

    $product = getProductDetails($productSlug);

    if (!$product || !isset($product['data'])) {
        echo '<div class="alert alert-danger" role="alert">Producto no encontrado.</div>';
        exit();
    } else {
        $product = $product['data'];
    }
} else {
    echo '<div class="alert alert-danger" role="alert">No se proporcionó un slug de producto.</div>';
    exit();
}
?>
