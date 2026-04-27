<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'navbar.php';

/* Fetch courses */
$sql = "SELECT * FROM courses ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container mt-4">

    <h2 class="text-center mb-4">Welcome to Restaurant Management System</h2>

    <!-- Bootstrap Carousel -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img 
                    src="res1.avif"
                    class="d-block w-100"
                    style="height:500px; object-fit:cover;"
                    alt="Learn New Skills"
                >
                <div class="carousel-caption">
                    <h3>Happy Food</h3>
                </div>
            </div>

            <div class="carousel-item">
                <img 
                    src="re2.jpg"
                    class="d-block w-100"
                    style="height:500px; object-fit:cover;"
                    alt="Build Your Career"
                >
                <div class="carousel-caption">
                    <h3>Cooking and item</h3>
                </div>
            </div>

            <div class="carousel-item">
                <img 
                    src="res3.jpg"
                    class="d-block w-100"
                    style="height:500px; object-fit:cover;"
                    alt="Success Starts Here"
                >
                <div class="carousel-caption">
                    <h3>Break Food</h3>
                </div>
            </div>

        </div>

        <button 
            class="carousel-control-prev" 
            type="button" 
            data-bs-target="#carouselExample" 
            data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button 
            class="carousel-control-next" 
            type="button" 
            data-bs-target="#carouselExample" 
            data-bs-slide="next"
        >
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</div>


<!-- View Courses Section -->
<div class="container mt-5">
    <h2 class="mb-4">View Courses</h2>

    <div class="row">

        <?php if ($result && $result->num_rows > 0) { ?>

            <?php while ($row = $result->fetch_assoc()) { ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow">

                        <?php if (!empty($row['image']) && file_exists("uploads/" . $row['image'])) { ?>

                            <img 
                                src="uploads/<?php echo $row['image']; ?>" 
                                class="card-img-top"
                                alt="Course Image"
                                style="height:250px; object-fit:cover;"
                            >

                        <?php } else { ?>

                            <img 
                                src="book1.jpg" 
                                class="card-img-top"
                                alt="No Image"
                                style="height:250px; object-fit:cover;"
                            >

                        <?php } ?>

                        <div class="card-body">

                            <h4><?php echo $row['course_name']; ?></h4>

                            <p><?php echo $row['description']; ?></p>

                            <p>
                                <strong>Duration:</strong>
                                <?php echo $row['duration']; ?>
                            </p>

                            <a 
                                href="edit_course.php?id=<?php echo $row['id']; ?>" 
                                class="btn btn-warning"
                            >
                                Edit
                            </a>

                            <a 
                                href="delete_course.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Are you sure?')"
                            >
                                Delete
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p class="text-center">No food found.</p>

        <?php } ?>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
git commd
git init
git remote add origin https://github.com/rc720/Php_prac2.git
git pull origin main --allow-unrelated-histories

git add .
git commit -m "Init"
git push origin main