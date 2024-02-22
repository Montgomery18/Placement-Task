<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Trends.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >
    <script>
        window.data = @json($data);
    </script>
    @vite(['resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <title>Trends</title>
</head>

<body class="TrendsPage">

    @include("Header")

    <main>
        <section>
            <div class="canvas_div">
                <canvas id="myChart"></canvas>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="day_mode" name="day_mode" value="yes">
                </div>
                <form id="day_form" style="display:block" action="{{ route('graphfilter') }}" method="post">
                    @csrf
                    <input style="display:none" type="text" name="page" value="\Trends">
                    <input style="display:none" type="text" name="DogID" value="CANINE001"> <!-- Temporary, will only show canine001 for now -->
                    <input style="display:none" type="text" name="DisplayAll" value="false">
                    <div class="row">
                        <div class="col">
                            <select id="day_form_select" class="form-select">
                                <option value="Weight">Weight</option>
                                <option value="Activity_Level">Steps</option>
                                <option value="Heart_Rate">Heart Rate</option>
                                <option value="Calorie_Burn">Calories Burned</option>
                                <option value="Temperature">Temperature</option>
                                <option value="Food_Intake">Calories Consumed</option>
                                <option value="Water_Intake">Water Consumed</option>
                                <option value="Breathing_Rate">Breathing Rate</option>
                                <option value="Barking_Frequency">Barking Frequency</option>
                            </select>
                        </div>
                        <div class="col">
                            @if (@isset($startDate))
                                <input id="start" type="date" name="DateMin" class="form-control" value="{{$startDate}}">
                            @else
                                <input id="start" type="date" name="DateMin" class="form-control">
                            @endif
                        </div>
                        <div class="col">
                            @if (@isset($endDate))
                                <input id="end" type="date" name="DateMax" class="form-control" value="{{$endDate}}">
                            @else
                                <input id="end" type="date" name="DateMax" class="form-control">
                            @endif
                        </div>
                        <div class="col">
                            <input type="submit" class="form-control">
                        </div>
                    </div>
                </form>
                <form id="hour_form" style="display:none" action="{{ route('graphfilter') }}" method="post">
                    @csrf
                    <input style="display:none" type="text" name="page" value="\Trends">
                    <input style="display:none" type="text" name="DogID" value="CANINE001"> <!-- Temporary, will only show canine001 for now -->
                    <input style="display:none" type="text" name="DisplayAll" value="false">
                    <div class="row">
                        <div class="col">
                            <select class="form-select">
                                <option value="Weight">Weight</option>
                                <option value="Activity_Level">Steps</option>
                                <option value="Heart_Rate">Heart Rate</option>
                                <option value="Calorie_Burn">Calories Burned</option>
                                <option value="Temperature">Temperature</option>
                                <option value="Food_Intake">Calories Consumed</option>
                                <option value="Water_Intake">Water Consumed</option>
                                <option value="Breathing_Rate">Breathing Rate</option>
                                <option value="Barking Frequency">Barking Frequency</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="DateMin">
                        </div>
                        <div class="col">
                            <input type="submit" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>

        </section>
    </main>

    <footer>

    </footer>
</body>
</html>