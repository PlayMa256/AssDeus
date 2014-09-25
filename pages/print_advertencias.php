<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "header_print.php";
include "../function/format_data.php";
?>
<style type="text/css">
    @page{
        margin-left:0mm;
    }
    table{
        width: 100%;
        float: left;
    }
    h1{
        float:left;

    }
    body{
        text-align: center;
    }
</style>
<div style="clear: both"></div>
<h1>Membros com advert&ecirc;ncias</h1>
<table>
    <tr>
        <th>C&oacute;digo</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Motivo</th>
        <th>Data</th>
    </tr>
<?php
$membro = (int)$_POST['membro'];
$sql = mysql_query("SELECT membros.id AS MEMBRO, membros.nome, cargos.nome AS CARGONOME, advertencia.motivo, advertencia.data FROM
(membros INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id INNER JOIN advertencia ON membros.id = advertencia.id_membro)
WHERE membros.id = '$membro' ORDER BY cargos.id ASC") or die(mysql_error());

while($res = mysql_fetch_array($sql)){
    $membro_id = $res['MEMBRO'];
    $membro_nome = $res['nome'];
    $cargo = $res['CARGONOME'];
    $motivo = $res['motivo'];
    $data = format_data_Normal($res['data']);
    echo "
        <tr>
            <td>$membro_id</td>
            <td>$membro_nome</td>
            <td>$cargo</td>
            <td>$motivo</td>
            <td>$data</td>
        </tr>
    ";
}
?>
</table>
