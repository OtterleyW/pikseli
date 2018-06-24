<?php 
	require('navit.php');
	require('../luokat/Heppa.php');
		//Perustietojen hakeminen
		$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE id = :id');
		$stmt->bindParam(':id', $hevonen_id);
		$hevonen_id = $_GET['id'];
		$stmt->execute();
		$haettu_tiedot = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//Sukutietojen
		$stmt = $db->prepare('SELECT * FROM hevonen_suku WHERE id = :id');
		$stmt->bindParam(':id', $hevonen_id);
		$stmt->execute();
		$haettu_suku = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//Tämän Heppa-olion luonti
		$tama_heppa = new Heppa($haettu_tiedot, $haettu_suku);
		$tama_heppa->hae_sukupolvet($db, $tama_heppa->suvun_pituus);

		//listaus kannassa olevista hevosista isää ja emää varten

		$stmt = $db->prepare('SELECT id, nimi FROM hevonen_tiedot WHERE sukupuoli = "ori" OR sukupuoli = "ruuna" ORDER BY nimi');
		$stmt->execute();
		$orit = $stmt->fetchAll();

		$stmt = $db->prepare('SELECT id, nimi FROM hevonen_tiedot WHERE sukupuoli = "tamma" ORDER BY nimi');
		$stmt->execute();
		$tammat = $stmt->fetchAll();


		
	?>

	<h2>Muokkaa sukulaista #<?=$tama_heppa->id?></h2>
	
	<div class="text-left">
	<form action="paivita_sukulainen.php" method="post">
		<input type="hidden" name="id" value="<?=$tama_heppa->id?>">

	  	<div class="form-group">
		    <label for="url">URL:</label>
	  		<input type="text" class="form-control" name="url" value="<?=$tama_heppa->url?>" /> 
	  	</div>

	 	<div class="form-group">
		    <label for="status">Status:</label>
	 		<input type="text" class="form-control" name="status" value="<?=$tama_heppa->status?>" />
	 	</div>
	 
	  	<div class="form-group">
		    <label for="nimi">Nimi:</label>
	  		<input type="text" class="form-control" name="nimi" value="<?=$tama_heppa->nimi?>" /> 
	  	</div>
	  	
	  	<div class="form-group">
 		    <label for="rotu">Rotu:</label>
  			<input type="text" class="form-control" name="rotu" value="<?=$tama_heppa->rotu?>" /> 
  		</div>
  		<div class="form-group">
		    <label for="rotu_lyhenne">Rodun lyhenne:</label>
	  		<input type="text" class="form-control" name="rotu_lyhenne" value="<?=$tama_heppa->rotu_lyhenne?>" /> 
	  	</div> 	  	
	 
	  	<div class="form-group">
		    <label for="sukupuoli">Sukupuoli:</label>
		  	<select class="form-control" name="sukupuoli">
			  	<option><?=$tama_heppa->sukupuoli?></option>
			  	<option value="ori">ori</option>
			  	<option value="tamma">tamma</option>
			  	<option value="ruuna">ruuna</option>
		  	</select> 
		</div>  	

	   	<div class="form-group">
		    <label for="saka">Säkä:</label>
			<input type="text" class="form-control" name="saka" value="<?=$tama_heppa->saka?>" />
		</div> 
	  	<div class="form-group">
		    <label for="vari">Väri:</label>
	  		<input type="text" class="form-control" name="vari" value="<?=$tama_heppa->vari?>" /> 
	  	</div>

	  	<div class="form-group">
		    <label for="meriitit">Meriitit:</label>
	  		<input type="text" class="form-control" name="meriitit" value="<?=$tama_heppa->meriitit?>" /> 
	  	</div>
	 
	 
	  	<div class="form-group">
		    <label for="isa">Isä:</label>
			<select class="form-control" name="isa">
				 <option value="<?=$tama_heppa->isa->id?>"><?=$tama_heppa->isa->nimi?></option>
			 	  <?
			 	  	foreach($orit as $ori){
			 	  		echo '<option value="'.$ori['id'].'">'.$ori['nimi'].'</option>';
			 	  	}
			 	  ?>
			</select>  
		</div>
	  	<div class="form-group">
		    <label for="ema">Emä:</label>
			<select class="form-control" name="ema">
				 <option value="<?=$tama_heppa->ema->id?>"><?=$tama_heppa->ema->nimi?></option>
			 	  <?
			 	  	foreach($tammat as $tamma){
			 	  		echo '<option value="'.$tamma['id'].'">'.$tamma['nimi'].'</option>';
			 	  	}
			 	  ?>
			</select>  
		</div>

	  	<div class="form-group">
		    <label for="kasvattja">Kasvattaja:</label>
	  		<input type="text" class="form-control" name="kasvattaja" value="<?=$tama_heppa->kasvattaja?>" /> 
	  	</div>
	  	 <div class="form-group">
		    <label for="kasvattja_url">Kasvattajan url:</label>
	  		<input type="text" class="form-control" name="kasvattaja_url" value="<?=$tama_heppa->kasvattaja_url?>" />
	  	</div>

	  	<div class="form-group">
		    <label for="omistaja">Omistaja:</label> 
	  		<input type="text" class="form-control" name="omistaja" value="<?= $tama_heppa->omistaja?>" /> 
	  	</div>
	  	<div class="form-group">
		    <label for="omistaja_url">Omistajan url:</label> 
	  		<input type="text" class="form-control" name="omistaja_url" value="<?=$tama_heppa->omistaja_url?>" /> 
	  	</div>

	 	 
		<div class="form-group">
		    <label for="syntymaaika">Syntymäaika:</label>
	  		<input type="date" class="form-control" name="syntymaaika" value="<?=$tama_heppa->syntymaaika?>" />
	  	</div>
	  	
	 	<div class="form-group"> 
	 	     <button type="submit" class="btn btn-primary btn-block" name="muokkaa">Päivitä muutokset</button>
	 	 </div>
	
	</form>
	</div>

      	
    </div>
  </div>
</div>
</body>
</html>


