<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan COTS PBW</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="card-wrapper">
            <div class="card-header">
                <h2>Login Form</h2>
                <p><?php
                    session_start();
                    if (isset($_SESSION['statusLogin'])) {
                        if ($_SESSION['statusLogin'] == 0) {
                            echo "Gagal Login, Password atau Username Salah!";
                            $_SESSION['statusLogin'] = null;
                        }elseif($_SESSION['statusLogin'] == 1){
                            header('Location: ./pages/dataMhs.php');
                        }
                    }
                ?></p>
            </div>
            <div class="card-body">
                <form action="./Config/auth.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="input-login">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input-login">
                    <input type="submit" name="submit" value="Login Kan">
                </form>
            </div>
        </div>
    </div>
</body>
</html>