<?php
include "../conf/config.php";
include "../function/logs.php";
include "../pages/header_print.php";
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
<div style="clear: both"></div>
<div id="box">
<?php
    function advertencias(){
        $sql = mysql_query("SELECT membros.id as id_membro, membros.nome as nome, cargos.nome as cargo_nome, count(advertencia.id) as quantidade FROM (
    advertencia INNER JOIN membros ON  advertencia.id_membro = membros.id INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id) GROUP BY membros.nome  ORDER BY cargos.id ASC")or Logs(date("d-m-Y H:i:s")." arquivo classifica na parte de faltas  ".mysql_error(), 2);
        $contar_resultados = mysql_num_rows($sql);
        $total_select = mysql_query("SELECT * FROM membros WHERE cargoEclesiastico <> 10");
        $conta_membros = mysql_num_rows($total_select);
        echo '
        <h1 align="center">Relat&oacute;rio de Membros - Faltas</h1>
        <p>'.$contar_resultados.' de '.$conta_membros.' membros</p>
            <table border="1" cellspacing="0" class="table">
                 <tr>
                    <td style="font-weight:bold;">Nº</td>
                    <td style="font-weight:bold;">Nome</td>
                    <td style="font-weight:bold;">Cargo</td>
                    <td style="font-weight:bold;">Quantidade Advert&ecirc;ncias</td>
                 </tr>
            ';
//(membros INNER JOIN faltas on membros.id = faltas.id_membro)

        while($res = mysql_fetch_array($sql)){
            $id = $res['id_membro'];
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
    advertencias();
    ?>
    </table>
</div>
<script type="text/javascript">
    window.print();
</script>