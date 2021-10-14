<?php
include("config.php");

class Causes{
    public function showCauses($choroba)
    {
        $dataPoints = array( 
	
        );

    
         
        $resultedCausesMany= $conn->query("SELECT przyczyny, COUNT(przyczyny) AS newc FROM da_pacjenci WHERE choroba = '$choroba' GROUP BY przyczyny ORDER BY newc DESC LIMIT 100");
        
        while($row = $resultedCausesMany->fetch_assoc())
        {
            $causes = $row["przyczyny"];
            $howMany = $row["newc"];
            $newOther = new otherFunctions();
            $howManyPatients = $newOther->counterOfPatientsAll($choroba);
            $srednia = ($howMany / $howManyPatients) * 100/1;
        
            print"Przyczyny chorób dla $choroba ";
        
            print"$causes wynosi : ";
            echo round($srednia);
            print" %<br><br>";
        
            array_push($dataPoints, array("label"=> $causes, "y"=> $srednia));

        }     
        
        
        return $dataPoints;


                    



    }
    
}

?>