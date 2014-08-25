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
    <title>Cadastrar Membros | Sistema de Controle</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../js/tabulous.js"></script>
    <style type="text/css">
    </style>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $("form div:first").show().css({"background":"#FFF"});
            $(".nav a").click(function(){
                $("form div").hide();
                var div = $(this).attr('href');
                $(div).fadeIn();
                return false;
            });
        });
    </script>
</head>
<body>
<div id="box">
<div id="corpo">
<div id="conteudo">
<h1>Cadastro de membro</h1>
<ul class="nav">
    <li><a href="#pessoais" style="border-left:1px solid #333;">Dados Pessoais</a></li>
    <li><a href="#familiares" style="border-left:1px solid #333;">Dados Fam&iacute;liares</a></li>
    <li><a href="#complementares" style="border-left:1px solid #333;">Dados Complementares</a></li>
    <li><a href="#igreja" style="border-left:1px solid #333;border-right:1px solid #333;">Dados Eclesiásticos</a></li>
</ul>
<div style="clear: both;"></div>
<form action="" method="post" id="formulario" enctype="multipart/form-data" style=" margin-top:10px;
background:#FFF;
width:595px;
padding:5px;">
<div id="pessoais">
    <h4>Dados Pessoais</h4>
    <label>
        <span>Foto</span>
        <input type="file" name="foto" />
    </label>
    <label>
        <span>Nome</span>
        <input type="text" name="nome" placeholder="Insira o nome" />
    </label>
    <label>
        <span>Sexo</span>
        <select name="sexo">
            <option value="" selected="selected">Selecione o sexo</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select>
    </label>
    <span>Estado-Civil</span>
    <select name="estadoCivil" id="estadoCivil">
        <option value="" selected="selected">Selecione o estado civ&iacute;l.</option>
        <option value="Casado">Casado</option>
        <option value="Solteiro">Solteiro</option>
    </select>
    <label>
        <span>Data de Nascimento</span>
        <small>No formato dd-mm-aaaa.</small>
        <input type="text" name="dataNascimento" class="data"/>
    </label>
    <span>Estado de Nascimento</span>
    <select name="estadoNascimento" id="estadoNascimento" style="margin-bottom:5px;">
        <option value="" selected="selected">Selecione estado</option>
        <?php
        $consulta = mysql_query("SELECT DISTINCT uf FROM tb_cidades ORDER BY uf ASC");
        while($ln = mysql_fetch_array($consulta)){
            echo '<option value="'.$ln['uf'].'">'.$ln['uf'].'</option>';
        }
        ?>
    </select>
    <script type="text/javascript">
        $("#estadoNascimento").change(function(){
            var estado = $(this).val();
            $.post("../scripts/volta-cidade.php",
                {estado:estado},
                function(valor){
                    $("select[name=cidadeNascimento]").html(valor);
                }
            )
        });
    </script>
    <span>Cidade de Nascimento</span>
    <select name="cidadeNascimento">
        <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>
    </select>
    <label>
        <span>Nacionalidade</span>
        <input type="text" name="nacionalidade"/>
    </label>
    <label>
        <span>Telefone</span>
        <input type="text" name="tel" id="tel"/>
    </label>
    <label>
        <span>Telefone 1</span>
        <input type="text" name="tel1" id="tel" />
    </label>
    <label>
        <span>Telefone 2</span>
        <input type="text" name="tel2" id="tel" />
    </label>
    <label>
        <span>Celular</span>
        <input type="text" name="celular" id="cel" />
    </label>
    <label>
        <span>E-Mail</span>
        <input type="text" name="email"/>
    </label>
    <label>
        <span>Skype</span>
        <input type="text" name="skype"/>
    </label>
    <label>
        <span>Senha</span>
        <input type="password" name="senha" id="pass" />
    </label>
</div><!--pessoais-->
<div id="familiares">
    <h4>Dados Fam&iacute;liares</h4>
    <label>
        <span>Nome do Pai</span>
        <select name="nomePai">
            <option value="0" selected="selected" disabled="disabled">Selecione o nome do Pai</option>
            <?php
            $mysql = mysql_query("SELECT * FROM membros");
            while($res = mysql_fetch_array($mysql)){
                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
            }
            ?>
        </select>
    </label>
    <label>
        <span>Nome da M&atilde;e</span>
        <select name="nomeMae">
            <option value="0" selected="selected" disabled="disabled">Selecione o nome da m&atilde;e</option>
            <?php
            $mysql = mysql_query("SELECT * FROM membros");
            while($res = mysql_fetch_array($mysql)){
                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
            }
            ?>
        </select>
    </label>
    <label>
        <span>Nome do C&ocirc;njuge</span>
        <select name="conjuge">
            <option value="" selected="selected" disabled="disabled"></option>
            <?php
            $mysql = mysql_query("SELECT * FROM membros");
            while($res = mysql_fetch_array($mysql)){
                echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
            }
            ?>
        </select>
    </label>
    <script type="text/javascript">
        $("#estadoCivil").change(function(){
            var estado = $(this).val();
            switch (estado){
                case "Solteiro":
                    $('#filhosEstadoCivil').hide();
                    break;
            }
        });
    </script>
    <div id="filhosEstadoCivil">
        <span>Tem Filhos?</span>
        <input type="radio" name="filhos" value="1" />Sim
        <input type="radio" name="filhos" value="0" checked="checked" />N&atilde;o
    </div>
</div><!--familiares-->
<div id="complementares">
    <h4>Dados Complementares</h4>
    <label>
        <span>Endere&ccedil;o</span>
        <input type="text" name="endereco" />
    </label>
    <label>
        <span>Bairro</span>
        <input type="text" name="bairro" />
    </label>
    <span>Estado</span>
    <select name="estado" id="estado" style="margin-bottom:5px;">
        <option value="" selected="selected">Selecione estado</option>
        <?php
        $consulta = mysql_query("SELECT DISTINCT uf FROM tb_cidades ORDER BY uf ASC");
        while($ln = mysql_fetch_array($consulta)){
            echo '<option value="'.$ln['uf'].'">'.$ln['uf'].'</option>';
        }
        ?>
    </select>
    <script type="text/javascript">
        $("#estado").change(function(){
            var estado = $(this).val();
            $.post("../scripts/volta-cidade.php",
                {estado:estado},
                function(valor){
                    $("select[name=cidade]").html(valor);
                }
            )
        });
    </script>
    <span>Cidade</span>
    <select name="cidade">
        <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>
    </select>
    <label>
        <span>CEP</span>
        <input type="text" name="cep" class="cep" />
    </label>
    <label>
        <span>CPF</span>
        <input type="text" name="cpf" class="" />
    </label>
    <label>
        <span>RG</span>
        <input type="text" name="rg" id="rg" />
    </label>
    <label>
        <span>Data de emissão RG</span>
        <input type="text" name="data_emissao_rg" class="data" />
    </label>
    <label>
        <span>Org&atilde;o Emissor RG</span>
        <input type="text" name="orgao_emissor_rg" id="" />
    </label>
    <label>
        <span>T&iacute;tulo Eleitor</span>
        <input type="text" name="titulo_eleitor" id="" />
    </label>
    <label>
        <span>Zona Eleitoral</span>
        <input type="text" name="zona_eleitoral" id="" />
    </label>
    <label>
        <span>Se&ccedil;&atilde;o Eleitoral</span>
        <input type="text" name="sessao_eleitoral" id="" />
    </label>
    <label>
        <span>Tipo Sangu&iacute;neo</span>
        <select name="tipo_sanguineo">
            <option value="a+">A+</option>
            <option value="a-">A-</option>
            <option value="b+">B+</option>
            <option value="b-">B-</option>
            <option value="ab+">AB+</option>
            <option value="ab-">AB-</option>
            <option value="o+">O+</option>
            <option value="o-">O-</option>
        </select>
    </label>
    <label>
        <span>Cor</span>
        <input type="text" name="cor" />
    </label>
    <label>
        <span>Escolaridade</span>
        <select name="escolaridade">
            <option value="analfabeto">Analfabeto</option>
            <option value="Fundamental Completo">Fundamental Completo</option>
            <option value="Fundamental Incompleto">Fundamental Incompleto</option>
            <option value="Médio completo">M&eacute;dio Completo</option>
            <option value="Médio Incompleto">M&eacute;dio Incompleto</option>
            <option value="Superior">Superior</option>
            <option value="Superior incompleto">Superior Incompleto</option>
        </select>
    </label>
    <label>
        <span>Profiss&atilde;o</span>
        <input type="text" name="profissao" />
    </label>
    <label>
        <span>Empresa onde trabalha</span>
        <input type="text" name="empresa" value="" />
    </label>
    <label>
        <span>Telefone da empresa</span>
        <input type="text" name="telempresa" class="tel" />
    </label>
</div><!--complementers-->
<div id="igreja">
    <h4>Dados Eclesiásticos</h4>
    <span>Tipo de Admissão</span>
    <input type="text" name="admissao" />
    <span>Data de Admissão</span>
    <input type="text" name="dataAdmissao" class="data"/>
    <span>&Eacute; evang&eacute;lico?</span>
    <input type="radio" checked="checked" name="evangelico" value="1" />Sim
    <input type="radio" name="evangelico" value="0" />N&atilde;o
    <span>&Eacute; Discupulado?</span>
    <input type="radio" checked="checked" name="discipulado" value="1" />Sim
    <input type="radio" name="discipulado" value="0" />N&atilde;o
    <span>&Eacute; Batizado nas &Aacute;guas?</span>
    <input type="radio" checked="checked" name="aguas" value="1" />Sim
    <input type="radio" name="aguas" value="0" />N&atilde;o
    <span>&Eacute; Batizado nas Com o Esp&iacute;rito Santo?</span>
    <input type="radio" checked="checked" name="es" value="1" />Sim
    <input type="radio" name="es" value="0" />N&atilde;o
    <span>&Eacute; Dizimista Fiel?</span>
    <input type="radio" checked="checked" name="dizimista" value="1" />Sim
    <input type="radio" name="dizimista" value="0" />N&atilde;o
    <span>Tem curso teol&oacute;gico?</span>
    <input type="radio" checked="checked" name="curso" value="1" />Sim
    <input type="radio" name="curso" value="0" />N&atilde;o
    <span>&Eacute; Obreiro?</span>
    <input type="radio" checked="checked" name="obreiro" value="1" />Sim
    <input type="radio" name="obreiro" value="0" />N&atilde;o
    <span>Cargo Eclesiastico</span>
    <select name="cargoEclesiastico">
        <option value="" selected="selected">Selecione o cargo</option>
        <?php
        $sq = mysql_query("SELECT * from cargos WHERE nome <>'Administrador'");
        while($res = mysql_fetch_array($sq)){
            echo '<option value="'.$res['id'].'">'.utf8_encode($res['nome']).'</option>';
        }
        ?>
    </select>
    <span>Congrega&ccedil;&atilde;o</span>
    <select name="congregacao">
        <option value="" selected="selected">Selecione a congregacao</option>
        <?php
        $sq = mysql_query("SELECT * from congregacao");
        while($res = mysql_fetch_array($sq)){
            echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';
        }
        ?>
    </select>
    <span>Fun&ccedil;&atilde;o que Exerce</span>
    <select name="funcao">
        <option value="" selected="selected">Selecione o cargo</option>
        <?php
        $sq = mysql_query("SELECT * from cargos WHERE nome <>'Administrador'") or die(mysql_error());
        while($res = mysql_fetch_array($sq)){
            echo '<option value="'.$res['id'].'">'.utf8_encode($res['nome']).'</option>';
        }
        ?>
    </select>
    <input type="hidden" name="acao" value="cadastrar" />
    <input type="submit" value="Cadastrar" id="btn-submit" />
</div>
</form>
<?php
if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
    include_once "../scripts/cadastra_membro_script.php";
}
?>
</div><!--conteudo-->
<?php include("menu.php");?>
<div style="clear: both"></div>
</div><!--corpo-->
<div id="footer" style="float:right;">
    <a href="pages/contact.php">feito por: MGS</a>
</div>
</div><!--box-->
</body>
</html>
<script type="text/javascript" src="../js/jmask.js"></script>
<script type="text/javascript" src="../js/validate.js"></script>
<script type="text/javascript">
$(function(){
    $('.data').mask('99-99-9999');
    $('.data3').mask('99-99-9999');
    $('#tel').mask('(99)9999-9999');
    $('.tel').mask('(99)9999-9999');
    $('#cel').mask('(99)9999-9999');
    $('.cep').mask('99999-999')
    jQuery.validator.addMethod("verificaCPF", function(value, element) {
        value = value.replace('.','');
        value = value.replace('.','');
        cpf = value.replace('-','');
        while(cpf.length < 11) cpf = "0"+ cpf;
        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
        var a = [];
        var b = new Number;
        var c = 11;
        for (i=0; i<11; i++){
            a[i] = cpf.charAt(i);
            if (i < 9) b += (a[i] * --c);
        }
        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
        b = 0;
        c = 11;
        for (y=0; y<10; y++) b += (a[y] * c--);
        if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;
        return true;
    }, "Informe um CPF válido.");
    $("#formulario").validate({
// Define as regras
        rules:{
            nome:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            sexo:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true
            },
            estadoCivil:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            dataNascimento:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 4
            },
            estadoNascimento:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true
            },
            cidadeNascimento:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            nacionalidade:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            tel:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 8
            },
            celular:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 8
            },
            email:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 2, email: true
            },
            nomePai:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            nomeMae:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true
            },
            conjuge:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            endereco:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 2
            },
            bairro:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            estado:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            cidade:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            cep:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 2
            },
            cpf:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, verificaCPF: true
            },
            rg:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 9
            },
            data_emissao_rg:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 2
            },
            orgao_emissor_rg:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            titulo_eleitor:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            zona_eleitoral:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 2
            },
            sessao_eleitoral:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            tipo_sanguineo:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            cor:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            escolaridade:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true
            },
            profissao:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            empresa:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            telempresa:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, minlength: 2
            },
            admissao:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            dataAdmissao:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            cargoEclesiastico:{
// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true
            },
            congregacao:{
// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            funcao:{
// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true
            },
            senha:{
                required: true
            }
        },
// Define as mensagens de erro para cada regra
        messages:{
            nome: {required: "Preencha um nome"},
            sexo: "Selecione o Sexo",
            estadoCivil: "Selecione o estado civil",
            dataNascimento: {required:"Preencha a data de nascimento", minlength: "a data deve ter um tamanho maior"},
            estadoNascimento: "Selecione o estado de nascimento",//é select
            cidadeNascimento: "Selecione a cidade de nascimento",//é select
            nacionalidade: "Preencha a nacionalidade",
            tel: {required:"Preencha o telefone",minlength: "Telefone deve ter no minimo 8 digitos."},
            celular: {required: "Preencha com um celular", minlength: "O celular deve ter no minimo 8 digitos"},
            email: {required:"Preencha um Email", minlength: "O email deve ter no minimo 2 caracteres", email: "Preencha um email válido"},
            nomePai: {required:"Preencha o nome do pai"},//é select
            nomeMae: {required:"Preencha o nome da mãe"},//é select
            conjuge: {required:"Preencha o nome do(a) conjuge", minlength: "O nome tem que ter no minimo 2 caracteres"},//é select
// filhos: {required:"Preencha o nome do filho", minlength: "O nome tem que ter no minimo 2 caracteres"},//é select
            endereco: {required:"Preencha o endereço", minlength: "O endereço tem que ter no minimo 2 caracteres"},
            bairro: {required:"Preencha o bairro", minlength: "O bairro tem que ter no minimo 2 caracteres"},
            estado: "Selecione um estado",//é select
            cidade: "Selecione uma cidade",//é select
            cep:{required:"Preencha o cep", minlength: "O cep tem que ter no minimo 5 caracteres"},
            cpf: {
                required: "Digite seu CPF",
                verificaCPF: "CPF Invalido"
            },
            rg: {required:"Preencha o RG", minlength: "O RG tem que ter no minimo 9 caracteres"},
            data_emissao_rg: {required:"Preencha a data de emissão", minlength: "A data de emissao tem que ter no minimo 5 caracteres"},
            orgao_emissor_rg: "Preencha o nome do emissor do RG",
            titulo_eleitor: "Preencha o campo titulo de eleitor",
            zona_eleitoral: "Preencha o campo zona eleitoral",
            sessao_eleitoral: "Preencha o campo sessão eleitoral",
            tipo_sanguineo: "Selecione um tipo sanguineo", //é select
            cor: "Preencha o campo Cor",
            escolaridade: "Selecione a escolaridade",
            profissao: "Preencha o campo Profissão",
            empresa: "Preencha o nome da empresa",
            telempresa: "Preencha o telefone da empresa",
            admissao: "Selecione o motivo de admissão", //select
            dataAdmissao: {required:"Preencha a data de admissão", minlength: "A data de admissão tem que ter no minimo 5 caracteres"},
            congregacao: "Selecione a Congregação",
            funcao: "Selecione a função",
            senha: {required: "Preencha uma senha"}
        }
    });
});
</script>
