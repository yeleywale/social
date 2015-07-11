<!DOCTYPE html>
<html>
    <head>
    <title>Aggiornamento dati</title>
    </head>
    <body style=" background-image:url(immagini/sfondo_login.jpg);">
    <h2> 

    <?php
    include ('php_functions.php');
    $conn=dbConnect();
    $error=''; 
	$username=$_SESSION['login_username'];
    if($_SESSION['login_username']=='admin'){
		if(isset($_GET['u'])){
			$username=(safe($conn,$_GET['u']));
		}
	}        $arr=array('nome_completo/'.safe($conn,$_POST['nome_completo']),'indirizzo/'.safe($conn,$_POST['indirizzo']),'luogo_nascita/'.safe($conn,$_POST['nascita']),'professione/'.safe($conn,$_POST['professione']),'lavora_a/'.safe($conn,$_POST['lavoro']),'situazione_sentimentale/'.safe($conn,$_POST['sentimentale']),'film/'.safe($conn,$_POST['film']),'descrizione/'.safe($conn,$_POST['descrizione']));
    
    foreach ($arr as &$val){
        if(!empty($val)){
            $chiave=substr($val,0,strpos($val,"/"));
			$valore=substr($val,strpos($val,"/")+1,strlen($val));
			if(!empty($valore)){
				$sql="UPDATE users SET ".$chiave."='".$valore."' WHERE username='".$username."'";
				$result = $conn->query($sql);
			}
        }
	}
	$password=safe($conn,$_POST['password']);
	$r_password=safe($conn,$_POST['r_password']);
	if(isset($password) && !empty($password) && isset($r_password) && !empty($r_password)){
		if($password==$r_password){
			$sql="UPDATE users SET password='".$password."' WHERE username='".$username."'";
			$result = $conn->query($sql);
		}
	}
	if(!empty($_FILES["fileToUpload"]["name"])){
		$target_dir = "immagini/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check == false) {
				$error="Il file non &egrave; un immagine!";
			}
		}
		if (file_exists($target_file)) {
			$error="Esiste gi&agrave; un file con lo stesso nome, cambia il nome e riprova!";
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$error="Sono permessi solo immagini di tipo JPG, JPEG, PNG & GIF.";
		}
		else {
			if (!(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))) {
				$error= "Il file non &egrave; stato caricato!";
			}else{
				$sql="update users set immagine_grande='".$_FILES["fileToUpload"]["name"]."' where username='".$username."'";
				$result = $conn->query($sql);
			}
		}
	}

    if($error==''){
        echo '<img src="immagini/happy.png"><br>';
		if($_SESSION['login_username']!='admin' ||($_SESSION['login_username']=='admin' && $_GET['u']=='admin')){
			$sql = "select * from users where username='$username'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			if ($result->num_rows == 1) {
				$_SESSION['login_username']=$username; 
				$_SESSION['login_nome_completo']=$row['nome_completo']; 
				$_SESSION['login_messaggio']=$row['messaggio'];
				$_SESSION['login_url']=$row['url'];
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
			}
		}
		
		if($password==$r_password){
			echo "I dati sono stati aggiornati correttamente!";
				 
		}else{
			echo "Si &egrave; verificato un errore con la password, ma il resto dei dati sono stati registrati!";
		}
		header("refresh:3; url=index.php");
	}
    else{
        echo '<img src="immagini/sad.png"><br>';
		echo $error; 
       	header("refresh:3; url=index.php");
    }
	$conn->close(); 
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