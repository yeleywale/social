<!DOCTYPE html>
<html>
    <head>
    <title>Effettua la registrazione.</title>
    </head>
    <body style=" background-image:url(immagini/sfondo_login.jpg);">
    <h2> 

    <?php
    include ('php_functions.php');
    $conn=dbConnect();
    $error=''; 
    $username=safe($conn,$_POST['username']);
    $c_username=safe($conn,$_POST['c_username']);
    $password=safe($conn,$_POST['password']);
    $r_password=safe($conn,$_POST['r_password']);
	
	//echo $username." ".$c_username." ".$password;
    $sql = "Select * from users where username='".$username."'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) 
        $flag=true;
    else
        $flag=false;
    if (empty($username) || empty($c_username) || empty($password) || empty($r_password) || ControllaInput($username) || ControllaInput($c_username)||ControllaInput($password)||ControllaInput($r_password)||($password!=$r_password)||strlen($password)<=4|| $flag) {
        $error = "Alcuni campi non rispettavano i requisti, riprovare perfavore.";
    }
    else
    {
        
        $sql = "INSERT INTO `users`(`username`, `password`, `nome_completo`, `messaggio`, `url`, `immagine`, `immagine_grande`, `indirizzo`, `luogo_nascita`, `professione`, `lavora_a`, `situazione_sentimentale`, `seguito`, `film`, `descrizione`) VALUES ('".$username."','".$password."','".$c_username."','Modifica il tuo primo messaggio di stato!','','default_piccola.jpg','default.jpg','Indirizzo non inserito','Luogo di nascita non inserito','Professione non inserita','Sconosciuto','Sconosciuto','0 persone','Nessuna preferenza','Cambia la descrizione per farti conoscere meglio!')";
        $result = $conn->query($sql);
        header("refresh:3; url=log_in_form.php"); 
        echo '<img src="immagini/happy.png"><br>';
        echo "Registrazione eseguita corettamente!";
    } 
    $conn->close(); 
    if($error!=''){
        echo '<img src="immagini/sad.png"><br>';
        echo $error;  
        header("refresh:3; url=register_form.php");
    }

    ?>
    <br><br><div style="font-size: 22px; font-style: oblique;font-weight: normal;">Verrai reindirizzato tra 3 secondi...</div>
    </h2> 
</body>
</html>
<style>
    h2{
        background-color: #FEFFED;
        text-align: center;
        border-radius: 10px;
        width: 500px;
        border: 2px solid #FEFFED;
        margin: 5% auto;
        height: 382px;
    }
</style>