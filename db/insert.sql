/*insert into tipo_conta(id_tipo,disc_tipo) values 
(1,"aluno"),(2,"professor"),(3,"secretário"),(4,"administrador");*/

insert into conta(email,nome,senha,tipo_conta) values
("aluno@iserj.edu.br","aluno",md5("aluno"),1),
("aluno1@iserj.edu.br","aluno1",md5("aluno1"),1),
("aluno2@iserj.edu.br","aluno2",md5("aluno2"),1),
("aluno3@iserj.edu.br","aluno3",md5("aluno3"),1),
("aluno4@iserj.edu.br","aluno4",md5("aluno4"),1),
("aluno5@iserj.edu.br","aluno5",md5("aluno5"),1),
("aluno6@iserj.edu.br","aluno6",md5("aluno6"),1),
("aluno7@iserj.edu.br","aluno7",md5("aluno7"),1),
("aluno8@iserj.edu.br","aluno8",md5("aluno8"),1),
("aluno9@iserj.edu.br","aluno9",md5("aluno9"),1),
("aluno10@iserj.edu.br","aluno10",md5("aluno10"),1),
("aluno11@iserj.edu.br","aluno11",md5("aluno11"),1),
("aluno12@iserj.edu.br","aluno12",md5("aluno12"),1),

("professor@iserj.edu.br","professor",md5("professor"),2),
("professor1@iserj.edu.br","professor1",md5("professor1"),2),
("professor2@iserj.edu.br","professor2",md5("professor2"),2),
("professor3@iserj.edu.br","professor3",md5("professor3"),2),

("gianpmaule@gmail.com","gian",md5("gian"),3),
("cury.duda@gmail.com","eduardo",md5("eduardo"),3),
("gabriel","gabriel",md5("gabriel"),3),
("guilhermearaujo186@gmail.com","guilherme",md5("guilherme"),3),
("miguel","miguel",md5("miguel"),3),
("jose","",md5("jose"),3),
("matheus","matheus",md5("matheus"),3),
("flaviomendonca.labmm@iserj.edu.br","Flávio",md5("flavio"),3),
("sancreyalves.medio@iserj.edu.br","Sancrey",md5("sancrey"),3);

insert into conta
(email, nome, senha, genero, tipo_conta)
values
("alunoteste@iserj.edu.br","alunoteste",md5("alunoteste"), "m", 1);
update aluno
left join conta on conta.id = aluno.idConta
    set aluno.codigo_aluno = "A-151203898",
        aluno.matricula = "4581782",
        aluno.email_pessoal = "alunopessoal@gmail.com",
        aluno.data_da_matricula = "2019-08-11",
        aluno.data_do_nascimento = "2003-04-28",
        aluno.nacionalidade = "BR",
        aluno.naturalidade = "Nova Iguaçu",
        aluno.cep = "65900130",
        aluno.logradouro = "Rua São Domingos",
        aluno.bairro = "Centro",
        aluno.cidade = "Imperatriz",
        aluno.estado = "MA",
        aluno.residencial = "2185554920",
        aluno.celular = "21990345115",
        aluno.rg = "368461348",
        aluno.cpf = "02938817070",
        aluno.nome_rl1 = "Maria Joaquina da Silva",
        aluno.nome_rl2 = "Lucas Marcos de Oliveira",
        aluno.celular_rl1 = "21984929303",
        aluno.celular_rl2 = "21974830293",
        aluno.email_rl1 = "mariajoaquinass@gmail.com",
        aluno.email_rl2 = "lucasoliveira@outlook.com"
    where conta.email = "alunoteste@iserj.edu.br";
insert into etapa(id_etapa,disc_etapa) values 
(1,"1º trimestre"),(2,"2º trimestre"),(3,"3º trimestre");

insert into ano(id_ano, ano_ativo) values 
(2021,1);

insert into serie(id_serie,disc_serie) values 
(1,"1ª série"),(2,"2ª série"),(3,"3ª série");

insert into turno(id_turno,disc_turno) values 
(1,"manhã"),(2,"tarde");

insert into curso(id_curso,disc_curso) values 
(2,"informática"),(3,"administração"),(1,"formação geral");

insert into disciplina(nome) values 
("Língua Portuguesa"),("Literatura Brasileira"),("Língua Estrangeira"),
("Matemática"),("Física"),("Química"),
("Biologia"),("Geografia"),("História"),
("Sociologia"),("Filosofia"),("Artes"),
("Produção de Texto"),("Psicologia"),("Língua Estrangeira"),
("IAI"),("Psicologia"),

("Informática Aplicada"),("OST"),

("LTP 1"),("MD 1"),("Raciocínio Lógico"),
("Arquitetura de Computadores"),("Redes"),("MD 2"),
("WEB 1"),("LTP 2"),("FDPV"),
("MD 3"),("WEB 2"),("LTP 3"),("Projeto Final"),

("Fundamentos Administração"),("Eventos"),("Estatística"),
("Contabilidade 1"),("Ambiental"),("Administração Org"),
("Administração Mercado"),("Matemática/Produção"),("Economia"),
("D. Empresarial"),("Contabilidade 2"),
("Qual/Log"),("Pessoas"),("D. Trabalho"),
("Administração Financeira"),
("TCC");

insert into turma(id,ano,serie,curso) values
(1101,2021,1,1),(1102,2021,1,1),(1103,2021,1,2),(1104,2021,1,2),(1105,2021,1,3),(1106,2021,1,3),
(1107,2021,1,1),(1108,2021,1,1),(1109,2021,1,2),(1110,2021,1,2),(1111,2021,1,3),(1112,2021,1,3),
(1201,2021,2,1),(1202,2021,2,1),(1203,2021,2,2),(1204,2021,2,2),(1205,2021,2,3),(1206,2021,2,3),
(1207,2021,2,1),(1208,2021,2,1),(1209,2021,2,2),(1210,2021,2,2),(1211,2021,2,3),(1212,2021,2,3),
(1301,2021,3,1),(1302,2021,3,1),(1303,2021,3,2),(1304,2021,3,2),(1305,2021,3,3),(1306,2021,3,3),
(1307,2021,3,1),(1308,2021,3,1),(1309,2021,3,2),(1310,2021,3,2),(1311,2021,3,3),(1312,2021,3,3);

/*insert into rProfessorTurmaDisciplina(idProfessor, idTurma, anoTurma, idDisciplina) values
(1,1101,2021,1),(1,1201,2021,1),(1,1104,2021,1),(1,1105,2021,1),
(1,1204,2021,1),(1,1205,2021,1),
(1,1102,2021,2),(1,1104,2021,2),(1,1105,2021,2),(1,1206,2021,2),
(1,1202,2021,2),(1,1203,2021,2),(1,1304,2021,2);*/

/*insert into rAlunoTurma(idAluno,idTurma,anoTurma) values
(1,1101,2021),(2,1101,2021),(3,1101,2021),(4,1102,2021),(5,1102,2021),
(6,1103,2021),(7,1204,2021),(8,1204,2021),(9,1306,2021),(10,1306,2021);*/

INSERT INTO permissoes(
	classe, 
	Acessar_Ficha_do_Aluno,
    Gestar_Informacoes_do_Aluno,
    Acessar_Login_aluno,
    Gestar_Login_aluno,
    Acessar_Boletim,
    Gestar_Boletim,
    Enturmar_Aluno,
    Acessar_Ficha_do_Professor,
    Gestar_Informacoes_do_Professor,
    Acessar_Login_professor,
    Gestar_Login_professor,
    Acessar_Ficha_da_Turma,
    Gestar_Informacoes_da_Turma,
    Criar_Horario)
VALUES ("admin",1,1,1,1,1,1,1,1,1,1,1,1,1,1);

UPDATE gestao_interna
SET classe_permissoes = "admin"
WHERE id IN (1,2,3,4,5,6,7,8,9);


insert into tempo (horario) values (070000), (075000), (084000), (093000), (102000), (104000), (113000), (130000), (135000), (145000), (153000),
 (162000), (164000), (173000);


INSERT INTO
	grade_horaria (idturma, iddisciplina, dia_semana, idtempo, idprofessor, sala) 
VALUES
	(1, 1, "SEG", 1, 2, "29"),
	(1, 1, "SEG", 2, 1, "245"),
	(1, 1, "SEG", 3, 1, "245"),
	(1, 1, "SEG", 4, 2, "614-A"),
	(1, 1, "INT", 5, 3, "69-B"),
	(1, 1, "SEG", 6, 4, "245"),
	(1, 1, "SEG", 7, 1, "2475"),
	(1, 1, "SEG", 8, 2, "442"),
	(1, 1, "SEG", 9, 3, "87"),
	(1, 1, "INT", 10, 3, "7"),
	(1, 1, "SEG", 11, 3, "86"),
	(1, 1, "SEG", 12, 4, "42");

INSERT INTO rProfessorDisciplina(idprofessor, iddisciplina) values (2,1), (2,2), (1,1);
insert into rAlunoTurma(idaluno, idturma) values (1, 1), (2, 1), (3, 1), (4, 1), (5, 1), (6, 2), (7, 2), (8, 2), (9, 2), (10, 2);
insert into nota(idaluno, idturma, iddisciplina, etapa, idprofessor, nota) values 
(1, 1, 1, 1, 1, 4.5),		
(1, 1, 1, 2, 1, 5.54),
(1, 1, 1, 3, 1, 10);
insert into falta(idaluno, idturma, iddisciplina, etapa, idprofessor, falta, data_f) values
(1, 1, 1, 1, 1, 1, 20211106),
(1, 1, 1, 2, 1, 1, 20211207),	
(1, 1, 1, 3, 1, 0, 20211208);		