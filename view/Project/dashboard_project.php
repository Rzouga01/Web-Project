<!DOCTYPE html>
<html lang="en">

<?php
require_once "../../controller/Project/projectC.php";
require_once "../../controller/Type/TypeC.php";
?>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


    <link rel="stylesheet" href="project.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const headers = document.querySelectorAll("th");
            headers.forEach(header => {
                header.addEventListener("click", () => sortTable(header.cellIndex));
                header.classList.add("sortable-header");
            });

            let currentSort = {
                column: -1,
                order: 1
            };

            function sortTable(column) {
                const table = document.querySelector(".table");
                const rows = Array.from(table.rows).slice(1); // Exclude header row
                const isNumeric = column === 5 || column === 6; // Assuming 3rd, 5th, and 6th columns are numeric

                rows.sort((row1, row2) => {
                    const value1 = row1.cells[column].textContent.trim();
                    const value2 = row2.cells[column].textContent.trim();

                    if (isNumeric) {
                        return parseFloat(value1) - parseFloat(value2);
                    } else {
                        return value1.localeCompare(value2);
                    }
                });

                if (currentSort.column === column) {
                    currentSort.order *= -1;
                } else {
                    currentSort.column = column;
                    currentSort.order = 1;
                }

                // Toggle sorting order class
                const header = document.querySelectorAll("th")[column];
                const currentOrder = currentSort.order === 1 ? "asc" : "desc";

                // Remove sorting classes from all headers
                document.querySelectorAll("th").forEach(th => {
                    th.classList.remove("asc", "desc");
                });

                // Toggle sorting order class
                header.classList.add(currentOrder);

                // Remove existing rows
                while (table.rows.length > 1) {
                    table.deleteRow(1);
                }

                // Append sorted rows
                const sortedRows = currentSort.order === 1 ? rows : rows.reverse();
                sortedRows.forEach(row => {
                    table.appendChild(row);
                });
            }
        });
    </script>
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
                <li><a href="">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Profile</span>
                    </a></li>
                <li><a href="../User/dashboard_user.php">
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


                        function echoHeader($columnName, $index, $initialSort = false)
                        {

                            $sortClass = $initialSort ? 'sortable-header asc' : 'sortable-header';
                            $iconClass = 'fa fa-sort';


                            echo "<th onclick='sortTable($index)' class='$sortClass'>";
                            echo "$columnName <i class='fa $iconClass' aria-hidden='true'></i>";
                            echo "</th>";
                        }

                        $projectC = new ProjectC();
                        $projects = $projectC->read_project();

                        if (!empty($projects) && (is_iterable($projects) || is_object($projects))) {
                            echo "<tr>";
                            echoHeader("ID", 0, true); // Initial sort on ID column
                            echoHeader("Name", 1);
                            echoHeader("Description", 2);
                            echoHeader("Start Date", 3);
                            echoHeader("Goal", 4);
                            echoHeader("Current Amount", 5);
                            echoHeader("Percentage", 6);
                            echoHeader("Organization ID", 7);
                            echoHeader("Type ID", 8);
                            echo "<th>Actions</th>";
                            echo "</tr>";


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
                                        <div class="progress-bar" style="width: <?php echo htmlspecialchars($project['Percentage']) ?>%; ;"></div>
                                    </div>
                                    <p><?php echo number_format($project['Percentage'], 2);; ?>%</p>
                                </td>

                        <?php

                                echo "<td>" . htmlspecialchars($project['ID_Org']) . "</td>";
                                echo "<td>" . htmlspecialchars($project['ID_Type']) . "</td>";
                                echo "<td>";
                                echo "<button onclick=\"openEditModal(" . $project['ID_Project'] . ", '" . $project['Project_name'] . "', '" . $project['Project_description'] . "', '" . $project['start_date'] .  "', '" . $project['Current_amount'] . "', '" . $project['Goal'] . "', '" .  $project['ID_Type'] . "', '" .  $project['ID_Org'] . "')\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $project['ID_Project'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Projects found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="create()">Add a Project</button>
                </div>
            </div>

        </section>

        <!-- Edit Modal -->
        <div id="editModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <div class="container">
                    <form id="editForm" method="post" onsubmit="event.preventDefault();edit()">
                        <table>
                            <tr>

                                <input type="hidden" id="project-id-update" name="project-id-update">
                            </tr>
                            <tr>
                                <td><label for="project-name-update">Project Name</label></td>
                                <td><input type="text" id="project-name-update" name="project-name-update"></td>
                            </tr>
                            <tr>
                                <td><label for="project-description-update">Project Description</label></td>
                                <td>
                                    <textarea id="project-description-update" name="project-description-update" class="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="project-date-update">Start Date</label></td>
                                <td><input type="date" id="project-date-update" name="project-date-update"></td>
                            </tr>
                            <tr>
                                <td><label for="project-current-update">Current Amount</label></td>
                                <td><input type="number" id="project-current-update" name="project-current-update" value=0></td>
                            </tr>
                            <tr>
                                <td><label for="project-goal-update">Goal Amount</label></td>
                                <td><input type="number" id="project-goal-update" name="project-goal-update" value=0></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="project-type">Type</label>
                                </td>
                                <td>
                                    <select name="project-type-update" id="project-type-update">
                                        <?php
                                        $typeC = new TypeC();
                                        $types = $typeC->read_type();
                                        foreach ($types as $type) {
                                            if ($type == $types[0])
                                                echo "<option value='" . $type['ID_Type'] . "' selected>" . $type['Type_name'] . "</option>";
                                            else
                                                echo "<option value='" . $type['ID_Type'] . "'>" . $type['Type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            <tr>
                            <tr>
                                <td>
                                    <label for="project-organization-update">Organization</label>
                                </td>
                                <td>
                                    <select name="project-organization-update" id="project-organization-update">
                                        <option value="1" selected>Organization test</option>
                                    </select>
                                </td>
                            <tr>
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
                    <form id="AddForm" onsubmit="event.preventDefault(); add();">
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
                                <td><label for="project-current">Current Amount</label></td>
                                <td><input type="number" id="project-current" name="project-current" value=0></td>
                            </tr>
                            <tr>
                                <td><label for="project-goal">Goal Amount</label></td>
                                <td><input type="number" id="project-goal" name="project-goal" value=0></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="project-type">Type</label>
                                </td>
                                <td>
                                    <select name="project-type" id="project-type">
                                        <?php
                                        $typeC = new TypeC();
                                        $types = $typeC->read_type();
                                        foreach ($types as $type) {
                                            if ($type == $types[0])
                                                echo "<option value='" . $type['ID_Type'] . "' selected>" . $type['Type_name'] . "</option>";
                                            else
                                                echo "<option value='" . $type['ID_Type'] . "'>" . $type['Type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            <tr>
                            <tr>
                                <td>
                                    <label for="project-organization">Organization</label>
                                </td>
                                <td>
                                    <select name="project-organization" id="project-organization">
                                        <option value="1" selected>Organization test</option>
                                    </select>
                                </td>
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
            xhttp.open("POST", "../../controller/Project/project_delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.send("id=" + id);
        }





        function create() {
            var modal = document.getElementById("AddModal");
            modal.style.display = "block";
        }

        function closeAddModal() {
            var modal = document.getElementById("AddModal");
            modal.style.display = "none";
        }

        function add() {
            var projectName = document.getElementById("project-name");
            var projectDescription = document.getElementById("project-description");
            var projectDate = document.getElementById("project-date");
            var projectCurrentAmount = document.getElementById("project-current");
            var projectGoal = document.getElementById("project-goal");
            var projectType = document.getElementById("project-type");
            var projectOrganization = document.getElementById("project-organization");

            if (projectName.value === "" || projectName.value.length > 20) {
                alert("Project Name should not be empty and should not exceed 20 characters.");
                projectName.style.border = "1px solid red";
                return;
            } else {
                projectName.style.border = "1px solid green";
            }

            if (projectDescription.value === "" || projectDescription.value.length > 20) {
                alert("Project Description should not be empty and should not exceed 20 characters.");
                projectDescription.style.border = "1px solid red";
                return;
            } else {
                projectDescription.style.border = "1px solid green";
            }

            var projectDateValue = new Date(projectDate.value);

            if (projectDateValue < Date.now() || projectDate.value === "") {
                alert("Project Date should not be empty and higher than today.");
                projectDate.style.border = "1px solid red";
                return;
            } else {
                projectDate.style.border = "1px solid green";
            }

            if (projectCurrentAmount.value < 0 || projectCurrentAmount.value == "") {
                alert("Current Amount  should not be Negative and should not be empty.");
                projectCurrentAmount.style.border = "1px solid red";
                return;
            } else {
                projectCurrentAmount.style.border = "1px solid green";
            }

            if (projectGoal.value < 0 || projectGoal.value == "") {
                alert("Project Goal  should not be Negative and should not be empty.");
                projectGoal.style.border = "1px solid red";
                return;
            } else {
                projectGoal.style.border = "1px solid green";
            }



            if (!projectType.value) {
                alert("Please select a Type.");
                projectType.style.border = "1px solid red";
                return;
            } else {
                projectType.style.border = "1px solid green";
            }


            if (!projectOrganization.value) {
                alert("Please select an Organization.");
                projectOrganization.style.border = "1px solid red";
                return;
            } else {
                projectOrganization.style.border = "1px solid green";
            }


            var formattedDate = new Date(projectDate.value).toISOString().slice(0, 19).replace("T", " ");

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Project/project_create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    closeAddModal();
                    location.reload();
                }
            };
            xhttp.send(
                "project-name=" +
                encodeURIComponent(projectName.value) +
                "&project-description=" +
                encodeURIComponent(projectDescription.value) +
                "&project-date=" +
                encodeURIComponent(formattedDate) +
                "&project-current=" +
                encodeURIComponent(projectCurrentAmount.value) +
                "&project-goal=" +
                encodeURIComponent(projectGoal.value) +
                "&project-type=" +
                encodeURIComponent(projectType.value) +
                "&project-organization=" +
                encodeURIComponent(projectOrganization.value)
            );
        }






        function closeEditModal() {
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
        }




        function openEditModal(id, name, description, date, current, goal, type, organization) {
            var modal = document.getElementById("editModal");
            modal.style.display = "block";


            document.getElementById("project-id-update").value = id;
            document.getElementById("project-name-update").value = name;
            document.getElementById("project-description-update").value = description;

            var formattedDate = new Date(date);
            var yyyy = formattedDate.getFullYear();
            var mm = String(formattedDate.getMonth() + 1).padStart(2, '0');
            var dd = String(formattedDate.getDate()).padStart(2, '0');
            var formattedDateString = `${yyyy}-${mm}-${dd}`;

            document.getElementById("project-date-update").value = formattedDateString;
            document.getElementById("project-current-update").value = current;
            document.getElementById("project-goal-update").value = goal;


            var typeSelect = document.getElementById("project-type-update");
            for (var i = 0; i < typeSelect.options.length; i++) {
                if (typeSelect.options[i].value == type) {
                    typeSelect.options[i].selected = true;
                    break;
                }
            }


            var orgSelect = document.getElementById("project-organization-update");
            for (var j = 0; j < orgSelect.options.length; j++) {
                if (orgSelect.options[j].value == organization) {
                    orgSelect.options[j].selected = true;
                    break;
                }
            }
        }





        function edit() {
            var id = document.getElementById("project-id-update").value;
            var projectName = document.getElementById("project-name-update").value;
            var projectDescription = document.getElementById("project-description-update").value;
            var projectDate = document.getElementById("project-date-update").value;
            var projectCurrentAmount = document.getElementById("project-current-update").value;
            var projectGoal = document.getElementById("project-goal-update").value;
            var projectType = document.getElementById("project-type-update").value;
            var projectOrganization = document.getElementById("project-organization-update").value;


            if (projectName === "" || projectName.length > 20) {
                alert("Project Name should not be empty and should not exceed 20 characters.");
                return;
            }

            if (projectDescription === "" || projectDescription.length > 20) {
                alert("Project Description should not be empty and should not exceed 20 characters.");
                return;
            }
            var projectDateValue = new Date(projectDate);
            if (isNaN(projectDateValue.getTime()) || projectDateValue < Date.now()) {
                alert("Invalid or empty Project Date. Please select a valid date.");
                return;
            }


            if (isNaN(projectCurrentAmount) || projectCurrentAmount < 0 || projectCurrentAmount === "") {
                alert("Current Amount should be a non-negative number and should not be empty.");
                return;
            }

            if (isNaN(projectGoal) || projectGoal < 0 || projectGoal === "") {
                alert("Project Goal should be a non-negative number and should not be empty.");
                return;
            }


            if (!projectType) {
                alert("Please select a Type.");
                return;
            }

            if (!projectOrganization) {
                alert("Please select an Organization.");
                return;
            }


            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Project/project_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    closeEditModal();
                    location.reload();
                }
            };

            xhttp.send(
                "project-name-update=" + encodeURIComponent(projectName) +
                "&project-description-update=" + encodeURIComponent(projectDescription) +
                "&project-date-update=" + encodeURIComponent(projectDate) +
                "&project-current-update=" + encodeURIComponent(projectCurrentAmount) +
                "&project-goal-update=" + encodeURIComponent(projectGoal) +
                "&project-type-update=" + encodeURIComponent(projectType) +
                "&project-organization-update=" + encodeURIComponent(projectOrganization) +
                "&project-id-update=" + encodeURIComponent(id)
            );
        }
    </script>

</body>

</html>