<?php
	include("db.php");

	if(isset($_POST["id"]) && $_POST["id"] != null &&
		isset($_POST["pwd"]) && $_POST["pwd"] != null){
		if(connectAdmin($_POST["id"], $_POST["pwd"])) header("Location: modifier.php");
		else header("Location: admin.php?err=1");
	}
	else header("Location: admin.php?err=2")
?>