<?php

function Connect_db(){
	$host="iutdoua-webetu.univ-lyon1.fr";
	$user="p1402965";
	$password="212498";
	$bdname="p1402965";
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
}

?>