 
  var count=0.00;
  

window.onload = (event) => {
  window.scrollTo(top);
  var tnav=document.getElementById("topNav");
 var bnav = document.getElementById("bottomNav");    
  var CntBtn= document.getElementById("CntBtn");
  var AbtBtn= document.getElementById("AbtBtn");


  
 
     introVid=document.getElementById("vid");
       introVid.onended = function(){
         document.getElementById("body").style.overflowY="visible";
        
           introVid.remove();
          
            countup = setInterval(countUp, 25);

          
       }

      
      

   
  var set=-1;    
     var change=true;

       document.addEventListener('scroll', function(e){
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
          

       })

       
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
if(count>23){
  clearInterval(countup);
}


}

      


