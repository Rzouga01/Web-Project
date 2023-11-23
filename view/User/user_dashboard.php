<?php
require_once "../../database/connect.php";
require_once "../../controller/User/user.php";
require_once "../../model/User/userC.php";
?>
<span style="font-family: verdana, geneva, sans-serif;">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Dashboard</title>
        <link rel="stylesheet" href="dashboard.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
                <li><a href="../User/user_dashboard.php">
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
                        <i class="fas fa-users"></i>
                        <h3>Users list</h3>
                         <table class="table table-bordered">
                        <?php
                       $user = new UserCRUD();
                       $users = $user->getAllUsers();
                        if (!empty($users)&&(is_iterable($users) )) {
                            echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone number</th><th>Birthdate</th><th>Country</th><th>Role</th></tr>";
                            foreach ($users as $user) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($user['ID_USER']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['First_Name']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['Last_Name']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['Phone_number']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['Birthdate']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['Country']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['Role']) . "</td>";
                                echo "<button onclick=\"openEditModal(" . $user['ID_USER'] . "', '" .$user['First_Name'] . "','" . $user['Last_Name'] . "','" . $user['Email'] . "', '" . $user['Phone_number'] . ")\">Edit</button>";
                                echo "<button onclick=\"confirmDelete(" . $user['ID_USER'] . ")\">Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        else{
                            echo "<tr><td colspan='4'>No Users found </td></tr>";
                        }
                        ?>
                    </table>
                        <a href="../../view/Register/register.html">Add User</a>
                    </div>
                </div>
            </section>
            <div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="container">
                    <form id="editForm" method="post" action="">
                            <div class="row">
                                <div class="col-50">
                                    <h3>User Information</h3>
                                    <label for="edit-First_Name"> First Name</label>
                                    <input type="text" id="edit-First_Name" name="First_Name">
                                    <label for="edit-Last_Name"> Last Name</label>
                                    <input type="text" id="edit-Last_Name" name="Last_Name">
                                    <label for="edit-Email"> Email</label>
                                    <input type="email" id="edit-Email" name="Email">
                                    <label for="edit-Phone_number">Phone Number :</label>
                                    <input type="text" id="edit-Phone_number" name="Phone_number"
                                        placeholder="Phone Number">
                                    <label for="edit-Password">Password :</label>
                                    <input type="password" id="edit-Password" name="Password" placeholder="Password">
                                    <label for="edit-Birthdate">Birthdate :</label>
                                    <input type="date" id="edit-Birthdate" name="Birthdate">
                                    <label for="edit-Country">Country :</label>
                                    <select name="Country" id="edit-Country">
                                        <option value="">Select Country</option>
                                        <option value="Country 1">Country 1</option>
                                        <option value="Country 2">Country 2</option>
                                    </select>
                                    <label for="edit-Role">Role :</label>
                                    <select name="Role" id="edit-Role">
                                        <option value="">Select Role</option>
                                        <option value="Admin">Organisation</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div><div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="container">
                    <form id="editForm" method="post" action="">
                            <div class="row">
                                <div class="col-50">
                                    <h3>User Information</h3>
                                    <label for="edit-First_Name"> First Name</label>
                                    <input type="text" id="edit-First_Name" name="First_Name">
                                    <label for="edit-Last_Name"> Last Name</label>
                                    <input type="text" id="edit-Last_Name" name="Last_Name">
                                    <label for="edit-Email"> Email</label>
                                    <input type="email" id="edit-Email" name="Email">
                                    <label for="edit-Phone_number">Phone Number :</label>
                                    <input type="text" id="edit-Phone_number" name="Phone_number"
                                        placeholder="Phone Number">
                                    <label for="edit-Password">Password :</label>
                                    <input type="password" id="edit-Password" name="Password" placeholder="Password">
                                    <label for="edit-Birthdate">Birthdate :</label>
                                    <input type="date" id="edit-Birthdate" name="Birthdate">
                                    <label for="edit-Country">Country :</label>
                                    <select name="Country" id="edit-Country">
                                        <option value="">Select Country</option>
                                        <option value="Country 1">Country 1</option>
                                        <option value="Country 2">Country 2</option>
                                    </select>
                                    <label for="edit-Role">Role :</label>
                                    <select name="Role" id="edit-Role">
                                        <option value="">Select Role</option>
                                        <option value="Admin">Organisation</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>
                            <input type="submit" value="Update" class="btn">
                        </form>
                    </div>
                </div>
            </div>
    </body>
    <script>
        function confirmDelete(id) {
    return confirm('Are you sure you want to delete user with ID ' + id + '?');
        }

        var modal = document.getElementById("editModal");
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.querySelectorAll('.edit-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var row = e.target.parentNode.parentNode;
                document.getElementById('edit-First_Name').value = row.children[1].innerText;
                document.getElementById('edit-Last_Name').value = row.children[2].innerText;
                document.getElementById('edit-Email').value = row.children[3].innerText;
                document.getElementById('edit-Phone_number').value = row.children[4].innerText;
                document.getElementById('edit-Birthdate').value = row.children[5].innerText;
                modal.style.display = "block";
            });
        });
        document.getElementById('edit-form').addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            fetch('../../model/User/user.php', {
                method: 'POST',
                body: formData
            }).then(function (response) {
                return response.text();
            }).then(function (data) {
                console.log(data);
            }).catch(function (error) {
                console.error(error);
            });
        });
    </script>

    </html>
</span>