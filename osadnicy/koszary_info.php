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

      $sql = "SELECT id_koszar, id_zamku FROM wioski WHERE id_uzytkownika = ".$_SESSION['id'];
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          $id_koszar = $row['id_koszar'];
          $id_zamku = $row['id_zamku'];
        }
      }

      $sql = "SELECT MAX(poziom) FROM koszary";
      $result = mysqli_query($polaczenie, $sql);
      $row = mysqli_fetch_assoc($result);
      $max = $row["MAX(poziom)"];

      $sql = "SELECT poziom FROM zamek WHERE id_zamku = $id_zamku";
      $result = mysqli_query($polaczenie, $sql);
      $row = mysqli_fetch_assoc($result);
      $zamek = $row["poziom"];

      $sql = "SELECT wojska.wojownicy, wojska.lucznicy  FROM wojska WHERE id_wojska= ".$_SESSION['id_wojska'];
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          $wojownicy = $row['wojownicy'];
          $lucznicy = $row['lucznicy'];
        }
      }

      $sql = "SELECT * FROM koszary WHERE id_koszar = $id_koszar";
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
          $row = mysqli_fetch_assoc($result);
          echo '<div class="row">';
          echo '<div class="col-sm-11 col-11 budynek-nazwa">Koszary</div>';
          echo '<div class="col-sm-1 col-1"><a href = " " class="zamknij" onclick="close(koszary)"><i class="fa fa-window-close"></i></a></div>';
          echo "</div>";
          echo "<p> Poziom: ";
          echo $row['poziom'];
          echo "</p>";
          echo "<p>Koszt ulepszenia";

          if($row['poziom'] < $max){
              echo "<p> Drewno: ";
              echo $row['drewno'];
              echo "</p>";
              echo "<p> Kamień: ";
              echo $row['kamien'];
              echo "</p>";
              if($row['poziom'] < $zamek){
                  echo '<button class="btn-ulepsz" id="ulepsz_koszary">Ulepsz</button>';
              }
              else {
                  echo '<p>Aby ulepszyć ten mudynek twój zamek musisz rozbudować swój zamek.</p>';
              }
          }
          else{
              echo "<p>Osiągnięto maksymalny poziom budynku.</p>";
          }

          echo '<p>Wojownicy: '.$wojownicy.'/'.$row['wojownicy'].'</p>';
          echo '<p>Łucznicy: '.$lucznicy.'/'.$row['lucznicy'].'</p>';
        if($_SESSION['zboze'] >=700){
            if($wojownicy < $row['wojownicy']){
                echo '</br>';
                echo '<button class="btn-ulepsz" id="rekrutuj_wojownika">Rekrutuj wojownika</button>';
            }
            else {
                echo '<p>Osiągnięto limit wojowników</p>';
            }
            if($lucznicy < $row['lucznicy']){
                echo '</br>';
                echo '<button class="btn-ulepsz" id="rekrutuj_lucznika">Rekrutuj łucznika</button>';
            }
            else {
                echo '<p>Osiągnięto limit łuczników</p>';
            }
      }
      else {
          echo "</p>Koszt rekrutacji jednostki wynosi 700 sztuk zboża</p>";
      }
      }



    }
  }
  catch(Exception $e){
    alert("Bład serwera!");
  }
?>
