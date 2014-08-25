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
	<title> | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                $("#target").on('keyup', function(){
                    var nome = $(this).val();
                    $.post("../scripts/pega-nome.php",
                        {nome:nome},
                        function(valor){
                            $("#recebe_dados").html(valor);
                        }
                    )
                });
            })
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
                     <label for="">
                         <span>Nome</span>
                         <input type="text" id="target" name="nome"  />
                     </label>
                     <div id="recebe_dados">

                     </div>
                     <button value="Achei!" onclick="opener.document.formPresenca.id.value=id.value"  >Achei!</button>
                 </fieldset>
             </form>
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