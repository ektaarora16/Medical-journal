<?php
    include("Data.php");
    include("config.php");

    session_start();
	
if (!isset($_SESSION['zalogowany']))
{
    header('Location: ../index.php');
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
	<link rel="stylesheet" href="../css/patients.css">
	<link rel="stylesheet" href="../css/fontello.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="../img/icon.png">
	<script>
    
    function myFunction() {
        let inputs = document.querySelectorAll("input");
        for(let i =0; i < inputs.length; i++)
        {
            if(inputs[i].value == "")
            {
                alert("Uzupłenij puste pola!");
                return false;

            }
        }
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
			<a class="active" href="patients.php"><span class="h4"><i
						class="demo-icon icon-accessibility"></i>&nbsp;Pacjenci</span></a>
			<a href="przyczyny.php"><span class="h4"><i class="demo-icon icon-tasks"></i>&nbsp;Przyczyny</span></a>
			<a href="choroby.php"><span class="h4"><i class="demo-icon icon-low-vision"></i>&nbsp;Choroby</span></a>
			<a href="konto.php"><span class="h4"><i class="demo-icon icon-pencil"></i>&nbsp;Konto</span></a>
		</div>

	<div class="content">
	
	
	<?php
   $ShowPatients = new Data();
   $ShowPatients->showPatients();


?>
	</div>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>

	<script src="../js/bootstrap.min.js"></script>

</body>

</html>