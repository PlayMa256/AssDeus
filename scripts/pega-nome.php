<?php
include_once "../conf/config.php";
$get = $_POST['nome'];
$mysql = mysql_query("SELECT id, nome FROM membros WHERE nome LIKE '%$get%'");
while($res = mysql_fetch_array($mysql)){
    echo '<input type="checkbox" name="id" value="'.$res['id'].'" class="Checkbox">'.$res['nome'].'<br/>';
}