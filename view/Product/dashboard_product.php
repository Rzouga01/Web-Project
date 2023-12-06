<!DOCTYPE html>
<html lang="en">

<?php
require_once "../../controller/Product/productC.php";
require_once "../../controller/Category/categoryC.php"
?>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


</head>

<body>
    <div class="container">
        <nav class="navbar">
            <ul>
                <li>
                    <a href="../index.html" class="logo">
                        <img src="../../assets/images/logo.png" alt="">
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li><a href="../index.html">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Home</span>
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
                <li><a href="dashboard_product.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Product</span>
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
                    <h3>Product List</h3>
                    <table class="table table-bordered">
                        <?php
                        $product = new ProductC();
                        $products = $product->read();

                        if (!empty($products) && (is_iterable($products) || is_object($products))) {
                            echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Category ID</th></tr>";
                            foreach ($products as $product) {


                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($product['ID_Product']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Product_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Product_price']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Product_description']) . "</td>";
                                echo "<td><img src='../image/" . htmlspecialchars($product['image_link']) . "' alt='Image not found'></td>";
                                echo "<td>" . htmlspecialchars($product['ID_Category']) . "</td>";
                                echo "<td>";
                                echo "<button onclick=\"openEditModal(" . $product['ID_Product'] . ", '" . $product['Product_name'] . "', '"  . "', '" . $product['Product_price'] . "')\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $product['ID_Product'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Products found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="createType()">Add a Product</button>
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
                                <input type="hidden" id="edit-type-id" name="edit-type-id" value="">
                                <td><label for="new-type-price">New Price</label></td>
                                <td><input type="text" id="new-type-price" name="new-type-price"></td>
                            </tr>
                            <tr>
                                <td><label for="new-type-description">New Description</label></td>
                                <td>
                                    <textarea id="new-type-description" name="new-type-description" class="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="select-product-update">Category</label>
                                </td>
                                <td>
                                    <select name="select-product-update" id="select-product-update">
                                        <?php
                                        $category = new CategoryC();
                                        $categories = $category->read();
                                        foreach ($categories as $category) {
                                            echo "<option value='" . $category['ID_Category'] . ">" . htmlspecialchars($category['Category_name']) . "</option>";
                                        }
                                        ?>
                                </td>
                                </select>
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

        <!-- Add Modal -->
        <div id="AddModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeAddModal()">&times;</span>
                <div class="container">
                    <form id="AddForm" onsubmit="event.preventDefault(); addType();">
                        <table>
                            <tr>
                                <td><label for="product-name">Product Name</label></td>
                                <td><input type="text" id="product-name" name="product-name"></td>
                            </tr>
                            <tr>
                                <td><label for="product-description">Product Description</label></td>
                                <td>
                                    <textarea id="product-description" name="product-description" class="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="product-image">Product Image</label></td>
                                <td><input type="text" id="product-image" name="product-image"></td>
                            </tr>
                            <tr>
                                <td><label for="product-price">Product Price</label></td>
                                <td><input type="number" id="product-price" name="product-price"></td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="select-product">Category</label>
                                </td>
                                <td>
                                    <select name="select-product" id="select-product">
                                        <?php
                                        $category = new CategoryC();
                                        $categories = $category->read();
                                        foreach ($categories as $category) {
                                            echo "<option value='" . $category['ID_Category'] . ">" . htmlspecialchars($category['Category_name']) . "</option>";
                                        }
                                        ?>
                                </td>
                                </select>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Create" id="button_create">
                                </td>
                                <td>
                                    <input type="reset" value="Reset">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
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
            xhttp.onreadystatechange = function() {
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
            xhttp.onreadystatechange = function() {
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

        function openEditModal(id, name, description, price) {
            var modal = document.getElementById("editModal");
            modal.style.display = "block";


            document.getElementById("edit-type-id").value = id;
            var existingTypeName = name;
            var existingTypeDescription = description;
            var existingTypePrice = price;


        }

        function editType() {

            var id = document.getElementById("edit-type-id").value;

            var typeName = document.getElementById("new-type-name");
            var typeDescription = document.getElementById("new-type-description");
            var typePrice = document.getElementById("new-type-price");



            if (typeDescription.value === "" || typeDescription.value.length > 20) {
                alert("Product Description should not be empty and should not exceed 20 characters.");
                typeDescription.style.border = "1px solid red";
                return; // Exit the function if conditions are not met
            } else {
                typeDescription.style.border = "1px solid green";
            }

            if (typeName.value === "" || typeName.value.length > 20) {
                alert("Product Name should not be empty and should not exceed 20 characters.");
                typeName.style.border = "1px solid red";
                return; // Exit the function if conditions are not met
            } else {
                typeName.style.border = "1px solid green";
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Product/product_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    closeEditModal();
                    location.reload();
                }
            };
            xhttp.send("name=" + encodeURIComponent(name.value) + "&price=" + encodeURIComponent(price.value) + "&description=" + encodeURIComponent(desc.value) + "&image=" + encodeURIComponent(image.value) + "&category=" + encodeURIComponent(category.value));

        }
    </script>

</body>

</html>