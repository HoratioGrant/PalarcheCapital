<?php
require("./Server_Info/check.php"); //get database login info
  $error="";
if($_SERVER['REQUEST_METHOD']=="POST"){
  
    

    $username=trim($_POST['username']);
    $pass=trim($_POST['password']);
    
    try{
         
        $dbConn = new PDO("mysql:host = $hostname; dbname=$dbname",$user,$password);
         
        $allUser="select * from client_list order by userName";
      
        $stmt = $dbConn->prepare($allUser);
        $execOK= $stmt->execute();

        while($row = $stmt->fetch()){
               
            if($username==$row['userName']){
                 
                if($pass==$row['passWord']){
                    session_start();
                    $_SESSION["id"]=$row['clientId'];
                    $_SESSION["username"]=$username;
                    header("Location: clientView");
                    exit();
                }else{
                    $error="Incorrect Password";
                }
            }
        }
        $error="Login information incorrect";
        
    }catch(PDOException $e){
        $error="Cannot connect to Server";
    }


    

}
?>
<!DOC
TYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palarche Capital | Sign In</title>
    <link rel="stylesheet" href="./CSS/client.css">
    <script src="./JS/client.js"></script>
</head>
<body id="accessBody">


      <nav id="bottomNav" class="bottom">
          <a href="/"><img src="https://i.ibb.co/829b5MH/Palarche-Logo.png" alt="Palarche Capital" id="logo"></a> 
    </nav>
<article>
    <div id="box"> 
        <h1>Sign In</h1>
   

        <form action="" autocomplete="off" method="POST" >
            <div>
             <input class="inp" type="text" name="username"  placeholder="Username"> 
         </div>
         <div>
            
               <input class="inp" id="password_inp" type="password" name="password"  placeholder="Password"> 
               <img class="blind" id="eye"src="https://i.ibb.co/VJMmgqD/hidden.png" alt="" onclick="show()">
         </div>
            <div>
               <input class="sub" type="submit" value="Log In"> 
            </div>
        

        </form>

        <p id="error message"><?= $error ?></p>
    </div>
    
</article>

<footer>
<p><?php include('./text/clientFooter.txt')?></p>
</footer>




</body>
</html>