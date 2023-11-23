<!DOCTYPE html>
<html lang="en">

<?php
require "../../controller/Reclamation/reclamation.php";
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
                <li><a href="../Project/dashboard_project.php">
                        <i class="fa fa-list"></i>
                        <span class="nav-item">Project</span>
                    </a></li>
                <li><a href="dashboard_reclamation.php">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="nav-item">Reclamation</span>
                    </a></li>
                <li><a href="dashboard_type.php">
                        <i class="fa fa-envelope-open"></i>
                        <span class="nav-item">Response</span>
                    </a></li>
                <li><a href="dashboard_type.php">
                        <i class="fa fa-comments"></i>
                        <span class="nav-item">Feedback</span>
                    </a></li>
                <li><a href="">
                        <i class="fas fa-cog"></i>
                        <span class="nav-item">Settings</span>
                    </a></li>
                <li><a href="" class="logout">
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
                    <table class="table table-bordered">
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
                                echo "<button onclick=\"openEditModal(" . $reclamation['ID_Reclamation'] . ", '" . $reclamation['ID_User'] . "', '" . $reclamation['Reclamation_text'] . "','" . $reclamation['Reclamation_date'] . "','" . $reclamation['Reclamation_status'] . "')\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $reclamation['ID_Reclamation'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Reclamations found</td></tr>";
                        }
                        ?>
                    </table>
                    <button onclick="createReclamation()">Add a reclamation</button>
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
                                <input type="hidden" id="edit-ID-reclamation" name="edit-ID-reclamation" value="">
                                <td><label for="new-reclamation">new reclamation</label></td>
                                <td><input type="text" id="new reclamation" name="new reclamation"></td>
                            </tr>
                            <tr>
                                <td><label for="new-reclamation-text">new reclamation</label></td>
                                <td>
                                    <textarea id="new-reclamation-text" name="new-reclamation-text" class="reclamation-text"></textarea>
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
                                <td><label for="ID-reclamation">ID-reclamation</label></td>
                                <td><input type="text" id="ID-reclamation" name="ID-reclamation"></td>
                            </tr>
                            <tr>
                                <td><label for="ID-User">ID-User</label></td>
                                <td><input type="text" id="ID-User" name="ID-User"></td>
                            </tr>
                            <tr>
                                <td><label for="reclamation-text">Reclamation-text</label></td>
                                <td>
                                    <textarea id="reclamation-text" name="reclamation-text" class="reclamation-text"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="Reclamation-date">Reclamation-date</label></td>
                                <td><input type="reclamation-date" id="reclamation-date" name="reclamation-date"></td>
                            </tr>
                            <tr>
                                <td><label for="Reclamation-status">Reclamation-status</label></td>
                                <td><input type="reclamation-status" id="reclamation-status" name="reclamation-status"></td>
                            </tr>
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