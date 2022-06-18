<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php include_once("modules/session/tabInfo.php"); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script> <!-- https://github.com/SheetJS/sheetjs https://www.npmjs.com/package/xlsx-->
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- animaçoes jquery -->
        <script src="js/gi.js"></script>
        <script src="js/gi_planilha.js"></script>
        <script src="js/verificar.js"></script>
        <link rel="stylesheet" href="css/gi.css">
        <link rel="stylesheet" href="css/gi_planilha.css">

    </head>

    <body>
        <?php include_once("modules/divisions/CardPesquisa.php"); ?>
        <?php include_once("modules/divisions/gi_header.php"); ?>

        <div class="corpo">
            <label class="upload">               
                <input type="file" accept=".xls,.xlsx" onchange='upload(this)'>
                <img src="img/upload.png">
                Upload
            </label>
        </div>
    </body>
     <!-- ??? -->
</html>