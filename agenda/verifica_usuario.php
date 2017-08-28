<?php


       session_start();
       //caso a variavel nao existe, ela cria, carrega
    function login( ){
            $login = $_POST['login']; //pegando post
            $senha = $_POST['senha'];

            $usuario_existe = false;


            $usuarios = file_get_contents('usuarios.json');
            //lendo os dados de um arquivo json
            $usuarios = json_decode($usuarios, true);
            //para usar o jason tem que codificar, o true siginifca que preciso codificar em codigo, caso contrario vai ler como objeto. ARRAY

            foreach ($usuarios as $usuario){
                // percorrer sem se preocupar com o tamanho
                if ($login == $usuario['login'] && $senha == $usuario['senha']) {

                    $usuario_existe = true;
                    //deu certo;
                    $_SESSION['usuario_nome']   = $_POST['nome'];
                    $_SESSION['usuario_login']  = $login;
                    $_SESSION['usuario_senha']  = $senha;
                    $_SESSION['usuario_online'] = true;
                    header('Location: index.phtml');
                    //redirecionar um usuario

                }

            }
            if($usuario_existe == false ){
                header('Location: _index.php');

            }
        }

        function logout( ){
            session_destroy();
            header("Location: login.php");
        }

    //Rotas
    if($_GET['acao'] == 'login'){
            login();
        }
    if($_GET['acao'] == 'sair'){
            logout();
        }