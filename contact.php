<?php
ob_start();
require("connect.php"); //get database login info
define ("MAX_NAME_LENGTH", 20);
define ("MAXIMUM_EMAIL_LENGTH", 255);
define ("MAXIMUM_MESSAGE_LENGTH", 255);

if($_SERVER['REQUEST_METHOD']=="POST"){
    $error="";
    $dbConn = new PDO("mysql:host = $hostname; dbname=$dbname",$user,$password);
  
    //captured info
    $name=trim($_POST['input_name']);
    $email=trim($_POST['input_email']);
    $message=trim($_POST['input_message']);
    $date = date("Ymd");

    //validatoin
    if(empty($email)){
        $error="Email is Empty <br>";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error.="Invalid email format <br>";
       } else if (strlen($email)>MAXIMUM_EMAIL_LENGTH){
        $error.="Email is too long <br>";
       }
    if(empty($name)){
        $error="Message is empty";
    }else if (strlen($name)>MAX_NAME_LENGTH){
        $error.="First name cannot be longer than 20 characters <br>";
      }
    if(empty($message)){
        $error="Message is empty";
    }else if (strlen($message)>MAXIMUM_MESSAGE_LENGTH){
        $error.="First name cannot be longer than 20 characters <br>";
      }
    


    if($error==""){
    try{
        mail("granthoratio@gmail.com","NEW Contact Request",$msg);
        $command="INSERT INTO contactusmessages (email,UserName,UserMessage,createdON ) VALUES(?,?,?,?)";
        $stmt= $dbConn->prepare($command);
        $execOk = $stmt->execute(array($email,$name,$message,$date));

        $msg = "TEST from website";

        $msg = wordwrap($msg,70);

      
        
    }catch (PDOException $e){

    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/css.css">
</head>
<body>
    
<div class="imgcnt">

</div>
<header id="topNav">
    <nav>
        <ul>
            <a><li>Newsletter</a>
            <a><li>Client Access</a>
            <a><li>Advisors</a>
            <a><li>fr</li></a>
            
        </ul>
    </nav>
    </header>

    <header id="bottomNav" class="top" >
      <nav>
        <ul>
        <a href="homePage.php"><li>Home</li></a>
        <a><li>Invest</li></a>
        <a><li>FAQ</li></a>
        <a><li> About US</li></a>
         <a><li>Log In</li></a>
        </ul>
           <img src="https://i.ibb.co/829b5MH/Palarche-Logo.png" alt="Palarche Capital" id="logo">
    </nav>

    <article class="title">
        <h1 >Contact us</h1>
        <h2  id="info">For all information requests, please complete the form below. We will contact you within 2 business days.
Clients are invited to write to the dedicated email address:</h2>
    </article>

    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">

            <div>
                
                <input class="inp" type="text" name="input_name" placeholder="Full Name">
            </div>
             <div>
             
                <input class="inp" type="text" name="input_email" placeholder="Email">
            </div>
            <div>
               
                <input class="inp" type="text" name="input_message" placeholder="Message">
            </div>
            <div>
                <input class="sub" type="submit" value="Submit">
                
            </div>
      </article>

</form>
</body>
</html>