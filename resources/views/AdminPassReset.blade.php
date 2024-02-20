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
    <header>
    <div id="LeftHead">
            <img src="{{ asset('images/Elanco_Logo.png') }}" alt="Elanco Logo">
            <p><a href="/Login">Login</a></p>
        </div>
        <div id="RightHead">
            <h1>Activity Tracker</h1>
            <nav>
                <ul>
                    <li><a href="/Register">Register</a></li>
                    <li><a href="/ResetPassRequest">Reset Password Request</a></li>                        
                    <li><a href="/Profile">Profile</a></li>
                    <li><a href="/Trends">Trends</a></li>
                    <li><a href="/Admin">Admin</a></li>
                    <li><a href="/ContactUs">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </header>
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

    </footer>
</body>
</html>