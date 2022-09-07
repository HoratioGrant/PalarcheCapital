function preventBack() {
    window.history.forward(); 
}
  
setTimeout("preventBack()", 0);
  
window.onunload = function () { null };
function show(){
   
    var ps=document.getElementById("password_inp");
    var eye=document.getElementById("eye");
  
    if(eye.className=="blind"){
        eye.src = "https://i.ibb.co/DzWD570/pass-Eye-see.png";
        eye.className="see";
        ps.type="text"
    }else{
        eye.src = "https://i.ibb.co/VJMmgqD/hidden.png";
        eye.className="blind";
        ps.type="password"
    }
  }