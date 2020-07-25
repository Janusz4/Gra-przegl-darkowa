<?php
session_start();

if($_SESSION['admin'] != 1){
  header('Location: index.php');
  exit();
}

include 'connect.php';
mysqli_report(MYSQLI_REPORT_STRICT);
try{
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    if($polaczenie->connect_errno!=0){
      throw new Exception(mysqli_connect_errno());
    }
    else {
      $sql = "SELECT id, user, email, administrator, zablokowany FROM uzytkownicy";
      $result = mysqli_query($polaczenie, $sql);
      echo "<table>";
      echo "<tr><td>Nick</td><td>E-mail</td><td>Administrator</td><td>Zablokowany</td></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row['user']."</td>";
          echo "<td>".$row['email']."</td>";
          if($row['administrator'] == 1){
              echo "<td>Tak</td>";
          }
          else{
              echo "<td>Nie</td>";
          }
          if($row['zablokowany'] == 1){
              echo "<td>Tak</td>";
              echo '<td><button class="ban">Odbanuj</button></td>';
          }
          else{
              echo "<td>Nie</td>";
              echo '<td><button class="ban">Zbanuj</button></td>';
          }
          echo "</tr>";
      }
      echo "</table>";
  }
}
catch(Exception $e){
  alert("Bład serwera!");
}
?>
