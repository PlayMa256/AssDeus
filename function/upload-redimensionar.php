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

function upload_generic($tmp, $nome,$tipo, $largura,$pasta, $altura){
    switch($tipo){
        case ".jpg":
            $img = imagecreatefromjpeg($tmp);
            $x = imagesx($img);
            $y = imagesy($img);
            $nova = imagecreatetruecolor($largura, $altura);
            imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
            imagejpeg($nova, "$pasta/$nome");
            break;
        case ".png":
            
    }

    imagedestroy($nova);
    imagedestroy($img);
    return($nome);
}
?>
