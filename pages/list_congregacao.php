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
	<title>Gerenciar Congrega&ccedil;&otilde;es | Sistema de Controle</title>
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
            <h2>Gerenciar Congrega&ccedil;&otilde;es</h2>
               <table width="100%" style="margin-top:5px">
                   <tr>
                       <td style="font-weight: bold">Nome</td>
                       <td style="font-weight: bold">Estado</td>
                       <td style="font-weight: bold">Cidade</td>
                       <td colspan="2" style="font-weight: bold">A&ccedil;&atilde;o</td>
                   </tr>
                   <?php
                   $quantidade = 20;
                   $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                   $inicio     = ($quantidade * $pagina) - $quantidade;
                       $sql = mysql_query("SELECT id, nome, estado, cidade FROM congregacao ORDER BY nome ASC LIMIT $inicio, $quantidade");
                   while($ln = mysql_fetch_array($sql)){
                   ?>
                   <tr>
                       <td><?php echo $ln['nome']; ?></td>
                       <td><?php echo $ln['estado']; ?></td>
                       <td><?php $cidade = $ln['cidade']; $cidadeqr = mysql_query("SELECT nome FROM tb_cidades WHERE id = '$cidade'");
                           $resultado = mysql_fetch_array($cidadeqr);
                           echo $resultado['nome'];
                           ?></td>

                       <td><a href="edit_congregacao.php?id=<?php echo $ln['id'];?>">Editar</a></td>
                       <td><a href="?id=<?php echo $ln['id'];?>">Apagar</a></td>
                   </tr>
                   <?}?>
               </table>
            <div id="paginacao">
                <?php
                $sqlTotal   = "SELECT id FROM congregacao";
                $qrTotal    = mysql_query($sqlTotal) or die(mysql_error());
                $numTotal   = mysql_num_rows($qrTotal);
                $totalPagina= ceil($numTotal/$quantidade);

                $exibir = 3;
                $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
                $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;

                include "paginacao.php";
                ?>
            </div>
            <?php
                if(isset($_GET['id'])){
                     $id = $_GET['id'];
                     $remove = mysql_query("DELETE FROM congregacao WHERE id = '$id'");
                     if($remove){
                         echo '<script>alert("Congrega&ccedil;o apagado com sucesso");location.href="list_congregacao.php";</script>';
                     }else{
                         echo '<script>alert("Problema ao apagar congrega&ccedil;&atilde;o.");location.href="list_congregacao.php";</script>';
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