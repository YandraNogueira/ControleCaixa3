<?php 
$tarefa = $_POST['tarefa'];
$id = $_POST['id'];

include_once("conect.php");

include_once("crud.php");

$obj = new Crud($conexao);

$obj->atualizar($id,$tarefa);

?>