<?php 


session_start();
include '../../../controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';
$eventC = new EventC();
if(isset($_GET['id']))
{
    $event=$eventC->getOneById($_GET['id']);
}



          if (isset($_REQUEST['edit'])) {
            $eventC = new EventC();
          
            $date = DateTime::createFromFormat('Y-m-d', $_POST['Event_date']);
            $event = new Event($_GET['id'], $date,$_POST['Event_type'],$_POST['Event_name'],$_POST['Event_description'],$_POST['Location']);
            $eventC->Modifier($event);
            
           
            header('Location:back.php');
          } 
         
       else {
          echo 'error';
          //header('Location:blank.php');
      }
    
    

?> 

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="type.css">
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
                    <li><a href="../User/dashboard_admin.php?showProfile=true.php">
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
                <li><a href="../Project/dashboard_project.php">
                        <i class="fa fa-database"></i>
                        <span class="nav-item">Project</span>
                    </a></li>
                <li><a href="../../Category/dashboard_category.php">
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
                <li><a href="dashboard_category.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Category</span>
                    </a></li>
                <li><a href="../../Product/dashboard_product.php">
                        <i class="fa fa-archive"></i>
                        <span class="nav-item">Product</span>
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
                    <h3>Edit Event</h3>
                    
        <div class="modal-content">
        <div class="container">
        <form method="POST" action="" >
               
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Event Name</label>
                  <div class="col-sm-10">
                    <input name="Event_name" id="Event_name" type="text" value="<?php echo $event['Event_name']?>" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">Event Date</label>
                  <div class="col-sm-10">
                    <input name="Event_date" id="date" value="<?php echo $event['Event_date']?>" type="date" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Event Description </label>
                  <div class="col-sm-10">
                    <input name="Event_description" id="Event_description" value="<?php echo $event['Event_description']?>" type="text" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Event Location </label>
                  <div class="col-sm-10">
                    <input name="Location" id="Location" value="<?php echo $event['Location']?>" type="text" class="form-control" required>
                  </div>
                </div>
                

               
               
               
              
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Type Event</label>
                  <div class="col-sm-10">
                    <select name="Event_type" class="form-select" aria-label="Default select example">
                     
                      <option value="Donation">Donation</option>
                      <option value="Charity">Charity</option>
                      <option value="Adoption">Adoption</option>
                    </select>
                    </div>
                </div>
                    
                
                
      
               

                <div class="row mb-3">
                  
                    <button name="edit" id="edit" type="submit" >Edit</button>
              
                </div>

              </form>
      </div>
    </div> 
                  
                </div>
            </div>

        </section>
        <script>
  var submitBtn = document.getElementById('edit');

  // add event listener to the submit button
  submitBtn.addEventListener('click', function(event) {
    // get the input field
    var input = document.getElementById('Event_name');
    // get the input value
    var value = input.value;

    // check if the input contains only letters and spaces
    if (/^[a-zA-Z\s]+$/.test(value)) {
      // input is valid, allow the form to submit
    } else {
      // input contains non-letter characters, prevent the form from submitting
      event.preventDefault();
      // display error message next to the input field
      var errorMsg = document.createElement('span');
      errorMsg.style.color = 'red';
      errorMsg.innerText = 'Event Name contains only letters';
      input.parentNode.insertBefore(errorMsg, input.nextSibling);
    }
  });
</script>
<script>
  var submitBtn = document.getElementById('edit');

  // add event listener to the submit button
  submitBtn.addEventListener('click', function(event) {
    // get the input field
    var inputDate = document.getElementById('date');    // get the input value
    var currentDate = new Date();
    var selectedDate = new Date(inputDate.value);

    // check if the input contains only letters and spaces
    if (selectedDate >= currentDate)  {
      // input is valid, allow the form to submit
    } else {
      // input contains non-letter characters, prevent the form from submitting
      event.preventDefault();
      // display error message next to the input field
      var errorMsg = document.createElement('span');
      errorMsg.style.color = 'red';
      errorMsg.innerText = 'Date is Invalid';
      inputDate.parentNode.insertBefore(errorMsg, inputDate.nextSibling);
    }
  });
</script>
 

      
    </div>
    

</body>

</html>
</script>

</body>

</html>