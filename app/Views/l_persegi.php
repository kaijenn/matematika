<section class="section">
    <div class="row justify-content-center" id="basic-table">
        <div class="col-12 col-md-6"> <!-- Form Hitung Luas tetap besar -->
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px; text-align: center;">MENGHITUNG LUAS PERSEGI</h4>
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
                                                <img src="<?= base_url('images/persegi.png') ?>" alt="image description" class="center-image" />
                                            </div>

                                            <!-- Judul -->
                                            <h4 class="text-center">Hitung Luas Persegi</h4>
                                            
                                            <p class="text-center" style="font-size: 1em; font-weight: bold;">
    Rumus: <span style="font-size: 1.1em;">L = s × s</span><br>
    atau <span style="font-size: 1.1em;">L = s<sup>2</sup></span>
</p>
                                            <!-- Form Hitung Luas -->
                                            <form id="hitungLuasForm">
                                                <div class="mb-3">
                                                    <label for="sisi" class="form-label">Masukkan panjang sisi:</label>
                                                    <input type="number" class="form-control" id="sisi" name="sisi" required>
                                                </div>
                                                <div id="hasilLuas" style="display: none; margin-top: 20px;">
                                                    <h4>HASIL:</h4>
                                                    <p id="rumusOutput" style="font-size: 1.3em; color:rgb(48, 48, 48);"></p>
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
    // Function to load "Tambah Jurusan" form dynamically
    function loadTambahLuasForm() {
        // Fetch and load the form for adding a new jurusan
        fetch('<?= base_url('home/t_luas') ?>') // Endpoint for adding siswa form
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToRumusList()">
                        <i class="fe fe-arrow-left"></i> Back to luas List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form tambah user.');
            });
    }

    // Function to load "Edit Jurusan" form dynamically
    function loadEditLuasForm(id_rumus) {
        // Fetch and load the edit form for the rumus
        fetch('<?= base_url('home/e_rumus') ?>/' + id_rumus) // Endpoint for editing jurusan
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToRumusList()">
                        <i class="fe fe-arrow-left"></i> Back to Rumus List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form edit jurusan.');
            });
    }

    // Function to return to the jurusan list
    function backToRumusList() {
        // Show the section again
        document.querySelector('.section').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }


    // Function to delete history entry only from the form (UI) without affecting the database
function deleteHistory(id) {
    // Find the row to delete
    const row = document.querySelector(`#historyRow${id}`);
    
    // Remove the row from the table
    if (row) {
        row.remove();
    }
}




document.getElementById("hitungLuasForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Mencegah reload halaman
    
    // Ambil nilai sisi dari input
    let sisi = document.getElementById("sisi").value;

    // Validasi jika sisi kosong atau bukan angka
    if (!sisi || isNaN(sisi)) {
        alert('Masukkan angka yang valid!');
        return;
    }

    // Hitung luas
    let hasil = `L = ${sisi} × ${sisi} = ${sisi * sisi}`;

    // Tampilkan hasil di halaman
    document.getElementById("rumusOutput").innerText = hasil;
    document.getElementById("hasilLuas").style.display = "block"; // Menampilkan hasil

    // Buat objek FormData untuk mengirim data sisi ke server
    let formData = new FormData();
    formData.append('sisi', sisi);

    fetch('<?= base_url('home/simpan_history_l_persegi') ?>', {
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

// Fungsi untuk menghapus entry dari history secara dinamis (UI)
function deleteHistory(id) {
    const row = document.querySelector(`#historyRow${id}`);
    if (row) {
        row.remove();  // Hapus hanya dari tabel UI
    }
}

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