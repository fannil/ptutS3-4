<?php include("./db.php"); 
?>
<p>
	<?php
	if(isset($_POST['nomDept']) && $_POST['nomDept'] != null && isset($_POST['desc']) && $_POST['desc'] != null 
		&& isset($_POST['lat']) && $_POST['lat'] != null && isset($_POST['lng']) && $_POST['lng'] != null){

		$id = addDept($_POST['nomDept'], $_POST['desc'], $_POST['lat'] ,$_POST['lng']);
		setcookie("dptId", $id);
		header("Location: addImg.php");
	}

	else{
		echo("Formulaire incomplet");
		header('Refresh: 3; URL=ajout.php');
	}
	?>
</p>