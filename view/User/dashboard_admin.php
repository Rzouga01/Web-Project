<?php
session_start();
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
                    <li>
                        <a href="#" onclick="showProfile()">
                            <i class="fas fa-user"></i>
                            <span class="nav-item">Profile</span>
                        </a>
                    </li>

                    <li><a href="dashboard_admin.php">
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
            <section class="main" id="main-section" style="display: block;">
                <div class="users">
                    <div class="card">
                        <i class="fas fa-users"></i>
                        <h3>Users list</h3>
                        <button onclick="openAddUserModal()" style="float: right;"><i class="fa fa-plus"></i>
                            Add</button>
                        <button style="float: right; margin-right: 10px;"><i class="fa fa-search"></i> Search</button>
                        <div style="float: right; margin-right: 10px;">
                            <button onclick="toggleSortMenu()">
                                <i class="fa fa-sort"></i> Sort
                            </button>
                            <div id="sortOptions" class="sort-options">
                                <a onclick="">ID</a>
                                <a onclick="">First Name</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <?php
                            $userCRUD = new UserCRUD();
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $result = $userCRUD->getAllUsers($page);
                            $users = $result['users'];
                            $total_pages = $result['total_pages'];
                            usort($users, function ($a, $b) {
                                return $a['Status'] - $b['Status'];
                            });
                            if (!empty($users)) {
                                echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone number</th><th>Birthdate</th><th>Country</th><th>Role</th><th>Status</th><th>Action</th></tr>";
                                foreach ($users as $user) {
                                    $class = $user['Status'] == 1 ? 'banned' : '';
                                    echo "<tr class='{$class}'>";
                                    echo "<td>" . htmlspecialchars($user['ID_USER']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['First_Name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['Last_Name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['Phone_number']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['Birthdate']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['Country']) . "</td>";
                                    echo "<td>";
                                    switch ($user['Role']) {
                                        case 0:
                                            echo "Admin";
                                            break;
                                        case 1:
                                            echo "User";
                                            break;
                                        case 2:
                                            echo "Organisation";
                                            break;
                                    }
                                    echo "</td>";
                                    echo "<td class='{$class}'>";
                                    echo $user['Status'] == 1 ? 'Banned' : 'Active';
                                    echo "</td>";
                                    echo "<td>";
                                    if ($user['Status'] == 1) {
                                        echo "<button onclick='unbanUser(\"{$user['ID_USER']}\")'>Unban </button>";
                                    } else {
                                        echo "<button onclick='banUser(\"{$user['ID_USER']}\")'>Ban </button>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                        <div class="pagination">
                            <?php
                            if ($page > 1) {
                                echo "<a href='?page=" . ($page - 1) . "'>❮ Previous</a>";
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $page) {
                                    echo "<a href='?page=$i' class='active'>$i</a>";
                                } else {
                                    echo "<a href='?page=$i'>$i</a>";
                                }
                            }

                            if ($page < $total_pages) {
                                echo "<a href='?page=" . ($page + 1) . "'>Next ❯</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="profile" id="profile-section" style="display: none;">
                <div class="card">
                    <h3>Profile</h3>
                    <table class="table table-bordered">
                        <?php
                        $user = new UserCRUD();

                        if (!empty($user)) {
                            $fields = [
                                'First Name' => $_SESSION['firstName'],
                                'Last Name' => $_SESSION['lastName'],
                                'Email' => $_SESSION['username'],
                                'Phone Number' => $_SESSION['phoneNumber'],
                                'Birthdate' => $_SESSION['birthdate'],
                                'Country' => $_SESSION['country']
                            ];

                            foreach ($fields as $label => $value) {
                                echo "<tr>";
                                echo "<td><strong>" . $label . "</strong></td>";
                                echo "<td>" . htmlspecialchars($value) . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="2">
                                <button onclick="openEditUserModal(
                        '<?php echo $_SESSION['user_id']; ?>',
                        '<?php echo $_SESSION['firstName']; ?>',
                        '<?php echo $_SESSION['lastName']; ?>',
                        '<?php echo $_SESSION['username']; ?>',
                        '<?php echo $_SESSION['phoneNumber']; ?>',
                        '<?php echo $_SESSION['password']; ?>',
                        '<?php echo $_SESSION['birthdate']; ?>',
                        '<?php echo $_SESSION['country']; ?>',
                        '<?php echo $_SESSION['role']; ?>'
                    )" class="btn btn-info">Edit</button>

                                <button onclick="deleteUser('<?php echo $_SESSION['user_id']; ?>');"
                                    class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

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

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="add-role">Role</label>
                                        <select name="Role" id="add-role">
                                            <option selected disabled></option>
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
                    xhttp.onreadystatechange = function () {
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
                        xhr.onreadystatechange = function () {
                            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                console.log('user deleted');
                                location.reload();
                            }
                        }
                        xhr.send("id=" + id);
                    }
                }

                function banUser(id) {
                    if (confirm("Are you sure you want to ban this user?")) {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", '../../controller/User/userBan.php', true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                location.reload();
                            }
                        };
                        xhr.send("id=" + encodeURIComponent(id));
                    }
                }

                function unbanUser(id) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", '../../controller/User/userUnban.php', true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            location.reload();
                        }
                    };
                    xhr.send("id=" + encodeURIComponent(id));
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

                function toggleSortMenu() {
                    var sortOptions = document.getElementById('sortOptions');
                    if (sortOptions.style.display === 'block') {
                        sortOptions.style.display = 'none';
                    } else {
                        sortOptions.style.display = 'block';
                    }
                }

                function showProfile() {
                    var mainSection = document.getElementById("main-section");
                    var profileSection = document.getElementById("profile-section");
                    mainSection.style.display = "none";
                    profileSection.style.display = "block";
                }
                document.addEventListener("DOMContentLoaded", function () {
                    const urlParams = new URLSearchParams(window.location.search);
                    const showProfileParam = urlParams.get('showProfile');

                    if (showProfileParam === 'true') {
                        showProfile();
                    }
                });

            </script>
    </body>

    </html>
</span>