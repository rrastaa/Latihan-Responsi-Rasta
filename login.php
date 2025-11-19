<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['name'];
    $password = $_POST['pass'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $user = $stmt->execute();
    $user = $stmt->get_result();
    if ($user->num_rows > 0) {
        $user = $user->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header('location: dashboard.php');
        }
    } else {
        header('location: login.php?err=salah');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins';
            width: 100%;
            height: 100%;
        }

        .outer {
            width: 100%;
            height: 100%;
        }

        .form {
            padding: 40px;
            width: 400px;
            margin: 150px auto;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin: 5px 0;
        }

        .form div {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            border-radius: 4px;
            border: 2px solid grey;
            padding: 2px 10px;
        }

        button {
            width: 100%;
            border: none;
            background-color: #0d6efd;
            padding: 10px;
            border-radius: 5px;
            color: white;
        }

        .other {
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="outer">
        <div class="form">
            <form action="" method="post">
                <h4>Login</h4>
                <div class="username">
                    <label for="name">Username</label><br>
                    <input type="text" name="name" id="name" placeholder="Username" required>
                </div>
                <div class="password">
                    <label for="pass">Password</label><br>
                    <input type="password" name="pass" id="pass" placeholder="Password" required>
                </div>
                <?php
                if ($_GET['err'] == 'salah') {
                    echo '
                            <div class="alert alert-danger" role="alert">
                                Incorrect Password
                            </div>';
                } elseif ($_GET['err'] == 'loginfirst') {
                    echo '
                            <div class="alert alert-danger" role="alert">
                                You Have Not Logged In :(
                            </div>';
                }
                ?>
                <button type="submit">
                    Login
                </button>
                <div class="other">
                    <div class="login">
                        <p>Belum punya akun?</p>
                        <a href="register.php">Register</a>
                    </div>
                </div>
            </form>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>