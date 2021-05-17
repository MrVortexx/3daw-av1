<?php

    $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $host = "localhost";
    $user = "3daw_av1";
    $pass = "3daw_av1";
    $db = "av1_3daw";

    $db = new mysqli($host, $user, $pass, $db);

    if ($db->connect_error) {
        die("Nao foi possivel conectar ao banco de dados: " . $db->connect_error);
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
            <span> Deletar disciplina</span>
        </div>
        <form action="excluirDisciplina.php" method="POST">
            <label for="nome">Nome da disciplina</label>
            <input type="text" name="nome">
        </form>
      
        <?php   
            $nome = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){         
                    $nome      = $_POST['nome'];

                    if (!$nome ){
                        $message = "<span class='error'> Revise o campo e tente novamente. </span>";
                    }else{
                        $sql = "SELECT * FROM disciplinas where nome='$nome'";
                        $result = $db->query($sql); 
    
                        if ( $result->num_rows == 0)    $message = "<p class='error'>Nao foi encontrada uma disciplina com este nome.</p>";
                        else {                       
                            $sql = "DELETE FROM disciplinas where nome='$nome'";
                            if ($db->query($sql)  === true)
                                $message = "<p class='sucess'>Deletado com sucesso!</p>"; 
                            else 
                                $message = "<p class='error'>Problema para remover:  $db->error</p>";
                        }
                    }
            }
                ?>
           
            
       <?php
                    echo "$message";
                ?>
    </div>
  </body>
  </html>