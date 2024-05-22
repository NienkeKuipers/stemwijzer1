<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo '<script>alert("Passwords do not match."); window.location.href = "registreerpagina.php";</script>';
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo '<script>alert("Username already exists. Please choose another username."); window.location.href = "registreerpagina.php";</script>';
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        if ($stmt->execute()) {
            echo '<script>alert("Registration successful!"); window.location.href = "index.php";</script>';
        } else {
            echo '<script>alert("Error occurred during registration. Please try again."); window.location.href = "registeerpagina.php";</script>';
        }
    }

    $stmt->close();
}

$conn->close();

