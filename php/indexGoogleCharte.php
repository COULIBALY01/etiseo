<!doctype html>
<html>
	<head>
		<meta charset='utf8'/>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
		<script src="https://d3js.org/d3.v5.js"></script>
		<script src="https://d3js.org/d3.v5.min.js"></script>
		<script src="./script/graphchart.js"></script>
		<script src="./script/camamb.js"></script>
		<script src="./script/client.js"></script>
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
		<h1>Tableau de bord dynamique</h1>
		<h2>Nombre de formations par client</h2>
		
		<table>
		<tr>
			<td><?php $data=nb_formation_client();?></td>
			<td><div id="Sarah_chart_div" ></div></td>
		</tr>
		</table>
		
		</div>
		
		<?php
		echo "<script>
			client('.$data.')
		</script>";
		?>
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
	<?php
	echo '<script id="graph1">
		cammamber('.$data.')
	</script>';
	?>
	
	</body>
	
</html>



