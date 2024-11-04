<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="index.html" class="b-brand text-primary">
                <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" alt="logo image" class="logo-lg" />
                <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">v1.2.0</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>E-commerce</label>
                    <i class="ph-duotone ph-storefront"></i>
                </li>

                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>views/products/index.php" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-box"></i>
                        </span>
                        <span class="pc-mtext">Productos</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>views/products/create.php" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-plus-circle"></i>
                        </span>
                        <span class="pc-mtext">Agregar Producto</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>views/products/edit.php" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-pencil-simple"></i>
                        </span>
                        <span class="pc-mtext">Editar Producto</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>views/products/delete.php" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-trash"></i>
                        </span>
                        <span class="pc-mtext">Eliminar Producto</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->