<?php
include_once "../conf/config.php";
include_once "../function/format_data.php";
include_once "../function/valida_cpf.php";
include_once "../function/upload-redimensionar.php";

$codigo = trim($_POST['codigo']);
$nome_membro = trim($_POST['nome']);
$sexo = trim($_POST['sexo']);
$estadoCivil = trim($_POST['estadoCivil']);
$dataNascimento = trim($_POST['dataNascimento']);
$dataNascimento = format_data($dataNascimento);
$estadoNascimento = trim($_POST['estadoNascimento']);
$cidadeNascimento = trim($_POST['cidadeNascimento']);//FK da tabela tb_cidades em que está a combinação UF/Cidade
$nacionalidade = trim($_POST['nacionalidade']);
$tel = trim($_POST['tel']);
$tel1 = trim($_POST['tel1']);
$tel2 = trim($_POST['tel2']);
$celular = trim($_POST['celular']);
$email = trim($_POST['email']);
$skype = trim($_POST['skype']);
$nomePai = trim($_POST['nomePai']); //id da tabela membros
$nomeMae = trim($_POST['nomeMae']);//id da tabela membros
$conjuge = trim($_POST['conjuge']);//id da tabela membros
$filhos  = $_POST['filhos'];// 1 = SIM, 0 = NAO
$endereco = trim($_POST['endereco']);
$bairro = trim($_POST['bairro']);
$estado = trim($_POST['estado']);
$cidade = trim($_POST['cidade']);//FK da tabela tb_cidades em que está a combinação UF/Cidade
$cep = trim($_POST['cep']);
$cpf = $_POST['cpf'];
$rg = trim($_POST['rg']);
$data_emissao_rg = trim($_POST['data_emissao_rg']);
$data_emissao_rg = format_data($data_emissao_rg);
$orgao_emissor_rg = trim($_POST['orgao_emissor_rg']);
$titulo_eleitor = trim($_POST['titulo_eleitor']);
$zona_eleitoral = trim($_POST['zona_eleitoral']);
$sessao_eleitoral = trim($_POST['sessao_eleitoral']);
$tipo_sanguineo = trim($_POST['tipo_sanguineo']);
$cor = trim($_POST['cor']);
$escolaridade = trim($_POST['escolaridade']);
$profissao = trim($_POST['profissao']);
$empresa = trim($_POST['empresa']);
$telempresa = trim($_POST['telempresa']);
$admissao = trim($_POST['admissao']);
$dataAdmissao = trim($_POST['dataAdmissao']);
$dataAdmissao = format_data($dataAdmissao);
$evangelico = $_POST['evangelico'];// 1 = sim, 0 = nao
$discipulado = $_POST['discipulado']; // 1 = sim, 0 = nao
$aguas = $_POST['aguas'];   // 1 = SIM, 0 = NAO
$es = $_POST['es']; // 1 = SIM, 0 = NAO
$dizimista = $_POST['dizimista'];   // 1 = SIM, 0 = NAO
$curso = $_POST['curso'];   // 1 = SIM, 0 = NAO
$obreiro = $_POST['obreiro'];   // 1 = SIM, 0 = NAO
$cargoEclesiastico = trim($_POST['cargoEclesiastico']);//FK da tabela cargos
$congregacao = trim($_POST['congregacao']);//FK da tabela congregacao
$funcao = trim($_POST['funcao']); //FK da tabela cargos
$data = date('Y-m-d');
$batismo = format_data($_POST['batismo']);
$status = (int)$_POST['status'];
$senha = (empty($_POST['senha'])) ? "" :  md5(sha1($_POST['senha']));




    $foto = $_FILES['foto'];
    $nome = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $explode = explode(".", $nome);
    $ext = $explode[1];
    $nome = (empty($nome)) ? 'vazio-'.$codigo.'-'.md5(uniqid(rand(), true)) : $codigo.'-'.md5(uniqid(rand(), true)).'.'.$ext;
    $pasta = "../uploads/";



    $var = upload($tmp, $nome, 110, $pasta, 147);


    if(!empty($var)){//move_uploaded_file($tmp, $pasta.nome)){

        $sql = mysql_query("INSERT INTO membros (id, foto, nome,sexo,estadoCivil,dataNascimento,estadoNascimento,
        cidadeNascimento,nacionalidade,telefone,tel1,tel2,celular,email,skype,nomePai,nomeMae,
        conjuge,filhos,endereco,bairro,estado,cidade,cep,cpf,rg,data_emissao_rg,orgao_emissor_rg,
        titulo_eleitor,zona_eleitoral,sessao_eleitoral,tipo_sanguineo,cor,escolaridade,profissao,empresa,
        telempresa,admissao,dataAdmissao,evangelico,discipulo,aguas,es,dizimista,curso,obreiro,
        cargoEclesiastico,congregacao,funcao,data, senha, batismo,status)
        VALUES('$codigo','$var','$nome_membro','$sexo','$estadoCivil','$dataNascimento','$estadoNascimento',
        '$cidadeNascimento','$nacionalidade','$tel','$tel1','$tel2','$celular','$email',
        '$skype','$nomePai','$nomeMae','$conjuge','$filhos','$endereco','$bairro','$estado',
        '$cidade','$cep','$cpf','$rg','$data_emissao_rg','$orgao_emissor_rg',
        '$titulo_eleitor','$zona_eleitoral','$sessao_eleitoral','$tipo_sanguineo','$cor',
        '$escolaridade','$profissao','$empresa','$telempresa','$admissao','$dataAdmissao','$evangelico','$discipulado',
        '$aguas','$es','$dizimista','$curso','$obreiro','$cargoEclesiastico','$congregacao','$funcao','$data', '$senha', '$batismo', '$status')") or die(mysql_error());

        if($sql){
            echo '<div id="sucesso">Dados inseridos com sucesso</div>';
        }else{
            echo '<div id="erro">Problema</div>';
        }
    }else{
        $sql = mysql_query("INSERT INTO membros (id, nome,sexo,estadoCivil,dataNascimento,estadoNascimento,
        cidadeNascimento,nacionalidade,telefone,tel1,tel2,celular,email,skype,nomePai,nomeMae,
        conjuge,filhos,endereco,bairro,estado,cidade,cep,cpf,rg,data_emissao_rg,orgao_emissor_rg,
        titulo_eleitor,zona_eleitoral,sessao_eleitoral,tipo_sanguineo,cor,escolaridade,profissao,empresa,
        telempresa,admissao,dataAdmissao,evangelico,discipulo,aguas,es,dizimista,curso,obreiro,
        cargoEclesiastico,congregacao,funcao,data, senha, batismo,status)
        VALUES('$codigo','$nome_membro','$sexo','$estadoCivil','$dataNascimento','$estadoNascimento',
        '$cidadeNascimento','$nacionalidade','$tel','$tel1','$tel2','$celular','$email',
        '$skype','$nomePai','$nomeMae','$conjuge','$filhos','$endereco','$bairro','$estado',
        '$cidade','$cep','$cpf','$rg','$data_emissao_rg','$orgao_emissor_rg',
        '$titulo_eleitor','$zona_eleitoral','$sessao_eleitoral','$tipo_sanguineo','$cor',
        '$escolaridade','$profissao','$empresa','$telempresa','$admissao','$dataAdmissao','$evangelico','$discipulado',
        '$aguas','$es','$dizimista','$curso','$obreiro','$cargoEclesiastico','$congregacao','$funcao','$data', '$senha', '$batismo', '$status')") or die(mysql_error());
    }
