<?php
session_start();
require("./Server_Info/check.php");
$userId;
$username;
$error="";
if(!isset($username)){
    
$userId=$_SESSION["id"];
$username=$_SESSION["username"];
}


if(empty($username)){
    header("Location: clientAccess");
    exit();
}

try{
    
    $dbConn = new  
    PDO("mysql:host=$hostname;dbname=$dbname",     
    $user, $password);

    if($username=="aundre.palarche"){
        $getClientAdmin = "select * from client_list order by clientId";
        $client_stmt_Admin = $dbConn->prepare($getClientAdmin);
        $client_Admin = $client_stmt_Admin->execute();
    }

    $getClient = "select * from client_list where clientId ='$userId'";
    $getAccount = "select * from accounts_list where clientId ='$userId'";
    $getTransActions = "select * from client_requests where clientId ='$userId' order by requestNumber";
    

$client_stmt = $dbConn->prepare($getClient);
$account_stmt = $dbConn->prepare($getAccount);
$requests_stmt = $dbConn->prepare($getTransActions);
$clients = $client_stmt->execute();
$accounts = $account_stmt->execute();
$requests = $requests_stmt->execute();
$x=0;
$output="";
$total=0;
while($client_row= $client_stmt->fetch()){

    
$user=$client_row['userName'];
while($request_row= $requests_stmt->fetch()){
    $reqType=$request_row['requestType'];
    $reqInfo=$request_row['info'];
    $reqStatus=$request_row['requestStatus'];
         $reqOut.="<tr>
         <td> $reqType</td>
         <td> $reqInfo</td>
         <td> $reqStatus</td>
         </tr>";
         
}
    if($username=="aundre.palarche"){
        $output.="<tr><td> <input class='view_inp' readonly name='accountNumber$x' id='name$x' value='$user'></td></tr>";
    }
    while($account_row= $account_stmt->fetch()){
        $balance=$account_row['balance'];
        $total+=$balance;
        $balance=number_format($balance, 2, '.', ',');
        $type=$account_row['type'];
        $accountNumber=$account_row['accountNumber'];
             $output.="<tr>
             <td> <input class='view_inp' readonly name='accountNumber$x' id='name$x' value='$type $accountNumber'></td>
             <td id='balance_d'><input class='view_inp balance_data' readonly name='balance$x' value='$ $balance'></td>
             <td class='hide'><button type='button' onclick='delete_Row($x)'> delete</button></td>
             </tr>";
             
    }
    if($username=="aundre.palarche"){
    $userId=$client_stmt_Admin->fetch()["clientId"]+1;
    $getClient = "select * from client_list where clientId ='$userId'";
    $getAccount = "select * from accounts_list where clientId ='$userId'";
    $client_stmt = $dbConn->prepare($getClient);
    $account_stmt = $dbConn->prepare($getAccount);
    $clients = $client_stmt->execute();
    $accounts = $account_stmt->execute();  
    }


   
     $x++;
}
$edit="";
if($username=="aundre.palarche"){
    $edit="<button id='edit' type='reset' onclick='edit_table()'>edit</button>";
}
   


}catch(PDOException $e){
   $output.="<tr><td>Error Retrieving Information</td></tr>";
}
$total=number_format($total, 2, '.', ',');

if($_SERVER['REQUEST_METHOD']=="POST"){
    $type= $_POST['request_Type'];
    $info=$_POST['request_info'];
    
        //validation
        if($type=="Cancellation"){
            if(empty($info)){
                
                $error="Reason Cannot be Empty";
            }
            else if(is_numeric($info)){
                
                $error="Reason cannot be a number";

            }
        }else{
            if(empty($info)){
                
                $error="Amount cannot be empty";

            }else if(!is_numeric($info)){
                
                $error="Amount must be a number";

            }else if($info<0){
                
                $error="Amount must be above 0";
            }
        }
        if(!$error){
            try{
       
                $newReq="INSERT INTO client_Requests (requestNumber,clientId,requestStatus,requestType,info ) VALUES(?,?,?,?,?)";
                $bob= $dbConn->prepare($newReq);
                $execOk10 = $bob->execute(array(null,$userId,"pending",$type,$info));
        
                
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
    <title>Palarche Capital | Dashboard</title>
    <link rel="stylesheet" href="./CSS/client.css">
    <script src="./JS/clientView.js"></script>
</head>
<body id="viewBody">


    
<nav id="bottomNav" class="bottom">
          <a href="/"><img src="https://i.ibb.co/829b5MH/Palarche-Logo.png" alt="Palarche Capital" id="logo"></a> 
    <button id="signOut"><a href="clientAccess">Sign Out</a></button>
        </nav>

<header class="view_header">
    <h1 id="welcome">Welcome Back, <?= $username ?>  </h1>
    <div id="total_area">
        <p id="total">Total:</p>
       <p>$<?=$total?> </p> 
    </div>
    
</header>

<section>
    
    <div >
  
        <div id="viewBox">
            <form action="<?=$_SERVER['PHP_SELF']?>" id="tab" method="POST" name="client_list" autocomplete="off">
                
                <table id="client_table" contenteditable='false'>
                    <tr> <th>Account Info</th><th></th></tr>
                    <?=$output?>
                    <div id="add"></div>
                  
                </table>
                <button type="button" class="hide" onclick="add_Row('client_table')">add</button>
        <!--  <?=$edit?>-->
          </div> 
         
    </div>

        <input type="submit" value="save" id="save">  
</form> 
</section>

<aside>
<form action="<?=$_SERVER['PHP_SELF']?>"method="POST" id="request_form" name="requestFrom" autocomplete="off">
    <h3>Request a Withdrawl, Deposit or Account Cancellation</h3>
    <div id="request_Type">
        <label for="request_Type">Type of Request :</label>
        <select name="request_Type" class="request_inp" id="reqType"onclick='typeChosen()'> 
            <option disabled selected value> -- select an option -- </option>
            <option value="Withdraw">Withdraw</option>
             <option value="Deposit">Deposit</option>
            <option value="Cancellation">Account Cancellation</option>
        </select>
   </div> 
   <div id="request_info">
        <label id="reqInfo"for="request_info">Amount :</label>
        <input class="request_inp" type="text" name="request_info" >
    </div>
    <div id="form_send">
       <input type="submit" value="send" id="reqSumbit"> 
    </div>
    <p id="errorMSG"><?=$error?></p>
    
</form >

<div id="transaction-history">
    <h2>Transactions</h2>
    <table>
        <tr><th>Request Type</th><th>Amount</th><th>Status</th></tr>
        <?=$reqOut ?>
    </table>

</div>
</aside>

<footer >
    <p >Account information updated daily. If you think there is a mistake please contact us at aundre.palarche@gmail.com</p>
</footer>

</body>
</html>