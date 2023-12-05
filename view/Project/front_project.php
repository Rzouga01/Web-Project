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
require_once "../../controller/Project/ProjectC.php";
?>

<head>
    <title>Our Projects</title>

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
    <script src="../js/modernizr.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

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

                <a class="navbar-brand" href="../index.php"><img src="../../../assets/images/logo.png" class="logo" id="logo-img" /><span id="logo-text">Recovery<span id="logo-text-color">Butterfly</span></span></a>

                <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation"><ion-icon name="menu-outline"></ion-icon></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link me-4" href="../../index.html">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link me-4" href="../../Type/dashboard_type.php">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a href="../view//Project/front_project.php" class="dropdown-item" href="#scrollspyHeading3">Projects</a>
                                    </li>
                                    <li><a href="blog.html" class="dropdown-item" href="#scrollspyHeading4">FeedBack</a>
                                    </li>
                                    <li><a href="contact.html" class="dropdown-item" href="#scrollspyHeading5">Reclamtion</a></li>
                                    <li><a href="single-post.html" class="dropdown-item" href="#scrollspyHeading5">Response</a></li>
                                    <li><a href="styles.html" class="dropdown-item" href="#scrollspyHeading5">Products</a></li>
                                </ul>
                            </li>
                            <?php if ($isLoggedIn) { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle me-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $firstName . ' ' . $lastName; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                        <li class="nav-item">
                                            <a class="nav-link me-4" href="Type/dashboard_type.php">Dashboard</a>
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
                <div class="col-md-6 offset-md-3">
                    <header class="text-center my-5">
                        <span class="text-muted">Donate</span>
                        <h2><strong>Our Projects</strong></h2>
                    </header>
                </div>
                <div class="col-md-12">
                    <table class="table-project">
                        <?php
                        $projectC = new ProjectC();
                        $projects = $projectC->read_project();

                        if (!empty($projects) && (is_iterable($projects) || is_object($projects))) {
                            echo "<tr><th>Name</th><th>Description</th><th >Start Date</th><th>Goal</th><th>Collected</th><th class='percentage-header' >Percentage</th><th>Organization</th><th>Type</th></tr>";
                            foreach ($projects as $project) {

                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($project['Project_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['Project_description']) . "</td>";
                        ?>
                                <td id="start_date" class="start-date">
                                    <?php echo htmlspecialchars($project['start_date']); ?>
                                </td>

                                <?php
                                echo "<td>" . number_format(htmlspecialchars($project['Goal']), 0, '', ' ') . " " . '<span class="currency">TND</span>' . "</td>";
                                echo "<td>" . number_format(htmlspecialchars($project['Current_amount']), 0, '', ' ') . " " . '<span class="currency">TND</span>' . "</td>";
                                ?>

                                <td class="progress-bar-container">
                                    <div class="full-bar">
                                        <div class="progress-bar" style="width: <?php echo htmlspecialchars($project['Percentage']) ?>%;"></div>
                                        <p class="percentage-number"><?php echo number_format($project['Percentage'], 2); ?>%</p>
                                    </div>
                                </td>

                        <?php
                                $db = config::getConnexion();

                                $r = "SELECT * FROM organization WHERE ID_Org=" . $project['ID_Org'] . "";
                                $org = $db->query($r);
                                $org = $org->fetch();
                                echo "<td>" . htmlspecialchars($org['Org_name']) . "</td>";


                                $r = "SELECT Type_name FROM type WHERE ID_Type=" . $project['ID_Type'] . "";
                                $type = $db->query($r);

                                $type_name = $type->fetch();
                                echo "<td>" . htmlspecialchars($type_name['Type_name']) . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Projects found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

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

    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../plugins/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/script.js"></script>

</body>

</html>