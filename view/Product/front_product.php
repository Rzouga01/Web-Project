<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);

if ($isLoggedIn) {
    $username = $_SESSION['username'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once "../../controller/Product/productC.php"; // Assuming you have a Product controller
require_once "../../database/connect.php";
?>


<head>
    <title>Our Products</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="TemplatesJungle">
    <link rel="stylesheet" type="text/css" href="../css/vendor.css">
    <link href="../plugins/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="../js/modernizr.js"></script>


    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
    <!-- ... (rest of the head section remains unchanged) ... -->

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">
    <div id="overlayer">
        <span class="loader">
            <div class="dot dot-1"></div>
            <div class="dot dot-2"></div>
            <div class="dot dot-3"></div>
        </span>
    </div>
    <header class="site-header position-fixed py-1 text-white" style="background: #092035;">
        <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">

            <div class="container-fluid">

                <a class="navbar-brand" href="../index.php"><img src="../../assets/images/logo.png" class="logo" id="logo-img" /><span id="logo-text">Recovery<span id="logo-text-color">Butterfly</span></span></a>

                <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation"><ion-icon name="menu-outline"></ion-icon></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link me-4" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a href="../Project/front_project.php" class="dropdown-item" href="#scrollspyHeading3">Projects</a>
                                    </li>
                                    <li><a href="../Reclamation/front_reclamation.php" class="dropdown-item" href="#scrollspyHeading5">Reclamtion</a></li>
                                    <li><a href="single-post.html" class="dropdown-item" href="#scrollspyHeading5">Response</a></li>
                                    <li><a href="../Product/front_product.php" class="dropdown-item" href="#scrollspyHeading5">Products</a></li>
                                </ul>
                            </li>
                            <?php if ($isLoggedIn) { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle me-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $firstName . ' ' . $lastName; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                        <li class="nav-item">
                                            <a class="nav-link me-4" href="../Type/dashboard_type.php">Dashboard</a>
                                        </li>
                                        <li><a href="../controller/User/logout.php" class="dropdown-item">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-lg rounded-pill" href="../User/user.html#signup">Join Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-4" href="../User/user.html#signin">Login</a>
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
                <div class="col-md-6 offset-md-3">
                    <header class="text-center my-5">
                        <span class="text-muted">View</span>
                        <h2><strong>Our Products</strong></h2>
                    </header>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <?php

                        $db = config::getConnexion();
                        $productC = new ProductC(); // Assuming you have a Product controller
                        $products = $productC->read();

                        if (!empty($products) && (is_iterable($products) || is_object($products))) {
                            echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>Category</th></tr>";
                            foreach ($products as $product) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($product['Product_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Product_description']) . "</td>";
                                echo "<td>" . number_format(htmlspecialchars($product['Product_price']), 2) . " " . '<span class="currency">TND</span>' . "</td>";
                                echo "<td><img src='images/" . htmlspecialchars($product['image_link']) . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";

                                // Assuming you have a Category table and a foreign key in the Product table
                                $r = "SELECT Category_name FROM category WHERE ID_Category=" . $product['ID_Category'] . "";
                                $category = $db->query($r);
                                $category_name = $category->fetch();

                                echo "<td>" . htmlspecialchars($category_name["Category_name"]) . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Products found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- ... (rest of the HTML remains unchanged) ... -->
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
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../plugins/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>