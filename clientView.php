<?php
session_start();
require("./Server_Info/check.php");
$userId;
if(!isset($userId)){
    session_start();
$userId=$_SESSION["id"];
$username=$_SESSION["username"];
}


if(empty($username)){
    header("Location: clientAccess.php");
    exit();
}

try{
    
    $dbConn = new  
    PDO("mysql:host=$hostname;dbname=$dbname",     
    $user, $password);

if($username=="admin"){
    $command = "select * from client_list order by userName";
  
}else{
    $command = "select * from client_list where userName ='$username'";
}

$stmt = $dbConn->prepare($command);
$execOK = $stmt->execute();
$x=0;
$output="";


//If Admin Edits
if($_SERVER['REQUEST_METHOD']=="POST"){
    $error="";  
  //need Validation
  
  if(empty($error)){
      $x=0;
   
     
     
      while($row= $stmt->fetch()){//update
          $SQL_balance=$row['balance'];
          $SQL_user=$row['userName'];
          $POST_balance=$_POST['balance'.$x];
          $POST_user=$_POST['name'.$x];
          
          if(is_numeric($POST_user)){//check delete
  
              $deleteCmd="delete from client_list where userName=''";
              $stmt3 = $dbConn->prepare($deleteCmd);
              $execOK3 = $stmt3->execute();
              header("Refresh:0");
          }elseif($SQL_user!=$POST_user||$SQL_balance!=$POST_balance){//check update
            
              $updateCmd="update client_list set userName='$POST_user', balance='$POST_balance' where userName='$SQL_user'";
              $stmt2 = $dbConn->prepare($updateCmd);
              $execOK2 = $stmt2->execute();
              header("Refresh:0");
             
          }
          $x++;
     }  
  }
     
  }



while($row= $stmt->fetch()){
     $balance=$row['balance'];
     $user=$row['userName'];
     
    
     $output.="<tr><td> <input class='view_inp' readonly name='name$x' id='name$x' value='$user'></td><td><input class='view_inp' readonly name='balance$x' value='$balance'></td><td class='hide'><button type='button' onclick='delete_Row($x)'> delete</button></td></tr>";
     
     $x++;
}
$edit="";
if($username=="admin"){
    $edit="<button id='edit' type='reset' onclick='edit_table()'>edit</button>";
}
   

}catch(PDOException $e){
   $output.="<tr><td>Error Retrieving Information</td></tr>";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palarche Capital | Dashboard</title>
    <link rel="stylesheet" href="./CSS/client.css">
    <script src="./JS/clientView.js"></script>
</head>
<body id="viewBody">


    
<nav id="bottomNav" class="bottom">
          <a href="homePage.php"><img src="https://i.ibb.co/829b5MH/Palarche-Logo.png" alt="Palarche Capital" id="logo"></a> 
    <button id="signOut">Sign Out</button>
        </nav>

<header>
    <h1 id="welcome">Welcome Back, <?= $username ?>  
    
</header>

<section>
    <h3 id="acc">
        Account Info
    </h3>
    <div >
  
        <div id="viewBox">
            <form action="<?=$_SERVER['PHP_SELF']?>" id="tab" method="POST" >
                
                <table id="client_table" contenteditable='false'>
                    <tr> <th>Name</th><th>Balance</th></tr>
                    <?=$output?>
                    <div id="add"></div>
                  
                </table>
                <button type="button" class="hide" onclick="add_Row('client_table')">add</button>
        </div>
    </div>
       <?=$edit?>
        <input type="submit" value="save" id="save">
</form> 
</section>


</body>
</html>