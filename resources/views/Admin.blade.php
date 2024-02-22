<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/Admin.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Admin</title>
</head>
<body>
    @include("Header")
    <main>
        <section>
        <ul id="admin_list">
                <li><a href="/AdminPassReset">Password Reset Management</a></li>
                <li><a href="/AdminDeleteUser">Manage Users</a></li>
            </ul>
        </section>
    </main>

    <footer>
    @include("Footer")
    </footer>
</body>
</html>
