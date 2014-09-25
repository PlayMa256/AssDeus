<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
if($_SESSION['cargo'] == 8 || $_SESSION['cargo'] == 9){
       header("Location: ../../index.php");
}
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Gerenciar Membros | Sistema de Controle</title>
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
            <h1>Listar Obreiros</h1>
            <form method="post" enctype="multipart/form-data" action="print_obreiros.php">
                <span>Setor: </span>
                <small style="margin-top: 3px;">no formato 01,02,03....</small>
                <input type="text" name="setores" />
                <input type="hidden" name="acao" value="select" />
                <input type="submit" value="Enviar" id="btn-submit"/>
            </form>
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