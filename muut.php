<? require('top.php');

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE rotu_lyhenne="x" AND omistaja = "Otterley Wilson VRL-12757" AND status <> "poistettu" AND status <> "kuollut" OR rotu_lyhenne="xx" AND omistaja = "Otterley Wilson VRL-12757" AND status <> "poistettu" AND status <> "kuollut" OR rotu_lyhenne="ox" AND omistaja = "Otterley Wilson VRL-12757" AND status <> "poistettu" AND status <> "kuollut" ORDER BY rotu, suvun_pituus, sukupuoli');
$stmt->execute();
$taykit = $stmt->fetchAll();


$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE omistaja = "Otterley Wilson VRL-12757" AND status <> "poistettu" AND status <> "kuollut" AND  rotu_lyhenne="pre" AND omistaja = "Otterley Wilson VRL-12757" ORDER BY suvun_pituus, sukupuoli');
$stmt->execute();
$pre = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE omistaja = "Otterley Wilson VRL-12757" AND status <> "poistettu" AND status <> "kuollut" AND  rotu_lyhenne="sh" ORDER BY suvun_pituus, sukupuoli');
$stmt->execute();
$sh = $stmt->fetchAll();


$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE omistaja = "Otterley Wilson VRL-12757" AND status <> "poistettu"AND status <> "kuollut" AND kaytto ="pihatto" AND rotu_lyhenne <> "pre"  AND rotu_lyhenne <> "xx" AND rotu_lyhenne <> "x"  AND rotu_lyhenne <> "ox"  AND rotu_lyhenne <> "sh" ORDER BY rotu, suvun_pituus, sukupuoli');
$stmt->execute();
$muut = $stmt->fetchAll();

function hae_kuva($id, $db){
					//Kuvan hakeminen
	$stmt = $db->prepare('SELECT * FROM hevonen_kuva WHERE hevonen_id = :id AND iso_kuva="true"');
	$stmt->bindParam(':id', $hevonen_id);
	$hevonen_id = $id;
	$stmt->execute();
	$kuva = $stmt->fetch(PDO::FETCH_ASSOC);
	return $kuva;
}
?>

<div class="row sisalto">
	<div class="small-12 columns hevoslistaus">
		<div class="row">
			<div class="small-12 columns">
				<h2>Täysveriset</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($taykit as $hevonen) {
				$tama_heppa = hae_tiedot($hevonen['id'], $db);
				$kuva = hae_kuva($hevonen['id'], $db);
				$suku = $tama_heppa->suvun_pituus.'-polvinen';
				?>
				<div class="small-12 medium-6 large-4 columns" data-equalizer-watch>
					<div class="heppa">
						<a class="row heppalinkki" href="<?=$tama_heppa->hae_url()?>">
							<div class="small-4 listauskuva"><img src="img/h/thumb/t<?=strtolower($kuva['osoite'])?>" title="<?=$tama_heppa->lempinimi?>" />
								<p><?=$tama_heppa->lempinimi?></p>
							</div>
							<div class="small-8 columns">
								<span class="listanimi"><?=$tama_heppa->nimi?></span><br />
								<?=$tama_heppa->rotu_lyhenne?>, <?=$tama_heppa->sukupuoli?><br />
								<?=$tama_heppa->painotus?><br />
								<?
								if($tama_heppa->suvun_pituus == 0){
									echo('evm-suku');
								}elseif($tama_heppa->suvun_pituus >= 5){
									echo('pitkä suku');
								} else{
									echo $tama_heppa->suvun_pituus."-polvinen";
								}
								?><br />
								<b><?=$tama_heppa->meriitit?>&nbsp;</b>
							</div>
						</a>
					</div>
				</div>

				<?
			}
			?>
		</div>

		<div class="row">
			<div class="small-12 columns">
				<h2>Andalusialaiset</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($pre as $hevonen) {
				$tama_heppa = hae_tiedot($hevonen['id'], $db);
				$kuva = hae_kuva($hevonen['id'], $db);
				$suku = $tama_heppa->suvun_pituus.'-polvinen';
				?>
								<div class="small-12 medium-6 large-4 columns" data-equalizer-watch>
					<div class="heppa">
						<a class="row heppalinkki" href="<?=$tama_heppa->hae_url()?>">
							<div class="small-4 listauskuva"><img src="img/h/thumb/t<?=strtolower($kuva['osoite'])?>" title="<?=$tama_heppa->lempinimi?>" />
								<p><?=$tama_heppa->lempinimi?></p>
							</div>
							<div class="small-8 columns">
								<span class="listanimi"><?=$tama_heppa->nimi?></span><br />
								<?=$tama_heppa->rotu_lyhenne?>, <?=$tama_heppa->sukupuoli?><br />
								<?=$tama_heppa->painotus?><br />
								<?
								if($tama_heppa->suvun_pituus == 0){
									echo('evm-suku');
								}elseif($tama_heppa->suvun_pituus >= 5){
									echo('pitkä suku');
								} else{
									echo $tama_heppa->suvun_pituus."-polvinen";
								}
								?><br />
								<b><?=$tama_heppa->meriitit?>&nbsp;</b>
							</div>
						</a>
					</div>
				</div>
				<?
			}
			?>
		</div>


		<div class="row">
			<div class="small-12 columns">
				<h2>Suomenhevoset</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($sh as $hevonen) {
				$tama_heppa = hae_tiedot($hevonen['id'], $db);
				$kuva = hae_kuva($hevonen['id'], $db);
				$suku = $tama_heppa->suvun_pituus.'-polvinen';
				?>
								<div class="small-12 medium-6 large-4 columns" data-equalizer-watch>
					<div class="heppa">
						<a class="row heppalinkki" href="<?=$tama_heppa->hae_url()?>">
							<div class="small-4 listauskuva"><img src="img/h/thumb/t<?=strtolower($kuva['osoite'])?>" title="<?=$tama_heppa->lempinimi?>" />
								<p><?=$tama_heppa->lempinimi?></p>
							</div>
							<div class="small-8 columns">
								<span class="listanimi"><?=$tama_heppa->nimi?></span><br />
								<?=$tama_heppa->rotu_lyhenne?>, <?=$tama_heppa->sukupuoli?><br />
								<?=$tama_heppa->painotus?><br />
								<?
								if($tama_heppa->suvun_pituus == 0){
									echo('evm-suku');
								}elseif($tama_heppa->suvun_pituus >= 5){
									echo('pitkä suku');
								} else{
									echo $tama_heppa->suvun_pituus."-polvinen";
								}
								?><br />
								<b><?=$tama_heppa->meriitit?>&nbsp;</b>
							</div>
						</a>
					</div>
				</div>
				<?
			}
			?>
		</div>

		<div class="row">
			<div class="small-12 columns">
				<h2>Muut hevoset ja ponit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($muut as $hevonen) {
				$tama_heppa = hae_tiedot($hevonen['id'], $db);
				$kuva = hae_kuva($hevonen['id'], $db);
				$suku = $tama_heppa->suvun_pituus.'-polvinen';
				?>
								<div class="small-12 medium-6 large-4 columns" data-equalizer-watch>
					<div class="heppa">
						<a class="row heppalinkki" href="<?=$tama_heppa->hae_url()?>">
							<div class="small-4 listauskuva"><img src="img/h/thumb/t<?=strtolower($kuva['osoite'])?>" title="<?=$tama_heppa->lempinimi?>" />
								<p><?=$tama_heppa->lempinimi?></p>
							</div>
							<div class="small-8 columns">
								<span class="listanimi"><?=$tama_heppa->nimi?></span><br />
								<?=$tama_heppa->rotu_lyhenne?>, <?=$tama_heppa->sukupuoli?><br />
								<?=$tama_heppa->painotus?><br />
								<?
								if($tama_heppa->suvun_pituus == 0){
									echo('evm-suku');
								}elseif($tama_heppa->suvun_pituus >= 5){
									echo('pitkä suku');
								} else{
									echo $tama_heppa->suvun_pituus."-polvinen";
								}
								?><br />
								<b><?=$tama_heppa->meriitit?>&nbsp;</b>
							</div>
						</a>
					</div>
				</div>
				<?
			}
			?>
		</div>
	</div>
</div>
<? require('bottom.php');?>