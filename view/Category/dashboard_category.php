<!DOCTYPE html>
<html lang="en">

<?php
require "../../controller/Category/categoryC.php";
?>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
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
                <li><a href="../Reclamation/dashboard_reclamation.php">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="nav-item">Reclamation</span>
                    </a></li>
                <li><a href="../Reponse/dashboard_reponse.php">
                        <i class="fa fa-envelope-open"></i>
                        <span class="nav-item">Response</span>
                    </a></li>
                    <li><a href="../Event/Backend/back.php">
                            <i class="fa fa-comments"></i>
                            <span class="nav-item">Event</span>
                        </a></li>
                <li><a href="dashboard_category.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Category</span>
                    </a></li>
                <li><a href="../Product/dashboard_product.php">
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
                    <h3>Categories List</h3>
                    <table class="table table-bordered">
                        <?php
                        $category = new CategoryC();
                        $categories = $category->read();

                        if (!empty($categories) && (is_iterable($categories) || is_object($categories))) {
                            echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Actions</th></tr>";
                            foreach ($categories as $category) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($category['ID_Category']) . "</td>";
                                echo "<td>" . htmlspecialchars($category['Category_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($category['Category_description']) . "</td>";
                                echo "<td>";
                                echo "<button onclick=\"openEditModal(" . $category['ID_Category'] . ", '" . $category['Category_name'] . "', '" . $category['Category_description'] . "')\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $category['ID_Category'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Categories found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="createType()">Add a Category</button>
                </div>
            </div>

        </section>

        <!-- Edit Modal -->
        <!-- Edit Modal -->
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
                                <td><label for="new-type-description">New Description</label></td>
                                <td>
                                    <textarea id="new-type-description" name="new-type-description"
                                        class="description"></textarea>
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

        <!-- Add Modal -->
        <div id="AddModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeAddModal()">&times;</span>
                <div class="container">
                    <form id="AddForm" onsubmit="event.preventDefault(); addType();">
                        <table>
                            <tr>
                                <td><label for="type-name">Category Name</label></td>
                                <td><input type="text" id="type-name" name="type-name"></td>
                            </tr>
                            <tr>
                                <td><label for="type-description">Category Description</label></td>
                                <td>
                                    <textarea id="type-description" name="type-description"
                                        class="description"></textarea>
                                </td>
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
        // DELETE TYPE MODAL
        function confirmDelete(id) {
            var userConfirmed = confirm('Are you sure you want to delete type with ID ' + id + '?');
            if (userConfirmed) {
                Delete(id);
            }
        }


        function Delete(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Category/category_delete.php", true);
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
            var typeName = document.getElementById("type-name");
            var typeDescription = document.getElementById("type-description");

            if (typeDescription.value === "" || typeDescription.value.length > 20) {
                alert("Category Description should not be empty and should not exceed 20 characters.");
                typeDescription.style.border = "1px solid red";
                return;
            } else {
                typeDescription.style.border = "1px solid green";
            }

            if (typeName.value === "" || typeName.value.length > 20) {
                alert("Category Name should not be empty and should not exceed 20 characters.");
                typeName.style.border = "1px solid red";
                return;
            } else {
                typeName.style.border = "1px solid green";
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Category/category_create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    closeAddModal();
                    location.reload();
                }
            };
            xhttp.send("type-name=" + encodeURIComponent(typeName.value) + "&type-description=" + encodeURIComponent(typeDescription.value));
        }





        // EDIT TYPE MODAL
        function closeEditModal() {
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
        }

        function openEditModal(id, name, description) {
            var modal = document.getElementById("editModal");
            modal.style.display = "block";


            document.getElementById("edit-type-id").value = id;
            document.getElementById("new-type-name").value = name;
            document.getElementById("new-type-description").value = description;



        }

        function editType() {

            var id = document.getElementById("edit-type-id").value;

            var categoryName = document.getElementById("new-type-name");
            var categoryDescription = document.getElementById("new-type-description");


            if (categoryDescription.value === "" || categoryDescription.value.length > 20) {
                alert("Category Description should not be empty and should not exceed 20 characters.");
                categoryDescription.style.border = "1px solid red";
                return; // Exit the function if conditions are not met
            } else {
                categoryDescription.style.border = "1px solid green";
            }

            if (categoryName.value === "" || categoryName.value.length > 20) {
                alert("Category Name should not be empty and should not exceed 20 characters.");
                categoryName.style.border = "1px solid red";
                return; // Exit the function if conditions are not met
            } else {
                categoryName.style.border = "1px solid green";
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Category/category_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    closeEditModal();
                    location.reload();
                }
            };
            xhttp.send("id=" + encodeURIComponent(id) + "&name=" + encodeURIComponent(typeName.value) + "&description=" + encodeURIComponent(typeDescription.value));
        }
    </script>

</body>

</html>
</script>

</body>

</html>