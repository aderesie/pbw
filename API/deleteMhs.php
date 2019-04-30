<?php

    include_once "../Config/connection.php";
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->idMhs)) {
        $idMhs = $data->idMhs;

        $query = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$idMhs'";
        $eksekusi = mysqli_query($conn, $query);

        if ($eksekusi) {
            http_response_code(200);
            echo json_encode(array(
                "Status" => "1",
                "Pesan" => "Berhasil Hapus Data"
            ));
        }else{
            http_response_code(400);
            echo json_encode(array(
                "Status" => "0",
                "Pesan" => "Gagal Hapus Data"
            ));
        }
    }else{
        http_response_code(400);
        echo json_encode(array(
            "Status" => "0",
            "Pesan" => "ID Belum dimasukkan"
        ));
    }