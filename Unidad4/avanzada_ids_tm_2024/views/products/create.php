<?php
include_once "../../app/config.php";
include_once "../../app/ProductController.php";

$productController = new ProductController();
$categories = $productController->getCategories();
$brands = $productController->getBrands();
$tags = $productController->getTags();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include "../layouts/head.php"; ?>
</head>
<body>
  <?php include "../layouts/sidebar.php"; ?>
  <?php include "../layouts/nav.php"; ?>

  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <h2 class="mb-0">Add New Product</h2>
            </div>
          </div>
        </div>
      </div>

      <form action="<?= BASE_PATH ?>products" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="create_product">
        
        <div class="row">
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header">
                <h5>Product Description</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Product Name</label>
                  <input type="text" class="form-control" name="name" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Category</label>
                  <select class="form-select" name="category" required>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Brand</label>
                  <select class="form-select" name="brand_id" required>
                    <?php foreach ($brands as $brand): ?>
                      <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Product Description</label>
                  <textarea class="form-control" name="description" required></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Product Features</label>
                  <textarea class="form-control" name="features" required></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Product Image</label>
                  <input type="file" class="form-control" name="cover" required />
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6">
            <div class="card">
              <div class="card-header">
                <h5>Pricing and Inventory</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Price</label>
                  <input type="number" step="0.01" class="form-control" name="price" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Original Price</label>
                  <input type="number" step="0.01" class="form-control" name="original_price" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Stock Quantity</label>
                  <input type="number" class="form-control" name="stock" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">SKU</label>
                  <input type="text" class="form-control" name="sku" required />
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h5>Tags</h5>
              </div>
              <div class="card-body">
                <?php foreach ($tags as $tag): ?>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="<?= $tag->id ?>" id="tag-<?= $tag->id ?>">
                    <label class="form-check-label" for="tag-<?= $tag->id ?>"><?= $tag->name ?></label>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="card">
              <div class="card-body text-end">
                <button type="submit" class="btn btn-primary">Save Product</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include "../layouts/footer.php"; ?>
  <?php include "../layouts/scripts.php"; ?>
</body>
</html>
