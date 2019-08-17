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
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
	
	<!-- Favicon -->
	<link href="img/brand/favicon.png" rel="icon" type="image/png">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<!-- Icons -->
	<link href="vendor/nucleo/css/nucleo.css" rel="stylesheet">
	<link href="vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
	<!-- Argon CSS -->
	<link type="text/css" href="css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- jQuery -->
    <script src="js/jquery.js" crossorigin="anonymous"></script>
	<!-- Meu js -->
	<script src="js/main.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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
	<div class="wrapper">
		<?php
		$paginaHome = '';
    	$paginaLista = '';
		include_once('include/sidebar.php');
		?>
		<div id="page">

			<?php include_once('include/navbar.php'); ?>

			<div class='content co-10 co-ult'>
				<table id="tabela" style="width: 100%">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    	if(!empty($organizador)){
                        	foreach ($organizador as $org) {
                            	echo "<tr>
                                    <td>".$org->getNome()."</td>
									<td>".$org->getEmail()."</td>
                                </tr>" ;  
                    	    }
                    	}
               		?>
					</tbody>
				</table>
			</div>
			</section>
		</div>
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
                        window.location.href = "form_organizador.php?op=alt&id=" + id;

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
                            window.location.href = "form_organizador.php?op=exc&id=" + id;
                        });
                    }
                }
            });
        }


        $(document).ready(init);
        </script>
</body>
</html>