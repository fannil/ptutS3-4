<?php include("./db.php"); 
?>
<p>
	<?php
	if(isset($_COOKIE['dptId']) && $_COOKIE['dptId'] != null  && 
		isset($_POST['nomDept']) && $_POST['nomDept'] != null && isset($_POST['desc']) && $_POST['desc'] != null 
		&& isset($_POST['lat']) && $_POST['lat'] != null && isset($_POST['lng']) && $_POST['lng'] != null){

		updateDpt($_POST["nomDept"], $_POST["desc"], $_POST["lat"], $_POST["lng"], $_COOKIE['dptId']);
		header("Location: modifier.php?id=" . $_COOKIE['dptId'] . "&mod=1");
	}

	else{
		echo("Formulaire incomplet");
		header('Refresh: 3; URL=modifier.php?id=' . $_COOKIE['dptId'] . "&mod=0");
	}
	?>
</p>