<?php
    session_start();

    include 'connect.php';
    mysqli_report(MYSQLI_REPORT_STRICT);

  try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno!=0){
        throw new Exception(mysqli_connect_errno());
      }
      else {
            $sql = "SELECT drewno, kamien, zboze, chwala
            FROM uzytkownicy WHERE id = ?";
            $id = $_SESSION['id'];
            $stmt = $polaczenie->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($drewno, $kamien, $zboze, $chwala);
            $stmt->fetch();
            $stmt->close();

            $_SESSION['drewno'] = $drewno;
            $_SESSION['kamien'] = $kamien;
            $_SESSION['zboze'] = $zboze;
            $_SESSION['chwala'] = $chwala;


            echo '<div class="col-md-3"> Drewno ' . $drewno . "</div>";
            echo '<div class="col-md-3"> Kamień ' . $kamien . "</div>";
            echo '<div class="col-md-3"> Zboże ' . $zboze . "</div>";
            echo '<div class="col-md-3"> Chwała ' . $chwala . "</div>";

      }
  }
  catch(Exception $e){

  }
 ?>
