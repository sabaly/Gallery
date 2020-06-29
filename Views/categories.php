<?php
	require "../Models/autoload.php";
	$db = DBFactory::getMysqlConnexionWithPDO();

	/*
		Récupération des catégories
	*/
	//{
		$categorieManager = new categorieManager_PDO($db);
		$categories = $categorieManager->listcategories();
	//}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
	
	<title>Catégories | Salmy Business Shop</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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


  	<!--aos-master-->
  	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

	<!--
		Header
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
					<a href="../Views">Acceuil</a>
					<a href="../Views#gallerie">Galerie</a>
					<a href="../Views#contact">Contacts</a>
					<a href="../Views#about">A propos</a>
				</nav>
			</div>
		</div>

	</header>
	<!--
		Main
	-->
	<main class="container">
		<!-- BreadCrumb -->
		<nav aria-label="breadcrumb" id="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="../Views">Acceuil</a></li>
				<li class="breadcrumb-item active" aria-current="page">Catégories</li>
			</ol>
		</nav>


		<!-- Article -->
		<article class="bg-white products-container">
			<div class="categorie-menu">
				<select onchange="reloadCategorie(this)">
					<?php 
						foreach ($categories as $categorie) {
					?>
					<option value="<?=$categorie->idCategorie() ; ?>"><?= $categorie->nameCategorie() ?></option>
					<?php } ?>
				</select>
			</div>

			<div id="products">
			</div>

		</article>
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

	<!--aos master-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    	AOS.init();
    </script>
</body>
</html>