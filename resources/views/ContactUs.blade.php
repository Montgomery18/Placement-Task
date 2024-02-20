<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elanco Animal Tracker</title>

    <link href="{{ asset('css/desktop.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" >
    <link media="only screen and (min-width:1027px)" href="" rel="stylesheet">

</head>
<body>
    
    @include("Header")

    <main>
        <section>
           <!DOCTYPE html>
           <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
            <link href="{{ asset('css/ContactUs.css') }}" rel="stylesheet" >
           <html>
              <body>
                    <h2> Contact number = 01256353131</h2>
                    <h2> Email=ElancoPartners@elanco.com</h2>
                    <h2> Office address : Form 2, Bartley Wood, Bartley Wood Business Park, Hook, RG27 9XA</h2>

               <div id="googleMap" style="width:500px;height:500px;margin:auto;"></div>

               <script>
                   function myMap() {
                    var mapProp= {
                    center:new google.maps.LatLng(51.280438,-0.949812),
                    zoom:20,
                    };

                   var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                   var marker = new google.maps.Marker({position: myProp});
                   animation:google.maps.Animation.BOUNCE
                   marker.setMap(map);
                   }
               </script>

              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlVrwmx_xztSwSiS_zZQMrNacxEup3UDo&callback=myMap"></script>

            </body>
            </html>
        </section>
        <section>

        </section>
    </main>

     @include("Footer")
    
   
   
    
</body>
</html>

