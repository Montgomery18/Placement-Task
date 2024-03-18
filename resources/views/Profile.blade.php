<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canine Profile</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    
    <link href="{{ asset('css/profile-desktop.css') }}" rel="stylesheet" >
</head>

<body>

    <!-- Temperary Header Stuff (Look into either PHP includes or Building components with Blade.) -->
    
    @include("Header")
    

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
                <p>{{ $data[0]}}</p>
            </section>

            <section>
                <h1>Average Temperture:</h1>
                <p>{{ $data[1] }} &deg;C</p>
            </section>

            <section>
                <h1>Average BPM:</h1>
                <p>{{ $data[2] }} BPM</p>
            </section>
        
        </div>
    </main>

    <footer>
    @include ("Footer")
    </footer> 
</body>
</html>
