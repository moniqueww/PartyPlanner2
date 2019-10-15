<?php
	if (isset($_SESSION['usuario'])) {
		$seusEventosControle = new ControleEvento();
		$seusEventos = array();
		$seusEventos = $seusEventosControle->controleAcao("listarTodos", '', $_SESSION['id']);
	}
?>
<nav id="sidebar">
				<a href="home.php"><img src="img/brand/logo-branco.png" style="margin-left: 30px; margin-bottom: 25px; margin-top: 25px; height: 30px;"></a>

					<!--
										<button id="encolheMenu" class="btn-diferente">
												<i class="fas fa-angle-left"></i>
										</button>
										<button id="expandeMenu" class="btn-diferente" style="display: none">
						                    	<i class="fas fa-angle-right"></i>
										</button>
					-->
    		<!--<ul class="list-unstyled components">
				<li class="active li-add">
					<div>
					  <button type="button" class="btn btn-block waves-effect waves-light btn-primary-alternative btn-add" data-toggle="modal" data-target="#modal-form"><span class="circle btn-inner--icon"><i class="ni ni-fat-add"></i></span>
	
						<span class="btn-inner--text">Novo Evento</span></button>
						<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
							<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
                          
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">Escolha um nome para seu evento</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('eventos.store') }}" method="post">
								<div class="modal-body">
								
									<div class="form-group">
													<div class="input-group input-group-alternative">
														@csrf
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
														</div>
														<input class="form-control" name="nome" placeholder="Nome do evento" type="text">
													</div>
												</div>
									
								</div>
								
								<div class="modal-footer">
									<input type="submit" class="btn btn-primary" value="Save changes">
									<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button> 
								</div>
							</form>
                            
                        </div>
							</div>
						</div>
					</div>
				</li>
			</ul>-->
            <ul class="list-unstyled components">
                <a <?php echo $paginaHome; ?> href="home.php">
                	<div class="paginaAtiva"></div>
	                <li>
	                    <span>Início</span>
	                </li>
                </a>
                <a href="<?= isset($_SESSION['usuario']) ? 'perfil_organizador.php?organizador='.$_SESSION['id'] : '' ?>">
                	<div class="paginaAtiva"></div>
					<li>
                    	<span>Perfil</span>
                	</li>
                </a>
                <!--<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
	                <li>
	                    <i class="far fa-copy"></i>Pages
	                    <ul class="collapse list-unstyled" id="pageSubmenu">
	                        <li>
	                            <a href="#">Page 1</a>
	                        </li>
	                        <li>
	                            <a href="#">Page 2</a>           class="dropdown-toggle collapsed"
	                        </li>
	                        <li>
	                            <a href="#">Page 3</a>
	                        </li>
	                    </ul>
	                </li>
                </a>-->
				<a <?php echo $paginaLista; ?> href="lista_evento.php">
					<div class="paginaAtiva"></div>
					<li>
                    	<span>Eventos</span>
                	</li>
                </a>
                <?php
                	if (isset($seusEventos)) {
                		echo "<p style='padding-top: 30px'>SEUS EVENTOS</p>";
                		foreach ($seusEventos as $sevs) {
                			$eventoSelecionado = '';
                			if (isset($paginaEvento)) {
                				if ($paginaEvento == $sevs->getId()) {
                					$eventoSelecionado = "active";
                				}
                			}
                			echo "<a href='form_evento.php?evento=".$sevs->getId()."' class='sidebar-evento ".$eventoSelecionado."'>
                			<div class='paginaAtiva paginaAtiva-menor'></div>
					<li class='li-menor'>
                    	<div>".$sevs->getNome()."</div>
                	</li>
                </a>";
                		} //<div class='paginaAtiva paginaAtiva-menor'></div>
                	}
                ?>
            </ul>
            <div style="width: 100%; text-align: center; margin-top: 45px;">
            	 <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#modal-form">
            		<span class="btn-inner--text">Novo Evento</span>
            	</button>
        	</div>
        </nav>