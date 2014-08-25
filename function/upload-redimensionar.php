<?php
function upload($tmp, $nome, $largura,$pasta, $altura){
    $img = imagecreatefromjpeg($tmp);
    $x = imagesx($img);
    $y = imagesy($img);
//    $altura = ($largura*$y) / $x;
    $nova = imagecreatetruecolor($largura, $altura);
    imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
    imagejpeg($nova, "$pasta/$nome");
    imagedestroy($nova);
    imagedestroy($img);
    return($nome);
}

?>
<!--<form method="post" enctype="multipart/form-data">
    <input type="file" name="foto" />
    <input type="submit" value="oi" />
    <input type="hidden" name="acao" value="cadastrra" />
</form>-->
<?php
  /*  if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrra'){
        $foto = $_FILES['foto'];
        $nome = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        $explode = explode(".", $nome);
        $ext = $explode[1];
        $nome = md5(uniqid(rand(), true)).'.'.$ext;

        $pasta = "../uploads/";

        $var = upload($tmp, $nome, 100, $pasta);
        echo $var;


    }*/
?>