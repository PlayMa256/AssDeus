<?php
include "../scripts/permissao.php";
include "../conf/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Preencher justificativa de falta avisada | Sistema de Controle</title>
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
            <h1>Listar Justificativas de Faltas</h1>
            <form method="post" enctype="multipart/form-data">
                <span>Reuni&atilde;o</span>
                <select name="reuniao">
                    <option selected="selected">Selecione uma reuni&atilde;o</option>
                    <?php
                        $sql = mysql_query("SELECT * FROM reuniao");
                        while($res = mysql_fetch_array($sql)){
                            $id = $res['id'];
                            $titulo = $res['titulo'];
                            $data = date("d-m-Y",$res['DataInicio']);
                            echo '<option value="'.$id.'">'.$titulo.'-'.$data.'</option>';
                        }

                    ?>
                </select>
                <input type="hidden" name="acao" value="enviar" />
                <input type="submit" value="Procurar" id="btn-submit" /> 
            </form>
            <br/>
        <?php if(isset($_POST['acao']) && $_POST['acao']=='enviar'){

                echo '<table>';
                echo '<tr>';
                    echo '<td>Nome</td>';
                    echo '<td>Cargo</td>';
                    echo '<td>Justificativa</td>';
                    echo '<td colspan="2">A&ccedil;&atilde;o</td>';
                echo '</tr>';

                $reuniao = (int)$_POST['reuniao'];
                $sql2 = mysql_query("SELECT membros.id, membros.nome as MEMBRO, cargos.nome, faltas.justificativa, faltas.id as IDFALTA 
                    FROM(membros INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id 
                        INNER JOIN faltas ON membros.id = faltas.id_membro)") or die(mysql_error());
                while($ress = mysql_fetch_array($sql2)){
                    $id_membro = $ress['id'];
                    $nome_membro = $ress['MEMBRO'];
                    $cargo_membro = $ress['nome'];
                    $justificativa_falta = $ress['justificativa'];
                    $falta_id = $ress['IDFALTA'];
                
                    echo '<tr>';
                        echo '<td>'.$nome_membro.'</td>';
                        echo '<td>'.$cargo_membro.'</td>';
                        echo '<td>'.$justificativa_falta.'</td>';
                        echo '<td><a href="edit_justificativa.php?idfalta='.$falta_id.'">Editar Justificativa</a</td>';
                        echo '<td><a href="apagar_falta.php?idfalta='.$falta_id.'">Apagar falta</a</td>';
                    echo '</tr>';

                }
                echo '</table>';
            }

            ?>

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