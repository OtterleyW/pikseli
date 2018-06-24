<?	
	require('../../.yhdista.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pikseliponi admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="tyyli.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">ADMIN</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="hukkis.php">Hukkapuro</a></li>
        <li><a href="wolf.php">Wolf Sporthorses</a></li>
        <li><a href="hukkiskasv.php">Lista Hukkiksen kasvateista</a></li>
        <li><a href="listaus.php">Lista kaikista hevosista</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="row content text-center">
    <div class="col-sm-3 sidenav">
    <h2>Toiminnot</h2>
      <form action="lisaa_hevonen.php" method="post">
      	<input class="btn btn-default btn-block" type="submit" value="Luo uusi hevonen" name="lisaa_hevonen" />
      </form>
      <form action="lisaa_sukulainen.php" method="post">
      	<input class="btn btn-default btn-block" type="submit" value="Luo uusi sukulainen" name="lisaa_hevonen" />
      </form>
      <br />
      <form action="lisaa_kilpailuja.php" method="post">
      	<input class="btn btn-default btn-block" type="submit" value="Lisää kilpailuja" name="lisaa_kilpailu" />
      </form>
      <form action="lisaa_teksti.php" method="post">
      <input class="btn btn-default btn-block" type="submit" value="Lisää teksti" name="lisaa_teksti" />
      </form>
      <form action="lisaa_kuva.php" method="post">
      <input class="btn btn-default btn-block" type="submit" value="Lisää kuva" name="lisaa_kuva" />
      </form>

    </div>

    <div class="col-sm-9 sisalto">