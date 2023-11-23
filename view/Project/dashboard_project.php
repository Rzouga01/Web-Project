<!DOCTYPE html>
<html lang="en">

<?php
require "../../controller/Project/ProjectC.php";
?>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="project.css">
</head>

<body>
    <div class="container">
        <nav class="navbar">
            <ul>
                <li>
                    <a href="#" class="logo">
                        <img src="../../assets/images/logo.png" alt="">
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li><a href="../index.html">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Home</span>
                    </a></li>
                <li><a href="">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
                <li><a href="">
                        <i class="fas fa-users"></i>
                        <span class="nav-item">Users</span>
                    </a></li>
                <li><a href="../Type/dashboard_type.php">
                        <i class="fa fa-list"></i>
                        <span class="nav-item">Types</span>
                    </a></li>
                <li><a href="dashboard_project.php">
                        <i class="fa fa-database"></i>
                        <span class="nav-item">Project</span>
                    </a></li>
                <li><a href="../Reclamation/dashboard_reclamation.php">
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
                <li><a href="../Category/dashboard_category.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Category</span>
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
                    <i class="fa fa-database"></i>
                    <h3>Projects List</h3>
                    <table class="table table-bordered">
                        <?php
                        $projectC = new ProjectC();
                        $projects = $projectC->read_project();

                        if (!empty($projects) && (is_iterable($projects) || is_object($projects))) {
                            echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Start Date</th><th>Goal</th><th>Current Amount</th><th>Percentage</th><th>Organization ID</th><th>Type ID</th><th>Actions</th></tr>";
                            foreach ($projects as $project) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($project['ID_Project']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['Project_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['Project_description']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['start_date']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['Goal']) . "</td>";
                                echo  "<td>" . htmlspecialchars($project['Current_amount']) . "</td>";
                        ?>
                                <td class="progress-bar-container">
                                    <div class="full-bar">
                                        <div class="progress-bar" style="width: <?php echo htmlspecialchars($project['Percentage']); ?>%;"></div>
                                    </div>
                                    <p><?php echo htmlspecialchars($project['Percentage']); ?>%
                                    </p>

                                </td>

                        <?php


                                echo "<td>" . htmlspecialchars($project['ID_Org']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['ID_Type']) . "</td>";
                                echo "<td>";
                                echo "<button onclick=\"openEditModal(" . $project['ID_Project'] . ", '" . $project['Project_name'] . "', '" . $project['Project_description'] . "')\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $project['ID_Project'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Projects found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="createType()">Add a Project</button>
                </div>
            </div>

        </section>

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
                                    <textarea id="new-type-description" name="new-type-description" class="description"></textarea>
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
                                <td><label for="project-name">Project Name</label></td>
                                <td><input type="text" id="project-name" name="project-name"></td>
                            </tr>
                            <tr>
                                <td><label for="project-description">Project Description</label></td>
                                <td>
                                    <textarea id="project-description" name="project-description" class="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="project-date">Start Date</label></td>
                                <td><input type="date" id="project-date" name="project-date"></td>
                            </tr>
                            <tr>
                                <td><label for="project-goal">Goal Amount</label></td>
                                <td><input type="number" id="project-goal" name="project-goal" value=0></td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <select>
                                        <?php  ?>
                                        <option value="1">test 1</option>
                                        <option value="2">test 2</option>
                                    </select>
                                </td>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Create" id="button_create">
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
            xhttp.open("POST", "../../controller/Type/type_delete.php", true);
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
            var typeName = document.getElementById("type-name");
            var typeDescription = document.getElementById("type-description");

            if (typeDescription.value === "" || typeDescription.value.length > 20) {
                alert("Type Description should not be empty and should not exceed 20 characters.");
                typeDescription.style.border = "1px solid red";
                return;
            } else {
                typeDescription.style.border = "1px solid green";
            }

            if (typeName.value === "" || typeName.value.length > 20) {
                alert("Type Name should not be empty and should not exceed 20 characters.");
                typeName.style.border = "1px solid red";
                return;
            } else {
                typeName.style.border = "1px solid green";
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Type/type_create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
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
            var existingTypeName = name;
            var existingTypeDescription = description;


        }

        function editType() {

            var id = document.getElementById("edit-type-id").value;

            var typeName = document.getElementById("new-type-name");
            var typeDescription = document.getElementById("new-type-description");


            if (typeDescription.value === "" || typeDescription.value.length > 20) {
                alert("Type Description should not be empty and should not exceed 20 characters.");
                typeDescription.style.border = "1px solid red";
                return;
            } else {
                typeDescription.style.border = "1px solid green";
            }

            if (typeName.value === "" || typeName.value.length > 20) {
                alert("Type Name should not be empty and should not exceed 20 characters.");
                typeName.style.border = "1px solid red";
                return;
            } else {
                typeName.style.border = "1px solid green";
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Type/type_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
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