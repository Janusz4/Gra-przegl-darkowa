<?php

  session_start();

  if(!isset($_SESSION['zalogowany'])){
    header('Location: index.php');
    exit();
  }

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Osadnicy</title>
	<meta name="description" content="Gra przeglądarkowa.">
	<meta name="keywords" content="osadnicy, gra">
	<meta name="author" content="Janusz Siek">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/skrypt.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->

</head>

<body>
    <main>
        <h1 class="text-center logo">Osadnicy</h1>
        <div class="menu row">
                <?php
                    echo '<div class="col-md-2">Witaj '.$_SESSION['user']."</div>";
                    echo '<div id="surowce" class="col-md-6"></div>';
                    echo '<div class="col-md-2"><span class="fas fa-medal" style="position:relative; top:3px; margin-right:5px; font-size:18px;"></span><span id="ranking" style="cursor: pointer;">Ranking</span></div>';
                    echo '<div class="col-md-2"><span class="glyphicon glyphicon-log-out" style="position:relative; top:3px; margin-right:5px; font-size:18px;"></span><a href="logout.php">Wyloguj się!</a></div>';
                ?>
        </div>
        <div class="container" style="min-height: 92vh;">

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4 budynek">
                        <span class="fa fa-fort-awesome img" id ="zamek" onclick="show('zamek_info')"></span>
                        <p>Zamek</p>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 budynek">
                        <span class="fa fa-tree img" id ="tartak" onclick="show('tartak_info')"></span>
                        <p>Tartak</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4 budynek">
                        <span class="fas fa-mountain img" id ="kamieniolom" onclick="show('kamieniolom_info')"></span>
                        <p>Kamieniołom</p>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 budynek">
                        <img src = "images/field.png" id ="pole" class="img" onclick="show('pole_info')">
                        <p>Pole</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4 budynek">
                        <span class="fas fa-campground img" id ="koszary" onclick="show('koszary_info')"></span>
                        <p>Koszary</p>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 budynek">
                        <img src = "images/sword.png" class="img" id ="atakuj" onclick="show('atakuj_info')">
                        <p>Atakuj</p>
                    </div>
                </div>
                <div id="zamek_info" class="popup_content col-12 col-md-6">Zamek, poziom, koszt ulepszenia<a href = " " onclick="close(zamek)">Close</a></div>
                <div id="tartak_info" class="popup_content col-12 col-md-6">Tartak</div>
                <div id="kamieniolom_info" class="popup_content col-12 col-md-6">kamieniolom</div>
                <div id="pole_info" class="popup_content col-12 col-md-6">Pole</div>
                <div id="koszary_info" class="popup_content col-12 col-md-6">Koszary</div>
                <div id="atakuj_info" class="popup_content col-12 col-md-6">Atak</div>
                <div id="ranking_info" class="popup_content col-12 col-md-6">ranking</div>

                <div id="fade" class="black_overlay"></div>

    </main>

    <footer>
        <div class="stopka py-3 text-center footer-bottom">
            Janusz Siek
        </div>
    </footer>

</body>
</html>
