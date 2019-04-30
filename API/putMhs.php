<?php

    include_once "../Config/connection.php";
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->nama) && !empty($data->nim) && !empty($data->kelas) && !empty($data->idLogin) && !empty($data->idMhs)) {
        $nama = $data->nama;
        $nim = $data->nim;
        $kelas = $data->kelas;
        $idLogin = $data->idLogin;
        $idMhs = $data->idMhs;

        $query = "UPDATE tb_mahasiswa SET nama_mahasiswa='$nama', nim_mahasiswa='$nim', kelas_mahasiswa='$kelas', id_login='$idLogin' WHERE id_mahasiswa = '$idMhs'";
        $eksekusi = mysqli_query($conn, $query);

        if ($eksekusi) {
            http_response_code(200);
            echo json_encode(
                array(
                    "Status" => "1",
                    "Pesan" => "Berhasil Update Data"
                )
            );
        }
    }else{
        http_response_code(400);
        echo json_encode(
            array(
                "Status" => "0",
                "Pesan" => "Gagal Update Data, Data Tak Lengkap",
                "data" => "$nama $nim $kelas $idLogin $idMhs"
            )
        );
    }