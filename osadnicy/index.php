<?php

  session_start();

  if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true){
    header('Location: gra.php');
    exit();
  }

?>

<!DOCTYPE html>
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

  		<div class="container" style="min-height: 92vh;">
            <h1 class="logo">Osadnicy</h1>
            <p class="text-center">Rozbuduj swoją osadę i rywalizuj z innymi graczami pnąc się po szczeblach raningu.</p>

            <div class="text-light row justify-content-center">
                <div class="col-0 col-md-2"></div>
                <div class="main-div col-12 col-md-8 bg-primary text-center">
                    <form action="zaloguj.php" method="post">

                    <p><i class="fa fa-user"></i> <input type="text" name="login" placeholder="Login" id="log-login"/></p>
                    <p><i class="fa fa-lock"></i> <input type="password" name="haslo" placeholder="Hasło" id="log-haslo"/></p>
                    <p><i class="glyphicon glyphicon-log-in" style="position:relative; top:8px; margin-right:5px;"></i><input class="ml-3" type="submit" value="Zaloguj się"/></p>

                    </form>
                    <p class="mt-5"><a href="reset_password.php">Zapomniałeś hasła?</a></p>
                    <p><i class="fa fa-user-plus" style="font-size:24px"></i><a href="rejestracja.php">Rejestracja - załóż darmowe konto</a></p>
                    <?php
                        if(isset($_SESSION['blad']))  echo $_SESSION['blad'];
                        if(isset($_SESSION['resetInfo'])){
                            echo $_SESSION['resetInfo'];
                            unset($_SESSION['resetInfo']);
                        }
                    ?>
                </div>
            </div>

    </div>

  </main>

  <footer>
		<div class="stopka py-3 text-center footer-bottom">
			Janusz Siek
		</div>
    </footer>

</body>
</html>
