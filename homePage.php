<?php

require("connect.php"); //get database login info
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

<div class="img"></div>

    <header id="topNav">
    <nav>
        <ul>
            <li><a>Newsletter</a>
            <a>Client Access</a>
            <a>Advisors</a>
            <a>fr</a>
            
        </ul>
    </nav>
    </header>

    <header id="bottomNav" >
      <nav>
        <ul>
            <li><a>Contact US</a>
            <a>Invest</a>
            <a>FAQ</a>
            <a>About US</a>
            <a>Log In</a></li>
        </ul>
    </nav>

   
    <img src="./pics/PalarcheLogo.png" alt="Palarche Capital" id="logo">

</header>

<video id="vid" autoplay muted>
     <source  src="./pics/PalarcheCapitalWEB.mp4" type="video/mp4" >
 </video>

 <header>
  
</header>

<article>
    <h2 id="description"> We are a Canadian asset management fund guided by our five core values: </h2>
    <div class="blocks"><p>Do the right thing </p></div>
    <div class="blocks"><p>Put clients first </p></div>
    <div class="blocks"><p>Lead with exceptional ideas </p></div>
    <div class="blocks"><p>Commit to diversity and inclusion </p></div>
    <div class="blocks"><p>Give back to the Community </p></div>
    <div id=stats>
         <p id="info">random statistic</p>
         <p id="countUp"></p>
     </div>    
</article>









</body>
</html>