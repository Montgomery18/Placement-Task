<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Admin.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Admin</title>
</head>
<body>
    @include("Header")
    <main>
        <section>
        <ul id="admin_list">
                <li><a href="/AdminPassReset">Password Reset Management</a></li>
                <li><a href="/AdminDeleteUser">Manage Users</a></li>
            </ul>
        </section>

        <section>
            <h2>Regenerate Via A Regular CSV Format</h2>
            <form id="RegenData" action="{{ route('AdminHandler')}}" method="post">
                @csrf
                <input style="display:none;" type="text" id="type" name="type" value="regular">
                <button type="submit">Regenerate Database</button>
            </form>
            @if (isset($error))
                @dd($error)
                <h1>{{ $error }}</h1>
            @endif
            <h2>Regenerate Via A Different CSV Format</h2>
            <form id="CSVDifferent" action="{{ route('AdminHandler')}}" method="post">
                @csrf
                <input style="display:none;" type="text" id="type" name="type" value="different">
                <label>Has Columns Within CSV</label>
                <div>
                    <input type="radio" id="HasColumns-1" name="HasColumns" value="true" checked>
                    <label for="HasColumns-1">True</label>
                    <input type="radio" id="HasColumns-2" name ="HasColumns" value="false">
                    <label for="HasColumns-2">False</label>
                </div>
                <div>
                    <label>Start Of Columns</label>
                    <input type="number" min="0" id="ColumnStart" name="ColumnStart" value="0">
                    <label>End Of Columns</label>
                    <input type="number" min="0" id="ColumnEnd" name="ColumnEnd" value="1">
                </div>
                <div>
                    <label for="DogID">DogID</label>
                    <input type="number" min="0" max="12" id="DogID" name="DogID" value="0">
                    <label for="Weight">Weight</label>
                    <input type="number" min="0" max="12" id="Weight" name="Weight" value="1">
                    <label for="Date">Date</label>
                    <input type="number" min="0" max="12" id="Date" name="Date" value="2">
                    <label for="Hour">Hour</label>
                    <input type="number" min="0" max="12" id="Hour" name="Hour" value="3">
                    <label for="Behaviour">Behaviour</label>
                    <input type="number" min="0" max="12" id="Behaviour" name="Behaviour" value="4">
                    <label for="ActivityLevel">Activity Level</label>
                    <input type="number" min="0" max="12" id="ActivityLevel" name="ActivityLevel" value="5">
                    <label for="HeartRate">HeartRate</label>
                    <input type="number" min="0" max="12" id="HeateRate" name="HeartRate" value="6">
                    <label for="CaolorieBurn">Calorie Burn</label>
                    <input type="number" min="0" max="12" id="CalorieBurn" name="CalorieBurn" value="7">
                    <label for="Temperature">Temperature</label>
                    <input type="number" min="0" max="12" id="Temperature" name="Temperature" value="8">
                    <label for="FoodIntake">Food Intake</label>
                    <input type="number" min="0" max="12" id="FoodIntake" name="FoodIntake" value="9">
                    <label for="WaterIntake">Water Intake</label>
                    <input type="number" min="0" max="12" id="WaterIntake" name="WaterIntake" value="10">
                    <label for="BreathingRate">Breathing Rate</label>
                    <input type="number" min="0" max="12" id="BreathingRate" name="BreathingRate" value="11">
                    <label for="BarkingFrequency">Barking Frequency</label>
                    <input type="number" min="0" max="12" id="BarkingFrequedncy" name="BarkingFrequency" value="12">
                </div>
                <button type="submit">Regenerate Database</button>
            </form>
        </section>
    </main>

    <footer>
    @include("Footer")
    </footer>
</body>
</html>