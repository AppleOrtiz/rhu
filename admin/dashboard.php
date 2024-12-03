<!DOCTYPE html>
<html lang="en">

<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR DASHBOARD</title>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css" />
        <style>
            main{
                margin-left: 280px;
                padding: -10px;
                background-color: #fff;
                justify-content: center;
            }
        </style>
</head>
<?php
session_start(); //starts the session
    if($_SESSION['admin']){ // checks if the user is logged in
    }
    else{
        header("location: index.php"); // redirects if user is not logged in
    }

    $admin = $_SESSION['admin']; //assigns user value
?>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidenav" id="sidebar">
            <div class="sidebar-logo">
            <img src="img/rr.png" alt="logo" class="mt-0.5" style="width:35px; height:35px; margin-left:-22px; margin-right:3px;">
            <a href="#"> RURAL HEALTH HUB</a>
            </div>
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav p-0">
                <li class="sidebar-item">
                    <a href="dash.php" class="sidebar-link">
                    <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="create-ad.php" class="sidebar-link">
                    <i class="bi bi-person-fill-add"></i>
                        <span>Create Admin</span>
                    </a>
                </li>
                
                
                <li class="sidebar-item">
                    <a href="patients.php" class="sidebar-link">
                    <i class="bi bi-file-earmark-person-fill"></i>
                        <span>Patients Record</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="add.php" class="sidebar-link">
                    <i class="bi bi-file-earmark-fill"></i>
                        <span>Health Form</span>
                    </a>
                </li>
              
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="bi bi-prescription2"></i>
                        <span>Health Tracker</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="bmi.php" class="sidebar-link"><i class="bi bi-speedometer"></i> BMI Tracker</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="track.php" class="sidebar-link"><i class="bi bi-activity"></i> Calorie Tracker</a>
                        </li>
                    </ul>
                </li>
            
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#side" aria-expanded="false" aria-controls="side">
                        <i class="bi bi-file-earmark-check-fill"></i>
                        <span>Services</span>
                    </a>
                    <ul id="side" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                            <a href="announcement.php" class="sidebar-link"><i class="bi bi-megaphone"></i> Announcement</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="healthform.php" class="sidebar-link"><i class="bi bi-clipboard2-data"></i> Data Forms</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="brochure.php" class="sidebar-link"><i class="bi bi-journal-text"></i> Brochures</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="manual.php" class="sidebar-link"><i class="bi bi-book"></i> User Guide</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="archive.php" class="sidebar-link">
                    <i class="bi bi-archive-fill"></i>
                        <span>Archive Data</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="time_log.php" class="sidebar-link">
                    <i class="bi bi-clock-history"></i></i>
                        <span>User's Time Log</span>
                    </a>
                </li>

            </ul>

            

            <!-- Sidebar Navigation Ends -->
            <li class="sidebar-footer">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#set" aria-expanded="false" aria-controls="set">
                        <i class="bi bi-person-fill"></i> <?php echo $admin; ?>
                        <span></span>
                    </a>
                    <ul id="set" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="account.php" class="sidebar-link">
                                <i class="bi bi-person-circle"></i>
                                <span> Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="logout.php" class="sidebar-link" >
                                <i class="bi bi-box-arrow-left"></i>
                                <span> Logout</span>
                            </a>
                        </li>
                    </ul>
            </li>
</nav>
       
        
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>