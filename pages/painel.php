<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include_once "../scripts/daemon.gera_adv.php";
include_once "../scripts/backup2/backup.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>HOME | Sistema de Controle de Membros</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
<?php
    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $usuario = $_SESSION['usuario'];
    $s = mysql_query("INSERT INTO log_acesso (membro, data, hora) VALUES ('$usuario', '$data', '$hora')") or die(mysql_error()); 

?>
</head>
<body>

	<!--<div id="header" style="width: 100%;position: absolute">
        <div id="logo">
            <img src="../images/logo%20igreja.png" alt="igreja" height="150" style="position: relative;top:10px; left:5px" />
        </div>-->

	</div><!--header-->
    <div id="box">
	<div id="corpo">
        <div id="conteudo">
             <h1>Bem vindo ao painel de controle <?php //echo nome($_SESSION['usuario']); ?></h1>
             <p>Selecione uma das Op&ccedil;&otilde;es ao lado.</p>


            <p></p>
        </div><!--conteudo-->

    <?php if($_SESSION['cargo'] == 8 || $_SESSION['cargo'] == 9){
        $user = $_SESSION['usuario'];
        //header("location: justifica_adv.php?id=$user");
        $id_membro = $_SESSION['usuario'];
        $cargo = $_SESSION['cargo'];
        $nao_acessam = array(8,9);
        if(in_array($cargo, $nao_acessam)){
            echo '<div id="cssmenu">
            <ul>';
            echo "<li class=''><a href='justifica_adv.php?id=$id_membro'><span>Justificar Advert&egrave;ncia</span></a></li>";
            echo "<li><a href='../../logout.php'><span>Sair</span></a></li>";
            echo '</ul>
        </div>';
        }

    }else{

    include("menu.php");
}?>


<div style="clear: both"></div>
	</div><!--corpo-->
        <div id="footer" style="float:right;">
            <a href="pages/contact.php">feito por: MGS</a>
        </div>
</div><!--box-->
</body>
</html>