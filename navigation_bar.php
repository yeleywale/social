<div id="navigation">
    <h1 style="border-width:0;"><a href="index.php?q">Amici</a></h1>
    <?php
    $conn=dbConnect();
    $utente=$_SESSION['login_username'];
    $sql = "SELECT * FROM users where username in(SELECT user2 from amicizie a1 where (a1.user1='".$utente."' and a1.stato=1) UNION SELECT user1 from amicizie a1 where (a1.user2='".$utente."' and a1.stato=1))order by username limit 2";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        if($row['username']!=$_SESSION['login_username']){
            ?>
            <div class="contenitore_amico">
                
                <img  src="immagini/<?php echo $row['immagine_grande']; ?>" alt="immagini/no_image.png">
                <p><a href="index.php?q=<?php echo $row['username'];?>"><?php echo ucfirst($row['username']); ?></a></p>
            </div>
            <?php
        }
    }
	$conn->close();
    ?>

    <div class="nav_link">
        <a href="index.php?q">Tutti gli amici</a>
    </div>
    <h1 style="padding-top: 9px;"><a href ="notizie.php">Notizie</a></h1>
    <h1><a href="statistiche.php">Statistiche</a></h1>
    <h1><a href="index.php?contact">Contatti</a></h1>

</div>