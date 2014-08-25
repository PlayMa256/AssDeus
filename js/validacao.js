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
            required: true, minlength: 2
        },
        sexo:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
        },
        estadoCivil:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true,
            minlength: 2
        },
        dataNascimento:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        estadoNascimento:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
        },
        cidadeNascimento:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
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
        skype:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        nomePai:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        nomeMae:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
        },
        conjuge:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
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
            required: true, minlength: 2
        },
        cidade:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
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
            required: true, minlength: 2
        },
        cor:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        escolaridade:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
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
        evangelico:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
        },
        discipulado:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        aguas:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        es:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        dizimista:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
        },
        curso:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        obreiro:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        cargoEclesiastico:{
            // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
            required: true, minlength: 2
        },
        congregacao:{
            // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
        },
        funcao:{
            // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
            required: true, minlength: 2
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

        nomePai: {required:"Preencha o nome do pai", minlength: "O nome tem que ter no minimo 2 caracteres"},//é select
        nomeMae: {required:"Preencha o nome da mãe", minlength: "O nome tem que ter no minimo 2 caracteres"},//é select
        conjuge: {required:"Preencha o nome do(a) conjuge", minlength: "O nome tem que ter no minimo 2 caracteres"},//é select
        // filhos: {required:"Preencha o nome do filho", minlength: "O nome tem que ter no minimo 2 caracteres"},//é select
        endereco:  {required:"Preencha o endereço", minlength: "O endereço tem que ter no minimo 2 caracteres"},
        bairro:  {required:"Preencha o bairro", minlength: "O bairro tem que ter no minimo 2 caracteres"},
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
        //evangelico: "Adicione um campo",//radio
        // discipulado: "Adicione um campo",//radio
        //aguas: "Adicione um campo",//radio
        //es: "Adicione um campo",//radio
        //dizimista: "Adicione um campo",//radio
        //curso: "Adicione um campo",//radio
        //obreiro: "Adicione um campo",//radio
        cargoEclesiastico: "Selecione o cargo Eclesiastico",
        congregacao: "Selecione a Congregação",
        funcao: "Selecione a função"
    }
});