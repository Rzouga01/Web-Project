<!DOCTYPE html>
<html lang="en">

<?php
require_once "../../controller/Reclamation/reclamation.php";
require_once "../../model/Reclamation/reclamationC.php";
?>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="../dashboard.css">

    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
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
                <li><a href="../Category/dashboard_category.php">
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
                <li><a href="../../controller/User/logout.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a></li>
            </ul>
        </nav>

        <section class="main">
            <div class="users">
                <div class="card">
                    <i class="fa fa-list"></i>
                    <h3>reclamation list</h3>
                    <table id="reclamation-table" class="table table-bordered">
                        <tr>
                            <td colspan="3"><button id="search" onclick="search()"><i class="fa fa-search"></i> Search</button> </td>
                            <td colspan="3"> <input type="text" id="search-input" placeholder="Search"></td>


                        </tr>
                        <?php
                        $reclamation = new ReclamationC();
                        $reclamations = $reclamation->listReclamation();

                        if (!empty($reclamations) && (is_iterable($reclamations) || is_object($reclamations))) {
                            echo "<tr><th>ID</th><th>ID User</th><th>Text</th><th>Date</th><th>Status</th><th>Actions</th></tr>";
                            foreach ($reclamations as $reclamation) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($reclamation['ID_Reclamation']) . "</td>";
                                echo "<td>" . htmlspecialchars($reclamation['ID_User']) . "</td>";
                                echo "<td>" . htmlspecialchars($reclamation['Reclamation_text']) . "</td>";
                                echo "<td>" . htmlspecialchars($reclamation['Reclamation_date']) . "</td>";
                                echo "<td>" . htmlspecialchars($reclamation['Reclamation_status']) . "</td>";
                                echo "<td>";
                                echo "<button onclick=\"openEditModal(" . $reclamation['ID_Reclamation'] . ", '" . $reclamation['Reclamation_text'] . "','" . $reclamation['Reclamation_date'] . "','" . $reclamation['Reclamation_status'] . "')\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $reclamation['ID_Reclamation'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Reclamations found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="createType()">Add a Reclamation</button>
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
                                <input type="hidden" id="edit-ID-reclamation" name="edit-ID-reclamation" value="">
                                <input type="hidden" id="edit-ID-user" name="edit-ID-user" value="">
                                <input type="hidden" id="edit-date-reclamation" name="edit-date-reclamation" value="">
                                <input type="hidden" id="edit-status-reclamation" name="edit-status-reclamation"
                                    value="">
                            </tr>
                            <tr>
                                <td><label for="new-reclamation-text">new reclamation</label></td>
                                <td>
                                    <textarea id="new-reclamation-text" name="new-reclamation-text"
                                        class="reclamation-text"></textarea>
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
                                <td><label for="reclamation-text">Reclamation text</label></td>
                                <td>
                                    <textarea id="reclamation-text" name="reclamation-text"
                                        class="reclamation-text"></textarea>
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
        function search() {

            searchBar = document.getElementById("search-input");
            filter = searchBar.value.toUpperCase();
            table = document.getElementById("reclamation-table");
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
            xhttp.open("POST", "../../controller/Reclamation/reclamation_delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.send("id=" + id);
        }





        function createType() {
            var modal = document.getElementById("AddModal");
            modal.style.display = "block";
        }

        function closeAddModal() {
            var modal = document.getElementById("AddModal");
            modal.style.display = "none";
        }

        function addType() {
            var Text = document.getElementById("reclamation-text");

            if (Text.value === "" || Text.value.length > 20) {
                alert("Text should not be empty and should not exceed 20 characters.");
                Text.style.border = "1px solid red";
                console.log(Text.value)
                return;
            } else {
                Text.style.border = "1px solid green";
            }


            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Reclamation/reclamation_create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    closeAddModal();
                    location.reload();
                }
            };
            xhttp.send("text=" + encodeURIComponent(Text.value));
        }





        function closeEditModal() {
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
        }

        function openEditModal(id, text, date, status) {
            var modal = document.getElementById("editModal");
            modal.style.display = "block";


            document.getElementById("edit-ID-reclamation").value = id;
            document.getElementById("edit-date-reclamation").value = date;
            document.getElementById("edit-status-reclamation").value = status;


        }

        function editType() {

            var id = document.getElementById("edit-ID-reclamation").value;


            var text = document.getElementById("new-reclamation-text");

            var date = document.getElementById("edit-date-reclamation").value;

            var status = document.getElementById("edit-status-reclamation").value;




            if (text.value === "" || text.value.length > 20) {
                alert("Text Description should not be empty and should not exceed 20 characters.");
                text.style.border = "1px solid red";
                return;
            } else {
                text.style.border = "1px solid green";
            }



            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Reclamation/reclamation_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    closeEditModal();
                    location.reload();
                }
            };
            xhttp.send("id=" + encodeURIComponent(id) + "&text=" + encodeURIComponent(text.value) + "&date=" + encodeURIComponent(date) + "&status=" + encodeURIComponent(status));;
        }
    </script>

</body>

</html>


</body>

</html>