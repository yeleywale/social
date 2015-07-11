<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="fogli_stile/index_style.css" >
    <script type="text/javascript" src="javascript.js"></script>
    <?php include('php_functions.php');?>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>Welcome <?php echo $_SESSION['login_nome_completo'];?></title>
</head>
<!--body onload="stampaCommenti(0);"-->
<body onload="alert(bbb);">
    <?php //session_start(); ?>
    
    <div id="container" >
        <div id="header">
             <div id="logo">
                 <a href="index.php"><img src="immagini/logof1.png" alt="immagini/no_image.png"></a>
             </div>
             <div id="top_header">
                 <div id="container_header">
                     <p id="messaggio"><?php stampa_messaggio(); ?></p>
                     <div id="middle">
                         <textarea id="messaggio_nuovo" cols="22" rows="3"></textarea>
                         <button id="button_mes" onClick="CambiaMessaggio()">Invia! </button>
                     </div>
                 </div>
             </div>
             <div id="bottom_header">
                 <?php include('login_layout.php'); ?>
                 <div class="header_link_container">
                    <div class="header_link">
                        <a href="index.php">HOME</a>
                    </div>
                    <div class="header_link">
                        <a style="background-color: #ff7200;" href="notizie.php">NOTIZIE</a>
                    </div>
                    <div class="header_link">
                        <a href="index.php?q">AMICI</a>
                    </div>
                    <div class="header_link">
                        <a href="statistiche.php">STATISTICHE</a>
                    </div>
                 </div>
             </div>
        </div>
        
        <div id="menu_content" >
            <?php include('navigation_bar.php'); ?>
            <div id="content"> 
                <div class="descrizione" style="margin-left:0px;min-width:560px;">
                    <div class="info_box_top_color">
                        <h3>News</h3>
                    </div><br>
                    <?php include 'stampa_notizie.php'; ?>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="box_footer">
                <p>Made with <img src="immagini/cuore_rosso.png" alt="immagini/no_image.png"> by Felix!<a href="contact.php"><img title="Invia un messaggio" src="immagini/messagio.png" alt="immagini/no_image.png"></a></p>
            </div>
        </div>
    </div>
</body>
</html>
