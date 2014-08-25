<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
if($_SESSION['cargo'] == 8 || $_SESSION['cargo'] != 9){}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Justificar Advert&ecirc;ncia | Sistema de Controle</title>
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
                <fieldset>
                    <legend>Justificar Advert&ecirc;ncia</legend>
                    <span>Advert&ecirc;ncia</span>
                    <p><?php
                        $id_membro = $_SESSION['usuario'];
                        $select = mysql_query("SELECT * from advertencia WHERE id_membro = '$id_membro' AND status = 1 LIMIT 1");
                        $res = mysql_fetch_array($select);
                        echo $res['motivo'];
                        ?></p>

                        <span>Justificativa: </span>
                        <textarea rows="" cols="" name="justificativa" style="width: 300px;height:100px;"></textarea>
                    <br/>

                    <input type="hidden" name="id_adv" value="<?php echo $res['id'];?>" />
                    <input type="hidden" name="acao" value="enviar" />
                    <input type="submit" value="Enviar" id="btn-submit" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
               $justificativa = strip_tags(trim($_POST['justificativa']));
                $id_adv = $_POST['id_adv'];
               $insert = mysql_query("UPDATE advertencia SET justificativa = '$justificativa', status = 0 WHERE id = '$id_adv'");
                if($insert){
                    echo '<div id="sucesso">Justificativa inserida!</div>';
                }else{
                    echo '<div id="erro">Problema ao inserir justificativa.</div>';
                }
            }?>
        </div><!--conteudo-->
        <div id="cssmenu">
            <ul>
                <?php
                $id_membro = $_SESSION['usuario'];
                $cargo = $_SESSION['cargo'];
                $nao_acessam = array(8,9);
                if(in_array($cargo, $nao_acessam)){
                    echo "<li class=''><a href='membros/justifica_adv.php?id=$id_membro'><span>Justificar Advert&egrave;ncia</span></a></li>";
                    echo "<li><a href='../../logout.php'><span>Sair</span></a></li>";
                }
                ?>
            </ul>

        </div>

<div style="clear: both"></div>
	</div><!--corpo-->
    <div id="footer" style="float:right;">
        <a href="pages/contact.php">feito por: MGS</a>
    </div>
</div><!--box-->
</body>
</html>