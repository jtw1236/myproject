
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Form</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height:900px;
    }

    .register-form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(2, 0, 0, 0.42);
      width: 300px;
    }

    h2 {
      margin-bottom: 20px;
      text-align: center;
      color:rgba(150, 51, 51, 1)
    }

   input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid rgba(145, 134, 134, 1);
    }

    .register-form input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: rgba(0, 47, 255, 1);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .register-form input[type="submit"]:hover {
      background-color: rgb(25, 0, 255);
    }
     a{
     text-decoration: none;
     text-align:center;
     color: rgba(255, 238, 238, 1)

    }
    .link{
     border: 2px solid black;
     background-color: rgba(201, 24, 24, 1);
     text-align:center;
     border-radius:5px
    }
    .error { color:#e74c3c; font-weight:bold; display:block; margin-top:10px; }
  </style>
</head>
<body>


  <form class="register-form" action="login_action.php" method="POST">
    <h2>Welcome to Login Page</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Submit">
    <a href="register.php"><div class="link"> <b>Go Register</b></div></a>
        <?php 
    if (isset($massage)) {
    echo $massage;} ?>

  </form>

</body>
</html>
