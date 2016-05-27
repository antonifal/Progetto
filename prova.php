<?php
require_once('connection.class.php');
$data_obj=new connection;
$data_obj->connect();
$data_obj->send_query("SELECT * FROM tabellaC ORDER BY codifica","codicefiscale");
$data=$data_obj->get_resource_array();

print_r($data);
//print_r(array_flip($data));
$data_obj->disconnect();

?>
