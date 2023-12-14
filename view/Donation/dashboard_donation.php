<?php
require_once '../../controller/Donation/DonationC.php';
require_once '../../controller/organization/organizationC.php';

$donC = new DonationC();
$orgC = new organizationC();
$donations = $donC->showDonation();
$donations = $donC->showDonationOrderd();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
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
            </ul>
        </nav>

        </header>
        <section id="Home" class="padding-large jarallax">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="section-title my-5">
                            <h2 class="text-white display-2">Donations <em></em></h2>
                            <a href="showDonation.php" class="btn btn-primary btn-lg rounded-pill">Donations</a>
                            <a href="statsDonation.php" class="btn btn-primary btn-lg rounded-pill">Stats</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-dark" data-aos="fade-up" data-aos-delay="600">
                            <div class="card-body">
                                <form action="ajoutDonation.php" method="post" id="myForm">
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="text" class="form-control" id="amount" name="amount">
                                        <span id="errorAmount"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_project">ID Project:</label>
                                        <select class="form-control" id="id_cat" name="id_project">
                                            <?php
                                            $liste = $orgC->showOrg();
                                            foreach ($liste as $categorie) {
                                                echo "<option value='" . $categorie['id_org'] . "'>" . $categorie['org_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <span id="errorProject"></span>
                                    </div>
                                    <div class="form-group">
                                        <a href="showDonation.php" class="btn btn-secondary">Back</a>
                                        <button class="btn btn-danger btn-lg rounded-pill" type="submit">Delete</button>
                                        <button class="btn btn-success btn-lg rounded-pill"
                                            type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>