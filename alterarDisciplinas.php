<?php

$message = "";

$host = "localhost";
$user = "3daw_av1";
$pass = "3daw_av1";
$db = "av1_3daw";

$db = new mysqli($host, $user, $pass, $db);

if ($db->connect_error) {
    die("Nao foi possivel conectar ao banco de dados: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $disciplina      = $_POST['disciplina'];
    $nome      = $_POST['nome'];
    $creditos    = $_POST['creditos'];
    $periodo    = $_POST['periodo'];
    $idPreReq    = $_POST['idprereq'];

    if (!$nome || !$creditos || !$periodo || !$idPreReq ){
        $message = "<span class='error'> Revise os campos e tente novamente. </span>";
    }
    else{
        
        $sql = "Update  disciplinas SET nome='$nome',  periodo='$periodo', creditos='$creditos', idPreRequisito='$idPreReq' where nome='$disciplina'";
        if ($db->query($sql)  === true)
            $message = "<span class='sucess'> Alterado com sucesso </span>";
        else $message = "<span class='error'> Não  foi possível alterar:  $db->error;</span>";
    }   
    
}else{

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

    <div  class="form">
    <div class="form-title">
            <span> Alterar disciplinas</span>
        </div>
        <form action="alterarDisciplinas.php" method="POST">
            <?php
                $sql = "SELECT nome FROM disciplinas";
                $result = $db->query($sql);  
            ?>

            <label for="disciplina">Selecione a disciplina</label>
            <select name="disciplina" id="">  
                <option value=""></option>                      
                <?php
                    while($row = $result->fetch_assoc()) 
                        echo "<option value='".$row['nome']."'>".$row['nome']."</option>";     
                ?>
            </select>

            <label for="nome">Nome</label>
            <input type="text"  name="nome" placeholder="Nome" /> 

            <label for="periodo">Periodo</label>
            <input type="text"  name="periodo" placeholder="Periodo" /> 

            <label>Créditos</label>
            <input type=""  name="creditos" placeholder="Créditos" /> 

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