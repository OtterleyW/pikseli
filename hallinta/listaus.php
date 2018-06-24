<?	
	require('navit.php');


		$stmt = $db->prepare('SELECT id, nimi, status, sukupuoli, rotu_lyhenne FROM hevonen_tiedot WHERE omistaja <> "Otterley Wilson VRL-12757" OR omistaja <> "Wolf Sporthorses, VRL-12757" AND kasvattaja <> "Hukkapuro" OR kasvattaja<>"Wolf Sporthorses" ORDER BY nimi');
		$stmt->execute();
		$kaikki = $stmt->fetchAll();

	
?>



      
      <h1>Muut hevoset</h1>

      <p>Hevosia yhteensä <?= count($kaikki) ?>. Listassa ei ole omia hevosia tai omia kasvatteja.</p>
      
      <?
      	foreach ($kaikki as $hevonen) {
      		echo '<div class="row hevoslistaus"><div class="col-sm-5 tiedot"><big><strong>'.$hevonen['nimi'].'</strong></big><br /><small>'.$hevonen['rotu_lyhenne'].'-'.$hevonen['sukupuoli'].' '.$hevonen['status'].'</small></div><div class="col-sm-7 buttonit"><a href="muokkaa_sukulaista.php?id='.$hevonen['id'].'"><button type="button" class="btn btn-default">Muokkaa sukulaista</button></a><a href="muokkaa_hevosta.php?id='.$hevonen['id'].'"><button type="button" class="btn btn-default">Muokkaa hevosta</button></a><a href="poista_hevonen.php?id='.$hevonen['id'].'"><button type="button" class="btn btn-default">Poista</button></a></div></div>';
      	}
      ?>
      
      	
    </div>
  </div>
</div>
</body>
</html>









