<?php
include_once('../../controller/Donation/DonationC.php');
include_once('../../controller/Organization/organizationC.php');
require_once "../../controller/Project/projectC.php";
$orgC = new organizationC();


$projectC = new projectC();
$projects = $projectC->read_project();

$donC = new DonationC();
if (isset($_POST['ref']) && isset($_POST['id_user']) && isset($_POST['amount']) && isset($_POST['id_project'])) {
	$donation = new Donation($_POST['id_user'], $_POST['amount'], $_POST['id_project']);
	$donC->updateDonation($_POST['ref'], $donation);
	header('Location: showDonation.php');
}
$donation = $donC->getDonation($_GET['ref']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>Dashboard</title>
	<link rel="stylesheet" href="../dashboard.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

	<link rel="stylesheet" href="product.css">

	<link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
	<style>
		body {
			font-family: 'Arial', sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f5f5f5;
		}

		#scrollToTopBtn {
			position: fixed;
			bottom: 30px;
			right: 30px;
			background-color: #333;
			color: white;
			border: none;
			border-radius: 5px;
			padding: 10px;
			cursor: pointer;
			display: none;
		}

		#scrollToTopBtn:hover {
			background-color: #555;
		}
	</style>

</head>

<body>
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
				<li><a href="../Product/dashboard_product.php">
						<i class="fa fa-exclamation-triangle"></i>
						<span class="nav-item">Reclamation</span>
					</a></li>
				<li><a href="#">
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

				<li><a href="dashboard_product.php">
						<i class="fa fa-archive"></i>
						<span class="nav-item">Product</span>
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

		<section class="main">
			<div class="users">
				<div class="card">
					<i class="fa fa-archive"></i>
					<form action="updateDonation.php" method="post" id="myForm">
						<table>
							<tr>
								<td><label for="id_user">ID User:</label></td>
								<td><input type="text" id="id_user" name="id_user"
										value="<?php echo $donation['ID_USER']; ?>"></td>
								<td><span id="errorUser"></span></td>
							</tr>
							<tr>
								<td><label for="amount">Amount:</label></td>
								<td><input type="text" id="amount" name="amount"
										value="<?php echo $donation['amount']; ?>"></td>
								<td><span id="errorAmount"></span></td>
							</tr>
							<tr>
								<td><label for="id_project">ID Project:</label>
									<select id="id_project" name="id_project">
										<?php
										foreach ($projects as $project) {
											echo "<option value='{$project['ID_Project']}'>{$project['Project_name']}</option>";
										}
										?>
									</select>
								</td>
								<td><span id="errorProject"></span></td>
							</tr>
							<input type="text" name="ref" value="<?php echo $donation['Ref_Donation']; ?>" hidden>
							<tr>
								<td><a href="showDonation.php">Back</a></td>
								<td><button class="btn btn-primary btn-lg rounded-pill" type="submit">Update</button>
								</td>
							</tr>
						</table>
					</form>
					<script>
						let myForm = document.getElementById('myForm');
						myForm.addEventListener('submit', function (e) {
							let id_user = document.getElementById('id_user');
							let amount = document.getElementById('amount');
							let id_project = document.getElementById('id_project');

							if (id_user.value == "" || !(/^[0-9,]+$/.test(id_user.value))) {
								let error = document.getElementById('errorUser');
								error.innerHTML = "ID User required and must be a number";
								error.style.color = 'red';
								e.preventDefault();
							}
							if (amount.value == "" || !(/^\d+(\.\d+)?$/.test(amount.value))) {
								let error = document.getElementById('errorAmount');
								error.innerHTML = "Amount required and mustn't contains caracters";
								error.style.color = 'red';
								e.preventDefault();
							}
							if (id_project.value == "" || !(/^[0-9,]+$/.test(id_project.value))) {
								let error = document.getElementById('errorProject');
								error.innerHTML = "ID Project required and must be a number";
								error.style.color = 'red';
								e.preventDefault();
							}
						});

					</script>
				</div>
			</div>

		</section>


		<div id="editModal" class="modal" style="display: none;">
			<div class="modal-content">
				<span class="close" onclick="closeEditModal()">&times;</span>
				<div class="container">
					<form id="editForm" method="post" onsubmit="event.preventDefault();editType()">
						<table>
							<tr>
								<input type="hidden" id="edit-type-id" name="edit-type-id" value="">
								<td><label for="new-type-name">New Name</label></td>
								<td><input type="text" id="new-type-name" name="new-type-name"></td>
							</tr>
							<tr>
								<td><label for="new-type-img">New Image</label></td>
								<td><input type="text" id="new-type-img" name="new-type-img"></td>
							</tr>

							<tr>
								<td><label for="new-type-price">New Price</label></td>
								<td><input type="text" id="new-type-price" name="new-type-price"></td>
							</tr>
							<tr>
								<td><label for="new-type-description">New Description</label></td>
								<td>
									<textarea id="new-type-description" name="new-type-description"
										class="description"></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label for="select-product-update">Category</label>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" value="Update" id="button_update"></td>
								<td><input type="reset" value="Reset"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>

		<button id="scrollToTopBtn" onclick="scrollToTop()">Top</button>
		<script>
			function search() {

				searchBar = document.getElementById("search-input");
				filter = searchBar.value.toUpperCase();
				table = document.getElementById("product-tab");
				tr = table.getElementsByTagName("tr");

				for (i = 1; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[1];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
				}



			}

			function confirmDelete(id) {
				var userConfirmed = confirm('Are you sure you want to delete type with ID ' + id + '?');
				if (userConfirmed) {
					Delete(id);
				}
			}


			function Delete(id) {
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "../../controller/Product/product_delete.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						location.reload();
					}
				};
				xhttp.send("id=" + id);
			}




			// ADD TYPE MODAL
			function createType() {
				var modal = document.getElementById("AddModal");
				modal.style.display = "block";
			}

			function closeAddModal() {
				var modal = document.getElementById("AddModal");
				modal.style.display = "none";
			}

			function addType() {
				var name = document.getElementById("product-name");
				var desc = document.getElementById("product-description");
				var image = document.getElementById("product-image");
				var category = document.getElementById("select-product");
				var price = document.getElementById("product-price");


				if (name.value === "" || name.value.length > 20) {
					alert("Product Name should not be empty and should not exceed 20 characters.");
					name.style.border = "1px solid red";
					return;
				} else {
					name.style.border = "1px solid green";
				}



				if (desc.value === "" || desc.value.length > 20) {
					alert("Product Description should not be empty and should not exceed 20 characters.");
					desc.style.border = "1px solid red";
					return;
				} else {
					desc.style.border = "1px solid green";
				}


				if (image.value === "" || image.value.length > 20) {
					alert("Image should not be empty.");
					image.style.border = "1px solid red";
					return;
				} else {
					image.style.border = "1px solid green";
				}

				if (price.value <= 0) {
					alert("price should not be negative.");
					price.style.border = "1px solid red";
					return;
				} else {
					price.style.border = "1px solid green";
				}


				if (!category.value) {
					alert("Select a Category.");
					category.style.border = "1px solid red";
					return;
				} else {
					category.style.border = "1px solid green";
				}







				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "../../controller/Product/product_create.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						closeAddModal();
						location.reload();
					}
				};
				xhttp.send("name=" + encodeURIComponent(name.value) + "&price=" + encodeURIComponent(price.value) + "&description=" + encodeURIComponent(desc.value) + "&image=" + encodeURIComponent(image.value) + "&category=" + encodeURIComponent(category.value));
			}





			// EDIT TYPE MODAL
			function closeEditModal() {
				var modal = document.getElementById("editModal");
				modal.style.display = "none";
			}

			function openEditModal(id, name, description, price, image, category) {
				var modal = document.getElementById("editModal");
				modal.style.display = "block";

				document.getElementById("edit-type-id").value = id;
				document.getElementById("new-type-name").value = name;
				document.getElementById("new-type-description").value = description;
				document.getElementById("new-type-price").value = price;

				var productcategory = document.getElementById("select-product-update");
				for (var i = 0; i < productcategory.options.length; i++) {
					if (productcategory.options[i].value == category) {
						productcategory.options[i].selected = true;
						break;
					}
				}

				document.getElementById("new-type-img").value = image;
			}

			function editType() {
				var id = document.getElementById("edit-type-id").value;
				var productName = document.getElementById("new-type-name");
				var productDescription = document.getElementById("new-type-description");
				var productPrice = document.getElementById("new-type-price");
				var productImage = document.getElementById("new-type-img");
				var productCategory = document.getElementById("select-product-update");

				// Validate productDescription and productName
				if (productDescription.value === "" || productDescription.value.length > 20) {
					alert("Product Description should not be empty and should not exceed 20 characters.");
					productDescription.style.border = "1px solid red";
					return;
				} else {
					productDescription.style.border = "1px solid green";
				}

				if (productName.value === "" || productName.value.length > 20) {
					alert("Product Name should not be empty and should not exceed 20 characters.");
					productName.style.border = "1px solid red";
					return;
				} else {
					productName.style.border = "1px solid green";
				}

				// ... (rest of your code)

				// Use the correct variable names in the send method
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "../../controller/Product/product_update.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						closeEditModal();
						location.reload();
					}
				};
				xhttp.send("id=" + encodeURIComponent(id) + "&name=" + encodeURIComponent(productName.value) + "&price=" + encodeURIComponent(productPrice.value) + "&description=" + encodeURIComponent(productDescription.value) + "&image=" + encodeURIComponent(productImage.value) + "&category=" + encodeURIComponent(productCategory.value));
			}





			// Function to scroll to the top of the page
			function scrollToTop() {
				document.body.scrollTop = 0; // For Safari
				document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
			}

			// Show/hide the button based on scroll position
			window.onscroll = function () {
				showScrollButton();
			};

			function showScrollButton() {
				var btn = document.getElementById("scrollToTopBtn");

				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					btn.style.display = "block";
				} else {
					btn.style.display = "none";
				}
			}
		</script>
		<button id="scrollToTopBtn" onclick="scrollToTop()">up</button>

		<script>
			// Function to scroll to the top of the page
			function scrollToTop() {
				document.body.scrollTop = 0; // For Safari
				document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
			}

			// Show/hide the button based on scroll position
			window.onscroll = function () {
				showScrollButton();
			};

			function showScrollButton() {
				var btn = document.getElementById("scrollToTopBtn");

				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					btn.style.display = "block";
				} else {
					btn.style.display = "none";
				}
			}
		</script>



</body>

</html>