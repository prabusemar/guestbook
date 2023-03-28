<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi Buku Tamu</title>
    <!-- CSS stylesheet -->
    <link rel="stylesheet" href="style.css">
    <style>
        .error-message {
            color: red;
            display: none;
            margin-top: 5px;
        }

        .error-input {
            border: 2px solid red;
        }

        #nikError {
            color: red;
            display: none;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <h1>Aplikasi Buku Tamu</h1>
    <!-- Form input -->
    <form method="post" action="simpan.php" onsubmit="return validateForm(), validateFormHP()" enctype="multipart/form-data">
        <label for="nik">NIK:</label>
        <input type="text" name="nik" id="nik" required>
        <div id="nikError"></div>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="no_hp">Nomor Telepon:</label>
        <input type="tel" name="no_hp" id="no_hp" required>
        <div id="no_hp_error" class="error-message"></div>

        <label for="keperluan">Keperluan:</label>
        <textarea name="keperluan" id="keperluan" rows="5" required></textarea>

        <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>

        <label for="waktu_kunjungan">Waktu Kunjungan:</label>
        <input type="time" name="waktu_kunjungan" id="waktu_kunjungan" value="<?php echo date('H:i'); ?>" required>

        <label for="foto">Foto:</label>
        <input type="hidden" name="foto" id="foto">
        <div>
            <video id="video" autoplay></video>
            <button type="button" id="ambil_foto" style="display: none;">Ambil Foto</button>
            <canvas id="canvas" style="display:none"></canvas>
            <img id="preview" style="display:none">
        </div>

        <input type="submit" name="submit" value="Simpan">
    </form>

    <script>
        //Fungsi validasi untuk NIK dan No.HP

        //Validasi NIK
        function validateForm() {
            var nikInput = document.getElementById('nik');
            var nik = nikInput.value;
            var isNumeric = /^\d+$/.test(nik);

            if (nik.length !== 16 || !isNumeric) {
                var nikError = document.getElementById('nikError');
                nikError.style.color = 'red';
                nikError.style.display = 'block';
                nikError.textContent = 'NIK tidak valid';
                nikInput.style.border = '1px solid red';
                return false;
            } else {
                return true;
            }
        }

        //Validasi No.Hp
        function validateFormHP() {
            var noHpInput = document.getElementById('no_hp');
            var noHp = noHpInput.value;
            if (isNaN(noHp) || noHp.length < 12 || noHp.length > 13) {
                var noHpError = document.getElementById('no_hp_error');
                noHpError.innerHTML = 'Nomor Telepon tidak valid';
                noHpError.style.display = 'block';
                noHpInput.style.border = '1px solid red';
                noHpInput.classList.add('error-input');
                return false;
            } else {

                return true;
            }

        }



        //Script untuk mengambil gambar dari webcam
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const preview = document.getElementById('preview');
        const ambilFoto = document.getElementById('ambil_foto');
        const foto = document.getElementById('foto');

        video.addEventListener('canplay', () => {
            ambilFoto.style.display = 'block';
        });

        ambilFoto.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const image = canvas.toDataURL('image/png');
            preview.src = image;
            foto.value = image;
            preview.style.display = 'none';
            ambilFoto.style.display = 'none';
            canvas.style.display = 'none';
            video.pause();
            video.srcObject.getTracks().forEach(track => track.stop());
        });

        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                console.log(error);
            });

        //Untuk mengunci inputan waktu supaya real-time
        // Menentukan elemen input waktu kunjungan
        const inputWaktuKunjungan = document.getElementById('waktu_kunjungan');

        // Memperbarui nilai input waktu kunjungan setiap 5 detik
        setInterval(() => {
            const waktuSekarang = new Date();
            const jam = waktuSekarang.getHours().toString().padStart(2, '0');
            const menit = waktuSekarang.getMinutes().toString().padStart(2, '0');
            inputWaktuKunjungan.value = `${jam}:${menit}`;
        }, 5000); // Ubah nilai interval sesuai dengan kebutuhan
    </script>

</body>

</html>