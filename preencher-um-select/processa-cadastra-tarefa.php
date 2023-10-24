<?php
include_once("conexao.php");

	//Variáves que recebem os dados do modal cadastra
	$categoria = $_POST['categoria'];
	$subcategoria = $_POST['id_sub_categoria'];
	$data = $_POST['data'];


	$sql = "INSERT INTO tarefas (cod_categoria, cod_subcat, data_realiz, status) VALUES ('$categoria', '$subcategoria', '$data', 'Aguardando')";
	$query_sql = mysqli_query($conn, $sql);	
	if (mysqli_affected_rows($conn) > 0) {
		echo '<script language="javascript">alert("Cadastro realizado com sucesso.")</script>';
		echo '<script language="javascript">window.location="index.php"</script>';
	}else{
		echo '<script language="javascript">alert("Ocorreu um erro.")</script>';
		echo '<script language="javascript">window.location="index.php"</script>';
	}
	mysqli_close($conn);
?>