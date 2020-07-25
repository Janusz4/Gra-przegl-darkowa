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
      echo '<form action="atakuj.php" method="post">';
      echo '<div class="row">';
      echo '<div class="col-sm-11 col-11 budynek-nazwa">Atakuj</div>';
      echo '<div class="col-sm-1 col-1"><a href = " " class="zamknij" onclick="close(atakuj)"><i class="fa fa-window-close"></i></a></div>';
      echo "</div>";

      $sql = "SELECT * FROM `uzytkownicy` WHERE id != ".$_SESSION['id']." ORDER BY abs(chwala - ".$_SESSION['chwala'].") LIMIT 5";
      $result = mysqli_query($polaczenie, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
          echo '<label for="przeciwnik">'.$row['user'].'</label>';
          echo '<input type="radio" name="przeciwnik" value="'.$row['id_wojska'].'">';
      }

      $sql = "SELECT wojska.wojownicy, wojska.lucznicy  FROM wojska WHERE id_wojska= ".$_SESSION['id_wojska'];
      $result = mysqli_query($polaczenie, $sql);
      if (mysqli_num_rows($result) == 1){
        while ($row = mysqli_fetch_assoc($result)) {
          $wojownicy = $row['wojownicy'];
          $lucznicy = $row['lucznicy'];
        }
      }

      echo "<table>";
      echo '<tr><td>Wojownicy</td><td><input type="number" class="number" name="wojownicy" value="0" min="0" max="'.$wojownicy.'"/>/'.$wojownicy.'</td></tr>';
      echo '<tr><td>Łucznicy</td><td><input type="number" class="number" name="lucznicy" value="0" min="0 max="'.$lucznicy.'"/>/'.$lucznicy.'</td></tr>';
      echo "</table>";
      echo '<input class="btn-ulepsz" type="submit" value="Atakuj"/>';

      echo '</form>';

    }
  }
  catch(Exception $e){
    alert("Bład serwera!");
  }
?>
