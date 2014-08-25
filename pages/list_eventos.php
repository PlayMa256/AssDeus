<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include "../function/format_data.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<title>Gerenciar Eventos | Sistema de Controle</title>
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
               <table width="100%" style="margin-top:5px">
                   <tr>
                       <td style="font-weight: bold">Nome</td>
                       <td style="font-weight: bold">Local</td>
                       <td style="font-weight: bold">Vagas</td>
                       <td style="font-weight: bold">Data</td>
                       <td colspan="3" style="font-weight: bold">A&ccedil;&atilde;o</td>
                   </tr>
                   <?php
                   $quantidade = 20;
                   $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                   $inicio     = ($quantidade * $pagina) - $quantidade;
                       $sql = mysql_query("SELECT * FROM eventos ORDER BY nome ASC LIMIT $inicio, $quantidade");
                   while($ln = mysql_fetch_array($sql)){
                   ?>
                   <tr>
                       <td><?php echo utf8_encode($ln['nome']); ?></td>
                       <td><?php echo $ln['local']; ?></td>
                       <td><?php echo $ln['vagas']; ?></td>
                       <td><?php echo format_data_Normal($ln['data']); ?></td>
                       <td><a href="edit_eventos.php?id=<?php echo $ln['id'];?>">Editar</a></td>
                       <td><a href="preencher_evento.php?id=<?php echo $ln['id'];?>">Preencher evento</a></td>
                       <td><a href="?id=<?php echo $ln['id'];?>">Apagar</a></td>

                   </tr>
                   <?}?>
               </table>

                <?php

                //SQL para saber o total
                $sqlTotal   = "SELECT id FROM eventos";
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

            <?php
                if(isset($_GET['id'])){
                     $id = $_GET['id'];
                     $remove = mysql_query("DELETE FROM eventos WHERE id = '$id'");
                     if($remove){
                         echo '<script>alert("Evento apagado com sucesso");location.href="list_eventos.php";</script>';
                     }else{
                         echo '<script>alert("problema ao apagar Evento.");location.href="list_eventos.php";</script>';
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