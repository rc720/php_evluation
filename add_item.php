<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $menu_name = $_POST['course_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $user_id = $_SESSION['user_id'];
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $uploadDir = __DIR__ . "/uploads/";


    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $targetFile = $uploadDir . basename($image);

    if (move_uploaded_file($tmp, $targetFile)) {

        $stmt = $conn->prepare("INSERT INTO courses (course_name, description, duration, image, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $course_name, $description, $duration, $image, $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('Course Added Successfully'); window.location='view_courses.php';</script>";
            exit();
        } else {
            echo "Database Insert Error!";
        }

    } else {
        echo "Image Upload Failed!";
    }
}
?>

<div class="container mt-4">
    <h2>Add Course</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Course Name</label>
            <input type="text" name="course_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Duration</label>
            <input type="text" name="duration" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Course Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Add Course
        </button>

    </form>
</div>

</body>
</html>
