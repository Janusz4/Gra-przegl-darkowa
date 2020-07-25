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

    //koszt rekrutacji jednostki wynosi 700
      if($_SESSION['zboze'] >= 700){
          try {
            // rozpoczęcie tranzakcji
            $polaczenie->begin_transaction();

            // zapytania
            $sql = "UPDATE uzytkownicy SET zboze = ".($_SESSION['zboze'] - 700)." WHERE id = ".$_SESSION['id'];
            $polaczenie->query($sql);
            $sql = "UPDATE wojska
                    SET wojska.wojownicy = wojska.wojownicy + 1
                    WHERE wojska.id_wojska = ".$_SESSION['id_wojska'];

            $polaczenie->query($sql);

            // wykonanie tranzakcji
            $polaczenie->commit();
        } catch (Exception $e) {
            // wycofanie tranzakcji
            $polaczenie->rollback();
        }
      }
    }
  }
  catch(Exception $e){
    alert("Bład serwera!");
  }
?>
