
<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="fogli_stile/index_style.css" >
    <script type="text/javascript" src="javascript.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <?php include('php_functions.php');?>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>Welcome <?php echo $_SESSION['login_nome_completo'];?></title>
</head>
<body>
        <script type="text/javascript">
          function show_hide_column(col_no,z) {
                var link_c=document.getElementsByClassName("link_click");
                for(var c=0;c<=4;c++){
                      link_c[c].style.fontSize="100%";
                      link_c[c].style.textDecoration="none";
                }
                z.style.fontSize="120%";
                z.style.textDecoration="underline";
                  //tr riga e td colonna

                var tbl  = document.getElementById('tab_graf');
                var rows = tbl.getElementsByTagName('tr');
                var chd="t:";
                var chl="";
                for (var row=0; row<rows.length;row++) {
                  var cels = rows[row].getElementsByTagName('td')
                  for(cel=1; cel<cels.length; cel++){
                        cels[cel].style.display='none';
                  }
                  cels[col_no].style.display='';
                    
                    
                   if(row!=0){//devo saltare la prima volta
                       //alert(rows[row].getElementsByClassName("pizza")[0].innerHTML);//nome
                       //alert(cels[col_no].innerHTML);//numero
                       chd+=cels[col_no].innerHTML+",";
                       chl+=rows[row].getElementsByClassName("pizza")[0].innerHTML+"|";
                   }else if(row==0){
                    chtt=(cels[col_no].innerHTML);
                   }
                }
              chl=chl.replace(/&nbsp;/g,"");
              chd = chd.substring(0, chd.length - 1);
              chl = chl.substring(0, chl.length - 1);
              link="http://chart.apis.google.com/chart?cht=p&chs=750x350&chd="+chd+"&chl="+chl+"&chtt="+chtt;
              
              document.getElementById("img_grafico").src=link;
            }
          
        </script>
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
                        <a style="background-color: #ff7200;" href="statistiche.php">STATISTICHE</a>
                    </div>
                 </div>
             </div>
        </div>
        
        <div id="menu_content" >
            <?php include('navigation_bar.php'); ?>
            <div id="content" style="max-width:800px;"> 
                <div class="descrizione" style="margin-left:0px; min-width:780px;">
                    <div class="info_box_top_color">
                        <h3>Statistiche</h3>
                    </div>
                    <div class="box_grafico">
                        <div id="link_container">
                            <a class="link_click" href="#" onclick="show_hide_column(1,this)">Mostra n&deg; di post</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                            <a class="link_click" href="#" onclick="show_hide_column(2,this)">Mostra n&deg; like ricevuti</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                            <a class="link_click" href="#" onclick="show_hide_column(3,this)">Mostra n&deg;commenti ricevuti</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                            <a class="link_click" href="#" onclick="show_hide_column(4,this)">Mostra n&deg;commenti assegnati</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                            <a class="link_click" href="#" onclick="show_hide_column(5,this)">Mostra n&deg; amici</a>
                        </div>
                        <img id="img_grafico" src="immagini/logout.png" alt="immagini/no_image.png">
                    </div>
                    <div class="tabella">
                        <table id="tab_graf">
                            <tr >
                                <td style="width:10%"></td>
                                <td>N&deg; di post</td>
                                <td>N&deg; di like ricevuti</td>
                                <td>N&deg; commenti ricevuti</td>
                                <td>N&deg; commenti assegnati</td>
                                <td>N&deg; di amici</td>
                            </tr>
                            <?php 
                                $conn=dbConnect();
                                $utente=$_SESSION['login_username'];
                                $sql="SELECT * from users where username in(SELECT user2 from amicizie a1 where (a1.user1='".$utente."' and a1.stato=1) UNION SELECT user1 from amicizie a1 where (a1.user2='".$utente."' and a1.stato=1))";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $array=stats($row["username"]);
                                        echo '<tr>';
                                            echo '<td>';
                                                ?>
                                                <img src=<?php echo '"immagini/'.$row['immagine_grande'].'"'; ?> alt="immagini/no_image.png">
                                                <a style="color: #4F00EE;" class="pizza" href=<?php echo '"index.php?q='.$row['username'].'"'; ?>><?php echo ucfirst($row['username'])?>&nbsp;&nbsp;</a>
                                                <?php
                                            echo '</td>';
                                            echo '<td>'.$array['a'].'</td>';
                                            echo '<td>'.$array['b'].'</td>';
                                            echo '<td>'.$array['c'].'</td>';
                                            echo '<td>'.$array['d'].'</td>';
                                            echo '<td>'.$array['e'].'</td>';
                                        echo '</tr>';
                                        
                                    }
                                } 
                                $conn->close();
                            ?>
                        </table>
                    </div>
					<?php if ($result->num_rows == 0) { echo '<script>clearStat();</script> <ul>Non ci sono statistiche da visualizzare</ul>';} ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("include_footer.php"); ?>
</body>
</html>
