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
	<title>Gerenciar Alojamentos | Sistema de Controle</title>
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
            <h2>Gerenciar Alojamentos</h2>
               <table width="100%" style="margin-top:5px">
                   <tr>
                       <td style="font-weight: bold">Nome</td>
                       <td style="font-weight: bold">Local</td>
                       <td style="font-weight: bold">Vagas para Mulheres</td>
                       <td style="font-weight: bold">Vagas para Homens</td>
                       <td colspan="3" style="font-weight: bold">A&ccedil;&atilde;o</td>
                   </tr>
                   <?php
                   $quantidade = 20;
                   $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                   $inicio     = ($quantidade * $pagina) - $quantidade;
                       $sql = mysql_query("SELECT * FROM alojamentos ORDER BY local ASC LIMIT $inicio, $quantidade");
                   while($ln = mysql_fetch_array($sql)){
                   ?>
                   <tr>
                       <td><?php echo $ln['nome']; ?></td>
                       <td><?php echo $ln['local']; ?></td>
                       <td><?php echo $ln['VagasFem']; ?></td>
                       <td><?php echo $ln['VagasMasc']; ?></td>
                       <td><a href="edit_alojamentos.php?id=<?php echo $ln['id'];?>">Editar</a></td>
                       <td><a href="alocar_membro.php?id=<?php echo $ln['id'];?>">Alocar Membro</a></td>
                       <td><a href="?id=<?php echo $ln['id'];?>">Apagar</a></td>
                   </tr>
                   <?}?>
               </table>
            <div id="paginacao">
                <?php

                //SQL para saber o total
                $sqlTotal   = "SELECT id FROM alojamentos";
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
                /**
                 * Agora monta o Link paar Primeira Página
                 * Depois O link para voltar uma página
                 */
                include "paginacao.php";

                ?>
            </div>
            <?php
                if(isset($_GET['id'])){
                     $id = $_GET['id'];
                     $remove = mysql_query("DELETE FROM membros WHERE id = '$id'");
                     if($remove){
                         echo '<script>alert("Membro apagado com sucesso");location.href="list_alojamentos.php";</script>';
                     }else{
                         echo '<script>alert("problema ao apagar membro.");location.href="list_alojamentos.php";</script>';
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