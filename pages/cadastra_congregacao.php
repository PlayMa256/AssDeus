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
	<title>Cadastrar Congrega&ccedil;&otilde;es | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/validate.js"></script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Cadastro de Congrega&ccedil;&atilde;o</h1>
            <form method="post" enctype="multipart/form-data" id="congregacao">


                <fieldset>
                    <label>
                        <span>Nome da Congrega&ccedil;&atilde;o</span>
                        <input type="text" name="nome" />
                    </label>

                        <span>Estado</span>
                        <select name="estado" id="estado" style="margin-bottom:5px;">
                            <option value="" selected="selected">Selecione estado</option>
                            <?php
                            $consulta = mysql_query("SELECT DISTINCT uf FROM tb_cidades ORDER BY uf ASC");
                            while($ln = mysql_fetch_array($consulta)){
                                echo '<option value="'.$ln['uf'].'">'.$ln['uf'].'</option>';
                            }
                            ?>
                        </select>
                        <script type="text/javascript">
                            $("#estado").change(function(){
                                var estado = $(this).val();
                                $.post("../scripts/volta-cidade.php",
                                    {estado:estado},
                                    function(valor){
                                        $("select[name=cidade]").html(valor);
                                    }
                                )

                            });

                        </script>
                    <span>Cidade</span>
                        <select name="cidade">
                            <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>
                        </select>
                    <label for="">
                        <span>Endere&ccedil;o</span>
                        <input type="text" name="endereco"/>
                    </label>
                    <label for="">
                        <span>Bairro</span>
                        <input type="text" name="bairro"/>
                    </label>
                    <label for="">
                        <span>Telefone 1</span>
                        <input type="text" name="tel1"/>
                    </label>
                    <label for="">
                        <span>Telefone 2</span>
                        <input type="text" name="tel2"/>
                    </label>
                    <label for="">
                        <span>E-mail</span>
                        <input type="text" name="email"/>
                    </label>
                        <span>Dirigente</span>
                        <select name="dirigente">
                            <?php
                                $qr=mysql_query("SELECT nome,id FROM membros");
                                while($res = mysql_fetch_array($qr)){
                                    echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                                }
                            ?>
                        </select>
                    <label for="">
                        <span>Setor</span>
                        <input type="text" name="setor"/>
                    </label>

                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Cadastrar" id="btn-submit" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){

                $nome = trim(strip_tags($_POST['nome']));
                $estado = $_POST['estado'];
                $cidade = $_POST['cidade'];
                $endereco = trim($_POST['endereco']);
                $bairro = trim($_POST['bairro']);
                $tel1 = trim($_POST['tel1']);
                $tel2 = trim($_POST['tel2']);
                $email = trim($_POST['email']);
                $dirigente =(int)$_POST['dirigente'];
                $setor = trim($_POST['setor']);

                    $qr = mysql_query("INSERT INTO congregacao (nome, estado, cidade, endereco, bairro, telefone1, telefone2, email, dirigente, setor)
                    VALUES ('$nome', '$estado', '$cidade', '$endereco', '$bairro', '$tel1', '$tel2', '$email', '$dirigente', '$setor')") or Logs(date('d-m-Y H:i:s').' pagina de cadastro de congregacao '.mysql_error(), 2);
                    if($qr){
                        echo '<div id="sucesso">Congrega&ccedil;&atilde;o inserido com sucesso</div>';
                    }else{
                        echo '<div id="erro">Problema ao inserir congrega&ccedil;&atilde;o</div>';
                    }

            }?>
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