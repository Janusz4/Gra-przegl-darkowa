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
        $sql = "SELECT chwala, user FROM uzytkownicy ORDER BY chwala DESC limit 100";
        $result = mysqli_query($polaczenie, $sql);
        echo '<div class="row">';
        echo '<div class="col-sm-11 col-11 budynek-nazwa">Ranking</div>';
        echo '<div class="col-sm-1 col-1"><a href = " " class="zamknij" onclick="close(ranking)"><i class="fa fa-window-close"></i></a></div>';
        echo "</div>";
        echo "<table>";
        echo "<tr><td>Miejsce</td><td>Nick</td><td>Chwała</td></tr>";
        $miejsce = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$miejsce."</td>";
            echo "<td>".$row['user']."</td>";
            echo "<td>".$row['chwala']."</td>";
            echo "</tr>";
            $miejsce++;
        }
        echo "</table>";
    }
  }
  catch(Exception $e){
    alert("Bład serwera!");
  }
?>
