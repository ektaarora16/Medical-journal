<?php



class Login{
    public function logInMe()
    {
            include("config.php");
        
            // session_start();

            $username = mysqli_real_escape_string($conn, $_POST['login']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $decryptedPassword = md5($password);

            $result = $conn->query("SELECT * FROM da_users WHERE BINARY login='$username' and password='$decryptedPassword'");
            while($row = $result->fetch_assoc())
            {
                $_SESSION["zalogowany"] = true;
                 $_SESSION["nick"] = $username;  
                 $_SESSION["imie"] = $row["imie"];  
                 $_SESSION["nazwisko"] = $row["nazwisko"];  
                $URL="panel.php";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';           

             }

             //Tutaj masz H2 którego musisz stylować i zrobić responsywnego
            print"<h2 style='color: red; position:fixed; top: 10vh; left: 50%; transform: translateX(-50%);'>Nieprawidłowe dane!</h2>";

        

    }
}


?>