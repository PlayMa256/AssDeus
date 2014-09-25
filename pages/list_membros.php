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
    <script type="text/javascript">
        $(function(){
            $("#alertas").fadeIn('slow');

        })
    </script>

</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->

	<div id="corpo">
        <div id="conteudo">



            <h2 style="text-align: center;">Gerenciar Membros</h2>
            <div id="alertas" style="float: left;margin: 3px 0 9px;">
                <?php
              /*  $erro = $_GET['erro'];
                switch($erro){
                    case 8:
                        echo '<div id="sucesso" style="margin-top:0">Foto e/ou dados atualizados com sucesso</div>';
                        break;
                    case 9:
                        echo '<div id="erro">Problema ao atualizar dados</div>';
                        break;
                    case 10:
                        echo '<div id="erro">Problema ao atualizar foto</div>';
                        break;
                    case 11:
                        echo '<div id="erro">Problema ao atualizar dados</div>';
                        echo '<div id="sucesso" style="margin-top:0">Foto  atualizada com sucesso</div>';
                        break;

                    case 12:
                        echo '<div id="erro">Problema ao atualizar dados</div>';
                        echo '<div id="erro">Problema ao atualizar foto</div>';
                        break;
                }*/

                ?>
            </div>
            <table width="100%" style="margin-top:5px">
                <tr>
                    <td style="font-weight: bold">N&uacute;mero de Identifica&ccedil;&atilde;o</td>
                    <td style="font-weight: bold">Nome</td>
                    <td colspan="2" style="font-weight: bold">A&ccedil;&atilde;o</td>
                </tr>
                <?php
                $membrocargo = (int)$_GET['mc'];
                $quantidade = 50;
                $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                $inicio = ($quantidade * $pagina) - $quantidade;
                if($membrocargo == 10 || $membrocargo == 1){
                    $sql = mysql_query("SELECT id, nome, cargoEclesiastico FROM membros ORDER BY nome ASC LIMIT $inicio, $quantidade") or die(mysql_error());
                }else{
                    $sql = mysql_query("SELECT id, nome, cargoEclesiastico FROM membros WHERE cargoEclesiastico <> 10 AND cargoEclesiastico <> 1 ORDER BY nome ASC LIMIT $inicio, $quantidade") or die(mysql_error());
                }
                while($ln = mysql_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><? echo $ln['id'];?></td>
                        <td><?php echo $ln['nome']; ?></td>
                        <td><a href="edit_membros.php?id=<?php echo $ln['id'];?>">Editar</a></td>
                        <td><a href="?id=<?php echo $ln['id'];?>">Apagar</a></td>
                    </tr>
                <?}?>
            </table>
            <div id="paginacao">
                <?php
                //SQL para saber o total
                $sqlTotal = "SELECT id FROM membros";
                //Executa o SQL
                $qrTotal = mysql_query($sqlTotal) or die(mysql_error());
                //Total de Registro na tabela
                $numTotal = mysql_num_rows($qrTotal);
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
                $anterior = (($pagina - 1) == 0) ? 1 : $pagina - 1;
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
                $remove = mysql_query("DELETE FROM membros WHERE id = '$id'");
                if($remove){
                    echo '<script>alert("Membro apagado com sucesso");location.href="list_membros.php";</script>';
                }else{
                    echo '<script>alert("problema ao apagar membro.");location.href="list_membros.php";</script>';
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