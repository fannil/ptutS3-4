<?php include("./db.php"); 
?>
<p>
	<?php
	if(isset($_GET["id"]) && $_GET["id"] != null){

		deleteDpt($_GET["id"]);
		header("Location: modifier.php?del=" . $_GET['id']);
	}

	else{
		header('Location: modifier.php?del=-1');
	}
	?>
</p>