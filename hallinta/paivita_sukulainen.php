<?	
require('navit.php');
$paivita_hevonen = $db->prepare(<<<SQL
UPDATE hevonen_tiedot 
SET 
	id = :id,
	url = :url,
	nimi = :nimi,
	rotu = :rotu,
	rotu_lyhenne = :rotu_lyhenne,
	sukupuoli = :sukupuoli,
	saka = :saka,
	meriitit = :meriitit,
	vari = :vari,
	status = :status,
	omistaja = :omistaja,
	omistaja_url = :omistaja_url,
	kasvattaja = :kasvattaja,
	kasvattaja_url = :kasvattaja_url,
	syntymaaika = :syntymaaika
	WHERE id = :id
SQL
);

$paivita_hevonen->bindParam(':id', $_POST['id']);
$paivita_hevonen->bindParam(':url', $_POST['url']);
$paivita_hevonen->bindParam(':nimi', $_POST['nimi']);
$paivita_hevonen->bindParam(':rotu', $_POST['rotu']);
$paivita_hevonen->bindParam(':rotu_lyhenne', $_POST['rotu_lyhenne']);
$paivita_hevonen->bindParam(':sukupuoli', $_POST['sukupuoli']);
$paivita_hevonen->bindParam(':saka', $_POST['saka']);
$paivita_hevonen->bindParam(':meriitit', $_POST['meriitit']);
$paivita_hevonen->bindParam(':vari', $_POST['vari']);
$paivita_hevonen->bindParam(':status', $_POST['status']);
$paivita_hevonen->bindParam(':omistaja', $_POST['omistaja']);
$paivita_hevonen->bindParam(':omistaja_url', $_POST['omistaja_url']);
$paivita_hevonen->bindParam(':kasvattaja', $_POST['kasvattaja']);
$paivita_hevonen->bindParam(':kasvattaja_url', $_POST['kasvattaja_url']);
$paivita_hevonen->bindParam(':syntymaaika', $_POST['syntymaaika']);




$paivita_hevonen->execute();

$paivita_suku = $db->prepare(<<<SQL
UPDATE hevonen_suku
SET 
	id = :id,
	isa_id = :isa_id,
	ema_id = :ema_id
WHERE id = :id
SQL
);

$paivita_suku->bindParam(':id', $_POST['id']);
$paivita_suku->bindParam(':isa_id', $_POST['isa']);
$paivita_suku->bindParam(':ema_id', $_POST['ema']);

$paivita_suku->execute();

?>
	
		<h2>Muokkaa sukulaista #<?=$_POST['id']?></h2>

      <div class="alert alert-success">
        Tiedot päivitetty!
      </div>

      
    
    </div>
  </div>
</div>
</body>
</html>