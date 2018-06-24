<?
 require('navit.php');

 $id = $_GET['id'];

 $stmt = $db->prepare('UPDATE hevonen_tiedot SET status="poistettu" WHERE id=:id');
 $stmt->bindParam(':id', $id);
 $stmt->execute();
?>

	<h2>Hevosen poistaminen</h2>
      <div class="alert alert-danger">
        Hevonen poistettu!
      </div>

      
    
    </div>
  </div>
</div>
</body>
</html>