<div id="container_box_news">
<div class="edit_bg" style="display: none;"></div>
<div class="edit_container" style="display:none;">
	<div id="top_editor">Effettua le modifiche neccessarie tramite questo box.<a href="#" onClick="showEdit(false)"><img style="float:right;margin-top:0px!important;" src="immagini/x.png" alt="immagini/no_image.png"></a></div>
	<textarea class="new_val" cols="91" rows="10" onfocus="if(this.value == 'Aggiungi un commento') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Aggiungi un commento'; }">Aggiungi un commento</textarea>
	<input name="i_salva" type="submit" value=" Salva le modifiche " onclick="">
	<input name="i_cancella" type="submit" value=" Cancella il contenuto " onclick="" style="background-color: #c33030;border-color:#c33030;">
	<img id="i_img" src="immagini/conferma_modifiche.png" alt="immagini/no_image.png">
</div>
<?php
$conn=dbConnect(); //
$utente=$_SESSION['login_username'];
$sql="SELECT * from messaggi_stato,users where (messaggi_stato.username in (SELECT user2 from amicizie a1 where (a1.user1='".$utente."' and a1.stato=1) UNION SELECT user1 from amicizie a1 where (a1.user2='".$utente."' and a1.stato=1)) || messaggi_stato.username='".$utente."') and messaggi_stato.username=users.username and messaggi_stato.visibile=1 order by messaggi_stato.data DESC";
if($utente=="admin"){
	$sql="Select * from messaggi_stato m1 join users u1 on m1.username=u1.username and m1.visibile=1 order by data DESC";
}
$result = $conn->query($sql);
$c=-1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id_notizia=$row["id_notizia"];
        $notizia=$row["notizia"];
        $nome_completo=$row["nome_completo"];
        $data=$row["data"];
        $like=$row["likeC"];
        $foto=$row["immagine_grande"];
        //$url=$row["url"];
        $username=$row["username"];
        $c++;
        
        $data1 = new DateTime($data);
        $data2 = new DateTime('NOW');
        $interval = $data1->diff($data2);
        
        if($interval->h==0 && $interval->i==0)
            $data='Pochi secondi fa';
        elseif($interval->h==0 && $interval->m==0 && $interval->d==0){
            $data=$interval->i.' minuti fa';
            if($interval->i==1)
                $data=$interval->i.' minuto fa';
        }
        elseif($interval->h!=0 && $interval->m==0 && $interval->d==0){
            $data=$interval->h.' ore fa';
            if($interval->h==1)
                $data=$interval->h.' ora fa';
        }
        elseif($interval->m==0 && $interval->d!=0){
            $data=$interval->d.' giorni fa';
            if($interval->d==1)
                $data=$interval->d.' giorno fa';
        }
        elseif($interval->m!=0){
            $data=$interval->m.' mesi fa';
            if($interval->m==1)
                $data=$interval->m.' mese fa';
        }
        else
            $data="Data sconosciuta";
		$sql="Select * from social_network_like where id_notizia='".$id_notizia."' and username='".$utente."'";
		$resultI = $conn->query($sql);
		$like_val=0;
		if ($resultI->num_rows != 0) {
			while($rowI = $resultI->fetch_assoc()) {
				$like_val=$rowI['likeC'];
			}
		}
        ?><div class="box_news">
						
                        <div class="foto_news">
                            <img <?php echo 'src="immagini/'.$foto.'" '; ?> alt="immagini/no_image.png">
                        </div>
                        <div class="like_box">
                            <div class="like_count"><?php echo $like; ?></div>
                            <img  class="like_img" style="cursor:pointer;" <?php echo 'onClick="functionLikeDislike(1,'.$id_notizia.',this,'.$c.');"' ?> <?php if($like_val==1){ echo 'src="immagini/like_spento.png"'; }else{ echo 'src="immagini/like.png"'; } ?> alt="immagini/no_image.png">
                            <img  class="dislike_img" style="cursor:pointer;" <?php echo 'onClick="functionLikeDislike(-1,'.$id_notizia.',this,'.$c.');"' ?> <?php if($like_val==-1){ echo 'src="immagini/dislike_spento.png"'; }else{ echo 'src="immagini/dislike.png"'; } ?> alt="immagini/no_image.png">
                        </div>
                        <div class="nome_news">
                            <?php if($username==$_SESSION['login_username']){?>
                            <p><a <?php echo 'href="index.php"'; ?> ><?php echo $nome_completo; ?></a> ha scritto un nuovo post <a href="#" onClick=<?php echo '"showEdit(true,'."'".'messaggi_stato'."',".$id_notizia.','."'".$utente."'".')"'?>><img class="edit" src="immagini/settings.png" alt="immagini/no_image.png"></a></p>
                            <?php }else{ 
							if($_SESSION['login_username']!='admin'){
							?>
                            <p><a <?php echo 'href="index.php?q='.$username.'"'; ?> ><?php echo $nome_completo; ?></a> ha scritto un nuovo post 
							</p>
                            <?php
							}else{ ?>
							<p><a <?php echo 'href="index.php?q='.$username.'"'; ?> ><?php echo $nome_completo; ?></a> ha scritto un nuovo post <a href="#" onClick=<?php echo '"showEdit(true,'."'".'messaggi_stato'."',".$id_notizia.','."'".$utente."'".')"'?>><img class="edit" src="immagini/settings.png" alt="immagini/no_image.png"></a>
							</p>
							<?php
							}
							}?>
                        </div>
                        <div class="time_news">
                             <?php echo $data; ?>
                        </div>
                        <div class="news">
                            <?php echo $notizia; ?>
                        </div>
                        
                        <div class="container_quadrato">
                            <?php stampa_commenti($id_notizia); ?>
                            <!--img style="margin-top: -11px;margin-left: 10px;" src="immagini/loading.gif"-->
                        </div>

                        <textarea class="commento_area" cols="50" rows="2" onfocus="if(this.value == 'Aggiungi un commento') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Aggiungi un commento'; }">Aggiungi un commento</textarea>
                        <button class="commento_buton" <?php echo 'onClick="aggiungiCommento('.$id_notizia.','.$c.')">' ?> Invia</button>
                        
                    </div>
<?php
    }
} else {echo "<ul>Nessuna notizia presente, usa la sezione contatti per cercare i tuoi amici!</ul>";}

$conn->close();
?>
</div>