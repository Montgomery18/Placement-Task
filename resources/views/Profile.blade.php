<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canine Profile</title>

    <!-- Bootstrap 5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/profile-desktop.css') }}" rel="stylesheet" >
</head>
<body>

    <!-- Temperary Header Stuff (Look into either PHP includes or Building components with Blade.) -->
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

    <main class="FlexDisplay">
        <section class="TopBox">

            <img src="{{ asset('images/Example_Dog_Image.jpg') }}" id="profile-picture" alt="Dog Profile Picture" width="100" height="100"></img>
            <h1>Profile</h1>

            <p>Name: [Insert Dog Name Here]</p>
            <p>Breed: []</p>
            <p>Age: []</p>
        </section>

        <div class="smallerFlexDisplay">

            <section>
                <h1>Average Steps:</h1>
                <!-- Add some sort of circle graph showing Average Steps. -->
                <p>[] Steps</p>
            </section>

            <section>
                <h1>Average Temperture:</h1>
                <p>[] &deg;C</p>
            </section>

            <section>
                <h1>Average BPM:</h1>
                <p>[] BPM</p>
            </section>
        
        </div>
    </main>

    <footer>

    </footer> 
</body>
</html>