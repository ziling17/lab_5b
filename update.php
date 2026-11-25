<?php
include "auth.php";
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old    = $_POST['old_matric'];
    $matric = $_POST['matric'];
    $name   = $_POST['name'];
    $role   = $_POST['role'];

    $stmt = mysqli_prepare($conn, "UPDATE users SET matric = ?, name = ?, role = ? WHERE matric = ?");
    mysqli_stmt_bind_param($stmt, "ssss", $matric, $name, $role, $old);
    mysqli_stmt_execute($stmt);

    if ($old == $_SESSION['matric']) {
        $_SESSION['matric'] = $matric;
        $_SESSION['name'] = $name;
    }
    header("Location: users.php");
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT matric, name, role FROM users WHERE matric = ?");
mysqli_stmt_bind_param($stmt, "s", $_GET['matric']);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$user) die("User not found.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Update User</h2>
    <form method="POST">
        <input type="hidden" name="old_matric" value="<?php echo htmlspecialchars($user['matric']); ?>">
        <label>Matric</label>
        <input type="text" name="matric" maxlength="10" value="<?php echo htmlspecialchars($user['matric']); ?>" required>
        <label>Name</label>
        <input type="text" name="name" maxlength="100" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        <label>Access Level</label>
        <select name="role">
            <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
            <option value="student"  <?php if ($user['role'] == 'student')  echo 'selected'; ?>>Student</option>
        </select>
        <button type="submit">Update</button>
        <a href="users.php">Cancel</a>
    </form>
</div>
</body>
</html>
