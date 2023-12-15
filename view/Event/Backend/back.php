<?php 

session_start();
include '../../../controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';


$eventC = new EventC();

$listevents = $eventC->Afficher();   

?> 

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="type.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
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
                <li><a href="../../index.php">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Home</span>
                    </a></li>
                    <li><a href="../../User/dashboard_admin.php?showProfile=true.php">
                            <i class="fas fa-user"></i>
                            <span class="nav-item">Profile</span>
                        </a></li>
                <li><a href="../../User/dashboard_admin.php">
                        <i class="fas fa-users"></i>
                        <span class="nav-item">Users</span>
                    </a></li>
                <li><a href="../../Type/dashboard_type.php">
                        <i class="fa fa-list"></i>
                        <span class="nav-item">Types</span>
                    </a></li>
                <li><a href="../../Project/dashboard_project.php">
                        <i class="fa fa-database"></i>
                        <span class="nav-item">Project</span>
                    </a></li>
                <li><a href="../../Reclamation/dashboard_reclamation.php">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="nav-item">Reclamation</span>
                    </a></li>
                <li><a href="../../Reponse/dashboard_reponse.php">
                        <i class="fa fa-envelope-open"></i>
                        <span class="nav-item">Response</span>
                    </a></li>
                    <li><a href="../Backend/back.php">
                            <i class="fa fa-comments"></i>
                            <span class="nav-item">Event</span>
                        </a></li>
                <li><a href="../../Category/dashboard_category.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Category</span>
                    </a></li>
                <li><a href="../../Product/dashboard_product.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Product</span>
                    </a></li>
                    <li><a href="../../Donation/showDonation.php">
						<i class="fas fa-user"></i>
						<span class="nav-item">Donation</span>
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
                    <h3>Events List</h3>
                    <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listevents as $key) { ?>
                      <tr>
                        <td><?php echo $key['Event_name'] ?> </td>
                        <td><?php echo $key['Event_type'] ?></td>
                        <td><?php echo $key['Event_description'] ?></td>
                        <td><?php echo $key['Event_date'] ?></td>
                        <td><?php echo $key['Location'] ?></td>
                       

                        
                        <td>
    <a href="Edit.php?id=<?php echo $key['ID_Event'] ?>">Edit</a>
    <a style="color:red;" href="#" onclick="confirmDelete(<?php echo $key['ID_Event'] ?>)">Delete</a>
</td>

<script>
    function confirmDelete(eventId) {
        var confirmation = confirm("Are you sure you want to delete this event?");
        
        if (confirmation) {
            // If the user clicks "OK" in the confirmation popup, proceed with the deletion
            window.location.href = "DeleteEvent.php?id=" + eventId;
        } else {
            // If the user clicks "Cancel" in the confirmation popup, do nothing
            // You can optionally provide feedback or take other actions here
        }
    }
</script>
                        
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  
                </div>
            </div>

        </section>

 

      
    </div>
    

</body>

</html>
</script>

</body>

</html>