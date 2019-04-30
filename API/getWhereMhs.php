<?php

    include_once "../Config/connection.php";
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->idMhs)) {
        $idMhs = $data->idMhs;

        $query = "SELECT id_mahasiswa, nama_mahasiswa, nim_mahasiswa, kelas_mahasiswa FROM tb_mahasiswa WHERE id_mahasiswa = '$idMhs'";
        $eksekusi = mysqli_query($conn, $query);

        if ($eksekusi) {
            $mahasiswa = array();
            $mahasiswa["data_mahasiswa"] = array();
            while ($key = mysqli_fetch_assoc($eksekusi)) {
                extract($key);
                $mahasiswaIndividu = array(
                    "id_mahasiswa" => $id_mahasiswa,
                    "nama_mahasiswa" => $nama_mahasiswa,
                    "nim_mahasiswa" => $nim_mahasiswa,
                    "kelas_mahasiswa" => $kelas_mahasiswa
                );
                array_push($mahasiswa["data_mahasiswa"], $mahasiswaIndividu);
            }
            http_response_code(200);
            $mahasiswaData = json_encode($mahasiswa);
            echo $mahasiswaData;
        }else{
            http_response_code(400);
            echo json_encode(
                array(
                    "Status" => "0",
                    "Pesan" => "Gagal Mendapatkan Data"
                )
            );
        }
    }else{
        http_response_code(400);
        echo json_encode(
            array(
                "Status" => "0",
                "Pesan" => "Gagal Mendapatkan Data"
            )
        );
    }