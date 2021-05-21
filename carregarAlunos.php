<?php
$message = "";

function inserirAux($colunasArr, $alunoArr)
{
   
}
function inserirAluno($db, $colunasArr, $alunoArr){
    if (!$colunasArr || !$alunoArr) return false;

    $sql = "Insert into alunos (" . implode(", ", $colunasArr) .") VALUES ('" . implode("', '", $alunoArr) . "')";

    return $db->query($sql);;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $host = "localhost";
    $user = "3daw_av1";
    $pass = "3daw_av1";
    $db = "av1_3daw";

    $db = new mysqli($host, $user, $pass, $db);

    if ($db->connect_error) {
        die("Nao foi possivel conectar ao banco de dados: " . $db->connect_error);
    } 
    $fileName = $_FILES['file_alunos']['name'];
    if (!$fileName){
        $message = "<span class='error'> Por favor, selecione um arquivo antes de enviar</span>";
    }
    else{
        $filePath = $_FILES['file_alunos']['tmp_name'];

        $openFile = fopen($filePath, "r") or die("Unable to open file!");

        $first = 1;
        $arrHeader;
        $tblElementsLength = 0;

        while(($line = fgets($openFile))){
            $lineExplode =  explode(';', $line);

            if ($first){
                $arrHeader =  $lineExplode;
                $first = 0;
                continue;
            }
           $res = inserirAluno($db, $arrHeader, $lineExplode);

           if ($res != true) break;
        }
        if ($db->error) $message = "<span class='error'> Não  foi possível inserir:  $db->error;</span>";
        else     $message = "<span class='sucess'> Inserido com sucesso </span>";

    }  
    
}
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="assets/index.css">
      <title>Document</title>
  </head>
  <body>
    <header>
        <div>
            <a href="index.html">Prova av1 - 3DAW</a href="index.html">
        </div>
    </header>

    <div class="form">
        <div class="form-title">
            <span> Inserir elementos</span>
        </div>
        <form  enctype="multipart/form-data" action="carregarAlunos.php" method="POST">
            <label for="nome">Lista de alunos</label>
            <input type="file"  name="file_alunos" accept=".csv" placeholder="Nome" /> 
           
            <button type="submit"> Enviar</button>
            <div class="submit-message">
                <?php
                    echo "$message";
                ?>
            </div>   
           
        </form>
    </div>
  </body>
  </html>