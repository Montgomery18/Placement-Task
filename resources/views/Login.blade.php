<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Login.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Login</title>
</head>
<body>
    <header>
    <div id="LeftHead">
            <img src="{{ asset('images/Elanco_Logo.png') }}" alt="Elanco Logo">
            <p><a href="/Login">Login</a></p>
        </div>
        <div id="RightHead">
            <h1>Activity Tracker</h1>
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

    
    <main class="bg-image bg">
        <section class="form-group float-right">
            <form class="form was-validated" action="" method="post">
                <div>
                    <label for="email" class="form_text">Email</label><br>
                    <input class="form-control" type="text" id="email" name="email" placeholder="example@email.com" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <label for="passw" class="form_text">Password</label><br>
                    <input class="form-control" type="text" id="passw" name="passw" placeholder="********" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <input class="btn form_button" type="submit" value="Enter">
                </div>
            </form>
        </section>
        <section>

        </section>
    </main>

    
     <footer>


    </footer>
    
</body>
</html>
