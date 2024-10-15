<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <form method="POST" action="app/AuthController.php">
                        <input type="hidden" name="action" value="access">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="checkMeOut">
                            <label class="form-check-label" for="checkMeOut">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-FT3Aj4Be9XYKoyy2wi5c+4p9cbUw4N4iYeK8fKtOTxkUt6B8hIdP1T0GhBD0gEV2" crossorigin="anonymous"></script>
</body>
</html>