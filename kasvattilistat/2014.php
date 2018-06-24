<?
$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE kasvattaja = "Hukkapuro" AND YEAR(syntymaaika) = "2014" ORDER BY syntymaaika DESC');
$stmt->execute();
$kasvatit14 = $stmt->fetchAll();
?>

<h3>Vuoden 2014 kasvatit</h3>

<p>Kasvatteja syntynyt <?= count($kasvatit14)?>.</p>
</div>
</div>

<div class="row content">
	<?
	foreach ($kasvatit14 as $hevonen) {
		$tama_heppa = hae_tiedot($hevonen['id'], $db);
		$suku = $tama_heppa->suvun_pituus.'-polvinen';
		$skp = $tama_heppa->sukupuoli;
		if($skp=='ori'){$skp='o';}
		elseif($skp=='ruuna'){$skp='r';}
		elseif($skp=='tamma'){$skp='t';}
	?>
		<div class="small-12 columns">
			<div class="row sisarivi  kasvattilistaus">
				<div class="small-12 medium-1 large-1 columns"><?=$tama_heppa->rotu_lyhenne?>-<?=$skp?>.</div>
				<div class="small-12 medium-3 large-3 columns"><strong><a href="<?=$tama_heppa->hae_url()?>" target="_blank"><?=$tama_heppa->nimi?></a></strong></div>
				<div class="small-12 medium-2 large-2 columns"><?= muotoile_pelkka_paivamaara($tama_heppa->syntymaaika);?></div>
				<div class="small-12 medium-3 large-2 columns">
					<small>
						i. <a href="<?=$tama_heppa->isa->hae_url()?>" target="_blank"><?=$tama_heppa->isa->nimi?></a><br /> 
						e. <a href="<?=$tama_heppa->ema->hae_url()?>" target="_blank"><?=$tama_heppa->ema->nimi?></a>
					</small>
				</div>
				<?if($tama_heppa->omistaja=='Otterley Wilson VRL-12757'){?>
				<div class="small-12 medium-2 large-2 columns"><small>om. Hukkapuro</small></div>
				<?} else{?>
				<div class="small-12 medium-2 large-2 columns"><small>om. <a href="<?=$tama_heppa->omistaja_url?>"><?=$tama_heppa->omistaja?></a></small></div>
				<?}?>
				<div class="small-12 medium-1 large-2 columns"><?=$tama_heppa->meriitit?></div>

				
			</div>
		</div>
		<?
	}
	?>
</div>




