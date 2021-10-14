<?php
    session_start();
    if (isset($_SESSION['zalogowany'])) {

        $URL="panel.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';   
               
    }

    include("../subpages/Log_In.php");
    include("../subpages/config.php");

   

?>
<!DOCTYPE html>
<html lang="pl">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Dziennik medyczny</title>
  <meta name="description" content="Dziennik medyczny">
  <meta name="keywords" content="dziennik medyczny, lekarze, pacjenci, choroby, dziennik lekarza">
  <meta name="author" content="Adam Franz i Daniel Śledź">
  <meta http-equiv="X-Ua-Compatible" content="IE=edge">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/signin.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/icon.png">
  </head>

  <body class="text-center">
    <form class="form-signin" action="login.php" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Logowanie</h1>
      <p class="mt-3">(konto testowe: daniel, hasło: 12345)</p>
      <label for="inputEmail" class="sr-only">E-mail</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Podaj swój login..." required="" autofocus="" name="login">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Podaj swoje hasło..." required="" name="password">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Zapamiętaj mnie
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj się</button>
      <p class="mt-5 mb-3 text-muted">Dziennik medyczny © 2020 </p>
    </form>

    <?php

    //test
    // print "test";
    // include("config.php");
    // $result = $conn->query("SELECT * FROM da_users");
    // while ($row = $result->fetch_assoc())
    // {
    //   print "test";
    // }


    if($_POST)
    {

        $login = new Login();
        $login->logInMe(); 


    }
   
    ?>
  

</body></html>