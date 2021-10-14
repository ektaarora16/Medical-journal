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
        
                            array("label"=> $choroby, "y"=> $numerek)
        
                        );

                        $srednia = ($numerek * 100/1) / ($newOther->counterOfPatients($gender, $age));

                        

                        array_push(
                            $dataPointsSecond,
        
                            array("label"=> $choroby, "y"=> $srednia)
        
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
        
                            array("label"=> $choroby, "y"=> $numerek)
        
                        );

                        $srednia = ($numerek * 100/1) / ($newOther->counterOfPatients($gender, $age));
                        array_push(
                            $dataPointsSecond,
        
                            array("label"=> $choroby, "y"=> $srednia)
        
                        );


                        
                    }
                }


            
       


    }


    
   

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
	<link rel="stylesheet" href="../css/diseases.css">
	<link rel="stylesheet" href="../css/fontello.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="../img/icon.png">
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



	<div class="container-fluid">

		<header>

			<nav class="navbar navbar-dark fixed-top navbar-expand-md p-4" style="background-color: #0079bf;">
				<a class="navbar-brand text-light py-3" href="panel.php"><span class="h2"><i
							class="demo-icon icon-hospital"></i>Dziennik medyczny</span></a>

				<button class="navbar-toggler mb-2" type="button" data-toggle="collapse" data-target="#mainmenu"
					aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="mainmenu">

					<ul class="navbar-nav ml-auto">

						<li class="nav-item bg-dark p-2">
							<span class="nav-link text-light"><i class="demo-icon icon-user-o"></i>&nbsp;Zalogowano
								jako:
								<?php
								print$_SESSION["imie"];
								
								?>
								</span>
						</li>

						<li class="nav-item bg-dark p-2">
							<a class="nav-link text-light" href="logout.php"><i
									class="demo-icon icon-logout"></i>&nbsp;Wyloguj</a>
						</li>

					</ul>

				</div>

			</nav>

		</header>

		<div class="sidebar">
			<a href="panel.php"><span class="h4"><i class="demo-icon icon-desktop"></i>&nbsp;Pulpit</span></a>
			<a  href="patients.php"><span class="h4"><i
						class="demo-icon icon-accessibility"></i>&nbsp;Pacjenci</span></a>
			<a href="przyczyny.php"><span class="h4"><i class="demo-icon icon-tasks"></i>&nbsp;Przyczyny</span></a>
			<a class="active" href="choroby.php"><span class="h4"><i class="demo-icon icon-low-vision"></i>&nbsp;Choroby</span></a>
			<a href="konto.php"><span class="h4"><i class="demo-icon icon-pencil"></i>&nbsp;Konto</span></a>
		</div>

	<div class="content">
    <form method="get">

Płeć: <select name="gender">

    <option value="M">Mężczyzna</option>
    <option value="K">Kobieta</option>

</select>
<br>



Przedział wiekowy<select name="age">

    <option value="all">Każdy</option>
    <option value="30plus">0-44</option>
    <option value="45plus">45 - 64</option>
    <option value="65plus">65+</option>
    

</select>
<br>

<input class="btn btn-primary mt-1" type="submit" value="Wybierz" name="btn" onclick="wykres()">

</form>


	<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<br>
<br>
<br>
<br>
<br>
<br>

<div id="chartContainerSecond" style="height: 370px; width: 100%;"></div>




	
	</div>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>

	<script src="../js/bootstrap.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>