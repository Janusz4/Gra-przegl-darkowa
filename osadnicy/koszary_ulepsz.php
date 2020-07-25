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

      $sql = "SELECT id_koszar FROM wioski WHERE id_uzytkownika = ".$_SESSION['id'];
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          $id_koszar = $row['id_koszar'];
        }
      }

      $sql = "SELECT * FROM koszary WHERE id_koszar = $id_koszar";
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
          $row = mysqli_fetch_assoc($result);
      }

      //ulepszenie
      if($_SESSION['drewno'] >= $row['drewno'] && $_SESSION['kamien'] >= $row['kamien']){
          try {
            // rozpoczęcie tranzakcji
            $polaczenie->begin_transaction();

            // zapytania
            $sql = "UPDATE uzytkownicy SET drewno = ".($_SESSION['drewno'] - $row['drewno'])." WHERE id = ".$_SESSION['id'];
            $polaczenie->query($sql);
            $sql = "UPDATE uzytkownicy SET kamien = ".($_SESSION['kamien'] - $row['kamien'])." WHERE id = ".$_SESSION['id'];
            $polaczenie->query($sql);
            $sql = "UPDATE wioski
                    SET wioski.id_koszar =
                        "."(
                        SELECT koszary.id_koszar
                        FROM koszary
                        WHERE koszary.poziom = ".($row['poziom']+1)."
                        )
                    WHERE wioski.id_uzytkownika = ".$_SESSION['id'];
                    //WHERE wioski.id_uzytkownika = ".$_SESSION['id']." AND ".($row['poziom']+1)."<= "."(SELECT MAX(poziom) FROM zamek)";
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
