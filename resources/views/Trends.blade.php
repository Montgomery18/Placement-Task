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
            <div class="row" style="max-width:100%; margin:auto">
                <div class="col" style="max-width:48%; margin:auto; overflow: auto">
                    <canvas id="Chart1"></canvas>
                    <select id="chart1_select" class="form-select">
                        <option value="Weight">Weight</option>
                        <option value="Steps" selected="selected">Steps</option>
                        <option value="Heart Rate">Heart Rate</option>
                        <option value="Calories Burned">Calories Burned</option>
                        <option value="Temperature">Temperature</option>
                        <option value="Calories Consumed">Calories Consumed</option>
                        <option value="Water Consumed">Water Consumed</option>
                        <option value="Breathing Rate">Breathing Rate</option>
                    </select>
                </div>
                <div class="col"  style="max-width:48%; margin:auto; overflow: auto">
                    <canvas id="Chart2"></canvas>
                    <select id="chart2_select" class="form-select">
                        <option value="Weight">Weight</option>
                        <option value="Steps">Steps</option>
                        <option value="Heart Rate" selected="selected">Heart Rate</option>
                        <option value="Calories Burned">Calories Burned</option>
                        <option value="Temperature">Temperature</option>
                        <option value="Calories Consumed">Calories Consumed</option>
                        <option value="Water Consumed">Water Consumed</option>
                        <option value="Breathing Rate">Breathing Rate</option>
                    </select>
                </div>
            </div>
            <div class="form_div" style="max-width:100%">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="day_mode" name="day_mode" value="yes">
                    <label class="form-check-label" for="day_mode">24hr</label>
                </div>
                <form id="day_form" style="display:block" action="{{ route('graphfilter') }}" method="post">
                    @csrf
                    <input style="display:none" type="text" name="page" value="\Trends">
                    <input style="display:none" type="text" name="DogID" value="CANINE001"> <!-- Temporary, will only show canine001 for now -->
                    <input style="display:none" type="text" name="DisplayAll" value="false">
                    <div class="row">
                        <div class="col">
                            <label for="DateMin" class="form-label">Start Date</label>
                            @if (@isset($startDate))
                                <input id="start" type="date" name="DateMin" class="form-control" value="{{$startDate}}" min="2021-01-01" max="2023-12-31">
                            @else
                                <input id="start" type="date" name="DateMin" class="form-control" min="2021-01-01" max="2023-12-31">
                            @endif
                        </div>
                        <div class="col">
                            <label for="DateMax" class="form-label">End Date</label>
                            @if (@isset($endDate))
                                <input id="end" type="date" name="DateMax" class="form-control" value="{{$endDate}}" min="2021-01-01" max="2023-12-31">
                            @else
                                <input id="end" type="date" name="DateMax" class="form-control" min="2021-01-01" max="2023-12-31">
                            @endif
                        </div>
                        <div class="col">
                            <label for="submit" class="form-label">Submit</label>
                            <input name="submit" type="submit" class="form-control">
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
                            <label for="DateMin" class="form-label">Date</label>
                            <input type="date" class="form-control" name="DateMin" min="2021-01-01" max="2023-12-31">
                        </div>
                        <div class="col">
                            <label for="submit" class="form-label">Submit</label>
                            <input name="submit" type="submit" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>

        </section>
    </main>

    @include("Footer")
</body>
</html>