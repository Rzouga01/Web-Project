<!DOCTYPE html>
<html lang="en">

<?php
require_once "../../controller/Reponse/reponse.php";
require_once "../../model/Reponse/reponseC.php";
require_once "../../controller/Reclamation/reclamation.php";
?>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="../dashboard.css">
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
                <li><a href="../project/dashboard_project.php">
                        <i class="fa fa-database"></i>
                        <span class="nav-item">Project</span>
                    </a></li>
                <li><a href="../Reclamation/dashboard_reclamation.php">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="nav-item">Reclamation</span>
                    </a></li>
                <li><a href="dashboard_reponse.php">
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
                    <i class="fa fa-list"></i>
                    <h3>response list</h3>
                    <table class="table table-bordered">
                        <?php
                        $response = new ResponseC();
                        $responses = $response->listResponse();

                        if (!empty($response) && (is_iterable($responses) || is_object($responses))) {
                            echo "<tr><th>ID</th><th>ID Reclamation</th><th>Text</th><th>Date</th><th>Actions</th></tr>";
                            foreach ($responses as $response) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($response['ID_Response']) . "</td>";
                                echo "<td>" . htmlspecialchars($response['#ID_Reclamation']) . "</td>";
                                echo "<td>" . htmlspecialchars($response['Response_text']) . "</td>";
                                echo "<td>" . htmlspecialchars($response['Response_date']) . "</td>";
                                echo "<td>";
                                echo "<button onclick=\"openEditModal(" . $response['ID_Response'] . ", '" . $response['Response_text'] . "','" . $response['Response_date'] . " ',' ".$response['#ID_Reclamation'].")\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $response['ID_Response'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Responses found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="createType()">Add a Response</button>
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
                                <input type="hidden" id="edit-ID-response" name="edit-ID-response" value="">
                                <input type="hidden" id="edit-ID-reclamation" name="edit-ID-reclamation" value="">
                                <input type="hidden" id="edit-date-response" name="edit-date-response" value="">
                            </tr>
                            <tr>
                                <td><label for="new-response-text">new response</label></td>
                                <td>
                                    <textarea id="new-response-text" name="new-response-text" class="response-text"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for ="reclamation">Reclamation </label>
                                </td>
                                <td>
                                    <select name = "reclamation" id="reclamation">
                                        <?php
                                            $reclamation = new ReclamationC();
                                            $reclamations = $reclamation->listReclamation();
                                            foreach ($reclamations as $r){
                                                echo '<option value = " '.$r['ID_Reclamation'] . '">'.$r['Reclamation_text'].'</option>';
                                            }
                                        ?>
                                    </select>  
                                </td>
                            </tr>
                            <tr>
                            <td>
                                    <input type="submit" value="Create" id="button_create">
                                </td>
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
                                <td><label for="response-text">Response text</label></td>
                                <td>
                                    <textarea id="response-text" name="response-text" class="response-text"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for ="reclamation">Reclamation </label>
                                </td>
                                <td>
                                    <select name = "reclamation" id="reclamation">
                                        <?php
                                            $reclamation = new ReclamationC();
                                            $reclamations = $reclamation->listReclamation();
                                            foreach ($reclamations as $r){
                                                echo '<option value = " '.$r['ID_Reclamation'] . '">'.$r['Reclamation_text'].'</option>';
                                            }
                                        ?>
                                    </select>  
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
        function confirmDelete(id) {
            var userConfirmed = confirm('Are you sure you want to delete type with ID ' + id + '?');
            if (userConfirmed) {
                Delete(id);
            }
        }


        function Delete(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Reponse/reponse_delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
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
            var Text = document.getElementById("reponse-text");
            var ID_Reclamation = document.getElementById("reclamation");

            if (Text.value === "" || Text.value.length > 20) {
                alert("Text should not be empty and should not exceed 20 characters.");
                Text.style.border = "1px solid red";
                console.log(Text.value)
                return;
            } else {
                Text.style.border = "1px solid green";
            }


            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Reponse/reponse_create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    closeAddModal();
                    location.reload();
                }
            };
          
            xhttp.send("text=" + encodeURIComponent(Text.value) + "&ID_Reclamation=" + encodeURIComponent(ID_Reclamation.value));
        }





        function closeEditModal() {
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
        }

        function openEditModal(id, text, date, status) {
            var modal = document.getElementById("editModal");
            modal.style.display = "block";


            document.getElementById("edit-ID-reponse").value = id;
            document.getElementById("edit-text-reponse").value = date;
            document.getElementById("edit-date-reponse").value = status;


        }

        function editType() {

            var id = document.getElementById("edit-ID-reponse").value;


            var text = document.getElementById("new-reponse-text");

            var date = document.getElementById("edit-date-reponse").value;






            if (text.value === "" || text.value.length > 20) {
                alert("Text Description should not be empty and should not exceed 20 characters.");
                text.style.border = "1px solid red";
                return;
            } else {
                text.style.border = "1px solid green";
            }



            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../controller/Reponse/reponse_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
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