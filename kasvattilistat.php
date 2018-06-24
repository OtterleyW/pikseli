<? require('top.php');?>
<div class="row sisalto">
	<div class="small-12 columns teksti">
		<h2>Hukkapuron kasvatit</h2>

		<p>
			Tänne on listattu vuosittain kaikki Hukkapurossa syntyneet kasvatit. Jos omistamaasi kasvattia ei löydy listoilta tai listan tiedot eivät ole ajantasalla, ilmoitathan sähköpostitse <a href="mailto:virtuaali@salaovi.net">virtuaali@salaovi.net</a>!
		</p>

		<?php
		if(isset($_GET["vuosi"])){
			$vuosi = $_GET["vuosi"];
			if( $vuosi == "2014" ) {
				?>
				<div class="row content">
					<div class="small-12 columns">
						<ul class="pagination text-center" role="navigation">
							<li class="current"><big>Kasvatit 2014</big></li>
							<li><a href="kasvattilistat.php?vuosi=2015"><big>Kasvatit 2015</big></a></li>
							<li><a href="kasvattilistat.php?vuosi=2016"><big>Kasvatit 2016</big></a></li>
							<li><a href="kasvattilistat.php?vuosi=2017"><big>Kasvatit 2017</big></a></li>
							<li><a href="kasvattilistat.php?vuosi=2018"><big>Kasvatit 2018</big></a></li>
						</ul>
					</div>
				</div>
				<div class="row content">
					<div class="small-12 columns">
						<?
						include('kasvattilistat/2014.php');
					} 

					elseif( $vuosi == "2015") {
						?>
						<div class="row content">
							<div class="small-12 columns">
								<ul class="pagination text-center" role="navigation">
									<li><a href="kasvattilistat.php?vuosi=2014"><big>Kasvatit 2014</big></a></li>
									<li class="current"><big>Kasvatit 2015</big></li>
									<li><a href="kasvattilistat.php?vuosi=2016"><big>Kasvatit 2016</big></a></li>
									<li><a href="kasvattilistat.php?vuosi=2017"><big>Kasvatit 2017</big></a></li>
									<li><a href="kasvattilistat.php?vuosi=2018"><big>Kasvatit 2018</big></a></li>
								</ul>
							</div>
						</div>
						<div class="row content">
							<div class="small-12 columns">
								<?
								include('kasvattilistat/2015.php');
							} 

							elseif ( $vuosi == "2016" ) {
								?>
								<div class="row content">
									<div class="small-12 columns">
										<ul class="pagination text-center" role="navigation">
											<li><a href="kasvattilistat.php?vuosi=2014"><big>Kasvatit 2014</big></a></li>
											<li><a href="kasvattilistat.php?vuosi=2015"><big>Kasvatit 2015</big></a></li>
											<li class="current"><big>Kasvatit 2016</big></li>
											<li><a href="kasvattilistat.php?vuosi=2017"><big>Kasvatit 2017</big></a></li>
											<li><a href="kasvattilistat.php?vuosi=2018"><big>Kasvatit 2018</big></a></li>
										</ul>
									</div>
								</div>
								<div class="row content">
									<div class="small-12 columns">
										<?
										include('kasvattilistat/2016.php');
									} 

									elseif ( $vuosi == "2017" ) {
										?>
										<div class="row content">
											<div class="small-12 columns">
												<ul class="pagination text-center" role="navigation">
													<li><a href="kasvattilistat.php?vuosi=2014"><big>Kasvatit 2014</big></a></li>
													<li><a href="kasvattilistat.php?vuosi=2015"><big>Kasvatit 2015</big></a></li>
													<li><a href="kasvattilistat.php?vuosi=2016"><big>Kasvatit 2016</big></a></li>
													<li class="current"><big>Kasvatit 2017</big></li>
													<li><a href="kasvattilistat.php?vuosi=2018"><big>Kasvatit 2018</big></a></li>
												</ul>
											</div>
										</div>
										<div class="row content">
											<div class="small-12 columns">
												<?
												include('kasvattilistat/2017.php');
											} elseif ( $vuosi == "2018" ) {
												?>
												<div class="row content">
													<div class="small-12 columns">
														<ul class="pagination text-center" role="navigation">
															<li><a href="kasvattilistat.php?vuosi=2014"><big>Kasvatit 2014</big></a></li>
															<li><a href="kasvattilistat.php?vuosi=2015"><big>Kasvatit 2015</big></a></li>
															<li><a href="kasvattilistat.php?vuosi=2016"><big>Kasvatit 2016</big></a></li>
															<li><a href="kasvattilistat.php?vuosi=2017"><big>Kasvatit 2017</big></a></li>
															<li class="current"><big>Kasvatit 2018</big></li>
														</ul>
													</div>
												</div>
												<div class="row content">
													<div class="small-12 columns">
														<?
														include('kasvattilistat/2018.php');
													}
													else {
														?>
														<div class="row content">
															<div class="small-12 columns">
																<ul class="pagination text-center" role="navigation">
																	<li><a href="kasvattilistat.php?vuosi=2014"><big>Kasvatit 2014</big></a></li>
																	<li><a href="kasvattilistat.php?vuosi=2015"><big>Kasvatit 2015</big></a></li>
																	<li><a href="kasvattilistat.php?vuosi=2016"><big>Kasvatit 2016</big></a></li>
																	<li><a href="kasvattilistat.php?vuosi=2017"><big>Kasvatit 2017</big></a></li>
																	<li class="current"><big>Kasvatit 2018</big></li>
																</ul>
															</div>
														</div>
														<div class="row content">
															<div class="small-12 columns">
																<?
																include('kasvattilistat/2018.php');
															}

														}  

														else {
															?>
															<div class="row content">
																<div class="small-12 columns">
																	<ul class="pagination text-center" role="navigation">
																		<li><a href="kasvattilistat.php?vuosi=2014"><big>Kasvatit 2014</big></a></li>
																		<li><a href="kasvattilistat.php?vuosi=2015"><big>Kasvatit 2015</big></a></li>
																		<li><a href="kasvattilistat.php?vuosi=2016"><big>Kasvatit 2016</big></a></li>
																		<li><a href="kasvattilistat.php?vuosi=2017"><big>Kasvatit 2017</big></a></li>
																		<li class="current"><big>Kasvatit 2018</big></li>
																	</ul>
																</div>
															</div>
															<div class="row content">
																<div class="small-12 columns">
																	<?
																	include('kasvattilistat/2018.php');
																}
																?>

															</div>
														</div>
													</div>
												</div>

												<? require('bottom.php');?>