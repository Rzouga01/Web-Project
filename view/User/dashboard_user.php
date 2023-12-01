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
                    <li><a href="">
                            <i class="fas fa-user"></i>
                            <span class="nav-item">Profile</span>
                        </a></li>
                    <li><a href="dashboard_user.php">
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
                    <li><a href="#">
                            <i class="fa fa-comments"></i>
                            <span class="nav-item">Feedback</span>
                        </a></li>
                    <li><a href="../Category/dashboard_category.php">
                            <i class="fa fa-archive"></i>
                            <span class="nav-item">Category</span>
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
                        <i class="fas fa-users"></i>
                        <h3>Users list</h3>
                        <table class="table table-bordered">
                            <?php
                            $user = new UserCRUD();
                            $users = $user->getAllUsers();
                            if (!empty($users)) {
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
                                    echo "<td>";
                                    echo "<button onclick='openEditUserModal(\"{$user['ID_USER']}\", \"{$user['First_Name']}\", \"{$user['Last_Name']}\", \"{$user['Email']}\", \"{$user['Phone_number']}\", \"{$user['Password']}\", \"{$user['Birthdate']}\", \"{$user['Country']}\", \"{$user['Role']}\")'>Edit</button>";
                                    echo "<button onclick='deleteUser(\"{$user['ID_USER']}\")'>Delete</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No Users found </td></tr>";
                            }
                            ?>
                        </table>
                        <button onclick="openAddUserModal()">Add User</button>
                    </div>
                </div>
            </section>
            <div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <div class="container">
                        <form id="editForm" onsubmit="event.preventDefault(); editUser();">
                            <table>
                                <input type="hidden" id="edit-id-user" name="ID_USER">
                                <tr>
                                    <td><label for="edit-First_Name">First Name</label></td>
                                    <td><input type="text" id="edit-First_Name" name="First_Name"></td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Last_Name">Last Name</label></td>
                                    <td><input type="text" id="edit-Last_Name" name="Last_Name"></td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Email">Email</label></td>
                                    <td><input type="text" id="edit-Email" name="Email"></td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Phone_number">Phone Number</label></td>
                                    <td><input type="text" id="edit-Phone_number" name="Phone_number"></td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Password">Password</label></td>
                                    <td>
                                        <input type="text" name="Password" id="edit-Password">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Birthdate">Birthdate</label></td>
                                    <td><input type="date" id="edit-Birthdate" name="Birthdate"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="country">Country</label>
                                        <select name="country" id="edit-country">
                                            <option value="Country1">Country 1</option>
                                            <option value="Country2">Country 2</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="edit-role">Role</label>
                                        <select name="Role" id="edit-role">
                                            <option value="0">Admin</option>
                                            <option value="1">Organisation</option>
                                            <option value="2">User</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="submit" value="Save Changes" id="button_save">
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div id="addModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <div class="container">
                        <form id="addForm" onsubmit="event.preventDefault(); addUser();">
                            <table>
                                <tr>
                                    <td><label for="add-First_Name">First Name</label></td>
                                    <td><input type="text" id="add-First_Name" name="First_Name"></td>
                                </tr>
                                <tr>
                                    <td><label for="add-Last_Name">Last Name</label></td>
                                    <td><input type="text" id="add-Last_Name" name="Last_Name"></td>
                                </tr>
                                <tr>
                                    <td><label for="add-Email">Email</label></td>
                                    <td><input type="text" id="add-Email" name="Email"></td>
                                </tr>
                                <tr>
                                    <td><label for="add-Phone_number">Phone Number</label></td>
                                    <td><input type="text" id="add-Phone_number" name="Phone_number">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add-Password">Password</label></td>
                                    <td>
                                        <input type="text" name="Password" id="add-Password">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add-Birthdate">Birthdate</label></td>
                                    <td><input type="date" id="add-Birthdate" name="Birthdate"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="add-country">Country</label>
                                        <select name="Country" id="add-country">
                                            <option value="Country1">Country 1</option>
                                            <option value="Country2">Country 2</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="add-role">Role</label>
                                        <select name="Role" id="add-role">
                                            <option value="0">Admin</option>
                                            <option value="1">Organisation</option>
                                            <option value="2">User</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Create" id="button_create">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function addUser() {
                    var firstName = document.getElementById("add-First_Name").value;
                    var lastName = document.getElementById("add-Last_Name").value;
                    var email = document.getElementById("add-Email").value;
                    var password = document.getElementById('add-Password').value;
                    var phoneNumber = document.getElementById("add-Phone_number").value;
                    var birthdate = document.getElementById("add-Birthdate").value;
                    var country = document.getElementById("add-country").value;
                    var role = document.getElementById("add-role").value;
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "../../controller/User/userCreate.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            location.reload();
                        }
                    };
                    xhttp.send("First_Name=" + encodeURIComponent(firstName) + "&Last_Name=" + encodeURIComponent(lastName) + "&Email=" + encodeURIComponent(email) + "&Password=" + encodeURIComponent(password) + "&Phone_number=" + encodeURIComponent(phoneNumber) + "&Birthdate=" + encodeURIComponent(birthdate) + "&Country=" + encodeURIComponent(country) + "&Role=" + encodeURIComponent(role));
                }

                function deleteUser(id) {
                    if (confirm("Are you sure you want to delete this user?")) {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", '../../controller/User/userDelete.php', true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                console.log('user deleted');
                                location.reload();
                            }
                        }
                        xhr.send("id=" + id);
                    }
                }


                function editUser() {
                    var id = document.getElementById('edit-id-user');
                    var firstName = document.getElementById('edit-First_Name');
                    var lastName = document.getElementById('edit-Last_Name');
                    var email = document.getElementById('edit-Email');
                    var phoneNumber = document.getElementById('edit-Phone_number');
                    var password = document.getElementById('edit-Password');
                    var birthdate = document.getElementById('edit-Birthdate');
                    var country = document.getElementById('edit-country');
                    var role = document.getElementById('edit-role');

                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "../../controller/User/userUpdate.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                            closeEditModal();
                            location.reload();
                        }
                    };
                    xhttp.send("id=" + encodeURIComponent(id.value) +
                        "&firstName=" + encodeURIComponent(firstName.value) +
                        "&lastName=" + encodeURIComponent(lastName.value) +
                        "&email=" + encodeURIComponent(email.value) +
                        "&password=" + encodeURIComponent(password.value) +
                        "&phoneNumber=" + encodeURIComponent(phoneNumber.value) +
                        "&birthdate=" + encodeURIComponent(birthdate.value) +
                        "&country=" + encodeURIComponent(country.value) +
                        "&role=" + encodeURIComponent(role.value));
                    console.log(id.value, firstName.value, lastName.value, email.value, phoneNumber.value, password.value, birthdate.value, country.value, role.value);
                }


                var modal = document.getElementById("editModal");
                var span = document.getElementsByClassName("close")[0];


                span.onclick = function() {
                    modal.style.display = "none";
                };

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };


                function openEditUserModal(userID, firstName, lastName, email, phoneNumber, password, birthdate, country, role) {
                    var modal = document.getElementById("editModal");
                    var id = document.getElementById('edit-id-user');
                    var firstNameElem = document.getElementById('edit-First_Name');
                    var lastNameElem = document.getElementById('edit-Last_Name');
                    var emailElem = document.getElementById('edit-Email');
                    var phoneNumberElem = document.getElementById('edit-Phone_number');
                    var passwordElem = document.getElementById('edit-Password');
                    var birthdateElem = document.getElementById('edit-Birthdate');
                    var countryElem = document.getElementById('edit-country');
                    var roleElem = document.getElementById('edit-role');


                    id.value = userID;
                    firstNameElem.value = firstName;
                    lastNameElem.value = lastName;
                    emailElem.value = email;
                    phoneNumberElem.value = phoneNumber;
                    passwordElem.value = password;
                    birthdateElem.value = birthdate;

                    for (var i = 0; i < countryElem.options.length; i++) {
                        if (countryElem.options[i].value == country) {
                            countryElem.options[i].selected = true;
                            break;
                        }
                    }
                    for (var i = 0; i < roleElem.options.length; i++) {
                        if (roleElem.options[i].value == role) {
                            roleElem.options[i].selected = true;
                            break;
                        }
                    }
                    modal.style.display = "block";
                    console.log(id.value, firstNameElem.value, lastNameElem.value, emailElem.value, phoneNumberElem.value, passwordElem.value, birthdateElem.value, countryElem.value, roleElem.value)

                }

                function closeEditModal() {
                    var modal = document.getElementById("editModal");
                    modal.style.display = "none";
                }

                function openAddUserModal() {
                    var modal = document.getElementById("addModal");
                    document.getElementById('add-First_Name').value = '';
                    document.getElementById('add-Last_Name').value = '';
                    document.getElementById('add-Email').value = '';
                    document.getElementById('add-Phone_number').value = '';
                    addModal.style.display = "block";
                }

                function closeAddModal() {
                    var modal = document.getElementById("addModal");
                    if (modal) {
                        modal.style.display = "none";
                    } else {
                        console.error("Modal element not found or is null");
                    }
                }
            </script>
    </body>

    </html>
</span>