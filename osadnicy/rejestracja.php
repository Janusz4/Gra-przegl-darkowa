<?php

  session_start();

  if(isset($_POST['email'])){
    // Udana walidacja?
    $wszystkoOK = true;

    // Sprawdź poprawność Nickname'a
    $nick = $_POST['nick'];

    // Sprawdzeneie długości nick'a
    if((strlen($nick)<3) || (strlen($nick)>20)){
      $wszystkoOK = false;
      $_SESSION['e_nick'] = "Nick  musi posiadać od 3 do  20 znaków!";
    }
    // Sprawdzenie znaków
    if(!ctype_alnum($nick)){
      $wszystkoOK = false;
      $_SESSION['e_nick'] = "Nick może się składać tylko z liter i cyfr (bez polskich znaków)";
    }
    // Sprawdzenie adresu Email
    $email = $_POST['email'];
    $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);

    if(!filter_var($emailB, FILTER_VALIDATE_EMAIL) || ($email != $emailB)){
      $wszystkoOK = false;
      $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }
    // Sprawdzenie poprawności hasła
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];

    if((strlen($haslo1)<8) || (strlen($haslo1)>20)){
      $wszystkoOK = false;
      $_SESSION['e_haslo'] = "Hasło  musi posiadać od 8 do  20 znaków!";
    }

    if($haslo1!=$haslo2){
      $wszystkoOK = false;
      $_SESSION['e_haslo'] = "Podane hasła są różne!";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    // Czy zaakceptowano regulamin
    if(!isset($_POST['regulamin'])){
      $wszystkoOK = false;
      $_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu!";
    }

    // Bot or not?
    $sekret = "6LeNneEUAAAAAL823wzxVXJ3FcZg15M5HBb1qfXS";

    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

    $odpowiedz = json_decode($sprawdz);

    if($odpowiedz->success == false){
      $wszystkoOK = false;
      $_SESSION['e_bot'] = "Potwierdź, że nie jesteś botem!";
    }

    // Zapamiętaj wprowadzone dane
    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
    if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

    // Sprawdzenie czy taki użytkownik już istnieje
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno!=0){
        throw new Exception(mysqli_connect_errno());
      }
      else {
        // Czy e-mail już istnieje?
        $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");

        if(!$rezultat) throw new Exception($polaczenie->error);

        $ile_takich_maili = $rezultat->num_rows;
        if($ile_takich_maili>0){
          $wszystkoOK = false;
          $_SESSION['e_email'] = "Istnieje już konto o takim adresie e-mail!";
        }

        // Czy nick już istnieje?
        $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

        if(!$rezultat) throw new Exception($polaczenie->error);

        $ile_takich_nickow = $rezultat->num_rows;
        if($ile_takich_nickow>0){
          $wszystkoOK = false;
          $_SESSION['e_nick'] = "Ten nick jesst już zajęty!";
        }

        if($wszystkoOK){
         /* if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, 0, 0)")){
            $_SESSION['udanarejestracja']=true;
            header('Location: witamy.php');
          }
          else {
            throw new Exception($polaczenie->error);
          }
        }

        $polaczenie->close();
        */
        try {
            // rozpoczęcie tranzakcji
            $polaczenie->begin_transaction();

            $polaczenie->query("INSERT INTO wojska VALUES (NULL, 0, 0)");
            $polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, LAST_INSERT_ID(), 0, 0, 0)");
            $polaczenie->query("INSERT INTO wioski VALUES (NULL, LAST_INSERT_ID(), 1, 1, 1, 1, 1)");

            // wykonanie tranzakcji
            $polaczenie->commit();

            $_SESSION['udanarejestracja']=true;
            header('Location: witamy.php');
        } catch (Exception $e) {
            // wycofanie tranzakcji
            $polaczenie->rollback();
        }
        finally{
            $polaczenie->close();
        }
      }
    }
  }
    catch(Exception $e){
      echo '<div class="error">Błąd serwera! Spróbuj zarejstrować się pużniej.</div>';
    }

  }

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Osadnicy - załóż darmowe konto!</title>
	<meta name="description" content="Gra przeglądarkowa.">
	<meta name="keywords" content="osadnicy, gra">
	<meta name="author" content="Janusz Siek">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
            <h3 class="text-center">Rejestracja</h3>

            <div class="text-light row justify-content-center">
                <div class="col-0 col-md-2"></div>
                <div class="rejstracja col-12 col-md-8 bg-primary text-center">

                  <form method="post">

                    <i class="fa fa-user"></i> <input type="text" placeholder="Nazwa użytkownika" value="<?php
                      if(isset($_SESSION['fr_nick'])){
                        echo $_SESSION['fr_nick'];
                        unset($_SESSION['fr_nick']);
                      }
                    ?>" name="nick"/><br/>

                    <?php
                      if(isset($_SESSION['e_nick'])){
                        echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                        unset($_SESSION['e_nick']);
                      }
                    ?>

                    <i class="fa fa-at"></i> <input type="text" placeholder="e-mail" value="<?php
                      if(isset($_SESSION['fr_email'])){
                        echo $_SESSION['fr_email'];
                        unset($_SESSION['fr_email']);
                      }
                    ?>" name="email"/><br/>

                    <?php
                      if(isset($_SESSION['e_email'])){
                        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                        unset($_SESSION['e_email']);
                      }
                    ?>

                    <i class="fa fa-lock"></i> <input type="password" placeholder="Hasło" value="<?php
                      if(isset($_SESSION['fr_haslo1'])){
                        echo $_SESSION['fr_haslo1'];
                        unset($_SESSION['fr_haslo1']);
                      }
                    ?>" name="haslo1"/><br/>

                    <?php
                      if(isset($_SESSION['e_haslo'])){
                        echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                        unset($_SESSION['e_haslo']);
                      }
                    ?>

                    <i class="fa fa-lock"></i> <input type="password" placeholder="Powtórz hasło" value="<?php
                      if(isset($_SESSION['fr_haslo2'])){
                        echo $_SESSION['fr_haslo2'];
                        unset($_SESSION['fr_haslo2']);
                      }
                    ?>" name="haslo2"/><br/>

                    <label>
                      <input type="checkbox" name="regulamin" <?php
                        if(isset($_SESSION['fr_regulamin'])){
                          echo "checked";
                          unset($_SESSION['fr_regulamin']);
                        }
                      ?> /> Akceptuję regulamin
                    </label>

                    <?php
                      if(isset($_SESSION['e_regulamin'])){
                        echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                        unset($_SESSION['e_regulamin']);
                      }
                    ?>

                    <div class="g-recaptcha ml-a mr-a" data-sitekey="6LeNneEUAAAAAC4ybgbQHgQrt4_P-n5b5h69J8zj"></div>

                    <?php
                      if(isset($_SESSION['e_bot'])){
                        echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                        unset($_SESSION['e_bot']);
                      }
                    ?>

                    <br/>

                    <input type="submit" value="Zarejestruj się"/>

                  </form>

              </div>
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
