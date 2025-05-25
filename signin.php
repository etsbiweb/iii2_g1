<?php
session_start();
include 'includes/dbh.inc.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gymnast - Gym Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
</head>
<body>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$showAlert = false;
$alertType = '';
$alertMessage = '';



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = trim($_POST['userName'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $about = trim($_POST['about'] ?? '');

    if ($userName && $gender && $email && $phoneNumber && $address && $about) {
        if ($user->addUser($userName, $gender, $email, $phoneNumber, $address, $about)) {
            $showAlert = true;
            $alertType = 'success';
            $alertMessage = 'Successfully submitted and saved!';
        } else {
            $showAlert = true;
            $alertType = 'danger';
            $alertMessage = 'Database error: Could not save user.';
        }
    } else {
        $showAlert = true;
        $alertType = 'danger';
        $alertMessage = 'Please fill in all fields!';
    }
}


    if (isset($_SESSION['add'])) {
     echo $_SESSION['add'];
     unset($_SESSION['add']);
    }
    if (isset($_SESSION['db_error'])) {
     echo $_SESSION['db_error'];
     unset($_SESSION['db_error']);
    }
   

?>

<!-- Contact Start -->
<div class="container pt-5">
    <div class="d-flex flex-column text-center mb-5">
        <h4 class="text-primary font-weight-bold">Get In Touch</h4>
        <h4 class="display-4 font-weight-bold">Email Us For Any Query</h4>
    </div>

    <section class="kontakt py-5" style="background-color: #111;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h1 class="fw-bold mb-5 text-center" style="color: red;">JOIN </h1>

            <form method="POST" action="">
              <div class="mb-4">
                <input type="text" name="userName" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="User Name">
              </div>

              <div class="mb-4">
                <select name="gender" class="form-control form-control-lg bg-dark text-white border-danger" >
                  <option selected disabled value="">Choose Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>

              <div class="mb-4">
                <input type="email" name="email" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Email Address" >
              </div>

              <div class="mb-4">
                <input type="tel" name="phoneNumber" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Phone Number" >
              </div>

              <div class="mb-4">
                <input type="text" name="address" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Address" >
              </div>

              <div class="mb-4">
                <textarea name="about" class="form-control form-control-lg bg-dark text-white border-danger" rows="4" placeholder="What are your goals ? (build muscle, lose fat...)" ></textarea>
              </div>

              <?php if ($showAlert): ?>
                <div class="alert alert-<?= $alertType ?> text-center fw-bold mb-4" role="alert">
                  <?= htmlspecialchars($alertMessage) ?>
                </div>
              
                <?php
                  $users = $user->prikaziSve();
    if(!empty($users)){
      foreach($users as $user){
        $userID = htmlspecialchars($user['userID']);
        $userName = htmlspecialchars($user['userName']);
        $gender = htmlspecialchars($user['gender']);
        $email = htmlspecialchars($user['email']);
        $phoneNumber = htmlspecialchars($user['phoneNumber']);
        $address = htmlspecialchars($user['address']);
        $about = htmlspecialchars($user['about']);
             
echo "<div class='col-12 col-md-6 col-lg-6 mx-auto'>
         <div class='card border-0 shadow-lg rounded-5 overflow-hidden mb-5'>
           <div class='card-header bg-gradient bg-primary text-white py-4 text-center'>
             <h4 class='mb-1 fw-bold' id='ime-".$userID."'>".$userName."</h4>
             <div class='fw-light' id='broj-".$userID."'>".$gender."</div>
           </div>
           <div class='card-body bg-body-secondary p-4'>
             <ul class='list-group list-group-flush rounded'>
               <li class='list-group-item d-flex justify-content-between align-items-center border-0 border-bottom'>
                 <strong>Email:</strong> <span class='badge text-bg-dark fs-6 px-3 py-2 nastupi-".$userID."'>".$email."</span>
               </li>
               <li class='list-group-item d-flex justify-content-between align-items-center border-0 border-bottom'>
                 <strong>Phone:</strong> <span class='badge text-bg-dark fs-6 px-3 py-2 kosevi-".$userID."'>".$phoneNumber."</span>
               </li>
               <li class='list-group-item d-flex justify-content-between align-items-center border-0 border-bottom'>
                 <strong>Address:</strong> <span class='badge text-bg-dark fs-6 px-3 py-2 asistencije-".$userID."'>".$address."</span>
               </li>
               <li class='list-group-item d-flex justify-content-between align-items-center border-0'>
                 <strong>About:</strong> <span class='badge text-bg-dark fs-6 px-3 py-2 skokovi-".$userID."'>".$about."</span>
               </li>
             </ul>
           </div>
           <div class='card-footer bg-white d-flex justify-content-center gap-4 py-4'>
             <button class='btn btn-outline-success btn-lg edit-btn px-5' data-bs-toggle='modal' data-bs-target='#myModal' data-id=".$userID." id='edit-submit-".$userID."'>⚙ Uredi</button>
             <a href='includes/delete.inc.php?id=".$userID."' class='btn btn-outline-danger btn-lg px-5'>🗑 Obriši</a>
           </div>
         </div>
       </div>";

      }
    }
              
              ?>
              
                <?php endif; ?>

              <div class="text-center">
                <button type="submit" value="add" name="add" class="btn btn-danger btn-lg px-5 py-2 fw-bold text-uppercase" style="border-radius: 0;">
                  Send Message
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</div>
<!-- Contact End -->

<!-- JS libraries etc... -->
</body>
</html>
