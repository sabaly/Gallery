<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Accueil | Salmy Business Shop</title>

	<!--
		Vendor CSS
	-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/animate.css/animate.css">

	<!--
		Project css files
	-->
	<link rel="stylesheet" type="text/css" href="../assets/css/index.css">

	<!--
		Google Font
	-->
</head>
<body>
	<!--
		Headre
	-->
	<header class="container-fluid flex-header bg-white" id="header">
		<div class="logo">
			<h2><i class="icofont-grocery" style="font-size: 25px;"></i> Salmy Business Shop</h2>
			<p>Beauté et Qualité</p>
		</div>

		<div class="search-input">
			<input type="hidden" name="search">
			<i class="icofont-search btn" id="search-btn"></i>
			<button class="btn menu-toggle"><i class="icofont-navigation-menu"></i></button>

			<div class="d-none  rounded rounded-circle menu">
				<nav class="flex-menu">
					<a href="#header">Acceuil</a>
					<a href="#gallerie">Galerie</a>
					<a href="#contact">Contacts</a>
					<a href="#about">A propos</a>
				</nav>
			</div>
		</div>

	</header>

	<!--
		Banner
	-->
	<div class="container-fluid" id="banner">
		<p>Gallerie de Salmy Shop</p>
		<a href="#gallerie" class="scrollto"><button class="btn scrollto">Découvrir</button></a>
	</div>

	<!--
		main
	-->
	<main class="container" id="main">
	<!--
		About
	-->
		<div class="about-block" id="about">
			<div class="texte">
				<h2>A propos</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>

			<div class="slider d-none d-lg-block">
				<div id="caroussel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="../assets/img/portfolio-5.jpg"  class="d-block w-100" />
						</div>

						<div class="carousel-item">
							<img src="../assets/img/portfolio-2.jpg"  class="d-block w-100" />
						</div>

						<div class="carousel-item">
							<img src="../assets/img/portfolio-6.jpg"  class="d-block w-100" />
						</div>

						<div class="carousel-item">
							<img src="../assets/img/portfolio-1.jpg"  class="d-block w-100" />
						</div>

						<div class="carousel-item">
							<img src="../assets/img/portfolio-3.jpg"  class="d-block w-100" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--
			Gallery
		-->
		<div id="gallerie">
			<h2>Gallerie</h2>
			<hr style="width: 20%; background-color: rgb(255, 45, 150); height:0.5px;" />
			<p>
				Découvrir nos produits.<br> Pour plus de détails cliquer sur l'icon détails.
			</p>
			<h5 class="categorie">
				Categorie 1

				<a href=""><span>Voir tout les produits</span></a>
			</h5>
			<div class="articles-categorie-1 bg-white">
				<div id="categorie-1-item" class="carousel slide d-lg-block d-none" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="flex-items w-100">
								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-5.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-6.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-2.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-4.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="flex-items w-100">
								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-1.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-3.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-4.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-3.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#categorie-1-item" role="button", data-slide="prev">
						<span class="carousel-control-prev-icon preview rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>

					<a class="carousel-control-next" href="#categorie-1-item" role="button", data-slide="next">
						<span class="carousel-control-next-icon next rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>
				</div>
			</div>
			
			<!-- Carousel in mobile -->
			<div id="categorie-1-item-mobile" class="carousel slide d-lg-none bg-white" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="flex-items w-100">
								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-5.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="flex-items w-100">
								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-1.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#categorie-1-item-mobile" role="button", data-slide="prev">
						<span class="carousel-control-prev-icon preview rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>

					<a class="carousel-control-next" href="#categorie-1-item-mobile" role="button", data-slide="next">
						<span class="carousel-control-next-icon next rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>
				</div>
			</div>
		</div>

		<div>
			<h5  class="categorie">
				Categorie 2

				<a href=""><span>Voir tout les produits</span></a>
			</h5>
			<div class="articles-categorie-2 bg-white">
				<div id="categorie2-item" class="carousel slide d-lg-block d-none" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="flex-items w-100">
								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-5.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-6.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-2.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-4.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="flex-items w-100">
								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-1.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-3.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-4.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>

								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-3.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#categorie2-item" role="button", data-slide="prev">
						<span class="carousel-control-prev-icon preview rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>

					<a class="carousel-control-next" href="#categorie2-item" role="button", data-slide="next">
						<span class="carousel-control-next-icon next rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>
				</div>
			</div>

			<!-- Carousel in mobile -->
			<div id="categorie-2-item-mobile" class="carousel slide d-lg-none bg-white" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="flex-items w-100">
								<div class="article w-40 h-40">
									<img src="../assets/img/portfolio-6.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="flex-items w-100">
								<div class="article w-20 h-20">
									<img src="../assets/img/portfolio-3.jpg" class="d-block" />
									<div class="article-text">
										<i class="icofont-like"></i>
										<i class="icofont-heart"></i>
										<i class="icofont-link" title="Détails"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#categorie-2-item-mobile" role="button", data-slide="prev">
						<span class="carousel-control-prev-icon preview rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>

					<a class="carousel-control-next" href="#categorie-2-item-mobile" role="button", data-slide="next">
						<span class="carousel-control-next-icon next rounded rounded-circle" aria-hidden="true"></span>
						<span class="sr-only"></span>
					</a>
				</div>
			</div>
		</div>

		<!--
			Contact
		-->
		<div id="contact">
			<h2>Contact</h2>
			<hr style="width: 20%; background-color: rgb(255, 45, 150); height:0.5px;" />
			<p>
				Contactez-nous
			</p>

			<div class="flex-contact-sections">
				<div class="contact-items bg-white">
					<span><i class="icofont-whatsapp rounded rounded-circle"></i> 77 000 11 22</span>
					<span><i class="icofont-facebook rounded rounded-circle"></i> monFace </span>
					<span><i class="icofont-instagram rounded rounded-circle"></i> monInsta</span>
					<span><i class="icofont-envelope rounded rounded-circle"></i> salmybusiness-shop@gmail.com</span>
				</div>

				<div class="contact-form bg-white">
					<form id="contact-form">
						<div class="form-row">
			                <div class="col-md-6 form-group">
			                  <input type="text" name="name" class="form-control" id="name" placeholder="Votre nom" data-rule="minlen:4" data-msg="votre nom, 4 caractères au moins" />
			                  <!--div class="validate"></div-->
			                </div>

			                <div class="col-md-6 form-group">
			                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Adresse email invalide" />
			                  <!--div class="validate"></div-->
			                </div>
			            </div>

						<div class="form-group">
			                <input type="text" class="form-control" name="subject" id="subject" placeholder="Objet" data-rule="minlen:4" data-msg="8 caractères au moins" />
			                <!--div class="validate"></div-->
			            </div>

						<div class="form-group">
			                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Ecrivez nous quelque chose, s'il vous plait." placeholder="Message"></textarea>
			                <!--div class="validate"></div-->
			            </div>

			            <!--div class="mb-3">
			                <div class="loading">Envoie</div>
			                <div class="error-message"></div>
			                <div class="sent-message">Votre message a été envoyé. Merci!</div>
			            </div-->
			            <div class="text-center">
			            	<button type="submit" class="btn">Envoyer</button>
			            </div>

					</form>
				</div>
			</div>
		</div>
	</main>

	<!--
		Footer
	-->
	<footer id="footer">
		<div class="copyright">
			&copy; <strong><span>Salmy Shop</span></strong>-2020, salmybusiness-shop@gmail.com <br> Design by <strong>S@dmin</strong>
		</div>
	</footer>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<!--
		Vendor JS
	-->
	<script type="text/javascript" src="../assets/vendor/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
  	<script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  	<script src="../assets/vendor/jquery.color/jquery.color.js"></script>
	<script type="text/javascript" src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="../assets/vendor/counterup/counterup.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="../assets/js/index.js"></script>
</body>
</html>