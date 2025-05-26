<?php
include '../includes/dbh.inc.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="admin.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.png" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Admin</h6>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>


                    <a href="admintables.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Table</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="adminsignin.php" class="dropdown-item">Sign In</a>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>

 <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 350px; max-height: 400px; overflow-y: auto;">
    <h6 class="mb-3">Messages</h6>

    <?php
   

    try {
        $stmt = $conn->query("SELECT messageID, message, created_at FROM messages ORDER BY created_at DESC");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($messages && count($messages) > 0):
            foreach ($messages as $row):
    ?>
        <div class="d-flex align-items-center border-bottom py-2 message-item"
            data-message="<?= htmlspecialchars($row['message']) ?>"
            data-id = "<?= $row['messageID']?>">
            <img class="rounded-circle flex-shrink-0" src="img/user.png" alt="" style="width: 40px; height: 40px;">
            <div class="w-100 ms-2">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">anonymous</h6>
                    <small class="text-muted"><?= date("H:i", strtotime($row['created_at'])) ?></small>
                </div>
                <small><?= htmlspecialchars($row['message']) ?></small>
            </div>
        </div>
    <?php
            endforeach;
        else:
            echo '<div class="text-muted">No messages.</div>';
        endif;
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Greška pri dohvaćanju poruka: ' . $e->getMessage() . '</div>';
    }
    ?>
</div>

            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="img/user.png" alt="" style="width: 40px; height: 40px;">
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="../index.php" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
     </nav>
     <!-- Navbar End -->

<!-- Reply Popup -->
<div id="replyPopup" style="position: fixed; bottom: 20px; right: 20px; width: 300px; background: white; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.2); padding: 15px; display: none; z-index: 1050; border-radius: 10px;">
  <h6>Reply to Message</h6>
  <p id="popupMessage" style="font-size: 14px; color: #555;"></p>
  <p id="popupFeedback" style="font-size: 13px; color: green;"></p>

  <form action="../includes/reply.php" id="replyForm" method="POST" >
    <input type="hidden" name="messageID" id="originalMessageInput">
    <div class="mb-2">
      <textarea name="reply" class="form-control" rows="2" style="color:black" placeholder="Type your reply..." required></textarea>
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Send</button>
    <button type="button" class="btn btn-sm btn-secondary" onclick="hidePopup()">Cancel</button>
  </form>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // Otvaranje popupa kad se klikne poruka
    document.querySelectorAll('.message-item').forEach(item => {
        item.addEventListener('click', function () {
            const messageText = this.getAttribute('data-message');
            const messageId = this.getAttribute('data-id');

            document.getElementById('popupMessage').textContent = messageText;
            document.getElementById('originalMessageInput').value = messageId;
            document.getElementById('popupFeedback').textContent = ''; // očisti stari feedback

            document.getElementById('replyPopup').style.display = 'block';
        });
    });

    // AJAX za slanje forme
    document.getElementById('replyForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('../includes/reply.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Prikazi poruku korisniku
            document.getElementById('popupFeedback').textContent = 'Poslali ste poruku.';

            // Očisti textarea
            document.querySelector('#replyForm textarea').value = '';
        })
        .catch(error => {
            document.getElementById('popupFeedback').textContent = 'Došlo je do greške.';
            document.getElementById('popupFeedback').style.color = 'red';
        });
    });
});

function hidePopup() {
    document.getElementById('replyPopup').style.display = 'none';
    document.getElementById('popupFeedback').textContent = '';
}
</script>
      <!-- JavaScript for popup behavior -->
























            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">

                        <h6 class="mb-0">Products</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <!-- Table Header -->
<tr class="text-dark">
    <th scope="col"><input class="form-check-input" type="checkbox"></th>
    <th scope="col">Invoice</th>
    <th scope="col">Name</th>
    <th scope="col">Date</th>
    <th scope="col">Amount</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
</tr>

<!-- Table Rows -->
<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-121</td>
    <td>Whey Protein</td>
    <td>2025-05-01</td>
    <td>$45.00</td>
    <td>Paid</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-122</td>
    <td>Creatin</td>
    <td>2025-04-30</td>
    <td>$30.00</td>
    <td>Pending</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-123</td>
    <td>BCAA</td>
    <td>2025-04-28</td>
    <td>$25.00</td>
    <td>Paid</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-124</td>
    <td>Pre-Workout</td>
    <td>2025-04-26</td>
    <td>$35.00</td>
    <td>Refunded</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-125</td>
    <td>Whey Protein</td>
    <td>2025-04-25</td>
    <td>$45.00</td>
    <td>Paid</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-126</td>
    <td>Creatin</td>
    <td>2025-04-23</td>
    <td>$30.00</td>
    <td>Cancelled</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-127</td>
    <td>BCAA</td>
    <td>2025-04-21</td>
    <td>$25.00</td>
    <td>Paid</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-128</td>
    <td>Pre-Workout</td>
    <td>2025-04-19</td>
    <td>$35.00</td>
    <td>Pending</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-129</td>
    <td>Whey Protein</td>
    <td>2025-04-17</td>
    <td>$45.00</td>
    <td>Paid</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td>INV-130</td>
    <td>BCAA</td>
    <td>2025-04-15</td>
    <td>$25.00</td>
    <td>Refunded</td>
    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
</tr>

                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Users</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                           
                            <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">About</th>
                                </tr>
                            </thead>
                <?php  
$users = $user->prikaziSve();
if(!empty($users)) {
    echo '<tbody>';
    foreach ($users as $user) {
        $userID = htmlspecialchars($user['userID']);
        $userName = htmlspecialchars($user['userName']);
        $gender = htmlspecialchars($user['gender']);
        $email = htmlspecialchars($user['email']);
        $phoneNumber = htmlspecialchars($user['phoneNumber']);
        $address = htmlspecialchars($user['address']);
        $about = htmlspecialchars($user['about']);

        echo '<tr>';
        echo '<th scope="row">' . $userID . '</th>';
        echo '<td>' . $userName . '</td>';
        echo '<td>' . $email . '</td>';
        echo '<td>' . $gender . '</td>';
        echo '<td>' . $about . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
}
?>
                                </tbody>
                        </table>

                        <!-- Recent Sales End -->

                        <!-- JavaScript Libraries -->
                        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                        <script
                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
                        <script src="lib/chart/chart.min.js"></script>
                        <script src="lib/easing/easing.min.js"></script>
                        <script src="lib/waypoints/waypoints.min.js"></script>
                        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
                        <script src="lib/tempusdominus/js/moment.min.js"></script>
                        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
                        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

                        <!-- Template Javascript -->
                        <script src="js/main.js"></script>
</body>

</html>