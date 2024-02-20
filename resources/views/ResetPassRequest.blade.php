<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/ResetPass.css') }}" rel="stylesheet" >
    <title>Password Reset Request</title>
</head>
<body>
    <header>
    <div id="LeftHead">
            <img src="{{ asset('images/Elanco_Logo.png') }}" alt="Elanco Logo">
            <p><a href="/Login">Login</a></p>
        </div>
        <div id="RightHead">
            <h1>Activity tracker</h1>
            <nav>
                <ul>
                    <li><a href="/Register">Register</a></li>
                    <li><a href="/ResetPassRequest">Reset Password Request</a></li>                        
                    <li><a href="/Profile">Profile</a></li>
                    <li><a href="/Trends">Trends</a></li>
                    <li><a href="/Admin">Admin</a></li>
                    <li><a href="/ContactUs">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <h2>Reset account password</h2>
    <p>Enter a new password for '@example.gmail.com' </p>
    <main class="bg-image bg">
    <section class="form-group float-right">
            <form class="form was-validated form-container" action="" method="post">
                <div>
                    <input class="form-control" type="text" id="new_pass" name="new_pass" placeholder="New Password" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <input class="form-control" type="text" id="confirm_pass" name="confirm_pass" placeholder="Confirm Password" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <input class="btn form_button" type="submit" value="Reset Password">
                </div>
            </form>
    </main>

</body>
</html>
