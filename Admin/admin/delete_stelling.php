<?php
include 'dbconfig.php';

// Get the stelling ID
$idStelling = $_GET['id'];

// Delete the stelling from the database
$stmt = $conn->prepare("DELETE FROM stelling WHERE idStelling = ?");
$stmt->bind_param("i", $idStelling);
if ($stmt->execute()) {
    echo '<script>alert("Stelling deleted successfully!"); window.location.href = "dashboard.php";</script>';
} else {
    echo '<script>alert("Error occurred while deleting stelling. Please try again."); window.location.href = "dashboard.php";</script>';
}

$stmt->close();
$conn->close();
?>
