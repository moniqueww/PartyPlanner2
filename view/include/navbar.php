<div class="navigation">
	<nav class="navbar navbar-horizontal navbar-expand-lg">
		<div class="container container-menu">
			<div class="collapse navbar-collapse" id="navbar-default">
				
				<form class="navbar-search navbar-search-light form-inline mr-3 d-none d-md-flex ml-lg-auto">
				  <div class="form-group mb-0">
					<div class="input-group input-group-alternative">
					  <div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-search"></i></span>
					  </div>
					  <input id="geralPesq" class="form-control" placeholder="Pesquisar" type="text">
					</div>
				  </div>
				</form>
				
				<ul class="navbar-nav ml-lg-auto">
					<li class="nav-item dropdown">
						<a class="nav-link nav-link-icon" href="" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="header-photo circle" style="display: inline-block;">
								<?php
									if (isset($_SESSION['usuario'])) {
										if ($_SESSION['tipo'] == 'O') {
											$usuarioControle = new ControleOrganizador();
											$img = "<img style='background-color: #f7f8fc;' src='img/imagens_organizador/";
										} else {
											$usuarioControle = new ControleServico();
											$img = "<img style='background-color: #f7f8fc;' src='img/imagens_servico/";
										}
										$usuarioUnico = $usuarioControle->controleAcao('listarUnico', $_SESSION['id']);
										$img .= $usuarioUnico->getImagem()."'/>";
										echo $img;
									}
								?>
							</div>
							<span><?php if (isset($_SESSION['usuario'])) { echo $_SESSION['usuario']; } else { echo "Entrar"; } ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
							<!--<a class="dropdown-item" href="">Action</a>
							<a class="dropdown-item" href="">Another action</a>
							<div class="dropdown-divider"></div>-->
							<?php if (isset($_SESSION['usuario'])) {?>
							<a class="dropdown-item" href="sair.php">Sair</a>
							<?php }else{?>
							<a class="dropdown-item" href="login.php">Logar</a>
							<?php } ?>
						</div>
					</li>
				</ul>
				
			</div>
		</div>
	</nav>
</div>