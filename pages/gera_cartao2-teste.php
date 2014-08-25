<?php
include '../function/barcode.inc.php';
include '../conf/config.php';
include '../function/logs.php';
include '../function/format_data.php';

//codigo barras
require_once('../barcode/class/BCGFontFile.php');
require_once('../barcode/class/BCGColor.php');
require_once('../barcode/class/BCGDrawing.php');
require_once('../barcode/class/BCGcode128.barcode.php');

?>
<style type="text/css">
    @font-face {
        font-family: impact;
        src: url('../fontes/IMPACT.TTF');
    }
    .cartao{
        /*background: url('../modelos-carteirinhas/templates/Homens/membro-azul.png') no-repeat;*/
        height: 377px;
        width: 600px;
        position: relative;

    }
    .cartao > img{
        bottom: 22px;
        left: 91px;
        position: absolute;
    }
    .nome{
        bottom: 43px;
        font-family: Berlin Sans Fb;
        font-size: 18px;
        left: 259px;
        position: absolute;
    }
    .congregacao{
        bottom: 25px;
        font-family: Berlin Sans Fb;
        font-size: 18px;
        left: 308px;
        position: absolute;
    }
    .verso{
        background: url("../modelos-carteirinhas/templates/Cartao%20Verso.png") no-repeat;
        height: 377px;
        width: 600px;
        margin-left: 600px;
        margin-top: -377px;
        position: relative;
        font-size:14px;
        font-family: impact;
    }
    .registro{
        left: 122px;
        position: absolute;
        top: 93px;
    }
    .estadoCivil{
        left: 126px;
        position: absolute;
        top: 117px;
    }
    .Batismo{
        left: 289px;
        position: absolute;
        top: 93px;
    }
    .rg{
        left: 266px;
        position: absolute;
        top: 117px;
    }
    .nascimento{
        left: 474px;
        position: absolute;
        top: 93px;
    }
    .validade{
        left: 433px;
        position: absolute;
        top: 117px;
    }
    .barras{
        height: 75px;
        left: 50%;
        margin-left: -35px;
        margin-top: 96px;
        position: absolute;
        top: 50%;
    }
</style>
<?php
    $ids_membros = $_POST['membros'];
    $quantidade = count($ids_membros);
    //echo "QUANTIDADE: $quantidade <br />";
    for($i = 0;$i<$quantidade;$i++){
        $idMembro = $_POST['membros'][$i];
//        echo $idMembro;

        $sql = mysql_query("SELECT * FROM membros WHERE id = '$idMembro'") or Logs(date('d-m-Y H:i:s').' arquivo: gera_cartao2'.mysql_error(), 2);
        while($res = mysql_fetch_array($sql)){
            $foto = $res['foto'];
            $id = $res['id'];
            $nome = $res['nome'];
            $congregacao = $res['congregacao'];
            //procura COngregacao
            $sql2 = mysql_query("SELECT nome FROM congregacao WHERE id = '$congregacao'");
            $resultado = mysql_fetch_array($sql2);
            $congregacao = $resultado['nome'];


            $cargo = $res['cargoEclesiastico'];
            $nascimento = $res['dataNascimento'];
            //ainda nao tem
            //$batismo = $res['batismo'];
            $rg = $res['rg'];
            $rg = str_replace(".", "", $rg);
            $estadoCivil = $res['estadoCivil'];
            $data = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")+1);
            $dataVencimento = date("d/m/Y", $data);
            $sexo = $res['sexo'];

            if($sexo == 'Masculino'){
                switch($cargo){
                    case 1:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/pastor-azul.png') no-repeat;
                                    
                                }
                            </style>
                        ";
                    break;
                    case 2:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/bispo-azul.png') no-repeat;
                                }
                            </style>
                        ";
                    break;
                    case 3:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/evangelista-azul.png') no-repeat;
                                }
                            </style>
                        ";
                    break;
                    case 4:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/missionario-azul.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 5:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/presbitero-azul.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 6:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/diacomo-azul.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 7:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/auxiliar-azul.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 8:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/membro-azul.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 9:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/Homens/visitante-azul.png') no-repeat;
                                }
                            </style>
                        ";
                    break;
                }
            }else if($sexo == 'Feminino'){
                switch($cargo){
                    case 1:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/pastor-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 2:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/bispo-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 3:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/evangelista-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 4:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/missionario-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 5:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/presbitero-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 6:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/diacomo-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 7:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/auxiliar-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 8:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/membro-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                    case 9:
                        echo "
                            <style type=\"text/css\">
                                .cartao{
                                    background: url('../modelos-carteirinhas/templates/mulheres/visitante-rosa.png') no-repeat;
                                }
                            </style>
                        ";
                        break;
                }//switch
            }//if

            // The arguments are R, G, and B for color.
            $colorFront = new BCGColor(0, 0, 0);
            $colorBack = new BCGColor(255, 255, 255);
            $font = new BCGFontFile('../barcode/font/Arial.ttf', 18);//font
            $code = new BCGcode128(); // Or another class name from the manual
            $code->setScale(2); // Resolution
            $code->setThickness(30); // Thickness
            $code->setForegroundColor($colorFront); // Color of bars
            $code->setBackgroundColor($colorBack); // Color of spaces
            $code->setFont($font); // Font (or 0)
            $code->parse($id); // Text
            $drawing = new BCGDrawing('../images/codigobarras/id'.$id.'-codigoBarras.png', $colorBack);
            $drawing->setBarcode($code);
            $drawing->draw();
            $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

            echo '
            <div class="cartao">
                <span class="nome">'.$nome.'</span>
                <span class="congregacao">'.$congregacao.'</span>
                <img src="../uploads/'.$foto.'" />
            </div>
            <div class="verso">
                <span class="registro">'.$id.'</span>
                <span class="estadoCivil">'.$estadoCivil.'</span>
                <span class="Batismo"></span>
                <span class="rg">'.$rg.'</span>
                <span class="nascimento">'.$nascimento.'</span>
                <span class="validade">'.format_data_Normal($dataVencimento).'</span>

                <img src="../images/codigobarras/id'.$id.'-codigoBarras.png" height="70px" align="" class="barras" />
            </div>
        <br />
        ';

        }//while




    }//for


?>
<!--<table class="cartao" border="1" style="border:1px solid #000" cellspacing="0">
    <tr>
        <td colspan=""><img src="../uploads/2995.jpg" width="75px" /></td>
        <td colspan="3"><small>Nome</small><span>Matheus Gonçalves da Silva</span></td>
    </tr>
    <tr>
        <td><small>Cspanf</small><span>445.261.258-06</span></td>
        <td><small>Rg</small><span>50.219.049-8</span></td>
        <td><small>Número</small><span>1</span></td>
        <td><small>Estado Civil</small><span>Solteiro</span></td>
    </tr>
    <tr>
        <td colspall="3"><small>Natural</small><span>Cosmópolis - SP</span></td>
        <td><small>Admissão</small><span> 11/08/2013</span></td>
    </tr>
    <tr>
        <td colspan="4">Codigo de barras</td>
    </tr>
</table>-->

<!--<table border="1" cellspacing="0" style="border:1px solid #000" class="cartao" width="350px;">
    <tbody><tr>
        <td class="image" align="center" style="border-right:0px;"><img src="../uploads/2995.jpg" style="" width="85px" align="center" /></td>
        <td colspan="3" style="border-left:0px;"><small>Nome</small><span>Matheus GonÃ§alves da Silva</span></td>
    </tr>
    <tr>
        <td><small>Cspanf</small><span>445.261.258-06</span></td>
        <td><small>Rg</small><span>50.219.049-8</span></td>
        <td><small>NÃºmero</small><span>1</span></td>
        <td><small>Estado Civil</small><span>Solteiro</span></td>
    </tr>
    <tr>
        <td><small>Natural</small><span>CosmÃ³polis</span></td>
        <td><small>Estado</small><span>SP</span></td>
        <td colspan="2"><small>AdmissÃ£o</small><span> 11/08/2013</span></td>
    </tr>
    <tr>
        <td colspan="4" align="center">



        </td>
    </tr>
    </tbody></table>-->

<!--<div id="cartao">
    <div id="linha1" style="position: relative">
        <img src="../uploads/2995.jpg" width="85px" />
        <div class="direita" style="position: absolute; top: -3px; padding: 3px; text-align: center; right: 61px;">
            <div style=" border: 1px solid rgb(0, 0, 0);text-align: center;padding: 3px;"><small style="text-align: left;">Nome</small><span>Matheus GonÃ§alves da Silva</span></div>
        </div>
        <div>


        </div>
    </div>


</div>-->
<script type="text/javascript">
    window.print();
</script>


