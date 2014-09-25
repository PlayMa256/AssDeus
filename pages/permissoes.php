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
	<title>Permiss&atilde;o para justificar faltas | Sistema de Controle</title>
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
            <form method="post" enctype="multipart/form-data">
                <legend>Permiss&atilde;o para justificar faltas</legend>
                <fieldset>
                    <span>Membros</span>
                    <?php
                        $quantidade = 40;
                        $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                        $inicio     = ($quantidade * $pagina) - $quantidade;

                        $procura_membros = mysql_query("SELECT * FROM membros WHERE status = 1 ORDER BY nome ASC LIMIT $inicio, $quantidade");
                        while($ressultado = mysql_fetch_array($procura_membros)){

                            $id = $ressultado['id'];
                            $nome = $ressultado['nome'];
                            if($nome != "Administrador"){
                                echo "<input type='checkbox' name='membro_id[]' value='$id' />$nome<br/>";
                            }else{}


                        }
                    ?>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Liberar" id="btn-submit" />
                </fieldset>
            </form>
            <?php
                //SQL para saber o total
                $sqlTotal   = "SELECT * FROM membros WHERE status = 1 ORDER BY nome ASC";
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
            <div style="clear: both"></div>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $membro = $_POST['membro_id'];
                $contar = count($membro);
                $quantidade = 0;
                for($i=0;$i<$contar;$i++){
                    $membro_id = $_POST['membro_id'][$i];
                    $inserir = mysql_query("INSERT INTO permissao (id_membro, status) VALUES('$membro_id', '1')") or Logs(mysql_error(), 2);
                    $quantidade++;
                }

                if($quantidade == $contar){
                    echo '<div id="sucesso" style="margin-top:15px;">Permiss&atilde;o dada com sucesso!</div>';
                }else{
                    echo '<div id="erro" style="margin-top:15px;">Erro ao dar permiss&atilde;o!</div>';
                }
            }?>
        </div><!--conteudo-->
    <?php include("menu.php");?>


    <div style="clear: both"></div>
	</div><!--corpo-->

</div><!--box-->
</body>
</html>