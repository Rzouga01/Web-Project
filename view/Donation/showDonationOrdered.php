<?php
include('../../controller/Donation/DonationC.php');

$donC = new DonationC();
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
	<style>
		.actionBtn {
			display: flex;
			align-items: center;
			justify-content: space-evenly;
			justify-items: center;
		}

		.headerTable {
			padding: 9px;
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
					<div class="col-md-7">
						<div class="section-title my-5">
							<a href="showDonation.php" class="btn btn-primary btn-lg rounded-pill">Donation</a>
							<a href="statsDonation.php" class="btn btn-primary btn-lg rounded-pill">Stats</a>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="donations">
							<div class="card">
								<i class="fas fa-donations"></i>
								<h3>Donation list</h3>
								<div class="actions-container">

									<div class="search-container">
										<i class="fa fa-search"></i> <input type="text" class="search-input" id="searchInput" placeholder="Search..." oninput="search()">
									</div>
								</div>

								<?php if (!empty($donations)) { ?>
									<table class="table table-bordered">
										<tr>
											<th class="headerTable">Donation Reference</th>
											<th class="headerTable">ID User</th>
											<th class="headerTable">ID Project</th>
											<th class="headerTable">Amount</th>
											<th class="headerTable">Actions</th>
										</tr>
										<?php foreach ($donations as $donation) : ?>
											<tr>
												<td align="center"><?= htmlspecialchars($donation['Ref_Donation']) ?></td>
												<td align="center"><?= htmlspecialchars($donation['ID_USER']) ?></td>
												<td align="center"><?= htmlspecialchars($donation['ID_Project']) ?></td>
												<td align="center"><?= htmlspecialchars($donation['amount']) ?></td>
												<td class="actionBtn">
													<a href="./updateDonation.php?ref=<?= $donation['Ref_Donation'] ?>" class="btn btn-success">Update</a>
													<a href="./deleteDonation.php?ref=<?= $donation['Ref_Donation'] ?>" class="btn btn-danger">Delete</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								<?php } else {
									echo "No Donations Found";
								} ?>

							</div>
						</div>
					</div>
				</div>
		</section>
	</div>
</body>

</html>