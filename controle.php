<?php
//utilização de namespaces
namespace controle; //define um namespace chamado "controle".
include 'processaAcesso.php'; //inclui o arquivo "processaAcesso.php" que contém a classe "ProcessaAcesso".
use processaAcesso as processaAcesso; //cria um alias para o namespace "processaAcesso".
$controle = new \processaAcesso\ProcessaAcesso; //instancia um objeto da classe "ProcessaAcesso" do namespace "processaAcesso".
if ($_POST['enviar']) { //verifica se o formulário de login foi submetido.
    $login = $_POST['login']; //obtém o valor do campo "login" do formulário de login.
    $senha = md5($_POST['senha']); //obtém o valor do campo "senha" do formulário de login e aplica uma função de hash MD5 nele.
    $usuario = $controle->verificaAcesso($login, $senha);
    //redirecionando para pagina conforme o tipo do usuário
    //chama o método "verificaAcesso" do objeto $controle para verificar o login e senha do usuário.
    if ($usuario[0]['id_tipo_acesso'] == 1) { //verifica se o tipo de acesso do usuário é igual a 1.
        header("Location:paginas/pagina1.html"); // redireciona o usuário para a página 1.
    } else if ($usuario[0]['id_tipo_acesso'] == 2) { //verifica se o tipo de acesso do usuário é igual a 2.
        header("Location:paginas/pagina2.html"); //redireciona o usuário para a página 2.
    }
} else if ($_POST['cadastrar']) { //verifica se o formulário de cadastro foi submetido.
    $login = $_POST['login']; // obtém o valor do campo "login" do formulário de cadastro.
    $senha = md5($_POST['senha']); //obtém o valor do campo "senha" do formulário de cadastro e aplica uma função de hash MD5 nele.
    $tipo_usuario = $_POST['tipo_usuario']; //obtém o valor do campo "tipo_usuario" do formulário de cadastro.
    $arr = array('login_usuario' => $login, 'senha_usuario' => $senha,
'id_tipo_acesso' => $tipo_usuario); //cria um array com os valores do login, senha e tipo de usuário.
    if (!$controle->cadastraUsuario($arr)) { //verifica se houve algum erro ao cadastrar o usuário.
        echo 'Aconteceu algum erro'; //exibe uma mensagem de erro.
    } else { // caso não haja erro ao cadastrar o usuário.
        $tipo_acesso = $controle->verificaAcesso($login, $senha); //verifica o acesso do usuário recém-cadastrado.
        if ($tipo_acesso[0]['id_tipo_acesso'] == 1) { //verifica se o tipo de acesso do usuário é igual a 1.
            header("Location:paginas/pagina1.html"); //redireciona o usuário para a página 1.
        } else if ($tipo_acesso[0]['id_tipo_acesso'] == 2) {
            header("Location:paginas/pagina2.html"); //verifica se o tipo de acesso do usuário é igual a 2.
        }
    }
}
?>