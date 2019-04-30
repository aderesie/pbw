<?php
    include_once './connection.php';
    session_start();

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query = "SELECT id_login, username, nama FROM tb_login WHERE username='$username' AND password='$password'";
        $hasil = mysqli_query($conn, $query);
        foreach($hasil as $key){
            $dataLogin = $key;
        }
        
        if ($hasil->num_rows == 1) {
            header('Location: ../pages/dataMhs.php');
            $_SESSION['statusLogin'] = 1;
            $_SESSION['dataLogin'] = $dataLogin;
            // var_dump($_SESSION['dataLogin']);
        }else{
            header('Location: ../index.php');
            $_SESSION['statusLogin'] = 0;
        }
    }