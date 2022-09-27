<?php

require("./Server_Info/connect.php"); //get database login info

//max Size of inputs
define ("MAX_NAME_LENGTH", 20);
define ("MAXIMUM_EMAIL_LENGTH", 255);
define ("MAXIMUM_MESSAGE_LENGTH", 255);

if($_SERVER['REQUEST_METHOD']=="POST"){//when form is submitted
    $error="";//tracks any error msgs
    $dbConn = new PDO("mysql:host = $hostname; dbname=$dbname",$user,$password);//new DB connection
  
    //captured info
    $name=trim($_POST['input_name']);
    $email=trim($_POST['input_email']);
    $message=trim($_POST['input_message']);
    $date = date("Ymd");

    //validation
    if(empty($email)){//checks if email is empty
        $error="Email is Empty <br>";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){//check if email is proper format
        $error.="Invalid email format <br>";
       } else if (strlen($email)>MAXIMUM_EMAIL_LENGTH){//checks if email is not too long
        $error.="Email is too long <br>";
       }
    if(empty($name)){//checks that name isnt empty
        $error="Message is empty";
    }else if (strlen($name)>MAX_NAME_LENGTH){//makes sure is name isnt too long
        $error.="First name cannot be longer than 20 characters <br>";
      }
    if(empty($message)){//check to see if message is empty
        $error="Message is empty";
    }else if (strlen($message)>MAXIMUM_MESSAGE_LENGTH){//makes sure message isnt too long
        $error.="First name cannot be longer than 20 characters <br>";
      }
    


    if($error==""){//only runs if all inputs were valid
    try{
       
        $command="INSERT INTO ContactUsMessages (email,UserName,UserMessage,createdON ) VALUES(?,?,?,?)"; //insert message to inputs user message to Contact message table
        $stmt= $dbConn->prepare($command);
        $execOk = $stmt->execute(array($email,$name,$message,$date));//inputs request 

        
    }catch (PDOException $e){

    }
}
header("Refresh:0");//refreshes page
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PalarcheCapital</title>
    <link rel="stylesheet" href="./CSS/css.css">
    <script src="./JS/display.js"></script>
</head>


<body id="body">

<!-- HomePage Page-->
<div id="fake-body">
<div class="img"></div>
</div>
    <header id="topNav">
    <nav>
        <ul>
           
            <a  target="_blank"href="clientAccess"> <li>Client Access</li></a>
            <a> <li>Advisors</li></a>
          
            
        </ul>
    </nav>
    </header>

    <header  >
      <nav id="bottomNav" class="bottom">
        <ul>
        <a id="AbtBtn" href="#AboutUsPart"><li> About US</li></a>
        <a id="CntBtn" href="#contactPart"><li>Contact US</li></a>
        <a><li>Invest</li></a>
        
         
        </ul>
           <img src="https://i.ibb.co/X4gzRrN/Palarche-Logo.png" alt="Palarche Capital" id="logo">
    </nav>
   </header> 
   <!-- Video  -->
   <div id="vidDiv">

<video id="vid" autoplay muted >
     <source  src="./pics/PalarchCapitalWEB_Fast.mp4" type="video/mp4" >

    
 </video>
 
</div>


<article>
    <h2 id="description"> <?php include('./text/Identity_Statement.txt')?> </h2>
    
    <div id=stats class="info center">
         <p >ANNUALIZED RETURNS SINCE <br>JUNE 2022 </p>
         <p id="countUp"></p>
     </div>    
</article>

<!-- About Page-->

<article class=" aboutUs" id="AboutUsPart">
    <h2 class=" title" > About Us</h2>
    <h3 class="info about " ><?php include('./text/aboutUs.txt')?></h3><br>
    <img id="stockPic"src="https://i.ibb.co/F5MJ0LH/stockPic.jpg" alt="">
    
    
</article>

<!-- contact Page-->

<article class="contact" >
        <h2 class="title" id="contactPart" >Contact us</h2 >
      
        <h3 class="info cnt">For all information requests, please complete the form below. We will contact you within 5 business days.
                Clients are invited to write to the dedicated email address</h3>
        </div>        
    <form  action="" method="POST" autocomplete="off" >


    <div class="grid-container " >
        <div class="grid-item center">
            <input class="inp" type="text" name="input_name" placeholder="Full Name">
        </div>
        <div class="grid-item center">             
            <input class="inp" type="text" name="input_email" placeholder="Email">
        </div>
        <div class="grid-item center" >
             <input class="inp" type="text" name="input_message" placeholder="Message">
        </div>
        
  <div class="below center">
            <input class="sub " type="submit" value="Submit">              
        </div>
</form>

<img id="contactPic"src="https://i.ibb.co/8xxywzs/chair.jpg" alt="">
    </article>







</body>
</html>



