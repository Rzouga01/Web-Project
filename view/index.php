<?php
include '../controller/Event/EventC.php';
require_once '../model/Event/Event.php';
include '../controller/Event/ParticipationC.php';
require_once '../model/Event/Participation.php';
$eventC = new EventC();
if (isset($_REQUEST['search-btn'])) {
	$listevents = $eventC->searchform($_POST['search']);
} else
	$listevents = $eventC->Afficher();
session_start();

$isLoggedIn = isset($_SESSION['username']);

if ($isLoggedIn) {
	$username = $_SESSION['username'];
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
	$isAdmin = $_SESSION['role'] == '0';
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

	<link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">

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

				<a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" class="logo" id="logo-img" /><span id="logo-text">Recovery<span id="logo-text-color">Butterfly</span></span></a>

				<button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation"><ion-icon name="menu-outline"></ion-icon></button>

				<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
								<a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
								<ul class="dropdown-menu dropdown-menu-dark">
									<li><a href="Project/front_project.php" class="dropdown-item">Projects</a>
									</li>
									<li><a href="Product/front_product.php" class="dropdown-item">Products</a></li>
								</ul>
								<?php if ($isLoggedIn) { ?>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle me-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<?php echo $firstName . ' ' . $lastName; ?>
								</a>
								<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
									<li class="nav-item">
										<?php if ($isAdmin) { ?>
											<a class="nav-link me-4" href="User/dashboard_admin.php">Dashboard</a>
										<?php } else { ?>
											<a class="nav-link me-4" href="User/dashboard_user.php">Dashboard</a>
										<?php } ?>
									</li>
									<li><a href="Reclamation/front_reclamation.php" class="dropdown-item">Reclamtion</a>
									</li>
									<li><a href="Reponse/front_reponse.php" class="dropdown-item">Response</a></li>
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

							<p>Brighten a child's future by sponsoring education, nourishment, and hope. Your support breaks the cycle of poverty, empowering children to thrive. Join us in making a lasting impact and creating a brighter tomorrow!</p>

						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-dark" data-aos="fade-up" data-aos-delay="300">
						<div class="card-body">
							<h3>Make Donation</h3>

							<p>Empower change effortlessly with our user-friendly platform. Whether you're passionate about disaster relief, community projects, or global initiatives, your donation reaches where it's needed most. Join us in making the world a better place!</p>

						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-dark" data-aos="fade-up" data-aos-delay="600">
						<div class="card-body">
							<h3>Start a fundraiser</h3>

							<p>Turn your passion into action with us, addressing local or global needs. Join us as a catalyst for positive change, making a lasting impact on the issues that matter most to you and your communities.</p>

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
				<div class="col-md-6" style="background: url('images/veronika-jorjobert-27w3ULIIJfI-unsplash.jpg');background-size: cover;">
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
						<span class="text-muted">know more About</span>
						<h2><strong>Recovery<span style="color: #F4BE37;">Butterfly</span></strong></h2>
					</header>
				</div>
			</div>
			<div class="row">
				<center>
					<div class="col-md-4" data-aos="fade-zoom-in" data-aos-delay="300">
						<p>Discover the mission of <em>Recovery Butterfly</em>, a charity symbolizing resilience and hope. Join us in the narrative of healing, where every story reflects the strength within us. Your support transforms lives and shapes a brighter future.</p>

					</div>
				</center>

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
			<center>
				<div class="search-container">
					<form method="POST">
						<input type="text" class="search-bar" name="search" placeholder="Search...">

						<button name="search-btn" type="submit" class="search-btn">Search</button>
					</form>
				</div>
			</center>
			<br>
			<div class="col-md-12">
				<div class="filters-content">
					<div class="row grid">
						<?php $events_per_page = 3; // set number of films per page
						$total_events = count($listevents);
						$total_pages = ceil($total_events / $events_per_page);
						$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
						$start = ($page - 1) * $events_per_page;
						$events_on_page = array_slice($listevents, $start, $events_per_page);
						foreach ($events_on_page as $key) { ?>
							<div class="col-lg-4 col-md-4 all des">
								<div class="product-item">
									<a href="DetailsEvent.php"><img src="../assets/images/event.png" width="150" height="200" alt=""></a>
									<div class="down-content">
										<a href="">
											<h4>
												<?php echo $key['Event_name'] ?>
											</h4>
										</a>
										<h6>type :
											<?php echo $key['Event_type'] ?>
										</h6>
										<p>
											<?php echo $key['Event_description'] ?>
										</p>

										<span>
											<?php echo $key['Event_date'] ?>
										</span>
										<br>

										<?php $partC = new ParticipationC();
										$currentDateTime = new DateTime();
										$check = $partC->Check(1, $key['ID_Event']);
										$eventDateTime = DateTime::createFromFormat('Y-m-d', $key['Event_date']);


										if ($eventDateTime < $currentDateTime) { ?>
											<span>Event already finished</span>
										<?php } else if ($check == 0) { ?>
											<a class="btn btn-primary btn-lg rounded-pill" href="participer.php?id=<?php echo $key['ID_Event'] ?>">Participer</a>
										<?php } else { ?>
											<span>You have already participated </span>

										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
					<center>
						<div class="pagination-container">

							<ul class="pagination">
								<?php
								// display pagination links
								for ($i = 1; $i <= $total_pages; $i++) {
									$active = ($i == $page) ? "active" : "";
									echo "<li><a class='pagination-link $active' href='Event/Frontend/ListEvents.php?page=$i'>$i</a></li>";
								}
								?>
							</ul>
						</div>
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
						<p style="color: white;">Brighten a child's future by sponsoring education, nourishment, and hope. Your support breaks the cycle of poverty, empowering children to thrive. Join us in making a lasting impact and creating a brighter tomorrow!</p>
					</header>
					<button class="btn btn-primary btn-lg rounded-pill">Donate</button>
				</div>

			</div>
		</div>
		<img src="../assets/images/banner.jpg" class="jarallax-img" />
	</section>


	<footer class="padding-large text-white bg-dark">
		<center>
			<div class="container">
				<div class="row">

					<div>
						<span id="logo-text" style="font-size: 70px;">&copy Recovery<span id="logo-text-color">Butterfly</span></span>
					</div>

				</div>
		</center>
	</footer>


	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script src="plugins/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>

</body>

</html>