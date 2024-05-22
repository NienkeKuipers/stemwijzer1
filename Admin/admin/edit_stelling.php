<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idStelling = $_POST['idStelling'];
    $inhoud = $_POST['inhoud'];

    // Update stelling in the database
    $stmt = $conn->prepare("UPDATE stelling SET inhoud = ? WHERE idStelling = ?");
    $stmt->bind_param("si", $inhoud, $idStelling);
    if ($stmt->execute()) {
        echo '<script>alert("Stelling updated successfully!"); window.location.href = "dashboard.php";</script>';
    } else {
        echo '<script>alert("Error occurred while updating stelling. Please try again."); window.location.href = "edit_stelling.php?id=' . $idStelling . '";</script>';
    }

    $stmt->close();
}

// Fetch the existing stelling data
$idStelling = $_GET['id'];
$stmt = $conn->prepare("SELECT inhoud FROM stelling WHERE idStelling = ?");
$stmt->bind_param("i", $idStelling);
$stmt->execute();
$stmt->bind_result($inhoud);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stelling</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Stelling</h2>
        <form action="edit_stelling.php" method="post">
            <input type="hidden" name="idStelling" value="<?php echo $idStelling; ?>">
            <textarea name="inhoud" placeholder="Stelling inhoud" required><?php echo $inhoud; ?></textarea>
            <button type="submit">Update Stelling</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
