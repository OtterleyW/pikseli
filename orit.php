<? require('top.php');

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus ="kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" AND rotu_lyhenne<>"pre" AND suvun_pituus="0" ORDER BY painotus DESC, rotu, nimi');
$stmt->execute();
$orit0p = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus ="kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" AND rotu_lyhenne<>"pre" AND suvun_pituus="1" ORDER BY painotus DESC, rotu, nimi');
$stmt->execute();
$orit1p = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus ="kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" AND rotu_lyhenne<>"pre" AND suvun_pituus="2" ORDER BY painotus DESC, rotu, nimi');
$stmt->execute();
$orit2p = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus ="kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" AND rotu_lyhenne<>"pre" AND suvun_pituus="3" ORDER BY painotus DESC, rotu, nimi');
$stmt->execute();
$orit3p = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus="kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" AND rotu_lyhenne<>"pre" AND suvun_pituus="4" ORDER BY painotus DESC, rotu, nimi');
$stmt->execute();
$orit4p = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus ="kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" AND rotu_lyhenne<>"pre" AND suvun_pituus<>"0" AND suvun_pituus<>"1" AND suvun_pituus<>"2" AND suvun_pituus<>"3" AND suvun_pituus<>"4"  ORDER BY suvun_pituus, painotus DESC, rotu, nimi');
$stmt->execute();
$orit5p = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE sukupuoli="ori" AND omistaja = "Otterley Wilson VRL-12757" AND painotus <>"kouluratsastus" AND status <> "poistettu" AND status <> "kuollut" AND kaytto <> "pihatto" ORDER BY painotus DESC, suvun_pituus, rotu, nimi');
$stmt->execute();
$oritmuu = $stmt->fetchAll();

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
				<h2>EVM-sukuiset koulupainotteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($orit0p as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
								<?=$tama_heppa->painotus?><br />
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
				<h2>1-polviset koulupainotteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($orit1p as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
								<?=$tama_heppa->painotus?><br />
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
				<h2>2-polviset koulupainotteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($orit2p as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
								<?=$tama_heppa->painotus?><br />
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
				<h2>3-polviset koulupainotteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($orit3p as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
								<?=$tama_heppa->painotus?><br />
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
				<h2>4-polviset koulupainotteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($orit4p as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
								<?=$tama_heppa->painotus?><br />
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
				<h2>Pitkäsukuiset koulupainotteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($orit5p as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
								<?=$tama_heppa->painotus?><br />
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
				<h2>Muun painoitteiset orit</h2>
			</div>
		</div>

		<div class="row hevosrivi"  data-equalizer data-equalize-by-row="true">
			<?
			foreach ($oritmuu as $hevonen) {
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
								<?=$tama_heppa->rotu?><br />
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