<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Login.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Login</title>
</head>
<body>

    @include("Header")

    
    <main class="bg-image bg">
        <section class="form-group float-right">
            <form class="form was-validated" action="{{route('login1')}}" method="post">
                @csrf
                <div>
                    <label for="username" class="form_text">Username</label><br>
                    <input class="form-control" type="text" id="username" name="username" placeholder="example1" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <label for="password" class="form_text">Password</label><br>
                    <input class="form-control" type="password" id="password" name="password" placeholder="********" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <input class="btn form_button" type="submit" value="Enter">
                </div>
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
