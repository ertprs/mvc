<?php

$array = array(

    array(
        'nome_grupo' => 'Banners Principais',
        'campos'     => array(
            'banners_principais'           => 'Listar',
            'banners_principais_cadastrar' => 'Cadastrar',
            'banners_principais_editar'    => 'Editar',
            'banners_principais_deletar'   => 'Deletar'
        )
    ),

    array(
        'nome_grupo' => 'A Empresa',
        'campos'     => array(
            'a_empresa' => 'Texto principal'
        )
    ),

    array(
        'nome_grupo' => 'Clientes',
        'campos'     => array(
            'clientes'           => 'Listar',
            'clientes_deletar'   => 'Deletar'
        )
    ),

    array(
        'nome_grupo' => 'Produtos',
        'campos'     => array(
            'produtos'           => 'Listar',
            'produtos_cadastrar' => 'Cadastrar',
            'produtos_editar'    => 'Editar',
            'produtos_deletar'   => 'Deletar'
        )
    ),

    array(
        'nome_grupo' => 'Produtos - Categorias',
        'campos'     => array(
            'produtos_categorias'           => 'Listar',
            'produtos_categorias_cadastrar' => 'Cadastrar',
            'produtos_categorias_editar'    => 'Editar',
            'produtos_categorias_deletar'   => 'Deletar'
        )
    ),




    array(
        'nome_grupo' => 'Orçamentos',
        'campos'     => array(
            'orcamentos'           => 'Listar',
            'orcamentos_editar'    => 'Editar',
            'orcamentos_deletar'   => 'Deletar'
        )
    ),

    array(
        'nome_grupo' => 'Parceiros',
        'campos'     => array(
            'parceiros'           => 'Listar',
            'parceiros_cadastrar' => 'Cadastrar',
            'parceiros_editar'    => 'Editar',
            'parceiros_deletar'   => 'Deletar'
        )
    ),


    array(
        'nome_grupo' => 'Notícias',
        'campos'     => array(
            'noticias'           => 'Listar',
            'noticias_cadastrar' => 'Cadastrar',
            'noticias_editar'    => 'Editar',
            'noticias_deletar'   => 'Deletar'
        )
    ),

    /*
array(
        'nome_grupo' => 'Vídeos',
        'campos'     => array(
            'videos'           => 'Listar',
            'videos_cadastrar' => 'Cadastrar',
            'videos_editar'    => 'Editar',
            'videos_deletar'   => 'Deletar'
        )
    ),
*/

    array(
        'nome_grupo' => 'Fale conosco',
        'campos'     => array(
            'fale_conosco_texto'     => 'Texto principal',
            'fale_conosco'           => 'Listar',
            'fale_conosco_deletar'   => 'Deletar'
        )
    ),

   /*
 array(
        'nome_grupo' => 'Trabalhe conosco',
        'campos'     => array(
            'trabalhe_conosco_texto'     => 'Texto principal',
            'trabalhe_conosco'           => 'Listar',
            'trabalhe_conosco_deletar'   => 'Deletar'
        )
    ),
*/



     /*array(
        'nome_grupo' => 'Newsletter',
        'campos'     => array(
            'emails'         => 'Listar',
            'emails_deletar' => 'Deletar'
        )
    ),

   
array(
        'nome_grupo' => 'Ligamos para você',
        'campos'     => array(
            'ligamos_para_voce'         => 'Listar',
            'ligamos_para_voce_deletar' => 'Deletar'
        )
    ),
*/

    array(
        'nome_grupo' => 'Usuários',
        'campos'     => array(
            'usuarios'           => 'Listar',
            'usuarios_cadastrar' => 'Cadastrar',
            'usuarios_editar'    => 'Editar',
            'usuarios_deletar'   => 'Deletar'
        )
    ),

    array(
        'nome_grupo' => 'Níveis',
        'campos'     => array(
            'niveis'           => 'Listar',
            'niveis_cadastrar' => 'Cadastrar',
            'niveis_editar'    => 'Editar',
            'niveis_deletar'   => 'Deletar',
            'permissoes_acesso'   => 'Permissões de acesso'
        )
    )
);



if(!empty($_POST) && $_GET['acao'] == 'atualizar'){
    $ok = 1;
    foreach($_POST['nivel'] as $id_nivel=>$linha_nivel){
        mysql_query("DELETE FROM nivel_permissao WHERE nivel='".$id_nivel."'");

        foreach($linha_nivel as $nome_campo => $valor_campo){
            if(!mysql_query("INSERT INTO nivel_permissao (nivel,pagina) VALUES ('".$id_nivel."','".$nome_campo."');")){
                $ok = 0;
            }
        }
    }

    if($ok = 1){
        $permissoes = array();
        $sql_permissoes = "SELECT pagina FROM nivel_permissao WHERE nivel='".$_SESSION['nivel_online']."'";
        $sql_permissoes = mysql_query($sql_permissoes);
        while($linha_permissoes = mysql_fetch_assoc($sql_permissoes)){
            $permissoes[$linha_permissoes['pagina']] = 1;
        }

        $_SESSION['permissoes'] = $permissoes;

        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Acessos atualizados com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger'>Não foi possível efetuar a atualização!</p>";
    }
}

$niveis = array();
$sql_niveis = "SELECT id,nome FROM nivel ORDER BY nome ASC";
$sql_niveis = mysql_query($sql_niveis) or die (mysql_error());
if(mysql_num_rows($sql_niveis) > 0){
    while($linha_niveis = mysql_fetch_assoc($sql_niveis)){
        $niveis[] = $linha_niveis;
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Permissões de acesso
            <small>listar</small>
        </h1>

        <div class="pull-right"></div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" action="?secao=permissoes_acesso&acao=atualizar" method="post"  enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-body">
                            <br clear="all">
                            <?=$mensagem?>

                            <table id="example2" class="ordem-table table table-bordered table-hover">
                                <tbody>
                                    <?php foreach($array as $linha){ ?>
                                        <?php if(!empty($linha['titulo_agrupado'])){ ?>
                                            <tr height="60">
                                                <td class='text-center' style='vertical-align:middle; background-color:<?=$cor1?>; color:#fff; width:120px; font-size:20px;' colspan="<?=(count($niveis) + 1)?>"><?=$linha['titulo_agrupado']?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <td class='text-center' style='vertical-align:middle; background-color:#444; color:#fff; width:120px; font-size:20px;' colspan="<?=(count($niveis) + 1)?>"><?=$linha['nome_grupo']?></td>
                                        </tr>

                                        <tr>
                                            <td style="background-color:<?=$cor1?>; color:#fff; width:20%" class="text-center"></td>
                                            <?php foreach($niveis as $linha_niveis){ ?>
                                                <td style='background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:120px;' class='text-center'><?=$linha_niveis['nome']?></td>
                                            <?php } ?>
                                        </tr>

                                        <?php foreach($linha['campos'] as $key => $linha_campos){ ?>
                                            <tr>
                                                <td class='text-right' style='vertical-align:middle;'><?=$linha_campos?></td>
                                                <?php foreach($niveis as $linha_niveis){ ?>
                                                    <td class='text-center' style='vertical-align:middle;'>
                                                        <input type="checkbox" name="nivel[<?=$linha_niveis['id']?>][<?=$key?>]" class="flat-red" value='1' <?=(checa_permissao($linha_niveis['id'],$key) ? "checked" : "");?>>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>

                                        <tr height="30">
                                            <td class='text-right' style='vertical-align:middle;' colspan="<?=(count($niveis) + 1)?>"></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br clear="all">

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>




