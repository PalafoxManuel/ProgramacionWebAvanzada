<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
        die('Solicitud no válida: Token de seguridad no coincide.');
    }

    if (isset($_POST['action']) && $_POST['action'] === 'create_product') {
        $nombre = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $features = $_POST['features'];
        $image = $_FILES['image'];

        $productController = new ProductController();
        $response = $productController->createProducts($nombre, $slug, $description, $features, $image);

        if ($response) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/home?success=ok");
            exit();
        } else {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/home?error=error");
            exit();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update_product') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $features = $_POST['features'];

        $productController = new ProductController();
        $response = $productController->updateProduct($id, $name, $slug, $description, $features);

        if ($response) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/home?success=ok");
            exit();
        } else {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/home?error=error");
            exit();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'delete_product') {
        $id = $_POST['id'];

        $productController = new ProductController();
        $response = $productController->deleteProduct($id);

        if ($response) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/home?success=ok");
            exit();
        } else {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/home?error=error");
            exit();
        }
    }
}

class ProductController {
    public function getProducts() {
        if (!isset($_SESSION['user_token'])) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
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

    public function createProducts($nombre, $slug, $description, $features, $image) {
        if (!isset($_SESSION['user_token'])) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
            exit();
        }

        $token = $_SESSION['user_token'];

        $cfile = new CURLFile($image['tmp_name'], $image['type'], $image['name']);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'name' => $nombre,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
                'cover' => $cfile
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        if (isset($decodedResponse['code']) && $decodedResponse['code'] === 4) {
            return true;
        }

        return false;
    }

    public function updateProduct($id, $name, $slug, $description, $features) {
        if (!isset($_SESSION['user_token'])) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
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
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'id' => $id,
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        return isset($decodedResponse['code']) && $decodedResponse['code'] === 4;
    }

    public function deleteProduct($id) {
        if (!isset($_SESSION['user_token'])) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
            exit();
        }

        $token = $_SESSION['user_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        return isset($decodedResponse['code']) && $decodedResponse['code'] === 2;
    }

    public function getBrands() {
        if (!isset($_SESSION['user_token'])) {
            header("Location: /ProgramacionWebAvanzada/Unidad4/Actividad13/login");
            exit();
        }

        $token = $_SESSION['user_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
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
        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        return isset($decodedResponse['data']) ? $decodedResponse['data'] : [];
    }
}
?>
