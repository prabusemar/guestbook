<!DOCTYPE html>
<html>

<head>
    <title>Daftar Tamu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .search-box {
            margin-bottom: 20px;
            display: flex;
        }

        .search-box input[type="text"] {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            table-layout: fixed;

        }

        th,
        td {
            text-align: left;
            padding: 10px;
            border: 1px solid grey;
            word-wrap: break-word;
            max-width: 200px;
            /* Ubah lebar maksimum sesuai kebutuhan */
            font-size: 14px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        tbody td img {
            max-width: 100%;
            height: auto;
        }

        img {
            max-width: 150px;
            border-radius: 5px;
        }

        .lb-outerContainer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            text-align: center;
        }

        .lb-image {
            display: inline-block;
            margin-top: 20px;
            vertical-align: middle;
            max-height: calc(100% - 80px);
            max-width: calc(100% - 80px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        #pagination {
            margin-top: 20px;
        }

        #pagination button {
            display: inline-block;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        #pagination button:hover {
            background-color: #2E8B57;
        }

        #prevButton {
            display: none;
        }

        .button {
            display: inline-block;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .button:hover {
            background-color: #2E8B57;
        }

        a.button {
            text-decoration: none;
        }

        .delete-button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }

        /* Menampilkan satu baris pada perangkat smartphone */
        @media only screen and (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            /* Styling untuk header kolom */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            /* Styling untuk setiap kolom */
            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            td:nth-of-type(1):before {
                content: "Nama";
            }

            td:nth-of-type(2):before {
                content: "NIK";
            }

            td:nth-of-type(3):before {
                content: "No. HP";
            }

            td:nth-of-type(4):before {
                content: "Keperluan";
            }

            td:nth-of-type(5):before {
                content: "Tanggal Kunjungan";
            }

            td:nth-of-type(6):before {
                content: "Waktu Kunjungan";
            }

            td:nth-of-type(7):before {
                content: "Foto";
            }
        }
    </style>
</head>

<body>
    <h1>Daftar Tamu</h1>
    <div class="container">
        <div class="search-box">
            <input type="text" id="datepicker" placeholder="Pencarian Data">
            <button onclick="searchTable()">Cari</button>
        </div>
        <table id="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>No. HP</th>
                    <th>Keperluan</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Waktu Kunjungan</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                // Membuka file tamu.txt
                $file = fopen('tamu.txt', 'r');

                // Membaca data tamu dari file tamu.txt
                while ($data = fgets($file)) {
                    // Memisahkan data tamu menjadi array
                    $data_tamu = explode(' | ', $data);

                    // Menampilkan data tamu dan foto
                    echo '<tr>';
                    echo '<td>' . $data_tamu[0] . '</td>';
                    echo '<td>' . $data_tamu[1] . '</td>';
                    echo '<td>' . $data_tamu[2] . '</td>';
                    echo '<td>' . $data_tamu[3] . '</td>';
                    echo '<td>' . $data_tamu[4] . '</td>';
                    echo '<td>' . $data_tamu[5] . '</td>';
                    echo '<td><a href="uploads/' . $data_tamu[6] . '" data-lightbox="foto" target="_blank"><img src="uploads/' . $data_tamu[6] . '"></a></td>';
                    echo '<td><button class="delete-button delete-btn" onclick="deleteRow(this)">Delete</button></td>';

                    echo '</tr>';
                }

                // Menutup file tamu.txt
                fclose($file);
                ?>
            </tbody>

        </table>

        <div id="pagination">
            <button id="prevButton" onclick="prevPage()">Previous</button>
            <button id="nextButton" onclick="nextPage()">Next</button>
        </div>
        <a href="index.html" class="button">Kembali ke Halaman Utama</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="script.js"></script>

</body>

</html>