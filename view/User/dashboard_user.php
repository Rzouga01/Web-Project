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
        <link rel="stylesheet" href="..\dashboard.css" />
        <link rel="stylesheet" href="style.css" />
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
                    <li><a href="dashboard_user.php">
                            <i class="fas fa-user"></i>
                            <span class="nav-item">Profile</span>
                        </a></li>
                    <li><a href="../Reponse/dashboard_reponse.php">
                            <i class="fa fa-envelope-open"></i>
                            <span class="nav-item">Messages</span>
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
                <div class="profile">
                    <div class="card">
                        <h3>Profile</h3>
                        <img src="../../assets/images/user.png" alt="User Photo">
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
                                     '<?php echo $_SESSION['user_id']; ?>' ,
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
                </div>
            </section>
            <div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <div class="container">
                        <form id="editForm" onsubmit="event.preventDefault(); editUser();">
                            <input type="hidden" id="edit-id-user" name="ID_USER">
                            <table>
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
                                    <td><input type="password" id="edit-Password" name="Password"></td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Birthdate">Birthdate</label></td>
                                    <td><input type="date" id="edit-Birthdate" name="Birthdate"></td>
                                </tr>
                                <tr>
                                    <td><label for="edit-Country">Country</label></td>
                                    <td>
                                        <select id="edit-Country" name="Country">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Åland Islands">Åland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean
                                                Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic
                                                Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                                            </option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories
                                            </option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald
                                                Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                                            </option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic
                                                People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic
                                                Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The
                                                Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States
                                                of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory,
                                                Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The
                                                Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia
                                                and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of
                                            </option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor
                                                Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Save Changes" id="button_save">
                                    </td>
                                    <td>> <input type="button" value="Discard Changes" id="button_discard"
                                            onclick="closeEditModal()"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function deleteUser(id) {
                    console.log("Function deleteUser called with id: ", id);
                    if (confirm("Are you sure you want to delete your account?")) {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", '../../controller/User/userDelete.php', true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                console.log('user deleted');
                                window.location.href = '../../controller/User/logout.php';
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
                    var country = document.getElementById('edit-Country');

                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "../../controller/User/userUpdate.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.onreadystatechange = function () {
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
                        "&country=" + encodeURIComponent(country.value));
                    console.log(id.value, firstName.value, lastName.value, email.value, phoneNumber.value, password.value, birthdate.value, country.value);
                }

                var modal = document.getElementById("editModal");
                var span = document.getElementsByClassName("close")[0];

                span.onclick = function () {
                    modal.style.display = "none";
                };

                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };

                function openEditUserModal(userID, firstName, lastName, email, phoneNumber, password, birthdate, country) {
                    var modal = document.getElementById("editModal");
                    var id = document.getElementById('edit-id-user');
                    var firstNameElem = document.getElementById('edit-First_Name');
                    var lastNameElem = document.getElementById('edit-Last_Name');
                    var emailElem = document.getElementById('edit-Email');
                    var phoneNumberElem = document.getElementById('edit-Phone_number');
                    var passwordElem = document.getElementById('edit-Password');
                    var birthdateElem = document.getElementById('edit-Birthdate');
                    var countryElem = document.getElementById('edit-Country');

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

                    modal.style.display = "block";
                    console.log(id.value, firstNameElem.value, lastNameElem.value, emailElem.value, phoneNumberElem.value, passwordElem.value, birthdateElem.value, countryElem.value)

                }

                function closeEditModal() {
                    var modal = document.getElementById("editModal");
                    modal.style.display = "none";
                }
            </script>
    </body>

    </html>
</span>