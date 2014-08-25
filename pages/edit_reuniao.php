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
	<title> | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/jmask.js"></script>
    <script type="text/javascript" src="../js/validate.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#data').mask('99-99-9999');
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
                        required:true,
                        date:true
                    },
                    DataFim:{
                        required:true,
                        date: true
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
            <form method="post" enctype="multipart/form-data" id="formulario">
                <fieldset>
                    <? if(isset($_GET)){
                        $id = (int)$_GET['id'];
                        $sql = mysql_query("SELECT * FROM reuniao WHERE id = '$id'");
                        $res = mysql_fetch_array($sql);
                    }
                    ?>
                    <label for="">
                        <span>Titulo</span>
                        <input type="text" name="titulo" value="<?php echo $res['titulo'];?>" />
                    </label>
                    <span>Dirigente</span>
                    <select name="dirigente">
                        <option value="" selected="selected">Selecione um dirigente</option>
                        <?php
                            $sql2 = mysql_query("SELECT id, nome FROM membros");
                            while($res2 = mysql_fetch_array($sql2)){
                                if($res2['id'] == $res['dirigente']){
                                    echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';
                                    echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                                }else{
                                    echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                                }

                            }
                        ?>
                    </select>

                    <span>Preletor</span>
                    <select name="preletor">
                        <option value="" selected="selected">Selecione um preletor</option>
                        <?php
                        $sql2 = mysql_query("SELECT id, nome FROM membros");
                        while($res2 = mysql_fetch_array($sql)){
                            if($res2['id'] == $res['preletor']){
                                echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';
                                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                            }else{
                            echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                            }
                        }
                        ?>
                    </select>

                    <label for="">
                        <span>Tema</span>
                        <input type="text" name="tema" value="<? echo $res['tema'];?>" />
                    </label>
                    <label for="">
                        <span>Tipo</span>
                        <select name="tipo">
                            <?php
                                switch($res['tipo']){
                                    case "Ministerial":

                                        echo '<option value="Ministerial" selected="selected" >Ministerial</option>
                            <option value="Extraordinária"  >Extraordin&acute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Extraordinária":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" selected="selected" >Extraordin&acute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Informativa":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" >Extraordin&acute;ria</option>
                            <option value="Informativa" selected="selected" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Treinamento":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" >Extraordin&acute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" selected="selected" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Pastoral":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" >Extraordin&acute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral"  selected="selected">Pastoral</option>';
                                        break;
                                }

                            ?>


                        </select>
                    </label>
                    <label for="">
                        <span>Observa&ccedil;&atilde;o</span>
                        <input type="text" name="obs" value="<? echo $res['obs']; ?>" />
                    </label>
                    <label for="">
                        <span>Data In&iacute;cio</span>
                        <input type="text" name="DataInicio" id="data" value="<? echo format_data_Normal($res['DataInicio']); ?>" />
                    </label>
                    <label for="">
                        <span>Data Fim</span>
                        <input type="text" name="DataFim" id="data" value="<? echo format_data_Normal($res['DataFim']); ?>" />
                    </label>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Enviar" />
                </fieldset>
            </form>
            <?php if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                $titulo = trim(strip_tags($_POST['titulo']));
                $dirigente = trim(strip_tags($_POST['dirigente']));
                $preletor = trim(strip_tags($_POST['preletor']));
                $tema = trim(strip_tags($_POST['tema']));
                $tipo = trim(strip_tags($_POST['tipo']));
                $obs = trim(strip_tags($_POST['obs']));
                $dataInicio = trim(strip_tags($_POST['DataInicio']));
                $dataInicio = format_data($dataInicio);
                $DataFim = trim(strip_tags($_POST['DataFim']));
                $DataFim = format_data($DataFim);

                $sql = mysql_query("UPDATE reuniao SET  titulo = '$titulo' , dirigente = '$dirigente' , preletor = '$preletor' , tipo = '$tipo' , tema = '$tema' , obs = '$obs' , DataInicio = '$dataInicio' , DataFim = '$DataFim'") or die(mysql_error());
                if($sql){
                    echo '<div id="sucesso">Dados Atualizados com sucesso</div>';
                }else{
                    echo '<div id="erro">Problema ao atualizar dados da reuni&atilde;o</div>';
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