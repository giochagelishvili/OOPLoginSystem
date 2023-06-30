<?php
  // Start the session
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Log In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <?php
      // Check if user is logged in
      if(isset($_SESSION["userid"])) 
      {
    ?>
      <!-- Display this form if the user is logged in -->
      <form action="includes/logout.inc.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">You are logged in</h1>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="logout">Logout</button>
      </form>
    <?php
      }
      else
      {
    ?>
      <!-- Display these forms if the user is not logged in -->
      <form action="includes/login.inc.php" method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <input type="text" name="uid" placeholder="Username" class="form-control mb-3" required>
        <input type="password" name="pwd" placeholder="Password" class="form-control mb-3" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      </form>
      <form action="includes/signup.inc.php" method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">SIGN UP</h1>
        <p>Don't have an account yet? Sign up here!</p>

        <input type="email" name="email" placeholder="E-mail" class="form-control mb-3" required">
        <input type="text" name="uid" placeholder="Username" class="form-control mb-3" required">
        <input type="password" name="pwd" placeholder="Password" class="form-control mb-3" required">
        <input type="password" name="pwdrepeat" placeholder="Repeat Password" class="form-control mb-3" required">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign Up</button>
      </form>
    <?php
      }
    ?>
  </body>
</html>
