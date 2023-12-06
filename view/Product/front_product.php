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
require_once "../../controller/Product/ProductC.php"; // Assuming you have a Product controller
?>

<head>
    <title>Our Products</title>

    <!-- ... (rest of the head section remains unchanged) ... -->

</head>

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">
    <!-- ... (rest of the body section remains unchanged) ... -->

    <section id="Home" class="padding-large jarallax">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <header class="text-center my-5">
                        <span class="text-muted">Explore</span>
                        <h2><strong>Our Products</strong></h2>
                    </header>
                </div>
                <div class="col-md-12">
                    <table class="table-product"> <!-- Change the class to differentiate from project table -->
                        <?php
                        $productC = new ProductC(); // Assuming you have a Product controller
                        $products = $productC->read();

                        if (!empty($products) && (is_iterable($products) || is_object($products))) {
                            echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>Category</th></tr>";
                            foreach ($products as $product) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($product['Product_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Product_description']) . "</td>";
                                echo "<td>" . number_format(htmlspecialchars($product['Price']), 2) . " " . '<span class="currency">TND</span>' . "</td>";
                                echo "<td><img src='" . htmlspecialchars($product['Image_link']) . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";

                                // Assuming you have a Category table and a foreign key in the Product table
                                $r = "SELECT Category_name FROM category WHERE ID_Category=" . $product['ID_Category'] . "";
                                $category = $db->query($r);
                                $category_name = $category->fetch();
                                echo "<td>" . htmlspecialchars($category_name['Category_name']) . "</td>";

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

</body>

</html>
