<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include "../function/logs.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Gerar Carteirinha | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <style type="text/css">
        #cart_membros{
            margin-bottom:5px;
        }
    </style>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Gerar Carteirinhas</h1>
            <form method="post" enctype="multipart/form-data" action="gera_cartao2.php">
                <fieldset>
                    <legend>Selecione os membros para imprimir carteirinhas</legend>
                    <span>Membros</span>
                    <?php
                    $quantidade = 40;
                    $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                    $inicio     = ($quantidade * $pagina) - $quantidade;

                    $sql = mysql_query("SELECT id, nome FROM membros ORDER BY nome ASC LIMIT $inicio, $quantidade") or Logs(date("d-m-Y H:i:s").' arquivo: gerar_cartao'.mysql_error(), 2);
                        while($res = mysql_fetch_array($sql)){
                            echo '<label id="cart_membros"><input type="checkbox" name="membros[]" value="'.$res['id'].'" /> '.$res['nome'].'</label>';
                            echo '<br />';
                        }
?>
<br />

                    <input type="hidden" name="acao" value="imprimir" />
                    <input type="submit" value="Imprimir" id="btn-submit" style="margin-top:-3px;" />
                </fieldset>
            </form>
            <?php
            //SQL para saber o total
            $sqlTotal   = "SELECT id FROM membros";
            //Executa o SQL
            $qrTotal    = mysql_query($sqlTotal) or die(mysql_error());
            //Total de Registro na tabela
            $numTotal   = mysql_num_rows($qrTotal);
            //O calculo do Total de página ser exibido
            $totalPagina= ceil($numTotal/$quantidade);
            /**
            * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
            */
            $exibir = 3;
            /**
            * Aqui montará o link que voltará uma pagina
            * Caso o valor seja zero, por padrão ficará o valor 1
            */
            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
            /**
            * Aqui montará o link que ir para proxima pagina
            * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
            * caso contrario, ele pegar o valor da página + 1
            */
            $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
            include "paginacao.php";

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