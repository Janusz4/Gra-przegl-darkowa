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

      $sql = "SELECT id_tartaku, id_zamku FROM wioski WHERE id_uzytkownika = ".$_SESSION['id'];
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          $id_tartaku = $row['id_tartaku'];
          $id_zamku = $row['id_zamku'];
        }
      }

      $sql = "SELECT MAX(poziom) FROM tartak";
      $result = mysqli_query($polaczenie, $sql);
      $row = mysqli_fetch_assoc($result);
      $max = $row["MAX(poziom)"];

      $sql = "SELECT poziom FROM zamek WHERE id_zamku = $id_zamku";
      $result = mysqli_query($polaczenie, $sql);
      $row = mysqli_fetch_assoc($result);
      $zamek = $row["poziom"];

      $sql = "SELECT * FROM tartak WHERE id_tartaku = $id_tartaku";
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
          $row = mysqli_fetch_assoc($result);
          echo '<div class="row">';
          echo '<div class="col-sm-11 col-11 budynek-nazwa">Tartak</div>';
          echo '<div class="col-sm-1 col-1"><a href = " " class="zamknij" onclick="close(tartak)"><i class="fa fa-window-close"></i></a></div>';
          echo "</div>";
          echo "<p> Poziom: ";
          echo $row['poziom'];
          echo "</p>";
          echo "<p> Produkcja: ";
          echo $row['produkcja']." szt./min";
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
                  echo '<button class="btn-ulepsz" id="ulepsz_tartak">Ulepsz</button>';
              }
              else {
                  echo '<p>Aby ulepszyć ten mudynek twój zamek musisz rozbudować swój zamek.</p>';
              }
          }
          else{
              echo "<p>Osiągnięto maksymalny poziom budynku.</p>";
          }
      }

    }
  }
  catch(Exception $e){
    alert("Bład serwera!");
  }
?>
