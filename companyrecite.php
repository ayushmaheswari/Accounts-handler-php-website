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

    if (isset($_POST['cid']) && isset($_POST['billno']) && isset($_POST['amount']) ) 
    {
        $cid = htmlentities($_POST['cid']);
        $billno = htmlentities($_POST['billno']);
        $amount = htmlentities($_POST['amount']);
        $gst = 0.05*$amount;
        $total= $amount+$gst;
        $tdate = date('Y-m-d');

        $stmt = $pdo->prepare("
            insert into companyrecite(cid,amount,gst,total,billno,tdate) VALUES (:cid,:amount,:gst,:total,:billno,:tdate)
        ");

        $stmt->execute([
            ':cid' => $cid,
            ':amount' => $amount, 
            ':gst' => $gst,
            ':total' => $total,
            ':billno' => $billno,
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
        ':cballance' => $mybalance+$total,
    ]);




        header('Location: mainpage.php');
        return;
    }






?>
<!DOCTYPE html>
<html>
<head>
	<title>Anmol paridhan company recite</title>
	<link rel="stylesheet" type="text/css" href="allpagecss.css" />
</head>
<body>



<div class="login">
    <h1>Bill's Detail</h1>
    <form method="post">
        <input type="number" name="cid" placeholder="Enter Company Id" required="required" />
        <input type="text" name="billno" placeholder="Enter Company Bill No" required="required" />
        <input type="number" name="amount" placeholder="Enter Amount" required="required" />
        <button type="submit" class="btn btn-primary btn-large" style="width: 160px">Submit</button>
        <a href="mainpage.php"><button type="button" class="btn btn-primary btn-large" style="width: 130px" name="Cancel">Cancel</button></a>
    </form>
</div>


</body>
</html>