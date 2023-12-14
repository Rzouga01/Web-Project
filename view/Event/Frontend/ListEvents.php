<?php 
include '../../../controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';


$eventC = new EventC();
if(isset($_REQUEST['search-btn']))
{
	$listevents=$eventC->searchform($_POST['search']);
}else
$listevents= $eventC->Afficher();

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
								<a class="nav-link me-4" href="#events">Events</a>
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
									<li><a  class="dropdown-item" href="MesParticipation.php?id=1">My Participations</a>
									</li>
									<li><a href="../Reclamation/front_reclamation.php" class="dropdown-item"
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
	<style>
   

    .search-container {
      position: relative;
    }

    .search-bar {
      width: 300px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      outline: none;
    }

    .search-icon {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 10px;
      color: #aaa;
    }

    .search-bar:focus + .search-icon,
    .search-bar:valid + .search-icon {
      color: #333;
    }

    .search-bar:focus,
    .search-bar:valid {
      border: 2px solid #FAD02C;
    }

    .search-btn {
      background-color: #FAD02C;
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-btn:hover {
      background-color: #2980b9;
    }
  </style>
	<section id="events" class="padding-large">
		<div class="container">
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
        <?php  $events_per_page = 3; // set number of films per page
                $total_events = count($listevents);
                $total_pages = ceil($total_events / $events_per_page);
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $start = ($page - 1) * $events_per_page;
                $events_on_page = array_slice($listevents, $start, $events_per_page); 
   foreach ($events_on_page as $key) { ?>
                    <div class="col-lg-4 col-md-4 all des">
                      <div class="product-item">
                        <a href="DetailsEvent.php"><img src="assets/images/event.png" width="150" height="200" alt=""></a>
                        <div class="down-content">
                          <a href=""><h4><?php echo $key['Event_name'] ?></h4></a>
                          <h6>type : <?php echo $key['Event_type'] ?></h6>
                          <p><?php echo $key['Event_description'] ?></p>
                          
                          <span><?php echo $key['Event_date'] ?></span>
						  <br>

						  <?php $partC = new ParticipationC();
						  $currentDateTime = new DateTime();
						  $check=$partC->Check(1,$key['ID_Event']);
						  $eventDateTime = DateTime::createFromFormat('Y-m-d', $key['Event_date']);
				

						  if($eventDateTime<$currentDateTime)
						  {  ?> 
						  <span>Event already finished</span>
                        <?php }
						
						 
						  else if($check == 0) { ?>
						  <a class="btn btn-primary btn-lg rounded-pill" href="participer.php?id=<?php echo $key['ID_Event']?>">Participer</a>
						  <?php } else { ?>
                        <span>You have already participated </span>
						
						<?php } ?>
                        </div>
                      </div>
                    </div>
                 <?php } ?> 
			
                 </div>
				 <center>
<div class="pagination-container" >
  <style>
      ul.pagination {
  display: inline-block;
  list-style-type: none;
  margin: 0;
  padding: 0;
  border: 1px solid #666;
  border-radius: 5px;
}

ul.pagination li {
  display: inline-block;
}

ul.pagination li a {
  display: block;
  padding: 5px 10px;
  text-decoration: none;
  color: white;
  background-color: #8B0000;
}

ul.pagination li a.active {
  background-color: #666;
}


    </style>
<ul class="pagination">
  <?php 
    // display pagination links
    for ($i = 1; $i <= $total_pages; $i++) {
      $active = ($i == $page) ? "active" : "";
      echo "<li><a class='pagination-link $active' href='ListEvents.php?page=$i'>$i</a></li>";
    }
  ?>
</ul>
</div>
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
