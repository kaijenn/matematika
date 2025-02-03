<section class="section">
    <div class="row justify-content-center" id="basic-table">
        <div class="col-12 col-md-6">
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title text-center" style="text-transform: uppercase; font-size: 30px;">
                        Menghitung Luas Segitiga
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="image-container">
                            <img src="<?= base_url('images/segitiga.png') ?>" alt="Gambar Segitiga" class="center-image" />
                        </div>

                        <h4 class="text-center">Hitung Luas Segitiga</h4>

                        <p class="text-center" style="font-size: 1em; font-weight: bold;">
    Rumus: <span style="font-size: 1.1em;">L = ½ × a × t</span><br>
    atau <span style="font-size: 1.1em;">L = ½ × a × t</span>
</p>

                        <form id="hitungLuasForm">
                            <div class="mb-3">
                                <label for="alas" class="form-label">Masukkan panjang alas:</label>
                                <input type="number" class="form-control" id="alas" name="alas" required>
                            </div>
                            <div class="mb-3">
                                <label for="tinggi" class="form-label">Masukkan tinggi:</label>
                                <input type="number" class="form-control" id="tinggi" name="tinggi" required>
                            </div>
                            <div id="hasilLuas" style="display: none; margin-top: 20px;">
                                <h4>HASIL:</h4>
                                <p id="rumusOutput" style="font-size: 1.5em; color:rgb(48, 48, 48);"></p>
                            </div>
                            <button type="submit" class="btn btn-info w-100" style="margin-top: 20px;">Hitung</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Section -->
        <div class="col-12 col-md-3">
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title text-center" style="text-transform: uppercase; font-size: 18px;">
                        History Perhitungan
                    </h4>
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
document.getElementById("hitungLuasForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    let alas = document.getElementById("alas").value;
    let tinggi = document.getElementById("tinggi").value;

    if (!alas || isNaN(alas) || !tinggi || isNaN(tinggi)) {
        alert('Masukkan angka yang valid untuk alas dan tinggi!');
        return;
    }

    let luas = 0.5 * alas * tinggi;
    let hasil = `L = 1/2 × ${alas} × ${tinggi} = ${luas}`;

    document.getElementById("rumusOutput").innerText = hasil;
    document.getElementById("hasilLuas").style.display = "block";

    let formData = new FormData();
    formData.append('alas', alas);
    formData.append('tinggi', tinggi);

    fetch('<?= base_url('home/simpan_history_l_segitiga') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Data berhasil disimpan ke database.');

            const newHistoryRow = `
                <tr id="historyRow${data.id}">
                    <td>${data.hasil}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteHistory(${data.id})">Delete</button>
                    </td>
                </tr>
            `;

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

function deleteHistory(id) {
    fetch(`<?= base_url('home/delete_history') ?>/${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`#historyRow${id}`).remove();
        } else {
            console.log('Gagal menghapus data.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function loadHistory() {
    fetch('<?= base_url('home/get_history') ?>')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#historyContent table tbody");
            tbody.innerHTML = '';

            data.forEach(item => {
                const newRow = `
                    <tr id="historyRow${item.id}">
                        <td>${item.hasil}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteHistory(${item.id})">Delete</button>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', newRow);
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
