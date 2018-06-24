<?	
	require('navit.php');

		
		$stmt = $db->prepare('SELECT id, nimi, status, sukupuoli, rotu_lyhenne FROM hevonen_tiedot WHERE omistaja="Otterley Wilson VRL-12757" AND status <> "poistettu" AND status <> "kuollut" ORDER BY nimi');
		$stmt->execute();
		$hukkapuron = $stmt->fetchAll();

		

	
?>
      
      <h1>Hukkapuron hevoset</h1>

      <p>Hevosia yhteensä <?= count($hukkapuron) ?></p>
      
      <?
      	foreach ($hukkapuron as $hevonen) {
      		echo '<div class="row hevoslistaus"><div class="col-sm-6 tiedot"><big><strong>'.$hevonen['nimi'].'</strong></big><br /><small>'.$hevonen['rotu_lyhenne'].'-'.$hevonen['sukupuoli'].' '.$hevonen['status'].'</small></div><div class="col-sm-6 buttonit"><a href="muokkaa_hevosta.php?id='.$hevonen['id'].'"><button type="button" class="btn btn-default">Muokkaa hevosta</button></a><a href="poista_hevonen.php?id='.$hevonen['id'].'"><button type="button" class="btn btn-default">Poista</button></a></div></div>';
      	}
      ?>
      
      	
    </div>
  </div>
</div>
</body>
</html>

















