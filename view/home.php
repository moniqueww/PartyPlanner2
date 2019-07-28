<?php include_once 'include/verifica.php';?>
<?php include_once 'include/banco.php';?>
<?php
	include_once '../autoload.php';
	$alunoControle = new ControleAluno();
	$alunos = array();
    $alunos = $alunoControle->controleAcao("listarTodos");
	
	$livroControle = new ControleLivro();
	$livros = array();
	$livros = $livroControle->controleAcao("listarTodos");
	
	$emprestimoControle = new ControleEmprestimo();
	$emprestimos = array();
	if(isset($_GET['procure'])){
		$emprestimos = $emprestimoControle->controleAcao("listarTodos", $_GET['procure']);
	}else{
		$emprestimos = $emprestimoControle->controleAcao("listarTodos");
	}
	
	$categoriaControle = new ControleCategoria();
	$categorias = array();

	$exemplarControle = new ControleExemplar();
	$exemplares = array();
	$exemplares=$exemplarControle->controleAcao("listarTodos");
	
	$usuarioControle = new ControleUsuario();
	$usuarios = array();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Página inicial</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#procure').on('input',function(e){
				valor = $('#procure').val();
				if(valor != ""){
					$('.all-content h2:nth-child(1)').hide();
					$('.all-content div:nth-child(2)').hide();
					$('.all-content br:nth-child(3)').hide();
					$('.all-content section:nth-child(4)').hide();
					$('.all-content .page-title.title-livros').css('marginTop','0px');
					$('.all-content section:nth-child(5)').hide();
					$('.all-content section:nth-child(6)').hide();
					$('.all-content section:nth-child(7)').hide();
					$('.all-content section:nth-child(8)').hide();
					$('#tabela-aluno tbody').load("load_procura_aluno3.php",{
						procure: valor
					});
					$('#tabela-livro tbody').load("load_procura_livro3.php",{
						procure: valor
					});
					$('#tabela-emprestimo tbody').load("load_procura_emprestimo3.php",{
						procure: valor
					});
				}else{
					$('.all-content h2:nth-child(1)').show();
					$('.all-content div:nth-child(2)').show();
					$('.all-content br:nth-child(3)').show();
					$('.all-content section:nth-child(4)').show();
					$('.all-content .page-title.title-livros').css('marginTop','50px');
					$('.all-content section:nth-child(5)').show();
					$('.all-content section:nth-child(6)').show();
					$('.all-content section:nth-child(7)').show();
					$('.all-content section:nth-child(8)').show();
					$('#tabela-aluno tbody').load("load_procura_aluno3.php",{
						procure: valor
					});
					$('#tabela-livro tbody').load("load_procura_livro3.php",{
						procure: valor
					});
					$('#tabela-emprestimo tbody').load("load_procura_emprestimo3.php",{
						procure: valor
					});
				}
			});
		});
	</script>
</head>
<body>
	<?php include_once 'include/menu.php'; ?>
	<div id="div2">
		<?php include_once 'include/cabecalho.php'; ?>
		<div class="all-content">
			<h2 class="page-title">Informações gerais</h2>
			<div>
				<input type="date" id="data" name="data"/>
				<button class="normal-button"><i class='material-icons'>date_range</i></button>
			</div>
			<br clear='all'/>
			<section class="content">Livros cadastrados<br/><br/><span class="dados">
				<?php
					$sql = "SELECT count(*) FROM Livro";
                    $resultado = $conexao->query($sql);
                    while($registro = $resultado->fetch_array()){
						echo $registro['count(*)'];
					}
                    $resultado->free();
                 ?>
				 </span>
			</section>
			<section class="content">Alunos cadastrados<br/><br/><span class="dados">
				<?php
					$sql = "SELECT count(*) FROM Aluno";
                    $resultado = $conexao->query($sql);
                    while($registro = $resultado->fetch_array()){
						echo $registro['count(*)'];
					}
                    $resultado->free();
                ?></span>
			</section>
			<section class="content content-2x">Empréstimos cadastrados<br/><br/><span class="dados maior">
				<?php
					$sql = "SELECT count(*) FROM Emprestimo";
                    $resultado = $conexao->query($sql);
                    while($registro = $resultado->fetch_array()){
						echo $registro['count(*)'];
					}
                    $resultado->free();
                ?></span>
			</section>
			<section class="content">Exemplares cadastrados<br/><br/><span class="dados">
				<?php
					$sql = "SELECT count(*) FROM Exemplar";
                    $resultado = $conexao->query($sql);
                    while($registro = $resultado->fetch_array()){
						echo $registro['count(*)'];
					}
                    $resultado->free();
                ?></span>
			</section>
			<section class="content">Usuários cadastrados<br/><br/><span class="dados">
				<?php
					$sql = "SELECT count(*) FROM Usuario";
                    $resultado = $conexao->query($sql);
                    while($registro = $resultado->fetch_array()){
						echo $registro['count(*)'];
					}
                    $resultado->free();
                ?></span>
			</section>
			<br clear="all"/>
			<h2 class="page-title title-livros">Lista de livros</h2>
			<section class="content content-full">
				<table id="tabela-livro">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nome</th>
							<th>Volume</th>
							<th>Categoria</th>
							<th>Quantidade</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                    	if(!empty($livros)){
							$r = 0;
                        	foreach ($livros as $al) {
								if($r>=5){
									break;
								}
								$categorias = $categoriaControle->controleAcao("listarTodos");
								if(!empty($categorias)){
									foreach ($categorias as $ca) {
										if($ca->getId() == $al->getIdCategoria()){
											$categoria = $ca->getNome();
										}
									}
								}
                            	echo "<tr>
                                    <td><img height='5%' width='auto' alt='Foto do livro {$al->getNome()}' src='img/capas/".$al->getFotoLivro()."'/></td>
									<td>".$al->getNome()."</td>
									<td>".$al->getVolume()."</td>
                                    <td>".$categoria."</td>
									<td>".$al->getQuantidade()."</td>
								</tr>" ; 
								$r++;
                    	    }
                    	}
               		?>
					</tbody>
				</table>
				<a href="lista_livro.php"><button class="normal-button">Ver todos</button></a>
				<br clear="all"/>
			</section>
			<h2 class="page-title">Lista de alunos</h2>
			<section class="content content-full">
				<table id="tabela-aluno">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Matricula</th>
							<th>Curso</th>
							<th>Turma</th>
						</tr>
					</thead>
					<tbody>
					<?php 
                    	if(!empty($alunos)){
							$w = 0;
                        	foreach ($alunos as $al) {
								if($w>=5){
									break;
								}
                            	echo "<tr>
                                    <td>".$al->getNome()."</td>
									<td>".$al->getMatricula()."</td>
									<td>".$al->getCurso()."</td>
                                    <td>".$al->getTurma()."</td>
                                    </td>
                                </tr>" ;
								$w++;
                    	    }
                    	}
               		?>
					</tbody>
				</table>
				<a href="lista_aluno.php"><button class="normal-button">Ver todos</button></a>
				<br clear="all"/>
			</section>
			<h2 class="page-title">Lista de empréstimos</h2>
			<section class="content content-full">
				<table id="tabela-emprestimo">
					<thead>
						<tr>
							<th>Nome do Aluno</th>
							<th>Curso</th>
							<th>Nome do Livro</th>
							<th>Código do Livro</th>
							<th>Funcionário</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    	if(!empty($emprestimos)){
							$w = 0;
                        	foreach ($emprestimos as $em) {
								if($w>=5){
									break;
								}
								$aluno = "";
								$curso = "";
								$livro = "";
								$isbn = "";
								if(!empty($alunos)){
									foreach ($alunos as $al) {
										if($al->getMatricula() == $em->getIdAluno()){
											$aluno = $al->getNome();
											$curso = $al->getCurso();
										}
									}
								}
								if(!empty($exemplares)){
									foreach ($exemplares as $ex){
										if($ex->getCodigo() == $em->getIdLivro()){
											$isbn = $ex->getIsbn();
										}
									}
								}
								if(!empty($livros)){
									foreach ($livros as $li) {
										if($li->getIsbn() == $isbn){
											$livro = $li->getNome();
										}
									}
								}
								$status = $em->getStatus();
								if($status == 1){
									$status = "Ativo";
								}else{
									$status = "Inativo";
								}
                            	echo "<tr>
                                    <td>".$aluno."</td>
									<td>".$curso."</td>
									<td>".$livro."</td>
                                    <td>".$em->getIdLivro()."</td>
									<td>".$em->getFuncionario()."</td>
									<td>".$status."</td>
                                </tr>" ;
								$w++;
                    	    }
                    	}
               		?>
					</tbody>
				</table>
				<a href="lista_emprestimo.php"><button class="normal-button">Ver todos</button></a>
				<br clear="all"/>
			</section>
		</div>
	</div>
</body>
</html>