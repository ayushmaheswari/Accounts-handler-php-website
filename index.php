<?php

session_start();
error_reporting(0);
if ( isset($_POST['userid']) && isset($_POST['password']) ) 
{
   
    $password = htmlentities($_POST['password']);
    $userid = htmlentities($_POST['userid']);

    try 
    {
        require_once "mypdo.php";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
        die();
    }

    $stmt = $pdo->prepare("
        SELECT * FROM myuser 
        WHERE userid = :userid AND password = :password
    ");

    $stmt->execute([
        ':userid' => $userid, 
        ':password' => $password, 
    ]);

    $row = $stmt->fetch(PDO::FETCH_OBJ);

    if ($row !== false) 
    {
        //error_log("Login success ".$email);
        $_SESSION['userid'] = $row->userid;
        header("Location: mainpage.php");
        return;
    }

    error_log("Login fail ".$pass." $check");
    $_SESSION['failure'] = "Incorrect password";

    header("Location: index.php");
    return;

}

?>
<html>
<head>
<meta charset="utf-8">
<title>Anmol Paridhan</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div class="login">
    <h1>Anmol Paridhan</h1>
    <form method="post">
        <input type="text" name="userid" placeholder="Username" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" style="font-size: 20px ">Login</button>
    </form>
</div>
</body>
</html>