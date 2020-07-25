<?php

  session_start();

  if($_SESSION['admin'] != 1){
    header('Location: index.php');
    exit();
  }

?>

<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Osadnicy</title>
	<meta name="description" content="Gra przeglądarkowa.">
	<meta name="keywords" content="osadnicy, gra">
	<meta name="author" content="Janusz Siek">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->

</head>

<body>

    <main>
        <h1 class="logo">Osadnicy</h1>
        <h3 class="text-center">Panel administratora</h3>
        <div class="menu row">
            <div class="col-md-2">Witaj <?php echo $_SESSION['user'] ?></div>
            <div class="col-md-8"></div>
            <div class="col-md-2"><a href="logout.php">Wyloguj się!</a></div>
        </div>
  		<div class="container" style="min-height: 92vh;">
            <div class="text-light row justify-content-center">
                <div class="col-0 col-md-2"></div>
                <div class="main-div col-12 col-md-8 bg-primary text-center">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input type="text" placeholder="Nick" name="nick">
                        <input type="submit" value="Wyszukaj">
                    </form>

                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        include 'connect.php';
                        mysqli_report(MYSQLI_REPORT_STRICT);
                        try{
                            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                            if($polaczenie->connect_errno!=0){
                              throw new Exception(mysqli_connect_errno());
                            }
                            else {
                              $sql = "SELECT id, user, email, administrator, zablokowany FROM uzytkownicy WHERE user LIKE '%".$_POST['nick']."%'";
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
                                      echo '<td><a href="odbanuj.php?id='.$row['id'].'">Odbanuj</a></td>';
                                  }
                                  else{
                                      echo "<td>Nie</td>";
                                      echo '<td><a href="zbanuj.php?id='.$row['id'].'">Zbanuj</a></td>';
                                  }
                                  echo "</tr>";
                              }
                              echo "</table>";
                          }
                        }
                        catch(Exception $e){
                          alert("Bład serwera!");
                        }
                    }
                    ?>

                </div>

            </div>

    </div>

  </main>

  <footer>
		<div class="stopka py-3 text-center footer-bottom">
			Janusz Siek
		</div>
    </footer>

</body>
</html>
