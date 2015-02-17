<?php
include "../conf/config.php";
include "../function/logs.php";
$data = date('Y-m-d');
$hora = date("H:i:s");
//id da reuniao
$id = (int)$_GET['id_reuniao'];
/*echo "Id da reuniao: $id";*/
//$id = 10;
//reuniao finalizada
$updateReuniao = mysql_query("UPDATE reuniao SET status = 1 WHERE id = '$id'");

//setores ao qual ela faz parte selecionados
$selecionaSetores = mysql_query("SELECT setores FROM reuniao WHERE id = '$id'");
$resultado = mysql_fetch_array($selecionaSetores);
$setores = $resultado['setores'];

echo "<br/>setores: $setores<br/>";
$explode = explode(",", $setores);


$total = 0;
$certos = 0;
$errado = 0;
foreach($explode as $setoreIndividual){
    $membrosFora = mysql_query("SELECT membros.id, congregacao.setor FROM (membros INNER JOIN congregacao ON membros.congregacao = congregacao.id)
                            WHERE membros.id NOT IN(SELECT controle_membros.id_membro FROM controle_membros WHERE id_reuniao = '$id') AND congregacao.setor IN('$setoreIndividual')
                            AND membros.id NOT IN(SELECT id_membro FROM faltas WHERE id_reuniao = '$id' AND status = 0)
                                ") or die(mysql_error());


        $quantidade = mysql_num_rows($membrosFora);
        $total += $quantidade;
   // echo "<br/>Membros fora: $quantidade<br/>";
    //echo "total $total";

    while($res = mysql_fetch_array($membrosFora)){
        $id_membro = $res['id'];
        //inserir na tabela de faltas
        $falta = mysql_query("INSERT INTO faltas (id_membro, data, status, justificativa, id_reuniao) VALUES('$id_membro', '$data', '1', 'Nao Compareceu a Reuniao','$id')") or Logs(mysql_error(), 2);
        if($falta){
            $certos++;
        }else{
            $errado++;
        }
    }


}
    
if($updateReuniao && $certos == $total){
    echo '<script>alert("Reuniao encerrada com sucesso!");location.href="list_reuniao.php";</script>';
}else if(!$updateReuniao && $errado == $total){
    echo '<script>alert("Problema ao encerrar reuniao");location.href="list_reuniao.php";</script>';
}else if($certos >0 || $certos < $total){
    echo '<script>alert("Faltas dadas para alguns, nao para todos.");location.href="list_reuniao.php";</script>';
}