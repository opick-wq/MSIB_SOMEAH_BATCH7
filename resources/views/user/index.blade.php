<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Auth System</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#login-form">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#register-form">Register</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2>Login</h2>
    <div id="login-form">
        <form id="loginForm">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" class="form-control" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <hr>

    <h2>Register</h2>
    <div id="register-form">
        <form id="registerForm">
            <div class="form-group">
                <label for="register-name">Name</label>
                <input type="text" class="form-control" id="register-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" class="form-control" id="register-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="register-password">Password</label>
                <input type="password" class="form-control" id="register-password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Handle login form submission
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        var formData = {
            email: $('#login-email').val(),
            password: $('#login-password').val()
        };

        $.ajax({
            url: '{{ url("api/login") }}',  // API endpoint for login
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                alert('Login successful');
                // Redirect or perform additional actions here
            },
            error: function(xhr) {
                alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
            }
        });
    });

    // Handle register form submission
    $('#registerForm').submit(function(e) {
        e.preventDefault();

        var formData = {
            name: $('#register-name').val(),
            email: $('#register-email').val(),
            password: $('#register-password').val(),
        };

        $.ajax({
            url: '{{ url("api/register") }}',  // API endpoint for register
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                alert('Registration successful');
                // Redirect or perform additional actions here
            },
            error: function(xhr) {
                alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>

</body>
</html>
