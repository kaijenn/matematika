<section class="section">
    <div class="row justify-content-center" id="basic-table">
        <div class="col-12 col-md-6"> <!-- Form Hitung Volume Balok -->
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px; text-align: center;">MENGHITUNG VOLUME BALOK</h4>
                </div>
                <div id="content">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" id="cardContainer">
                                <div class="col-md-12 mb-4">
                                    <div class="card bg-light-gray">
                                        <div class="card-body">
                                            <!-- Image -->
                                            <div class="image-container">
                                                <img src="<?= base_url('images/balok.png') ?>" alt="image description" class="center-image" />
                                            </div>

                                            <!-- Judul -->
                                            <h4 class="text-center">Hitung Volume Balok</h4>

                                            <p class="text-center" style="font-size: 1em; font-weight: bold;">
    Rumus: <span style="font-size: 1.1em;">V = p × l × t</span><br>
    atau <span style="font-size: 1.1em;">V = panjang × lebar × tinggi</span>
</p>

                                            <!-- Form Hitung Volume -->
                                            <form id="hitungVolumeForm">
                                                <div class="mb-3">
                                                    <label for="panjang" class="form-label">Masukkan panjang:</label>
                                                    <input type="number" class="form-control" id="panjang" name="panjang" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lebar" class="form-label">Masukkan lebar:</label>
                                                    <input type="number" class="form-control" id="lebar" name="lebar" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tinggi" class="form-label">Masukkan tinggi:</label>
                                                    <input type="number" class="form-control" id="tinggi" name="tinggi" required>
                                                </div>
                                                <div id="hasilVolume" style="display: none; margin-top: 20px;">
                                                    <h4>HASIL:</h4>
                                                    <p id="rumusOutput" style="font-size: 1.5em; color:rgb(48, 48, 48);"></p>
                                                </div>
                                                <button type="submit" class="btn btn-info w-100" style="margin-top: 20px;">Hitung</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End of row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Section -->
        <div class="col-12 col-md-3"> <!-- History lebih kecil -->
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 18px; text-align: center;">History Perhitungan</h4>
                </div>
                <div class="card-body">
                    <div id="historyContent">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Hasil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- History entries will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div id="dynamicContent"></div>

<script>
    // Function to delete history entry only from the form (UI) without affecting the database
    function deleteHistory(id) {
        const row = document.querySelector(`#historyRow${id}`);
        if (row) {
            row.remove();  // Hapus hanya dari tabel UI
        }
    }

    document.getElementById("hitungVolumeForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        
        // Ambil nilai panjang, lebar, dan tinggi dari input
        let panjang = document.getElementById("panjang").value;
        let lebar = document.getElementById("lebar").value;
        let tinggi = document.getElementById("tinggi").value;

        // Validasi jika nilai kosong atau bukan angka
        if (!panjang || isNaN(panjang) || !lebar || isNaN(lebar) || !tinggi || isNaN(tinggi)) {
            alert('Masukkan angka yang valid untuk semua nilai!');
            return;
        }

        // Hitung volume balok
        let volume = panjang * lebar * tinggi; // Volume = panjang × lebar × tinggi

        // Tampilkan hasil di halaman
        let hasil = `V = p =${panjang} × L =${lebar} × t =${tinggi} = ${volume}`;

        document.getElementById("rumusOutput").innerText = hasil;
        document.getElementById("hasilVolume").style.display = "block"; // Menampilkan hasil

        // Buat objek FormData untuk mengirim data ke server
        let formData = new FormData();
        formData.append('panjang', panjang);
        formData.append('lebar', lebar);
        formData.append('tinggi', tinggi);

        fetch('<?= base_url('home/simpan_history_v_balok') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Menunggu respons JSON
        .then(data => {
            if (data.success) {
                console.log('Data berhasil disimpan ke database.');

                // Menambahkan entry ke tabel history secara dinamis
                const newHistoryRow = `
                    <tr id="historyRow${data.id}">
                        <td>${data.hasil}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteHistory(${data.id})">Delete</button>
                        </td>
                    </tr>
                `;

                // Menambahkan row baru ke tabel history
                document.querySelector("#historyContent table tbody").insertAdjacentHTML('beforeend', newHistoryRow);
            } else {
                console.log('Gagal menyimpan data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

        loadHistory();
    });

    // Fungsi untuk mengambil data history dari database dan memperbarui tabel
    function loadHistory() {
        fetch('<?= base_url('home/get_history') ?>')
            .then(response => response.json())
            .then(data => {
                console.log('Data History Terbaru:', data);  // Debug log untuk memastikan data yang diterima
                const tbody = document.querySelector("#historyContent table tbody");
                tbody.innerHTML = '';  // Clear previous rows
                // Loop over data and add rows dynamically
                data.forEach(item => {
                    const newRow = `
                        <tr id="historyRow${item.id}">
                            <td>${item.hasil}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="deleteHistory(${item.id})">Delete</button>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', newRow);  // Add new row to the table
                });
            })
            .catch(error => {
                console.error('Error loading history:', error);
            });
    }

    loadHistory();
</script>

<style>
    .bg-light-gray {
        background-color: #f5f5f5;
    }

    #cardContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .card {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }

    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .center-image {
        max-width: 50%;
        height: auto;
    }

    .form-label {
        font-size: 1.3em;
    }

    /* History Section Styling */
    .col-md-4 {
        flex: 1;
        margin: 10px;
    }

    #historyContent {
        max-height: 300px;
        overflow-y: scroll;
        background-color: #f5f5f5;
        padding: 10px;
    }

    .history-item {
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    .history-item p {
        margin: 0;
        font-size: 1.1em;
        color: rgb(48, 48, 48);
    }
</style>
