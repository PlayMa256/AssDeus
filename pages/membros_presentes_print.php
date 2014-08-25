<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";?>
<script type="text/javascript">
    window.print();
</script>
<div class="relatorio" style="margin-top:10px;">

            <?php
            $reuniao = (int)$_POST['reuniao'];
            $sexo_filter = $_POST['sexo'];
/*            $quantidade = 20;
            $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
            $inicio     = ($quantidade * $pagina) - $quantidade;*/


            $sql3 = mysql_query("SELECT membros.id, membros.nome, membros.sexo, cargos.nome as CARGONOME FROM
                        (membros INNER JOIN cargos ON membros.cargoEclesiastico = cargos.id)
                        WHERE membros.id IN( SELECT id_membro FROM controle_membros WHERE id_reuniao = '$reuniao')
                        AND membros.sexo = '$sexo_filter'
                        ORDER BY cargos.id ASC") or die(mysql_error());

            $nr = mysql_query("SELECT reuniao.titulo FROM reuniao WHERE id ='$reuniao'") or die(mysql_error());
            $resultado = mysql_fetch_array($nr);
            $nome_reuniao = $resultado['titulo'];
            $nome_reuniao = str_replace("Reunião", "", $nome_reuniao);

            $quantidade_presentes = mysql_num_rows($sql3);

            if($quantidade_presentes == 0){
                echo '<h1>N&atilde;o h&aacute; membros presentes na Reuni&atilde;o '.$nome_reuniao.'</h1>';
            }else{
                echo '<h2>Relat&oacute;rio de membros presentes  na Reuni&atilde;o '.$nome_reuniao.'</h2>';
                echo '<table>
            <tr>
                <td style="font-weight: bold;text-align: center;color:#000;">Nome</td>
                <td style="font-weight: bold;text-align: center;color:#000;">Cargo</td>
            </tr>';

                while($res = mysql_fetch_array($sql3)){
                    $membro = $res['id'];
                    $membro_nome = $res['nome'];
                    $cargo = $res['CARGONOME'];
                    ?>
                    <tr>
                        <td><?php echo $membro_nome;?></td>
                        <td><?php echo $cargo;?></td>
                    </tr>
                <?php
                }
                echo '</table>';
            }
            ?>

</div>