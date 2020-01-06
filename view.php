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

if (isset($_REQUEST['cid']))
{

    $cid = htmlentities($_REQUEST['cid']);
   	
   	$stmt1 = $pdo->prepare("
            SELECT cname,cballance from company where cid=:cid
        ");

        $stmt1->execute([
        ':cid' => $cid, 
    ]);

    $ballanceval = $stmt1->fetch(PDO::FETCH_OBJ);

    $cname = $ballanceval->cname;
    $cname = ucfirst($cname);




$stmt2 = $pdo->prepare("
            SELECT billno, total, tdate from companyrecite where cid=:cid
        ");

        $stmt2->execute([
        ':cid' => $cid, 
    ]);

    while ( $row = $stmt2->fetch(PDO::FETCH_OBJ) ) 
    {
        $companyrecite[] = $row;
    }




    $stmt3 = $pdo->prepare("
            SELECT chequeid, amount, tdate from cheque where cid=:cid
        ");

        $stmt3->execute([
        ':cid' => $cid, 
    ]);

    
    while ( $row = $stmt3->fetch(PDO::FETCH_OBJ) ) 
    {
        $cheque[] = $row;
    }






    $stmt4= $pdo->prepare("
            SELECT ebankid, amount, tdate from ebank where cid=:cid
        ");

        $stmt4->execute([
        ':cid' => $cid, 
    ]);

     
    while ( $row = $stmt4->fetch(PDO::FETCH_OBJ) ) 
    {
        $ebank[] = $row;
    }






$stmt5 = $pdo->prepare("
            SELECT amount, tdate from cash where cid=:cid
        ");

        $stmt5->execute([
        ':cid' => $cid, 
    ]);

   
   while ( $row = $stmt5->fetch(PDO::FETCH_OBJ) ) 
    {
        $cash[] = $row;
    }




    


}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Anmol paridhan view detail's</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body style="background-color: black">
	<h3 style="color:#ffa500"><?php echo $cname ?> Accounts History</h3><br>

	<h4 style="color:#ffa500">List of Company Bill's</h4>


	<div class="list"> 

<table class="table table-condensed"style="margin-left : 5%; color: #ffa500">
                <thead>
                  <tr>
                    <th>Bill NO</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($companyrecite as $comp) : ?>
                                <tr>
                                  <td>                                   
                                      <?php echo $comp->billno?>
                                  </td>
                      
                      <td>           
                          <?php echo $comp->total ?>
                    </td>


                    <td>
                       <?php echo $comp->tdate ?>
                      </td>
                    </tr>
                            <?php endforeach; ?>
                </tbody>
              </table>

</div>


	




<br>



<h4 style="color:#ffa500">Amount Deposite By Cheque </h4>



<div class="list"> 

<table class="table table-condensed"style="margin-left : 5%; color: #ffa500">
                <thead>
                  <tr>
                    <th>Cheque Id</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($cheque as $comp) : ?>
                                <tr>
                                  <td>                                   
                                      <?php echo $comp->chequeid?>
                                  </td>
                      
                      <td>           
                          <?php echo $comp->amount ?>
                    </td>


                    <td>
                       <?php echo $comp->tdate ?>
                      </td>
                    </tr>
                            <?php endforeach; ?>
                </tbody>
              </table>

</div>

	


<br>




	<h4 style="color:#ffa500">Amount Pay By E-Banking</h4>


	<div class="list"> 

<table class="table table-condensed"style="margin-left : 5%; color: #ffa500">
                <thead>
                  <tr>
                    <th>E-Bank Id</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($ebank as $comp) : ?>
                                <tr>
                                  <td>                                   
                                      <?php echo $comp->ebankid?>
                                  </td>
                      
                      <td>           
                          <?php echo $comp->amount ?>
                    </td>


                    <td>
                       <?php echo $comp->tdate ?>
                      </td>
                    </tr>
                            <?php endforeach; ?>
                </tbody>
              </table>

</div>


	




<br>



<h4 style="color:#ffa500">Amount Deposite By Cash </h4>



<div class="list"> 

<table class="table table-condensed"style="margin-left : 5%; color: #ffa500">
                <thead>
                  <tr>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($cash as $comp) : ?>
                                <tr>
                      
                      <td>           
                          <?php echo $comp->amount ?>
                    </td>


                    <td>
                       <?php echo $comp->tdate ?>
                      </td>
                    </tr>
                            <?php endforeach; ?>
                </tbody>
              </table>

</div>

	
	<h1 style="color: #ffa500">Total :- <?php echo $ballanceval->cballance;?></h1>

  <a href="mainpage.php" style="text-decoration: none ;text-align: center; color:#ffa500"><h2>Done Go Back</h2>

</body>
</html>






