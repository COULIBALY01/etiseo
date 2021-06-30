<!doctype html>
<html>
	<head>
		<meta charset='utf8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://d3js.org/d3.v5.js"></script>
		<script src="https://d3js.org/d3.v5.min.js"></script>
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<title>Tableau de bord dynamique</title>
	</head>
	<body>
	<?php
    include('./php/tab_bord.php');
		?>
	<header>
	<!----------Menu------------>
	<h1>WEB DYNAMIQUE</h1>
	
	
	<nav>
		<ul class="menu">
		<li> <a href="#">Qui sommes nous ?</a> </li>
		<li> <a href="#">Tableau de bord</a>
			<!-- SOUS MENU ETAPES-->
			<ul>
			<li><a href="#status1">Status formations</a> </li>
			<li><a href="#client1">Formation client</a> </li>
			<li><a href="#line1">Formations bar</a> </li>
			<li><a href="#line2">Formations ligne</a> </li>
			<li><a href="indexGoogleCharte.php">Google chart</a>
			</ul>
		</li>
		<li> <a href="#">Nos services</a>
			<!-- SOUS MENU SERVICES-->
			<ul>
			<li><a href="#">Service1</a> </li>
			<li><a href="#">Service2</a> </li>
			</ul>
			</li>
		
		</ul>
	</nav>
		</header>
	<!----------fin du menu------------>
	</br></br>
	<hr>
	<center>
	
	<div class="status" >
		<h2 id="status1">Les formations en fonction des statuts</h2>
		<table border=1em>
			<tr>
				<th>source de données</th>
				<th>premère pie</th>
				<th>deuxième pie</th>
			</tr>
			<tr>
				<td>
					<?php $data=nb_formation_status();?>
				</td>	
				<td>					
					<div id="graph" > 
					<script src="./script/camamb.js"></script>
					</div>
				</td>
				<td>
					<div id="chart" >
					<script src="./script/pietooltip.js"></script>
					</div>
				</td>
			</tr>
		</table></br></br>
		<hr border=1em id="trait1"></br></br>
		<table>
			<tr>
				<th><span>Le premier modèle</span></th><th><span>Le second modèle </span></th>
			</tr>
			<tr>
				<td>
					<p class="comPie">
					L'objectif de cette représentation 
					n'est pas de représenter 
					toujours les données de la formation. 
					il s'agit de trouver un programme de pie qui s'adapte à aux 
					données qui respecte le format clé valeur. 
					Pour obtenir cette pie, nous avons fait une requête sql. 
					Les données ont ensuite été encodées en json. 
					Le D3JS nous a permis d'obtenir ce graphique 
					qui est adapté à n'importe quelle donnée en format 
					clé valeur.Nous avons voulu visualiser la situation 
					du statut des formations.
					</p>
				</td>
				<td>
					<p class="comPie">
					Cette deuxième figure est une proposition de représentation
					des données de json de la formation. Elle est également dynamique
					et interactive. Elle peut égament prendre les données en forme de 
					clé valeur.
					</p>
				</td>
			</tr>
		</table>
	</div>
	<hr border=1em id="trait2"></br></br>
	<div> 
		<h2 id="client1">Nombre de formations par client</h2>
		<table border=1em>
			<tr><th>Source de données</th><th>Formations par client</th></tr>
			<tr>
				<td>	
					<?php $nb_clients=nb_formation_client();?>	
				</td>
				<td>
					<div class="client">
				</td>	
			</tr>
		</table>
	</div>
	<div class="sa">
		<h3>Nombre de formations par rapport à SA</h3>
		<?php nb_formation_entreprise('SA')?>
	</div>
	<div class="bnp">
		<h3>Nombre de formations par rapport à BNP</h3>
		<?php nb_formation_entreprise('BNP')?>
	</div>
	<hr></br></br>
	<div class="zoneBar"  >
		<h2 id="line1">Nombre de formations dans le temps</h2>
		<table border=1em>
			<tr><th>Source de données</th><th>Evolutions de la formation dans le temps</th></tr>
			<tr>
				<td>
					<?php $hists=formations_termineDannsLeTemps();?>
				</td>
				<td>
					<div id="bar">
						<script src="./script/exo_histogramme.js"></script>
					</div>
				</td>
			</tr>
		</table ></br></br>
		<hr></br></br>
		<table border="1em">
			<tr><th id="line2">Formation en fonction du temps</th><th>Sources de données</th></tr>
			<tr>
				<td >
					<div id="line"></div>
				</td>
				<td>
				</td>
			</tr>
		</table>
	</div></br>
	<hr><br><br>
	<table>
		<tr><th>Le statut des factures</th></tr>
		<tr>
			<td>
			<div class="fact_four">
			<?php $status_facture=status_facture();?>
	</div>	
			</td>
		</table>
		</div>
	  <div id="template_histogramme">
	  </div>
	  <div id="template_courbe">
	  </div>
	
</center>
	<?php
	echo '<script>
		cammamber('.$data.',"#graph");
		var colorScheme = ["#E57373","#BA68C8","#7986CB"];
    	renderPieChart('.$data.',"#chart",colorScheme);
		cammamber('.$nb_clients.',".client");
		histo('.$hists.',"#bar");
		line('.$hists.',"#line");
		cammamber('.$status_facture.',".fact_four");
	</script>';
	?>
	
	<!--/*************** Partie 5 bas de page **************************/-->
    <footer>
      <div class="footer">
	  <h1>Web dynamique</h1>
        <div class="copyright">
		
          © Graphiques dynamiques Etiseo 
        </div>
    </footer>
	</body>	
</html>



