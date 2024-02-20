<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elanco Animal Tracker</title>

    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" >
    <link media="only screen and (min-width:1027px)" href="" rel="stylesheet">
    <!-- @vite(['resources/js/app.js']); -->
</head>

<body>

    <!-- Add Header to top of the page. -->
    @include("Header")


    <link href="{{ asset('css/Index.css') }}" rel="stylesheet" >
    <main class = "bg-image bg">
        <section class= "container-overlay">
            <div class= "container-text">
             <h1>Welcome to the Elanco Activity monitor</h1>
                <div>
                  On this website you will be able to view data in graphical form as well as manipulate that data to your needs
                  This data will then provide trends seen in the data and show this either on the graph or in text form.
                  <div>
                    To get started either login to your account or register for one with the nav bar above.
                  </div>
                </div>
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

