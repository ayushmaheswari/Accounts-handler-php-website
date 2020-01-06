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

    if (isset($_POST['cname'])) 
    {
        $cname = htmlentities($_POST['cname']);

        $stmt = $pdo->prepare("
            insert into company(cname,cballance) VALUES (:cname,:cballance)
        ");

        $stmt->execute([
            ':cname' => $cname,
            ':cballance' => 0, 
        ]);

        header('Location: mainpage.php');
        return;
    }







?>

<!DOCTYPE html>
<html>
<head>
	<title>Anmol paridhan company entery</title>
	<link rel="stylesheet" type="text/css" href="allpagecss.css" />
</head>
<body>

	<div class="login">
    <h1>Company Detail</h1>
    <form method="post">
        <input type="text" name="cname" placeholder="Enter Company Name" required="required" />
        <button type="submit" class="btn btn-primary btn-large" style="width: 160px">Submit</button>
        <a href="mainpage.php"><button type="button" class="btn btn-primary btn-large" style="width: 130px" name="Cancel">Cancel</button></a>
    </form>
</div>

</body>
</html>