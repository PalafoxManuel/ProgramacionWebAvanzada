<?php 
include_once "app/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_PATH . "home");
    exit();
}

if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "app/AuthController.php";
    $authController = new AuthController();
    $authController->login();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Login | Light Able Admin & Dashboard Template</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective." />
    <meta name="author" content="phoenixcoded" />

    <!-- Favicon -->
    <link rel="icon" href="<?= BASE_PATH ?>assets/images/favicon.svg" type="image/x-icon" />

    <!-- Fuentes y estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/phosphor/duotone/style.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/tabler-icons.min.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/feather.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/material.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/css/style-preset.css" />
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- Preloader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="auth-main v2">
        <div class="bg-overlay bg-dark"></div>
        <div class="auth-wrapper">
            <div class="auth-sidecontent">
                <div class="auth-sidefooter">
                    <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" class="img-brand img-fluid" alt="images" />
                    <hr class="mb-3 mt-4" />
                    <div class="row">
                        <div class="col my-1">
                            <p class="m-0">Made with ♥ by Team <a href="https://themeforest.net/user/phoenixcoded" target="_blank"> Phoenixcoded</a></p>
                        </div>
                        <div class="col-auto my-1">
                            <ul class="list-inline footer-link mb-0">
                                <li class="list-inline-item"><a href="<?= BASE_PATH ?>index.html">Home</a></li>
                                <li class="list-inline-item"><a href="https://pcoded.gitbook.io/light-able/" target="_blank">Documentation</a></li>
                                <li class="list-inline-item"><a href="https://phoenixcoded.support-hub.io/" target="_blank">Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de autenticación -->
            <div class="auth-form">
                <div class="card my-5 mx-3">
                    <div class="card-body">
                        <h4 class="f-w-500 mb-1">Login with your email</h4>
                        <p class="mb-3">Don't have an Account? <a href="<?= BASE_PATH ?>register-v2" class="link-primary ms-1">Create Account</a></p>
                        
                        <form method="POST" action="<?= BASE_PATH ?>login">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" required />
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="Password" required />
                            </div>
                            
                            <!-- Campos ocultos para acción y global_token -->
                            <input type="hidden" name="action" value="access" />
                            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>" />

                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked />
                                    <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                                </div>
                                <a href="<?= BASE_PATH ?>forgot-password-v2">
                                    <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
                                </a>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>

                        <div class="saprator my-3">
                            <span>Or continue with</span>
                        </div>
                        
                        <div class="text-center">
                            <ul class="list-inline mx-auto mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/" class="avtar avtar-s rounded-circle bg-facebook" target="_blank">
                                        <i class="fab fa-facebook-f text-white"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/" class="avtar avtar-s rounded-circle bg-twitter" target="_blank">
                                        <i class="fab fa-twitter text-white"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://myaccount.google.com/" class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                                        <i class="fab fa-google text-white"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= BASE_PATH ?>assets/js/plugins/popper.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/simplebar.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/fonts/custom-font.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/pcoded.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/feather.min.js"></script>

    <script>
        layout_change('light');
        layout_sidebar_change('light');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change('preset-1');
    </script>
</body>
</html>
