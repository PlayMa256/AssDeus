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
	<title>Cadastrar Alojamentos | Sistema de Controle</title>
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
                        required: true
                    },
                    VagasFem:{
                        // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true
                    },
                    VagasMasc:{
                        // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true
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
            <form method="post" enctype="multipart/form-data" id="formulario">
                <legend>Cadastro de Alojamentos</legend>

                <fieldset>
                    <label>
                        <span>Nome do Alojamento</span>
                        <input type="text" name="nome" />
                    </label>
                    <label>
                        <span>Local</span>
                        <input type="text" name="local" />
                    </label>
                    <label>
                        <span>Vagas para Mulheres</span>
                        <input type="text" name="VagasFem" />
                    </label>
                    <label>
                        <span>Vagas para Homens</span>
                        <input type="text" name="VagasMasc" />
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
                  $qr = mysql_query("INSERT INTO alojamentos (nome, local, VagasFem, VagasMasc) VALUES('$nome', '$local', '$VagasFem', '$VagasMasc')") or die(mysql_error());
                if($qr){
                    echo '<div id="sucesso">Alojamento cadastrado com sucesso.</div>';
                }else{
                    echo '<div id="erro">Erro ao cadastrar Alojamento.</div>';
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