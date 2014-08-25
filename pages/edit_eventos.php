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
	<title>Editar Eventos | Sistema de Controle</title>
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
            <?php
                if(isset($_GET)){
                    $id = (int)$_GET['id'];
                    $sql = mysql_query("SELECT * FROM eventos WHERE id = '$id'");
                    $resultado = mysql_fetch_array($sql);

                }
            ?>
             <form method="post" enctype="multipart/form-data">
                 <fieldset>
                     <label for="">
                         <span>Nome do Evento</span>
                         <input type="text" name="nome" value="<?php echo $resultado['nome'];?>"/>
                     </label>
                     <label for="">
                         <span>Data</span>
                         <input type="text" name="data" id="data" value="<?php echo format_data_Normal($resultado['data']);?>"/>
                     </label>
                     <label for="">
                         <span>Local do Evento</span>
                         <input type="text" name="local" value="<? echo $resultado['local'];?>"/>
                     </label>
                     <label for="">
                         <span>Vagas</span>
                         <input type="text" name="vagas" value="<? echo $resultado['vagas'];?>"/>
                     </label>

                     <input type="hidden" name="acao" value="cadastrar" />
                     <input type="submit" value="Cadastrar" id="btn-submit" />
                 </fieldset>
             </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $nome = utf8_encode(trim(strip_tags($_POST['nome'])));
                $data = format_data(trim(strip_tags($_POST['data'])));
                $local = trim(strip_tags($_POST['local']));
                $vagas = trim(strip_tags($_POST['vagas']));

                $insert = mysql_query("UPDATE eventos SET nome ='$nome', data = '$data', local = '$local', vagas = '$vagas'") or die (mysql_error());
                if($insert){
                    echo '<div id="sucesso">Evento editado com sucesso</div>';
                    sleep(4);
                    echo '<script>location.href="list_eventos.php";</script>';
                }else{
                    echo '<div id="erro">Problema ao editado evento</div>';
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