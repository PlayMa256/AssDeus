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
	<title>Editar Cargos | Sistema de Controle</title>
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
            <h2>Gerenciar Cargos</h2>
            <form method="post" enctype="multipart/form-data">
                <?php
                if(isset($_GET)){
                    $id = (int)$_GET['id'];
                    $ed = mysql_query("SELECT * FROM cargos WHERE id = '$id'");
                    $resultado = mysql_fetch_array($ed);

                }
                ?>
                <fieldset>
                    <label for="">
                        <span></span>
                        <input type="text" name="nome" value="<?php echo $resultado['nome'];?> "/>
                    </label>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Cadastrar" id="btn-submit" />
                </fieldset>

            </form>
            <?php
                if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                    $nome = trim(strip_tags($_POST['nome']));
                    $update = mysql_query("UPDATE cargos SET nome = '$nome' WHERE id = '$id'");
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