<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurant Management</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        /* Apply box-sizing globally */
        * {
            box-sizing: border-box;
        }

        /* Body background */
        body {
            margin: 0;
            font-family: Arial, sans-serif;

            background: linear-gradient(
                100deg,
                rgb(255, 145, 0),
                rgb(222, 30, 196),
                rgb(209, 205, 201),
                rgb(85, 5, 19),
                rgb(40, 60, 158),
                rgb(106, 92, 65)
            );

            background-size: 400% 400%;
            animation: grad 6s ease infinite;
            min-height: 100vh;
        }

        /* Animated background */
        @keyframes grad {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Navbar styling */
        .navbar {
            background: rgba(0, 0, 0, 0.75) !important;
            backdrop-filter: blur(8px);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
            padding: 15px 0;
        }

        /* Brand */
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #fff !important;
            letter-spacing: 1px;
        }

        /* Nav links */
        .nav-link {
            color: white !important;
            font-weight: 500;
            margin-right: 10px;
            transition: 0.3s;
            border-radius: 6px;
            padding: 8px 14px !important;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: yellow !important;
        }

        /* Logout button */
        .btn-danger {
            background-color: crimson;
            border: none;
            font-weight: bold;
            padding: 8px 18px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-danger:hover {
            background-color: darkred;
            transform: scale(1.05);
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none;
                transition: none;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand" href="home.php">
            Cookies
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarNav"
        >

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="home.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="add_course.php">
                        Add Menu item
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="view_courses.php">
                        View Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="export_excel.php">
                        Export Data
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="pdf.php">
                        Export PDF
                    </a>
                </li>

            </ul>

            <a
                href="logout.php"
                class="btn btn-danger"
            >
                Logout
            </a>

        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>