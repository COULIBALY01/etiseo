<!doctype html>
<html>
	<head>
		<meta charset='utf8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://d3js.org/d3.v5.js"></script>
		<script src="https://d3js.org/d3.v5.min.js"></script>
  			
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
        <title>Tableau de bord dynamique</title>
	</head>
	<body>
	<?php
    include('./php/tab_bord.php');
		?>
<header>
	<!----------Menu------------>
	<div class="container">
	<!--comment git four git -->
		<H1>Tableau de bord dynamique</H1>
	</div>
	<nav id="navbar_top" class="navbar navbar-expand-md bg-dark navbar-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
        <a class="navbar-brand" href="#"><i class="fa fa-fw fa-home"></i>WEB DYNAMIQUE</a>
           
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleLogin">
			<i class="fa fa-fw fa-user"></i>
		</button>
			<!-- Navbar links -->
 		<div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="nav navbar-nav navbar-expand-lg navbar-inner">
                <li class="nav-item"> <a class="nav-link" href="#">Qui sommes nous ?</a> </li>
                <li class="dropdown nav-item"> 
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Tableau de bord
                    <span class="caret"></span>
				</a>
               
                    <!-- SOUS MENU ETAPES-->

                <ul class="dropdown-menu bg-dark navbar-dark ">
                    <li class="nav-item"><a class="nav-link" href="#status1">Status formations</a> </li>
                    <li class="nav-item"><a class="nav-link" href="#client1">Formation client</a> </li>
                    <li class="nav-item"><a class="nav-link" href="#line1">Formations bar</a> </li>
                    <li class="nav-item"><a class="nav-link" href="#line2">Formations ligne</a> </li>
                    <li class="nav-item"><a class="nav-link" href="indexGoogleCharte.php">Google chart</a>
                </ul>
                </li>
                <li class="nav-item dropdown"> 
                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Nos services
                    <span class="caret"></span>
                </a>

					<!-- SOUS MENU SERVICES-->
					<ul class="dropdown-menu bg-dark navbar-dark">
						<li class="nav-item"><a class="nav-link" href="#">Service1</a> </li>
						<li class="nav-item"><a class="nav-link" href="#">Service2</a> </li>
					</ul>
                </li>
            </ul>
			<form class="navbar-form navbar-right" action="./index2.php">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
					<div class="input-group-btn">
					<button class="btn btn-success" type="submit">Search</button>
					</div>
				</div>
			</form>
		</div>
                
		<div class="collapse navbar-collapse" id="collapsibleLogin">
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-user"></i>Sign Up</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-fw fa-sign-in"></i> Login</a></li>
			</ul>
		</div>
	</nav>
    </header>
	<!----------fin du menu------------>

<!-- Modal -->
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Connexion</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
		<form action="/action_page.php">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" placeholder="Enter email" id="email">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" placeholder="Enter password" id="pwd">
			</div>
			<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<div class="container">
	<div class="col-12 py-4">
	<div class="status" >
		<h2 id="status1">Les formations en fonction des statuts</h2>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>source de données</th>
					<th>premère pie</th>
					<th>deuxième pie</th>
				</tr>
			</thead>
			<tr>
				<td>
					<?php $data=nb_formation_status();?>
				<td id="graph">						 
					<script src="./script/camamb.js"></script>
				</td>
				<td id="chart">
					<script src="./script/pietooltip.js"></script>
				</td>
			</tr>
		</table>
		
		<table class="table table-bordered">
			<thead>
			<tr>
				<th><span>Le premier modèle</span></th><th><span>Le second modèle </span></th>
			</tr>
			</thead>
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
	
		<div id="client1"> 
			<h2 >Nombre de formations par client</h2>
			<table class="table table-bordered">
				<thead><tr><th>Source de données</th><th>Formations par client</th></tr></thead>
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
			<table class="table table-bordered">
				<?php nb_formation_entreprise('SA')?>
			</table>
		</div>
	
		<div class="bnp">
			<h3>Nombre de formations par rapport à BNP</h3>
			<table class="table table-bordered">
				<?php nb_formation_entreprise('BNP')?>
			</table>
		</div>
	
		<div class="zoneBar"  >
			<h2 id="line1">Nombre de formations dans le temps</h2>
			<table class="table table-bordered">
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
			</table >
			<table class="table table-bordered">
				<tr><th id="line2">Formation en fonction du temps</th><th>Sources de données</th></tr>
				<tr>
					<td >
						<div id="line"></div>
					</td>
					<td>
					</td>
				</tr>
			</table>
		</div>
	
		<table class="table table-bordered"e>
			<tr><th>Le statut des factures</th></tr>
			<tr>
				<td>
				<div class="fact_four">
				<?php $status_facture=status_facture();?>

				</td>
			</table>
		
		<div id="template_histogramme">
		</div>
		<div id="template_courbe">
		</div>
	
	</div>
	</div>
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
    <footer class="bg-dark text-center text-white">
      <div class="footer">
	  <h1>Web dynamique</h1>
        <div class="copyright">
		
          © Graphiques dynamiques Etiseo 
        </div>
    </footer>

	<script>
		document.addEventListener("DOMContentLoaded", function(){
 		window.addEventListener('scroll', function() {
		if (window.scrollY > 50) {
			document.getElementById('navbar_top').classList.add('fixed-top');
			// add padding top to show content behind navbar
			navbar_height = document.querySelector('.navbar').offsetHeight;
			document.body.style.paddingTop = navbar_height + 'px';
		} else {
			document.getElementById('navbar_top').classList.remove('fixed-top');
			// remove padding top from body
			document.body.style.paddingTop = '0';
		} 
	});
	}); 
	</script>
	</body>	
</html>


