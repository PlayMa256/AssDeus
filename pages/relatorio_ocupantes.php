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
	<title>Relat&oacute;rio de Ocupantes do Alojamento | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/jmask.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".data").mask("99-99-9999");
        })
    </script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Relat&oacute;rio de Ocupantes</h1>
            <form method="post" action="print_ocupantes.php">
                <span>Alojamento</span>
                <select name="alojamento">
                    <option selected="selected" disabled="disabled">Selecione o Alojamento</option>
                    <?php
                        $alojamentos = mysql_query("SELECT * FROM alojamentos ORDER BY nome");
                        while($res = mysql_fetch_array($alojamentos)){
                            $id = $res['id'];
                            $nome = $res['nome'];
                            echo '<option value="'.$res['id'].'">'.$res['nome'].'-'.$res['local'].'</option>';
                        }
                    ?>
                </select>
                <span>Entre As Datas:</span>
                <input type="text" name="data_inicio" class="data"/>

                <span>Data Fim</span>
                <input type="text" name="data_fim" class="data"/>

                <input id="btn-submit" type="submit" value="Enviar"/>
            </form>

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