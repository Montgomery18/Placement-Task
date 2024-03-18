<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canine Profile</title>

    <!-- Bootstrap 5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    
    <link href="{{ asset('css/profile-desktop.css') }}" rel="stylesheet" >
</head>
<body>

    <!-- Temperary Header Stuff (Look into either PHP includes or Building components with Blade.) -->
    
    @include("Header")
    

    <main class="FlexDisplay">
        <section class="TopBox">

            <img src="{{ asset('images/Example_Dog_Image.jpg') }}" id="profile-picture" alt="Dog Profile Picture" width="100" height="100"></img>
            @if (session()->get("SelectedDog") !== null)
                <h1>{{ session()->get("SelectedDog") }}</h1>
            @elseif (isset($DogID))
                <h1>{{ $DogID[0]->DogID }}</h1>
            @else
                <h1>Null</h1>
            @endif
            <h1>Profile</h1>

            <p>Name: [Insert Dog Name Here]</p>
            <p>Breed: []</p>
            <p>Age: []</p>
        </section>
        
        <div class="smallerFlexDisplay">

            <section>
                <h1>Average Steps:</h1>
                <!-- Add some sort of circle graph showing Average Steps. -->
                <p> {{ $Data[0] }}</p>
            </section>

            <section>
                <h1>Average Temperture:</h1>
                <p> {{ $Data[1] }}</p>
            </section>

            <section>
                <h1>Average BPM:</h1>
                <p> {{ $Data[2] }}</p>
            </section>
        
        </div>
    </main>

    <form id="SelectDog" action="{{ route('SelectDog') }}" method="post">
        @csrf
        <label for="SelectDog">Select Your Dog</label>
        <select ID="Select" name="Select" form="SelectDog">
            @if (isset($DogID))
                @foreach ($DogID as $ID)
                    <option value="{{ $ID->DogID }}"> {{ $ID->DogID }} </option>
                @endforeach
            @endif
        </select>
        <button type="submit">test</button>
    </form>

    <footer>
    @include ("Footer")
    </footer> 
</body>
</html>
