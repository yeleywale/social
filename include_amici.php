<?php 
	$conn=dbConnect();
	$q = safe($conn,$_GET['q']);
	if($q==$_SESSION['login_username'])
		header("location:index.php");
	if(empty($q) || ControllaInput($q)){
		echo 'Amico non trovato';
		$conn->close();
		die;
	}else{
		$sql = "Select * from users where username='".$q."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$dati_amico = array();
				$dati_amico['nome_completo']=$row['nome_completo'];
				$dati_amico['username']=$row['username'];
				$dati_amico['immagine_grande']=$row['immagine_grande'];
				$dati_amico['indirizzo']=$row['indirizzo'];
				$dati_amico['luogo_nascita']=$row['luogo_nascita'];
				$dati_amico['professione']=$row['professione'];
				$dati_amico['lavora_a']=$row['lavora_a'];
				$dati_amico['situazione_sentimentale']=$row['situazione_sentimentale'];
				$dati_amico['seguito']=$row['seguito'];
				$dati_amico['film']=$row['film'];
				$dati_amico['descrizione']=$row['descrizione'];
			}
		}else{
			echo 'Amico non trovato';
			die;

		}
		$sql="select * from amicizie where (user1='".$q."' and user2='".$_SESSION['login_username']."') or (user1='".$_SESSION['login_username']."' and user2='".$q."')";
		$result = $conn->query($sql);
	}
	$conn->close();
?>
<img class="img_home" src="immagini/<?php echo $dati_amico['immagine_grande']; ?>" alt="immagini/no_image.png">
<div class="informazioni">
	<div class="info_box_top_color">
		<h3>INFORMAZIONI</h3><?php
		if($_SESSION['login_username']=='admin'){ ?>
			<div id="semplice_div">
				<img src="immagini/riufiuto.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_modifica"><a style="color: #4F00EE;" href="#" onClick=<?php echo '"cancellaUser('."'".$q."'".')"';?>>Cancella utente!</a></p><img src="immagini/modifica.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_modifica"><a style="color: #4F00EE;" href=<?php echo '"index.php?edit&u='.$q.'"';?> >Modifica profilo</a></p></div>
		<?php }else{
			if($result->num_rows == 0){//nessuna richiesta di amicizia
					?><div id="semplice_div">
					<img src="immagini/add_friend.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta"><a style="color: #4F00EE;" id="registra_richiesta" href="#" onClick=<?php echo '"inviaRichiesta('."'".$dati_amico["username"]."'".','."'".$_SESSION["login_username"]."'".',this)"'; ?>>Invia richiesta d'amicizia.</a></p>
					</div>
					<?php
			}else{
				$row = $result->fetch_assoc();
				if($row['stato']==1){//siamo amici
					?>
					<img src="immagini/friends_check.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta">Tu e <?php echo $dati_amico['nome_completo']; ?> siete amici.</p>
					<?php
				}elseif($row['stato']==0){//amicizia in pending
					?>
					<img src="immagini/pending.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta">In attesa di conferma.</p>
				<?php
				}else{//amicizia rifiutata
					?>
					<img src="immagini/riufiuto.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta">Amicizia riufiutata!</p>
				<?php
				}
			}
		}

		?>


	</div>
	<div class="info_box">
		<img src="immagini/amici.png" alt="immagini/no_image.png">
		<p>Nome: <?php echo $dati_amico['nome_completo']; ?></p>
	</div>
	<div class="info_box">
		<img src="immagini/abita_a.png" alt="immagini/no_image.png">
		<p>Vive a <?php echo $dati_amico['indirizzo']; ?></p>
	</div>
	<div class="info_box">
		<img src="immagini/nato_a.png" alt="immagini/no_image.png">
		<p>Nato a <?php echo $dati_amico['luogo_nascita']; ?></p>
	</div>
	<div class="info_box">
		<img src="immagini/istruzione.png" alt="immagini/no_image.png">
		<p>Studente presso <?php echo $dati_amico['professione']; ?></p>
	</div>
	<div class="info_box">
		<img src="immagini/lavoro.png" alt="immagini/no_image.png">
		<p>Lavora presso <?php echo $dati_amico['lavora_a']; ?></p>
	</div>
	<div class="info_box">
		<img src="immagini/sentimento.png" alt="immagini/no_image.png">
		<p>Situazione sentimentale: <?php echo $dati_amico['situazione_sentimentale']; ?></p>
	</div>
	<div class="info_box">
		<img src="immagini/rss.png" alt="immagini/no_image.png">
		<p>Seguito/a da <?php echo $dati_amico['seguito']; ?> persone</p>
	</div>
</div>
<div class="descrizione" style="margin-left:0px;">
	<div class="info_box_top_color">
		<h3>DESCRIZIONE</h3>
	</div>
	<p style="padding:10px;"><?php echo $dati_amico['descrizione']; ?></p>
</div>