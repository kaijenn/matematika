<section class="section">
    <div class="row justify-content-center" id="basic-table">
        <div class="col-12 col-md-6"> <!-- Form Hitung Limit -->
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px; text-align: center;">MENGHITUNG LIMIT</h4>
                </div>
                <div id="content">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" id="cardContainer">
                                <div class="col-md-12 mb-4">
                                    <div class="card bg-light-gray">
                                        <div class="card-body">
                                            <!-- Judul -->
                                            <h4 class="text-center">Hitung Limit</h4>

                                            <!-- Form Hitung Limit -->
                                            <form id="hitungLimitForm">
                                                <div class="mb-3">
                                                    <label for="fungsi" class="form-label">Masukkan Fungsi (misalnya: 4*x^2 - 6*x + 1):</label>
                                                    <input type="text" class="form-control" id="fungsi" name="fungsi" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nilaiX" class="form-label">Masukkan Nilai x (misalnya: 2):</label>
                                                    <input type="number" class="form-control" id="nilaiX" name="nilaiX" required>
                                                </div>
                                                <div id="hasilLimit" style="display: none; margin-top: 20px;">
                                                    <h4>HASIL LIMIT:</h4>
                                                    <p id="rumusOutput" style="font-size: 1.2em; color:rgb(48, 48, 48);"></p>
                                                </div>
                                                <button type="submit" class="btn btn-info w-100" style="margin-top: 20px;">Hitung Limit</button>
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

<script>
    // Function to delete history entry only from the form (UI) without affecting the database
    function deleteHistory(id) {
        const row = document.querySelector(`#historyRow${id}`);
        if (row) {
            row.remove();  // Hapus hanya dari tabel UI
        }
    }

    // Function to calculate the limit of the input function
    // Function to calculate the limit of the input function
function hitungLimit(fungsi, nilaiX) {
    try {
        // Perbaiki input fungsi untuk memastikan format yang benar (misalnya, 4x menjadi 4*x)
        fungsi = fungsi.replace(/(\d)(x)/g, '$1*$2');  // Mengganti angka yang diikuti x menjadi angka * x

        // Evaluasi fungsi dengan x yang diberikan
        const func = new Function('x', `return ${fungsi}`);
        const result = func(nilaiX);

        return result;
    } catch (error) {
        return 'Fungsi tidak valid!';
    }
}

document.getElementById("hitungLimitForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Mencegah reload halaman

    // Ambil nilai fungsi dan nilai x dari input
    let fungsi = document.getElementById("fungsi").value;
    let nilaiX = parseFloat(document.getElementById("nilaiX").value);

    // Validasi jika input kosong
    if (!fungsi || isNaN(nilaiX)) {
        alert('Masukkan fungsi dan nilai x yang valid!');
        return;
    }

    // Hitung limit fungsi
    let hasilLimit = hitungLimit(fungsi, nilaiX);

    // Tampilkan hasil di halaman
    document.getElementById("rumusOutput").innerText = `Limit dari fungsi ${fungsi} ketika x = ${nilaiX} adalah: ${hasilLimit}`;
    document.getElementById("hasilLimit").style.display = "block"; // Menampilkan hasil

    // Simpan hasil limit ke history
    let formData = new FormData();
    formData.append('fungsi', fungsi);
    formData.append('nilaiX', nilaiX);
    formData.append('hasil', hasilLimit);

    fetch('<?= base_url('home/simpan_history_limit') ?>', {
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
