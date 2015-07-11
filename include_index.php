<img class="img_home" src="immagini/<?php echo $_SESSION['home']['immagine_grande'];?>" alt="immagini/no_image.png">
<div class="informazioni">
	<div class="info_box_top_color">
			<h3>INFORMAZIONI</h3>
			<img src="immagini/modifica.png" alt="immagini/no_image.png" id="img_richiesta"><p id="p_richiesta"><a style="color: #4F00EE;" href="index.php?edit">Modifica profilo</a></p>
	</div>
	<div class="info_box">
		<img src="immagini/abita_a.png" alt="immagini/no_image.png">
		<p>Vive a <?php echo $_SESSION['home']['indirizzo'];?></p>
	</div>
	<div class="info_box">
		<img src="immagini/nato_a.png" alt="immagini/no_image.png">
		<p>Nato a <?php echo $_SESSION['home']['luogo_nascita'];?></p>
	</div>
	<div class="info_box">
		<img src="immagini/istruzione.png" alt="immagini/no_image.png">
		<p>Studente presso <?php echo $_SESSION['home']['professione'];?></p>
	</div>
	<div class="info_box">
		<img src="immagini/lavoro.png" alt="immagini/no_image.png">
		<p>Lavora presso <?php echo $_SESSION['home']['lavora_a'];?></p>
	</div>
	<div class="info_box">
		<img src="immagini/sentimento.png" alt="immagini/no_image.png">
		<p>Situazione sentimentale: <?php echo $_SESSION['home']['situazione_sentimentale'];?></p>
	</div>
	<div class="info_box">
		<img src="immagini/rss.png" alt="immagini/no_image.png">
		<p>Seguito/a da <?php echo $_SESSION['home']['seguito'];?> persone</p>
	</div>
	<div class="info_box">
		<img src="immagini/film.png" alt="immagini/no_image.png">
		<p>Film preferito: <?php echo $_SESSION['home']['film'];?></p>
	</div>
</div>
<div class="descrizione" style="margin-left:0px;">
	<div class="info_box_top_color">
		<h3>DESCRIZIONE</h3>
	</div>
	<p style="padding:10px;"> <?php echo $_SESSION['home']['descrizione'];?> </p>
</div>