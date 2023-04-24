<?php
// Utilização de namespaces
namespace Mysql {
    // Declaração de variáveis globais para conexão com o banco de dados
    define('DB_SERVER', 'localhost');
    define('DB_NAME', 'acesso');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');

    // Classe Mysql para interação com o banco de dados
    class mysql {
        var $db, $conn;

        // Método construtor para iniciar a conexão com o banco de dados
        public function __construct($server, $database, $username, $password) {
            // Inicia uma conexão com o banco de dados usando as credenciais fornecidas
            $this->conn = mysql_connect($server, $username, $password);
            // Seleciona o banco de dados a ser utilizado pela conexão
            $this->db = mysql_select_db($database, $this->conn);
        }

        /**
         * Função de seleção dos registros da tabela
         * @param string $tabela tabela onde será buscado os registros
         * @param string $colunas string contendo as colunas separadas por virgula para seleção, se null busca por todas *
         * @param string $where condição para filtragem dos resultados, se null não aplica condição de filtro
         * @return array com os registros selecionados da tabela
         */
        public function select($tabela, $colunas = "*", $where = "1=1") {
            // Monta a query de seleção de dados com as informações passadas por parâmetro
            $sql = "SELECT $colunas FROM $tabela $where";
            // Executa a query no banco de dados
            $result = $this->executar($sql);
            // Cria um array para armazenar os resultados selecionados
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $return[] = $row;
            }
            // Retorna o array com os resultados selecionados
            return $return;
        }

        /**
         * Função para inserir dados na tabela
         * @param string $tabela tabela que será inserido os dados
         * @param array $dados Array contendo os dados a serem inseridos
         * @return boolean verdadeiro ou falso indicando se a inserção foi bem sucedida
         */
        public function insert($tabela, $dados) {
            // Inicializa arrays vazios para armazenar as chaves e os valores a serem inseridos
            $keys = array();
            $insertvalues = array();

            // Itera sobre os dados a serem inseridos, armazenando as chaves e os valores em arrays separados
            foreach ($dados as $key => $value) {
                $keys[] = $key;
                $insertvalues[] = '\'' . $value . '\'';
            }

            // Junta as chaves e os valores em strings separadas por vírgula
            $keys = implode(',', $keys);
            $insertvalues = implode(',', $insertvalues);

            // Monta a query de inserção de dados com as informações passadas por parâmetro
            $sql = "INSERT INTO $tabela ($keys) VALUES ($insertvalues)";
            // Executa a query no banco de dados e retorna verdadeiro ou falso para indicar se a inserção foi bem sucedida
            return $this->executar($sql);
        }

        // Método privado para execut
