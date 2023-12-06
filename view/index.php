<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);
$isAdmin = $_SESSION['role'] == '0';

if($isLoggedIn) {
	$username = $_SESSION['username'];
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>RecoveryButterfly</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="TemplatesJungle">
	<link rel="stylesheet" type="text/css" href="css/vendor.css">
	<link href="plugins/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	<script src="js/modernizr.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">
	<div id="overlayer">
		<span class="loader">
			<div class="dot dot-1"></div>
			<div class="dot dot-2"></div>
			<div class="dot dot-3"></div>
		</span>
	</div>
	<header class="site-header position-fixed py-1 text-white">
		<nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">

			<div class="container-fluid">

				<a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" class="logo"
						id="logo-img" /><span id="logo-text">Recovery<span
							id="logo-text-color">Butterfly</span></span></a>

				<button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas"
					data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2"
					aria-label="Toggle navigation"><ion-icon name="menu-outline"></ion-icon></button>

				<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
					aria-labelledby="offcanvasNavbar2Label">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
							aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
							<li class="nav-item">
								<a class="nav-link me-4" href="#Home">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="#about">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="#events">Events</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="#latest-stories">Stories</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#"
									role="button" aria-expanded="false">More</a>
								<ul class="dropdown-menu dropdown-menu-dark">
									<li><a href="../view//Project/front_project.php" class="dropdown-item"
											href="#scrollspyHeading3">Projects</a>
									</li>
									<li><a href="blog.html" class="dropdown-item" href="#scrollspyHeading4">FeedBack</a>
									</li>
									<li><a href="contact.html" class="dropdown-item"
											href="#scrollspyHeading5">Reclamtion</a></li>
									<li><a href="single-post.html" class="dropdown-item"
											href="#scrollspyHeading5">Response</a></li>
									<li><a href="styles.html" class="dropdown-item"
											href="#scrollspyHeading5">Products</a></li>
								</ul>
								<?php if($isLoggedIn) { ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle me-4" href="#" id="navbarDropdown" role="button"
										data-bs-toggle="dropdown" aria-expanded="false">
										<?php echo $firstName.' '.$lastName; ?>
									</a>
									<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
										<li class="nav-item">
											<?php if($isAdmin) { ?>
												<a class="nav-link me-4" href="User/dashboard_admin.php">Dashboard</a>
											<?php } else { ?>
												<a class="nav-link me-4" href="User/dashboard_user.php">Dashboard</a>
											<?php } ?>
										</li>
										<li><a href="../controller/User/logout.php" class="dropdown-item">Logout</a></li>
									</ul>
								</li>
							<?php } else { ?>
								<li class="nav-item">
									<a class="btn btn-primary btn-lg rounded-pill" href="User/user.html#signup">Join Us</a>
								</li>
								<li class="nav-item">
									<a class="nav-link me-4" href="User/user.html#signin">Login</a>
								</li>
							<?php } ?>
						</ul>
					</div>

				</div>

			</div>

		</nav>
	</header>
	<section id="Home" class="padding-large jarallax">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="section-title my-5">
						<h2 class="text-white display-2">Let’s make this world <em>a better place</em> for every child
						</h2>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="card card-dark" data-aos="fade-up" data-aos-delay="0">
						<div class="card-body">
							<h3>Sponsor a child</h3>
							<p>Nibh urna, nunc molestie mi id lorem. Dui egestas non dum ut risus augue. Arcu eget a
								donec turpis. </p>
							<a href="#">Learn more</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-dark" data-aos="fade-up" data-aos-delay="300">
						<div class="card-body">
							<h3>Make Donation</h3>
							<p>Quisque montes, convallis lectus massa, in enim ut. Eu consequat at dolor tempor. </p>
							<a href="#">Learn more</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-dark" data-aos="fade-up" data-aos-delay="600">
						<div class="card-body">
							<h3>Start a fundraiser</h3>
							<p>Lacus vitae mauris morbi molestie vulputate per. Metus sollicitudin urna orci sapien
								mattis netus lacus.</p>
							<a href="#">Learn more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<img src="../assets/images/banner.jpg" class="jarallax-img">
	</section>

	<section id="about" class="padding-large">
		<div class="container">
			<div class="row">
				<div class="col-md-7 offset-md-3">
					<header>
						<h2 class="text-center my-5">Condition of these children is <strong>worse than you actually
								think</strong> it is</h2>
					</header>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md-6">
					<blockquote class="blockquote">
						<p>
							The number of children aged 5 to 17 years in hazardous work – defined as work that is likely
							to harm their health, safety or morals – has risen by 6.5 million to 79 million since 2016.
						</p>
						<cite class="mb-5">UNICEF/ILO joint publication</cite>
					</blockquote>
				</div>
				<div class="col-md-6"
					style="background: url('images/veronika-jorjobert-27w3ULIIJfI-unsplash.jpg');background-size: cover;">
				</div>
			</div>
		</div>
	</section>

	<section id="mission" class="padding-large no-padding-top">
		<div class="container">
			<div class="row mt-5">
				<div class="col-md-3">
					<div class="chart-box d-flex flex-wrap text-start" data-aos="fade-zoom-in" data-aos-delay="0">
						<div class="chart" style="max-width: 180px;margin-bottom: 30px;">
							<canvas id="orphans" width="180" height="180"></canvas>
						</div>
						<div>
							<h3>Orphans</h3>
							<p>An estimated 153 million children worldwide are orphans (UNICEF)</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="chart-box d-flex flex-wrap text-start" data-aos="fade-zoom-in" data-aos-delay="300">
						<div class="chart" style="max-width: 180px;margin-bottom: 30px;">
							<canvas id="labor" width="180" height="180"></canvas>
						</div>
						<div>
							<h3>Child Labor</h3>
							<p>Worldwide, there are 168 million child laborers, accounting for almost 11% of children
								(ILO)</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="chart-box d-flex flex-wrap text-start" data-aos="fade-zoom-in" data-aos-delay="600">
						<div class="chart" style="max-width: 180px;margin-bottom: 30px;">
							<canvas id="education" width="180" height="180"></canvas>
						</div>
						<div>
							<h3>Education </h3>
							<p>263 million children and youth are out of school (UNESCO)</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="chart-box d-flex flex-wrap text-start" data-aos="fade-zoom-in" data-aos-delay="900">
						<div class="chart" style="max-width: 180px;margin-bottom: 30px;">
							<canvas id="health" width="180" height="180"></canvas>
						</div>
						<div>
							<h3>Health</h3>
							<p>In 2017, 75% of malnourished children lived in less developed regions (WHO)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="mission" class="bg-grey padding-large">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<header class="text-center my-5">
						<span class="text-muted">know more</span>
						<h2><strong>About Help Children Organization</strong></h2>
					</header>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4" data-aos="fade-zoom-in" data-aos-delay="300">
					<h3>About HCO</h3>
					<p>Lacus vitae mauris morbi molestie vulputate lorem semper. Metus sollicitudin urna orci sapien
						mattis netus lacus.</p>
					<a href="#" class="btn-link">Read more</a>
				</div>
				<div class="col-md-4" data-aos="fade-zoom-in" data-aos-delay="600">
					<h3>About HCO</h3>
					<p>Lacus vitae mauris morbi molestie vulputate lorem semper. Metus sollicitudin urna orci sapien
						mattis netus lacus.</p>
					<a href="#" class="btn-link">Read more</a>
				</div>
				<div class="col-md-4" data-aos="fade-zoom-in" data-aos-delay="900">
					<h3>About HCO</h3>
					<p>Lacus vitae mauris morbi molestie vulputate lorem semper. Metus sollicitudin urna orci sapien
						mattis netus lacus.</p>
					<a href="#" class="btn-link">Read more</a>
				</div>
			</div>
		</div>
	</section>

	<section id="events" class="padding-large">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<header class="text-center my-5">
						<span class="text-muted">Join us</span>
						<h2><strong>Events & Programs</strong></h2>
					</header>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-8">
					<ol class="list-group list-group-flush" data-aos="fade-zoom-in">
						<li class="list-group-item d-flex justify-content-between align-items-start py-4">
							<div class="ms-2 me-5 text-uppercase">
								<span>Sat, Sep 25</span>
							</div>
							<div class="ms-2 me-auto">
								<div class="fw-bold">September Low-Cost Clinic</div>
								<span class="text-muted">Help Children Save Lives</span>
							</div>
							<a href="#" class="btn btn-primary rounded-pill">Learn more</a>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start py-4">
							<div class="ms-2 me-5 text-uppercase">
								<span>Fri, Oct 01</span>
							</div>
							<div class="ms-2 me-auto">
								<div class="fw-bold">October Free Clinic</div>
								<span class="text-muted">Help Children Save Lives</span>
							</div>
							<a href="#" class="btn btn-primary rounded-pill">Learn more</a>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start py-4">
							<div class="ms-2 me-5 text-uppercase">
								<span>Fri, Oct 02</span>
							</div>
							<div class="ms-2 me-auto">
								<div class="fw-bold">Monthly Dental Checkup</div>
								<span class="text-muted">Help Children Save Lives</span>
							</div>
							<a href="#" class="btn btn-primary rounded-pill">Learn more</a>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section id="latest-stories" class="pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<header class="text-center my-5">
						<span class="text-muted">Read our</span>
						<h2><strong>News & Stories</strong></h2>
					</header>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row justify-content-evenly">
				<div class="post-item col">
					<figure class="zoom-effect">
						<a href="#" class="zoom-in">
							<img src="../assets/images/post-thumb-1.jpg" alt="stories" class="lgpostImg">
						</a>
					</figure>
					<a href="single-post.html" class="post-title">Take Your Jeans From Sunday Brunch To A Monday Work
						Meeting</a>
				</div>
				<div class="post-item col">
					<figure class="zoom-effect">
						<a href="#" class="zoom-in"><img src="../assets/images/post-thumb-2.jpg" alt="stories"
								class="lgpostImg"></a>
					</figure>
					<a href="single-post.html" class="post-title">How To Wear Your 501 Jeans For Every Occasion</a>
				</div>
				<div class="post-item col">
					<figure class="zoom-effect">
						<a href="#" class="zoom-in"><img src="../assets/images/post-thumb-3.jpg" alt="stories"
								class="lgpostImg"></a>
					</figure>
					<a href="single-post.html" class="post-title">Going To The Grocery Store Has Never Looked So
						Good</a>
				</div>
				<div class="post-item col">
					<figure class="zoom-effect">
						<a href="#" class="zoom-in"><img src="../assets/images/post-thumb-4.jpg" alt="stories"
								class="lgpostImg"></a>
					</figure>
					<a href="single-post.html" class="post-title">Going To The Grocery Store Has Never Looked So
						Good</a>
				</div>
				<div class="post-item col">
					<figure class="zoom-effect">
						<a href="#" class="zoom-in"><img src="../assets/images/post-thumb-4.jpg" alt="stories"
								class="lgpostImg"></a>
					</figure>
					<a href="single-post.html" class="post-title">Going To The Grocery Store Has Never Looked So
						Good</a>
				</div>
			</div>
		</div>
	</section>

	<section id="donate" class="cta jarallax padding-large text-white">
		<div class="container">
			<div class="row justify-content-center">

				<div class="section-title justify-content-between col-md-5 mt-5">
					<header>
						<h2><strong>Sponsor a Child</strong></h2>
						<p class="text-white">Nibh urna, nunc molestie mi id lorem. Dui egestas non adipiscing interdum
							ut risus augue. Arcu eget a donec turpis. </p>
					</header>
					<button class="btn btn-primary btn-lg rounded-pill">Donate</button>
				</div>

			</div>
		</div>
		<img src="../assets/images/banner.jpg" class="jarallax-img" />
	</section>

	<footer class="padding-large text-white bg-dark">
		<div class="container">
			<div class="row">

				<div class="col-12 col-md-6">
					<span id="logo-text">Recovery<span id="logo-text-color">Butterfly</span></span>

					<ul class="justify-content-start list-unstyled d-flex">
						<li><a href="#" class="nav-link"><ion-icon name="logo-facebook"></ion-icon></a></li>
						<li><a href="#" class="nav-link"><ion-icon name="logo-instagram"></ion-icon></a></li>
						<li><a href="#" class="nav-link"><ion-icon name="logo-skype"></ion-icon></a></li>
						<li><a href="#" class="nav-link"><ion-icon name="logo-pinterest"></ion-icon></a></li>
						<li><a href="#" class="nav-link"><ion-icon name="logo-whatsapp"></ion-icon></a></li>
					</ul>
				</div>

				<div class="col-4 col-md-2">
					<ul class="nav flex-column">
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Facebook</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Twitter</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Instagram</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Pinterest</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">YouTube</a></li>
					</ul>
				</div>

				<div class="col-4 col-md-2">
					<ul class="nav flex-column">
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Home</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Features</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Pricing</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">About</a></li>
					</ul>
				</div>

				<div class="col-4 col-md-2">
					<ul class="nav flex-column">
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Home</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Features</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">Pricing</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
						<li class="nav-item mb-2"><a href="#" class="nav-link p-0">About</a></li>
					</ul>
				</div>
			</div>


		</div>
	</footer>

	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script src="plugins/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>

</body>

</html>