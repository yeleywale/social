<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="fogli_stile/index_style.css" >
    <script type="text/javascript" src="javascript.js"></script>
    <?php include('php_functions.php');?>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>Welcome <?php echo $_SESSION['login_nome_completo'];?></title>
</head>
<body>
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
                        <a href="notizie.php">NOTIZIE</a>
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
                <div class="descrizione" style="position:absolute;margin-left:0px;min-width:560px;width:55%;">
                    <div class="info_box_top_color">
                        <h3>Richieste d'amicizia</h3>
                    </div>

                    <div id="container_cerca">
                        <img id="immagine_cerca" style="margin:0" src="immagini/friend_req.png">
                        <div id="testo_cerca">Ecco le richieste in attesa di risposta!</div><br>
                        <?php
                            stampa_richieste_amicizia();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("include_footer.php"); ?>
    </div>
</body>
</html>
