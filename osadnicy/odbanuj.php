<?php
session_start();

if($_SESSION['admin'] != 1){
  header('Location: index.php');
  exit();
}

include 'connect.php';

try{
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if($polaczenie->connect_errno!=0){
          throw new Exception(mysqli_connect_errno());
        }
        else {
            $sql = "UPDATE uzytkownicy SET zablokowany = 0 WHERE id = ".$_GET['id'];
            $polaczenie->query($sql);
        }
    }
catch(Exception $e){
  alert("Bład serwera!");
}
finally{
    header('Location: admin.php');
}
?>
