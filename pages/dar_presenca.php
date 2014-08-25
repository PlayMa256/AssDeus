<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
include_once "../function/logs.php";

//data e hora do sistema, ja em gmt-3
$date = date('Y-m-d');
$hora = date('H:i:s');


//substituir esse novo
$id_reuniao = $_GET['id'];
//Var status é = 0 => reuniao não finalizada, 1=> reuniao finalizada
//por padrao $status = 0;

$select = mysql_query("SELECT * FROM logs WHERE data = '$date'") or die(mysql_error());
$conta = mysql_num_rows($select);
if($conta == 0){
    $insert = mysql_query("INSERT INTO logs (id_reuniao, data, hora) VALUES ('$id_reuniao','$date', '$hora')") or die(mysql_error());
    if($insert){
        echo 's';
    }else{
        echo 'n';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Atestar Presen&ccedila | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <!--<link rel="stylesheet" href="../css/shadowbox.css"/>-->
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
   <!-- <script type="text/javascript" src="../js/shadowbox.js"></script>-->
        <script type="text/javascript" src="../js/modal/jquery.simplemodal.js"></script>
    <script type="text/javascript">
       $(function(){
           $("a#popup").click(function(){
               $.modal('<form method="post" enctype="multipart/form-data"><label><span>Nome</span><input type="text" name="id" class="id" /></label><div id="recebe_dados"></div></form>', {
                   overlayId: 'contact-overlay',
                   minHeight:400,
                   minWidth: 400,
                   //overlayClose:true,
               });


              $(".id").on('keyup', function(){
                   var nome = $(this).val();
                   $.post("../scripts/pega-nome.php",
                       {nome:nome},
                       function(valor){
                           $("#recebe_dados").html(valor);
                           if(!isEmpty(valor)){
                               $(".id").val("");
                           }else{
                               $(".id").val("");
                           }
                       });

               });
           });

           //modal
           $(document).on("click", ".Checkbox", function(){
               $(".alvo").val(this.value);
               var id_membro = $(".alvo").val();
               var reuniao = $("input[name=reuniao_id]").val();
               $.post(
                   "../scripts/presenca-script.php",
                   {id_membro:id_membro, id_reuniao:reuniao},
                   function(value){
                       $("#resultado").html(value);
                       $.modal.close();
                       //reseta os campos
                       $(".alvo").val("");
                   }
               );
               //fecha modal

           });
           /*$(".alvo").on('keyup', function(){
               var id_membro = $(this).val();
               var reuniao = $("input[name=reuniao_id]").val();
             $.post(
                   "../scripts/presenca-script.php",
                   {id_membro:id_membro, id_reuniao:reuniao},
                   function(value){
                       $("#resultado").html(value);
                       $(".alvo").val("");

                   }
               );


           });*/
     });


    </script>
<style type="text/css">
    #contact-overlay {
        background-color: #000;
    }
</style>
</head>
<body onload="document.formPresenca.campo.focus();">
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <form method="post" enctype="multipart/form-data" id="formPresenca" name="formPresenca">
                <fieldset>
                    <legend>Atestar Presen&ccedil;a</legend>
                    <label>
                        <span>C&oacute;digo</span>
                        <input type="text" name="id_membro" class="alvo" style="height:20px;" id="campo" />
                    </label>
                    <input type="hidden" name="reuniao_id" value="<?php echo $id_reuniao;?>" />
                    <input type="hidden" name="acao" value="enviar" />
                    <a href="#" id="popup"  rel="">Pesquisar Manualmente</a>
                    <!--<input type="submit" name="" value="Presença" />-->
                </fieldset>
            </form>


        <div id="resultado">
            <?php
            if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
                $data = date('Y-m-d');
                $hora = date("H:i:s");
                $id_membro = (int)$_POST['id_membro'];
                $id_reuniao = (int)$_GET['id'];

                $procura_ja_tem = mysql_query("SELECT * FROM controle_membros WHERE id_reuniao = '$id_reuniao' AND id_membro = '$id_membro'");
                $quantidade = mysql_num_rows($procura_ja_tem);
                if($quantidade == 0){
                    $sql = mysql_query("INSERT INTO controle_membros (id_membro, data, id_reuniao, hora, status) VALUES ('$id_membro', '$data', '$id_reuniao', '$hora', 0)") or Logs(mysql_error(), 2);
                    if($sql){
                        echo '<div id="sucesso">Presen&ccedil;a dada com sucesso!</div>';
                    }else{
                        echo '<div id="erro">Problema ao inserir presen&ccedil;a!</div>';
                    }
                }else{
                    echo '<div id="alert">Us&aacute;rio j&aacute; tem presen&ccedil;a</div>';
                }



            }
        ?>
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
