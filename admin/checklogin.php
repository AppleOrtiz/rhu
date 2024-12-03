<?php
    session_start();

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $db_name = "isrhh";
    // Create connection
        $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

    // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=mysqli_real_escape_string($conn, $_POST['username']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
    $bool=true;
    
    $query = mysqli_query($conn,"Select * from admin_tbl WHERE username='$username'"); // Query the users table
    $exists = mysqli_num_rows($query); //Checks if username exists
    $table_admin = "";
    $table_password = "";

    if($exists > 0) //IF there are no returning rows or no existing username
    {
        while($row = mysqli_fetch_assoc($query)) // display all rows from query
        {
            $table_admin = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
            $table_password = $row['password']; // the first password row is passed on to $table_password, and so on until the query is finished
            
        }
    if(($username == $table_admin) && ($password == $table_password))//checks if there are any matching fields
    {
        if($password == $table_password)
        {
            $_SESSION['admin'] = $username; //set the username in a session. This serves as a global variable
            header("location: dash.php"); // redirects the user to the authenticated home page
        }
    }
    else
    {
        Print '<script>alert("Your Password was incorrect!");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; //redirects to login.php
    }
}
else
{
        Print '<script>alert("Your Username was incorrect!");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; //redirects to login.php
}

    }
   
?>