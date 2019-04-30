<?php
    include_once "../config/connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->nama) && !empty($data->nim) && !empty($data->kelas)) {
        $nama = $data->nama;
        $nim = $data->nim;
        $kelas = $data->kelas;
        $idLogin = $data->idLogin;

        $query = "INSERT INTO tb_mahasiswa(nama_mahasiswa, nim_mahasiswa, kelas_mahasiswa, id_login) VALUES('$nama', '$nim', '$kelas', '$idLogin')";
        $eksekusi = mysqli_query($conn, $query);

        if ($eksekusi) {
            http_response_code(201);
            echo json_encode(
                array(
                    "Status" => "1",
                    "Pesan" => "Berhasil Menambahkan Data!"
                )
            );
        }else{
            http_response_code(503);
            echo json_encode(
                array(
                    "Status" => "0",
                    "Pesan" => "Gagal Menambahkan Data"
                )
            );
        }
    }else{
        http_response_code(400);
        echo json_encode(
            array(
                "Status" => "0",
                "Pesan" => "Gagal Menambahkan Data!"
            )
        );
    }
    