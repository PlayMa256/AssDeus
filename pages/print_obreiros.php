<?php
include_once "../conf/config.php";
include_once "header_print.php";
?>
<style type="text/css">
    .blsetor{

    }
    .titulo{
        color:#181818;
        /*margin-top:20px;*/
    }
    .cargos li{
        list-style:  	disc outside none;
        margin-left: 0px;
        font-size: 14pt;
        font-weight: bold;
    }
    .membros{
        list-style: disc;
        margin-left: -11px;
    }
    .membros li{
        font-weight: normal;
        font-size:12pt;
    }
</style>
<div style="clear:both"></div>
<?php
    $filter = $_POST['setores'];
    $explode = explode(",", $filter);
    foreach($explode as $setores){

        $membrocargo = (int)$_GET['mc'];
        $quantidade = 60;
        $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
        $inicio = ($quantidade * $pagina) - $quantidade;

        $sql = mysql_query("SELECT id, nome, setor FROM congregacao WHERE setor = '$setores' GROUP BY setor");
        while($res = mysql_fetch_array($sql)){
            $id_congregacao = $res['id'];
            $nome_congregacao = $res['nome'];
            $setor_congregacao = (empty($res['setor'])) ? "" : 'Setor '.$res['setor'];


            echo '<div class="blsetor">';
            echo "<h2>$setor_congregacao</h2>";
            echo "<h2 class='titulo'>$nome_congregacao</h2>";
            echo '<ul class="cargos">';

            $sql2 = mysql_query("SELECT nome, id FROM cargos");
            while($result = mysql_fetch_array($sql2)){
                $id_cargo = $result['id'];
                $nome_cargo = $result['nome'];
                $sql4 = mysql_query("SELECT id, nome FROM membros
                                    WHERE congregacao = '$id_congregacao' AND cargoEclesiastico = '$id_cargo' AND status = 1 AND membros.obreiro = 1
                                    ORDER BY nome ASC");
                $conta = mysql_num_rows($sql4);



                if($conta > 0){
                    echo "<li>$nome_cargo</li>";
                }else if(conta == 0){

                }

                $sql3 = mysql_query("SELECT id, nome FROM membros
                                    WHERE congregacao = '$id_congregacao' AND cargoEclesiastico = '$id_cargo' AND status = 1 AND membros.obreiro = 1
                                    ORDER BY nome ASC");
                while($ress = mysql_fetch_array($sql3)){
                    $nome_membro = $ress['nome'];
                    $id_membro = $ress['id'];
                    echo "<ul class='membros'>";
                    echo "<li>$nome_membro - $id_membro</li>";
                    echo "</ul>";
                }
            }

            echo '</ul>';
            echo '</div>';
        }
}?>
<script type="text/javascript">
        window.print();

</script>