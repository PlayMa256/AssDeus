<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Editar Congrega&ccedil;&otilde;es | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->

	<div id="corpo">
        <div id="conteudo">
            <h2>Gerenciar Congrega&ccedil;&atilde;o</h2>
            <form method="post" enctype="multipart/form-data">
                <?php
                if(isset($_GET)){
                    $id = (int)$_GET['id'];
                    $ed = mysql_query("SELECT * FROM congregacao WHERE id = '$id'");
                    $resultado = mysql_fetch_array($ed);

                }
                ?>
                <fieldset>
                    <label>
                        <span>Nome da Congrega&ccedil;&atilde;o</span>
                        <input type="text" name="nome" value="<?php echo $resultado['nome']; ?>" />
                    </label>

                        <span>Estado</span>
                        <select name="estado" id="estado" style="margin-bottom:5px;">
                            <option value="" selected="selected">Selecione estado</option>
                            <?php
                            $consulta = mysql_query("SELECT DISTINCT uf FROM tb_cidades ORDER BY uf ASC");
                            while($ln = mysql_fetch_array($consulta)){
                                if($resultado['estado'] == $ln['uf']){
                                    echo '<option value="'.$ln['uf'].'" selected="selected">'.$ln['uf'].'</option>';
                                }else{
                                    echo '<option value="'.$ln['uf'].'">'.$ln['uf'].'</option>';
                                }

                            }
                            ?>
                        </select>
                        <script type="text/javascript">
                                var estado = $("#estado").val();
                                var cidade = <?php echo $resultado['cidade'];?>;
                                $.post("../scripts/volta-cidade-edit.php",
                                    {estado:estado, cidade:cidade},
                                    function(valor){
                                        $("select[name=cidade]").html(valor);
                                    }
                                )


                        </script>
                    <span>Cidade</span>
                    <select name="cidade">
                            <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>
                        </select>

                    <label for="">
                        <span>Endere&ccedil;o</span>
                        <input type="text" name="endereco" value="<?php echo $resultado['endereco'];?>"/>
                    </label>
                    <label for="">
                        <span>Bairro</span>
                        <input type="text" name="bairro" value="<?php echo $resultado['bairro'];?>"/>
                    </label>
                    <label for="">
                        <span>Telefone 1</span>
                        <input type="text" name="tel1" value="<?php echo $resultado['telefone1'];?>"/>
                    </label>
                    <label for="">
                        <span>Telefone 2</span>
                        <input type="text" name="tel2" value="<?php echo $resultado['telefone2'];?>"/>
                    </label>
                    <label for="">
                        <span>E-mail</span>
                        <input type="text" name="email" value="<?php echo $resultado['email'];?>"/>
                    </label>
                    <span>Dirigente</span>
                    <select name="dirigente">
                        <?php
                        $qr=mysql_query("SELECT nome,id FROM membros");
                        while($res = mysql_fetch_array($qr)){
                            if($resultado['dirigente'] == $res['nome']){
                                echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';
                            }else{
                                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                            }

                        }
                        ?>
                    </select>
                    <label for="">
                        <span>Setor</span>
                        <input type="text" name="setor" value="<?php echo $resultado['setor']; ?>"/>
                    </label>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Cadastrar" id="btn-submit" />
                </fieldset>

            </form>
            <?php
                if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                    $nome = trim(strip_tags($_POST['nome']));
                    $estado = trim(strip_tags($_POST['estado']));
                    $cidade = trim(strip_tags($_POST['cidade']));
                    $endereco = trim($_POST['endereco']);
                    $bairro = trim($_POST['bairro']);
                    $tel1 = trim($_POST['tel1']);
                    $tel2 = trim($_POST['tel2']);
                    $email = trim($_POST['email']);
                    $dirigente =(int)$_POST['dirigente'];
                    $setor = trim($_POST['setor']);

                    $update = mysql_query("UPDATE congregacao SET nome = '$nome', estado = '$estado', cidade = '$cidade',
                              endereco = '$endereco', bairro = '$bairro', telefone1 = '$tel1', telefone2 = '$tel2',
                              email = '$email', dirigente = '$dirigente', setor = '$setor'
                     WHERE id = '$id'");
                    if($update){
                        echo '<div id="sucesso">Dados alterados com sucesso</div>';

                    }else{
                        echo '<div id="erro">Problema ao alterar dados</div>';
                    }
                }

            ?>

        </div><!--conteudo-->

    <?php include("menu.php");?>


<div style="clear: both"></div>
	</div><!--corpo-->
    <div id="footer" style="float:right;">
        <a href="pages/contact.php">feito por: MGS</a>
    </div>
</div><!--box-->
</body>
</html>