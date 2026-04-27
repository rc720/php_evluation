<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];

                echo "<script>
                        alert('Login Successful!');
                        window.location='home.php';
                      </script>";
                exit();

            } else {
                echo "<script>alert('Invalid Password!');</script>";
            }

        } else {
            echo "<script>alert('User not found!');</script>";
        }

        $stmt->close();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Login</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        /* Apply box-sizing globally */
        * {
            box-sizing: border-box;
        }

        /* Page base styling */
        body {
            margin: 0;
            padding: 40px;
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
        }

        /* Background animation */
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

        /* Form container */
        .login-box {
            width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 32px black;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
        }

        /* Heading */
        h3 {
            color: white;
            font-weight: bold;
        }

        /* Labels */
        label {
            font-weight: bold;
            color: white;
        }

        /* Inputs */
        input.form-control {
            border-radius: 8px;
            padding: 10px;
        }

        input.form-control:focus {
            border-color: teal;
            box-shadow: none;
        }

        /* Button */
        .btn-primary {
            background-color: teal;
            border: none;
            padding: 10px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: darkcyan;
        }

        /* Register link */
        .register-link {
            color: white;
        }

        .register-link a {
            color: yellow;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
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

<div class="container mt-5">

    <h3 class="text-center mb-4">Login With Us</h3>

    <div class="login-box">

        <form method="POST">

            <div class="mb-3">
                <label>Email</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    required
                >
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    required
                >
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
            >
                Login
            </button>

            <div class="text-center mt-3 register-link">
                Don't have an account?
                <a href="register.php">Register Here</a>
            </div>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>