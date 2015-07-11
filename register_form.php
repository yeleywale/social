<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" media="screen" href="fogli_stile/forms.css" >
    <script type="text/javascript" src="javascript.js"></script>
    <title>Effettua il login</title>
    </head>
    <body style=" background-image:url(immagini/sfondo_login.jpg);">
        <div id="main">
            <h1>Effettua la registrazione</h1>
            <div id="login">
                <h2>Login Form</h2>
                    <form action="register.php" method="post">
                    <label>UserName :</label>
                    <input id="name" name="username" placeholder="Username" type="text" onkeyup="checkUsername(this.value)"><div id="checku"></div>
                    <label>Nome completo :</label>
                    <input id="name" name="c_username" placeholder="Nome completo" type="text">
                    <label>Password :</label>
                    <input id="password" name="password" placeholder="**********" type="password" onkeyup="checkPassword()">
                    <label>Ripeti la password Password :</label>
                    <input id="r_password" name="r_password" placeholder="**********" type="password" onkeyup="checkPassword()"><div id="checkp"></div>
                    <input name="submit" type="submit" value=" Registrati ">
                        
                    <input name="login" type="button" onclick="window.location.href='log_in_form.php'" value=" Login ">
                </form>
            </div>
        </div>
    </body>
</html>
