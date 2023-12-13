<?php
include '../../../Controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../Controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';
session_start();
$partC = new ParticipationC();
$listparts = $partC->getByUserId(1);

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

				<a class="navbar-brand" href="index.html"><img src="../assets/images/logo.png" class="logo"
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
							<a class="nav-link me-4" href="../../index.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="#about">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="ListEvents.php">Events</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="#latest-stories">Stories</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="../Backend/back.php">Dashboard</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#"
									role="button" aria-expanded="false">More</a>
								<ul class="dropdown-menu dropdown-menu-dark">
									<li><a href="about.html" class="dropdown-item"
											href="#scrollspyHeading3">Projects</a></li>
									<li><a href="blog.html" class="dropdown-item" href="#scrollspyHeading4">FeedBack</a>
									</li>
									<li><a href="contact.html" class="dropdown-item"
											href="#scrollspyHeading5">Reclamtion</a></li>
									<li><a href="single-post.html" class="dropdown-item"
											href="#scrollspyHeading5">Response</a></li>
									<li><a href="styles.html" class="dropdown-item"
											href="#scrollspyHeading5">Products</a></li>
								</ul>
							</li>
							<li class="nav-item">
								<a class="btn btn-primary btn-lg rounded-pill" href="#">Join Us</a>
							</li>
							<li class="nav-item">
								<a class="nav-link me-4" href="#">Login</a>
							</li>
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
						<h2 class="text-white display-2">Your <em>Upcoming</em> Events
						</h2>
					</div>

				</div>
			</div>
			<div class="row">
                <?php foreach($listparts as $key) { ?>
				<div class="col-md-4">
					<div class="card card-dark" data-aos="fade-up" data-aos-delay="0">
						<div class="card-body">
							<h3><?php $eventC = new EventC();
                            $event = $eventC->getOneById($key['id_event']) ;
                            echo $event['Event_name'] ?></h3>
							<p><?php echo $event['Event_date'] ?> </p>
							<a href="#" onclick="confirmDelete(<?php echo $key['id'] ?>)">Cancel</a>
						
							<a href="sendmail.php?name=<?php echo $event['Event_name']?>" >Get invitation mail</a>
						
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<img src="../assets/images/banner.jpg" class="jarallax-img">
	</section>

	<script>
    function confirmDelete(eventId) {
        var confirmation = confirm("Are you sure you want to delete this Participation?");
        
        if (confirmation) {
            // If the user clicks "OK" in the confirmation popup, proceed with the deletion
            window.location.href = "deleteparc.php?id=" + eventId;
        } else {
            // If the user clicks "Cancel" in the confirmation popup, do nothing
            // You can optionally provide feedback or take other actions here
        }
    }
</script>



	



	

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