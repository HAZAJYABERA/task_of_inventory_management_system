<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body bgcolor="skyblue">
<center>
    <h2>Registration Form</h2>
    <form action="register.php" method="post">
        <label>user_id:</label>
        <input type="text" name="user_id" placeholder="user_id" required><br><br><br>
        <label>username:</label>
        <input type="text" name="username" placeholder="username" required><br><br><br>

        <label>First_name:</label>
        <input type="text" name="first_name" placeholder="fname" required><br><br>

        <label>Last_name:</label>
        <input type="text" name="last_name" placeholder="lname" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" placeholder="enter your email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" placeholder="enter your password" required><br><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="male" checked>Male
        <input type="radio" name="gender" value="female">Female<br><br>

        <input type="submit" name="register" value="Register">
        <input type="reset" name="cancel" value="Cancel">
    </form>
</center>
</body>

</html>
<?php
include('database.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Retrieving form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];

    // Preparing SQL query
    $sql = "INSERT INTO user (user_id, username, First_name, Last_name, Email, Password, Gender) 
            VALUES ('$user_id', '$username', '$first_name', '$last_name', '$email', '$password', '$gender')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
