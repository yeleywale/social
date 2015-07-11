<div class="descrizione" style="margin-left:0px;min-width:650px;width:60%;">
	<div class="info_box_top_color">
		<h3>Modifica le informazioni del tuo profilo</h3>
	</div>
	<?php 
		$conn=dbConnect();
		$user=$_SESSION['login_username'];
		$sql = "Select * from users where username='".$_SESSION['login_username']."'";
		if($_SESSION['login_username']=='admin'){
			if(isset($_GET['u'])){
				$user=safe($conn,$_GET['u']);
				$sql = "Select * from users where username='".$user."'";
			}
		}
		$result = $conn->query($sql);
		if ($result->num_rows == 0) {
			echo 'Questo utente non esiste';
			exit;
		}
		$row = $result->fetch_assoc();
		$conn->close();

	?>
	<div id="login">
		<label>Completa solo i campi che desideri aggiornare</label><br>
		<form <?php echo 'action="update.php?u='.$user.'"'; ?> method="post" enctype="multipart/form-data">

			<label>Nome completo :</label>
			<input id="nome_completo" name="nome_completo" placeholder=<?php echo '"'.$row["nome_completo"].'"';?> type="text">
			<label>Password :</label>
			<input id="password" name="password" placeholder="**********" type="password" onkeyup="checkPassword()">
			<label>Ripeti la password Password :</label>
			<input id="r_password" name="r_password" placeholder="**********" type="password" onkeyup="checkPassword()"><div id="checkp"></div> 
			<label>Immagine profilo :</label>
			<input type="file" name="fileToUpload" id="fileToUpload"><br>
			<label>Indirizzo :</label>
			<input id="indirizzo" name="indirizzo" placeholder=<?php echo '"'.$row["indirizzo"].'"';?> type="text">
			<label>Luogo e data di nascita :</label>
			<input id="nascita" name="nascita" placeholder=<?php echo '"'.$row["luogo_nascita"].'"';?> type="text">
			<label>Professione :</label>
			<input id="professione" name="professione" placeholder=<?php echo '"'.$row["professione"].'"';?> type="text">
			<label>Lavoro :</label>
			<input id="lavoro" name="lavoro" placeholder=<?php echo '"'.$row["lavora_a"].'"';?> type="text">
			<label>Situazione Sentimentale :</label>
			<input id="sentimentale" name="sentimentale" placeholder=<?php echo '"'.$row["situazione_sentimentale"].'"';?> type="text">
			<label>Film Preferito :</label>
			<input id="film" name="film" placeholder=<?php echo '"'.$row["film"].'"';?> type="text">
			<label>Descrizione :</label>
			<input id="descrizione" name="descrizione" placeholder=<?php echo '"'.substr($row["descrizione"],0,60).'...'.'"';?> type="text">
			<input name="submit" type="submit" value=" Salva i dati ">
		</form>
	</div>
</div>