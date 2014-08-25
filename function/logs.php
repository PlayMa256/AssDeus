<?php
include_once "../conf/config.php";
/*
 * @param tipo  1 é para erros normais  2 para db, 3 para sucessos
 *
 * */
function Logs($msg, $tipo = 1){
    if($tipo == 1){
        $msg = trim($msg);
        $log_insert = mysql_query("INSERT INTO log_sistema (erro, tipo) VALUES ('$msg', '$tipo')");

    }else if($tipo == 2){
        $msg = trim($msg);
        $log_insert = mysql_query("INSERT INTO log_sistema (erro, tipo) VALUES ('$msg', '$tipo')");
        $pasta = "../logs/";

    }else if($tipo == 3){
        $msg = trim($msg);
        $log_insert = mysql_query("INSERT INTO log_sistema (erro, tipo) VALUES ('$msg', '$tipo')");

    }else if($tipo == 4){

    }
}