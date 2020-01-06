<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['userid'])) {
        die("ACCESS DENIED");
    }

    try 
  {
      require_once "mypdo.php";
      $all_profiles = $pdo->query("SELECT * FROM company");

    while ( $row = $all_profiles->fetch(PDO::FETCH_OBJ) ) 
    {
        $profiles[] = $row;
    }
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
	<title>Anmol Paridhan Main Page</title>
	<link rel="stylesheet" type="text/css" href="mainpagecss.css" />
  <link rel="stylesheet" type="text/css" href="part2css.css" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>



<div class="list"> 

<table class="table table-condensed"style="margin-left : 5%; color: #ffa500">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Ballance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($profiles as $profile) : ?>
                                <tr>
                                  <td>                                   
                                      <?php echo $profile->cid?>
                                  </td>
                      
                      <td>

                        <a href="view.php?cid=<?php echo $profile->cid; ?>" style="color: #ffa500;">
                          <?php echo $profile->cname ?>
                        </a>
                    </td>


                    <td>
                       <?php echo $profile->cballance ?>
                      </td>
                    </tr>
                            <?php endforeach; ?>
                </tbody>
              </table>

</div>



<div class="maindiv">

	<a href="bycheque.php"><div class="div2"><p class="textal">Pay By Cheque</p> </div> </a>
	<a href="companyrecite.php"><div class="div1"><p class="textal">Add Company Bill's</p></div> </a>
	<a href="byebanking.php"><div class="div4"><p class="textal">Pay By E-banking</p> </div> </a>
  <a href="bycash.php"><div class="div3"><p class="textal">Pay By Cash</p></div> </a>

</div>


<div class="lastdiv1">

<a href="company.php"><div class="ldiv1"><p class="text1">Add company</p></div></a>
<a href="mybank.php"><div class="ldiv2"><p class="text1">Bank Detail's</p></div></a>
<a href="regularacc.php"><div class="ldiv3"><p class="text1">Daily Expense</p></div></a>


</div>

<a href="logout.php"> <div class="logout"> <p id="one"> Logout </p> </div> </a>



</body>
</html>