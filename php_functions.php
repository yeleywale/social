<?php
include('dbConn.php');

session_start();
if(!isset($_SESSION['login_username'])){
	$pos = strrpos(basename($_SERVER['PHP_SELF']), "login.php");
	$pos1 = strrpos(basename($_SERVER['PHP_SELF']), "register.php");
	$pos2 = strrpos(basename($_SERVER['PHP_SELF']), "register_form.php");
	$pos3 = strrpos(basename($_SERVER['PHP_SELF']), "ajax_controller.php");
	if ($pos === false && $pos1===false && $pos2===false && $pos3===false){
		header("location:log_in_form.php");
		exit;
	}
}
function stampa_messaggio(){ 
	$conn=dbConnect();
    if(!empty($_SESSION['login_username'])){
        $utente=$_SESSION['login_username'];
        $sql = "SELECT messaggio FROM users where username='".$utente."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["messaggio"];
            }
        }
    }else{
         header("location:log_in_form.php");
    }
    $conn->close();
}
function stampa_richieste_amicizia(){
    $conn=dbConnect();
    $sql = "Select * from amicizie a1 join users u1 on u1.username=a1.user1 and  user2='".$_SESSION['login_username']."' and stato=0";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $c=-1;
        while($row = $result->fetch_assoc()) {
            $c++;
            ?>
            <div class="contenitore_amico_req">
                
                <img  src="immagini/<?php echo $row['immagine_grande']; ?>" style="margin:6px 20px 0px 6px; width:47px; height:50px;" alt="immagini/no_image.png">
                <p style="padding-top:20px;"><?php echo ucfirst($row['nome_completo']); ?></p>
                <div class="container_button_req">
                    <a href="#" onClick=<?php echo "managerRichieste(".$c.",".$row['id_a'].","."1)"; ?>><img src="immagini/conferma.png"></a>
                    <a href="#" onClick=<?php echo "managerRichieste(".$c.",".$row['id_a'].","."-1)"; ?>><img src="immagini/rifiuta.png"></a>
                </div>
            </div>
        <?php
        }
    }else
        echo 'Nessun richiesta in attesa di conferma';
	$conn->close();
}
function stampa_like($id){
    $conn=dbConnect();
    $sql = "Select * from social_network_like where id_notizia='".$id."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["likeC"];
        }
    }
    $conn->close();
}
function stampa_commenti($id){
    $conn=dbConnect();
    $utente=$_SESSION['login_username'];
    $sql="SELECT * from social_network,users where (social_network.autore in (SELECT user2 from amicizie a1 where (a1.user1='".$utente."' and a1.stato=1) UNION SELECT user1 from amicizie a1 where (a1.user2='".$utente."' and a1.stato=1)) || (social_network.autore='".$utente."')) and social_network.autore=users.username and social_network.id_notizia='".$id."'  and social_network.visibile=1 order by social_network.id_sn";
	if($utente=="admin"){
		$sql="Select * from social_network join users where autore=username and id_notizia='".$id."' and visibile=1 order by social_network.id_sn";
	}
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $commento=$row["commenti"];
            $nome_completo=$row["nome_completo"];
            $foto=$row["immagine_grande"];
            //$url=$row["url"];
            $username=$row['username'];
			$id_sn=$row['id_sn'];
            ?>
                <div class="quadrato">
                <div class="foto_news">
                       <img <?php echo 'src="immagini/'.$foto.'" '; ?> alt="immagini/no_image.png">
                </div>
                <div class="nome_news">
                    <p style="color:#6a7480;">
                        <?php if($username!=$_SESSION['login_username']){?>
                        <a <?php echo 'href="index.php?q='.$username.'"'; ?> ><?php echo $nome_completo; ?></a>
                        <?php } else { ?>
                        <a <?php echo 'href="index.php"'; ?> ><?php echo $nome_completo; ?></a>
                        <?php } ?>
                        ha scritto un nuovo commento 
						<?php 
						if($username==$utente || $utente=='admin') {
						?>
						<a href="#" onClick=<?php echo '"showEdit(true,'."'".'social_network'."',".$id_sn.','."'".$username."'".')"'?>><img class="edit" src="immagini/settings.png" alt="immagini/no_image.png"></a>
						<?php
						}
						?>
                    </p>
                </div>
                <div class="news">
                    <?php echo $commento; ?>
                </div>
                </div>
            <?php
        }
    }
    $conn->close();
}
function stats($user){
    $conn=dbConnect();
    $sql="select count(*) as a from messaggi_stato where username='".$user."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $a=$row['a'];
    
    $sql="select sum(likeC) as a from messaggi_stato where username='".$user."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
	$b=0;
	if(!empty($row['a']))
    	$b=$row['a'];
    
    $sql="select count(*)as a from messaggi_stato m1 join social_network s1 on m1.id_notizia=s1.id_notizia and m1.username='".$user."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $c=$row['a'];
    
    $sql="select count(*)as a from social_network where autore='".$user."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $d=$row['a'];
    
    $sql="(SELECT user2 from amicizie a1 where (a1.user1='".$user."' and a1.stato=1)) UNION (SELECT user1 from amicizie a1 where (a1.user2='".$user."' and a1.stato=1))";
    $result = $conn->query($sql);
    $e=$result->num_rows;
    
	$conn->close();
    return compact('a','b','c','d','e');
}
function ControllaInput($stringa){
    $reg_exp="(--|!=|[|+=<>\(\)%\*])";
    return (preg_match($reg_exp,$stringa) || strlen($stringa)<1 || strlen($stringa)>140 );
}
function safe($conn,$stringa){ 
   return mysqli_real_escape_string($conn,$stringa); 
} 
?>