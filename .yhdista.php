<?

// Luo tietokantayhteys, täytä oma tietokannan nimi, käyttäjänimi ja salasana
$db = new PDO("mysql:host=localhost;dbname=TIETOKANNAN_NIMI;port=8889", "KÄYTTÄJÄ", "SALASANA", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

// Räjäytä skripti heti ekan SQL-virheen kohdalla
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require('luokat/Heppa.php');

// Apufunktioita

function hae_tiedot($id, $db){
    //Perustietojen hakeminen
    $stmt = $db->prepare('SELECT * FROM hevonen_tiedot WHERE id = :id');
    $stmt->bindParam(':id', $hevonen_id);
    $hevonen_id = $id;
    $stmt->execute();
    $haettu_tiedot = $stmt->fetch(PDO::FETCH_ASSOC);


    //Sukutietojen
    $stmt = $db->prepare('SELECT * FROM hevonen_suku WHERE id = :id');
    $stmt->bindParam(':id', $hevonen_id);
    $stmt->execute();
    $haettu_suku = $stmt->fetch(PDO::FETCH_ASSOC);

    //Tämän Heppa-olion luonti
    $tama_heppa = new Heppa($haettu_tiedot, $haettu_suku);
    $tama_heppa->hae_sukupolvet($db, 4);

    return $tama_heppa;
  }

  //Päivämäärän muotoilu
  function muotoile_paivamaara($paivamaara_merkkijono){
  try {
    $date = new DateTime($paivamaara_merkkijono);
  } catch (Exception $e) {
    return $e->getMessage();
  }

  return $date->format('d.m.Y G:i:s');
  }

  //Päivämäärän muotoilu
  function muotoile_pelkka_paivamaara($paivamaara_merkkijono){
  try {
    $date = new DateTime($paivamaara_merkkijono);
  } catch (Exception $e) {
    return $e->getMessage();
  }

  return $date->format('d.m.Y');
  }

##EOF