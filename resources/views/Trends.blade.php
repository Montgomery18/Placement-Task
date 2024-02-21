<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Trends.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >
    @vite(['resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <title>Trends</title>
</head>
<body class="TrendsPage">
    
    @include('Header')

    <main>
        <section>
            <div style="width:600px">
                <canvas id="myChart"></canvas>
                <button type="button">
                <form>
                    <div class="row">
                        <div class="col">
                            
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