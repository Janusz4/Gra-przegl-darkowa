<?php

  session_start();

  if(!isset($_POST['login']) || !isset($_POST['haslo'])){
    header('Location: index.php');
    exit();
  }

  require_once "connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);

  try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno!=0){
        throw new Exception(mysqli_connect_errno());
      }
      else {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        // Encje HTML
        $login = htmlentities($login, ENT_NOQUOTES, "UTF-8");

        if($rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
        mysqli_real_escape_string($polaczenie,$login)))){
          $ilu_userow = $rezultat->num_rows;
          if($ilu_userow>0){
            $wiersz = $rezultat->fetch_assoc();

            if(password_verify($haslo, $wiersz['pass'])){

              $_SESSION['id'] = $wiersz['id'];
              $_SESSION['user'] = $wiersz['user'];
              $_SESSION['drewno'] = $wiersz['drewno'];
              $_SESSION['kamien'] = $wiersz['kamien'];
              $_SESSION['zboze'] = $wiersz['zboze'];
              $_SESSION['email'] = $wiersz['email'];
              $_SESSION['id_wojska'] = $wiersz['id_wojska'];
              $_SESSION['chwala'] = $wiersz['chwala'];
              $_SESSION['admin'] = $wiersz['administrator'];
              $ban = $wiersz['zablokowany'];

              $rezultat->close();
              if($ban == 0){

                  if($_SESSION['admin'] == 1){
                      //$_SESSION['zalogowany'] = true;
                      unset($_SESSION['blad']);
                      echo "adsad";
                      header('Location: admin.php');
                  }
                  else {
                      $_SESSION['zalogowany'] = true;
                      unset($_SESSION['blad']);
                      header('Location: index.php');
                  }
              }
              else{
                  $_SESSION['blad'] = '<span style="color:red;">Twoje konto zostało zablokowane.</span>';
                  header('Location: index.php');
              }

            }
            else{
              $_SESSION['blad'] = '<span style="color:red;">Nieprawidłowy login lub hasło!</span>';
              header('Location: index.php');
            }
          } else{
            $_SESSION['blad'] = '<span style="color:red;">Nieprawidłowy login lub hasło!</span>';
            header('Location: index.php');
          }

        }

        $polaczenie->close();
      }
  }
  catch(Exception $e){
    echo '<div class="error">Błąd serwera! Spróbuj zalogować się później.</div>';
  }
?>
