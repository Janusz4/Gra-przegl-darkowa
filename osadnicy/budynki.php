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

      $sql = "SELECT id_zamku FROM wioski WHERE id_uzytkownika = ".$_SESSION['id'];
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          $id_zamku = $row['id_zamku'];
        }
      }

      $sql = "SELECT * FROM zamek WHERE id_zamku = $id_zamku";
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
          $row = mysqli_fetch_assoc($result);
          echo "<p> Poziom zamku: ";
          echo $row['poziom'];
          echo "</p>";
      }

?>
