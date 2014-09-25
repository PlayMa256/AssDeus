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
    <style type="text/css">
        .titulo{
            font-size:18px;
            font-weight: bold;
            color:red;
            margin-top:20px;
        }
        .cargos{
            list-style: circle;
        }
        .membros{
            list-style: katakana;
            margin-left:50px;
        }
    </style>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->

	<div id="corpo">
        <div id="conteudo">
            <h2>Listar Obreiros</h2>
                <?php
                $membrocargo = (int)$_GET['mc'];
                $quantidade = 60;
                $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                $inicio = ($quantidade * $pagina) - $quantidade;
                if($membrocargo == 10 || $membrocargo == 1){
                    $sql = mysql_query("SELECT DISTINCT membros.id, membros.nome, cargos.nome AS CARGO, congregacao.nome as CONGREGACAO, congregacao.setor
                    FROM (congregacao INNER JOIN membros ON congregacao.id = membros.congregacao INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id)
                    WHERE membros.obreiro = 1 AND membros.status = 1
                    GROUP BY congregacao.setor, CARGO, CONGREGACAO LIMIT $inicio, $quantidade");

                }else{
                    $sql = mysql_query("SELECT membros.id, membros.nome, cargos.nome AS CARGO, congregacao.nome as CONGREGACAO, congregacao.setor
                    FROM (congregacao INNER JOIN membros ON congregacao.id = membros.congregacao INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id)
                    WHERE membros.obreiro = 1 AND membros.cargoEclesiastico <> 10 AND membros.cargoEclesiastico <> 1  AND membros.status = 1
                    GROUP BY congregacao.setor, congregacao.nome, cargos.nome LIMIT $inicio, $quantidade");
                }
                while($ln = mysql_fetch_array($sql)){

                    echo "variavel congragacao antes = $congregacao <br />";
                    echo "variavel setor antes = $setor<br />";
                    echo "variavel cargo antes = $cargos <br />";

                    if($setor2 == $setor){
                        $setor = "";
                    }else{
                        $setor = $ln['setor'];
                    }
                if($congregacao2 == $congregacao){
                    $congregacao = "";
                }else{
                    $congregacao = $ln['CONGREGACAO'];
                }
                if($cargos2 == $cargos){
                    $cargos = "";
                }else{
                    $cargos = $ln['CARGO'];
                }
                    $membro_id = $ln['id'];
                    $membro_nome = $ln['nome'];
                    $cargos = "";
                    $congregacao = "";
                    $setor = "";
                    echo "variavel congragacao = $congregacao <br />";
                    echo "variavel setor = $setor<br />";
                    echo "variavel cargo = $cargos <br />";

                    $congregacao2 = "";
                    $cargos2 = "";
                    $setor2 = "";

                    //echo "<h2>$setor</h2>";
                    //echo "<span class='titulo'>$congregacao</span>";
                    //echo '<ul class="cargos">';
                    //  echo "<li>$cargos</li>";
                    //          echo "<ul class='membros'>";
                    //              echo "<li>$membro_nome - $membro_id</li>";
                    //          echo "</ul>";
                    //echo '</ul>';

                    $congregacao = (empty($congregacao)) ? $ln['CONGREGACAO'] : $congregacao ;
                    $cargos = (empty($cargos)) ? $ln['CARGO'] : $cargos ;
                    $setor = (empty($setor)) ? $ln['setor'] : $setor;

                    $congregacao2 = $congregacao;
                    $setor2 = $setor;
                    $cargos2 = $cargos;
                    echo "variavel congragacao2 = $congregacao2 <br />";
                    echo "variavel setor2  = $setor2 <br />";
                    echo "variavel cargos2  = $cargos2 <br />";
                }?>

            <div id="paginacao">
                <?php
                //SQL para saber o total
                $sqlTotal = "SELECT membros.id, membros.nome, cargos.nome AS CARGO
                    FROM (congregacao INNER JOIN membros ON congregacao.id = membros.congregacao INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id)
                    WHERE membros.obreiro = 1
                    GROUP BY congregacao.setor, congregacao.nome, cargos.nome";
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