<?php
function nome($sessao){
    $sql = mysql_query("SELECT nome FROM usuario WHERE id = '$sessao'");
    $res = mysql_fetch_array($sql);
    $nome = $res['nome'];
    return $nome;
}
