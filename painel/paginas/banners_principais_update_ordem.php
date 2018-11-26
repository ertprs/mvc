<?php

#### CONEXÃO
include "../conecta.php";

$action = mysql_real_escape_string($_POST['action']);
$atualizarRecordsArray 	= $_POST['recordsArray'];


$listingCounter = 1;
foreach($atualizarRecordsArray as $recordIDValue){
	$query = "UPDATE banner_principal SET ordem='".$listingCounter."' WHERE id='".$recordIDValue."'";
	mysql_query($query) or die('Error, insert query failed');
	$listingCounter = $listingCounter + 1;
}

echo '<pre>';
print_r($atualizarRecordsArray);
echo '</pre>';
echo 'If you refresh the page, you will see that records will stay just as you modified.';

?>