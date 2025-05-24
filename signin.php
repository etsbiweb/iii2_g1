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
    $name = trim($_POST['name'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $gender && $email && $phone && $address && $message) {
        $showAlert = true;
        $alertType = 'success';
        $alertMessage = 'Successfully submitted!';
    } else {
        $showAlert = true;
        $alertType = 'danger';
        $alertMessage = 'Please fill in all fields!';
    }
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
                <input type="text" name="name" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Full Name">
              </div>

              <div class="mb-4">
                <select name="gender" class="form-control form-control-lg bg-dark text-white border-danger">
                  <option selected disabled value="">Choose Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>

              <div class="mb-4">
                <input type="email" name="email" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Email Address">
              </div>

              <div class="mb-4">
                <input type="tel" name="phone" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Phone Number">
              </div>

              <div class="mb-4">
                <input type="text" name="address" class="form-control form-control-lg bg-dark text-white border-danger" placeholder="Address">
              </div>

              <div class="mb-4">
                <textarea name="message" class="form-control form-control-lg bg-dark text-white border-danger" rows="4" placeholder="Tell us your goals (build muscle, lose fat...)"></textarea>
              </div>

              <?php if ($showAlert): ?>
                <div class="alert alert-<?= $alertType ?> text-center fw-bold mb-4" role="alert">
                  <?= htmlspecialchars($alertMessage) ?>
                </div>
              <?php endif; ?>

              <div class="text-center">
                <button type="submit" class="btn btn-danger btn-lg px-5 py-2 fw-bold text-uppercase" style="border-radius: 0;">
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
