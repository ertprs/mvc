<?php
// Primeiro vamos nos conectar ao MySQL.
include "conecta.php";

// Agora vamos pegar os dados e envia-los para o excel.

$select = "SELECT * FROM pedidos order by nome ASC";         
      
$export = mysql_query($select);
$fields = mysql_num_fields($export);

for ($i = 0; $i < $fields; $i++) {
    $header .= mysql_field_name($export, $i) . "\t";
}

while($row = mysql_fetch_row($export)) {
    $line = '';
    foreach($row as $value) {                                           
        if ((!isset($value)) OR ($value == "")) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line)."\n";
}
$data = str_replace("\r","",$data);

if ($data == "") {
    $data = "\n(0) Records Found!\n";                       
}
// Agora vai ser iniciado o download do arquivo do excel.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=pedidos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>  