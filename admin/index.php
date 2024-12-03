<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">
        <title>ADMINISTRATOR LOGIN</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet"  href="css/landss.css">
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
