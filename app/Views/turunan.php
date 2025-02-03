<section class="section">
    <div class="row justify-content-center" id="basic-table">
        <div class="col-12 col-md-6"> <!-- Form Hitung Turunan -->
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px; text-align: center;">MENGHITUNG TURUNAN</h4>
                </div>
                <div id="content">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" id="cardContainer">
                                <div class="col-md-12 mb-4">
                                    <div class="card bg-light-gray">
                                        <div class="card-body">
                                            <!-- Judul -->
                                            <h4 class="text-center">Hitung Turunan</h4>

                                            <!-- Form Hitung Turunan -->
                                            <form id="hitungTurunanForm">
                                                <div class="mb-3">
                                                    <label for="fungsi" class="form-label">Masukkan Fungsi (misalnya: 4*x^2):</label>
                                                    <input type="text" class="form-control" id="fungsi" name="fungsi" required>
                                                </div>
                                                <div id="hasilTurunan" style="display: none; margin-top: 20px;">
                                                    <h4>HASIL TURUNAN:</h4>
                                                    <p id="rumusOutput" style="font-size: 1.2em; color:rgb(48, 48, 48);"></p>
                                                </div>
                                                <button type="submit" class="btn btn-info w-100" style="margin-top: 20px;">Hitung Turunan</button>
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

    // Function to calculate the derivative of the input function (for simplicity, only supporting basic cases)
    // Function to calculate the derivative of the input function (for simplicity, only supporting basic cases)
    function hitungTurunan(fungsi) {
    let turunan = '';

    // Regex untuk pola "a*x^n" atau "a*x"
    const regex = /([+-]?\d*)\*?x\^?(\d*)/;
    
    // Check jika fungsi hanya berupa angka (konstanta)
    if (/^[+-]?\d+$/.test(fungsi)) {
        // Fungsi adalah konstanta, turunan dari konstanta adalah 0
        turunan = '0';
    } else {
        // Cek apakah fungsi sesuai dengan pola "a*x^n" atau "a*x"
        const match = fungsi.match(regex);
        if (match) {
            // Penanganan koefisien
            let coefficient = match[1] === '' ? 1 : (match[1] === '-' ? -1 : parseInt(match[1]));
            let exponent = match[2] === '' ? 1 : parseInt(match[2]);

            // Jika eksponen 1, turunan adalah koefisien
            if (exponent === 1) {
                turunan = `${coefficient}`;
            } else if (exponent > 1) {
                // Aturan turunan: n * x^(n-1)
                let newCoefficient = coefficient * exponent;
                let newExponent = exponent - 1;
                turunan = `${newCoefficient}*x^${newExponent}`;
            }
        } else {
            turunan = 'Fungsi tidak dikenali!';
        }
    }

    return turunan;
}


    document.getElementById("hitungTurunanForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah reload halaman
        
        // Ambil nilai fungsi dari input
        let fungsi = document.getElementById("fungsi").value;

        // Validasi jika input kosong
        if (!fungsi) {
            alert('Masukkan fungsi yang valid!');
            return;
        }

        // Hitung turunan fungsi
        let turunan = hitungTurunan(fungsi);

        // Tampilkan hasil di halaman
        document.getElementById("rumusOutput").innerText = `Turunan dari fungsi ${fungsi} adalah: ${turunan}`;
        document.getElementById("hasilTurunan").style.display = "block"; // Menampilkan hasil

        // Simpan hasil turunan ke history
        let formData = new FormData();
        formData.append('fungsi', fungsi);
        formData.append('turunan', turunan);

        fetch('<?= base_url('home/simpan_history_turunan') ?>', {
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
