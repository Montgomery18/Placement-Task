<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/AdminDeleteUser.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Manage Users</title>
</head>
<body>
    @include("Header")
    <main>
        <section>
        <form class="form was-validated" action="{{route('views.delete')}}" method="post">
             @csrf
            <input type="text" id="username" name="username" placeholder= "Enter User ID" ><br>
            <input class="delete_button" type="submit" value="Delete">
        </form>
        </section>
    </main>

    <footer>
    @include("Footer")
    </footer>
</body>
</html>
