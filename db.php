<?php

ini_set('session.save_path', 'sessions');
session_start();

function getPropertyValue($str){
	preg_match('~=(.*?);~', $str, $output);
	return $output[1];
}

function getProperties(){
	$file = fopen("Restricted/connexion.properties", "r");
	$properties["host"] = getPropertyValue(fgets($file));
	$properties["user"] = getPropertyValue(fgets($file));
	$properties["password"] = getPropertyValue(fgets($file));
	$properties["bdname"] = getPropertyValue(fgets($file));

	return $properties;
}

function Connect_db(){
	if(($properties = getProperties()) != null){
		$host=$properties["host"];
		$user=$properties["user"];
		$password=$properties["password"];
		$bdname=$properties["bdname"];
	}
	else{
		$host="localhost";
		$user="root";
		$password="";
		$bdname="ptut";
	}

	try{
		$bdd = new PDO('mysql:host='.$host.';dbname='.$bdname.
			';charset=utf8',$user,$password);
		return $bdd;
	}
	catch(Exception $e)
	{
		die('Erreur: ' .$e->getMessage());
	}
}

function getIdDepartements(){
	$bdd = Connect_db();
	$SQL_Query = 'select idDepartement as id from Departement';
	$dpts = array();
	$i = 0;

    $query = $bdd -> prepare($SQL_Query);
    $query -> execute();

    while($line = $query -> fetch()){
    	$dpts[$i] = $line['id'];
    	$i++;
    }

    return $dpts;
}

function getInfos($idDepartement){
	$bdd = Connect_db();
	$SQL_Query = 'select nomDepartement as titre, description as description, lat, lng from Departement where idDepartement = '. $idDepartement;

    $query = $bdd -> prepare($SQL_Query);
    $query -> execute();

    return str_replace("'", "\'", ($query -> fetch(PDO::FETCH_ASSOC)));
}

function getImages($idDepartement){
	$bdd = Connect_db();
	$SQL_Query = 'select nomImage as nom, lienImage as link from Images where idDepartement = '. $idDepartement;

    $query = $bdd -> prepare($SQL_Query);
    $query -> execute();

    return str_replace("'", "\'", ($query -> fetchAll(PDO::FETCH_ASSOC)));
}

function addDept($nomDept, $desc, $lat, $lng){
	$bdd = Connect_db();
	$SQL_Query = "insert into Departement values (null, ?, ?, ?, ?)";

    $query = $bdd -> prepare($SQL_Query);
    $query->bindParam(1, $nomDept);
    $query->bindParam(2, $desc);
    $query->bindParam(3, $lat);
    $query->bindParam(4, $lng);

    $query->execute();

    $id = $bdd->lastInsertId();

    mkdir("dptImg/" . $id);
    return $id;
}

function getCookieId(){
	if(isset($_COOKIE["dptId"])){
		return $_COOKIE['dptId'];
	}
	else return -1;
}

function addImg($path, $dpt){

	$bdd = Connect_db();
	$SQL_Query = "insert into Images values (null, ?, ?, ?)";

    $query = $bdd -> prepare($SQL_Query);

    $name = pathinfo($path, PATHINFO_FILENAME);
    echo($name);
    $query->bindParam(1, $name);
    $query->bindParam(2, $path);
    $query->bindParam(3, $dpt);

    $query->execute();

    return $bdd->lastInsertId();
}

function suppImg($path, $dpt){
	$bdd = Connect_db();
	$SQL_Query = "delete from Images where idDepartement = " . $dpt . " and lienImage = '" . $path . "'";

    $query = $bdd -> prepare($SQL_Query);

    $query->execute();
}

function updateDpt($nomDept, $desc, $lat, $lng, $idDepartement){
	$bdd = Connect_db();
	$SQL_Query = "update Departement set nomDepartement = ?,
	 description = ?,
	 lat = ?,
	 lng = ?
	 where idDepartement = ". $idDepartement;

    $query = $bdd -> prepare($SQL_Query);
    $query->bindParam(1, $nomDept);
    $query->bindParam(2, $desc);
    $query->bindParam(3, $lat);
    $query->bindParam(4, $lng);

    $query->execute();
}

function deleteDpt($idDepartement){
	$dir = "dptImg/" . $idDepartement;

	$bdd = Connect_db();
	$SQL_Query = "delete from Departement where idDepartement = ". $idDepartement;

	$query = $bdd -> prepare($SQL_Query);
    $query->execute();

    $SQL_Query = "delete from Images where idDepartement = ". $idDepartement;

    $query = $bdd -> prepare($SQL_Query);
    $query->execute();

    array_map('unlink', glob("$dir/*.*"));
    rmdir($dir);
}

function isConnected(){
	if(isset($_SESSION["id"]) && isset($_SESSION["pwd"])) return true;
	else return false;
}

function connectAdmin($id, $pwd){
	$bdd = Connect_db();
	$SQL_Query = "select * from Admin where id = ? and pwd = ?";

	$query = $bdd -> prepare($SQL_Query);
    $query->bindParam(1, $id);
    $query->bindParam(2, $pwd);

    $i = 0;
    $query->execute();

    if($query->fetch()){
    	session_start();
    	$_SESSION['id'] = $id;
    	$_SESSION['pwd'] = $pwd;

    	return true;
    }
    else return false;
}

function disconnect(){
	session_unset();
	session_destroy();
}
?>
