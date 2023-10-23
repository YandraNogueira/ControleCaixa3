<?php 
$id = $_GET['id'];

include_once("conect.php");

include_once("Crud.php");

$obj = new Crud($conexao);

$dados = $obj->readInfo($id);

//var_dump($dados);

// echo $dados['nome']."<br>";

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
   <style>
      input{
         width: 100%;
         padding: 12px 20px;
         margin: 8px 0;
         box-sizing: border-box;
         border-radius:10px;
      }
   </style>
   </head>
   <body>
      <div class="container">
         <br>
   <form action="update.php" method="post">
         <div class="row">
			      <div class="col-md">
			      	<label>*Justificativa:</label>
                  <input class="w3-input w3-border w3-round-large" name="tarefa" placeholder="Descreva aqui a tarefa." required="" value="<?=$dados->tarefa;?>">
               </div>
         </div>
    
    <p> <input type="hidden" name="id" value="<?=$dados->id;?>"></p>

    <button type="submit" class="btn btn-danger">Não confirmar</button>
   </form>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   </body>
</html>
