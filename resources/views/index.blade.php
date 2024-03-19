<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elanco Animal Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Index.css') }}" rel="stylesheet" >
    <link media="only screen and (min-width:1027px)" href="" rel="stylesheet">
    <!-- @vite(['resources/js/app.js']); -->
</head>

<body>

    <!-- Add Header to top of the page. -->
    @include("Header")

    <main class = "bg">

        <section class= "container-overlay">
            <div class= "container-text">
             <h1>Welcome to the Elanco Activity Monitor</h1>
                <div>
                  On this website you will be able to view data in graphical form as well as manipulate that data to your needs
                  This data will then provide trends seen in the data and show this either on the graph or in text form.
                  <div>
                    To get started either login to your account or register for one  with the button below.
                  </div>
                </div>
            </div>

            <section class="Register_button">
                <form action="/Register" method="get">
                    <button class="btn form_button" type="submit" value="Register">Register</button>
                </form>
            </section>

        </section>

        

        <section id="ImageGallery">
            <img class="GalleryImage" id="image1" src="{{ asset('images/ImageGallery1.jpg') }}" width="600" height="300" alt="An Image of A Happy Dog">
        </section>


    </main>

    <footer>
        @include("Footer")
    </footer>
</body>
</html>

