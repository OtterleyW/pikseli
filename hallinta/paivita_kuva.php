<?
require('navit.php');


	$hevonen_id = $_POST['id'];
	$kuvaaja_id = $_POST['kuvaaja_id'];

	if(isset($_POST['vari'])){

		$id = $_POST['id'];
		$vari = $_POST['vari'];

		$stmt = $db->prepare('UPDATE hevonen_tiedot SET vari=:vari WHERE id=:id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':vari', $vari);
		$stmt->execute();
	}


	if($kuvaaja_id == 'kuvaaja'){
		$stmt = $db->prepare('SELECT id FROM hevonen_kuvaaja ORDER BY id DESC LIMIT 1');
		$stmt->execute();
		$viimeisin = $stmt->fetch(PDO::FETCH_ASSOC);
		$seuraava = $viimeisin['id']+1;
		$kuvaaja_id = $seuraava;

		$stmt = $db->prepare('INSERT INTO hevonen_kuvaaja (id, nimi, url) VALUES (:seuraava, :nimi, :url)');
		$stmt->bindParam(':seuraava', $seuraava);
		$stmt->bindParam(':nimi', $_POST['nimi']);
		$stmt->bindParam(':url', $_POST['url']);
		$stmt->execute();
	}	

	$iso = $_POST['isokuva'];
	$o1 = $_POST['osoite1'];
	$o2 = $_POST['osoite2'];
	$o3 = $_POST['osoite3'];
	$o4 = $_POST['osoite4'];


	$kuvat = array($o1, $o2, $o3, $o4);

	//Lataa ensimmäinen kuva
	$stmt = $db->prepare('INSERT INTO hevonen_kuva (hevonen_id, kuvaaja_id, osoite, iso_kuva) VALUES (:hevonen_id, :kuvaaja_id, :osoite, :iso_kuva)');
	$stmt->bindParam(':hevonen_id', $hevonen_id);
	$stmt->bindParam(':kuvaaja_id', $kuvaaja_id);
	$stmt->bindParam(':osoite', $iso);
	$iso_kuva = "true";
	$stmt->bindParam(':iso_kuva', $iso_kuva);
	$stmt->execute();

	//Lataa muut kuvat
	foreach ($kuvat as $kuva) {
			if($kuva != 'osoite'){
			$stmt = $db->prepare('INSERT INTO hevonen_kuva (hevonen_id, kuvaaja_id, osoite, iso_kuva) VALUES (:hevonen_id, :kuvaaja_id, :osoite, :iso_kuva)');
			$stmt->bindParam(':hevonen_id', $hevonen_id);
			$stmt->bindParam(':kuvaaja_id', $kuvaaja_id);
			$stmt->bindParam(':osoite', $kuva);
			$iso_kuva = "false";
			$stmt->bindParam(':iso_kuva', $iso_kuva);
			$stmt->execute();
		}
	}

?>

      <div class="alert alert-success">
        Tiedot päivitetty!
      </div>

      
    
    </div>
  </div>
</div>
</body>
</html>