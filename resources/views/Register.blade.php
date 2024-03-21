<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Register.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Register</title>
</head>
<body>

    @include("Header")

    <main class="bg-image bg">
        <section class="form-group float-right">
            <form class="form was-validated" action="{{route('views.add')}}" method="post">
                @csrf
                <div>
                    <label for="email" class="form_text">Email</label><br>
                    <input class="form-control" type="text" id="username" name="username" placeholder="example@email.com" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <label for="passw" class="form_text">Password</label><br>
                    <input class="form-control" type="text" id="passw" name="passw" placeholder="********" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <input class="btn form_button" type="submit" value="Enter">
                </div>
                @if (isset($error))
                    <p>{{ $error }}</p>
                @endif
            </form>
        </section>
    </main>

     <footer>
     @include ("Footer")
    </footer>
    
</body>
</html>

