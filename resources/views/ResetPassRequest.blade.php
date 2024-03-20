<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/ResetPass.css') }}" rel="stylesheet" >
    <title>Password Reset Request</title>
</head>
<body>
    @include("Header")

    <h2>Reset account password</h2>
    <p>Enter a new password for '@example.gmail.com' </p>
    <main class="bg-image bg">
    <section class="form-group float-right">
            <form class="form was-validated form-container" action="{{route('ResetPass1')}}" method="post">
                @csrf
                <div>
                    <label for="passw" class="form_text">Password</label><br>
                    <input class="form-control" type="password" id="passw" name="passw" placeholder="********" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <input class="btn form_button" type="submit" value="Enter">
                </div>
            </form>
    </main>
    @include("Footer")
</body>
</html>
