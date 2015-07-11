
<div class="descrizione" style="float:left;margin-left:0px;min-width:650px;width:60%;">
	<div class="info_box_top_color">
		<h3>Cerca un amico</h3>
	</div>

	<div id="container_cerca">
		<img id="immagine_cerca" style="margin:0" src="immagini/Lente.png" alt="immagini/no_image.png">
		<div id="testo_cerca">Inserisci il nome del amico cercato</div><br>
		<div style="margin-left: auto;margin-right: auto;width: 65%;">
			<table id="cerca_friends">
			  <tr>
				<td>Voglio vedere</td>
				<td><input type="radio" name="c_search" value="tutti" onchange="showHint()" checked>Tutti</td>
				<td><input type="radio" name="c_search" value="solo_amici" onchange="showHint()">Solo amici</td>
			  </tr>
			  <tr>
				<td>Ordina per</td>
				<td><input type="radio" name="c_result" value="nome_completo" onchange="showHint()" checked>Nome</td>
				<td><input type="radio" name="c_result" value="username" onchange="showHint()">Username</td>
			  </tr>
			</table>
		</div>
		<form id="form_cerca"> 
		<input type="text" id="txt1" placeholder="Cerca persone" style="width:75.5%;" onkeyup="showHint()">
		</form>

		<div id="txtHint">
		</div>
	</div>
</div>
