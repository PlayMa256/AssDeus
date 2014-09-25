<?php
include "../scripts/permissao.php";
include "../conf/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Editar Justificativa | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <?php


    ?>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Editar Justificativas de Faltas</h1>
            <form method="post" enctype="multipart/form-data">
                <?php
                    $id_falta = $_GET['idfalta'];
                    $sql = mysql_query("SELECT * FROM faltas WHERE id = '$id_falta'");

                    $res = mysql_fetch_array($sql);
                    $membro = $res['id_membro'];
                    
                    $sql_nomeMembro = mysql_query("SELECT nome FROM membros WHERE id = '$membro'");
                    $resultado = mysql_fetch_array($sql_nomeMembro);

                    $nome_membro = $resultado['nome'];
                    $justificativa = $res['justificativa'];
                    
                ?>
                <span>Membro</span>
                <span style="font-weight: normal;"><?php echo $nome_membro;?>
                <span>Justificativa</span>
                <textarea name="justificativa" style=" height: 200px;padding: 5px;width: 300px;"><?php echo $justificativa;?></textarea><br/>
                <input type="hidden" name="acao" value="enviar" />
                <input type="submit" value="Atualizar" id="btn-submit" />
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao']=='enviar'){
                $id_falta = $_GET['idfalta'];
                $justificativa_alterada = $_POST['justificativa'];
                $endereco ="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?idfalta=$id_falta";

                $sql_update = mysql_query("UPDATE faltas SET justificativa = '$justificativa_alterada' WHERE id = '$id_falta'") or die(mysql_error());

                if($sql_update){
                    echo '<div id="sucesso" style="float:none">Justificativa atualizada com sucesso</div>';

                    echo "<script>setTimeout(\"location.href='$endereco'\", 1300)</script>";
                }else{
                    echo '<div id="erro" style="float:none">Erro ao atualizar justificativa</div>';
                }
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