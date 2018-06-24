<? 	
	require('navit.php');

	$stmt=$db->prepare('SELECT id, nimi FROM hevonen_tiedot WHERE omistaja="Otterley Wilson VRL-12757" AND status <> "kuollut"  OR omistaja="Otterley VRL-12757" AND status <> "kuollut" ORDER BY nimi');
	$stmt->execute();
	$hevoset = $stmt->fetchAll();


?>
<h2>Lisää teksti</h2>
<form action="paivita_tekstit.php" method="post">
	<div class="form-group">
		<select class="form-control" name="id">
		 	  <option>valitse hevonen</option>
		 	  <?
		 	  	foreach($hevoset as $hevonen){
		 	  		echo '<option value="'.$hevonen['id'].'">'.$hevonen['nimi'].'</option>';
		 	  	}
		 	  ?>
		 </select>
	 </div>
	 <div class="form-group">
		 <select class="form-control" name="tekstin_tyyppi">
		  	  <option>valitse tyyppi</option>
		  	  <option value="pk-merkintä">pk-merkintä</option>
		  	  <option value="valmennus">valmennus</option>
		  	  <option value="valmennus">tarinakilpailut</option>
		  	  <option value="muu teksti">muu teksti</option>
		  </select>
	  </div>

	<div class="form-group">
		<input type="date" class="form-control" name="pvm" value="pvm" />
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="kirjoittaja" value="kirjoittaja" />
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="otsikko" value="otsikko" />
	</div>

	<div class="form-group">
	<textarea class="form-control" name="teksti" rows="12" placeholder="teksti"></textarea>
	</div>

	<div class="form-group"> 
	     <button type="submit" class="btn btn-primary btn-block" name="muokkaa">Lisää teksti</button>
	 </div>
</form>

</div>
  </div>
</div>
</body>
</html>