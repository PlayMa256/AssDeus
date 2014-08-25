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
	<title>Editar Alojamentos | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/validate.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#formulario").validate({
                // Define as regras
                rules:{
                    nome:{
                        // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true
                    },
                    local:{
                        // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                        required: true, minlength: 2
                    },
                    VagasFem:{
                        // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true, minlength: 2
                    },
                    VagasMasc:{
                        // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true, minlength: 4
                    },
                },
                messages:{
                    nome: {required: "Preencha um nome"},
                    local: {required: "Preencha um local", minlength:"O local tem que ter pelo menos 2 caracteres"},
                    VagasFem: {required: "Preencha o numero de vagas para mulheres", minlength:"O numero de vagas tem que ter pelo menos 2 caracteres"},
                    VagasMasc: {required: "Preencha o numero de vagas para homens", minlength:"O numero de vagas tem que ter pelo menos 2 caracteres"}
                }
            });
        });
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
                    $ed = mysql_query("SELECT * FROM alojamentos WHERE id = '$id'");
                    $resultado = mysql_fetch_array($ed);
                }
            ?>
            <form method="post" enctype="multipart/form-data" id="formulario">
                <legend>Editar Alojamentos</legend>

                <fieldset>
                    <label>
                        <span>Nome do Alojamento</span>
                        <input type="text" name="nome" value="<? echo $resultado['nome'];?>" />
                    </label>
                    <label>
                        <span>Local</span>
                        <input type="text" name="local" value="<? echo $resultado['local'];?>" />
                    </label>
                    <label>
                        <span>Vagas para Mulheres</span>
                        <input type="text" name="VagasFem" value="<? echo $resultado['VagasFem'];?>" />
                    </label>
                    <label>
                        <span>Vagas para Homens</span>
                        <input type="text" name="VagasMasc" value="<? echo $resultado['VagasMasc'];?>" />
                    </label>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Cadastrar" id="btn-submit" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $nome = trim(strip_tags($_POST['nome']));
                $local = trim(strip_tags($_POST['local']));
                $VagasFem = trim(strip_tags($_POST['VagasFem']));
                $VagasMasc = trim(strip_tags($_POST['VagasMasc']));
                  $qr = mysql_query("INSERT INTO alojamento (nome, local, VagasFem, VagasMasc) VALUES('$nome', '$local', '$VagasFem', '$VagasMasc'");
                if($qr){
                    echo '<div id="sucesso">Alojamento editado com sucesso.</div>';
                }else{
                    echo '<div id="erro">Erro ao editado Alojamento.</div>';
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