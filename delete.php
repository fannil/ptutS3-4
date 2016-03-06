<?php

include('db.php');
$subFolder = getCookieId();
$fileName = $_POST['name'];
$t= "dptImg/" . $subFolder . "/" . $fileName;
unlink($t);

suppImg($fileName, $subFolder);

?>