<?php include_once 'include/verifica.php';?>
<?php include_once 'include/banco.php';?>
<?php
	include_once '../autoload.php';
	$organizadorControle = new ControleOrganizador();
	$organizador = array();
	if(isset($_GET['procure'])){
		$organizador = $organizadorControle->controleAcao("listarTodos", $_GET['procure']);
	}else{
		$organizador = $organizadorControle->controleAcao("listarTodos");
	}
	
	/*$sql = "select * from aluno";
	$alunos = $conexao->query($sql);
	$total = mysqli_num_rows($alunos);
	$registros = 10;
	$numPaginas = ceil($total/$registros);
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	$inicio = ($registros*$pagina)-$registros;
	$sql = "select * from aluno limit $inicio,$registros";
	$alunos = $conexao->query($sql);
	$total = mysqli_num_rows($alunos);*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista de alunos</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#procure').on('input',function(e){
				valor = $('#procure').val();
				$('#tabela tbody').load("load_procura_aluno.php",{
					procure: valor
				});
			});
		});
	</script>
</head>
<body>
	<?php include_once 'include/menu.php'; ?>
	<div id="div2">
		<?php include_once 'include/cabecalho.php'; ?>
		<div class="all-content">
			<h2 class="page-title">Lista de organizador</h2>
			<div>
				<input type="date" id="data" name="data"/>
				<button class="normal-button"><i class='material-icons'>date_range</i></button>
			</div>
			<br clear='all'/>
			<section class="content content-full">
				<table id="tabela">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Email</th>
							<th>Celular</th>
							<th>Nomeorg</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    	if(!empty($alunos)){
                        	foreach ($alunos as $al) {
                            	echo "<tr>
                                    <td>".$al->getNome()."</td>
									<td>".$al->getEmail()."</td>
									<td>".$al->getCelular()."</td>
                                    <td>".$al->getNomeorg()."</td>
                                    <td>
                                    <button type='button' data-id=".$al->getEmail()." data-cmd='alterar' class='normal-button btn btn-xs btn-default'><i class='material-icons'>create</i></button></a>
                                    </td>
                                </tr>" ;  
                    	    }
                    	}
						/*while ($aluno = mysqli_fetch_array($alunos)) {
							echo "<tr>
                                    <td>".$aluno['nome']."</td>
									<td>".$aluno['matricula']."</td>
									<td>".$aluno['curso']."</td>
                                    <td>".$aluno['turma']."</td>
                                    <td>
                                    <button type='button' data-id=".$aluno['matricula']." data-cmd='alterar' class='normal-button btn btn-xs btn-default'><i class='material-icons'>create</i></button></a>
                                    </td>
								</tr>" ;
						}*/
               		?>
					</tbody>
				</table>
				<?php
					/*if($pagina > 1) {
						 echo "<a href='lista_aluno.php?pagina=".($pagina - 1)."' class='controle'><button class='normal-button no-float'>&laquo;
						anterior</button></a>";
						}
						for($i = 1; $i < $numPaginas + 1; $i++) {
						 $ativo = ($i == $pagina) ? 'numativo' : '';
						 echo "<a href='lista_aluno.php?pagina=".$i."' class='numero ".$ativo."'><button class='normal-button no-float'> ".$i." </button></a>";
						}

						if($pagina < $numPaginas) {
						 echo "<a href='lista_aluno.php?pagina=".($pagina + 1)."' class='controle'><button class='normal-button no-float'>proximo
						&raquo;</button></a>";
						}*/
				?>
			</section>
		</div>
	</div>
        <script type="text/javascript">
        function init()
        {
           

            //Pego o evento click nos botões da tabela
            $('#tabela').on('click', 'button', function () {
                //busco o id do registro que esta na linha selecionada
                var id = $(this).attr('data-id');                
                if (id) {
                    //vejo qual é a operação
                    var cmd = $(this).attr('data-cmd');
                    if (cmd == 'alterar') {
                        //Redireciono passando os parametros para alteração
                        window.location.href = "form_aluno.php?op=alt&id=" + id;

                    } else if (cmd == 'excluir') {
                        //Pergunto se realmente quer excluir
                        swal({
                            title: "Você tem certeza?",
                            text: "Você não poderá mais reverter esta ação.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Sim, exclua este registro!",
                            cancelButtonText: "Cancelar!",
                            closeOnConfirm: false
                        },
                        function () {
                            //Redireciono passando os parametros para exclusão
                            window.location.href = "form_aluno.php?op=exc&id=" + id;
                        });
                    }
                }
            });
        }


        $(document).ready(init);
        </script>
</body>
</html>