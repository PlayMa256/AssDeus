<?php
function cargo($sessao){
    $sql = mysql_query("SELECT cargo FROM usuario WHERE id = '$sessao'");
    $res = mysql_fetch_array($sql);
    $cargo = $res['cargo'];
    echo $cargo;
}
