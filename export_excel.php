<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=courses.xls");

echo "Course Name\tDescription\tDuration\n";

$result = $conn->query("SELECT * FROM courses WHERE user_id = " . $_SESSION['user_id']);

while ($row = $result->fetch_assoc()) {
    echo $row['menu_name'] . "\t" .
         $row['description'] . "\t" .
         $row['category'] . "\n";
}
exit();
?>