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



if (isset($_POST['cashdepo'])) 
    {
        $cashdepo = htmlentities($_POST['cashdepo']);
        $tdate = date('Y-m-d');

        $stmt = $pdo->prepare("
            insert into bankcash(cash,tdate) VALUES (:cid,:tdate)
        ");

        $stmt->execute([
            ':cid' => $cashdepo,
            ':tdate' => $tdate,
        ]);



$stmt1 = $pdo->prepare("
            SELECT balance from bank where accno=:accno
        ");


        $stmt1->execute([
        ':accno' => 410, 
    ]);

    $ballanceval = $stmt1->fetch(PDO::FETCH_OBJ);

    $mybalance = $ballanceval->balance;


     $stmt2 = $pdo->prepare("
            UPDATE bank set balance = :balance WHERE accno = :accno
        ");


        $stmt2->execute([
        ':accno' => 410, 
        ':balance' => $mybalance+$cashdepo,
    ]);



        header('Location: mainpage.php');
        return;
    }





?>

<!DOCTYPE html>
<html>
<head>
	<title>Anmol paridhan by cash entery</title>
	<link rel="stylesheet" type="text/css" href="allpagecss.css" />
</head>
<body>

    <div class="login">
    <h1>Amount Deposited</h1>
    <form method="post">
        <input type="number" name="cashdepo" placeholder="Enter Amount you depsite" required="required" />
        <button type="submit" class="btn btn-primary btn-large" style="width: 160px">Submit</button>

        <a href="mainpage.php"><button type="button" class="btn btn-primary btn-large" style="width: 130px" name="Cancel">Cancel</button></a>
<br><br>
         <a href="bankhistory.php" style="text-decoration: none"><button type="button" class="btn btn-primary btn-block btn-large"name="history">Show Bank History</button></a>
    </form>
</div>

</body>
</html>