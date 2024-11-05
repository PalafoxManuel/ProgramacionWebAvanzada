<?php 
include_once "../app/config.php";
?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <?php include "layouts/head.php"; ?>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    
    <?php include "layouts/sidebar.php"; ?>
    <?php include "layouts/nav.php"; ?>

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>home">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Home</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Card de Daily Sales -->
                <div class="col-md-4 col-sm-6">
                    <div class="card statistics-card-1 overflow-hidden">
                        <div class="card-body">
                            <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
                            <h5 class="mb-4">Daily Sales</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0">$249.95</h3>
                                <span class="badge bg-light-success ms-2">36%</span>
                            </div>
                            <p class="text-muted mb-2 text-sm mt-3">You made an extra 35,000 this daily</p>
                            <div class="progress" style="height: 7px">
                                <div class="progress-bar bg-brand-color-3" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card de Monthly Sales -->
                <div class="col-md-4 col-sm-6">
                    <div class="card statistics-card-1 overflow-hidden">
                        <div class="card-body">
                            <img src="<?= BASE_PATH ?>assets/images/widget/img-status-5.svg" alt="img" class="img-fluid img-bg" />
                            <h5 class="mb-4">Monthly Sales</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0">$249.95</h3>
                                <span class="badge bg-light-primary ms-2">20%</span>
                            </div>
                            <p class="text-muted mb-2 text-sm mt-3">You made an extra 35,000 this Monthly</p>
                            <div class="progress" style="height: 7px">
                                <div class="progress-bar bg-brand-color-3" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card de Yearly Sales -->
                <div class="col-md-4 col-sm-12">
                    <div class="card statistics-card-1 overflow-hidden bg-brand-color-3">
                        <div class="card-body">
                            <img src="<?= BASE_PATH ?>assets/images/widget/img-status-6.svg" alt="img" class="img-fluid img-bg" />
                            <h5 class="mb-4 text-white">Yearly Sales</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">$249.95</h3>
                            </div>
                            <p class="text-white text-opacity-75 mb-2 text-sm mt-3">You made an extra 35,000 this Daily</p>
                            <div class="progress bg-white bg-opacity-10" style="height: 7px">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aquí se muestran las demás tarjetas o contenido de la página -->
                
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <?php include "layouts/footer.php"; ?>
    <?php include "layouts/modals.php"; ?>

    <!-- [Page Specific JS] start -->
    <script src="<?= BASE_PATH ?>assets/js/plugins/apexcharts.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/jsvectormap.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/world.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/world-merc.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    
    <?php include "layouts/scripts.php"; ?>
</body>
<!-- [Body] end -->
</html>
