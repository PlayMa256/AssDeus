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
	<title>Retirar Advert&ecirc;ncia | Sistema de Controle</title>
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
            <h1>Suspender Advert&ecirc;ncia</h1>
            <form method="post" enctype="multipart/form-data">
                <fieldset>
                    <span>Selecione o Membro</span>
                    <select name="membro">
                        <option value="" selected="selected">Selecione um membro</option>
                        <?php
                            $sql = mysql_query("SELECT id_membro FROM advertencia WHERE status = 1") or die(mysql_error());
                            while($res = mysql_fetch_array($sql)){
                                $id_membro = $res['id_membro'];
                                $nome = mysql_query("SELECT nome FROM membros WHERE id = '$id_membro'") or die(mysql_error());
                                while($result = mysql_fetch_array($nome)){
                                    $nomes = $result['nome'];
                                    echo '<option value="'.$res['id_membro'].'">'.$result['nome'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Retirar" id="btn-submit" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $id_membro = $_POST['membro'];
                $mysql = mysql_query("UPDATE advertencia SET status = 0 WHERE id_membro = '$id_membro'");
                if($mysql){
                    echo '<div id="sucesso">Advert&ecirc;ncia retirada!</div>';
                }else{
                    echo '<div id="erro">Problema ao retirar advertencia</div>';
                }




            }?>
        </div><!--conteudo-->

    <?php include("menu.php");?>


<div style="clear: both"></div>
	</div><!--corpo-->
    <div id="footer" style="float:right;">
        <a href="contact.php">feito por: MGS</a>
    </div>
</div><!--box-->
</body>
</html>