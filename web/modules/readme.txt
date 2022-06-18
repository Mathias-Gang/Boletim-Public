1 Módulos principais

    1.1 modules/database/conexao.php

        1.1.1 Função conexao()
            conexao(): object

            Retorna um objeto MySQLI, que possibilita o acesso à database

            É preciso especificar no arquivo qual database será usada (servidor/local)

    1.2 modules/database/query.php

        1.2.1 Classe Query

            class Query {
                string $statement;
                array $param;
                boolean $log;
                
                public log()
                public execute(): mysqli_result|null
                public __construct($statement, $param, $log = false): mysqli_result|null
            }
            
        1.2.2 Função Query::__construct | Objeto new Query

            public Query::__construct($statement, $param, $log = false)
            Constrói um objeto com todos os parâmetros necessários para fazer uma query

            statement
                É a query a ser preparada ex: $statement = "SELECT id FROM conta WHERE id = ?"

            param
                É um array com os parâmetros da pesquisa ex: $param = array("i", 7)

            log
                default = false, se especificado true, serão registrados query, parâmetros, horário e usuário que realizou a query na database

            EXEMPLO #1

            $statement = "SELECT * FROM conta WHERE ID = ?";
            $param = array("i", 4);
            $query = new Query::execute($statement, $param);

        1.2.3 Função Query::execute()

            public Query::execute(): mysqli_result|null
            Essa função realiza uma query contra o banco de dados com os atributos providenciados

            Valores Retornados
            Retorna um objeto mysqli_result se a pesquisa for um SELECT

            EXEMPLO #1

            $statement = "SELECT * FROM conta WHERE ID = ?";
            $param = array("i", 4);
            $query = new Query::execute($statement, $param);
            $queryResult = $query->execute();
            $row = $queryResult->fetch_assoc();
            echo $row["nome"];
            // aluno3 //

        1.2.4 Função Query::log()

            public function log()
            Se $log = true, ao executar a função execute(), essa função será chamada também. Essa função registra, numa tabela de auditoria:
            -O usuário que realizou a query (pelo esquema de sessões)
            -O statement
            -Os parâmetros
            -O horário que a query foi realizada
            
