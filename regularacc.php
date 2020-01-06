<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['userid'])) {
        die("ACCESS DENIED");
    }


try 
{
    require_once "mypdo.php";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
    die();
}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Anmol paridhan by cash entery</title>
	<link rel="stylesheet" type="text/css" href="allpagecss.css" />
</head>
<body>


</body>
</html>