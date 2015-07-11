 
<?php 
    if(!empty($_SESSION['login_username'])){
 ?>
 <div id="log_user">
     <a href="richieste_amicizia.php" style="color:#0000ee;"><img class="login_layout2" style="float:left;" src="immagini/notifiche.png" alt="immagini/no_image.png"> </a>
     <a href="index.php"><img class="login_layout" src="immagini/<?php echo $_SESSION['login_immagine'];  ?>" alt="immagini/no_image.png"></a><a class="login_name" href="index.php"><?php echo $_SESSION['login_nome_completo'];  ?></a> 
     <a href="logout.php" style="color:#0000ee;"><img class="login_layout2" src="immagini/logout.png" alt="immagini/no_image.png"> </a>
 </div>
 <?php 
 } 
