
  var count=0.00;
window.onload = (event) => {
  
  
 
     introVid=document.getElementById("vid");
       introVid.onended = function(){
         document.getElementById("body").style.overflowY="visible";
        
           introVid.remove();
            countup = setInterval(countUp, 25);

          
       }

var tnav=document.getElementById("topNav");
 var bnav = document.getElementById("bottomNav");       
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
num.innerHTML = count.toFixed(1)+"%";
count=count+0.10;
if(count>11){
  clearInterval(countup);
}

}
      


