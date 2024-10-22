<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar vh-100 position-sticky sticky-top">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Customers</a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Products</h1>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addProductModal">Add Product</button>
                </div>

                <div class="row">
                    <?php
                    include './app/ProductController.php';
                    $productController = new ProductController();
                    $products = $productController->getProducts();

                    if (!empty($products) && isset($products['data'])) {
                        foreach ($products['data'] as $product) {
                            echo '<div class="col-md-4">';
                            echo '    <div class="card mb-4 shadow-sm">';
                            echo '        <img src="' . htmlspecialchars($product['cover']) . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">';
                            echo '        <div class="card-body">';
                            echo '            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>';
                            echo '            <p class="card-text">' . htmlspecialchars($product['description']) . '</p>';
                            echo '            <a href="detail.php?slug=' . htmlspecialchars($product['slug']) . '" class="btn btn-primary">View Details</a>';
                            echo '            <button class="btn btn-warning ml-2">Edit</button>';
                            echo '            <button class="btn btn-danger ml-2">Delete</button>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-md-12">';
                        echo '<div class="alert alert-warning" role="alert">No products available.</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Añadir Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="createProductForm" method="POST" action="">
                    <div class="form-group">
                        <label for="productName">Nombre del Producto</label>
                        <input type="text" class="form-control" id="productName" name="name" placeholder="Nombre del Producto" required>
                    </div>
                    <div class="form-group">
                        <label for="productSlug">Slug</label>
                        <input type="text" class="form-control" id="productSlug" name="slug" placeholder="Slug del Producto" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Descripción</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" placeholder="Descripción del Producto" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productFeatures">Características</label>
                        <textarea class="form-control" id="productFeatures" name="features" rows="3" placeholder="Características del Producto" required></textarea>
                    </div>
                    <input type="hidden" name="action" value="create_product">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear producto</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
