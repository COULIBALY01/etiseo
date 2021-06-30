
<?php
$sql="SELECT ucm_customer.customer_name, COUNT(*) as value
FROM ucm_training, ucm_customer WHERE ucm_training.customer_id=ucm_customer.customer_id 
GROUP BY ucm_customer.customer_name";
$sth = $dbh->prepare($sql);
$sth->execute();
$result = $sth->fetchAll();
?>