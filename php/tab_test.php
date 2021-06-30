<?php

	$dsn = "mysql:host=localhost;dbname=dmm-crm";  /* Data Source Name */
	$username = "root"; $pass = "";
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
	$dbh = new PDO($dsn, $username, $pass, $options);

	if (@$dbh->connect_error) {
		die( "connection failed: " .$dbh->connect_error);
	}
	else {
	
		}
?>
<!doctype html>
<html>
	<head>
		<meta charset='utf8'/>
		<title>Tableau de bord dynamique</title>
	</head>
	<body>
		<?php
		

		/*$sql="SELECT ucm_training_old.training_id, ucm_training_old.name, ucm_training_old.status FROM ucm_training_old";
		$sth = $dbh->prepare($sql);
				$sth->execute();  
		$result = $sth->fetchAll();
		//var_dump($result);
		echo "<table border='1'>";
		echo "<th>Training_id</th><th>Name</th><th>Status</th>";
		foreach ($result as $enr) {
				
				echo "<tr><td>".$enr['training_id']."</td><td>".$enr['name']."</td><td>".$enr['status']."</td></tr>";
					
				}
				
		echo "</table>";*/

		// calcul du nombre de formation par client

		$client="SELECT ucm_customer.customer_name, COUNT(*) FROM ucm_training, ucm_customer WHERE ucm_training.customer_id=ucm_customer.customer_id";
		$cli=$dbh->prepare($client);
		$cli->execute();  
		$res= $cli->fetchAll();
		//var_dump($res);
		?>
		<div>
		
		<?php
		echo "<h1>Tableau de bord dynamique</h1>";
		echo"<h2>Nombre de formations par client</h2>";
		echo "<table border='1'>";
		echo "<th>Noms clients</th><th>formation</th>";
		foreach (@$res as $e) {	
			echo "<tr><td>".$e['customer_name']."</td><td>".$e['COUNT(*)']."</td></tr>";		
					}	
			echo "</table>";
		?>
		
		
		</div>
		<?php
		$sa="SELECT customer_name, COUNT(*) 
			FROM ucm_customer, ucm_training 
			WHERE ucm_customer.customer_id= ucm_training.customer_id
			AND ucm_customer.customer_name='SA'";
		$sa1=$dbh->prepare($sa);
		$sa1->execute();  
		$r= $sa1->fetchAll();
		//var_dump($r);
		
		?>
		<div>
		<?php
		echo"<h3>Nombre de formations par rapport à SA</h3>";
		echo "<table border='1'>";
		echo "<th>Noms clients</th><th>formation</th>";
		foreach (@$r as $e) {
			echo "<tr><td>".$e['customer_name']."</td><td>".$e['COUNT(*)']."</td></tr>";		
			}		
			echo "</table>";	
		?>
		</div>
		

		<?php
		$bnp="SELECT customer_name, COUNT(*) 
			FROM ucm_customer, ucm_training 
			WHERE ucm_customer.customer_id= ucm_training.customer_id
			AND ucm_customer.customer_name='BNP'";
		
		$bnp1=$dbh->prepare($bnp);
		$bnp1->execute();  
		$a= $bnp1->fetchAll();
		//var_dump($a);
		?>
		<div>
		<?php
			echo"<h3>Nombre de formations par rapport à BNP</h3>";
			echo "<table border='1'>";
			echo "<th>Noms clients</th><th>formation</th>";
			foreach (@$a as $e) {	
				echo "<tr><td>".$e['customer_name']."</td><td>".$e['COUNT(*)']."</td></tr>";	
				}
			echo "</table>";
		?>
		</div>
		
		
		<div>
		<?php
		$sql="SELECT  ucm_training_old.status, COUNT(*) FROM ucm_training_old GROUP BY ucm_training_old.status";
		$sth = $dbh->prepare($sql);
		$sth->execute();  
		$result = $sth->fetchAll();
			//var_dump($result);
		echo "<h2>Les formations en fonction des status</h2>";
		echo "<table border='1'>";
		echo "<th>Status</th><th>formation</th>";
		foreach ($result as $enr) {	
			echo "<tr><td>".$enr['status']."</td><td>".$enr['COUNT(*)']."</td></tr>";				
			}		
			echo "</table>";
		?>
		</div>
		
		
		<div class="Graph">
		<?php
		/*echo"<img src='./graph1.php' />";*/
		?>
		</div>
	</body>
</html>