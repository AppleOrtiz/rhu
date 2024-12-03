<?php
include('dashboard.php');

$conn = new mysqli("localhost", "root", "", "isrhh") or die(mysqli_error($conn));

$query = $conn->query("SELECT * FROM admin_tbl ORDER BY id DESC LIMIT 1") or die(mysqli_error($conn));
$fetch = $query->fetch_array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    $update_query = $conn->query("UPDATE admin_tbl SET username = '$username', email = '$email', password = '$password' WHERE id = '{$fetch['id']}'") or die(mysqli_error($conn));
   
    if ($update_query) {
        echo "<script>alert('Profile updated successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/accs.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main class="mt-2 pt-3">
        <div class="row">
            <div class="col-md-15 mb-3">
                <div class="card">
                    <div class="card-header">
                        <span>
                        <i class="bi bi-person-badge"></i> MY ACCOUNT
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="container-s" border="0" cellpadding="10" cellspacing="0" style="width: 99%;">
                    <tr>
                        <td class="profile-picture" rowspan="2" style="text-align: left; width: 90px; margin-left: 10px;">
                            <?php echo strtoupper($fetch['username'][0]); ?>
                        </td>
                        <td>
                            <h1><?php echo $fetch['username']?></h1>
                            <p><i class="bi bi-envelope-at"></i> <?php echo $fetch['email']; ?></p>
                        </td>
                    </tr>
                </table>
            <hr>
                <form action="" method="post">
                    <h2>Personal Information</h2>
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" value="<?php echo $fetch['username']?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="<?php echo $fetch['email']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <div class="input-group">
                                <input type="password" id="password" name="password" value="<?php echo $fetch['password']; ?>" required>
                                <span class="input-group-text eye-icon" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                           
                            <button type="submit" class="btn btn-sm btn-info">Update</button> 
    </div> 
                    </div>
                </form>

                    </div>
                </div>
            </div>
        </div>

        
    </main>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye-slash');
            this.querySelector('i').classList.toggle('bi-eye');
        });
    </script>
</body>
</html>