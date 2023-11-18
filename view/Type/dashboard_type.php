<?php
require_once realpath(dirname(__DIR__, 2) . '/model/Connection/connection.php');
require_once '../../model/User/user_class.php';
require_once '../../model/User/user.php';
$userCRUD = new UserCRUD($pdo);
$users = $userCRUD->getAllUsers();
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
                    <li><a href="#" class="logo">
                            <img src="./../../assets/logo/logo.png" alt="">
                            <span class="nav-item">Dashboard</span>
                        </a></li>
                    <li><a href="#">
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
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['ID_USER']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['First_Name']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['Last_Name']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['Email']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['Phone_number']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['Birthdate']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['Country']; ?>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <?php echo $user['Role']; ?>
                                    </td>
                                    <td style="padding: 0 10px;"><a href="#" class="edit-btn">Edit</a></td>
                                    <td style="padding: 0 10px;">
                                        <form method="post" action="">
                                            <input type="hidden" name="delete" value="<?php echo $user['ID_USER']; ?>">
                                            <button type="submit"
                                                onclick="return confirmDelete(<?php echo $user['ID_USER']; ?>)">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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