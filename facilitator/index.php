<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "isrhh";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch announcements from the database
$sql = "SELECT * FROM announcements ORDER BY created_at DESC"; // Using created_at for sorting
$result = $conn->query($sql);

// Store announcements in an array if there are any results
$announcements = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
} else {
    $announcements = [];
}

// Sample services data (Replace this with actual database query if needed)
$services = [
    [
        'title' => 'General Check-up',
        'definition' => 'Comprehensive health check-up for general wellness.',
        'staff' => 'Dr. John Doe, Nurse Jane Smith',
        'treatment' => 'Basic diagnostic and prescription of medications as needed.',
        'image' => 'img/org.jpg'  // Path updated to img/ directory
    ],
    [
        'title' => 'Vaccination',
        'definition' => 'Immunizations for children and adults to prevent diseases.',
        'staff' => 'Nurse Mary Johnson',
        'treatment' => 'Administering vaccines according to the vaccination schedule.',
        'image' => 'img/org.jpg'  // Path updated to img/ directory
    ],
    [
        'title' => 'Maternal Care',
        'definition' => 'Prenatal and postnatal care for expectant mothers.',
        'staff' => 'Dr. Alice Green, Nurse Emily Brown',
        'treatment' => 'Regular check-ups and guidance during pregnancy.',
        'image' => 'img/org.jpg'  // Path updated to img/ directory
    ]
    
];

$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">
        <title>FACILITATOR LOGIN</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet"  href="css/landing.css">
        <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
    </head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-auto me-auto">
            <h1>VISION</h1>
            <p>It is the Vision of the Naic Rural Health Unit<br> that a better quality of life be enjoyed by the people<br> of Naic with the existence of complete and<br> excellent primary health care service.</p> 
            </div>
            <div class="col-auto">
            <h1>MISSION</h1>
	        <p>It is the mission of the Naic Rural Health Unit<br> to deliver comprehensive, high quality,<br> accesible, affordable, effective, efficient and sustainable<br> health services to all residents of Naic through<br> development of appropriate health technology.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
            <div clas="form-box">
            <form action="checklogin.php" method="POST">
                <img src="img/rr.png" alt="logo" class="mt-1" style="width:70px; height: 60px;">
                <h2>RURAL HEALTH HUB</h2>
                <h6>Facilitator Login</h6>
                <div class="input-field">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" name="username" placeholder="Username" required="required" /> 
                </div>
                <div class="input-field">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" id="password" name="password" placeholder="Password" togglepassword="" required="required" />
                    <span class="eye-icon" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                <div class="btn-field">
                    <button type="submit">Login</botton>
                </div>
            </form>
    </div>
</div>
<div class="container-sm">
        <h3 class="text-center mb-6">ANNOUNCEMENTS</h3>
        <h5>from the ADMINISTRATOR</h5>
        <div class="announcements-container">
            <?php if (empty($announcements)): ?>
                <p>No announcements yet.</p>
            <?php else: ?>
                <?php foreach ($announcements as $announcement): ?>
                    <div class="announcement-card">
                        <div class="row">
                            <?php if (!empty($announcement['image'])): ?>
                                <div class="col-md-6">
                                    <img src="<?php echo htmlspecialchars($announcement['image']); ?>" alt="Announcement Image" class="img-fluid rounded-start">
                                </div>
                            <?php endif; ?>
                            <div class="col-md-<?php echo !empty($announcement['image']) ? '6' : '12'; ?>">
                                <h4><?php echo htmlspecialchars($announcement['title']); ?></h4>
                                <p><strong>Posted on:</strong> <?php echo date("F j, Y", strtotime($announcement['created_at'])); ?></p> <!-- Formatting the created_at date -->
                                <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

       <br>
       <br>
       <br>
        <div class="services-section text-center">
            <h3>Service Offered</h3>
            <div class="container">
                <div class="row">
                    <?php foreach ($services as $service): ?>
                        <div class="col-md-4">
                            <div class="services-card">
                                <img src="<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>">
                                <div class="card-body">
                                    <h4><?php echo htmlspecialchars($service['title']); ?></h4>
                                    <p><strong>Definition:</strong> <?php echo nl2br(htmlspecialchars($service['definition'])); ?></p>
                                    <p><strong>Staff:</strong> <?php echo nl2br(htmlspecialchars($service['staff'])); ?></p>
                                    <p><strong>Treatment:</strong> <?php echo nl2br(htmlspecialchars($service['treatment'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; 2024 Rural Health Unit. All rights reserved.</p>
        </div>
    </div>

<script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
