DROP DATABASE IF EXISTS boletimRebeliao;
CREATE DATABASE boletimRebeliao;
USE boletimRebeliao;

CREATE TABLE permissoes (
    classe VARCHAR(25) PRIMARY KEY,
    Acessar_Ficha_do_Aluno BOOLEAN DEFAULT 0,
    Gestar_Informacoes_do_Aluno BOOLEAN DEFAULT 0,
    Acessar_Login_aluno BOOLEAN DEFAULT 0,
    Gestar_Login_aluno BOOLEAN DEFAULT 0,
    Acessar_Boletim BOOLEAN DEFAULT 0,
    
    Gestar_Boletim BOOLEAN DEFAULT 0,
    Enturmar_Aluno BOOLEAN DEFAULT 0,
    Acessar_Ficha_do_Professor BOOLEAN DEFAULT 0,
    Gestar_Informacoes_do_Professor BOOLEAN DEFAULT 0,
    Acessar_Login_professor BOOLEAN DEFAULT 0,
    
    Gestar_Login_professor BOOLEAN DEFAULT 0,
    Acessar_Ficha_da_Turma BOOLEAN DEFAULT 0,
    Gestar_Informacoes_da_Turma BOOLEAN DEFAULT 0,
    Criar_Horario BOOLEAN DEFAULT 0
);

CREATE TABLE conta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) UNIQUE,
    senha VARCHAR(32),
    nome VARCHAR(50),
    sobrenome VARCHAR(50),
    genero VARCHAR(1),
    tipo_conta INT NOT NULL,
    ativa BOOLEAN DEFAULT 1
);

CREATE TABLE redefinirSenha (
    id INT PRIMARY KEY AUTO_INCREMENT,
    emailConta VARCHAR(50),
    chave VARCHAR(48) UNIQUE,
    validade DATETIME,
    FOREIGN KEY (emailConta)
        REFERENCES conta (email)
        ON DELETE CASCADE
);

CREATE TABLE sessao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idConta INT,
    chave VARCHAR(48) UNIQUE,
    hora DATETIME,
    FOREIGN KEY (idConta)
        REFERENCES conta (id)
        ON DELETE CASCADE
);

CREATE TABLE registro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idConta INT,
    statement VARCHAR(100),
    parameters VARCHAR(200),
    hora DATETIME
);

CREATE TABLE aluno (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idConta INT,
    idTurmaBobo INT(4),
    anoTurmaBobo INT(4),
    codigo_aluno VARCHAR(11) UNIQUE,
    matricula VARCHAR(20),
    email_pessoal VARCHAR(30),
    data_da_matricula DATE,
    data_da_saida DATE,
    data_do_nascimento DATE,
    nacionalidade VARCHAR(30),
    naturalidade VARCHAR(30),
    cep VARCHAR(10),
    logradouro VARCHAR(50),
    bairro VARCHAR(50),
    cidade VARCHAR(30),
    estado VARCHAR(2),
    residencial VARCHAR(20),
    celular VARCHAR(20),
    rg VARCHAR(14),
    cpf VARCHAR(11),
    deficiencia TINYTEXT,
    beneficio_social TINYTEXT,
    observacoes TINYTEXT,
    nome_rl1 VARCHAR(30),
    nome_rl2 VARCHAR(30),
    celular_rl1 VARCHAR(20),
    celular_rl2 VARCHAR(20),
    email_rl1 VARCHAR(30),
    email_rl2 VARCHAR(30),
    FOREIGN KEY (idConta)
        REFERENCES conta (id)
        ON DELETE CASCADE
);
/*rl = responsavel legal*/
CREATE TABLE professor (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idConta INT,
    codigo_professor INT(9) UNIQUE,
    matricula_ativa BOOLEAN DEFAULT 1,
    FOREIGN KEY (idConta)
        REFERENCES conta (id)
        ON DELETE CASCADE
);

CREATE TABLE gestao_interna (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idConta INT,
    classe_permissoes VARCHAR(25),
    FOREIGN KEY (idConta)
        REFERENCES conta (id)
        ON DELETE CASCADE,
    FOREIGN KEY (classe_permissoes)
        REFERENCES permissoes (classe)
        ON DELETE SET NULL ON UPDATE SET NULL
);

/* TRIGGER que envia a conta para a sua respectiva tabela */
DELIMITER $
CREATE TRIGGER tTipo_conta AFTER INSERT ON conta
    FOR EACH ROW BEGIN
        IF (NEW.tipo_conta = 1) THEN
            INSERT INTO aluno(idConta)
            VALUES (NEW.id);
        END IF;
        
        IF (NEW.tipo_conta = 2) THEN
            INSERT INTO professor(idConta)
            VALUES (NEW.id);
        END IF;
        
        IF (NEW.tipo_conta = 3) THEN
            INSERT INTO gestao_interna(idConta)
            VALUES (NEW.id);
        END IF;
    END $
DELIMITER ;

CREATE TABLE etapa (
    id_etapa INT PRIMARY KEY,
    disc_etapa VARCHAR(15)
);

CREATE TABLE ano (
    id_ano INT(4) PRIMARY KEY AUTO_INCREMENT,
    ano_ativo BOOLEAN
)  AUTO_INCREMENT=2021;
/* A criação de um ano letivo se dará através de um inserção de 1 na coluna ano_ativo, criando na coluna id_ano, o próximo 
ano letivo; Partindo de 1930, para a plena inserção de alunos anteriores à informatização do ISERJ*/ 

CREATE TABLE serie (
    id_serie INT PRIMARY KEY,
    disc_serie VARCHAR(15)
);

CREATE TABLE turno (
    id_turno INT PRIMARY KEY,
    disc_turno VARCHAR(20)
);

CREATE TABLE curso (
    id_curso INT PRIMARY KEY,
    disc_curso VARCHAR(20)
);

/* SOBRE AS TABELAS CURSO, TURNO, SERIE, ETAPA
IMPORTANTE. Para o bom funcionamento, o grupo como um todo, optou pela pré-definição dos valores que serão utilizados em outra 
tabelas( as FK ), tal as tabelas curso, turno, série, etapa
 */

CREATE TABLE turma (
    idsis INT PRIMARY KEY AUTO_INCREMENT,
    id INT(4) NOT NULL,
    ano INT(4) NOT NULL,
    serie INT(1),
    turno INT(1),
    curso INT(1),
    UNIQUE KEY turma_ano (id , ano),
    FOREIGN KEY (ano)
        REFERENCES ano (id_ano)
        ON DELETE CASCADE,
    FOREIGN KEY (serie)
        REFERENCES serie (id_serie)
        ON DELETE CASCADE,
    FOREIGN KEY (turno)
        REFERENCES turno (id_turno)
        ON DELETE CASCADE,
    FOREIGN KEY (curso)
        REFERENCES curso (id_curso)
        ON DELETE CASCADE
);
/* Cada turma é determinada pela seu ANO e seu ID( exemplo: 1304-2021, ID = 1304 e ANO = 2021 ), e será criada pelo Secretário*/

CREATE TABLE disciplina (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30)
);

CREATE TABLE tempo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    horario TIME
);

CREATE TABLE grade_horaria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idTurma INT(4) NOT NULL,
    idDisciplina INT NOT NULL,
    dia_semana VARCHAR(3) NOT NULL,
    idTempo INT NOT NULL,
    idProfessor INT,
    sala VARCHAR(20),
    UNIQUE KEY (idTurma, idTempo, dia_semana),
    FOREIGN KEY (idTurma)
        REFERENCES turma(idsis)
        ON DELETE CASCADE,
    FOREIGN KEY (idTempo)
        REFERENCES tempo (id)
        ON DELETE CASCADE,
    FOREIGN KEY (idProfessor)
        REFERENCES professor(id)
        ON DELETE CASCADE,
    FOREIGN KEY (idDisciplina)
        REFERENCES disciplina(id)
        ON DELETE CASCADE
);

/* Tabela direcionada exclusivamente para o NEPEM. 
Especificação de cada coluna:
Turno - Separado em turnos da manhã, tarde, contra-turno da manhã, contra-turno da tarde, e sábado
Tempo - Separada em 6 tempos e um intervalo, para cada turno
Id, ano, prof, disci(disciplina), sala e dia_semana são auto-explicativos
*/

CREATE TABLE rProfessorDisciplina (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idProfessor INT,
    idDisciplina INT,
    FOREIGN KEY (idProfessor)
        REFERENCES professor(id)
        ON DELETE CASCADE,
    FOREIGN KEY (idDisciplina)
        REFERENCES disciplina(id)
        ON DELETE CASCADE
);
/* relação que determiana qual(is) matérias tal professor leciona  */
    
CREATE TABLE rAlunoTurma (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idAluno INT NOT NULL,
    idTurma INT NOT NULL,
    UNIQUE KEY TAC(idTurma, idAluno),
    FOREIGN KEY (idAluno)
        REFERENCES aluno(id)
        ON DELETE CASCADE,
    FOREIGN KEY (idTurma)
        REFERENCES turma(idsis)
        ON DELETE CASCADE
);
/* tabela para a enturmação do aluno, que será feita pelo Secretário */
/* tabela que determina o número da chamada daquela aluno, naquela turma */

CREATE TABLE nota(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idAluno INT NOT NULL,
    idTurma INT NOT NULL,
    idDisciplina INT NOT NULL,
    etapa INT(1) NOT NULL,
    idProfessor INT,
    nota DOUBLE(3,1),
    UNIQUE KEY (idAluno, idTurma, idDisciplina, etapa),
    FOREIGN KEY (idAluno)
        REFERENCES aluno(id)
        ON DELETE CASCADE,
    FOREIGN KEY (idTurma)
        REFERENCES turma(idsis)
        ON DELETE CASCADE,
    FOREIGN KEY (idProfessor)
        REFERENCES professor(id)
        ON DELETE CASCADE,
    FOREIGN KEY (idDisciplina)
        REFERENCES disciplina(id)
        ON DELETE CASCADE
);

CREATE TABLE falta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idAluno INT NOT NULL,
    idTurma INT NOT NULL,
    idDisciplina INT NOT NULL,
    etapa INT(1) NOT NULL,
    falta BOOLEAN NOT NULL,
    data_f DATE DEFAULT NULL,
    idProfessor INT,
    UNIQUE KEY (idAluno, idTurma, idDisciplina, etapa),
    FOREIGN KEY (idAluno)
        REFERENCES aluno(id)
        ON DELETE CASCADE,
    FOREIGN KEY (etapa)
        REFERENCES etapa(id_etapa)
        ON DELETE CASCADE,
    FOREIGN KEY (idTurma)
        REFERENCES turma(idsis)
        ON DELETE CASCADE,
    FOREIGN KEY (idProfessor)
        REFERENCES professor(id)
        ON DELETE CASCADE,
    FOREIGN KEY (idDisciplina)
        REFERENCES disciplina(id)
        ON DELETE CASCADE
);

/* Tabela FALTA e NOTA auto-explicativas, esta relaciona a etapa, a nota, o aluno que recebeu a nota na determinada
turma de tal ano, o professor que aplicou a nota e a disciplina. 
Aquela relaciona a etapa da falta, a data da falta, o aluno que recebeu, o aluno que recebeu a falta na determinada
turma de tal ano, o professor que aplicou e em qual disciplina
se ele faltou ou não, */

 

