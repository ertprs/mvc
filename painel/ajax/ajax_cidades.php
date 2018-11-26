<option value=''></option>

<?php
ini_set('display_errors',false);
include "../conecta.php";
mysql_query("SET CHARACTER SET utf8");

$estado = mysql_real_escape_string($_POST['estado']);

$sql = mysql_query("SELECT id,nome FROM cidade WHERE estado_id='".$estado."' ORDER BY nome ASC");
while($linha = mysql_fetch_assoc($sql)){
    echo "<option value='".$linha['id']."' ".($linha['id'] == $_POST['selecionado'] ? "seleted" : "").">".$linha['nome']."</option>";
}
?>
