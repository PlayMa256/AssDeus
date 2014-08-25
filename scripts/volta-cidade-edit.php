<?php
include "../conf/config.php";
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];

    $qr = mysql_query("SELECT nome, id from tb_cidades");
    if(mysql_num_rows($qr) ==0){
        echo  '<option value="0">'.htmlentities(utf8_decode('Não cidades nesse estado')).'</option>';
    }else{
        while($ln = mysql_fetch_assoc($qr)){
            if($ln['id'] == $cidade){
                echo '<option value="'.$ln['id'].'" selected="selected">'.$ln['nome'].'</option>';

            }else{
                echo '<option value="'.$ln['id'].'">'.$ln['nome'].'</option>';
            }
        }
    }
