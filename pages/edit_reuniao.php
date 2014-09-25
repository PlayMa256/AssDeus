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
	<title>Editar Reuni&atilde;o | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/jmask.js"></script>
    <script type="text/javascript" src="../js/validate.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.data').mask('99-99-9999')
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
                    <span>Dirigente: </span>
                    <select name="dirigente">
                        <?php
                            $sql2 = mysql_query("SELECT id, nome FROM membros");
                            while($res2 = mysql_fetch_array($sql2)){
                                 if($res2['id'] == $res['dirigente']){
                                     echo '<option value="'.$res2['id'].'" selected="selected">'.$res2['nome'].'</option>';
                                 }else{
                                     echo '<option value="'.$res2['id'].'">'.$res2['nome'].'</option>';
                                 }
                            }
                        ?>
                    </select>

                    <span>Preletor</span>
                    <select name="preletor">
                        <?php
                        $sql2 = mysql_query("SELECT id, nome FROM membros");
                        while($res2 = mysql_fetch_array($sql2)){
                            if($res2['id'] == $res['preletor']){
                                echo '<option value="'.$res2['id'].'" selected="selected">'.$res2['nome'].'</option>';
                            }else{
                                echo '<option value="'.$res2['id'].'">'.$res2['nome'].'</option>';
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
                            <option value="Extraordinária"  >Extraordin&aacute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Extraordinária":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" selected="selected" >Extraordin&aacute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Informativa":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" >Extraordin&aacute;ria</option>
                            <option value="Informativa" selected="selected" >Informativa</option>
                            <option value="Treinamento" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Treinamento":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" >Extraordin&aacute;ria</option>
                            <option value="Informativa" >Informativa</option>
                            <option value="Treinamento" selected="selected" >Treinamento</option>
                            <option value="Pastoral" >Pastoral</option>';
                                        break;
                                    case "Pastoral":
                                        echo '<option value="Ministerial" >Ministerial</option>
                            <option value="Extraordinária" >Extraordin&aacute;ria</option>
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
                        <input type="text" name="DataInicio" class="data" value="<? echo format_data_Normal($res['DataInicio']); ?>" />
                    </label>
                    <label for="">
                        <span>Data Fim</span>
                        <input type="text" name="DataFim" class="data" value="<? echo format_data_Normal($res['DataFim']); ?>" />
                    </label>
                    <span>Setores Participantes</span>
                    <input type="text" name="setor" value="<?php echo $res['setores'];?>" />

                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Enviar" id="btn-submit" />
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
                $setor = $_POST['setor'];

                $id_reuniao = (int)$_GET['id'];

                    $sql = mysql_query("UPDATE reuniao SET  titulo = '$titulo' , dirigente = '$dirigente' , preletor = '$preletor' ,
                 tipo = '$tipo' , tema = '$tema' , obs = '$obs' , DataInicio = '$dataInicio' , DataFim = '$DataFim',
                 setores = '$setor' WHERE id = '$id_reuniao'") or die(mysql_error());


                if($sql){
                    echo '<script>alert("Dados Atualizados com sucesso!");location.href="edit_reuniao.php?id='.$id_reuniao.'";</script>';
                }else{
                    echo '<script>alert("Problema ao atualizar dados da reuni&atilde;o");location.href="edit_reuniao.php?id='.$id_reuniao.'";</script>';
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