<?php
include "../conf/config.php";
include "../function/format_data.php";
include_once "../function/upload-redimensionar.php";

$id=(int)$_POST['id'];
$codigo=trim($_POST['codigo']);
$nome=trim($_POST['nome']);
$sexo=trim($_POST['sexo']);
$estadoCivil=$_POST['EstadoCivil'];
$dataNascimento=trim($_POST['dataNascimento']);
$dataNascimento=format_data($dataNascimento);
$estadoNascimento=$_POST['estadoNascimento'];
$cidadeNascimento=$_POST['cidadeNascimento'];/*FK da tabela tb_cidades em que está a combinação UF/Cidade*/
$nacionalidade=trim($_POST['nacionalidade']);
$telefone=trim($_POST['tel']);
$tel1=trim($_POST['tel1']);
$tel2=trim($_POST['tel2']);
$celular=trim($_POST['celular']);
$email=trim($_POST['email']);
$skype=trim($_POST['skype']);
$nomePai=$_POST['nomePai'];
/*id da tabela membros*/
$nomeMae=$_POST['nomeMae'];/*id da tabela membros*/
$conjuge=$_POST['conjuge'];/*id da tabela membros*/
$filhos=$_POST['filhos'];/* 1=SIM, 0=NAO*/
$endereco=trim($_POST['endereco']);
$bairro=trim($_POST['bairro']);
$estado=trim($_POST['estado']);
$cidade=trim($_POST['cidade']);/*FK da tabela tb_cidades em que está a combinação UF/Cidade*/
$cep=trim($_POST['cep']);
$cpf=trim($_POST['cpf']);
$rg=trim($_POST['rg']);
$data_emissao_rg=trim($_POST['data_emissao_rg']);
$orgao_emissor_rg=trim($_POST['orgao_emissor_rg']);
$titulo_eleitor=trim($_POST['titulo_eleitor']);
$zona_eleitoral=trim($_POST['zona_eleitoral']);
$sessao_eleitoral=trim($_POST['sessao_eleitoral']);
$tipo_sanguineo=trim($_POST['tipo_sanguineo']);
$cor=trim($_POST['cor']);
$escolaridade=trim($_POST['escolaridade']);
$profissao=trim($_POST['profissao']);
$empresa=trim($_POST['empresa']);
$telempresa=trim($_POST['telempresa']);
$admissao=trim($_POST['admissao']);
$dataAdmissao=trim($_POST['dataAdmissao']);
$dataAdmissao=format_data($dataAdmissao);
$evangelico=$_POST['evangelico'];/* 1=sim, 0=nao*/
$discipulado=$_POST['discipulado'];/* 1=sim, 0=nao*/
$aguas=$_POST['aguas'];/* 1=SIM, 0=NAO*/
$es=$_POST['es'];/* 1=SIM, 0=NAO*/
$dizimista=$_POST['dizimista'];/* 1=SIM, 0=NAO*/
$curso=$_POST['curso'];/* 1=SIM, 0=NAO*/
$obreiro=$_POST['obreiro'];/* 1=SIM, 0=NAO*/
$cargoEclesiastico=$_POST['cargoEclesiastico'];/*FK da tabela cargos*/
$congregacao=$_POST['congregacao'];/*FK da tabela congregacao*/
$funcao=$_POST['funcao'];/*FK da tabela cargos*/
$data=date('Y-m-d');
$batismo=format_data($_POST['batismo']);
$senhaNova=md5($_POST['senhaNova']);
$status = (int)$_POST['status'];


$sucessos_query=0;
$sucesso_foto=0;
$sucessosenha=0;


$ve_senha = mysql_query("SELECT senha FROM membros WHERE id = '$id'") or die(mysql_error());
$ress_senha = mysql_fetch_array($ve_senha);
$senhaAntiga = $ress_senha['senha'];

if(!empty($senhaNova)){
    $senhaNova2 = md5(sha1($senhaNova));
    $update_senha = mysql_query("UPDATE membros SET senha='$senhaNova' WHERE id = '$id'");
}else{

}

if(!empty($_FILES['foto']['name'])){

    $foto=$_FILES['foto'];
    $nome=$_FILES['foto']['name'];
    $tmp=$_FILES['foto']['tmp_name'];
    $explode=explode(".", $nome);
    $ext=$explode[1];
    $nome_foto=md5(uniqid(rand(), true)).'.'.$ext;
    $pasta="../uploads/";
    $var = upload($tmp, $nome_foto, 110, $pasta, 147);

    if(!empty($var)){
        $selectFoto = mysql_query("SELECT foto FROM membros WHERE id = $id") or die(mysql_error());
        $resultado = mysql_fetch_array($selectFoto);
        $foto_nome = $resultado['foto'];
        unlink($pasta.$foto_nome);
        $qr=mysql_query("UPDATE membros SET foto='$var' WHERE id=$id");
        if($qr){
            echo '<div id="sucesso">Foto atualizada com sucesso</div>';
            $sucesso_foto = 1;
        }else{
            echo '<div id="erro">Problema ao atualizar foto</div>';

        }
    }else{
        echo '<div id="alert">Problema ao fazer upload da foto</div>';
    }

}
$update = mysql_query("UPDATE membros SET
            nome = '$nome',
            id = '$codigo',
            sexo = '$sexo',
            estadoCivil = '$estadoCivil',
            dataNascimento = '$dataNascimento',
            estadoNascimento = '$estadoNascimento',
            cidadeNascimento = '$cidadeNascimento',
            nacionalidade = '$nacionalidade',
            telefone = '$telefone',
            tel1 = '$tel1',
            tel2 = '$tel2',
            celular = '$celular',
            email = '$email',
            skype='$skype',
            nomePai='$nomePai',
            nomeMae='$nomeMae' ,
            conjuge='$conjuge' ,
            filhos='$filhos' ,
            endereco='$endereco' ,
            bairro='$bairro' ,
            estado='$estado'
            ,cidade='$cidade' ,
            cep='$cep' ,
            cpf='$cpf' , rg='$rg' ,
            data_emissao_rg='$data_emissao_rg' ,
            orgao_emissor_rg='$orgao_emissor_rg'
            , titulo_eleitor='$titulo_eleitor' ,
            zona_eleitoral='$zona_eleitoral' ,
            sessao_eleitoral='$sessao_eleitoral' ,
            tipo_sanguineo='$tipo_sanguineo' ,
            cor='$cor' ,
            escolaridade='$escolaridade' ,
            profissao='$profissao' ,
            empresa='$empresa' ,
            telempresa='$telempresa' ,
            admissao='$admissao' ,
            dataAdmissao='$dataAdmissao' ,
            evangelico='$evangelico'
            ,discipulo='$discipulado' ,
            aguas='$aguas' ,
            es='$es'
            ,dizimista='$dizimista'
            ,curso='$curso' ,
            obreiro='$obreiro' ,
             cargoEclesiastico='$cargoEclesiastico'
             ,congregacao='$congregacao'
             ,funcao='$funcao',
              batismo='$batismo',
              status = '$status'
              WHERE id = '$id'") or die(mysql_error());

if($update){
    echo '<div id="sucesso">Dados atualizados com sucesso</div>';
}else{
    echo '<div id="erro">Problema ao atualizar dados</div>';
}