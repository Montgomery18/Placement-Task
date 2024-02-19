<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elanco Animal Tracker</title>

    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" >
    <link media="only screen and (min-width:1027px)" href="" rel="stylesheet">
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
    <link href="{{ asset('css/Index.css') }}" rel="stylesheet" >
    <main class = "bg-image bg">
        <section class= "container-overlay">
            <div class= "container-text">
                  Welcome to the Elanco Activity monitor.
                  On this website you will be able to view data in graphical form as well as manipulate that data to your needs
                  This data will then provide trends seen in the data and show this either on the graph or in text form.
                  To get started either login to your account or register for one with the nav bar above. 
            </div>
        </section>
        <section>

        </section>
    </main>

    <footer>
    @include ("Footer")

    </footer>
</body>
</html>

