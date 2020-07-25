<?php
    session_start();

  if(isset($_POST["reset-password-submit"])){
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $url = "http://localhost/osadnicy/create_new_password.php?selector=" . $selector . "&validator=" . $validator;
    $password1 = $_POST["pwd1"];
    $password2 = $_POST["pwd2"];
    // Sprawdzenie poprawności hasła
    if((strlen($password1)<8) || (strlen($password1)>20)){
      $_SESSION['e_haslo'] = "Hasło  musi posiadać od 8 do  20 znaków!";
      header("Location: $url");
      exit();
    }

    if($password1!=$password2){
      $_SESSION['e_haslo'] = "Podane hasła są różne!";
      header("Location: $url");
      exit();
    }
    // Sprawdzanie Tokenu
    $currentDate = date("U");
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno!=0){
        throw new Exception(mysqli_connect_errno());
      }
      else {
        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
        $stmt = mysqli_stmt_init($polaczenie);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "There was an error!";
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "ss",$selector, $currentDate);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          if(!$row = mysqli_fetch_assoc($result)){
            $_SESSION['resetInfo'] = "Musisz ponownie przesłać prośbę o zresetowanie hasła.";
            exit();
          }
          else{
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
            if($tokenCheck === false){
              $_SESSION['resetInfo'] = "Musisz ponownie przesłać prośbę o zresetowanie hasła.";
              exit();
            }
            else{
              $tokenEmail = $row['pwdResetEmail'];
              $sql = "SELECT * FROM uzytkownicy WHERE email=?;";
              $stmt = mysqli_stmt_init($polaczenie);
              if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "Tutaj jest błąd!";
                exit();
              }
              else{
                mysqli_stmt_bind_param($stmt, "s",$tokenEmail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(!$row = mysqli_fetch_assoc($result)){
                  echo "Tutaj jest błąd!";
                  exit();
                }
                else{
                  $sql = "UPDATE uzytkownicy SET pass=? WHERE email=?";
                  $stmt = mysqli_stmt_init($polaczenie);
                  if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "Tutaj jest błąd!";
                    exit();
                  }
                  else{
                    $newPwdHash = password_hash($password1, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $_SESSION['resetInfo'] = "Twoje hasło zostało zmienione.";
                    // Usuwanie Tokenu
                    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                    $stmt = mysqli_stmt_init($polaczenie);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                      echo "Tutaj jest błąd!";
                      exit();
                    }
                    else {
                      mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                      mysqli_stmt_execute($stmt);
                      header("Location: index.php");
                    }
                  }
                }
              }
            }
          }
        }

        $polaczenie->close();
      }
    }
    catch(Exception $e){
      echo '<div class="error">Błąd serwera! Spróbuj zalogować się później.</div>';
    }
  }
  else{
    header("Loaction: index.php");
  }
?>
