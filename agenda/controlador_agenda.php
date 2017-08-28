<?php
//Cadastro de user
function cadastrar($nome,$email,$telefone){
    //Pega o arquivo "contatos.json", decodifica e retorna todos os contatos
    $contatosAuxiliar = pegarContatos();
    //A variável $contato recebe os parâmetros enviados atraveś do formulário
    $contato = [
        'id'      => uniqid(),
        'nome'    => $nome,
        'email'   => $email,
        'telefone'=> $telefone
    ];
    //Array_push pega o $contato e coloca no final do $contatosAuxiliar, que é o arquivo "contatos.json" decodificado;
    array_push($contatosAuxiliar, $contato);
    //atualiza
    atualizarArquivo($contatosAuxiliar);
}

//Pega os contatos do JSON
function pegarContatos($valor_buscado = null){

    if ($valor_buscado == null){
        //Pegar arquivo "contatos.json"
        $contatosAuxiliar = file_get_contents('contatos.json');
        //decodificar o arquivo
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);
        //retornar o arquivo
        return $contatosAuxiliar;
    } else {
        return buscarContato($valor_buscado);
    }
}

//Exclui contatos
function excluirContato($id){
        //Invoca a função de pegar contatos
    $contatosAuxiliar = pegarContatos();
        //Para cada contatoAuxiliar, eu pego o dado do contato na posição que está e...
    foreach ($contatosAuxiliar as $posicao => $contato){
        //Se o id (['id']) do contato é igual o id que estou procurando...
        if($id == $contato['id']) {
        //excluir os dados do contato pelo id
            unset($contatosAuxiliar[$posicao]);
        }
    }

    atualizarArquivo($contatosAuxiliar);
}
//Edita os contatos
function editarContato($id){
        //Pego os contatos;
    $contatosAuxiliar = pegarContatos();
        //Para cada contatoAuxiliar como contato...
    foreach ($contatosAuxiliar as $contato){
        //Se e o id do contato é o mesmo que estou procurando
        if ($contato['id'] == $id){
        //retorna o contato com seus dados
            return $contato;
        }

    }
//Salva contato editado
function salvarContatoEditado($id , $nome, $email, $telefone){
        //Pega os contatos
    $contatosAuxiliar = pegarContatos();
        //Para cada contatoAuxiliar como a posição do array contato...
    foreach ($contatosAuxiliar as $posicao => $contato){
        //Se o id do contato é o id que estou procurando...
        if ($contato['id'] == $id){
        //pode editar os contatos
            $contatosAuxiliar[$posicao]['nome'] = $_POST['nome'];
            $contatosAuxiliar[$posicao]['email'] = $_POST['email'];
            $contatosAuxiliar[$posicao]['telefone'] = $_POST['telefone'];
            break;
        }
    }
        //Atualiza o arquivo
    atualizarArquivo($contatosAuxiliar);
}
//Atualiza os contatos
function atualizarArquivo($contatosAuxiliar){
        //Após ter cadastrado/editado/excluído o usuário, o arquivo "contatos.json" é codificado novamente;
    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
        //recebe todos os dados de usuário no arquivo "contatos.json", substituindo os dados que haviam anteriormente;
    file_put_contents('contatos.json', $contatosJson);
        //Redireciona para página inicial;
    header("Location: index.phtml");
}
//Busca contatos
function buscarContato($nome){
        //Pega os contatos
    $contatosAuxiliar = pegarContatos();

    $contatosEncontrados = [];

        //Para contato auxiiar como contato
    foreach ($contatosAuxiliar as $contato){
        //Se e o id do contato é o mesmo que estou procurand
        if ($contato['nome'] == $nome){
            //retorna os contatos
            $contatosEncontrados[] = $contato;
        }
    }

    return $contatosEncontrados;
    }
    //ROTAS
    if ($_GET['acao'] == 'cadastrar') {
        cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);
    }   elseif ($_GET['acao'] == 'excluir'){
        excluirContato($_GET['id']);
    }   elseif ($_GET['acao'] == 'editar') {
        salvarContatoEditado($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
    }   elseif ($_GET['acao'] = 'buscar'){
        buscarContato($_GET['nome']);}



