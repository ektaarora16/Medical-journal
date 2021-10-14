<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dziennik medyczny</title>
    <link rel="stylesheet" href="../css/patients.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/icon.png">
</head>
<body>
<?php



class Data
{

    public function showPatients()
    {
        $number = 1;
        include("config.php");

        $nickUser = $_SESSION['nick'];
        $resultID = $conn->query("SELECT id FROM da_users WHERE login ='$nickUser' ");
        while($row = $resultID->fetch_assoc())
            {
                $ID = $row["id"];

            }

            if(isset($_POST["btnDelete"]))
            {
                function checkNeedDelete($id)
                {
                    if(isset($_POST["id"][$id]))
                    {
                        
                        include("config.php");
    
                        $conn->query("DELETE FROM da_pacjenci WHERE id = $id");
                    }
                }
    
                $ResultNew = $conn->query("SELECT * FROM da_pacjenci WHERE ID_User = '$ID'");
                while($row = $ResultNew->fetch_assoc())
                {
                    $id = $row["id"];
                    checkNeedDelete($id);
    
                }
    
            }

            if(isset($_POST["btn"]))
        {
            function check($first, $second, $what, $id)
            {
                if($first !== $second)
                { 

                    include("config.php");

                    $stmt = $conn->query("UPDATE da_pacjenci SET $what = '$second' WHERE id = $id");
                    
                    return true;
                }

            }

           
          

            $ResultNew = $conn->query("SELECT * FROM da_pacjenci WHERE ID_User = '$ID'");
            while($row = $ResultNew->fetch_assoc())
            {
                
                $id = $row["id"];
                $imie = $row["imie"];
                $nazwisko = $row["nazwisko"];
                $sex = $row["sex"];
                $wiek = $row["wiek"];
                $waga = $row["waga"];
                $wzrost = $row["wzrost"];
                $choroba = $row["choroba"];
                $objawy = $row["objawy"];
                $przyczyny = $row["przyczyny"];

                $newImie = $_POST["imie"][$id];
                $newNazwisko = $_POST["nazwisko"][$id];
                $newSex = $_POST["sex"][$id];
                $newWiek = $_POST["wiek"][$id];
                $newWaga = $_POST["waga"][$id];
                $newWzrost = $_POST["wzrost"][$id];
                $newChoroba = $_POST["choroba"][$id];
                $newObjawy = $_POST["objawy"][$id];
                $newPrzyczyny = $_POST["przyczyny"][$id];

                


                check($imie, $newImie, "imie", $id);
                check($nazwisko, $newNazwisko, "nazwisko", $id);
                check($sex, $newSex, "sex", $id);
                check($wiek, $newWiek, "wiek", $id);
                check($waga, $newWaga, "waga", $id);
                check($wzrost, $newWzrost, "wzrost", $id);
                check($choroba, $newChoroba, "choroba", $id);
                check($objawy, $newObjawy, "objawy", $id);
                check($przyczyny, $newPrzyczyny, "przyczyny", $id);

                


            }

        }

        $result = $conn->query("SELECT * FROM da_pacjenci WHERE ID_User = '$ID'");
        
        print"<form method='POST' action='patients.php'>";
        print
        "
        <table class='table table-responsive'>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Imię</th>
            <th scope='col'>Nazwisko</th>
            <th scope='col'>Płeć</th>
            <th scope='col'>Wiek</th>
            <th scope='col'>Waga</th>
            <th scope='col'>Wzrost</th>
            <th scope='col'>Choroba</th>
            <th scope='col'>Objawy</th>
            <th scope='col'>Przyczyny</th>
            <th scope='col'>Usunąć?</th>
          </tr>
        </thead>
        ";
        while($row = $result->fetch_assoc())
                {
                    $id = $row["id"];
                    $imie = $row["imie"];
                    $nazwisko = $row["nazwisko"];
                    $sex = $row["sex"];
                    $wiek = $row["wiek"];
                    $waga = $row["waga"];
                    $wzrost = $row["wzrost"];
                    $choroba = $row["choroba"];
                    $objawy = $row["objawy"];
                    $przyczyny = $row["przyczyny"];
                    print 
                    "<tbody>
                    <tr>
                    <th scope='row'>" . $number++ . "</th>
                    <td>
                    <input type='text' value='$imie' name='imie[$id]' >
                    </td>
                    <td>
                    <input type='text'  value='$nazwisko' name='nazwisko[$id]'>
                    </td>
                    ";
                    if($sex == "M")
                    {
                        print 
                        "
                        <td>
                        <select name='sex[$id]'>
                                <option value='M' selected>Mężczyzna</option>
                                <option value='K' >Kobieta</option>
                        </select>
                        </td>
                        ";
                    }
                    else
                    {
                        print
                        "
                        <td>
                        <select name='sex[$id]'>
                                <option value='M'>Mężczyzna</option>
                                <option value='K' selected>Kobieta</option>
                        </select>
                        </td>
                        "; 
                    }
                    print
                    "
                    <td>
                    <input type='number' name='wiek[$id]' value='$wiek' min='0' max='150'>
                    </td>
                    <td>
                    <input type='number' value='$waga' name='waga[$id]' min='0' max='150'>
                    </td>
                    <td>
                    <input type='number' value='$wzrost' name='wzrost[$id]' min='0' max='230'>
                    </td>
                    <td>
                    <input type='text' value='$choroba' name='choroba[$id]'>
                    </td>
                    <td>
                    <input type='text' name='objawy[$id]' value='$objawy'>
                    </td>
                    <td>
                    <input type='text' value='$przyczyny' name='przyczyny[$id]'>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name='id[$id]' type='checkbox'>
                    </td>
                    </tr>
                    </tbody>
                    ";
                }
                print "</table>";
                print"
                <input class='btn btn-primary' type='submit' value='Edytuj' name='btn'>
                <input class='btn btn-dark' type='submit' value='Usuń' name='btnDelete'>  
                ";
                print "</form>";
                print "<h1 class='mt-5 mb-3' style='text-align: center'>Dodowanie nowego użytkownika: </h1>";
                print "<form method='POST' onsubmit='return myFunction()'>";
                print 
                "
                <table class='table table-responsive'>
                <thead>
                <tr>
                <th scope='col'>Imię</th>
                <th scope='col'>Nazwisko</th>
                <th scope='col'>Płeć</th>
                <th scope='col'>Wiek</th>
                <th scope='col'>Waga</th>
                <th scope='col'>Wzrost</th>
                <th scope='col'>Choroba</th>
                <th scope='col'>Objawy</th>
                <th scope='col'>Przyczyny</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>
                <input type='text' name='UserImie'>
                </td>
                <td>
                <input type='text'  name='UserNazwisko'>
                </td>
                <td>
                <select name='DA_usersex'>
                                <option value='M'>Mężczyzna</option>
                                <option value='K' selected>Kobieta</option>
                </select>
                </td>
                <td>
                <input type='number' name='UserWiek' min='0' max='150'>
                </td>
                <td>
                <input type='number'  name='UserWaga' min='0' max='150'>
                </td>
                <td>
                <input type='number' name='UserWzrost' min='0' max='230'>
                </td>
                <td>
                <input type='text'  name='UserChoroba'>
                </td>
                <td>
                <input type='text' name='UserObjawy'>
                </td>
                <td>
                <input type='text' name='UserPrzyczyny'>
                </td>
                </tr>
                </tbody>
                </table>
                <input class='btn btn-success' type='submit' value='Dodaj' name='addUser' id='addNewUser'>
                ";
                if(isset($_POST["addUser"]))
                {

                    // if(!isset($UserImie) || trim($UserImie) == '')
                    // {
                    //     $message = "Wypełnij puste pola!";
                    //     echo "<script type='text/javascript'>alert('$message');</script>";
                    //     return false;
                    // }
                   

                    

                    // else{
                        $UserImie = $_POST["UserImie"];
                        $UserNazwisko = $_POST["UserNazwisko"];
                        $DA_usersex = $_POST["DA_usersex"];
                        $UserWiek = $_POST["UserWiek"];
                        $UserWaga = $_POST["UserWaga"];
                        $UserWzrost = $_POST["UserWzrost"];
                        $UserChoroba = $_POST["UserChoroba"];
                        $UserObjawy = $_POST["UserObjawy"];
                        $UserPrzyczyny = $_POST["UserPrzyczyny"];
    
    
                        $conn->query("INSERT INTO da_pacjenci (imie, nazwisko, sex, wiek, waga, wzrost, choroba, objawy, przyczyny, ID_User) VALUES ('$UserImie', '$UserNazwisko', '$DA_usersex', '$UserWiek', '$UserWaga', '$UserWzrost', '$UserChoroba', '$UserObjawy', '$UserPrzyczyny', '$ID')");
                        $URL="patients.php";
                        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';   
                    // }
                }
                print "</form>";
               
    }
}  

?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>

	<script src="../js/bootstrap.min.js"></script>
</body>
</html>
