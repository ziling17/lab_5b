<?php
include "auth.php";
include "db.php";
$result = mysqli_query($conn, "SELECT matric, name, role FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box wide">
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?> | <a href="logout.php">Logout</a></p>
    <h2>User List</h2>
    <table>
        <tr><th>Matric</th><th>Name</th><th>Level</th><th>Action</th></tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['matric']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td>
                <a class="btn" href="update.php?matric=<?php echo urlencode($row['matric']); ?>">Update</a>
                <a class="btn del" href="delete.php?matric=<?php echo urlencode($row['matric']); ?>"
                   onclick="return confirm('Delete this user?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
