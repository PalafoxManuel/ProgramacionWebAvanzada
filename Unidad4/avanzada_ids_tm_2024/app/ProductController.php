<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['action'])) {
    $producController = new ProducController();

    switch ($_POST['action']) {
        case 'create_product':
            $name = $_POST['name'] ?? null;
            $slug = $_POST['slug'] ?? null;
            $description = $_POST['description'] ?? '';
            $features = $_POST['features'] ?? '';
            $cover = isset($_FILES['cover']) && !empty($_FILES['cover']['tmp_name']) ? $_FILES['cover'] : null;
            $brand_id = $_POST['brand_id'] ?? null;
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $categories = isset($_POST['category']) ? $_POST['category'] : [];
            $price = $_POST['price'] ?? 0;
            $original_price = $_POST['original_price'] ?? null;
            $stock = $_POST['stock'] ?? 0;
            $sku = $_POST['sku'] ?? null;

            if (!$name || !$slug || !$cover || !$brand_id || empty($categories)) {
                header('Location: ../create.php?status=error&msg=Missing Required Fields');
                exit;
            }

            $presentations = [
                [
                    'price' => $price,
                    'original_price' => $original_price,
                    'stock' => $stock,
                    'sku' => $sku
                ]
            ];

            $result = $producController->create(
                $name,
                $slug,
                $description,
                $features,
                $cover,
                $brand_id,
                $tags,
                $categories,
                $presentations
            );

            if (isset($result->code) && $result->code == 4) {
                header('Location: ../home.php?status=ok');
            } else {
                $errorMsg = $result->message ?? 'Unknown error';
                header('Location: ../create.php?status=error&msg=' . urlencode($errorMsg));
            }
            break;
    }
}


class ProducController
{
 
	public function get()
	{ 

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
		    'Authorization: Bearer '.$_SESSION['user_data']->token
		  ),
		));

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->data) && count($response->data)) {
			
			return $response->data;
		}

		return array();

	}


	public function getBySlug($slug)
	{ 

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$_SESSION['user_data']->token
		  ),
		));

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->data) && !is_null($response->data)) {
			
			return $response->data;
		}

		return null;

	}

	public function create($name, $slug, $description, $features, $cover, $brand_id, $tags, $categories, $presentations = [])
    {
        $curl = curl_init();

        $coverFile = curl_file_create($cover['tmp_name'], $cover['type'], $cover['name']);

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
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
                'cover' => $coverFile,
                'brand_id' => $brand_id,
                'tags' => json_encode($tags),
                'categories' => json_encode($categories),
                'presentations' => json_encode($presentations)
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            $errorMessage = curl_error($curl);
            curl_close($curl);
            header('Location: ../home.php?status=error&msg=' . urlencode('CURL Error: ' . $errorMessage));
            exit;
        }

        curl_close($curl);
        return json_decode($response);
    }

	public function update($nombre,$slug,$description,$features,$product_id)
	{
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
		  CURLOPT_POSTFIELDS => 'name='.$nombre.'&slug='.$slug.'&description='.$description.'&features='.$features.'&id='.$product_id,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/x-www-form-urlencoded',
		    'Authorization: Bearer '.$_SESSION['user_data']->token
		  ),
		));

		

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		#echo json_encode($response);

		if (isset($response->code) && $response->code == 4) {
			
			header('Location: ../home.php?status=ok');
		}else{
			header('Location: ../home.php?status=error');
		}

		
	}

	public function remove($product_id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$product_id,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'DELETE',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$_SESSION['user_data']->token
		  ),
		)); 

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		#echo json_encode($response);

		if (isset($response->code) && $response->code == 2) {
			
			header('Location: ../home.php?status=ok');
		}else{
			header('Location: ../home.php?status=error');
		}

		
	}

	public function getCategories()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);

        if (isset($response->data) && is_array($response->data)) {
            return $response->data;
        }

        return array();
    }

	public function getBrands()
    {
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
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);

        if (isset($response->data) && is_array($response->data)) {
            return $response->data;
        }

        return array();
    }

	public function getTags()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);

        if (isset($response->data) && is_array($response->data)) {
            return $response->data;
        }

        return array();
    }

}

?>