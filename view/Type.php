<!DOCTYPE html>
<html lang="en">


<?php
require "../controller/type/typeC.php";
?>

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


    <table>

        <?php
        require "../controller/type/typeC.php";

        $Type = new TypeC();
        $types = $Type->read_type();

        if (!empty($types) && (is_iterable($types) || is_object($types))) {
            echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Actions</th></tr>";
            foreach ($types as $type) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($type['ID_Type']) . "</td>";
                echo "<td>" . htmlspecialchars($type['Type_name']) . "</td>";
                echo "<td>" . htmlspecialchars($type['Type_description']) . "</td>";
                echo "<td>";
                echo "<button onclick=\"openEditModal(" . $type['ID_Type'] . ", '" . $type['Type_name'] . "', '" . $type['Type_description'] . "')\">Edit</button>";
                echo "<button onclick=\"confirmDelete(" . $type['ID_Type'] . ")\">Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No types found</td></tr>";
        }

        ?>
    </table>


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