 
  var count=0.00;
  

window.onload = (event) => {
  window.scrollTo(2000,2000); //fixes glitchy scroll after clicking contact us
  window.scrollTo(0,0);
  var tnav=document.getElementById("topNav");
 var bnav = document.getElementById("bottomNav");    
  var CntBtn= document.getElementById("CntBtn");
  var AbtBtn= document.getElementById("AbtBtn");
  var des= document.getElementById("description");
     introVid=document.getElementById("vid");
     
     introCont=document.getElementById("vidDiv");

 if(window.innerWidth<1000){
  des.innerHTML="We are a private Canadian Asset Management Fund and our mandate is to help people achieve their financial goals";
  document.getElementById("body").style.overflowY="visible";
} 
setTimeout(function(){
if(introVid.paused){
    console.log("here");
    introVid.remove();
    introCont.remove();
    countup = setInterval(countUp, 25);
    document.getElementById("body").style.overflowY="visible";
   }else{
    document.getElementById("conbtn").style.animationDelay="4.75s";
    document.getElementById("description").style.animationDelay="4.75s";
   }
},725)

       introVid.onended = function(){
         document.getElementById("body").style.overflowY="visible";
           countup = setInterval(countUp, 25);
           introVid.remove();
           introCont.remove();
}
 
 

      
     

   
  var set=-1;    
     var change=true;

       document.addEventListener('scroll', scrollFunc)
  
        function scrollFunc(){

        
       var tnavPos=tnav.offsetHeight;
       var navPos=bnav.offsetTop;
      
      
          var res = navPos - document.documentElement.scrollTop - tnavPos;
         
          if (res<0&&change==true){
           reset;
           bnav.setAttribute("class", "top");
              
              set=document.documentElement.scrollTop
              console.log("DocTop "+document.documentElement.scrollTop);
              console.log("DocHieght"+document.documentElement.clientHeight);
              change=false;

              

          }else if (document.documentElement.scrollTop<set&&change==false){
            reset
            bnav.setAttribute("class", "bottom");
            change=true;
           }
          

       }

       
       function reset(e){
        bnav.style.top="";
        bnav.style.bottom="";
        bnav.style.left="";
        bnav.style.right="";
       }
  };


function countUp(){

//count = +count.toFixed(2);
Math.round(count)
 var num = document.getElementById("countUp");
 count=count+0.10;
num.innerHTML = count.toFixed(1)+"%";
if(count>23.6){
  clearInterval(countup);
}


}

      


