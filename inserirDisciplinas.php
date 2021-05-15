<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $host = "localhost";
    $user = "3daw_av1";
    $pass = "3daw_av1";
    $db = "av1_3daw";

    $db = new mysqli($host, $user, $pass, $db);


    
    if ($db->connect_error) {
        $message = "<span class='error'> Nao foi possivel conectar ao banco de dados. Erro: $db->connect_error </span>";
    }

    $nome      = $_POST['nome'];
    $creditos    = $_POST['creditos'];
    $periodo    = $_POST['periodo'];
    $idPreReq    = $_POST['idprereq'];

    if (!$nome || !$creditos || !$periodo || !$idPreReq ){
        $message = "<span class='error'> Revise os campos e tente novamente. </span>";
    }
    else{
        $sql = "Insert into disciplinas (`nome`, `periodo`, `creditos`, `idPreRequisito`) VALUES ('$nome',  '$periodo', '$creditos', '$idPreReq')";
        if ($db->query($sql)  === true)
            $message = "<span class='sucess'> Inserido com sucesso </span>";
        else $message = "<span class='error'> Não  foi possível inserir:  $db->error;</span>";
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
            <h3>Prova av1 - 3DAW</h3>
        </div>
    </header>

    <div class="inserirDisciplinaForm">
        <form action="inserirDisciplinas.php" method="POST">
         
            <label for="nome">Nome</label>
            <input type="text"  name="nome" placeholder="Nome" /> 

            <label for="periodo">Periodo</label>
            <input type="text"  name="periodo" placeholder="Periodo" /> 

            <label>Créditos</label>
            <input type=""  name="creditos" placeholder="Créditos" /> 

            <label>Créditos</label>
            <input type="number"  name="creditos" placeholder="Créditos" /> 

            <label>Pre requisitos</label>
            <input type="number"  name="idprereq" placeholder="id da tabela requisitos" /> 

            <button type="submit"> Enviar</button>
            <div>
                <?php
                    echo "<span>$message</span>";
                ?>
            </div>   
           
        </form>
    </div>
  </body>
  </html>