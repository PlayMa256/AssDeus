<?php
include "../scripts/permissao.php";
include "../conf/config.php";
include "../function/pega-nome.php";
include "../function/pega-nivel.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Preencher justificativa de falta avisada | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <!--<script src="../js/float/excanvas.min.js"></script>
    <script src="../js/float/jquery.flot.js"></script>
    <script type="text/javascript" src="../js/float/jquery.flot.pie.js"></script>-->
    <script type="text/javascript" src="../js/chart/Chart.js"></script>
    <?php
        $mesAtual = date("m");
        $anoAtual = date("Y");
        $inicioMes = $anoAtual."-".$mesAtual."-01";
        $today = date("Y-m-d");

        $selecionaFaltas = mysql_query("SELECT * from faltas WHERE data BETWEEN '$inicioMes' AND '$today'");
        $quantidade_faltas = mysql_num_rows($selecionaFaltas);

        $selecionaADvertencias = mysql_query("SELECT * from advertencia WHERE data BETWEEN '$inicioMes' AND '$today'");
        $quantidade_advertencias = mysql_num_rows($selecionaADvertencias);



    ?>
    <script type="text/javascript">
        $(function(){

            var lineChartFalta = $("#lineChart1").get(0).getContext("2d");
            //var lineChartAdv = $("#lineChart2").get(0).getContext("2d");

            var dataPie = [
                {
                    value: <?php echo $quantidade_faltas;?>,
                    color:"#F7464A",
                    highlight: "#FF5A5E",
                    label: "Faltas"
                },
                {
                    value: <?php echo $quantidade_advertencias;?>,
                    color: "#46BFBD",
                    highlight: "#5AD3D1",
                    label: "Advertências"
                }

            ];
            var dataFaltas = {
                <?php
                    $mesAtual = date("m");
                    if($mesAtual <=7){
                        echo 'labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho"],';
                    }else if($mesAtual >7){
                            echo 'labels: ["Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],';
                        }

                ?>

                datasets: [
                    {

                        label: "Faltas",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",

                <?php
                $mesAtual = date("m");
                $anoAtual =date("Y");
                if($mesAtual <=7){
                    if ((($ano % 4) == 0 and ($ano % 100)!=0) or ($ano % 400)==0){
                        $fevereiroDias = "29";
                     }else{
                        $fevereiroDias = "28";
                     }

                    $meses = array(
                        "$anoAtual-01-01" => "$anoAtual-01-31",
                        "$anoAtual-02-01" => "$anoAtual-02-$fevereiroDias",
                        "$anoAtual-03-01" => "$anoAtual-03-31",
                        "$anoAtual-04-01" => "$anoAtual-04-30",
                        "$anoAtual-05-01" => "$anoAtual-05-31",
                        "$anoAtual-06-01" => "$anoAtual-06-30",
                        "$anoAtual-07-01" => "$anoAtual-07-31"
                    );
                    $valoresDasFaltas = array();
                    foreach($meses as $k=>$v){
                        $selecionaFaltas = mysql_query("SELECT * from faltas WHERE data BETWEEN '$k' AND '$v'");
                        $quantidade_faltas = mysql_num_rows($selecionaFaltas);
                        $valoresDasFaltas[] = $quantidade_faltas;
                    }

                    echo "data: [$valoresDasFaltas[0], $valoresDasFaltas[1], $valoresDasFaltas[2], $valoresDasFaltas[3],
                    $valoresDasFaltas[4], $valoresDasFaltas[5], $valoresDasFaltas[6], $valoresDasFaltas[7]]";
                }
                if($mesAtual >7){

                                $meses = array(
                                    "$anoAtual-08-01" => "$anoAtual-08-31",
                                    "$anoAtual-09-01" => "$anoAtual-09-30",
                                    "$anoAtual-10-01" => "$anoAtual-10-31",
                                    "$anoAtual-11-01" => "$anoAtual-11-30",
                                    "$anoAtual-12-01" => "$anoAtual-12-31",
                                );
                                $valoresDasFaltas = array();
                                foreach($meses as $k=>$v){
                                    $selecionaFaltas = mysql_query("SELECT * from faltas WHERE data BETWEEN '$k' AND '$v'");
                                    $quantidade_faltas = mysql_num_rows($selecionaFaltas);
                                    $valoresDasFaltas[] = $quantidade_faltas;
                                }

                                echo "data: [$valoresDasFaltas[0], $valoresDasFaltas[1], $valoresDasFaltas[2], $valoresDasFaltas[3],$valoresDasFaltas[4]]";
                            }

                ?>

                    },
                    {
                        label: "Advertencias",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        <?php
                            $mesAtual = date("m");
                            $anoAtual =date("Y");
                            if($mesAtual <=7){
                                if ((($ano % 4) == 0 and ($ano % 100)!=0) or ($ano % 400)==0){
                                    $fevereiroDias = "29";
                                }else{
                                    $fevereiroDias = "28";
                                }

                                $meses = array(
                                    "$anoAtual-01-01" => "$anoAtual-01-31",
                                    "$anoAtual-02-01" => "$anoAtual-02-$fevereiroDias",
                                    "$anoAtual-03-01" => "$anoAtual-03-31",
                                    "$anoAtual-04-01" => "$anoAtual-04-30",
                                    "$anoAtual-05-01" => "$anoAtual-05-31",
                                    "$anoAtual-06-01" => "$anoAtual-06-30",
                                    "$anoAtual-07-01" => "$anoAtual-07-31"
                                );
                                $valoresDasAdvertencias = array();
                                foreach($meses as $k=>$v){
                                    $selecionaADvertencias = mysql_query("SELECT * from advertencia WHERE data BETWEEN '$k' AND '$v'");
                                    $quantidade_advertencias = mysql_num_rows($selecionaADvertencias);
                                    $valoresDasAdvertencias[] = $quantidade_advertencias;
                                }

                                echo "data: [$valoresDasAdvertencias[0], $valoresDasAdvertencias[1], $valoresDasAdvertencias[2], $valoresDasAdvertencias[3], $valoresDasAdvertencias[4], $valoresDasAdvertencias[5], $valoresDasAdvertencias[6], $valoresDasAdvertencias[7]]";
                            }
                            if($mesAtual >7){

                                $meses = array(
                                    "$anoAtual-08-01" => "$anoAtual-08-31",
                                    "$anoAtual-09-01" => "$anoAtual-09-30",
                                    "$anoAtual-10-01" => "$anoAtual-10-31",
                                    "$anoAtual-11-01" => "$anoAtual-11-30",
                                    "$anoAtual-12-01" => "$anoAtual-12-31",
                                );
                                $valoresDasAdvertencias = array();
                                foreach($meses as $k=>$v){
                                    $selecionaADvertencias = mysql_query("SELECT * from advertencia WHERE data BETWEEN '$k' AND '$v'");
                                    $quantidade_advertencias = mysql_num_rows($selecionaADvertencias);
                                    $valoresDasAdvertencias[] = $quantidade_advertencias;
                                }

                                echo "data: [$valoresDasAdvertencias[0], $valoresDasAdvertencias[1], $valoresDasAdvertencias[2], $valoresDasAdvertencias[3],$valoresDasAdvertencias[4]]";
                            }
                        ?>

                    }
                ]
            };

            var myLineChartFaltas = new Chart(lineChartFalta).Line(dataFaltas, {animateScale:true});
            //var myLineChartAdv = new Chart(lineChartAdv).Line(data, options);




        });
    </script>
</head>
<body>
<div id="box">
	<div id="header">

	</div><!--header-->
	<div id="corpo">
        <div id="conteudo">
            <h1>Estat&iacute;sticas Semestrais</h1>
                <canvas id="lineChart1" width="818px" height="409px"></canvas>
                <img src="../images/legenda_grafico.png" />
        </div>
        </div><!--conteudo-->

    <?php include("menu.php");?>


<div style="clear: both"></div>
	</div><!--corpo-->
    <div id="footer" style="float:right;">
        <a href="contact.php">feito por: MGS</a>
    </div>
</div><!--box-->
</body>
</html>