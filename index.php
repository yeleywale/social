
<!DOCTYPE HTML>
<html>
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
                         <button id="button_mes" onClick="CambiaMessaggio()">Cambia! </button>
                     </div>
                 </div>
             </div>
             <div id="bottom_header">
                 <?php include('login_layout.php') ?>
                 <div class="header_link_container">
                    <div class="header_link">
						<?php 
						if(!isset($_GET['q'])){?>
                        	<a style="background-color: #ff7200;" href="index.php">HOME</a>
						<?php 
						}else{ ?>
							<a href="index.php">HOME</a>
						<?php } ?>
                    </div>
                    <div class="header_link">
                        <a href="notizie.php">NOTIZIE</a>
                    </div>
                    <div class="header_link">
						<?php 
						if(isset($_GET['q'])){?>
                        	<a style="background-color: #ff7200;" href="index.php?q">AMICI</a>
						<?php 
						}else{ ?>
							<a href="index.php?q">AMICI</a>
						<?php } ?>
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
				<?php 
				if(isset($_GET['q'])){
					if(!empty($_GET['q']))
						include("include_amici.php");
					else
						include("include_list_amici.php");
				}else{
					if(isset($_GET['edit']))
						include("include_edit.php");
					else if(isset($_GET['contact']))
						include("include_contact.php");
					else
						include("include_index.php");
				}
				?>
            </div>
        </div>
		<?php include("include_footer.php"); ?>
    </div>
</body>
</html>
