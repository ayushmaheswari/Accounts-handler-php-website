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

    if (isset($_POST['cid']) && isset($_POST['chequeno']) && isset($_POST['amount']) ) 
    {
        $cid = htmlentities($_POST['cid']);
        $chequeno = htmlentities($_POST['chequeno']);
        $amount = htmlentities($_POST['amount']);
        $tdate = date('Y-m-d');

        $stmt = $pdo->prepare("
            insert into cheque(cid,amount,chequeid,tdate) VALUES (:cid,:amount,:chequeno,:tdate)
        ");

        $stmt->execute([
            ':cid' => $cid,
            ':amount' => $amount, 
            ':chequeno' => $chequeno,
            ':tdate' => $tdate,
        ]);



$stmt1 = $pdo->prepare("
            SELECT cballance from company where cid=:cid
        ");


        $stmt1->execute([
        ':cid' => $cid, 
    ]);

    $ballanceval = $stmt1->fetch(PDO::FETCH_OBJ);

    $mybalance = $ballanceval->cballance;


     $stmt2 = $pdo->prepare("
            UPDATE company set cballance = :cballance WHERE cid = :cid
        ");


        $stmt2->execute([
        ':cid' => $cid, 
        ':cballance' => $mybalance-$amount,
    ]);







$stmt4 = $pdo->prepare("
            SELECT balance from bank where accno=:accno
        ");


        $stmt4->execute([
        ':accno' => 410, 
    ]);

    $ballanceval = $stmt4->fetch(PDO::FETCH_OBJ);

    $mybalance = $ballanceval->balance;


     $stmt5 = $pdo->prepare("
            UPDATE bank set balance = :balance WHERE accno = :accno
        ");


        $stmt5->execute([
        ':accno' => 410, 
        ':balance' => $mybalance-$amount,
    ]);



        header('Location: mainpage.php');
        return;
    }




?>

<!DOCTYPE html>
<html>
<head>
	<title>Anmol paridhan by cheque</title>
	<link rel="stylesheet" type="text/css" href="allpagecss.css" />
</head>
<body>



<div class="login">
    <h1>By Cheque Detail</h1>
    <form method="post">
        <input type="number" name="cid" placeholder="Enter Company Id" required="required" />
        <input type="text" name="chequeno" placeholder="Enter Cheque No" required="required" />
        <input type="number" name="amount" placeholder="Enter Amount" required="required" />
        <button type="submit" class="btn btn-primary btn-large" style="width: 160px">Submit</button>
        <a href="mainpage.php"><button type="button" class="btn btn-primary btn-large" style="width: 130px" name="Cancel">Cancel</button></a>
    </form>
</div>


</body>
</html>