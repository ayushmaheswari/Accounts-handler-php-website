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


   	
   	$stmt1 = $pdo->prepare("
            SELECT balance from bank where accno=:cid
        ");

        $stmt1->execute([
        ':cid' => 410, 
    ]);

    $ballanceval = $stmt1->fetch(PDO::FETCH_OBJ);


    



    $stmt3 = $pdo->prepare("
            SELECT cheque.chequeid, company.cname,cheque.amount, cheque.tdate from cheque INNER JOIN company ON cheque.cid=company.cid;
        ");

        $stmt3->execute([
        
    ]);

    
    while ( $row = $stmt3->fetch(PDO::FETCH_OBJ) ) 
    {
        $cheque[] = $row;
    }






    $stmt4= $pdo->prepare("
            SELECT ebank.ebankid, company.cname,ebank.amount, ebank.tdate from ebank INNER JOIN company ON ebank.cid=company.cid;
        ");

        $stmt4->execute([
        
    ]);

     
    while ( $row = $stmt4->fetch(PDO::FETCH_OBJ) ) 
    {
        $ebank[] = $row;
    }






$stmt5 = $pdo->prepare("
            SELECT cash, tdate from bankcash
        ");

        $stmt5->execute([
    ]);

   
   while ( $row = $stmt5->fetch(PDO::FETCH_OBJ) ) 
    {
        $cash[] = $row;
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
	<h3 style="color:#ffa500">Bank Accounts History</h3><br>

	  





<h4 style="color:#ffa500">Amount Deposite By Cash </h4>



<div class="list"> 

<table class="table table-condensed"style="margin-left : 5%; color: #ffa500">
                <thead>
                  <tr>
                    <th>Cash deposite</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($cash as $comp) : ?>
                                <tr>
                      
                      <td>           
                          <?php echo $comp->cash ?>
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
                    <th>Company name</th>
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
                          <?php echo $comp->cname ?>
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
                    <th>company Name</th>
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
                          <?php echo $comp->cname ?>
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




	
	<h1 style="color: #ffa500">Total :- <?php echo $ballanceval->balance;?></h1>

  <a href="mainpage.php" style="text-decoration: none ;text-align: center; color:#ffa500"><h2>Done Go Back</h2>

</body>
</html>






