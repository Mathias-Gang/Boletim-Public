<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php include_once("modules/session/tabInfo.php");?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script src="js/verificar.js"></script>
        <script src="js/secretario_filtros.js"></script>
        <link rel="stylesheet" href="css/gi.css">
        <link rel="stylesheet" href="css/gi_filtros.css">
    </head>

    <body>
        <?php include_once("modules/divisions/gi_header.php"); ?>
        <div class="corpo">
            <div class="gi_filtros_hub">
                <div class="gi_filtros_tipos">
                    <button id="butt_aluno" class="butt">Aluno</button>
                    <button id="butt_prof" class="butt">Professor</button>
                    <button id="butt_turma" class="butt">Turma</button>
                </div>
                <div class="formulario">
                    <form method="GET" action="" id="form_aluno">
                        <div style="display: grid; grid-template-columns: 50% 25% 25%; grid-column: span 4; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Nome</label>
                                <input name="nomeAluno" class="texto" type="text" placeholder="Nome">
                            </div>
                            <div class="opcao" style="display: grid; grid-template-columns: 48% 48%; justify-content: space-between;">
                                <div>
                                    <label>Turma</label>
                                    <input name="turmaAluno" class="texto" id="turma" placeholder="Turma">
                                </div>
                                <div>
                                    <label>do ano</label>
                                    <input name="anoTurmaAluno" class="texto" id="ano" placeholder="ano">
                                </div>
                            </div>                      
                            <div class="opcao">
                                <label>Código de Aluno ISERJ</label>
                                <input name="" class="texto" id="aiserj" placeholder="Código de Aluno ISERJ ">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 50% 50%; grid-row: span 2; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao"  style="grid-column: span 2;" >
                                <label>Número de Matrícula</label>
                                <input name="matriculaAluno" class="texto" id="matricula" placeholder="Número de Matrícula">
                            </div>
                            <div class="opcao">
                                <label>Data de Matrícula</label>
                                <input name="data_da_matriculaAluno" class="texto" type="date" id="data" placeholder="Data de Matrícula">
                            </div>
                            <div class="opcao">
                                <label>Data de Saída</label>
                                <input name="data_da_saidaAluno" class="texto" type="date" id="data" placeholder="Data de Saída">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 25% 25% 25% 25%; grid-column: span 2; grid-row: span 2;padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao" style="grid-column: span 3;">
                                <label>CPF</label>
                                <input name="CPFAluno" class="texto" id="cpf" inputmode="numeric" placeholder="CPF" >
                            </div>
                            <div class="opcao">
                                <label>Gênero</label>
                                <select name="generoAluno" class="texto" style="height: 35px;" name="">
                                    <option value="2">Todos</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Feminino</option>
                                    <option value="i">Indefinido</option>
                                </select>
                            </div>
                            <div class="opcao" style="grid-column: span 2;">
                                <label>Nacionalidade</label>
                                <input name="nacionalidadeAluno" class="texto" type="text"  placeholder="Nacionalidade">
                            </div>
                            <div class="opcao" style="grid-column: span 2;">
                                <label>Naturalidade</label>
                                <input name="naturalidadeAluno" class="texto" type="text"placeholder="Naturalidade">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 50% 50%; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Nome de Filiação</label>
                                <input name="responsavel_legal1Aluno" class="texto" type="text" placeholder="Nome de Filiação">
                            </div>
                            <div class="opcao">
                                <label>Endereço</label>
                                <input name="" class="texto" type="text" placeholder="Endereço">
                            </div>
                        </div>  
                        <div style="display: grid; grid-template-columns: 50% 50%; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Email Pessoal</label>
                                <input name="emailAluno" class="texto" type="email" placeholder="Email Pessoal">
                            </div>
                            <div class="opcao">
                                <label>Telefone</label>
                                <input name="celularAluno" class="texto" id="celular" inputmode="numeric" placeholder="Telefone">
                            </div>
                        </div>
                        <div style="grid-column: span 4; display: grid; grid-template-columns: auto auto auto; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Portador de Necessidades</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex; justify-content: flex-start; flex-direction: row; align-items: center; width:35%; font-size: 10px;">
                                        NÃO<input name="deficiencia_terAluno" type="range" min="1" max="3" value="">SIM</div>
                                    <select name="" class="texto" style="height: 35px; width:65%;">
                                        <option value="todos">Todos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="opcao">
                                <label>Benefício Social</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex; justify-content: flex-start; flex-direction: row ; align-items: center; font-size: 10px;">
                                        NÃO<input name="beneficios_sociaisAluno" type="range" min="1" max="3" value="2">SIM</div>
                                    <select name="" class="texto" style="height: 35px; width:65%;">
                                        <option value="todos">Todos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="opcao">
                                <label>Observação</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex; justify-content: flex-start; flex-direction: row ; align-items: center; width:35%; font-size: 10px;">
                                        NÃO<input name="" type="range" min="1" max="3" value="2">SIM</div>
                                    <select name="" class="texto" style="height: 35px; width:65%;">
                                        <option value="todos">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;text-align: center; width: 10%;">
                            <input type="reset" class="login" style="height: 30px; width: 115px; font-size: 10p; background: grey;" value="Limpar Filtros">
                        </div>
                        <div>
                            <input type="submit" value="Pesquisar" class="login" style="height: 30px; width: 115px; font-size: 10p; background: white;">
                        </div> 
                    </form>
                    <form method="GET" action="" id="form_prof">
                        <div style="display: grid; grid-template-columns: 50% 25% 25%; grid-column: span 4; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao" >
                                <label>Nome</label>
                                <input class="texto" type="text" name="nomeProfessor" placeholder="Nome">
                            </div>
                            <div class="opcao" style="display: grid; grid-template-columns: 48% 48%; justify-content: space-between;">
                                <div>
                                    <label>Turma</label>
                                    <input class="texto" id="turma" name="" placeholder="Turma">
                                </div>
                                <div>
                                    <label>do ano</label>
                                    <input class="texto" id="ano" name=""   placeholder="ano">
                                </div>
                            </div>
                            <div class="opcao">
                                <label>Código de Professor ISERJ</label>
                                <input class="texto" id="piserj" name="" placeholder="Código de Professor ISERJ">
                            </div>
                        </div>                  
                        <div style="display: grid; grid-template-columns: 50% 50%; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Data de Inserção</label>
                                <input class="texto" type="date" id="data" name="" placeholder="Data    de Matrícula">
                            </div>
                            <div class="opcao">
                                <label>Data de Saída</label>
                                <input class="texto" type="date" id="data" name="" placeholder="Data    de Saída">
                            </div>
                        </div>              
                        <div style="display: grid; grid-template-columns: 50% 50%; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Email Pessoal</label>
                                <input class="texto" type="email" name="emailProfessor" placeholder="Email Pessoal">
                            </div>
                            <div class="opcao">
                                <label>Telefone</label>
                                <input class="texto" id="celular" inputmode="numeric" name="" placeholder="Telefone">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: auto; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Gênero</label>
                                <select class="texto" style="height: 35px;" name="">
                                    <option value="todos">Todos</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                    <option value="indefinido">Indefinido</option>
                                </select>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: auto; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao" style="background-color: darkslateblue;">
                                <label>Observação</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex; justify-content: flex-start; flex-direction: row ; align-items: center; width:35%; font-size: 10px;">
                                        NÃO<input type="range" min="1" max="3" value="2">SIM
                                    </div>
                                    <select class="texto" style="height: 35px; width:65%;" name="">
                                        <option value="todos">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;text-align: center; width: 10%;">
                            <input type="reset" class="login" style="height: 30px; width: 115px; font-size: 10p; background: grey;" value="Limpar Filtros">
                        </div>
                        <div>
                            <input type="submit" value="Pesquisar" class="login" style="height: 30px; width: 115px; font-size: 10p; background: white;">
                        </div> 
                    </form>
                    <form method="GET" action="" id="form_turma">
                        <div style="display: grid; grid-template-columns: auto; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">  
                            <div class="opcao" style="display: grid; grid-template-columns: 48% 48%; justify-content: space-between;">
                                <div>
                                    <label>Turma</label>
                                    <input class="texto" id="turma" name="turma" placeholder="Turma">
                                </div>
                                <div>
                                    <label>do ano</label>
                                    <input class="texto" id="ano" name="anoTurma" placeholder="ano">
                                </div>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: auto; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao">
                                <label>Curso</label>
                                <select class="texto" style="height: 35px;" name="">
                                    <option value="0">Todos</option>
                                    <option value="1">Formação Geral</option>
                                    <option value="2">Informática</option>
                                    <option value="3">Administração</option>
                                </select>
                            </div>
                        </div>  
                        <div style="display: grid; grid-template-columns: auto; padding: 8px; margin: 5px!important; border-radius: 5px; margin: auto 0 auto 0; background-color: cadetblue;">
                            <div class="opcao" style="background-color: darkslateblue;">
                                <label>Observação</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex; justify-content: flex-start; flex-direction: row ; align-items: center; width:35%; font-size: 10px;">
                                        NÃO<input type="range" min="1" max="3" value="2">SIM
                                    </div>
                                    <select class="texto" style="height: 35px; width:65%;" name="">
                                        <option value="todos">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;text-align: center; width: 10%;">
                            <input type="reset" class="login" style="height: 30px; width: 115px; font-size: 10p; background: grey;" value="Limpar Filtros">
                        </div>
                        <div>
                            <input type="submit" value="Pesquisar" class="login" style="height: 30px; width: 115px; font-size: 10p; background: white;">
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>