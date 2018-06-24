<?	
require('navit.php');

$paivita_hevonen = $db->prepare(<<<SQL
UPDATE hevonen_tiedot 
SET 
	id = :id,
	url = :url,
	slug = :slug,
	nimi = :nimi,
	lempinimi = :lempinimi,
	vhtunnus = :vhtunnus,
	syntymaaika = :syntymaaika,
	ika = :ika,
	rotu = :rotu,
	rotu_lyhenne = :rotu_lyhenne,
	sukupuoli = :sukupuoli,
	saka = :saka,
	painotus = :painotus,
	koulutustaso = :koulutustaso,
	kasvattaja = :kasvattaja,
	kasvattaja_url = :kasvattaja_url,
	omistaja = :omistaja,
	omistaja_url = :omistaja_url,
	meriitit = :meriitit,
	luonne = :luonne,
	kaytto = :kaytto,
	kilpailu_tyyppi = :kilpailu_tyyppi,
	vari = :vari,
	sukuselvitys = :sukuselvitys,
	suvun_pituus = :suvun_pituus,
	status = :status,
	saavutukset = :saavutukset,
	muut_kilpailut = :muut_kilpailut,
	kaappi = :kaappi
WHERE id = :id
SQL
);

$paivita_hevonen->bindParam(':id', $_POST['id']);
$paivita_hevonen->bindParam(':url', $_POST['url']);
$paivita_hevonen->bindParam(':slug', $_POST['slug']);
$paivita_hevonen->bindParam(':nimi', $_POST['nimi']);
$paivita_hevonen->bindParam(':lempinimi', $_POST['lempinimi']);
$paivita_hevonen->bindParam(':vhtunnus', $_POST['vhtunnus']);
$paivita_hevonen->bindParam(':syntymaaika', $_POST['syntymaaika']);
$paivita_hevonen->bindParam(':ika', $_POST['ika']);
$paivita_hevonen->bindParam(':rotu', $_POST['rotu']);
$paivita_hevonen->bindParam(':rotu_lyhenne', $_POST['rotu_lyhenne']);
$paivita_hevonen->bindParam(':sukupuoli', $_POST['sukupuoli']);
$paivita_hevonen->bindParam(':saka', $_POST['saka']);
$paivita_hevonen->bindParam(':painotus', $_POST['painotus']);
$paivita_hevonen->bindParam(':koulutustaso', $_POST['koulutustaso']);
$paivita_hevonen->bindParam(':kasvattaja', $_POST['kasvattaja']);
$paivita_hevonen->bindParam(':kasvattaja_url', $_POST['kasvattaja_url']);
$paivita_hevonen->bindParam(':omistaja', $_POST['omistaja']);
$paivita_hevonen->bindParam(':omistaja_url', $_POST['omistaja_url']);
$paivita_hevonen->bindParam(':meriitit', $_POST['meriitit']);
$paivita_hevonen->bindParam(':luonne', $_POST['luonne']);
$paivita_hevonen->bindParam(':kaytto', $_POST['kaytto']);
$paivita_hevonen->bindParam(':kilpailu_tyyppi', $_POST['kilpailu_tyyppi']);
$paivita_hevonen->bindParam(':vari', $_POST['vari']);
$paivita_hevonen->bindParam(':sukuselvitys', $_POST['sukuselvitys']);
$paivita_hevonen->bindParam(':suvun_pituus', $_POST['suvun_pituus']);
$paivita_hevonen->bindParam(':status', $_POST['status']);
$paivita_hevonen->bindParam(':saavutukset', $_POST['saavutukset']);
$paivita_hevonen->bindParam(':muut_kilpailut', $_POST['muut_kilpailut']);
$paivita_hevonen->bindParam(':kaappi', $_POST['kaappi']);

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
	
		<h2>Muokkaa hevosta #<?=$_POST['id']?></h2>

      <div class="alert alert-success">
        Tiedot päivitetty!
      </div>

      
    
    </div>
  </div>
</div>
</body>
</html>