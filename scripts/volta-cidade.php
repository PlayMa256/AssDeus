<?php
include "../conf/config.php";
$estado = $_POST['estado'];


    $qr = mysql_query("SELECT * from tb_cidades WHERE uf = '$estado'");
    if(mysql_num_rows($qr) ==0){
        echo  '<option value="0">'.htmlentities(utf8_decode('Não cidades nesse estado')).'</option>';
    }else{
        while($ln = mysql_fetch_assoc($qr)){
            echo '<option value="'.$ln['id'].'">'.$ln['nome'].'</option>';
        }
    }
