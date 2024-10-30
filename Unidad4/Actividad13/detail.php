<?php
include './DetailsController.php';

if (!isset($product) || !$product) {
    echo '<div class="alert alert-danger">Producto no encontrado. Verifica el slug en la URL.</div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
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
                    <a class="nav-link" href="/ProgramacionWebAvanzada/Unidad4/Actividad13/home">Home <span class="sr-only">(current)</span></a>
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
            <nav id="sidebar" class="sticky-top col-md-3 col-lg-2 d-md-block bg-dark sidebar vh-100 d-none d-md-block">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo htmlspecialchars($product['name']); ?></h1>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <img class="d-block w-100" src="<?php echo htmlspecialchars($product['cover']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="col-md-6">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p><strong>Precio:</strong> $<?php echo number_format($product['presentations'][0]['price'][0]['amount'], 2); ?></p>
                        <p><strong>Disponibilidad:</strong> <?php echo htmlspecialchars($product['presentations'][0]['stock']); ?> unidades en stock</p>
                        <a href="#" class="btn btn-primary">Agregar al carrito</a>

                        <h4 class="mt-4">Marca</h4>
                        <p><?php echo htmlspecialchars($product['brand']['name']); ?> - <?php echo htmlspecialchars($product['brand']['description']); ?></p>

                        <h4 class="mt-4">Categorías</h4>
                        <ul>
                            <?php foreach ($product['categories'] as $category): ?>
                                <li><?php echo htmlspecialchars($category['name']); ?> - <?php echo htmlspecialchars($category['description']); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <h4 class="mt-4">Etiquetas</h4>
                        <ul>
                            <?php foreach ($product['tags'] as $tag): ?>
                                <li><?php echo htmlspecialchars($tag['name']); ?> - <?php echo htmlspecialchars($tag['description']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <h3 class="mt-4">Especificaciones</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Característica</th>
                            <th scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dimensiones</td>
                            <td><?php echo htmlspecialchars($product['presentations'][0]['description']); ?></td>
                        </tr>
                        <tr>
                            <td>Peso</td>
                            <td><?php echo htmlspecialchars($product['presentations'][0]['weight_in_grams'] / 1000); ?> kg</td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
