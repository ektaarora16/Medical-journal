<?php

    

    session_start();
	
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: ../index.php');
    }
    include("otherFunctions.php");
    include("config.php");

    $dataPoints = array(
       
    );
    
    $dataPointsSecond = array(
       
    );

    if(isset($_GET["btn"]))
    {
        $gender = $_GET["gender"];
        $age = $_GET["age"];

        

    
                if($age == "30plus")
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

                $newOther = new OtherFunctions();
                



                if($age == "all")
                {
                    $resultAllDiseases = $conn->query("SELECT DISTINCT choroba FROM da_pacjenci WHERE sex = '$gender'");
                    while($row = $resultAllDiseases->fetch_assoc())
                    {
                        $choroby = $row["choroba"];

                        $resultNumbers = $conn->query("SELECT COUNT(id) FROM da_pacjenci WHERE choroba = '$choroby' AND sex = '$gender'");
                        while($rows = $resultNumbers->fetch_assoc())
                        {
                            $numerek = $rows["COUNT(id)"];
                        }

                        array_push(
                            $dataPoints,
        
                            array("label"=> $choroby, "y"=> $numerek),
        
                        );

                        $srednia = ($numerek * 100/1) / ($newOther->counterOfPatients($gender, $age));

                        

                        array_push(
                            $dataPointsSecond,
        
                            array("label"=> $choroby, "y"=> $srednia),
        
                        );

                    }
               

                    
                }

                

                else{
                    $resultAllDiseases = $conn->query("SELECT DISTINCT choroba FROM da_pacjenci WHERE sex = '$gender' AND wiek <= $varForAgeMax AND wiek >= $varForAgeMin ");
                    while($row = $resultAllDiseases->fetch_assoc())
                    {
                        $choroby = $row["choroba"];

                        $resultNumbers = $conn->query("SELECT COUNT(id) FROM da_pacjenci WHERE choroba = '$choroby' AND wiek <= $varForAgeMax AND wiek >= $varForAgeMin AND sex = '$gender'");
                        while($rows = $resultNumbers->fetch_assoc())
                        {
                            $numerek = $rows["COUNT(id)"];
                        }

                        array_push(
                            $dataPoints,
        
                            array("label"=> $choroby, "y"=> $numerek),
        
                        );

                        $srednia = ($numerek * 100/1) / ($newOther->counterOfPatients($gender, $age));
                        array_push(
                            $dataPointsSecond,
        
                            array("label"=> $choroby, "y"=> $srednia),
        
                        );


                        
                    }
                }


            
       


    }


    
   

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
  window.onload = function () 
 {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: ""
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
secondWykres();
}

</script>
<script>
function secondWykres() {
 
var chart = new CanvasJS.Chart("chartContainerSecond", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: ""
	},
	axisY: {
		suffix: "%",
		scaleBreaks: {
			autoCalculate: true
		}
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0\"%\"",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPointsSecond, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

</head>
<body>

<form method="get">

Płeć: <select name="gender">

    <option value="M">Mężczyzna</option>
    <option value="K">Kobieta</option>

</select>
<br>



Przedział wiekowy<select name="age">

    <option value="all">Każdy</option>
    <option value="30plus"><=44</option>
    <option value="45plus">45 - 64</option>
    <option value="65plus">65+</option>
    

</select>
<br>

<input type="submit" value="Prześlij" name="btn" onclick="wykres()">

</form>

<a href="main.php">Powrót do menu!</a>


<?php

if(isset($_GET["btn"]))
{
    print"<h1 style='text-align: center'>Wykres dla $gender w wieku $age</h1>";

}
    

  

 

?>




<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<br><br>
<br>
<br>
<br>
<br>

<div id="chartContainerSecond" style="height: 370px; width: 100%;"></div>




<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>