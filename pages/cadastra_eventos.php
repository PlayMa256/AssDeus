<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include "../function/format_data.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Cadastrar Eventos | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/jmask.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#data").mask("99-99-9999");
        })
    </script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Cadastrar Eventos</h1>
             <form method="post" enctype="multipart/form-data">
                 <fieldset>
                     <label for="">
                         <span>Nome do Evento</span>
                         <input type="text" name="nome"/>
                     </label>
                     <label for="">
                         <span>Data</span>
                         <input type="text" name="data" id="data"/>
                     </label>
                     <label for="">
                         <span>Local do Evento</span>
                         <input type="text" name="local"/>
                     </label>
                     <label for="">
                         <span>Vagas</span>
                         <input type="text" name="vagas"/>
                     </label>

                     <input type="hidden" name="acao" value="cadastrar" />
                     <input type="submit" value="Cadastrar" id="btn-submit" />
                 </fieldset>
             </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $nome = trim(strip_tags($_POST['nome']));
                $data = format_data($_POST['data']);
                $local = trim(strip_tags($_POST['local']));
                $vagas = trim(strip_tags($_POST['vagas']));


                $insert = mysql_query("INSERT INTO eventos (nome, data, local, vagas) VALUES ('$nome', '$data', '$local', '$vagas')");
                if($insert){
                    echo '<div id="sucesso">Evento inserido com sucesso</div>';
                }else{
                    echo '<div id="erro">Problema ao inserir evento</div>';
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