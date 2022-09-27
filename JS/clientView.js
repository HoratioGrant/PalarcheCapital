
  
  
var edit=false;
function edit_table(){
    var table=document.getElementById("client_table");
    var editBtn=document.getElementById("edit");
    let collection=document.getElementsByClassName("view_inp");
    let btns=document.getElementsByClassName("hide");

   

    
    if(edit==false){
     
        for(let element of collection){
                element.removeAttribute("readonly");
        }
        for(let element of btns){
            element.style.visibility="visible";
    }
       
         
   table.style.border="solid";
   edit=true;
   editBtn.innerHTML = "cancel";
    document.getElementById("save").style.visibility ="visible";
    
 
    }else{
      
        for(let element of collection){
            element.readOnly=true;
    }
    for(let element of btns){
        element.style.visibility="hidden";
}
        edit = false;
       
        table.style.border="none";
        editBtn.innerHTML = "edit";
        document.getElementById("save").style.visibility ="hidden";
       document.location.reload();
        
    }
}


function add_Row(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var colCount = table.rows[0].cells.length +1;

    for(var i=0; i<colCount; i++) {

        var newcell	= row.insertCell(i);
        if(i==3){
            newcell.innerHTML = "<button type='button' > delete</button>";  
        }else if(i==0){
          newcell.innerHTML = "";  
        }
        
        //alert(newcell.childNodes);
        
    }
}

function delete_Row(pos){

   var table= document.getElementById("client_table");
    var usr = document.getElementById("name"+pos);s
   usr.setAttribute('value',pos+1);
   alert(usr.getAttribute('value'));
   table.deleteRow(pos+1);
    
}

function typeChosen(){
   var type= document.getElementById("reqType").value;
   var reqInfo= document.getElementById("reqInfo");
   console.log(type);
if(type){

document.getElementById("request_info").style.visibility="visible";
document.getElementById("form_send").style.visibility="visible";
}if(type=="Cancellation"){
    reqInfo.innerHTML="Reason :" 
}else{
    reqInfo.innerHTML="Amount :" 
}
}