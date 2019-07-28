<?php include_once 'include/verifica.php';?>
<?php
//Include das classes via autoload
include_once '../autoload.php';
//Caso tenha sido feito um POST da página
if($_POST){
    //Cria o Controle desta View (página)
    $categoriaControle = new ControleCategoria();

    //Passa o POST desta View para o Controle
    $categoriaControle->setVisao($_POST);
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id"])){
        $retorno = $categoriaControle->controleAcao("inserir");
        if($retorno) {$msg="Área inserido com sucesso!";}
        else{$erro="Houve um erro na inserção do Área!";}
    }else{
        $retorno = $categoriaControle->controleAcao("alterar");
        if($retorno) {$msg="Área alterado com sucesso!";}
        else{$erro="Houve um erro na alteração do área!";}
    }
   
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $categoriaControle = new ControleCategoria();
    //Passa o GET desta View para o Controle
    $categoriaControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o cliente do banco de dados
                $retorno=$categoriaControle->controleAcao("excluir");
                if($retorno) {$msg="Área excluído com sucesso!";}
                else{$erro="Houve um erro na exclusão do área!";}
            }elseif ($_GET["op"] == "alt") {
                // O $clienteAlteracao será utilizado no formulário para preencher os dados do cliente 
                // que foram pesquisados no banco de dados
                $categoriaAlteracao = $categoriaControle->controleAcao("listarUnico",$_GET["id"]);
                
            }
        }    

    }  if(isset($_GET["procure"])){
        
        // O $clientes será utilizado para preencher a tabela com os clientes cadastrados  
        $categorias = array();
        $categorias = $categoriaControle->controleAcao("listarTodos",$_GET["procure"]);
        
    }  
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar área</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/form.css" rel="stylesheet" type="text/css">
    <style>
        .red{
			margin-left: 5px;
			color: #ff868c;
			position: absolute;
			margin-top: 5px;
            font-size: 11pt;
			font-family: 'Montserrat';
		}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#nome').blur(function(){
				var nome = $("#nome").val();

				if (nome == "" || nome == " ") {
					$("#validnome").addClass("red");
					$("#validnome").html('Por favor, preencha o campo "Nome"!');
					return false;
				}else if(nome != "" || nome == " "){
					$("#validnome").html('');
				}
				return true;
			});
            
            $('form').submit(function(){
				var nome = $("#nome").val();

				if (nome == "" || nome == " ") {
					$("#validnome").addClass("red");
					$("#validnome").html('Por favor, preencha o campo "Nome"!');
					return false;
				}else if(nome != "" || nome == " "){
					$("#validnome").html('');
				}
                return true;
            });
        });
    </script>
</head>
<body>
	<?php
        $pagina = basename( __FILE__ );
        include("./include/menu.php"); 
    ?>
	<div id="div2">
		<?php include_once 'include/cabecalho.php'; ?>
		<div class="all-content">
			<h2 class="page-title">Cadastrar área</h2>
			<div>
				<input type="date" id="data" name="data"/>
				<button class="normal-button"><i class='material-icons'>date_range</i></button>
			</div>
			<br clear='all'/>
			<section class="content content-full">
				<form novalidate action="form_area.php" method="post">
                    <input name="id" type="hidden" value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";?>">
                    <div class="group">      
				      	<input class="input" id="nome" type="text" name="nome" value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getNome() : "";?>" required>
				      	<span class="highlight"></span>
				      	<span class="bar"></span>
                        <label class="label">Nome</label>
						<span id="validnome"></span>  
					</div>
					<br clear="all"/>
                    <button type="submit" class="button" name="cadastrar"><span class="spana">Cadastrar</span></button>
					<br clear="all"/>
			</section>
		</div>
	</div>
</body>
</html>