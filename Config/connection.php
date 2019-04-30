<?php

    $conn = mysqli_connect('localhost', 'root', '', 'db_latihancotspbw');
    if (!$conn) {
        die("Gagal terkoneksi ke DB");
    }