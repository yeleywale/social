
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" media="screen" href="fogli_stile/forms.css" >
    <title>Effettua il login</title>
    </head>
    <body style=" background-image:url(immagini/sfondo_login.jpg);">
        <div id="main">
            <h1>Effettua la registrazione prima di procedere</h1>
            <div id="login">
                <h2>Login Form</h2>
                    <form action="login.php" method="post">
                    <label>UserName :</label>
                    <input id="name" name="username" placeholder="username" type="text">
                    <label>Password :</label>
                    <input id="password" name="password" placeholder="**********" type="password">
                    <input name="submit" type="submit" value=" Login ">
                    <input name="registrati" type="button" onclick="window.location.href='register_form.php'" value=" Registrati ">
                </form>
            </div>
        </div>
    </body>
</html>
