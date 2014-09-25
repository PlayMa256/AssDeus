<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include_once "../function/logs.php";
if($_SESSION['cargo'] == 8 || $_SESSION['cargo'] == 9){
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Justificar Falta | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            language : "pt_BR",
            selector: "textarea",
            theme: "modern",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons"

        });
    </script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <form method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Preencher justificativa</legend>
                    <span>Selecione Membro</span>
                    <select name="membro">
                        <option value="" selected="selected" disabled="disabled">Selecione um membro</option>
                        <?php
                            $sql = mysql_query("SELECT nome, id FROM membros ORDER BY nome ASC");
                            while($res = mysql_fetch_array($sql)){
                                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
                            }
                        ?>
                    </select>
                <span>Motivo</span>
                    <textarea rows="" cols="" name="motivo" style="width:300px;height: 100px;padding: 5px;"></textarea><br/>
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" name="" value="Registrar" id="btn-submit" />
                </fieldset>
            </form>
            <?php
                if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
                    $reuniao = (int)$_GET['id'];
                    $membro = (int)$_POST['membro'];
                    $motivo = trim($_POST['motivo'] );
                    $data = date('Y-m-d');

                    $inserir = mysql_query("INSERT INTO faltas (id_membro, id_reuniao, data, status, justificativa) VALUES('$membro', '$reuniao', '$data', 0, '$motivo')") or Logs(date('d-m-Y H:i:s')." pagina: gera_justificativa_falta ".mysql_error(), 2);
                    if($inserir){
                        echo '<div id="sucesso">Justificativa inserida com sucesso</div>';

                    }else{
                        echo '<div id="erro">Erro ao inserir justificativa</div>';
                    }
                }
            ?>
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