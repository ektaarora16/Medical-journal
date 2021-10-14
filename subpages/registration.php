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
    <form class="form-signin" action="registration.php" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Rejestracja</h1>
      <label for="inputLogin" class="sr-only">Login</label>
      <input type="login" id="inputLogin" name="login" class="form-control" placeholder="Podaj swój login..." required="" autofocus="">
      <label for="inputImie" class="sr-only">Imię</label>
      <input type="text" id="inputImie" name="imie" class="form-control" placeholder="Podaj swoje imię..." required="" autofocus="">
      <label for="inputNazwisko" class="sr-only">Nazwisko</label>
      <input type="text" id="inputNazwisko" name="nazwisko" class="form-control" placeholder="Podaj swoje nazwisko..." required="" autofocus="">
      <label for="inputEmail" class="sr-only">E-mail</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Podaj swój adres e-mail..." required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Podaj swoje hasło..." required="">
      <label for="confirmPassword" class="sr-only">Confirm Password</label>
      <input type="password" id="confirmPassword" name="repeatPassword" class="form-control" placeholder="Powtórz swoje hasło..." required="">
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn">Zarejestruj się</button>
      <p class="mt-3">Masz konto? <a href="login.php">Zaloguj się</a></p>
      <p class="mt-5 mb-3 text-muted">Dziennik medyczny © 2020 </p>
    </form>

    <?php
    include("Log_In.php");
    include("config.php");
    if(isset($_POST["btn"]))
    {
        $userLogin = $_POST["login"];
        $userImie = $_POST["imie"];
        $DA_usersurname = $_POST["nazwisko"];
        $repeatPassword = $_POST["repeatPassword"];
        $userEmail = $_POST["email"];

        if ($_POST['password']!= $_POST['repeatPassword'])
        {
                $URL="registration.php?fail";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';   
                exit();
        }
      
    
        $didEmailExist = $conn->query("SELECT email FROM da_users WHERE email='$userEmail'");

            if(mysqli_num_rows($didEmailExist))
            {

                $URL="registration.php?failemail";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';   
                // echo"<h2 style='color: red; position:fixed; top: 10vh; left: 50%; z-index:999; transform: translateX(-50%);'>Konto pod podanym emailem już istnieje!</h2>";
                exit();
            }

        $hashed_userPassword = hash('MD5', $_POST['password']);

        // print"INSERT INTO `da_users` (`id`, `imie`, `login`, `nazwisko`, `password`, `email`) VALUES (NULL, '$userImie', '$userLogin', `$DA_usersurname`,  '$hashed_userPassword', '$userEmail')";
            
        if($conn->query("INSERT INTO da_users (id, imie, login, nazwisko, password, email) VALUES (NULL, '$userImie', '$userLogin', '$DA_usersurname',  '$hashed_userPassword', '$userEmail')") === true)
        {
            $URL="registration.php?confirmed";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';   
                // print"Zarejestrowano!";

        }

        
        
        
           



        // $password = $_POST["password"];
    }

    if(isset($_GET["confirmed"]))
    {
        print"<h2 style='color: green; position:fixed; top: 10vh; left: 50%; transform: translateX(-50%);'>Zarejestrowano!</h2>";

    }

    if(isset($_GET["fail"]))
    {
        print"<h2 style='color: red; z-index: 999; position:fixed; top: 10vh; left: 50%; transform: translateX(-50%);'>Hasła nie są do siebie podobne!</h2>";

    }

     

    if(isset($_GET["failemail"]))
    {
        print"<h2 style='color: red; position:fixed; top: 10vh; left: 50%; z-index:999; transform: translateX(-50%);'>Dany e-mail był już użyty!</h2>";
    }

    

?>
  

</body></html>