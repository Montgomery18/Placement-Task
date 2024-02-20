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

    <link href="{{ asset('css/Placeholder.css') }}" rel="stylesheet" >
    <main>
        <section class="Filter-bar">
           <div id="mySidebar" class="sidebar">
           <form action="" method="post">
                <h1> Filter Menu </h1>
                <div class= "Form-Text">
                    <input type="radio" value="Weight" name="type">Weight<br>
                    
                    <input class="btn form_button" type="submit" value="Enter">
                </div>
            </form>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            </div>

           
        </section>
        <section>
            <div id="main">
                <button class="openbtn" onclick="openNav()">&#9776;</button>
            </div>

        </section>

    </main>
<script>
    function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    }
</script>
    
     <footer>
     @include("Footer")

    </footer>
    
</body>
</html>
