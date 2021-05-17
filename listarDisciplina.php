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
            <span> Verificar disciplina</span>
        </div>
        <form action="listarDisciplina.php" method="POST">
            <label for="nome">Nome da disciplina</label>
            <input type="text" name="nome">
        </form>
       <table>
             <tr>
                <th>id</th>
                <th>Disciplina</th>
                <th>Periodo</th>
                <th>Pre requisitos</th>
                <th>Créditos</th>
            </tr>
            <?php   if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $nome      = $_POST['nome'];

                    if (!$nome ){
                        $message = "<span class='error'> Revise o campo e tente novamente. </span>";
                    }
                    else{
                            $sql = "SELECT * FROM disciplinas where nome='$nome'";
                            $result = $db->query($sql);  
                        
                            if ( $result->num_rows == 0)    $message = "<p class='error'>Nao foi encontrada uma disciplina com este nome.</p>";
                            else {
                                while($row = $result->fetch_assoc()) 
                                echo "<tr> <td><span>" . $row['id'] ."</span></td> <td><span>". $row['nome'] . "</span></td> <td><span>" 
                                .$row['periodo']."</span></td> <td><span>". 
                                    $row['idPreRequisito'] . "</span></td> <td><span>" . $row['creditos'] ."</span></td></tr>";     
                            }
                        }
                    }
                ?>
           
            </tr>
       </table>
        
            
       <?php
                    echo "$message";
                ?>
    </div>
  </body>
  </html>