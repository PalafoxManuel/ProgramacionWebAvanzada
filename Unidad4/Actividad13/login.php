<?php
session_start();

if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-75 shadow p-4 bg-light rounded">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="promocional.jpg" alt="Large Image" class="img-fluid w-100 d-none d-md-block">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <img src="logo.jpg" alt="Logo" class="mb-4">
                    <h2>Login</h2>
                    <form method="POST" action="/ProgramacionWebAvanzada/Unidad4/Actividad13/auth">
                        <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($_SESSION['global_token']); ?>">
                        <input type="hidden" name="action" value="access">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>