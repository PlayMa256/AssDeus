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
	<title>Preencher Vagas de Eventos | Sistema de Controle</title>
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
                 <legend>Selecionar Membros para participar de eventos.</legend>
                 <fieldset>
                     <?php
                        if(isset($_GET)){
                            $id = (int)$_GET['id'];
                            $sql = mysql_query("SELECT nome FROM eventos WHERE id = '$id'");
                            $res = mysql_fetch_array($sql);
                            echo '<h2 style="margin-top:5px;">Evento: '.$res['nome'].'</h2>';
                        }

                     ?>

                        <span>Selecione os Membros</span>
                     <table>
                        <?
                            $quantidade = 20;
                            $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                            $inicio     = ($quantidade * $pagina) - $quantidade;

                            $qr = mysql_query("SELECT nome, id FROM membros ORDER BY nome ASC limit $inicio, $quantidade");

                            while($ress = mysql_fetch_array($qr)){
                                echo '<tr><td><input type="checkbox" name="membro[]" value="'.$ress['id'].'" /></td><td>'.$ress['nome'].'</td></tr>';
                            }
                        ?>
                     </table>
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
                     /**
                      * Agora monta o Link paar Primeira Página
                      * Depois O link para voltar uma página
                      */
                        include "paginacao.php";
                     ?>
                     <br />
                     <br />
                     <br />
                     <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" name="" value="Enviar" id="btn-submit" />
                 </fieldset>
             </form>
            <?php
            if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $evento = $id;
                $qtdVagas = mysql_query("SELECT vagas FROM eventos WHERE id = '$evento'");
                $resultado = mysql_fetch_array($qtdVagas);
                $TotalVagas = $resultado['vagas'];
                $QtdMembros = count($_POST['membro']);
                //vagas é a quantidade de membros que o evento terá depois que for feito a retirada da quantidade de membros
                //e das vagas
                $vagas = $TotalVagas -$QtdMembros ;
                $membro = $_POST['membro'];
                if($vagas == 0 || $vagas < 0){
                    echo '<div id="erro">Evento Cheio.</div>';
                }else{
                    foreach($membro as $IdMembro){
                       $inserir = mysql_query("INSERT INTO disposicao_membros_eventos (id_evento, id_membro) VALUES('$evento', '$IdMembro')") or die(mysql_error());
                       $update_eventos = mysql_query("UPDATE eventos SET vagas = '$vagas' WHERE id = '$evento'") or die(mysql_error());
                        if($inserir && $update_eventos){
                            echo '<div id="sucesso">Vagas do evento preenchidas, restam '.$vagas.' vagas.</div>';
                        }else{
                            echo '<div id="erro">Erro ao preencher vagas do evento</div>';
                        }

                    }
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