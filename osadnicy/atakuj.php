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
          $gracz1 = $_POST['wojownicy'] + 4 * $_POST['lucznicy'];

          $sql = "SELECT wojownicy, lucznicy FROM wojska
                  WHERE id_wojska = ".$_POST['przeciwnik'];
          $result = mysqli_query($polaczenie, $sql);
          $row = mysqli_fetch_assoc($result);
          $gracz2 = $row['wojownicy'] + 4 * $row['lucznicy'];

          try {
            // rozpoczęcie tranzakcji
            $polaczenie->begin_transaction();

            // zapytania
            if($gracz1 > $gracz2){
                $sql = "UPDATE uzytkownicy SET chwala = chwala + 1
                        WHERE id = ".$_SESSION['id'];
                $polaczenie->query($sql);
            }

            $sql = "UPDATE wojska SET wojownicy = wojownicy - ".$_POST['wojownicy'].
                    ", lucznicy = lucznicy - ".$_POST['lucznicy']."
                    WHERE id_wojska = ".$_SESSION['id_wojska'];
            $polaczenie->query($sql);

            // wykonanie tranzakcji
            $polaczenie->commit();
        } catch (Exception $e) {
            // wycofanie tranzakcji
            $polaczenie->rollback();
        }
    }
  }
  catch(Exception $e){
    alert("Bład serwera!");
  }
  finally{
      header('Location: gra.php');
  }
?>
