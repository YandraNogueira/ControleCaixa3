<?php
	error_reporting(1);
	//Modifica a zona de tempo a ser utilizada.
	date_default_timezone_set('UTC');

	include_once('menu.php');
	include_once("conexao.php");	//Recebe os valores enviados do formulário de filtro
	$filter_status = $_GET['filter_status'];
	$filter_data = $_GET['filter_data'];
	//Data atual
	$data_atual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Controle de caixa</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="fontawesome/css/all.min.css">
		<style type="text/css">
			.carregando{
				color:#ff0000;
				display:none;
			}
			i{

			}
		</style>
	</head>
	<body>
		<br><br>
	<div class="container">
		<div class="corpo">
			<form>
			<h1>Pesquisar relatórios <i class="fa-solid fa-magnifying-glass fa-xs" style="color: #2e8b57;"></i></h1><br>
				<div class="row">
					<div class="col-md">
						<label>Status:</label>
						<select class="form-select form-select-sm" name="filter_status">
							<option></option>
							<option>Aguardando</option>
							<option>Concluído</option>
							<option>Pendente</option>
						</select>
					</div>
					<div class="col-md">
						<label>Data:</label>
						<input class="form-control form-control-sm" type="date" name="filter_data">
					</div>					
				</div><br>
				<button class="btn btn-sm btn-secondary" type="submit">Localizar</button>							
			</form><br><hr>
			<h1>Relatórios <i class="fa-solid fa-clipboard-list fa-xs" style="color: #2e8b57;"></i></h1>
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Nº</th>
						<th>Loja</th>
						<th>Justificativa</th>
						<th>Data</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($filter_status) AND empty($filter_data)) {
						$query_tarefas = $conn->query("SELECT t.*, cat.nome_sub_categoria FROM tarefas AS t INNER JOIN sub_categorias_post AS cat ON t.cod_subcat = cat.id  WHERE status = '$filter_status' ORDER BY data_realiz ASC");
					}elseif (empty($filter_status) AND !empty($filter_data)) {
						$query_tarefas = $conn->query("SELECT t.*, cat.nome_sub_categoria FROM tarefas AS t INNER JOIN sub_categorias_post AS cat ON t.cod_subcat = cat.id WHERE data_realiz = '$filter_data' ORDER BY data_realiz ASC");
					}elseif(!empty($filter_status) AND !empty($filter_data)){
						$query_tarefas = $conn->query("SELECT t.*, cat.nome_sub_categoria FROM tarefas AS t INNER JOIN sub_categorias_post AS cat ON t.cod_subcat = cat.id WHERE status = '$filter_status' AND data_realiz = '$filter_data' ORDER BY data_realiz ASC");
					}else{					
						$query_tarefas = $conn->query("SELECT t.*, cat.nome_sub_categoria FROM tarefas AS t INNER JOIN sub_categorias_post AS cat ON t.cod_subcat = cat.id WHERE data_realiz = '$data_atual' ORDER BY data_realiz ASC");
					}
					while ($result_query_tarefas = mysqli_fetch_assoc($query_tarefas)) {
						$id = $result_query_tarefas['id'];

							echo "<tr>";
							echo "<td>".$id."</td>";
							echo "<td>".$result_query_tarefas['nome_sub_categoria']."</td>";
							echo "<td>".$result_query_tarefas['tarefa']."</td>";
							echo "<td>".date('d/m/Y', strtotime($result_query_tarefas['data_realiz']))."</td>";
							echo "<td>".$result_query_tarefas['status']."</td>";
							echo "<td>
									<a class='btn btn-success' href='formAtualizar.php?id=$id'>Confirmar <i class='fa-solid fa-circle-check fa-xs'></i></a> &emsp;&emsp;
									<a class='btn btn-danger' href=formEdit.php?id=$id>Não confirmar <i class='fa-solid fa-circle-xmark fa-xs'></i></a>
								  </td>";
							echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#cadastrar">Adicionar</button>
		<!--Janela modal cadastra-->
		<div class="modal fade" id="cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Controle de Caixa <i class="fa-solid fa-pen-to-square fa-xs" style="color: #2e8b57;"></i></h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<form method="POST" action="processa-cadastra-tarefa.php">
			      	<div class="row">
						  <div class="col-md">
							<label>*Operação:</label>
							<select name="categoria" id="categoria" class="form-select form-select-sm" required="">
								<option value="">Selecione a operação</option>
								<?php
									$result_cat_post = "SELECT * FROM categoria ORDER BY categoria";
									$resultado_cat_post = mysqli_query($conn, $result_cat_post);
									while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
										echo '<option value="'.$row_cat_post['id'].'">'.$row_cat_post['categoria'].'</option>';
									}
								?>
							</select>
							</div>

							<div class="col-md">
								<label>*Loja:</label>
								<span class="carregando">Aguarde, carregando...</span>
								<select name="id_sub_categoria" id="id_sub_categoria" class="form-select form-select-sm" required="">
									<option value="">Selecione a loja</option>
								</select>
							</div>

							<div class="col-md">
			      				<label>*Data</label>
			      				<input class="form-control form-control-sm" type="date" required="" name="data">
			      			</div>
			      	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-success">Cadastrar</button>
			      </div>
			    </form>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		
		<script type="text/javascript">
		$(function(){
			$('#categoria').change(function(){
				if( $(this).val() ) {
					$('#id_sub_categoria').hide();
					$('.carregando').show();
					$.getJSON('sub_categorias_post.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolha Subcategoria</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome_sub_categoria + '</option>';
						}	
						$('#id_sub_categoria').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#id_sub_categoria').html('<option value="">– Escolha Subcategoria –</option>');
				}
			});
		});
		</script>

			</div>
		  </div>
		</div>
		<!-- FIM DO MODAL -->
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	</body>
</html>