<? 	
	require('navit.php');

	$stmt=$db->prepare('SELECT id, nimi FROM hevonen_tiedot WHERE omistaja="Otterley Wilson VRL-12757" OR omistaja="Wolf Sporthorses, VRL-12757" OR omistaja="Otterley VRL-12757" ORDER BY nimi');
	$stmt->execute();
	$hevoset = $stmt->fetchAll();

	$stmt=$db->prepare('SELECT id, nimi FROM hevonen_kuvaaja');
	$stmt->execute();
	$kuvaajat = $stmt->fetchAll();

?>
<p>
	<h2>Lisää kuva</h2>
	Huom! Voit lisätä yhdelle hevoselle vain yhden kuvaajan kuvat kerrallaan
</p>

<div class="text-left">
<form action="paivita_kuva.php" method="post">
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
	  	<input type="text" class="form-control" name="vari" placeholder="hevosen väri" />
	 </div>

	  <div class="form-group">
		  	<select class="form-control" name="kuvaaja_id">
		  	  <option value="kuvaaja">valitse kuvaaja</option>
		  	  <?
		  	  	foreach($kuvaajat as $kuvaaja){
		  	  		echo '<option value="'.$kuvaaja['id'].'">'.$kuvaaja['nimi'].'</option>';
		  	  	}
		  	  ?>
		  </select>
	  </div>
		Jos kuvaajaa ei löydy niin:<br />
	   <div class="form-group">
	   		<input type="text" class="form-control" name="nimi" value="kuvaajan nimi" />
	   </div>
	   <div class="form-group">
	   		<input type="text" class="form-control" name="url" value="kuvaajan url" />
		</div>
		<strong>Kuvien osoitteet</strong><br />
		Iso kuva:
		 <div class="form-group">
		 	<input type="text" class="form-control" name="isokuva" value="osoite" />
		</div>
		Muut kuvat:
		 <div class="form-group">
		 	<input type="text" class="form-control" name="osoite1" value="osoite" />
		</div>
		 <div class="form-group">
		 	<input type="text" class="form-control" name="osoite2" value="osoite" />
		</div>
		 <div class="form-group">
		 	<input type="text" class="form-control" name="osoite3" value="osoite" />
		</div>
		 <div class="form-group">
		 	<input type="text" class="form-control" name="osoite4" value="osoite" />
		</div>
	
		
		<div class="form-group"> 
		     <button type="submit" class="btn btn-primary btn-block" name="muokkaa">Lisää kuvat</button>
		 </div>
</form>
</div>
    </div>
  </div>
</div>
</body>
</html>



