<?php
// Database connection
$servername = "localhost";
$username = "Username";
$password = "Password";
$database = "users";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user details into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CodePen - Modern Login Form</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap'>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="wrapper">
    <div class="login_box">
        <div class="login-header">
            <span>Login</span>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input_box">
                <input type="text" id="user" name="user" class="input-field" required>
                <label for="user" class="label">Username</label>
                <i class="bx bx-user icon"></i>
            </div>
            <div class="input_box">
                <input type="password" id="pass" name="pass" class="input-field" required>
                <label for="pass" class="label">Password</label>
                <i class="bx bx-lock-alt icon"></i>
            </div>
            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="forgot">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
            <div class="input_box">
                <input type="submit" class="input-submit" value="Login">
            </div>
            <div class="register">
                <span>Don't have an account? <a href="#">Register</a></span>
            </div>
        </form>
    </div>
</div>
</body>
</html>
