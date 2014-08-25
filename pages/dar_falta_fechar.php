<?php
include "../conf/config.php";
include "../function/logs.php";
$data = date('Y-m-d');
$hora = date("H:i:s");

//id da reuniao
$id = (int)$_GET['id_reuniao'];

//reuniao finalizada
$updateReuniao = mysql_query("UPDATE reuniao SET status = 1 WHERE id = '$id'");

$membros_fora = mysql_query("SELECT membros.id FROM membros WHERE membros.id NOT IN(SELECT controle_membros.id_membro FROM controle_membros WHERE id_reuniao = '$id')") or Logs(mysql_error(), 2);
while($result = mysql_fetch_array($membros_fora)){
    $id_membro = $result['id'];

    //inserir na tabela de faltas
    $falta = mysql_query("INSERT INTO faltas (id_membro, data, status, id_reuniao) VALUES('$id_membro', '$data', '1', '$id_reuniao')") or Logs(mysql_error(), 2);
    if($falta && $updateReuniao){
        echo '<script>alert("Reuniao encerrada com sucesso!");location.href="list_reuniao.php";</script>';
    }else{
        echo '<script>alert("Problema ao encerrar reuniao");location.href="list_reuniao.php";</script>';
    }
}
