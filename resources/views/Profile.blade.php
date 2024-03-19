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
            @if (session()->get("SelectedDog") !== null)
                <h1>{{ session()->get("SelectedDog") }}</h1>
            @elseif (isset($DogID))
                <h1>{{ $DogID[0]->DogID }}</h1>
            @elseif (isset($DogName))
                <h1>{{ $DogName }}</h1>
            @else
                <h1>Null</h1>
            @endif
            <h1>Profile</h1>

            <p>Name: [Insert Dog Name Here]</p>
            <p>Breed: []</p>
            <p>Age: []</p>

            <h2>Show Averages Per Hour</h2>
            <form id="BehaviourAndBarkFrequency" action="{{ route('profileData') }}" method="post">
                @csrf
                <input style="display:none" type="text" name="FormType" value="Averages">
                @if (session()->get("SelectedDog") !== null)
                    <input style="display:none" type="text" name="DogID" value="{{ session()->get('SelectedDog') }}">
                @elseif (isset($DogID))
                    <input style="display:none" type="text" name="DogID" value="{{ $DogID[0]->DogID }}">
                @endif
                <label for="Behaviour">Select Behaviour</label>
                <select ID="Behaviour" name="Behaviour" form="BehaviourAndBarkFrequency">
                    @foreach ($BehavAndBarkList[0] as $behav)
                        <option value="{{ $behav->Behaviour }}"> {{ $behav->Behaviour }}</option>
                    @endforeach
                </select>
                <label for="BarkingFrequency">Select Barking Frequency</label>
                <select ID="BarkingFrequency" name="BarkingFrequency" form="BehaviourAndBarkFrequency">
                    @foreach ($BehavAndBarkList[1] as $bark)
                        <option value="{{ $bark->Barking_Frequency }}"> {{ $bark->Barking_Frequency }}</option>
                    @endforeach
                </select>
                <button type="submit">test</button>
            </form>
        </section>
        
        <div class="smallerFlexDisplay">

            <section>
                @if (isset($Behaviour) || isset($BarkingFrequency))
                    @if ($Behaviour != "All" || $BarkingFrequency != "All")
                        <h1>When behaviour is {{ $Behaviour }} and barking frequency is {{ $BarkingFrequency }}</h1>
                    @endif
                @else
                    <h1>When behaviour includes All types and barking frequency includes all types</h1>
                @endif
                <h1>Average Steps Per Hour:</h1>
                <!-- Add some sort of circle graph showing Average Steps. -->
                <p> {{ $Data[0] }}</p>
            </section>

            <section>
                @if (isset($Behaviour) || isset($BarkingFrequency))
                    @if ($Behaviour != "All" || $BarkingFrequency != "All")
                        <h1>When behaviour is {{ $Behaviour }} and barking frequency is {{ $BarkingFrequency }}</h1>
                    @endif
                @else
                    <h1>When behaviour includes All types and barking frequency includes all types</h1>
                @endif
                <h1>Average Temperture Per Hour:</h1>
                <p> {{ $Data[1] }}</p>
            </section>

            <section>
                @if (isset($Behaviour) || isset($BarkingFrequency))
                    @if ($Behaviour != "All" || $BarkingFrequency != "All")
                        <h1>When behaviour is {{ $Behaviour }} and barking frequency is {{ $BarkingFrequency }}</h1>
                    @endif
                @else
                    <h1>When behaviour includes All types and barking frequency includes all types</h1>
                @endif
                <h1>Average BPM Per Hour:</h1>
                <p> {{ $Data[2] }}</p>
            </section>
        
        </div>
    </main>

    <form id="SelectDog" action="{{ route('profileData') }}" method="post">
        @csrf
        <input style="display:none" type="text" name="FormType" value="SelectDog">
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
