
<?php
    session_start();
    if(session_destroy()) 
    {
        header("refresh:3; url=log_in_form.php"); 
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Logout</title>
    </head>
    <body style=" background-image:url(immagini/sfondo_login.jpg);">
    <h2> 
        <img src="immagini/sad.png"><br>
        Hai effettuato il logout con successo.
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
        height: 360px;
    }
</style>