<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-check-input:checked + .form-check-label::before {
            content: ''; 
            color: green;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Login</h1>
        <form id="loginForm" class="p-3 pt-5 pe-4 ps-4">
            <div class="mb-3">
                <label for="exampleInputMobile1" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="exampleInputMobile1" aria-describedby="mobileHelp" pattern="\d*" title="Please enter only numbers" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="mt-3">
                <p>Don't have an account? <a href="/register" class="btn btn-link">Register</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            window.location.href = '/home';
        });
    </script>
</body>
</html>
