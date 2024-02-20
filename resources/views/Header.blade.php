
<!-- Importing CSS File -->
<link href="{{ asset('css/header.css') }}" rel="stylesheet" >

<!-- Javascript -->
@vite(['resources/js/app.js'])

<body>

    <header>

        <div id="LeftHead">
            <img id="Logo" src="{{ asset('images/Elanco_Logo.png') }}" alt="Elanco Logo">
            <!-- <p><a href="/Login">Login</a></p> -->
            <!-- <img id="ProfilePicture" src="{{ asset('images/ProfilePicture_White.png') }}" alt="Profile Picture" width="50" height="50"> -->
            <input id="ProfilePicture" type="image" src="{{ asset('images/ProfilePicture_White.png') }}" width="50" height="50"/>
        </div>

        <div id="RightHead">
            <h1>Activity Tracker</h1>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/Admin">Admin</a></li>
                    <li><a href="/ContactUs">Contact Us</a></li>
                </ul>
            </nav>
        </div>


        
    </header>

    <div class="navbars">
        <nav class="Sidebar" id="LoggedInSidebar">
            <ul>
                <li><a href="javascript:void(0)" class="CloseButton">×</a></li>
                <li><a href="/Profile">Profile</a></li>
                <li><a href="/Trends">Trends</a></li>
                <li><a href="/ResetPassRequest">Reset Password Request</a></li>  
            </ul>
        </nav>

        <nav class="Sidebar" id="LoggedOutSidebar">
            <ul>
                <li><a href="javascript:void(0)" class="CloseButton">×</a></li>
                <li><a href="/Login">Login</a></li>
                <li><a href="/Register">Register</a></li>  
            </ul>
        </nav>
    </div>



</body>