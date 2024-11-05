<?php 
include_once "../../app/config.php";
include_once "../../app/ProductController.php";

$productController = new ProductController();
$products = $productController->get();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include "../layouts/head.php"; ?>
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  
  <?php include "../layouts/sidebar.php"; ?>
  <?php include "../layouts/nav.php"; ?>

  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                <li class="breadcrumb-item" aria-current="page">Products</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Products</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-sm-12">
          <div class="ecom-wrapper">
            <div class="ecom-content">
              <div class="row">
                <?php foreach ($products as $product): 
                  $imageUrl = !empty($product->cover) ? $product->cover : '../assets/images/default-product.png';
                  $price = isset($product->presentations[0]->price[0]->amount) && $product->presentations[0]->price[0]->is_current_price
                           ? $product->presentations[0]->price[0]->amount
                           : '0.00';
                ?>
                  <div class="col-sm-6 col-xl-4">
                    <div class="card product-card">
                      <div class="card-img-top">
                        <img src="<?= $imageUrl ?>" alt="<?= $product->name ?>" class="img-prod img-fluid" />
                      </div>
                      <div class="card-body">
                        <p class="prod-content mb-0 text-muted"><?= $product->name ?></p>
                        <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                          <h4 class="mb-0 text-truncate">
                            <b>$<?= number_format($price, 2) ?></b>
                          </h4>
                        </div>
                        <div class="d-flex">
                          <div class="flex-grow-1 ms-3">
                            <div class="d-grid">
                              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setProductToDelete(<?= $product->id ?>)">
                                Eliminar
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php include "../layouts/footer.php"; ?>
  <?php include "../layouts/scripts.php"; ?>

  <!-- Modal de Confirmación de Eliminación -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas eliminar este producto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" onclick="confirmDelete()">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Formulario oculto para enviar la eliminación -->
  <form id="deleteForm" action="<?= BASE_PATH ?>products" method="POST">
    <input type="hidden" name="action" value="delete_product">
    <input type="hidden" name="product_id" id="productToDelete">
  </form>

  <script>
    // Configura el ID del producto a eliminar
    function setProductToDelete(productId) {
      document.getElementById('productToDelete').value = productId;
    }

    // Confirma la eliminación enviando el formulario
    function confirmDelete() {
      document.getElementById('deleteForm').submit();
    }
  </script>
</body>
</html>
