<? require('top.php'); 

	//Perustietojen hakeminen
$stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE slug = :slug');
$stmt->bindParam(':slug', $hevonen_slug);
$hevonen_slug = $_GET['slug'];
$stmt->execute();
$haettu_tiedot = $stmt->fetch(PDO::FETCH_ASSOC);
$hevonen_id = $haettu_tiedot['id'];

	//Sukutietojen
$stmt = $db->prepare('SELECT * FROM hevonen_suku WHERE id = :id');
$stmt->bindParam(':id', $hevonen_id);
$stmt->execute();
$haettu_suku = $stmt->fetch(PDO::FETCH_ASSOC);

	//Tämän Heppa-olin luonti
$tama_heppa = new Heppa($haettu_tiedot, $haettu_suku);
$tama_heppa->hae_sukupolvet($db, $tama_heppa->suvun_pituus);

	//Vanhemien hakeminen
$isa = $tama_heppa->isa;
$ema = $tama_heppa->ema;

	//Ison kuvan hakeminen
$stmt = $db->prepare('SELECT * FROM hevonen_kuva WHERE hevonen_id = :id AND iso_kuva="true"');
$stmt->bindParam(':id', $hevonen_id);
$stmt->execute();
$isokuva = $stmt->fetch(PDO::FETCH_ASSOC);

	//Muiden kuvien hakeminen
$stmt = $db->prepare('SELECT * FROM hevonen_kuva WHERE hevonen_id = :id AND iso_kuva="false"');
$stmt->bindParam(':id', $hevonen_id);
$stmt->execute();
$kuvat = $stmt->fetchAll();

	//Kuvaajien hakeminen
$stmt = $db->prepare('SELECT DISTINCT kuvaaja_id, hevonen_kuvaaja.url, hevonen_kuvaaja.nimi FROM hevonen_kuva INNER JOIN hevonen_kuvaaja ON hevonen_kuva.kuvaaja_id=hevonen_kuvaaja.id WHERE hevonen_id = :id');
$stmt->bindParam(':id', $hevonen_id);
$stmt->execute();
$kuvaajat = $stmt->fetchAll();
?>

<div class="row sisalto">
	<div class="small-12 columns">
		
		<?
		if ($tama_heppa->nimi==""){
			?>

			<h2>Hevosta ei löytynyt!</h2>
			<p>
				Tarkista, onko kirjoittamasi osoite oikein.<br /> Voit myös yrittää etsiä hevosta seuraavilta sivuilta:
			</p>
			<ul>
				<li><a href="orit.php">Puoliveriset orit</a></li>
				<li><a href="tammat.php">Puoliveriset tammat</a></li>
				<li><a href="muut.php">Muut hevoset</a></li>
				<li><a href="muistoissa.php">Muistoissa</a></li>
				<li><a href="kasvattilistatp.php">Hukkapuron kasvattilistat</a></li>
				<li><a herf"=http://www.virtuaalihevoset.net/?vrl/jaesenyys/profiili.html?hlo=12757&nayta=hevoset" target="_blank">Otterleyn hevoset VRL:n rekisterissä</a> (aukeaa uuteen ikkunaan)</li>
			</ul>


			<p>&nbsp;</p>
		</div>
	</div>
	<?
	require('bottom.php');
	die();
}
?>
<div class="row sisalto">
	<div class="small-12 columns">
		<div class="row perustiedot perustiedot align-middle" >
			<!-- Vasen laatikko -->
			<div class="small-12 medium-6 large-6 columns tiedot">

				
				<h2><?=$tama_heppa->nimi?></h2>
				<h3>"<?=$tama_heppa->lempinimi?>"</h3>
				<p>
					<a href="http://www.virtuaalihevoset.net/?hevoset/hevosrekisteri/hevonen.html?vh=<?=$tama_heppa->vhtunnus?>" target"_blank"><?=$tama_heppa->vhtunnus?></a>
				</p>

				<hr />

				<p class="perustietokappale">
					<?=$tama_heppa->rotu?>, <?=$tama_heppa->sukupuoli?><br />
					<?=$tama_heppa->vari?>, <?=$tama_heppa->saka?> cm<br />
					s. <? echo muotoile_pelkka_paivamaara($tama_heppa->syntymaaika); if($tama_heppa->ika!=0 && $tama_heppa->status != "kuollut"){echo ", ".$tama_heppa->ika."v.";}?><br /><br/>


					<? if($tama_heppa->suvun_pituus=="0"){echo'Maahantuoja';} else{echo'Kasvattaja';}?> 
					<? if($tama_heppa->kasvattaja_url != ""){
						echo '<a href="'.$tama_heppa->kasvattaja_url.'" target="_blank">'.$tama_heppa->kasvattaja.'</a>';}
						else {
							echo $tama_heppa->kasvattaja;
						}?><br />
						Omistaja <a href="<?=$tama_heppa->omistaja_url?>" target="_blank"><?=$tama_heppa->omistaja?></a>
					</p>

					<? if($tama_heppa->meriitit){?>
					<p class="meriitit">
						<i class="fi-trophy"></i> <?=$tama_heppa->meriitit?>
					</p>
					<? } ?>

					
				</div>

				<!-- Oikea laatikko -->
				
				<div class="small-12 medium-6 large-6 paakuva">					
					
					<a href="http://www.salaovi.net/hukkapuro/img/h/<?=$isokuva['osoite']?>"  data-lightbox="kuvagalleria" title="&nbsp;"><img src="http://www.salaovi.net/hukkapuro/img/h/<?=$isokuva['osoite']?>"></a>
					
					
				</div>
				

			</div>

			<div class="row copyt">
				<div class="small-12 medium-6 large-6">

					<p class="sim-info">
						virtuaalihevonen / a sim-game horse
					</p>
				</div>
				<div class="small-12 medium-6 large-6 columns">
					<p class="sim-info"> 
						Kuvat &copy;
						<?	
						foreach ($kuvaajat as $kuvaaja) {
							if($kuvaaja['url'] != "kuvaajan url"){
								echo ' <a href="'.$kuvaaja['url'].'" target="_blank">'.$kuvaaja['nimi'].'</a>, ';
							}
							else{
								echo ' '.$kuvaaja['nimi'].", ";
							}
						}
						?>
					</p> 
				</div>
			</div>

			

			<div class="row" data-equalizer data-equalize-by-row="true">
				<div class="small-12 medium-8 large-7 columns luonne" data-equalizer-watch>


					
					<? if($tama_heppa->luonne!=""){

						$tama_heppa->luonne = preg_replace('/\n/', '</p><p>',$tama_heppa->luonne);
						$tama_heppa->luonne = "<p>{$tama_heppa->luonne}</p>";
						echo $tama_heppa->luonne;
					} else {?>
					<center><i>Luonne tulossa</i></center>
					<?}?>

				</div>

				<div class="small-12 medium-4 large-5 columns kuvagalleria" data-equalizer-watch>


					<div class="koristekuvat">
						<?
						foreach($kuvat as $kuva){
							echo '<a href="http://www.salaovi.net/hukkapuro/img/h/'.$kuva['osoite'].'"  data-lightbox="kuvagalleria" title="&nbsp;"><img src="http://www.salaovi.net/hukkapuro/img/h/'.$kuva['osoite'].'" class="galleriakuva"/></a>';
						}

						?>
					</div>

					
				</div>
			</div>

			<hr />

			<div class="clear"></div>
			

			


			<div class="row content">
				<div class="small-12 medium-12 large-10 columns suku">
					<h2>Sukutaulu</h2>
					<?php

					function tayta_sukulaisrivit($heppa, &$koko_suku, $polvi_str) {
						$rivi = &$koko_suku[count($koko_suku) - 1];
						$rivi[] = array($heppa, $polvi_str);
						if (isset($heppa->isa)) {
							tayta_sukulaisrivit($heppa->isa, $koko_suku, $polvi_str . "i");
						}
						if (isset($heppa->ema)) {
							$koko_suku[] = array();
							tayta_sukulaisrivit($heppa->ema, $koko_suku, $polvi_str . "e");
						}
					}

					$koko_suku = array(array());
					tayta_sukulaisrivit($tama_heppa->isa, $koko_suku, "i");
					$koko_suku[] = array();
					tayta_sukulaisrivit($tama_heppa->ema, $koko_suku, "e");

						        //Hevosen tietojen muotoilu sukutaulua varten
					function lisaa_sukulainen($heppa, $rowspan){
						if(!isset($heppa->id)){
							return 'tuntematon';
						}

						$str = '<span>'.$heppa->nimi.'</span>';


						if($heppa->hae_url() != ""){
							$str = '<span><a href="'.$heppa->hae_url().'" target="_blank">'.$heppa->nimi.'</a></span>';
						}

						if($heppa->status != "" && $heppa->status != "kuollut" ){
							$str = $str.' <span class="status">'.$heppa->status.'</span>';
						}



						if($heppa->rotu_lyhenne != ""){
							$str = $str."<br /><small>".$heppa->rotu_lyhenne."-".$heppa->sukupuoli;
						}

						if($heppa->saka){
							$str = $str.", ".$heppa->saka." cm";
						}

						if($heppa->vari != ""){
							$str = $str.", ".$heppa->vari;
						}


						if($heppa->meriitit != ""){
							$str = $str."<br /><strong><small>".$heppa->meriitit.'</small></strong>';
						}
						return $str;
					}
					?>
					<div class="table-scroll show-for-small">
						<table class="sukutaulu">

							<?php foreach($koko_suku as $suku_rivi): ?>

								<tr>

									<?php foreach($suku_rivi as $i => $heppa_info): ?>
										<?php
										$heppa = $heppa_info[0];
										$polvi_str = $heppa_info[1];
										$rowspan = pow(2, (count($suku_rivi) - $i - 1));
										?>

										<td rowspan="<?= $rowspan ?>"><b><?= $polvi_str . "." ?></b> <?= lisaa_sukulainen($heppa, $rowspan) ?></td>

									<?php endforeach; ?>

								</tr>

							<?php endforeach; ?>

						</table>
					</div>

					<div class="row">
						<div class="medium-6 columns medium-centered">
							<a href="/hukkapuro/suku/<?= $tama_heppa->id?>" target="_blank" class="button primary expanded sukubutton">Katso interaktiivinen sukutaulu!</a>
						</div>
					</div>

					<p class="sukuselvitys">	
						<?
						if($tama_heppa->sukuselvitys !=""){
							$tama_heppa->sukuselvitys = preg_replace('/\n/', '</p><p>',$tama_heppa->sukuselvitys);
							$tama_heppa->sukuselvitys = "<p>{$tama_heppa->sukuselvitys}</p>";


							if($tama_heppa->suvun_pituus > 3){
								?>
								<h3>Muut KRJ-palkitut sukulaiset</h3>
								<div class="sukuselvitys">
									<?= $tama_heppa->sukuselvitys?>
								</div>

								<?
							} else {
								?>
								<h3>Sukuselvitys</h3>
								<div class="sukuselvitys">
									<?= $tama_heppa->sukuselvitys?>
								</div>
								<?
							}}
							?>
						</p>

					</div>

					<div class="small-12 medium-12 large-2 columns jalkelaiset">
						<h3>Jälkeläiset</h3>

						<?

						$varsat = $tama_heppa->hae_jalkelaiset($db, $tama_heppa->sukupuoli);
						if(isset($varsat)){
							?>
							<div class="row">
								<?
								foreach ($varsat as $varsa){
									echo '<div class="small-6 medium-3 large-12 columns varsa"><b> <a href="'.$varsa->hae_url().'" target="_blank" class="nimi"> '.$varsa->nimi.'</a>'.'</b><br /> ';
									echo $varsa->rotu_lyhenne.'-'.$varsa->sukupuoli.'<br />';
									echo 's.'.muotoile_pelkka_paivamaara($varsa->syntymaaika).'<br />';
									if($tama_heppa->sukupuoli=='tamma'){
										echo '<small>i. <a href="'.$varsa->isa->hae_url().'" target="_blank">'.$varsa->isa->nimi.'</a></small><br />';
									} else{
										echo '<small>e. <a href="'.$varsa->ema->hae_url().'" target="_blank">'.$varsa->ema->nimi.'</a></small><br />';
									}

									if($varsa->meriitit != ""){
										echo '<strong><small>'.$varsa->meriitit.'</small></strong></div>';
									} else {
										echo '</div>';
									}
								}
								?>
							</div>
							<?
						}

						else {
							echo('<p>Tällä hevosella ei ole vielä jälkeläisiä</p>');
						}

						?>

					</div>
				</div>
				<hr />

				<div class="clear"></div>
				

				<div class="row">
					<div class="small-12 columns kilpailut">
						<div class="row">										
							<div class="small-12 medium-7 large-7 columns sijat">



								<h2>Kilpailut</h2>

								<div class="tietolaatikko">
									<strong>Painotuslaji:</strong> <?=$tama_heppa->painotus?><br />
									<strong>Koulutustaso:</strong> <?=$tama_heppa->koulutustaso?><br />

									<? if($tama_heppa->kilpailu_tyyppi=="porrastettu"){?>
									<p><?= $tama_heppa->lempinimi?> kilpailee porrastetuissa kilpailuissa!</p>
									<?}else{?>
									<p><?= $tama_heppa->lempinimi?> kilpailee tavallisissa kilpailuissa!</p>
									<?}?>
								</div>

								<!-- Hepan kisat tekstinä -->
								<?
								if($tama_heppa->kilpailu_tyyppi == "teksti") {

									$stmt = $db->prepare('SELECT * FROM hevonen_kisat WHERE hevonen_id = :id');
									$stmt->bindParam(':id', $hevonen_id);
									$stmt->execute();
									$haettu_kisat = $stmt->fetch(PDO::FETCH_ASSOC);
									?>



									<?
									echo '<div class="sijoitukset">'.$haettu_kisat['teksti'].'</div>';

									?>

									<!-- Hepan kisat sijoituksina -->
									<?
								}  elseif($tama_heppa->kilpailu_tyyppi == "normaali") {
									$stmt = $db->prepare('SELECT * FROM hevonen_kisat WHERE hevonen_id = :id');
									$stmt->bindParam(':id', $hevonen_id);
									$stmt->execute();
									$haettu_kisat = $stmt->fetchAll();
									?>

									<?if($tama_heppa->painotus != "yleispainotus"){?>
									<p>Sijoituksia yhteensä <b><?=count($haettu_kisat)?></b></p>
									<?}?>

									<div class="sijoitukset">
										<?
										foreach ($haettu_kisat as $kisa) {
											echo $kisa['pvm'].'  <b><a href="'.$kisa['kutsu_url'].'" target="_blank">'.$kisa['laji'].'</a></b> '.$kisa['luokka'].' <b>'.$kisa['sijoitus'].'/'.$kisa['osallistujat'].'</b><br />';
										}
										?>
									</div>

									<!-- Heppa kisaa porrastetuissa -->
									<? 
								} 
								else{

									$reknro = $tama_heppa->vhtunnus; 
									$json = file_get_contents('http://www.virtuaalihevoset.net/?rajapinta/ominaisuudet.html?vh=' . $reknro); 
									$obj = json_decode($json, true); 
									?>


									<?
									$krjtaso = $obj['krj']['level'];
									$krjtasomax = $obj['krj']['level_max'];

									if($krjtasomax != -1){
										$krjtasomax += 1;
										$krjprosentti = ($krjtaso/($krjtasomax))*100;
										if($krjprosentti > 100){
											$krjprosentti = 100;
										}

										?>


										<b>Kouluratsastus</b> taso <?=$krjtaso?>/<?=$krjtasomax-1?><br />
										<div class="progress" role="progressbar" tabindex="0" aria-valuenow="50" aria-valuemin="0" aria-valuetext="<?=$krjprosentti?> percent" aria-valuemax="100">
											<div class="progress-meter" style="width: <?=$krjprosentti?>%"></div>
										</div>

										<?
									}
									$erjtaso = $obj['erj']['level'];
									$erjtasomax = $obj['erj']['level_max'];

									if($erjtasomax != -1){
										$erjtasomax += 1;
										$erjprosentti = ($erjtaso/($erjtasomax))*100;
										if($erjprosentti > 100){
											$erjprosentti = 100;
										}

										?>


										<b>Esteratsastus</b> taso <?=$erjtaso?>/<?=$erjtasomax-1?><br />
										<div class="progress" role="progressbar" tabindex="0" aria-valuenow="50" aria-valuemin="0" aria-valuetext="<?=$erjprosentti?> percent" aria-valuemax="100">
											<div class="progress-meter" style="width: <?=$erjprosentti?>%"></div>
										</div>

										<?
									}
									$kerjtaso = $obj['kerj']['level'];
									$kerjtasomax = $obj['kerj']['level_max'];

									if($kerjtasomax != -1){
										$kerjtasomax += 1;
										$kerjprosentti = ($kerjtaso/($kerjtasomax))*100;
										if($kerjprosentti > 100){
											$kerjprosentti = 100;
										}

										?>

										<b>Kenttäratsastus</b> taso <?=$kerjtaso?>/<?=$kerjtasomax-1?><br />
										<div class="progress" role="progressbar" tabindex="0" aria-valuenow="50" aria-valuemin="0" aria-valuetext="<?=$kerjprosentti?> percent" aria-valuemax="100">
											<div class="progress-meter" style="width: <?=$kerjprosentti?>%"></div>
										</div>

										<?
									}
									$vvjtaso = $obj['vvj']['level'];
									$vvjtasomax = $obj['vvj']['level_max'];

									if($vvjtasomax != -1){
										$vvjtasomax += 1;
										$vvjprosentti = ($vvjtaso/($vvjtasomax))*100;
										if($vvjprosentti > 100){
											$vvjprosentti = 100;
										}

										?>

										<b>Valjakkoajo</b> taso <?=$vvjtaso?>/<?=$vvjtasomax-1?><br />
										<div class="progress" role="progressbar" tabindex="0" aria-valuenow="50" aria-valuemin="0" aria-valuetext="<?=$vvjprosentti?> percent" aria-valuemax="100">
											<div class="progress-meter" style="width: <?=$vvjprosentti?>%"></div>
										</div>




										<?php } ?>

										<?

										echo $obj['error_message'];
									}
									if(!empty($tama_heppa->muut_kilpailut)){?>
									<br />
									<div class="muut_kilpailut">
										<?=$tama_heppa->muut_kilpailut?>
									</div>
									<?}?>


								</div>



								<div class="small-12 medium-5 large-5 columns">
									<div class="saavutukset">
										<h2>Saavutukset</h2>
										<?=$tama_heppa->saavutukset?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<hr />

					<div class="clear"></div>


					<?
					$stmt = $db->prepare('SELECT * FROM hevonen_tekstit WHERE hevonen_id = :id ORDER BY pvm');
					$stmt->bindParam(':id', $tama_heppa->id);
					$stmt->execute();
					$tekstit = $stmt->fetchAll();

					if(count($tekstit) != 0){
						?>


						<div class="row">
							<div class="small-12 columns paivakirja">
								<h2>Päiväkirja</h2>

								<div class="row">
									<?
									foreach($tekstit as $teksti){
										?>

										<div class="pkmerkinta small-12 medium-6 columns">
											<h3><? if($teksti['pvm'] != "0000-00-00"){echo muotoile_pelkka_paivamaara($teksti['pvm']).' - ';} echo$teksti['otsikko']?></h3>
											<span class="copyteksti"><?=$teksti['tekstin_tyyppi'].' - kirjoittanut '.$teksti['kirjoittaja']?><br /><br /></span>
											<?
											$teksti = preg_replace('/\n/', '</p><p>',$teksti['teksti']);
											$teksti = "<p>{$teksti}</p>";
											echo $teksti
											?>

										</div>

										<?}?>
									</div>
								</div>
							</div>
							<?}?>
						</div>
					</div>
				</div>
			</div>			
			<? require('bottom.php'); ?>