<?php
include_once "../conf/config.php";
include_once "../function/logs.php";
$data = date('Y-m-d');
$hora = date("H:i:s");
$id_membro = (int)$_POST['id_membro'];
$id_reuniao = (int)$_POST['id_reuniao'];

$status = 0;




//consulta os logs pra ver quando começou a reuniao.
$select = mysql_query("SELECT * FROM logs WHERE data = '$data' and id_reuniao = '$id_reuniao'") or die(mysql_error());
while($res = mysql_fetch_array($select)){
    $horaInicio = $res['hora'];
    $diferencaHora = (int)abs((strtotime($horaInicio) - strtotime($hora))/60);


    if($diferencaHora >= 20){
        $status = 1;
    }else{
        $status = 0;
    }


    $procura_ja_tem = mysql_query("SELECT * FROM controle_membros WHERE id_reuniao = '$id_reuniao' AND id_membro = '$id_membro'");
    $quantidade = mysql_num_rows($procura_ja_tem);
    if($quantidade == 0){
        $sql = mysql_query("INSERT INTO controle_membros (id_membro, data, id_reuniao, hora, status) VALUES ('$id_membro', '$data', '$id_reuniao', '$hora', '$status')") or die(mysql_error());
        if($sql){
            echo '<div id="sucesso">Presen&ccedil;a dada com sucesso!</div>';
        }else{
            echo '<div id="erro">Problema ao inserir presen&ccedil;a!</div>';
        }
    }else{
        echo '<div id="alert">Us&aacute;rio j&aacute; tem presen&ccedil;a</div>';
    }

}

