<?php
	/**
	 * Cette fonction permet de se connecter à la base de donnée et 
	 * retourne la valuer de la connectionn
	 */
	function connect_dbh(){
		$dsn = "mysql:host=localhost;dbname=dmm-crm";  /* Data Source Name */
		$username = "root"; $pass = "";
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		try {
			$dbh = new PDO($dsn, $username, $pass, $options);
			return $dbh;
		} 
		catch (PDOException $e) {
			die( "connection failed: ");
			echo 'Connection failed: ' . $e->getMessage();
		} 
	}

	/**
	 * Cette fonction permet de recupérer les données 
	 * des formations par aux client
	 */
	function nb_formation_client(){
		$client="SELECT ucm_customer.customer_name as name, COUNT(*) as value
			FROM ucm_training, ucm_customer 
			WHERE ucm_training.customer_id=ucm_customer.customer_id 
			GROUP BY ucm_customer.customer_name";
		$cli=connect_dbh()->prepare($client);
		$cli->execute();  
		$res= $cli->fetchAll();
		
		
		echo "<table border='1'>";
		echo "<th>Noms clients</th><th>formation</th>";
		foreach (@$res as $e) {	
			echo "<tr><td>".$e['name']."</td><td>".$e['value']."</td></tr>";			
		}	
		echo "</table>";
		return json_encode($res,JSON_NUMERIC_CHECK);	
		
	}
	function chart( $data ){
		echo '<script>';
		echo client('.$data.');
		echo '</script>';
		}
		
	// nombre de formation par rapport client entreprise 
	function nb_formation_entreprise($name){
		$sa="SELECT customer_name, COUNT(*)
		FROM ucm_customer, ucm_training 
		WHERE ucm_customer.customer_id= ucm_training.customer_id
		AND ucm_customer.customer_name='$name'";
		$sa1=connect_dbh()->prepare($sa);
		$sa1->execute();  
		$r= $sa1->fetchAll();
		show_table_client($r);
		return json_encode($sa1,JSON_NUMERIC_CHECK);
	}
	
	//nb formation par status
	function nb_formation_status(){
		$sql="SELECT  ucm_training_old.status as name, COUNT(*) as value 
		FROM ucm_training_old GROUP BY ucm_training_old.status";
		$sth = connect_dbh()->prepare($sql);
		$sth->execute();  
		$result = $sth->fetchAll();
		
		
		echo "<table border='1'>";
		echo "<th>Status</th><th>formation</th>";
		foreach ($result as $enr) {	
			echo "<tr><td>".$enr['name']."</td><td>".$enr['value']."</td></tr>";
		}
		echo "</table>";
		return json_encode($result,JSON_NUMERIC_CHECK);
		console_log($result);
	}
	
	function formations_termineDannsLeTemps(){
		$sqlt="CALL `For_Temps`()";
		$sthh = connect_dbh()->prepare($sqlt);
		$sthh->execute();  
		$status_termine = $sthh->fetchAll();
		
		
		echo "<table border='1'>";
		echo "<th>année</th><th>status terminé</th>";
		foreach ($status_termine as $enr) {	
			echo "<tr><td>".$enr['created']."</td><td>".$enr['termine']."</td></tr>";
		}
		echo "</table>";
		return json_encode($status_termine,JSON_NUMERIC_CHECK);
	}
	
	function status_facture(){
		$status_fac="CALL `status_facture`()";
		$sthh = connect_dbh()->prepare($status_fac);
		$sthh->execute();  
		$status_facture = $sthh->fetchAll();
		
		
		/*echo "<table border='1'>";
		echo "<th>année</th><th>status terminé</th>";
		foreach ($status_facture as $enr) {	
			echo "<tr><td>".$enr['created']."</td><td>".$enr['termine']."</td></tr>";
		}
		echo "</table>";*/
		return json_encode($status_facture,JSON_NUMERIC_CHECK);
	}
		
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
		}
		
	function plot_chart( $data ){
		echo '<script>';
		echo 'cammamber('. json_encode( $data ) .')';
		echo '</script>';
		}

	function show_table_client($res){
		echo "<table border='1' class='table table-bordered'>";
		echo "<th>Noms clients</th><th>formation</th>";
		foreach (@$res as $e) {
			echo "<tr><td>".$e['customer_name']."</td><td>".$e['COUNT(*)']."</td></tr>";		
			}		
			echo "</table>";
			
		}	
?>
		  
	
		