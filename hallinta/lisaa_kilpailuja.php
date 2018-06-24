<? 	
	require('navit.php');

	$stmt=$db->prepare('SELECT id, nimi FROM hevonen_tiedot WHERE omistaja="Otterley Wilson VRL-12757"  AND kilpailu_tyyppi="normaali" AND status <> "kuollut" OR omistaja="Wolf Sporthorses, VRL-12757" AND kilpailu_tyyppi="normaali" AND status <> "kuollut" ORDER BY nimi');
	$stmt->execute();
	$hevoset = $stmt->fetchAll();


?>
<h2>Lisää kilpailuja</h2>

<form action="paivita_kilpailut.php" method="post">
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
		 <select class="form-control" name="laji">
		  	  <option>valitse laji</option>
		  	  <option value="KRJ">KRJ</option>
		  	  <option value="ERJ">ERJ</option>
		  	  <option value="KERJ">KERJ</option>
		  	  <option value="VVJ">VVJ</option>
		  	  <option value="WRJ">WRJ</option>
		  	  <option value="ARJ">ARJ</option>
		  </select>
	  </div>

	<div class="form-group">
	<textarea class="form-control" name="kilpailut" rows="12" placeholder="kilpailut"></textarea>
	</div>

	<div class="form-group"> 
	     <button type="submit" class="btn btn-primary btn-block" name="muokkaa">Lisää kilpailut</button>
	 </div>
</form>
      
      	
    </div>
  </div>
</div>
</body>
</html>

