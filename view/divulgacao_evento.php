<?php include_once 'include/banco.php';?>
<?php
    include_once '../autoload.php'; 
    if($_GET['evento']){ // Caso os dados sejam enviados via GET
        
        $categoriaControle = new ControleCategoria();

        $categorias = [];

        $categorias = $categoriaControle->controleAcao('listarTodos');

        $servicoControle = new ControleServico();

        $servicos = [];

        $eventoServicoControle = new ControleEventoServico();

        $eventosServicos = [];

        $eventosServicos = $eventoServicoControle->controleAcao("listarTodos", $_GET["evento"]);

        $servicos = $servicoControle->controleAcao("listarTodos");

        $eventoControle = new ControleEvento();
        //Passa o GET desta View para o Controle
        $eventoControle->setVisao($_GET);
    
        $eventoUnico = $eventoControle->controleAcao("listarUnico", $_GET["evento"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";

        $organizadorControle = new ControleOrganizador();

        $organizadorUnico = $organizadorControle->controleAcao('listarUnico', $eventoUnico->getIdUsuario());
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?> - Partyplann</title>
    <!-- Favicon -->
    <link href="img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Slick slider -->
    <link href="css/slick.css" rel="stylesheet">
    <!-- Theme color -->
    <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Fonts -->

    <!-- Open Sans for body font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,800" rel="stylesheet">
	<!-- Montserrat for title -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 
 
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	
  	<!-- Start Header -->
	<header id="mu-hero" class="" role="banner">
		<!-- Start menu  -->
		<div style="position: absolute; z-index: 99999; right: 20px; top: 0px;" id="mu-mu-logo"><img style="width: 200px; height: auto;" src="img/brand/logo-branco.png"/></div>
		<nav class="navbar navbar-fixed-top navbar-default mu-navbar">
		  	<div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>

			      <!-- Logo -->
			      <a class="navbar-brand" href="index.html"><?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?></a>

			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="nav navbar-nav mu-menu navbar-right">
			      		<li><a href="#mu-hero">Início</a></li>
				        <li><a href="#mu-about">Sobre</a></li>
				        <li><a href="#mu-schedule">Schedule</a></li>
			            <li><a href="#mu-speakers">Speakers</a></li>
			            <li><a href="#mu-pricing">Preço</a></li>
			            <li><a href="#mu-sponsors">Serviços</a></li>
			            <li><a href="#mu-contact">Contato</a></li>
			      	</ul>
			    </div><!-- /.navbar-collapse -->
		  	</div><!-- /.container-fluid -->
		</nav>
		<!-- End menu -->

		<div class="mu-hero-overlay">
			<div class="container">
				<div class="mu-hero-area">

					<!-- Start hero featured area -->
					<div class="mu-hero-featured-area">
						<div class="mu-hero-evento-photo-area">
    						<img style="height: 100%; width: 100%;" src="img/brand/foto-festa.png">
    					</div>
						<!-- Start center Logo -->
						<div class="mu-logo-area">
							<!-- text based logo -->
							<a class="mu-logo" href="#"><?= isset($organizadorUnico) ? $organizadorUnico->getNome() : "";?></a>
							<!-- image based logo -->
							<!-- <a class="mu-logo" href="#"><img src="assets/images/logo.jpg" alt="logo img"></a> -->
						</div>
						<!-- End center Logo -->

						<div class="mu-hero-featured-content">

							<h1><?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?></h1>
							<p class="mu-event-date-line">29 de outubro de 2019. Bento Gonçalves, RS</p>

							<div class="mu-event-counter-area">
								<div id="mu-event-counter">
									
								</div>
							</div>

						</div>
					</div>
					<!-- End hero featured area -->

				</div>
			</div>
		</div>
	</header>
	<!-- End Header -->
	
	<!-- Start main content -->
	<main role="main">
		<!-- Start About -->
		<section id="mu-about">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="mu-about-area">
							<!-- Start Feature Content -->
									<div class="mu-about-right">
										<h2>Sobre o evento</h2>
										<p style="margin: 0 20px 10px 0;"><?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?></p>
									</div>
							<!-- End Feature Content -->

						</div>
					</div>
				
					<div class="col-md-8">
						<div class="mu-speakers-area">

							<div class="mu-title-area">
								<h2 class="mu-title">Publicações</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							</div>

							<!-- Start Speakers Content -->
							<div class="mu-speakers-content">

								<div class="mu-speakers-slider">

									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Karl Groves</h3>
											<p>Digital Artist</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->

									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Sarah Dransner</h3>
											<p>Business Consultant</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->


									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Ned Stark</h3>
											<p>UI/UX Specialist</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->


									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Michaela Lehr </h3>
											<p>Digital Marketer</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->

									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Karl Groves</h3>
											<p>Digital Artist</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->

									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Sarah Dransner</h3>
											<p>Business Consultant</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->


									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Ned Stark</h3>
											<p>UI/UX Specialist</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->


									<!-- Start single speaker -->
									<div class="mu-single-speakers">
										<img src="img/brand/background3.png" alt="speaker img">
										<div class="mu-single-speakers-info">
											<h3>Michaela Lehr </h3>
											<p>Digital Marketer</p>
											<ul class="mu-single-speakers-social">
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- End single speaker -->

								</div>
							</div>
							<!-- End Speakers Content -->

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Speakers -->

		<!-- Start Schedule  -->
		<section id="mu-schedule">
			<div class="container">
				<div class="row">
					<div class="colo-md-12">
						<div class="mu-schedule-area">

							<div class="mu-title-area">
								<h2 class="mu-title">Schedule Detail</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis unde, ut sapiente et voluptatum facilis consectetur incidunt provident asperiores at necessitatibus nulla sequi voluptas libero quasi explicabo veritatis minima porro.</p>
							</div>

							<div class="mu-schedule-content-area">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs mu-schedule-menu" role="tablist">
								    <li role="presentation" class="active"><a href="#first-day" aria-controls="first-day" role="tab" data-toggle="tab">1 Day / 19 Feb</a></li>
								    <li role="presentation"><a href="#second-day" aria-controls="second-day" role="tab" data-toggle="tab">2 Day / 20 Feb</a></li>
								    <li role="presentation"><a href="#third-day" aria-controls="third-day" role="tab" data-toggle="tab">3 Day / 21 Feb</a></li>
								    
								</ul>

								<!-- Tab panes -->
								<div class="tab-content mu-schedule-content">
								    <div role="tabpanel" class="tab-pane fade mu-event-timeline in active" id="first-day">
								    	<ul>
								    		<li>
								    			<div class="mu-single-event">
								    				<p class="mu-event-time">9.00 AM</p>
								    				<h3>Breakfast</h3>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">10.00 AM</p>
								    				<h3>Advanced SVG Animations</h3>
								    				<span>By Karl Groves</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">11.00 AM</p>
								    				<h3>Presenting Work with Confidence</h3>
								    				<span>By Sarah Dransner</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">12.00 AM</p>
								    				<h3>Keynote on UX & UI Design</h3>
								    				<span>By Ned Stark</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<p class="mu-event-time">1.00 PM</p>
								    				<h3>The End</h3>
								    			</div>
								    		</li>
								    	</ul>
								    </div>
								    <div role="tabpanel" class="tab-pane fade mu-event-timeline" id="second-day">
								    	<ul>
								    		<li>
								    			<div class="mu-single-event">
								    				<p class="mu-event-time">9.00 AM</p>
								    				<h3>Breakfast</h3>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">10.00 AM</p>
								    				<h3>Advanced SVG Animations</h3>
								    				<span>By Karl Groves</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">11.00 AM</p>
								    				<h3>Presenting Work with Confidence</h3>
								    				<span>By Sarah Dransner</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">12.00 AM</p>
								    				<h3>Keynote on UX & UI Design</h3>
								    				<span>By Ned Stark</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<p class="mu-event-time">1.00 PM</p>
								    				<h3>The End</h3>
								    			</div>
								    		</li>
								    	</ul>
								    </div>
								    <div role="tabpanel" class="tab-pane fade mu-event-timeline" id="third-day">
								    	<ul>
								    		<li>
								    			<div class="mu-single-event">
								    				<p class="mu-event-time">9.00 AM</p>
								    				<h3>Breakfast</h3>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">10.00 AM</p>
								    				<h3>Advanced SVG Animations</h3>
								    				<span>By Karl Groves</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">11.00 AM</p>
								    				<h3>Presenting Work with Confidence</h3>
								    				<span>By Sarah Dransner</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<img src="img/brand/background3.png" alt="event speaker">
								    				<p class="mu-event-time">12.00 AM</p>
								    				<h3>Keynote on UX & UI Design</h3>
								    				<span>By Ned Stark</span>
								    			</div>
								    		</li>
								    		<li>
								    			<div class="mu-single-event">
								    				<p class="mu-event-time">1.00 PM</p>
								    				<h3>The End</h3>
								    			</div>
								    		</li>
								    	</ul>
								    </div>
								    
								</div>

							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Schedule -->

		<!-- Start Speakers -->
		<section id="mu-speakers">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-speakers-area">

							<div class="mu-title-area">
								<h2 class="mu-title">Our Speakers</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis unde, ut sapiente et voluptatum facilis consectetur incidunt provident asperiores at necessitatibus nulla sequi voluptas libero quasi explicabo veritatis minima porro.</p>
							</div>

							<!-- Start Speakers Content -->
							<div class="mu-speakers-content">

								<div class="mu-speakers-slider">

									
								</div>
							</div>
							<!-- End Speakers Content -->

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Speakers -->

		<!-- Start Venue -->
		<section id="mu-venue">
			<div class="mu-venue-area">
				<div class="row">

					<div class="col-md-6">
						<div class="mu-venue-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.8176744277202!2d-81.47150788457147!3d28.424757900613237!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e77e378ec5a9a9%3A0x2feec9271ed22c5b!2sOrange+County+Convention+Center!5e0!3m2!1sen!2sbd!4v1503833952781" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>

					<div class="col-md-6">
						<div class="mu-venue-address">
							<h2>VENUE <i class="fa fa-chevron-right" aria-hidden="true"></i></h2>
							<h3>Orange County Convention Center</h3>
							<h4>9800 International Dr, Orlando, FL 32819, USA</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem reiciendis incidunt accusantium porro amet repellendus hic corporis fugiat officiis, sequi iste distinctio possimus dignissimos, veniam quae delectus. Fuga, modi, perferendis!</p>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- End Venue -->

		<!-- Start Pricing  -->
		<section id="mu-pricing">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-pricing-area">
							
							<div class="mu-title-area">
								<h2 class="mu-title">Pricing plans</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis unde, ut sapiente et voluptatum facilis consectetur incidunt provident asperiores at necessitatibus nulla sequi voluptas libero quasi explicabo veritatis minima porro.</p>
							</div>
							
							<div class="mu-pricing-conten">
								<div class="row">
									
									<!-- single price item -->
									<div class="col-md-4">
										<div class="mu-single-price">

											<div class="mu-single-price-head">
												<span class="mu-currency">$</span>
												<span class="mu-rate">12</span>
												<span class="mu-time">/all days</span>
											</div>
											<h3 class="mu-price-title">BASIC</h3>
											<ul>
												<li>Basic Class Ticket</li>
												<li>Access to all sessions</li>
												<li>Free Breakfast</li>
											</ul>
											<a class="mu-register-btn" href="#"> Register Now</a>
										</div>
									</div>
									<!-- / single price item -->

									<!-- single price item -->
									<div class="col-md-4">
										<div class="mu-single-price mu-popular-price">
											<span class="mu-price-tag">Popular</span>
											<div class="mu-single-price-head">
												<span class="mu-currency">$</span>
												<span class="mu-rate">22</span>
												<span class="mu-time">/all days</span>
											</div>
											<h3 class="mu-price-title">STANDARD</h3>
											<ul>
												<li>Basic Class Ticket</li>
												<li>Access to all sessions</li>
												<li>Free Breakfast</li>
											</ul>
											<a class="mu-register-btn" href="#"> Register Now</a>
										</div>
									</div>
									<!-- / single price item -->

									<!-- single price item -->
									<div class="col-md-4">
										<div class="mu-single-price">

											<div class="mu-single-price-head">
												<span class="mu-currency">$</span>
												<span class="mu-rate">45</span>
												<span class="mu-time">/all days</span>
											</div>
											<h3 class="mu-price-title">PREMIUM</h3>
											<ul>
												<li>Basic Class Ticket</li>
												<li>Access to all sessions</li>
												<li>Free Breakfast</li>
											</ul>
											<a class="mu-register-btn" href="#"> Register Now</a>
										</div>
									</div>
									<!-- / single price item -->

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Pricing -->

		<!-- Start Sponsors -->
		<section id="mu-sponsors">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-sponsors-area">
							
							<div class="mu-title-area">
								<h2 class="mu-title">Our Sponsors</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint assumenda ut molestias doloremque ipsam, fugit laborum totam, pariatur est cumque at, repudiandae officia ex dolores quas minus optio, iusto soluta?</p>
							</div>
							
							<!-- Start spnonsors brand logo -->
							<div class="mu-sponsors-content">
								<div class="row">
								
									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

										<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

										<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

									<div class="col-md-2 col-sm-4 col-xs-4">
										<div class="mu-sponsors-single">
											<img src="img/brand/background3.png" alt="Brand Logo">
										</div>
									</div>

								</div>
							</div>
							<!-- End spnonsors brand logo -->

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Sponsors -->


		<!-- Start Contact -->
		<section id="mu-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-contact-area">

							<div class="mu-title-area">
								<h2 class="mu-heading-title">Contact Us</h2>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
							</div>

							<!-- Start Contact Content -->
							<div class="mu-contact-content">
								<div class="row">

								<div class="col-md-12">
									<div class="mu-contact-form-area">
										<div id="form-messages"></div>
											<form id="ajax-contact" method="post" action="mailer.php" class="mu-contact-form">
												<div class="form-group">                
													<input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
												</div>
												<div class="form-group">                
													<input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
												</div>              
												<div class="form-group">
													<textarea class="form-control" placeholder="Message" id="message" name="message" required></textarea>
												</div>
												<button type="submit" class="mu-send-msg-btn"><span>SUBMIT</span></button>
								            </form>
										</div>
									</div>
								</div>
							</div>
							<!-- End Contact Content -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact -->

	</main>
	
	<!-- End main content -->	
			
			
	<!-- Start footer -->
	<footer id="mu-footer" role="contentinfo">
			<div class="container">
				<div class="mu-footer-area">
					<div class="mu-footer-top">
						<div class="mu-social-media">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
							<a href="#"><i class="fa fa-linkedin"></i></a>
							<a href="#"><i class="fa fa-youtube"></i></a>
						</div>
					</div>
					<div class="mu-footer-bottom">
						<p class="mu-copy-right">&copy; Copyright <a rel="nofollow" href="http://markups.io">markups.io</a>. All right reserved.</p>
					</div>
				</div>
			</div>

	</footer>
	<!-- End footer -->

	
	
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
	<!-- Slick slider -->
    <script type="text/javascript" src="js/slick.min.js"></script>
    <!-- Event Counter -->
    <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
    <!-- Ajax contact form  -->
    <script type="text/javascript" src="js/app.js"></script>
  
       
	
    <!-- Custom js -->
	<script type="text/javascript" src="js/custom.js"></script>

	
	
    
  </body>
</html>