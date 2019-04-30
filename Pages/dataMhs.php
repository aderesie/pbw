<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan COTS PBW</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body onload="">
    <?php
        session_start();
        if (!isset($_SESSION['statusLogin'])) {
            if ($_SESSION['statusLogin'] !== 1) {
                header('Location: ../index.php');
            }
        }
    ?>
    <div class="container">
        <div class="card-wrapper">
            <div class="card-header">
                <h2>Data Mahasiswa</h2>
            </div>
            <div class="card-body">
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-mahasiswa"></tbody>
                </table>
            </div>
        </div>

        <div class="card-wrapper" style="margin-top:20%;" id="update-wrapper">
            <div class="card-header">
                <h3>Update Data Mahasiswa</h3>
            </div>
            <div class="card-body form-tambah-mahasiswa">
                <input type="hidden" id="idMhs">
                <label for="namaUpdate">nama</label>
                <input type="text" id="namaUpdate" class="input-login">
                <label for="nimUpdate">nim</label>
                <input type="text" id="nimUpdate" class="input-login">
                <label for="kelasUpdate">kelas</label>
                <input type="text" id="kelasUpdate" class="input-login">
                <button onclick="putData(<?= $_SESSION['dataLogin']['id_login']?>)">Update Data Mahasiswa</button>
            </div>
        </div>

        <div class="card-wrapper" style="margin-top:5%;">
            <div class="card-header">
                <h3>Tambahkan Data Mahasiswa</h3>
            </div>
            <div class="card-body form-tambah-mahasiswa">
                <label for="nama">nama</label>
                <input type="text" id="nama" class="input-login">
                <label for="nim">nim</label>
                <input type="text" id="nim" class="input-login">
                <label for="kelas">kelas</label>
                <input type="text" id="kelas" class="input-login">
                <button onclick="ambilDataInputan(<?= $_SESSION['dataLogin']['id_login']?>)">Tambahkan Data Mahasiswa</button>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <script src="../JS/getData.js"></script>
    <script>
        getData();
        function getData() {
            let xmlhttpReq = new XMLHttpRequest();
            xmlhttpReq.onreadystatechange = function () {
                if (xmlhttpReq.status == 200 && xmlhttpReq.readyState == 4) {
                    let dataMhs = JSON.parse(this.response);
                    let text = "";
                    let angka = 1;
                    for (const key in dataMhs) {
                        for (const key1 in dataMhs[key]) {
                            text += "<tr><td>" + angka + "</td><td>" + dataMhs[key][key1].nama_mahasiswa + "</td><td>" + dataMhs[key][key1].nim_mahasiswa + "</td><td>" + dataMhs[key][key1].kelas_mahasiswa + "</td><td><button onclick=\"getWhereData(" + dataMhs[key][key1].id_mahasiswa + ")\">Update Data</button>" + "<button onclick=\"deleteData(" + dataMhs[key][key1].id_mahasiswa + ")\">Hapus Data</button></td></tr>";

                            angka++;
                        }
                    }
                    document.getElementById("tbody-mahasiswa").innerHTML = text;
                }
            }
            xmlhttpReq.open("GET", "../API/getMhs.php", true);
            xmlhttpReq.send();
        }

        function ambilDataInputan(idLogin) {
            let inpNama = document.getElementById("nama").value;
            let inpNim = document.getElementById("nim").value;
            let inpKelas = document.getElementById("kelas").value;

            postData(inpNama, inpNim, inpKelas, idLogin);
            
            document.getElementById("nama").value = null;
            document.getElementById("nim").value = null;
            document.getElementById("kelas").value = null;
        }

        function postData(nama, nim, kelas, idLogin) {
            let data = {
                "nama": nama,
                "nim": nim,
                "kelas": kelas,
                "idLogin": idLogin
            };
            let dataJSON = JSON.stringify(data);
            let xmlhttpReq = new XMLHttpRequest();
            xmlhttpReq.onreadystatechange = function(){
                if (xmlhttpReq.status == 4 && xmlhttpReq.readyState == 201) {
                    let dataMhs = JSON.parse(this.response);
                    console.log(dataMhs);
                }
            }
            xmlhttpReq.open("POST", "../API/postMhs.php", true);
            xmlhttpReq.send(dataJSON);
            setTimeout(function(){
                getData();
            }, 1000);
        }

        function deleteData(idMhs) {
            let data = {
                "idMhs": idMhs
            };
            let dataJSON = JSON.stringify(data);
            let xmlhttpReq = new XMLHttpRequest();
            xmlhttpReq.onreadystatechange = function(){
                if (xmlhttpReq.status == 200 && xmlhttpReq.readyState == 4) {
                    let dataMhs = JSON.parse(this.response);
                    console.log(dataMhs);
                }
            }
            xmlhttpReq.open("DELETE", "../API/deleteMhs.php", true);
            xmlhttpReq.send(dataJSON);
            setTimeout(function(){
                getData();
            }, 500);
        }

        function getWhereData(idMhs) {
            document.getElementById("update-wrapper").style.display = "block";
            let data = {
                "idMhs": idMhs
            }
            let dataJSON = JSON.stringify(data);
            let xmlhttpReq = new XMLHttpRequest();
            xmlhttpReq.onreadystatechange = function(){
                if (xmlhttpReq.status == 200 && xmlhttpReq.readyState == 4) {
                    let dataMhs = JSON.parse(this.response);
                    for (const key in dataMhs) {
                        for (const key1 in dataMhs[key]) {
                            // console.log(dataMhs[key][key1].nama_mahasiswa);
                            document.getElementById("idMhs").value = dataMhs[key][key1].id_mahasiswa;
                            document.getElementById("namaUpdate").value = dataMhs[key][key1].nama_mahasiswa;
                            document.getElementById("nimUpdate").value = dataMhs[key][key1].nim_mahasiswa;
                            document.getElementById("kelasUpdate").value = dataMhs[key][key1].kelas_mahasiswa;
                        }
                    }
                }
            }
            xmlhttpReq.open("POST", "../API/getWhereMhs.php");
            xmlhttpReq.send(dataJSON);
        }

        function putData(idLogin) {
            let nama = document.getElementById("namaUpdate").value;
            let nim = document.getElementById("nimUpdate").value;
            let kelas = document.getElementById("kelasUpdate").value;
            let idMhs = document.getElementById("idMhs").value;
            let data = {
                "nama": nama,
                "nim": nim,
                "kelas": kelas,
                "idLogin": idLogin,
                "idMhs": idMhs
            };
            let dataJSON = JSON.stringify(data);
            let xmlhttpReq = new XMLHttpRequest();
            xmlhttpReq.onreadystatechenge = function(){
                if (xmlhttpReq.status == 200 && xmlhttpReq.readyState == 4) {
                    let dataMhs = JSON.parse(this.response);
                    console.log(dataMhs);
                }
            }
            xmlhttpReq.open("PUT", "../API/putMhs.php", true);
            xmlhttpReq.send(dataJSON);
            document.getElementById("update-wrapper").style.display = "none";
            setTimeout(function(){
                getData();
            }, 500)
        }

    </script>
</body>
</html>