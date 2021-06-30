<!doctype html>
<html>
	<head>
		<meta charset='utf8'/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="./css/styles.css">
		<title>Tableau de bord dynamique</title>
	</head>
	<body>
		<?php
			include('./php/tab_bord.php');
			include('./php/goog.php');
		?>
	<center>
		<div class="client">
		<h1>Exemple des graphiques google chart</h1>
		<h2>Nombre de formations par client</h2>
		<table>
		<tr>
			<td><?php $data=nb_formation_client();?></td>
			<td><div id="Sarah_chart_div" ></div></td>
		</tr>
		</table>
		</div>
		<div class="sa">
			<h3>Nombre de formations par rapport à SA</h3>
			<?php nb_formation_entreprise('SA')?></div>
		<div class="bnp">
			<h3>Nombre de formations par rapport à BNP</h3>
			<?php nb_formation_entreprise('BNP')?>
		</div>
	
		<div class="status" >
			<h2>Les formations en fonction des status</h2>
			<table>
			<tr>
				<td><?php $data=nb_formation_status();?></td>
				<td><div id="Anthony_chart_div" ></div></td>
			</tr>
			</table>
			
		</div>
		
	<center>
	
	
	</body>
	
</html>



