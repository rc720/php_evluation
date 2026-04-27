<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $raw_password = $_POST['password'];

    if (empty($name) || empty($email) || empty($raw_password)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {

        $password = password_hash($raw_password, PASSWORD_DEFAULT);

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {

            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Registration Successful!');
                        window.location='login.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Registration Failed!');</script>";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Register</title>

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

        .register-box {
            width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 32px black;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
        }

        h3 {
            color: white;
            font-weight: bold;
        }

        label {
            font-weight: bold;
            color: white;
        }

        input.form-control {
            border-radius: 8px;
            padding: 10px;
        }

        input.form-control:focus {
            border-color: teal;
            box-shadow: none;
        }

        .btn-primary {
            background-color: teal;
            border: none;
            padding: 10px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: darkcyan;
        }

        .login-link {
            color: white;
        }

        .login-link a {
            color: yellow;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

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

    <h3 class="text-center mb-4">Register With Us</h3>

    <div class="register-box">

        <form method="POST">

            <div class="mb-3">
                <label>Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    required
                >
            </div>

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
                Register
            </button>

            <div class="text-center mt-3 login-link">
                Already have an account?
                <a href="login.php">Login Here</a>
            </div>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>