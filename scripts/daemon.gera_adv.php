<?php
include "../conf/config.php";
include "../function/format_data.php";
include "../function/logs.php";

$dataHora = date('d-m-Y H:i:s');
$data = date("Y-m-d");
$sql = mysql_query("SELECT id, nome from membros") ;//or Logs(date("d-m-Y H:i:s")." arquivo de gerar_advertencia ".mysql_error(), 3); //die(mysql_error());
//quantidade em faltas;
$quantidade = 0;

//quantidade de registros
$s = mysql_query("SELECT id FROM faltas WHERE leitura = 0");
$qtdRegistros = mysql_num_rows($s);

while($res = mysql_fetch_array($sql)){
    $quantidadeMax = 3;
    //id do membro
    $id = $res['id'];
    //echo 'id do membro: '.$id.'<br />';

    for($i = 1;$i<=$qtdRegistros;$i++){
        $j = (empty($j)) ? 0 : ((3*$i)-3);
        //echo 'i: '.$i.'<br /> j: '.$j.'<br />';
        //ou seja, status = 1 de faltou sem avisar, e leitura = 0 de que a linha ainda n foi analisada

        $sql3 = mysql_query("SELECT id FROM faltas WHERE id_membro = '$id' AND status = 1 AND leitura = 0 LIMIT $j, 3") or die(mysql_error()); // or Logs(date("d-m-Y H:i:s")." arquivo de gerar_advertencia ".mysql_error(), 3); //die(mysql_error());
        $quantidade = mysql_num_rows($sql3);

        //ver se ja tem advertencia ainda
        $selectAdv = mysql_query("SELECT id FROM advertencia WHERE id_membro = '$id' AND status = 0") or die(mysql_error());
        $haAdv = mysql_num_rows($selectAdv);
        if($haAdv == 0){
            if($quantidade == 3){
                $daAdv = mysql_query("INSERT INTO advertencia (id_membro, motivo, status, data) VALUES ('$id', 'Teve 3 faltas consecutivas', 0, '$data')");
                if($daAdv){
                    //echo 'deu a adv';
                }else{
                    //echo 'eu odeio a adv';
                }

                while($resultado = mysql_fetch_array($sql3)){
                    $idFalta = $resultado['id'];
                    echo $idFalta;
                    $update = mysql_query("UPDATE faltas SET leitura = 1 WHERE id = '$idFalta'");
                    if($update){
                        //echo 'foi dado update com sucesso';
                    }else{
                        //echo 'n foi dado n';
                    }
                }

            }else{
                //echo 'quantidade menor q 3';
                

            }
        }else{
            //echo ' tem adv';
        }





    }



}










/*//seleciona as reunioes
$sql3 = mysql_query("SELECT id, justificativa FROM faltas WHERE id_membro = '$id' AND status = 1 AND justificativa = NULL LIMIT $pos, $quantidadeMax") ;// or Logs(date("d-m-Y H:i:s")." arquivo de gerar_advertencia ".mysql_error(), 3); //die(mysql_error());
$quantidade = mysql_num_rows($sql3);

while($result = mysql_fetch_array($sql3)){
    echo $result['id']." <br /> ".$result['$justificativa']." <br />";
}
echo "quantidade = $quantidade <br />  quantidade registros = $qtdRegistros <br />";*/



/*if($quantidade == 3){
    $sql4 = mysql_query("INSERT INTO advertencia (id_membro, motivo, status, data) VALUES ('$id', 'O membro teve 3 faltas consecutivas em reunioes', 1, '$data')") or Logs(date("d-m-Y H:i:s")." arquivo de gerar_advertencia ".mysql_error(), 3); //die(mysql_error());
    $quantidade = 0;
}else{}*/