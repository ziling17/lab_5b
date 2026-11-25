<?php
include "auth.php";
include "db.php";

$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE matric = ?");
mysqli_stmt_bind_param($stmt, "s", $_GET['matric']);
mysqli_stmt_execute($stmt);

header("Location: users.php");
exit();
?>
