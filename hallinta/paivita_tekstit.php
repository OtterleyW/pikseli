<?
require('navit.php');


	$lisaa_teksti = $db->prepare('INSERT INTO hevonen_tekstit
	(hevonen_id, pvm, otsikko, kirjoittaja, tekstin_tyyppi, teksti)
	VALUES
	(:hevonen_id, :pvm, :otsikko, :kirjoittaja, :tekstin_tyyppi, :teksti)
	');


		$lisaa_teksti->bindParam(':hevonen_id', $_POST['id']);
		$lisaa_teksti->bindParam(':tekstin_tyyppi', $_POST['tekstin_tyyppi']);
		$lisaa_teksti->bindParam(':pvm', $_POST['pvm']);
		$lisaa_teksti->bindParam(':kirjoittaja', $_POST['kirjoittaja']);
		$lisaa_teksti->bindParam(':otsikko', $_POST['otsikko']);
		$lisaa_teksti->bindParam(':teksti', $_POST['teksti']);

		$lisaa_teksti->execute();

?>
	<h2>Lisää teksti</h2>
      <div class="alert alert-success">
        Tiedot päivitetty!
      </div>

      
    
    </div>
  </div>
</div>
</body>
</html>