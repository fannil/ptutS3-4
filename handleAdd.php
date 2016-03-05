<?php include("./db.php"); 
?>
<h1>
	<?php
	if(isset($_POST['nomDept']) && isset($_POST['desc']) && isset($_POST['lat']) && isset($_POST['lng'])){
		if(addDept($_POST['nomDept'], $_POST['desc'], $_POST['lat'] ,$_POST['lng']) == 0){
			echo("Succès");
		}
		else echo("Echec");
	}
	else{
		echo("Formulaire incomplet");
	}
	?>
</h1>