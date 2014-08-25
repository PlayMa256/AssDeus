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
	<title>Preencher justificativa de falta avisada | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#reunioes").change(function(){
               var valor = $(this).val();
                console.log(valor);
                if(valor != ""){
                    $("#btn-submit").attr('value', 'Imprimir');
                    $("#btn-submit").attr('disabled', false);
                }else if(valor == ""){
                    $("#btn-submit").attr('value', 'Selecione uma Reuni&atilde;o Primeiro');
                    $("#btn-submit").attr('disabled', true);
                }
            });
        });
    </script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Relat&oacute;rio de membros Presentes</h1>
            <form method="post" enctype="multipart/form-data" action="membros_presentes_print.php">

                <span>Selecione a Reuni&atilde;o</span>
                <select name="reuniao" id="reunioes">
                    <option value="" selected="selected">Selecione uma Reuni&atilde;o</option>
                    <?php
                        $sql = mysql_query("SELECT * FROM reuniao");
                        while($res = mysql_fetch_array($sql)){
                            echo '<option value="'.$res['id'].'">'.$res['titulo'].'</option>';
                        }
                    ?>
                </select>
                <span>Reuni&atilde;o dos(as):</span>
                <select name="sexo">
                    <option value="Masculino">Homens</option>
                    <option value="Feminino">Mulheres</option>
                </select>
                <input name="acao" type="hidden" value="procurar" />
                <input type="submit" value="Selecione uma Reuni&atilde;o Primeiro" id="btn-submit" disabled="disabled"/>
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