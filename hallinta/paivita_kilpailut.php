<?
require('navit.php');

function pilko_rivit($merkkijono){
	if($merkkijono == ""){
		return array();
	} 
	else {
		$rivit = explode("\r\n", $merkkijono);
		return $rivit;
	}
}

function muotoile_kisat($txt){
		//Muotoonlaitettujen kisojen muotoilu tietokantaan RegExit
	  $re1='((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])';	# DDMMYYYY 1
	  $re2='.*?';	# Non-greedy match on filler
	  $re3='((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))';	# HTTP URL 1
	  $re4='.*?';	# Non-greedy match on filler
	  $re5='((?:[a-z][a-z]+))';	# Word 1
	  $re6='.*?';	# Non-greedy match on filler
	  $re7='((?:[a-z][a-z]+))';	# Word 2
	  $re8='(\\s+)';	# White Space 1
	  $re9='([a-z]+)';	# Any Single Word Character (Not Whitespace) 1
	  $re10='.*?';	# Non-greedy match on filler
	  $re11='(\\d+)';	# Integer Number 1
	  $re12='(.)';	# Any Single Character 1
	  $re13='(\\d+)';	# Integer Number 2

	  $pilkottu = array();
	  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11.$re12.$re13."/is", $txt, $matches))
	  {
	      $pilkottu['paivamaara']=$matches[1][0];
	      $pilkottu['url']=$matches[2][0];
	      $pilkottu['paikka']=$matches[3][0];
	      $pilkottu['taso']=$matches[4][0].$matches[5][0].$matches[6][0];
	      $pilkottu['sijoitus']=$matches[7][0];
	      $pilkottu['osallistujat']=$matches[9][0];

	      return $pilkottu;
	  }


	  return null;
	 }


	$id = $_POST['id'];
	$laji = $_POST['laji'];
	$kisat = pilko_rivit($_POST["kilpailut"]);

	$lisaa_kisat = $db->prepare('INSERT INTO hevonen_kisat
	(pvm, kutsu_url, paikka, laji, luokka, sijoitus, osallistujat, hevonen_id)
	VALUES
	(:pvm, :kutsu_url, :paikka, :laji, :luokka, :sijoitus, :osallistujat, :hevonen_id)
	');

	try {
	$db->beginTransaction();
		foreach ($kisat as $i=>$kisa) {
			$pilkottu = muotoile_kisat($kisa);

			$lisaa_kisat->bindParam(':pvm', $pilkottu['paivamaara']);
			$lisaa_kisat->bindParam(':kutsu_url', $pilkottu['url']);
			$lisaa_kisat->bindParam(':paikka', $pilkottu['paikka']);
			$lisaa_kisat->bindParam(':laji', $laji);
			$lisaa_kisat->bindParam(':luokka', $pilkottu['taso']);
			$lisaa_kisat->bindParam(':sijoitus', $pilkottu['sijoitus']);
			$lisaa_kisat->bindParam(':osallistujat', $pilkottu['osallistujat']);
			$lisaa_kisat->bindParam(':hevonen_id', $id);

			$lisaa_kisat->execute();
		}
		$db->commit();
		
		echo('<h2>Lisää kilpailuja</h2>
				<div class="alert alert-success">
		        Tiedot päivitetty!
		      </div>
			');
		
	}
	catch (Exception $e) {
		echo('<h2>Lisää kilpailuja</h2>
				<div class="alert alert-danger">
		        Pyöritään takaisin!
		      </div>
			');
		$db->rollBack();
		throw $e;
		
	}
?>

    </div>
  </div>
</div>
</body>
</html>