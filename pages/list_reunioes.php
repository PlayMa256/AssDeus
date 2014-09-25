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
	<title>Gerenciar Reuni&otilde;es | Sistema de Controle</title>
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
            <h1>Gerenciar Reuniões</h1>
                   <?php
                   $quantidade = 20;
                   $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                   $inicio     = ($quantidade * $pagina) - $quantidade;
                   $today      = date("Y-m-d");
                   $sql = mysql_query("SELECT * FROM reuniao WHERE status = 0 AND DataFim >= '$today' ORDER BY titulo ASC LIMIT $inicio, $quantidade") or die(mysql_error());
                   $hoje = date('Y-m-d');
                   while($ln = mysql_fetch_array($sql)){
                        $dataFim = $ln['DataFim'];
                echo '<table width="100%" style="margin-top:5px">
                   <tr>
                       <td style="font-weight: bold">Titulo</td>
                       <td style="font-weight: bold">Data In&iacute;cio</td>
                       <td style="font-weight: bold">Tipo</td>
                       <td style="font-weight: bold">Dirigente</td>
                       <td style="font-weight: bold">Preletor</td>
                       <td style="font-weight: bold">Tema</td>
                       <td colspan="6" style="font-weight: bold">A&ccedil;&atilde;o</td>
                   </tr>';


                   ?>
                   <tr>
                       <td><?php echo $ln['titulo']; ?></td>
                       <td><?php echo format_data_Normal($ln['DataInicio']); ?></td>
                       <td><?php echo $ln['tipo']; ?></td>
                       <td><?php echo $ln['dirigente']; ?></td>
                       <td><?php echo $ln['preletor']; ?></td>
                       <td><?php echo $ln['tema']; ?></td>
                       <td><a href="edit_reuniao.php?id=<?php echo $ln['id'];?>">Editar</a></td>
                       <td><a href="dar_presenca.php?id=<?php echo $ln['id'];?>">Inserir Presen&ccedil;a de Membros</a></td>
                       <?php
                       $id_membro = $_GET['m'];
                       $cargo = $_GET['mc'];
                       $sql = mysql_query("SELECT * FROM permissao WHERE id_membro = '$id_membro' AND status = 1");
                       $conta = mysql_num_rows($sql);
                       if($conta == 1 || $cargo == 10){
                           echo '<td><a href="gera_justificativa_falta.php?id='.$ln['id'].'">Preencher justificativa de Falta</a></td>';
                       }
                       if($cargo == 1 || $cargo == 2 || $cargo == 10){

                           echo '<td><a href="dar_falta_fechar.php?id_reuniao='.$ln['id'].'">Finalizar Reuni&atilde;o</a></td>';

                       }

                       ?>

                       <td><a href="?id=<?php echo $ln['id'];?>">Apagar</a></td>

                   </tr>
                   <?}echo '</table>';?>

            <div id="paginacao">
                <?php

                //SQL para saber o total
                $sqlTotal   = "SELECT id FROM reuniao";
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
            </div>
            <?php
                if(isset($_GET['id'])){
                     $id = $_GET['id'];
                     $remove = mysql_query("DELETE FROM reuniao WHERE id = '$id'");
                     if($remove){
                         echo '<script>alert("Reunião apagado com sucesso");location.href="list_reuniao.php";</script>';
                     }else{
                         echo '<script>alert("problema ao apagar reunião.");location.href="list_reuniao.php";</script>';
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