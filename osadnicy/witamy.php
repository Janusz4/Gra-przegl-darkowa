<?php
  session_start();

  if(!isset($_SESSION['udanarejestracja'])){
    header('Location: index.php');
    exit();
  }
  else {
    unset($_SESSION['udanarejestracja']);
  }

  // Usuwanie zmiennych pamiętających wartości wpisane do formularza
  if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
  if(isset($_SESSION['fr_emailk'])) unset($_SESSION['fr_email']);
  if(isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
  if(isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
  if(isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);

  // Usuwanie błędów rejestracji
  if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
  if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
  if(isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
  if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
  if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
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
            <div class="col-md-2"></div>
            <div class="bg-primary main-div text-center col-md-8">
                <h2>Dziękujemy z rejestrację</h2>
                <a href="index.php">Zaloguj się na swoje konto</a>
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
