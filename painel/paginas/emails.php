<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM emails WHERE id='".$_GET['deletar']."'";
    
    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Email deletado com sucesso!</p>";
        
    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o email!</p>";
    }
}




$condicao = '';

if(!empty($_GET['periodo'])){
    if($_GET['periodo'] == 'de-hoje'){
        $condicao .= " AND DATE_FORMAT(data,'%Y-%m-%d') = '".date('Y-m-d')."' ";
    
    }elseif($_GET['periodo'] == 'dessa-semana'){
        $data = date('Y-m-d')." 00:00:00";
    
        $dia = abs(date('w',strtotime($data)));
        
        if($dia == 0){
            $domingo = $data;
            $sabado = date('Y-m-d',strtotime("+6 day", strtotime($data)));
        }else{
            $domingo = date('Y-m-d',strtotime("-".$dia." day", strtotime($data)));
            $sabado = date('Y-m-d',strtotime("+6 day", strtotime($domingo)));
        }
        
        $condicao .= " AND DATE_FORMAT(data,'%Y-%m-%d') BETWEEN '".$domingo."' AND '".$sabado."'";
    
    }elseif($_GET['periodo'] == 'desse-mes'){
        $condicao .= " AND date_format(data, '%m') = '".date('m')."' AND date_format(data, '%Y') = '".date('Y')."' ";
    }
}






$num_por_pagina = 20;
if(empty($_GET['pagina'])){$_GET['pagina'] = 1;}
$primeiro_registro = (abs($_GET['pagina']) * $num_por_pagina) - $num_por_pagina;


// REGISTROS
$emails = array();
$sql_emails = "SELECT id,data,nome,email FROM emails WHERE id=id ".$condicao." ORDER BY nome ASC";

$total_emails = mysql_num_rows(mysql_query($sql_emails));
$sql_emails = mysql_query($sql_emails." LIMIT ".$primeiro_registro.", ".$num_por_pagina."") or die (mysql_error());
if(mysql_num_rows($sql_emails) > 0){
    while($linha_emails = mysql_fetch_assoc($sql_emails)){
        $emails[] = $linha_emails;
    }                                
}

// PAGINACAO
$paginacao = paginacao($_GET['pagina'], "?secao=".$_GET['secao']."&periodo=".$_GET['periodo']."&nome=".$_GET['nome']."&email=".$_GET['email']."", $total_emails, $num_por_pagina);



?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Emails
            <small>listar</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <?=$mensagem?>

                        <div class="col-sm-12">
                            <center>
                                <select name="select" onChange="MM_jumpMenu('parent',this,1)" class="form-control" style="max-width:200px;">
                                    <option value="?secao=emails"                         <?php if(empty($_GET['periodo'])){              ?>selected<?php } ?>>Períodos       </option>
                                    <option value="?secao=emails&periodo=de-hoje"         <?php if($_GET['periodo'] == 'de-hoje'){        ?>selected<?php } ?>>De hoje        </option>
                                    <option value="?secao=emails&periodo=dessa-semana"    <?php if($_GET['periodo'] == 'dessa-semana'){   ?>selected<?php } ?>>Dessa semana   </option>
                                    <option value="?secao=emails&periodo=desse-mes"       <?php if($_GET['periodo'] == 'desse-mes'){      ?>selected<?php } ?>>Desse mês      </option>
                                </select>
                            </center>
                        </div>

                        
        
                        <br clear="all">

                        <table id="example2" class="table table-bordered table-hover" style="margin-top:10px;">
                            <thead>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Data de cadastro</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Email</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(mysql_num_rows($sql_emails) > 0){
                                    foreach($emails as $linha_emails){
                                        echo "
                                        <tr> 
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_emails['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".date("d/m/Y H:i:s", strtotime($linha_emails['data']))."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".($linha_emails['nome'])."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_emails['email']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=emails&deletar=".$linha_emails['id']."' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                    <img src='imagens/cancel.png' height='18'>
                                                </a> 
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr> 
                                        <td colspan='5' class='text-center' style='vertical-align:middle;'>Nenhum email encontrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Data de cadastro</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Email</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <br clear="all">
            <?=$paginacao?>
            <br clear="all">
        </div>
    </section>
</div>


<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
//-->
</script>
    