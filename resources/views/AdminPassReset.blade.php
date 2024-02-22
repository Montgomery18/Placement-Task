<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/AdminPassReset.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/Header.css') }}" rel="stylesheet" >

    <title>Passsword Reset Management</title>
</head>
<body>
    @include("Header")
    <main>
        <section>
<table>
<tr>
    <th>User ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Actions</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Example1</td>
    <td>Example1@gmail.com</td>
    <td>
    <button type="button" class="view_button">View</button>
    <button type="button" class="accept_button">Accept</button>
    <button type="button" class="decline_button">Decline</button>
    </td>  
  </tr>
  <tr>
</table>
        </section>
    </main>

    <footer>
    @include("Footer")
    </footer>
</body>
</html>
