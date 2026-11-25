<?php
include "db.php";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric   = $_POST['matric'];
    $name     = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $stmt = mysqli_prepare($conn, "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $matric, $name, $password, $role);

    try {
        mysqli_stmt_execute($stmt);
        $msg = "<p class='success'>Registration successful. <a href='login.php'>Login here</a></p>";
    } catch (mysqli_sql_exception $e) {
        $msg = "<p class='error'>Error: matric number may already exist.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Registration</h2>
    <?php echo $msg; ?>
    <form method="POST">
        <label>Matric</label>
        <input type="text" name="matric" maxlength="10" required>
        <label>Name</label>
        <input type="text" name="name" maxlength="100" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <label>Role</label>
        <select name="role" required>
            <option value="">Please select</option>
            <option value="lecturer">Lecturer</option>
            <option value="student">Student</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    <p>Already registered? <a href="login.php">Login</a></p>
</div>
</body>
</html>
