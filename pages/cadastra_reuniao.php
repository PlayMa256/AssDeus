<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include_once "../function/format_data.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Cadastrar Reuni&otilde;es | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/jmask.js"></script>
    <script type="text/javascript" src="../js/validate.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#data').mask('99-99-9999');
            $('#data2').mask('99-99-9999');
            $("#formulario").validate({
                rules:{
                    titulo:{
                        required: true, minlength:2
                    },
                    dirigente:{
                        required:true
                    },
                    preletor:{
                        required:true
                    },
                    tema:{
                        required:true,
                        minlength:5
                    },
                    tipo:{
                        required:true
                    },
                    DataInicio:{
                        required:true

                    },
                    DataFim:{
                        required:true
                    }
                },
                messages:{
                    titulo:{required:"Preencha o campo Titulo", minlength: "O titulo tem que ter no minimo 2 caracteres"},
                    dirigente: "Selecione um Dirigente",
                    preletor: "Selecione um preletor",
                    tema: {required:"Preencha o campo tema", minlength: "O tema tem que ter pelo menos 5 caracteres"},
                    tipo: "Selecione um tipo de reuni&atilde;o",
                    DataInicio: {required: "Preencha a data de inicio da reuni&atilde;o", date: "Preencha uma data valida"},
                    DataFim: {required: "Preencha a data de termino da reuni&atilde;o", date: "Preencha uma data valida"},

                }



            })
        });
    </script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Cadastrar Reuni&atilde;o</h1>
            <form method="post" enctype="multipart/form-data" id="formulario">
                <fieldset>
                    <label for="">
                        <span>Titulo</span>
                        <input type="text" name="titulo" />
                    </label>
                    <span>Dirigente</span>
                    <select name="dirigente">
                        <option value="" selected="selected">Selecione um dirigente</option>
                        <?php
                            $sql = mysql_query("SELECT id, nome FROM membros");
                            while($res = mysql_fetch_array($sql)){
                                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                            }
                        ?>
                    </select>

                    <span>Preletor</span>
                    <select name="preletor">
                        <option value="" selected="selected">Selecione um preletor</option>
                        <?php
                        $sql = mysql_query("SELECT id, nome FROM membros");
                        while($res = mysql_fetch_array($sql)){
                            echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                        }
                        ?>
                    </select>

                    <label for="">
                        <span>Tema</span>
                        <input type="text" name="tema" />
                    </label>
                    <label for="">
                        <span>Tipo</span>
                        <select name="tipo">
                            <option value="" selected="selected">Selecione um tipo de reuni&atilde;o</option>
                            <option value="Ministerial" >Ministerial</option>
                            <option value="Extraordin&aacute;ria" >Extraordin&aacute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>
                        </select>
                    </label>
                    <label for="">
                        <span>Observa&ccedil;&atilde;o</span>
                        <input type="text" name="obs" />
                    </label>
                    <label for="">
                        <span>Data In&iacute;cio</span>
                        <input type="text" name="DataInicio" id="data" />
                    </label>
                    <label for="">
                        <span>Data Fim</span>
                        <input type="text" name="DataFim" id="data2" />
                    </label>
                    <span>Setores Participantes</span>
                    <small>Coloque no formato: 01,02,03(...)</small>
                    <input type="text" name="setor"  />

                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Enviar" id="btn-submit" />
                </fieldset>
            </form>
            <div id="alertas">
            <?php
               if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $titulo = trim(strip_tags($_POST['titulo']));
                $dirigente = trim(strip_tags($_POST['dirigente']));
                $preletor = trim(strip_tags($_POST['preletor']));
                $tema = trim(strip_tags($_POST['tema']));
                $tipo = trim(strip_tags($_POST['tipo']));
                $obs = trim(strip_tags($_POST['obs']));
                $dataInicio = trim(strip_tags($_POST['DataInicio']));
                $DataFim = trim(strip_tags($_POST['DataFim']));
                $setor = $_POST['setor'];


                //valores escapados e inseridos "virgulas"
                //$escaped_values = array_map('mysql_real_escape_string', array_values($setor));
                //inserido virgula
                //$values  = implode(", ", $escaped_values);

                if(strtotime($dataInicio) < strtotime(date("d-m-Y"))){
                    echo '<div id="erro">A data de inicio tem que ser maior ou igual a data de hoje!</div>';
                }else if(strtotime($DataFim) < strtotime(date("d-m-Y"))){
                    echo '<div id="erro">A data de termino tem que ser maior ou igual a data de hoje!</div>';
                }else{
                    $dataInicio = format_data($dataInicio);
                    $DataFim = format_data($DataFim);
                    $sql = mysql_query("INSERT INTO reuniao (titulo, dirigente, preletor, tipo, tema, obs, DataInicio, DataFim, status, setores)
                    VALUES('$titulo', '$dirigente','$preletor','$tipo','$tema','$obs','$dataInicio','$DataFim', 0, '$setor')") or die(mysql_error());
                    if($sql){
                        echo '<div id="sucesso">Reuni&atilde;o cadastrada com sucesso.</div>';
                        echo '<script>location.href="#alertas";</script>';
                    }else{
                        echo '<div id="erro">Problema ao inserir dados da reuni&atilde;o</div>';
                        echo '<script>location.href="#alertas";</script>';
                    }
            }}?>
            </div>
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