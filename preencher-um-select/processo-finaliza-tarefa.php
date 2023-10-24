<?php
include_once("conexao.php");
//Recebe o id da tarefa selecionada na página index
	$id = $_GET['id'];

	$up_finaliza = "UPDATE tarefas SET status = 'Concluído' WHERE id = '$id'";
	$query_up_finaliza = mysqli_query($conn, $up_finaliza);
	if (mysqli_affected_rows($conn) > 0) {
	 	echo '<script language="javascript">alert("Tarefa finalizada com sucesso.")</script>';
		echo '<script language="javascript">window.location="index.php"</script>';
	}else{
		echo '<script language="javascript">alert("Ocorreu um erro ao finalizar a tarefa.")</script>';
		echo '<script language="javascript">window.location="index.php"</script>';
	}
	mysqli_close($conn);
?>