<?php
include('../../controller/Donation/DonationC.php');

$donationC = new DonationC();
$donationStats = $donationC->getDonationStats();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        #donationChart {
            width: 100%;
            margin: auto;
        }
    </style>
</head>


<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">
    <div class="container">
        <nav class="navbar">
            <ul>
                <li>
                    <a href="../index.php" class="logo">
                        <img src="../../assets/images/logo.png" alt="">
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li><a href="../index.php">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Home</span>
                    </a></li>
                <li><a href="../User/dashboard_admin.php?showProfile=true.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
                <li><a href="../User/dashboard_admin.php">
                        <i class="fas fa-users"></i>
                        <span class="nav-item">Users</span>
                    </a></li>
                <li><a href="../Type/dashboard_type.php">
                        <i class="fa fa-list"></i>
                        <span class="nav-item">Types</span>
                    </a></li>
                <li><a href="../Project/dashboard_project.php">
                        <i class="fa fa-database"></i>
                        <span class="nav-item">Project</span>
                    </a></li>
                <li><a href="../Category/dashboard_category.php">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="nav-item">Reclamation</span>
                    </a></li>
                <li><a href="../Reponse/dashboard_reponse.php">
                        <i class="fa fa-envelope-open"></i>
                        <span class="nav-item">Response</span>
                    </a></li>
                <li><a href="#">
                        <i class="fa fa-comments"></i>
                        <span class="nav-item">Feedback</span>
                    </a></li>
                <li><a href="dashboard_category.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Category</span>
                    </a></li>
                <li><a href="../Product/dashboard_product.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                </a></li>
                <li><a href="../Donation/showDonation.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Donation</span>
                    </a></li>
                <li><a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a></li>

            </ul>
        </nav>

        </header>
        <section id="Home" class="padding-large jarallax">
            <div class="container">
                <div class="row">
                    <h1>Donation Statistics</h1>
                    <div id="donationChart"></div>
                    <script type="text/javascript">
                        google.charts.load("current", { "packages": ["corechart"] });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = new google.visualization.DataTable();
                            data.addColumn("string", "Project");
                            data.addColumn("number", "Total Amount");
                            data.addRows([
                                <?php
                                foreach ($donationStats as $stat) {
                                    echo '["Project ' . $stat['id_project'] . '", ' . $stat['total_amount'] . '],';
                                }
                                ?>
                            ]);

                            var options = {
                                title: "Donation Statistics",
                                hAxis: {
                                    title: "Project",
                                    titleTextStyle: {
                                        color: "#333"
                                    }
                                },
                                vAxis: {
                                    minValue: 0
                                }
                            };

                            var chart = new google.visualization.ColumnChart(document.getElementById("donationChart"));
                            chart.draw(data, options);
                        }
                    </script>
                </div>
            </div>
        </section>
    </div>
</body>

</html>