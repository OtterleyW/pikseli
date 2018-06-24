<?php
require('../../.yhdista.php');

	$stmt = $db->prepare('SELECT id FROM hevonen_tiedot ORDER BY id DESC LIMIT 1');
	$stmt->execute();
	$viimeisin = $stmt->fetch(PDO::FETCH_ASSOC);
	$seuraava = $viimeisin['id']+1;

	$stmt = $db->prepare('INSERT INTO hevonen_tiedot (id) VALUES (:seuraava)');
	$stmt->bindParam(':seuraava', $seuraava);
	$stmt->execute();

	$stmt = $db->prepare('INSERT INTO hevonen_suku (id) VALUES (:seuraava)');
	$stmt->bindParam(':seuraava', $seuraava);
	$stmt->execute();

	header("Location: muokkaa_hevosta.php?id=$seuraava");    

?>