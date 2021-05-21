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
    $nome      = $_POST['nome'];
    $creditos    = $_POST['creditos'];
    $periodo    = $_POST['periodo'];
    $pre_requisito    = $_POST['pre_requisito'];

    if (!$nome || !$creditos || !$periodo){
        $message = "<span class='error'> Revise os campos e tente novamente. </span>";
    }else if ( $nome == $pre_requisito){
        $message = "<span class='error'> Nome e pré requisito não podem ser iguais. </span>";
    }
    else{
        $sql_id_prereq = "SELECT id FROM  disciplinas WHERE nome='$pre_requisito'";
        $result = $db->query($sql_id_prereq);

        if (!$result) die ("Can't make a sql query");

        $id_prereq = $result->fetch_assoc();
        $id_prereq =  $id_prereq == ""?  0:  $id_prereq['id'];
        
        $sqlInsertDisciplinas = "INSERT INTO disciplinas (nome, periodo, creditos, idPreRequisito)
            VALUES ('$nome',  '$periodo', '$creditos', $id_prereq  )";

        if ($db->query( $sqlInsertDisciplinas)  === true)  $message = "<span class='sucess'> Inserido com sucesso </span>";
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
            <a href="index.html">Prova av1 - 3DAW</a href="index.html">
        </div>
    </header>

    <div class="form">
        <div class="form-title">
            <span> Inserir elementos</span>
        </div>
        <form action="inserirDisciplinas.php" method="POST">
         
            <label for="nome">Nome</label>
            <input type="text"  name="nome" placeholder="Nome" /> 

            <label for="periodo">Periodo</label>
            <input type="text"  name="periodo" placeholder="Periodo" /> 

            <label>Créditos</label>
            <input type=""  name="creditos" placeholder="Créditos" /> 


            <label for="pre_requisito">Selecione a disciplina</label>
           
            <select name="pre_requisito" id="">
                <?php
                    $sql = "SELECT nome FROM disciplinas";
                    $result = $db->query($sql);  
                ?>  
                <option value=""></option>                      
                <?php
                    while($row = $result->fetch_assoc()) 
                        echo "<option value='".$row['nome']."'>".$row['nome']."</option>";
                ?>
            </select>

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