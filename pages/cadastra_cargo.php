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
	<title>Cadastrar Cargos | Sistema de Controle</title>
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
            <form method="post" enctype="multipart/form-data">
                <legend>Cadastro de Cargos</legend>

                <fieldset>
                    <label>
                        <span>Nome do Cargo</span>
                        <input type="text" name="nome" />
                    </label>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Cadastrar" id="btn-submit" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){

                $nome = trim(strip_tags($_POST['nome']));
                if(empty($nome)){
                    echo '<div id="erro">Preencha o campo nome</div>';
                }else{
                    $qr = mysql_query("INSERT INTO cargos (nome) VALUES ('$nome')");
                    if($qr){
                        echo '<div id="sucesso">Cargo inserido com sucesso</div>';
                    }else{
                        echo '<div id="erro">Problema ao inserir cargo</div>';
                    }
                }
            }?>
        </div><!--conteudo-->

    <?php include("menu.php");?>



<div style="clear: both"></div>
	</div><!--corpo-->
    <div style="clear: both"></div>
    <div id="footer" style="float:right;">
        <a href="pages/contact.php">feito por: MGS</a>
    </div>
</div><!--box-->
</body>
</html>