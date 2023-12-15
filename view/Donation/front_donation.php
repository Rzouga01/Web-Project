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
require_once "../../controller/Donation/DonationC.php";
require_once "../../controller/Project/projectC.php";

$projectC = new projectC();
?>

<head>
  <title>Reclamtion Form</title>

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
  <link rel="stylesheet" href="reclamation.css">

  <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
  <style>

  </style>
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
                <a class="nav-link me-4" href="../index.html">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link me-4" href="../Type/dashboard_type.php">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link me-4 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a href="../Project/front_project.php" class="dropdown-item" href="#scrollspyHeading3">Projects</a>
                  </li>
                  <li><a href="../Reclamation/front_reclamation.php" class="dropdown-item" href="#scrollspyHeading5">Reclamtion</a></li>
                  <li><a href="single-post.html" class="dropdown-item" href="#scrollspyHeading5">Response</a></li>
                  <li><a href="styles.html" class="dropdown-item" href="#scrollspyHeading5">Products</a></li>
                  <li><a href="front_donation.php" class="dropdown-item" href="#scrollspyHeading5">Donations</a></li>
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
                    <li><a href="../../controller/User/logout.php" class="dropdown-item">Logout</a></li>
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

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="container">
    <div class="formDonate">
      <header>
        <h1>Donate</h1>
      </header>
      <form id="donationForm" method="POST" action="../../controller/Donation/ajoutDonation.php" onsubmit="event.preventDefault(); submitDonation();">
        <table>
          <tr>
            <td>
              <?php echo '<input type="hidden" id="id_user" name="id_user" value="' . $_SESSION['user_id'] . '">' ?>
            </td>
          </tr>
          <tr>
            <td>
              <label for="amount">Amount:</label>
            </td>
            <td>
              <input type="text" id="amount" name="amount">
            </td>
          </tr>
          <tr>
            <td>
              <label for="amount">Project:</label>
              <select id="id_project" name="id_project">
                <?php
                $projects = $projectC->read_project();
                foreach ($projects as $project) {
                  echo "<option value='{$project['ID_Project']}'>{$project['Project_name']}</option>";
                }
                ?>
              </select>
          </tr>
          <tr>
            <td>
              <input type="submit" value="Submit Donation">
            </td>
          </tr>
        </table>
      </form>

      <script>
        function submitDonation() {
          var id_user = document.getElementById("id_user").value;
          var amount = document.getElementById("amount").value;
          var id_project = document.getElementById("id_project").value;

          if (id_user.trim() === "" || amount.trim() === "" || id_project.trim() === "") {
            alert("Please fill in all fields.");
            return;
          }

          var formData = new FormData();
          formData.append('id_user', id_user);
          formData.append('amount', amount);
          formData.append('id_project', id_project);

          var xhttp = new XMLHttpRequest();
          xhttp.open("POST", "../../controller/Donation/ajoutDonation.php", true);
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              alert("Donation submitted successfully!");
              window.location.href = "../index.php";
            }
          };
          xhttp.send(formData);
        }
      </script>
    </div>
  </div>

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