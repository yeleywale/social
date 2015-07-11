<div class="descrizione" style="margin-left:0px;min-width:560px;">
	<div class="info_box_top_color">
		<h3>Ecco la lista dei tuoi amici</h3>
	</div>
	<ul>
		<?php 
			$conn=dbConnect();
			$sql = "SELECT * FROM users where username in(SELECT user2 from amicizie a1 where (a1.user1='".$utente."' and a1.stato=1) UNION SELECT user1 from amicizie a1 where (a1.user2='".$utente."' and a1.stato=1))order by username";
			if($_SESSION['login_username']=='admin'){
				$sql="Select * from users";
			}
			$result = $conn->query($sql);
			if ($result->num_rows == 0) {echo "Nessun amico, cerca subito altri amici!";}
			while($row = $result->fetch_assoc()) {
				if($row['username']!=$_SESSION['login_username']){
					?><li>
						<img style="max-width:none;max-height:none;" src="immagini/<?php echo $row['immagine_grande']; ?>" alt="immagini/no_image.png"> 
						<a style="color:#0000ee;" href="index.php?q=<?php echo $row['username']; ?>">
							<?php 
								if(strpos($row['nome_completo'],' ')===false)
									echo $row['nome_completo'];
								else
									echo substr($row['nome_completo'],0,strpos($row['nome_completo'],' '));
							?>
						</a>
					  </li>
				   <?php
				}
			}
		?>     
</ul>
</div>