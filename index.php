<?php session_start();?>
<?php
include_once("conf/config.php");
?>
<?php
if(isset($_POST['acao']) && $_POST['acao'] == 'entrar'){
    $user = mysql_real_escape_string(strip_tags($_POST['user']));
    $password = md5(sha1(strip_tags($_POST['password'])));

    if(empty($user) && empty($password)){
        echo '<div id="error">Por favor, preencha todos os campos!</div>';
    }else if(empty($user)){
        echo '<div id="error">Por favor, preencha o seu usu&aacute;rio!</div>';
    }else if(empty($password)){
        echo '<div id="error">Por favor, preencha a sua senha!</div>';
    }else{
        $sql = mysql_query("SELECT id, senha, cargoEclesiastico FROM membros WHERE id = '$user'") or die(mysql_error());
        $res = mysql_fetch_array($sql);
        if($res['senha'] == $password){
            $_SESSION['usuario'] = $user;
            $_SESSION['cargo'] = $res['cargoEclesiastico'];
            //sucesso


            header("Location: pages/painel.php");
        }else{
            echo '<script>location.href="?erro=2";</script>';
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Painel de Controle</title>

    <link rel="stylesheet" href="css/style.css"/>
    <meta name="author" content="MATHEUS GONCALVES DA SILVA">
    <meta name="author" content="www.matheus-silva.esy.es">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap-theme.min.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>

    <style type="text/css">
        body{
            background: #FFFFFF;
        }
    </style>
</head>
<body>
<?php
///home/adcosmop/public_html/sistema
//echo '<h1>'.$_SERVER['DOCUMENT_ROOT'].'</h1>';
?>
<div class="container" style="height: 500px;left: 50%;margin-left: -250px;margin-top: -250px;position: absolute;top: 50%;width: 500px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title" style="text-align: center;font-weight: bold;">Acesso restrito, identifique-se!</h1>
        </div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data" role="form">
                <fieldset>
                    <div class="form-group">
                        <span>Usu&aacute;rio</span>
                        <input type="text" name="user" id="" class="form-control" />
                    </div>
                    <div class="form-group">
                        <span>Senha</span>
                        <input type="password" name="password" id="" class="form-control" />
                    </div>
                    <input type="hidden" name="acao" value="entrar" />
                    <input type="submit" value="Entrar" id="btn-submit" />
                </fieldset>
            </form>

        </div>

    </div>
    <?php
    if(isset($_GET)){
        $erro = $_GET['erro'];
        switch($erro){
            case 1:
                echo '<div id="alert" style="margin-top: -16px;width: 470px;">Voc&ecirc; deve estar logado para ter acesso.</div>';
                break;
            case 2:
                echo '<div id="erro" style="margin-top: -16px;width: 470px;">Senha errada</div>';
                break;
            case 3:
                echo '<div id="sucesso" style="margin-top: -16px;width: 470px;">Logado com sucesso!</div>';
                break;
        }
    }
    ?>
    <div id="footer" style="float:right;">
        <a href="pages/contact.php">feito por: MGS</a>
    </div>
</div>

</body>
</html>
