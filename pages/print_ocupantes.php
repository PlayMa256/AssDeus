<?php
include "../function/format_data.php";
include "../conf/config.php";
include_once "header_print.php";
?>
<style type="text/css" media="all">
    @page
    {
        size: auto;   /* auto is the current printer page size */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
    #box{
        float:left;
        width: 100%;
    }
    .table{
        border-collapse: collapse !important;
        margin-top: 10px;
        width:100%;
    }
    .table th, .table td{
        border: 2px solid #000 !important;
        text-align: center;
        padding:5px;
        color:#000;
    }
    .table td{
        font-size:12pt;
    }
</style>
<div style="clear:both"></div>
<?php
$alojamento = (int)$_POST['alojamento'];
$dataInicio = format_data($_POST['data_inicio']);
$dataFIm = format_data($_POST['data_fim']);

$seleciona_total = mysql_query("SELECT * FROM membros");
$quantidade_membros = mysql_num_rows($seleciona_total);


$select = mysql_query("SELECT membros.nome, cargos.nome as CARGONOME, disposicao_membro_alojamento.data FROM (membros INNER JOIN disposicao_membro_alojamento ON disposicao_membro_alojamento.id_membro = membros.id
INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id) WHERE disposicao_membro_alojamento.id_alojamento = '$alojamento' AND data BETWEEN ('$dataInicio' AND '$dataFIm') ORDER BY cargos.id");
$quantidade_registros = mysql_num_rows($select);

echo "<p>$quantidade_registros de $quantidade_membros</p>";
echo '<table border="1" cellspacing="0" class="table">
    <thead>
        <td>Nome</td>
        <td>Cargo</td>
        <td>Data</td>
    </thead>
';
while($res = mysql_fetch_array($select)){

    $nome_membro = $res['nome'];
    $cargoMembro = $res['CARGONOME'];
    $data = $res['data'];
    $data = format_data_Normal($data);

    echo '<tr>';
    echo "<td>$nome_membro</td>";
    echo "<td>$cargoMembro</td>";
    echo "<td>$data</td>";
    echo '</tr>';

}



?>
</table>