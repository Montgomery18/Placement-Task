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
                <form id="day_form">
                    <div class="row">
                        <div class="col">
                            <select class="form-select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col">
                            <input type="submit" class="form-control">
                        </div>
                    </div>
                </form>
                <form id="hour_form" style="display:none">
                    <div class="row">
                        <div class="col">
                            <select class="form-select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control">
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