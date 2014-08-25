<?php
include "../conf/config.php";
include "../function/logs.php";
?>
<style type="text/css" media="all">
    @page
    {
        size: auto;   /* auto is the current printer page size */
        margin: 0mm;  /* this affects the margin in the printer settings */
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
<div id="box">
<?php
    function faltas(){
        echo '
        <h1 align="center">Relat&oacute;rio de Membros - Faltas</h1>
            <table border="1" cellspacing="0" class="table">
                 <tr>
                    <td style="font-weight:bold;">Nº</td>
                    <td style="font-weight:bold;">Nome</td>
                    <td style="font-weight:bold;">Cargo</td>
                    <td style="font-weight:bold;">Quantidade Faltas</td>
                 </tr>
            ';
//(membros INNER JOIN faltas on membros.id = faltas.id_membro)
        $sql = mysql_query("SELECT membros.id as id, membros.nome as nome, cargos.nome as cargo_nome, count(faltas.id) as quantidade FROM
        (faltas INNER JOIN membros ON  faltas.id_membro = membros.id INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id)
         GROUP BY membros.nome  ORDER BY cargos.id ASC")or Logs(date("d-m-Y H:i:s")." arquivo classifica na parte de faltas  ".mysql_error(), 2);
        while($res = mysql_fetch_array($sql)){
            $id = $res['id'];
            $nome = $res['nome'];
            $cargo = $res['cargo_nome'];
            $quantidade = $res['quantidade'];
            echo '<tr>
                    <td>'.$id.'</td>
                    <td>'.$nome.'</td>
                    <td>'.$cargo.'</td>
                    <td>'.$quantidade.'</td>
                 </tr>
            ';
        }
    }
function atraso(){
    echo '<h1 align="center">Relat&oacute;rio de Membros - Faltas</h1>
            <table border="1" cellspacing="0" class="table">
                 <tr>
                    <td style="font-weight:bold;">Nº</td>
                    <td style="font-weight:bold;">Nome</td>
                    <td style="font-weight:bold;">Cargo</td>
                    <td style="font-weight:bold;">Quantidade Atrasos</td>
                 </tr>
            ';
    $sql = mysql_query("SELECT membros.id as id, membros.nome as nome, cargos.nome as cargo, count(controle_membros.id) as quantidade FROM
    (controle_membros INNER JOIN membros ON controle_membros.id_membro = membros.id INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id)
    WHERE controle_membros.status = 1 GROUP BY membros.nome  ORDER BY cargos.id ASC") or Logs(date("d-m-Y H:i:s")." arquivo classifica na parte de atrasos ".mysql_error(), 2);
    while($res = mysql_fetch_array($sql)){
        $id = $res['id'];
        $nome = $res['nome'];
        $cargo = $res['cargo'];
        $quantidade = $res['quantidade'];
        //
        echo '<tr>
                    <td>'.$id.'</td>
                    <td>'.$nome.'</td>
                    <td>'.$cargo.'</td>
                    <td>'.$quantidade.'</td>
                 </tr>
            ';
    }
}
function geral(){
    echo '<h1 align="center">Relat&oacute;rio de Membros - Geral</h1>
            <table border="1" cellspacing="0" class="table">
                 <tr>
                    <td style="font-weight:bold;">Nº</td>
                    <td style="font-weight:bold;">Nome</td>
                    <td style="font-weight:bold;">Cargo</td>
                 </tr>
            ';
    $sql = mysql_query("SELECT membros.id as id, membros.nome as nome, cargos.nome as cargo, cargos.id FROM (membros INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id) WHERE cargos.id <> '10' ORDER BY cargos.id ASC ") or Logs(date("d-m-Y H:i:s")." arquivo classifica na parte de atrasos ".mysql_error(), 2);
    while($res = mysql_fetch_array($sql)){
        $id = $res['id'];
        $nome = $res['nome'];
        $cargo = $res['cargo'];
        echo '<tr>
                    <td>'.$id.'</td>
                    <td>'.$nome.'</td>
                    <td>'.$cargo.'</td>
                 </tr>
            ';
    }
}


    $consulta = $_POST['classificacao'];
    //$consulta = 'atraso';
    if($consulta == 'faltas'){
        faltas();
    }else if($consulta == 'atraso'){
        atraso();
    }else if($consulta == 'geral'){
        geral();
    }
    ?>
    </table>
</div>
<script type="text/javascript">
    window.print();
</script>