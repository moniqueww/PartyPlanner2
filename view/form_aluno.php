<?php
include_once 'include/verifica.php';
//Include das classes via autoload
include_once '../autoload.php';
//Caso tenha sido feito um POST da página
if($_POST){
    //Cria o Controle desta View (página)
    $alunoControle = new ControleAluno();

    //Passa o POST desta View para o Controle
    $alunoControle->setVisao($_POST);
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id"])){
        $retorno = $alunoControle->controleAcao("inserir");
        if($retorno) {$msg="Aluno inserido com sucesso!";}
        else{$erro="Houve um erro na inserção do aluno!";}
    }else{
        $retorno = $alunoControle->controleAcao("alterar", $_POST["id"]);
        if($retorno) {$msg="Aluno alterado com sucesso!";}
        else{$erro="Houve um erro na alteração do aluno!";}
    }
   
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $alunoControle = new ControleAluno();
    //Passa o GET desta View para o Controle
    $alunoControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o cliente do banco de dados
                $retorno=$alunoControle->controleAcao("excluir");
                if($retorno) {$msg="Aluno excluído com sucesso!";}
                else{$erro="Houve um erro na exclusão do aluno!";}
            }elseif ($_GET["op"] == "alt") {
                // O $clienteAlteracao será utilizado no formulário para preencher os dados do cliente 
                // que foram pesquisados no banco de dados
                $alunoAlteracao = $alunoControle->controleAcao("listarUnico",$_GET["id"]);
            }
        }    

    }  /*if(isset($_GET["procure"])){
        
        // O $clientes será utilizado para preencher a tabela com os clientes cadastrados  
        $alunos = array();
        $alunos = $alunoControle->controleAcao("listarTodos",$_GET["procure"]);
        
    }  */
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar aluno</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<style>
		.red{
			margin-left: 5px;
			color: #ff868c;
			position: absolute;
			margin-top: 5px;
			font-family: 'Montserrat';
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/form_aluno.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
        $pagina = basename( __FILE__ );
        include("./include/menu.php"); 
    ?>
	<div id="div2">
		<?php include_once 'include/cabecalho.php'; ?>
		<div class="all-content">
			<h2 class="page-title">Cadastrar aluno</h2>
			<div>
				<input type="date" id="data" name="data"/>
				<button class="normal-button"><i class='material-icons'>date_range</i></button>
			</div>
			<br clear='all'/>
			<section class="content content-full">
					<form action="form_aluno.php" method="post">
						<input name="id" type="hidden" value="<?= isset($alunoAlteracao) ? $alunoAlteracao->getMatricula() : "";?>">
						<div class="group">      
					      	<input class="input" type="text" name="nome" id="nome" value="<?= isset($alunoAlteracao) ? $alunoAlteracao->getNome() : "";?>" required>
					      	<span class="highlight"></span>
					      	<span class="bar"></span>
							<label class="label">Nome</label>
							<span id="validnome"></span>
					    </div>
					    <div class="group">      
						    <input class="input" type="number" id="matricula" name="matricula" value="<?= isset($alunoAlteracao) ? $alunoAlteracao->getMatricula() : "";?>" required>
					      	<span class="highlight"></span>
					      	<span class="bar"></span>
							<label class="label">Matrícula</label>
							<span id="validmatricula"></span>
					    </div>
					    <div class="group">      
						    <input class="input" type="text" name="email" id="email" value="<?= isset($alunoAlteracao) ? $alunoAlteracao->getEmail() : "";?>" required>
					      	<span class="highlight"></span>
					      	<span class="bar"></span>
							<label class="label">Email</label>
							<span id="validemail"></span>
					    </div>
					    <div class="group2"> 
					    	<span id="spansel">Curso</span>    
					    	<select class="input" name="curso" id="select" required> 
						      	<option <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getCurso()=="Enologia"){ echo "selected";}}?>><span class="option">Enologia</span></option>
                                                        <option <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getCurso()=="Meio Ambiente"){ echo "selected";}}?>><span class="option">Meio Ambiente</span></option>
						   	<option <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getCurso()=="Informática"){ echo "selected";}}?>><span class="option">Informática</span></option>
							<option <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getCurso()=="Agropecuária"){ echo "selected";}}?>><span class="option">Agropecuária</span></option>
						    </select>
					    </div>
					    <div class="group2"> 
					    	<span id="spansel2">Turma</span>    
					    	<select class="input" name="turma" id="select2" required>
                                                                <option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="1º ano"){ echo "selected";}}?> class="option normal"><span>1º ano</span></option>
								<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="1º ano A"){ echo "selected";}}?> class="option agro"><span>1º ano A</span></option>
								<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="1º ano B"){ echo "selected";}}?> class="option agro"><span>1º ano B</span></option>
                                                                <option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="2º ano"){ echo "selected";}}?> class="option normal">2º ano</option>
								<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="2º ano A"){ echo "selected";}}?> class="option agro">2º ano A</option>
								<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="2º ano B"){ echo "selected";}}?> class="option agro">2º ano B</option>
						   		<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="3º ano"){ echo "selected";}}?> class="option normal">3º ano</option>
						   		<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="3º ano A"){ echo "selected";}}?> class="option agro">3º ano A</option>
								<option  <?php if(isset($alunoAlteracao)){ if($alunoAlteracao->getTurma()=="3º ano B"){ echo "selected";}}?> class="option agro">3º ano B</option>
						    </select>
						</div>
						<br clear="all"/>
                        <button id="button" type="submit" class="button" name="cadastrar"><span class="spana">Cadastrar</span></button>
						<br clear="all"/>
					</form>
			</section>
		</div>
	</div>
        
</body>
</html>