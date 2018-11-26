<?php
if($_GET['acao'] == 'logout'){
    session_destroy();
    echo "<script>location.href = '?secao=main';</script>";
}

if($_GET['estado'] != ''){
    $_SESSION['painel_estado'] = $_GET['estado'];
    echo "<script>location.href = '?secao=main';</script>";
}

?>


<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Últimos <b>contatos por email</b> enviados</h3>
                    </div>

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color:<?=$cor2;?>; color:#fff;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor2;?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT id,data,nome FROM fale_conosco WHERE estado_id='".$_SESSION['painel_estado']."' ORDER BY data DESC LIMIT 15";
                                $sql = mysql_query($sql);
                                if(mysql_num_rows($sql) > 0){
                                    while($linha = mysql_fetch_assoc($sql)){
                                        echo "
                                        <tr>

                                            <td class='text-center' style='vertical-align:middle;'>".date("d/m/Y H:i:s", strtotime($linha['data']))."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha['nome'] ."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=fale_conosco_detalhes&id=".$linha['id']."' data-toggle='tooltip' data-placement='top' title='Visualizar'>
                                                    <img src='imagens/add.png' height='20'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='3' class='text-center' style='vertical-align:middle;'>Nenhum contato encontrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Últimos <b>Ligamos para você</b> encontrados</h3>
                    </div>

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color:<?=$cor2;?>; color:#fff;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor2;?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT id,data_cadastro,nome FROM ligamos_para_voce WHERE estado_id='".$_SESSION['painel_estado']."' ORDER BY data_cadastro DESC LIMIT 15";
                                $sql = mysql_query($sql);
                                if(mysql_num_rows($sql) > 0){
                                    while($linha = mysql_fetch_assoc($sql)){
                                        echo "
                                        <tr>
                                            <td class='text-center' style='vertical-align:middle;'>".date("d/m/Y H:i:s", strtotime($linha['data_cadastro']))."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha['nome'] ."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=ligamos_para_voce_detalhes&id=".$linha['id']."' data-toggle='tooltip' data-placement='top' title='Visualizar'>
                                                    <img src='imagens/add.png' height='20'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='3' class='text-center' style='vertical-align:middle;'>Nenhuma inscrição encontrada encontrada!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Empreendimentos <b>mais visualizados</b></h3>
                    </div>

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color:<?=$cor2;?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor2;?>; color:#fff;" class="text-center">Visualizações</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT id,n_visualizacoes,nome FROM empreendimento WHERE estado_id='".$_SESSION['painel_estado']."' ORDER BY n_visualizacoes DESC LIMIT 10";
                                $sql = mysql_query($sql);
                                if(mysql_num_rows($sql) > 0){
                                    while($linha = mysql_fetch_assoc($sql)){
                                        echo "
                                        <tr>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha['nome'] ."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha['n_visualizacoes'] ."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=empreendimentos_detalhes&id=".$linha['id']."' data-toggle='tooltip' data-placement='top' title='Visualizar'>
                                                    <img src='imagens/add.png' height='20'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='3' class='text-center' style='vertical-align:middle;'>Nenhuma emprendimento encontrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.bg-gradient h3{color:#fff;}
.bg-gradient p{color:#fff;}
</style>
