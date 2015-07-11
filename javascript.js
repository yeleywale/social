
function handler(){                                                                 
    /*if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1)=="statistiche.php"){//serve solo per evidenziare nella pagina
        var z=document.getElementsByClassName("link_click");                                    //statistiche il primo link
        z[0].style.fontSize="120%";
        z[0].style.textDecoration="underline";
    }*/
}//	(flag, tabella, id)
function showEdit(flag,tabella,id_t,username){
	var x=document.getElementsByClassName("edit_bg");
	var y=document.getElementsByClassName("edit_container");
	var z=document.getElementsByName("i_salva");
	var z2=document.getElementsByName("i_cancella");
	var a=document.getElementById("i_img");
	z[0].setAttribute('onclick','updateVal('+"'"+tabella+"'"+','+id_t+','+"'"+username+"'"+','+false+')');
	z2[0].setAttribute('onclick','updateVal('+"'"+tabella+"'"+','+id_t+','+"'"+username+"'"+','+true+')');
	
	if(flag==false){
		x[0].style.display='none';
		y[0].style.display='none';
		a.style.display='none';
	}else{
		x[0].style.display='initial';
		y[0].style.display='initial';
		
	}

}
function cancellaUser(utente){
    var x=document.getElementById("semplice_div");
    x.innerHTML="<img style='margin-top: -11px;margin-left: 10px;' src='immagini/loading.gif'>";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    x.innerHTML='<img src="immagini/pending.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta">Questo utente &egrave; stato cancellato.</p>';
                }
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=11&u="+utente,true);
        xmlhttp.send();
}
function updateVal(tabella,id_t,username,flag){
    var y=document.getElementsByClassName("new_val")[0].value;                    //mi prendo il contenuto del commento
    document.getElementsByClassName("new_val")[0].value="Aggiungi un commento";   //rimpristino il valore della textarea al default
    if(controllaInput(y)==false && y!="Aggiungi un commento" || flag==true){
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var resp=xmlhttp.responseText;
					//alert(resp);
					document.getElementById("i_img").style.display='initial';
					setTimeout("location.reload(true);",2000);
                }
            }
			
			if(flag==false)//devo fare la modifica
            	xmlhttp.open("GET","ajax_controller.php?case=9&id_notizia="+id_t+"&valore="+y+"&tabella="+tabella+"&username="+username,true);
			else //devo cancellare
            	xmlhttp.open("GET","ajax_controller.php?case=10&id_notizia="+id_t+"&tabella="+tabella+"&username="+username,true);
			
			
            xmlhttp.send();
        }
    }else
        alert("Ops, commento contenente caratteri illegali o di lunghezze maggiori di 140 o inferiori a 1.");
}
function CambiaMessaggio(){
    var x=document.getElementById("messaggio_nuovo").value;
    var y=document.getElementById("messaggio");
    if(controllaInput(x))
        alert("Input errato");
    else{
        y.innerHTML=x;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1)=="notizie.php"){
                        location.reload();
                    }
                }
            }
            xmlhttp.open("GET","ajax_controller.php?case=2&messaggi="+x,true);
            xmlhttp.send();
        }
        x.value="";
    }
}

function aggiungiCommento(n,c){//('.$id_notizia.','.$c.')
    var y=document.getElementsByClassName("commento_area")[c].value;                    //mi prendo il contenuto del commento
    document.getElementsByClassName("commento_area")[c].value="Aggiungi un commento";   //rimpristino il valore della textarea al default
    if(controllaInput(y)==false && y!="Aggiungi un commento"){
        var x=document.createElement("div");            
        x.innerHTML=y;
        x.setAttribute("class","quadrato");                                             //dopo aver creato il div che contiene il commento 
        var z=document.getElementsByClassName("container_quadrato");                    //e assegnato la classe CSS ed il commento stesso
        z[c].appendChild(x);                                                            //appendo il figlio al padre dei commenti

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    x.innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","ajax_controller.php?case=1&id_notizia="+n+"&commento="+x.innerHTML,true);
            xmlhttp.send();
        }
    }else
        alert("Ops, commento contenente caratteri illegali o di lunghezze maggiori di 140 o inferiori a 1.");
}

function stampaCommenti(z){
    var x=document.getElementsByClassName("container_quadrato");
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var op=xmlhttp.responseText;
                x[z].innerHTML=op;
                if(z<x.length-1){
                  stampaCommenti(z+1);  
                }else  
                  stampaLikeRicevuti(0);
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=0&id="+z,true);
        xmlhttp.send();
    }
}//(1,'.$id_notizia.',this,'.$c.')
function stampaLikeRicevuti(z,c){
    var x=document.getElementsByClassName("like_count");
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var op=xmlhttp.responseText;
                x[c].innerHTML=op;
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=3&id="+z,true);
        xmlhttp.send();
    }
}//(1,'.$id_notizia.',this,'.$c.')
function functionLikeDislike(n,z,im_this,c){
    var x=document.getElementsByClassName("like_count");
    
    if(n==1 && im_this.getAttribute('src')==="immagini/like.png"){
        im_this.src="immagini/like_spento.png";
        var mm=document.getElementsByClassName("dislike_img");
        mm[c].src="immagini/dislike.png";
    }
    else if(n==-1 && im_this.getAttribute('src')==="immagini/dislike.png"){
        im_this.src="immagini/dislike_spento.png";
        var mm=document.getElementsByClassName("like_img");
        mm[c].src="immagini/like.png";
    }
    else return;
    
    x[c].innerHTML="<img style='margin-top: -11px;margin-left: 10px;' src='immagini/loading.gif'>";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               //alert(xmlhttp.responseText);
                    stampaLikeRicevuti(z,c);  
                }
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=4&id="+z+"&n="+n,true);
        xmlhttp.send();
}
function checkUsername(str){
    if (str.length==0) { 
        document.getElementById("txtHint").innerHTML="";
        return;
    } else {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				//alert(xmlhttp.responseText);
                document.getElementById("checku").innerHTML=xmlhttp.responseText;
				//alert(str);
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=8&q="+str,true);
        xmlhttp.send();
    }  
}
function checkPassword(){
    a=document.getElementById("password").value;
    b=document.getElementById("r_password").value;
    if(a==b)
         document.getElementById("checkp").innerHTML='<p style="color:green;">Le password corrispondono.</p>';
    else
        document.getElementById("checkp").innerHTML='<p style="color:red;">Le password non corrispondono.</p>';
    if(a.length<=4)
        document.getElementById("checkp").innerHTML='<p style="color:red;">Password troppo corta.</p>';
}
function showHint()
{
	var x=document.getElementsByName("c_search");
	var y=document.getElementsByName("c_result");
	var str=document.getElementById("txt1").value;
	if(x[0].checked)
		x=x[0].value;
	else
		x=x[1].value;
	if(y[0].checked)
		y=y[0].value;
	else
		y=y[1].value;
	
    if (str.length==0) { 
        document.getElementById("txtHint").innerHTML="";
        return;
    } else {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=5&q="+str+"&x="+x+"&y="+y,true);
        xmlhttp.send();
    }    
}
function inviaRichiesta(destinatario,mittente,im_this){
    var x=document.getElementById("semplice_div");
    x.innerHTML="<img style='margin-top: -11px;margin-left: 10px;' src='immagini/loading.gif'>";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    x.innerHTML='<img src="immagini/pending.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta">In attesa di conferma.</p>';
                }
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=6&d="+destinatario+"&m="+mittente,true);
        xmlhttp.send();
    
}//(".$c.",".$row['id_a'].","."1)
function managerRichieste(c,id,v){
    var x=document.getElementsByClassName("container_button_req");
    x[c].innerHTML="<img style='margin-top: -11px;margin-left: 10px;' src='immagini/loading.gif'>";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if(v==1)
                        x[c].innerHTML="<p>Richiesta d'amicizia accettata!</p>";
                    else
                        x[c].innerHTML="<p>Richiesta d'amicizia rifiutata!</p>";
                }
            }
        }
        xmlhttp.open("GET","ajax_controller.php?case=7&id="+id+"&v="+v,true);
        xmlhttp.send();
    
}

function controllaInput(stringa){
     var re = new RegExp("(--|!=|[|+=<>\(\)%\*])");
    return re.test(stringa) || stringa.length>140 || stringa.length==0;
           
}
function clearStat(){
	document.getElementsByClassName("descrizione")[0].removeChild(document.getElementsByClassName("tabella")[0]);
	document.getElementsByClassName("descrizione")[0].removeChild(document.getElementsByClassName("box_grafico")[0]);
}

