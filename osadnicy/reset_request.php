<?php

  if(isset($_POST["reset_request_submit"])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/osadnicy/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = date("U") + 1800; // wygaśnięcie = dzisiejsza data + 1h

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if($polaczenie->connect_errno!=0){
          throw new Exception(mysqli_connect_errno());
        }
        else {
          $userEmail = $_POST["email"];

          // USUWANIE STAREGO TOKENU
          $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
          $stmt = mysqli_stmt_init($polaczenie);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
          }

          // WSTAWIANIE NOWEGO TOKENU
          $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
          $stmt = mysqli_stmt_init($polaczenie);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
          }
          else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
          }

          mysqli_stmt_close($stmt);

          // WYSŁANIE EMAILA
          $message = '<p>Kliknij w link jeżeli chcesz zmienić hasło. Jeżeli to nie ty spróbowałeś zmienić hasło zignoruj ten e-mail<p>
                      <p>Tutaj jest linkt resetujący haslo: </br>
                      <a href="' . $url . '">' . $url . '</a></p>';
          require_once('PHPMailer/PHPMailerAutoload.php');

          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = 'tls';
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = 587;
          $mail->isHTML();
          $mail->CharSet = 'UTF-8';
          $mail->Username = 'no.replay.projekt@gmail.com';
          $mail->Password = 'zaq1@WSX';
          $mail->SetFrom('no.replay.projekt@gmail.com');
          $mail->Subject = 'Zresetuj swoje hasło!';
          $mail->Body = $message;
          $mail->AddAddress("$userEmail");
          $mail->Send();

          $polaczenie->close();

          header("Location: reset_password.php?reset=success");
        }
    }
    catch(Exception $e){
      echo '<div class="error">Błąd serwera! Spróbuj odzyskać hasło później.</div>';
    }
  }
  else {
    header("index.php");
  }

?>
