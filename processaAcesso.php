<?php
//utilização de namespaces
namespace processaAcesso {
    // inclui o arquivo mysql.php que contém a classe Mysql
    include 'conexao/mysql.php';
    // utiliza o namespace Mysql
    use Mysql as Mysql;
    // define a classe ProcessaAcesso
    class ProcessaAcesso {        
        // declara uma variável para armazenar a conexão com o banco de dados
        var $db;
        // construtor da classe
        public function __construct() {
            // instancia a classe Mysql passando as informações de conexão como parâmetro
            $conexao = new Mysql\mysql(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
            // atribui a conexão à variável $db
            $this->db = $conexao;
        }
        // método para verificar o acesso do usuário
        public function verificaAcesso($login, $senha) {            
            // realiza uma consulta na tabela "tb_usuario" buscando pelo login e senha informados
            $select = $this->db->select('tb_usuario', '*', " where login_usuario = '$login' and senha_usuario = '$senha'");
            // retorna o resultado da consulta
            return $select;
        }        
        // método para cadastrar um novo usuário
        public function cadastraUsuario($dados){            
            // insere os dados do usuário na tabela "tb_usuario"
            $insert = $this->db->insert('tb_usuario', $dados);
            // retorna o resultado da operação de inserção
            return $insert;
        }
    }
}
?>
