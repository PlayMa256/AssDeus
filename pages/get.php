<?php
include "../conf/config.php";
$id = $_GET['id'];
if(!isset($id) || empty($id)){
    die("Please select your image!");
}else{

    $query = mysql_query("SELECT * FROM imagens WHERE id='".$id."'");
    $row = mysql_fetch_array($query);
    $content = $row['img'];

    header('Content-type: image/jpg');
    echo $content;
}