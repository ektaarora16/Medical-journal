

<?php

class OtherFunctions{

    public function counterOfPatients($gender, $age)
    {
        include("config.php");

        if($age == "all")
        {
            $varForAgeMax = 150;
            $varForAgeMin = 0;
        }

        else if($age == "30plus")
        {
            $varForAgeMax = 44;
            $varForAgeMin = 0;
        }

        else if($age == "45plus")
        {
            $varForAgeMax = 64;
            $varForAgeMin = 45;
        }

        else if($age == "65plus")
        {
            $varForAgeMax = 1000;
            $varForAgeMin = 65;
        }

        
        

            $resultForMen = $conn->query("SELECT id, COUNT(id) FROM da_pacjenci WHERE sex = '$gender' AND wiek <= $varForAgeMax AND wiek >= $varForAgeMin");
        while($row = $resultForMen->fetch_assoc())
        {
            $counter = $row["COUNT(id)"];
            // PRINT"COUNTER MO $counter<BR>";

        }
        return $counter;

    }


    public function counterOfPatientsAll($choroba)
    {
        include("config.php");

            $result = $conn->query("SELECT COUNT(id) FROM da_pacjenci WHERE choroba = '$choroba'");
        while($row = $result->fetch_assoc())
        {
            $counter = $row["COUNT(id)"];
            // PRINT"COUNTER MO $counter<BR>";

        }
        return $counter;
    }



}


?>