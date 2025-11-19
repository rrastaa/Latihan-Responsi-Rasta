<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $username=$_POST['name'];
    $password=$_POST['pass'];
    $hashed=password_hash($password,PASSWORD_BCRYPT);
    $stmt=mysqli_prepare($conn,"INSERT INTO users (username,password) VALUES (?,?)");
    $stmt->bind_param("ss",$username,$hashed);
    if ($stmt->execute()) {
        header('Location: login.php');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
            background-color: #1a8754;
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
                <h4>Register</h4>
                <div class="username">
                    <label for="name">Username</label><br>
                    <input type="text" name="name" id="name" placeholder="Username" required>
                </div>
                <div class="password">
                    <label for="pass">Password</label><br>
                    <input type="password" name="pass" id="pass" placeholder="Password" required>
                </div>
                <button type="submit">
                    Register
                </button>
                <div class="other">
                    <div class="login">
                        <p>Sudah punya akun?</p>
                        <a href="login.php">Login</a>
                    </div>
                </div>
            </form>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>