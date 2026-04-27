<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'navbar.php';

$result = $conn->query("SELECT * FROM courses WHERE user_id = " . $_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Table View</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="table-container">

    <h2>Course Table View</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Image</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td>
                <img
                    src="uploads/<?php echo $row['image']; ?>"
                    width="80"
                    height="60"
                    style="object-fit:cover;"
                >
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
