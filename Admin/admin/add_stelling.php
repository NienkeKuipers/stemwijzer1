<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inhoud = $_POST['inhoud'];

    // Insert new stelling into the database
    $stmt = $conn->prepare("INSERT INTO stelling (inhoud) VALUES (?)");
    $stmt->bind_param("s", $inhoud);
    if ($stmt->execute()) {
        echo '<script>alert("Stelling added successfully!"); window.location.href = "dashboard.php";</script>';
    } else {
        echo '<script>alert("Error occurred while adding stelling. Please try again."); window.location.href = "add_stelling.php";</script>';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stelling</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add New Stelling</h2>
        <form action="add_stelling.php" method="post">
            <textarea name="inhoud" placeholder="Stelling inhoud" required></textarea>
            <button type="submit">Add Stelling</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
