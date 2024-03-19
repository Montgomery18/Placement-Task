<?php

namespace resources\views;
    
    
    ?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Prediction.css') }}" rel="stylesheet" >
</head>
<body>

    @include("Header")
    <main>
        <section class="form-group float-right">
            <form class="form was-validated" action="{{route('predict')}}" method="POST">
                 @csrf

                 <label for="weight" class="form_text">Weight</label><br>
                 <input class="form-control" type="double" id="weight" name="weight"required>
                 <div class="invalid-feedback">Please fill out this field.</div>

                 <label for="activityLevel" class="form_text">Activity Level</label><br>
                 <input class="form-control" type="double" id="activityLevel" name="activityLevel"required>
                 <div class="invalid-feedback">Please fill out this field.</div>

                 <label for="heartRate" class="form_text">Heart Rate</label><br>
                 <input class="form-control" type="double" id="heartRate" name="heartRate"required>
                 <div class="invalid-feedback">Please fill out this field.</div>

                 <label for="calorieBurn" class="form_text">Calorie Burn</label><br>
                 <input class="form-control" type="double" id="calorieBurn" name="calorieBurn"required>
                 <div class="invalid-feedback">Please fill out this field.</div>

                 <label for="temperature" class="form_text">Temperature</label><br>
                 <input class="form-control" type="double" id="temperature" name="temperature"required>
                 <div class="invalid-feedback">Please fill out this field.</div>
        
                 <label for="foodIntake" class="form_text">Food Intake (calories)</label><br>
                 <input class="form-control" type="double" id="foodIntake" name="foodIntake"required>
                 <div class="invalid-feedback">Please fill out this field.</div>
        
                 <label for="waterIntake" class="form_text">Water Intake (ml)</label><br>
                 <input class="form-control" type="double" id="waterIntake" name="waterIntake"required>
                 <div class="invalid-feedback">Please fill out this field.</div>
        
                 <label for="breathingRate" class="form_text">Breathing Rate (breaths/min)</label><br>
                 <input class="form-control" type="double" id="breathingRate" name="breathingRate"required>
                 <div class="invalid-feedback">Please fill out this field.</div>
        
                 <label for="barkingFrequency" class="form_text">Barking Frequency</label><br>
                 <input class="form-control" type="text" id="barkingFrequency" name="barkingFrequency"required>
                 <div class="invalid-feedback">Please fill out this field.</div>
        
                <button type="submit">Predict Behavior Pattern</button>
                 <br><h4>  The dog's should be: </h4><br>
                 @if (isset($Predictions))
                 <br> <h4> {{ $Predictions['0'] }}</h4> <br>
                 @endif
            </form>
        </section>
        <section>
       
        </section>
    </main>
    
    
     <footer>
     @include("Footer")

    </footer>
</body>

</html>
