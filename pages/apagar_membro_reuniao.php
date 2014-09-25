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
	<title>Retirar Presen&ccedil;a | Sistema de Controle</title>
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
                <select name="membro">
                    <option selected="selected">Selecione um membro que n&atilde;o deveria est&aacute;r como presente!</option>
                    <?php
                    $id_reuniao = (int)$_GET['id_reuniao'];
                    $sql = mysql_query("SELECT membros.id as ID, membros.nome AS NOME, controle_membros.id AS ID_CONTROLE FROM (membros INNER JOIN controle_membros ON membros.id = controle_membros.id_membro)
                       WHERE controle_membros.id_reuniao = '$id_reuniao'
                     ORDER BY membros.nome ASC");
                    while($res = mysql_fetch_array($sql)){
                        $id = $res['ID_CONTROLE'];
                        $nome_membro = $res['NOME'];
                        $data = date("d-m-Y",$res['DataInicio']);
                        echo '<option value="'.$id.'">'.$nome_membro.'</option>';
                    }

                    ?>
                </select>
                <input type="hidden" name="acao" value="enviar" />
                <input type="submit" value="Remover" id="btn-submit" />
            </form>
            <br/>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
                $id_presenca = $_POST['membro'];
                $endereco ="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?id_reuniao=$id_reuniao";
                $rm = mysql_query("DELETE FROM controle_membros WHERE id = '$id_presenca'") or die(mysql_error());
                if($rm){
                    echo '<div id="sucesso">Removido com sucesso!</div>';
                    echo "<script>setTimeout(\"location.href='$endereco'\", 1300)</script>";
                }else{
                    echo '<div id="erro">Problema ao remover</div>';
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