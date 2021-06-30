<?php
function connect_dbh(){
    $dsn = "mysql:host=localhost;dbname=dmm-crm";  /* Data Source Name */
    $username = "root"; $pass = "";
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $dbh = new PDO($dsn, $username, $pass, $options);
        return $dbh;
    } catch (PDOException $e) {
        die( "connection failed: ");
        echo 'Connection failed: ' . $e->getMessage();
    }
}


if (!defined('BASEPATH'))
exit ('No direct script access allowed');
class chart_model extends CI_Model{
    function get_services_has_offers(){
        return $dbh->db->query('SELECT ucm_customer.customer_name as name, COUNT(*) as value
        FROM ucm_training, ucm_customer WHERE ucm_training.customer_id=ucm_customer.customer_id 
        GROUP BY ucm_customer.customer_name'
        )->result_array();
    }
}
var_dump(result_array());
?>