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
	<title>Gerar Advert&ecirc;ncia | Sistema de Controle</title>
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
            <h1>Gerar Advert&ecirc;ncia</h1>

            <form action="" enctype="multipart/form-data" method="post">
                <fieldset>
                    <span>Membro</span>
                    <select name="membro">
                        <option value="" selected="selected">Selecione um Membro</option>
                        <?php
                            $sql = mysql_query("SELECT nome, id FROM membros ORDER BY nome ASC");
                            while($res = mysql_fetch_array($sql)){
                                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                            }
                        ?>
                    </select>
                    <span>Motivo</span>
                    <textarea name="motivo" style="width: 300px; padding: 5px;" rows="5"></textarea>
                    <br />
                    <input type="hidden" name="acao" value="enviar" />
                    <input type="submit" value="Enviar" id="btn-submit" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
                $membro = (int)$_POST['membro'];
                $motivo = mysql_real_escape_string(trim(strip_tags($_POST['motivo'])));
                $insert = mysql_query("INSERT INTO advertencia (id_membro, motivo, status) VALUES ('$membro', '$motivo', 0)") or Logs(date('d-m-Y H:i:s').' arquivo: gerar_adv '.mysql_error(), 2);
                if($insert){
                    echo '<div id="sucesso">Advert&ecirc;ncia dada com sucesso!</div>';

                }else{
                    echo '<div id="erro">Erro ao dar advert&ecirc;ncia</div>';
                }
            }?>
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