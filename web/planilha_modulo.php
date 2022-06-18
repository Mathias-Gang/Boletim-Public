<?php
require 'vendor/autoload.php';
require 'modules/database/conexao.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//VARIÁVEIS PARA SETTAR O FUNCIONAMENTO DO LEITOR DE PLANILHAS XLSX
$inputFileName = 'planilhas/boletim.xlsx';
//COLUNAS
$nome = 1;
$turma = 0;

$spreadsheet = new Spreadsheet();
$inputFileType = 'Xlsx';
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
$reader->setReadDataOnly(true);

$worksheetData = $reader->listWorksheetInfo($inputFileName);

foreach ($worksheetData as $worksheet) {

    $sheetName = $worksheet['worksheetName'];
    
    echo "<h4>$sheetName</h4>";
    $reader->setLoadSheetsOnly($sheetName);
    $spreadsheet = $reader->load($inputFileName);
    
    $worksheet = $spreadsheet->getActiveSheet();
    $planilha = $worksheet->toArray();
    for ($i = 0; count($planilha); $i++) {

        if (!isset($planilha[$i][$nome]) and !isset($planilha[$i][$turma])) {break;}
        $rowPlanilha = $planilha[$i];
        if (isset($rowPlanilha[$nome]) and !is_int($rowPlanilha[$turma])) {continue;}

        $statement = "
            INSERT INTO conta
                (nome, senha, tipo_conta)
            VALUES
                (?, md5(?), 1)
            ";
        $param = array("ss", $rowPlanilha[$nome], $rowPlanilha[$nome]);
        Query::execute($statement, $param);

        $statement = "
            SELECT
                aluno.id 
            FROM aluno
            LEFT JOIN conta ON
                conta.id = aluno.idConta
            WHERE
                conta.nome = ?
            ";
        $param = array("s", $rowPlanilha[$nome]);
        $query = Query::execute($statement, $param);
        $rowAluno = $query->fetch_assoc();

        $statement = "
            SELECT 
                idsis
            FROM turma
            WHERE 
                id = ? AND
                ano = 2021
            ";
        $param = array("i", $rowPlanilha[$turma]);
        $query = Query::execute($statement, $param);
        $rowTurma = $query->fetch_assoc();

        $statement = "
            UPDATE
                aluno
            LEFT JOIN conta ON
                conta.id = aluno.idConta
            SET
                aluno.idturmabobo = ?,
                aluno.anoturmabobo = 2021
            WHERE
                conta.nome = ?
            ";
        $param = array("is", $rowPlanilha[$turma], $rowPlanilha[$nome]);
        Query::execute($statement, $param);
        $statement = "
            INSERT INTO rAlunoTurma
                (idAluno, idTurma)
            VALUES 
                (?, ?)
            ";
        $param = array("ii", $rowAluno["id"], $rowTurma["idsis"]);
        Query::execute($statement, $param);

        echo $rowAluno["id"], " ", $rowPlanilha[$nome], " ", $rowPlanilha[$turma];
        echo "<br>";
    }

}