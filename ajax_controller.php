
<?php
//include('dbConn.php');
include('php_functions.php');
$conn=dbConnect();
//session_start();
$pos = strrpos($_SERVER['HTTP_REFERER'], "register_form.php");
if ($pos === false) 	
	$utente=$_SESSION['login_username'];
else 
	$utente='sconosciuto';

$case = ($_GET['case']);

switch($case){
    case 1:
        //salva commento
        $id_notizia = safe($conn,$_GET['id_notizia']);
        $commento = safe($conn,$_GET['commento']);
        if(ControllaInput($id_notizia) || ControllaInput($commento)){
            echo 'Input errato, riprovare!';
            die;
        }
        $sql = "INSERT INTO social_network(id_notizia,commenti,autore) values('".$id_notizia."','".$commento."','".$utente."')";
        $result = $conn->query($sql);
        //restituisco il nodo completo
    
        $id = $id_notizia;
        $sql = "Select * from social_network s1 join users u1 on s1.autore=u1.username where s1.id_notizia='".$id."' order by s1.id_sn DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $commento=$row["commenti"];
                $nome_completo=$row["nome_completo"];//onClick="functionLikeDislike(1,0);"
                $foto=$row["immagine_grande"];
                //$url=$row["url"];
                ?>
                    <div class="foto_news">
                           <img <?php echo 'src="immagini/'.$foto.'" '; ?> alt="immagini/no_image.png">
                    </div>
                    <div class="nome_news">
                        <p style="color:#6a7480;"><a href="index.php"><?php echo $nome_completo; ?></a> ha scritto un nuovo commento</p>
                    </div>
                    <div class="news">
                        <?php echo $commento; ?>
                    </div>

                    <?php
            }
        } 
        
    break;
    case 2:
        //salva messaggio
        $messaggi = safe($conn,$_GET['messaggi']);
        if(ControllaInput($messaggi)){
            echo 'Input errato, riprovare!';
            die;
        }
        $sql="UPDATE `users` SET `messaggio`='".$messaggi."' WHERE `username`='".$utente."'";
        $result = $conn->query($sql);

        /*inserisco il commento anche nella tabella globale delle notizie*/
        $ora_attuale=new DateTime('NOW');
        $ora_attuale=$ora_attuale->format('Y-m-d H:i:s');
        $sql = "INSERT INTO messaggi_stato(notizia,username,data) values('".$messaggi."','".$utente."','".$ora_attuale."')";
        $result = $conn->query($sql);
        $sql = "INSERT INTO `social_network_like`(`like`) VALUES (0)";
        $result = $conn->query($sql);
        echo 'niente di particolare';
    break;
    case 3:
        //restituisci i like
        $id = safe($conn,$_GET['id']);
        if(ControllaInput($id)){
            echo 'Input errato, riprovare!';
            die;
        }
    
        $sql = "Select * from messaggi_stato where id_notizia='".$id."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["likeC"];
            }
        } 
    break;
    case 4:
        //aggiorna i like
        $id = safe($conn,$_GET['id']);
        $n=safe($conn,$_GET['n']);
        if(ControllaInput($id) || ControllaInput($n)){
            echo 'Input errato, riprovare!';
            die;
        }
        //$sql = "UPDATE social_network_like SET like='3' where id_notizia='".$id."'";
        $sql="UPDATE `messaggi_stato` SET `likeC`=`likeC`+'".$n."' WHERE `id_notizia`='".$id."'";
        $result = $conn->query($sql);
		$sql="Select * from social_network_like where id_notizia='".$id."' and username='".$_SESSION['login_username']."'";
		$result = $conn->query($sql);
		if ($result->num_rows == 0) {
			 $sql="INSERT INTO `social_network_like`(`id_notizia`, `username`, `likeC`) VALUES ('".$id."','".$_SESSION['login_username']."','".$n."')";
			 $result = $conn->query($sql);
		}else{
			$sql="UPDATE `social_network_like` SET `likeC`='".$n."' WHERE `id_notizia`='".$id."'";
			 $result = $conn->query($sql);
		}
        echo "Errore:".$conn->error;
    break;
    case 5:
        $q = safe($conn,$_GET['q']);
        $x = safe($conn,$_GET['x']);
        $y = safe($conn,$_GET['y']);
		$utente=$_SESSION['login_username'];
		if($x=="tutti"){
        	$sql = "Select * from users where username like '%".$q."%' order by ".$y."";
		}else{
			$sql = "Select * from users where username like '%".$q."%' and username in(SELECT user2 from amicizie a1 where (a1.user1='".$utente."' and a1.stato=1) UNION SELECT user1 from amicizie a1 where (a1.user2='".$utente."' and a1.stato=1)) order by ".$y."";
		}
	
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?><div class="contenitore_amico_cerca">
                    <img  style="margin:0; width:47px; height:50px;" src="immagini/<?php echo $row['immagine_grande']; ?>" alt="immagini/no_image.png">
                    <a href="index.php?q=<?php echo $row['username'];?>"><?php echo ucfirst($row['nome_completo']); ?></a>
                </div><?php
            }?><div style="border-color: #735C5C;border-width: 1px;border-top-style:solid; float:left; width:99.6%;"></div>
            <?php
        }else
            echo 'Nessun risultato';
    break;
    case 6://inserisci richieste d'amicizia
        $destinatario=safe($conn,$_GET['d']);
        $mittente=safe($conn,$_GET['m']);
        $sql = "INSERT INTO amicizie(user1,user2) values('".$mittente."','".$destinatario."')";
        $result = $conn->query($sql);
        echo "fatto";
    break;
    case 7:
        $id = safe($conn,$_GET['id']);
        $v=safe($conn,$_GET['v']);
        if(ControllaInput($id) || ControllaInput($v)){
            echo 'Input errato, riprovare!';
            die;
        }
        if($v==1)
            $sql="UPDATE `amicizie` SET `stato`=1 WHERE `id_a`='".$id."'";
        else
            $sql="UPDATE `amicizie` SET `stato`=-1 WHERE `id_a`='".$id."'";
        $result = $conn->query($sql);
        echo "Errore:".$conn->error;
    break;
    case 8:
        $q = safe($conn,$_GET['q']);
        $sql = "Select * from users where username='".$q."'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) 
            echo '<p style="color:green;">Username disponibile</p>';
        else 
            echo '<p style="color:red;">Username non disponibile</p>'; 
		//echo "Errore:".$conn->error;
    break;
	case 9:
	//xmlhttp.open("GET","ajax_controller.php?case=9&id_notizia="+id_t+"&commento="+y+"&tabella="+tabella,true);
		$id_notizia=safe($conn,$_GET['id_notizia']);
		$valore=safe($conn,$_GET['valore']);
		$tabella=safe($conn,$_GET['tabella']);
		$username=safe($conn,$_GET['username']);
		if($tabella=="messaggi_stato"){
			$colonna="notizia";
			$sql="UPDATE ".$tabella." SET ".$colonna."='".$valore."' WHERE id_notizia='".$id_notizia."'";
		}else{
			$colonna="commenti";
			$sql="UPDATE ".$tabella." SET ".$colonna."='".$valore."' WHERE id_sn='".$id_notizia."'";
		}
		$result = $conn->query($sql);
		echo $id_notizia;
		echo $valore;
		echo $tabella;
	
	break;
	case 10:
		$id_notizia=safe($conn,$_GET['id_notizia']);
		$tabella=safe($conn,$_GET['tabella']);
		$username=safe($conn,$_GET['username']);
		if($tabella=="messaggi_stato"){
			$sql="UPDATE ".$tabella." SET visibile=0 WHERE id_notizia='".$id_notizia."'";
		}else{
			$sql="UPDATE ".$tabella." SET visibile=0 WHERE id_sn='".$id_notizia."'";
		}
		$result = $conn->query($sql);
		echo $id_notizia;
		echo $username;
		echo $tabella;
	
	break;
	case 11:
		$u=safe($conn,$_GET['u']);
		$sql="UPDATE messaggi_stato SET visibile=0 WHERE username='".$u."'";
		$result = $conn->query($sql);
		$sql="UPDATE social_network SET visibile=0 WHERE autore='".$u."'";
		$result = $conn->query($sql);
		$sql="Delete from users WHERE username='".$u."'";
		$result = $conn->query($sql);
		$sql="Delete from amicizie WHERE user1='".$u."' || user2='".$u."'";
		$result = $conn->query($sql);
	break;

}
$conn->close();
?>