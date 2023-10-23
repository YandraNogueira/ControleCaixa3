<?php 
include_once("conect.php");

include_once("crud.php");


$obj = new Crud($conexao);

$obj->readInfo();

$dados = $obj->getAll();


echo "<main>";
echo "<header> Selecione um registro para alterar </header>";

echo "<table border='1'>";
echo "<tr><th>Tarefa</th><th></th></tr>";
foreach ($dados as $info) {
 echo "<tr>
 <td>".$info['tarefa']."</td>
 <td><a href=formEdit.php?id=".$info['id'].">Editar</a></td></tr>";
}

echo "</table>";

echo "</main>";






 ?>