<?php
include 'dbconfig.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: dashboard.php');
    exit();
}

// Fetch all stellingen from the database
$result = $conn->query("SELECT * FROM stelling");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Stellingen Dashboard</h2>
        <a href="add_stelling.php">Add New Stelling</a>
        <table>
            <thead>
                <tr>
                    <th>Inhoud</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['inhoud']; ?></td>
                    <td>
                        <a href="edit_stelling.php?id=<?php echo $row['idStelling']; ?>">Edit</a>
                        <a href="delete_stelling.php?id=<?php echo $row['idStelling']; ?>" onclick="return confirm('Are you sure you want to delete this stelling?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
