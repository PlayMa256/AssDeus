<?php
include "../conf/config.php";
include "../function/logs.php";


$data = date('Y-m-d');
$hora = date("H:i:s");
$consulta_log = mysql_query("SELECT * FROM logs WHERE data = '$data' AND HOUR(TIMEDIFF('$hora', hora))>=1 AND status = 0");//or die(mysql_error());
while($res = mysql_fetch_array($consulta_log)){
    $id = $res['id'];
    $id_reuniao = $res['id_reuniao'];
    //novo status da reuniao
    $updateLogReuniao = mysql_query("UPDATE logs SET status = 1 WHERE id = '$id'");//or die(mysql_error());
    $updateReuniao    = mysql_query("UPDATE reuniao SET status = 1 WHERE id = '$id_reuniao'");//or die(mysql_error());

    $membros_fora = mysql_query("SELECT membros.id FROM membros WHERE membros.id NOT IN(SELECT controle_membros.id_membro FROM controle_membros WHERE id_reuniao = '$id_reuniao')");//or die(mysql_error());
    while($result = mysql_fetch_array($membros_fora)){
        $id_membro = $result['id'];

        //inserir na tabela de faltas
        $falta = mysql_query("INSERT INTO faltas (id_membro, data, status, id_reuniao) VALUES('$id_membro', '$data', '1', '$id_reuniao')");//or die(mysql_error());
        if($falta){
            //echo 'deu certo;';
        }else{
         //echo 'nao deu';
        }
    }
}
