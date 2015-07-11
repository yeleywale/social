<!DOCTYPE html>
<html>
    <head>
    <title>Effettua il login</title>
    </head>
    <body style=" background-image:url(immagini/sfondo_login.jpg);">
    <h2> 

    <?php
    //include ('dbConn.php');
    include ('php_functions.php');
    $conn=dbConnect();
    $error=''; 
    $username=safe($conn,$_POST['username']);
    $password=safe($conn,$_POST['password']);

    if (empty($username) || empty($password) || ControllaInput($username) || ControllaInput($password)) {
        $error = "Username or Password non possono essere vuoti oppure hai inserito caratteri non consentiti! Verrai reindirizzato tra 3 secondi.";
    }
    else
    {   
        
        $sql = "select * from users where password='$password' AND username='$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($result->num_rows == 1) {
            $_SESSION['login_username']=$username; 
            $_SESSION['login_nome_completo']=$row['nome_completo']; 
            $_SESSION['login_messaggio']=$row['messaggio'];
            //$_SESSION['login_url']=$row['url'];
            $_SESSION['login_immagine']=$row['immagine_grande'];
                $home = array();
                $home['immagine_grande']=$row['immagine_grande'];
                $home['indirizzo']=$row['indirizzo'];
                $home['luogo_nascita']=$row['luogo_nascita'];
                $home['professione']=$row['professione'];
                $home['lavora_a']=$row['lavora_a'];
                $home['situazione_sentimentale']=$row['situazione_sentimentale'];
                $home['seguito']=$row['seguito'];
                $home['film']=$row['film'];
                $home['descrizione']=$row['descrizione'];
            $_SESSION['home']=$home;
            
            header("refresh:3; url=index.php"); 
            echo '<img src="immagini/happy.png"><br>';
            echo "Login eseguito corettamente!";
        } else {
            $error = "Username o Password errati!";
        }  
    }
	$conn->close(); 
    if($error!=''){
        echo '<img src="immagini/sad.png"><br>';
        echo $error;  
        header("refresh:3; url=log_in_form.php");
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