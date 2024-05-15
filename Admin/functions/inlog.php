<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $submitted_username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    // Verify the password
    if ($stmt->num_rows > 0 && $submitted_password === $stored_password) {
        echo '<script>alert("Login successful!"); window.location.href = "adminpanel.php";</script>';
    } else {
        echo '<script>alert("Invalid username or password."); window.location.href = "index.php";</script>';
    }

    $stmt->close();
}

$conn->close();
?>
