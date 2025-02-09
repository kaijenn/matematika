<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-5 mx-auto">
        <div class="card p-4 shadow-sm text-center">
            <h2 class="mb-3">Calculator</h2>
            <div class="form-control text-end fs-2 mb-3" id="display">0</div>

            <div class="row g-2">
                <div class="col-3"><button class="btn btn-danger w-100" onclick="clearDisplay()">C</button></div>
                <div class="col-3"></div>
                <div class="col-3"><button class="btn btn-dark w-100" onclick="hapusSatuAngka()">⌫</button></div>
                <div class="col-3"><button class="btn btn-light w-100" onclick="setOperator('/')">÷</button></div>

                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('7')">7</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('8')">8</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('9')">9</button></div>
                <div class="col-3"><button class="btn btn-light w-100" onclick="setOperator('*')">×</button></div>

                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('4')">4</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('5')">5</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('6')">6</button></div>
                <div class="col-3"><button class="btn btn-light w-100" onclick="setOperator('-')">-</button></div>

                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('1')">1</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('2')">2</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('3')">3</button></div>
                <div class="col-3"><button class="btn btn-light w-100" onclick="setOperator('+')">+</button></div>

                <div class="col-3"><button class="btn btn-secondary w-100" onclick="toggleNegatif()">+/-</button></div>
                <div class="col-3"><button class="btn btn-secondary w-100" onclick="tambahAngka('0')">0</button></div>
                <div class="col-3"><button class="btn btn-warning w-100" onclick="tambahAngka('.')">.</button></div>
                <div class="col-3"><button class="btn btn-info w-100" onclick="hitung()">=</button></div>
            </div>

            <!-- Table History -->
            <h3 class="mt-4">History</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perhitungan</th>
                        <th>Hasil</th>
                    </tr>
                </thead>
                <tbody id="historyTable">
                    <!-- Data history akan ditampilkan di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let currentInput = '';
let operator = '';
let firstValue = '';
let hasilTerakhir = null;
let history = []; // Array untuk menyimpan history perhitungan

// Update tampilan display kalkulator
function updateDisplay() {
    let displayText = firstValue + (operator ? ' ' + operator : '') + (currentInput ? ' ' + currentInput : '');
    document.getElementById("display").innerText = displayText.trim() || '0';
}

// Fungsi untuk menambah angka ke input
function tambahAngka(angka) {
    if (hasilTerakhir !== null && operator === '') {
        firstValue = angka;
        hasilTerakhir = null;
    } else if (!operator) {
        firstValue += angka;
    } else {
        currentInput += angka;
    }
    updateDisplay();
}

// Set operator perhitungan
function setOperator(op) {
    if (hasilTerakhir !== null) {
        firstValue = hasilTerakhir.toString();
        hasilTerakhir = null;
    }

    if (firstValue !== '') {
        operator = op;
        currentInput = '';
    }
    updateDisplay();
}

// Fungsi perhitungan
function hitung() {
    if (!operator || !firstValue || !currentInput) return;

    let angka1 = parseFloat(firstValue);
    let angka2 = parseFloat(currentInput);
    let hasil = 0;

    // Melakukan perhitungan berdasarkan operator
    switch (operator) {
        case '+': hasil = angka1 + angka2; break;
        case '-': hasil = angka1 - angka2; break;
        case '*': hasil = angka1 * angka2; break;
        case '/': 
            if (angka2 === 0) {
                alert("Tidak bisa membagi dengan nol!");
                return;
            }
            hasil = angka1 / angka2;
            break;
    }

    hasilTerakhir = hasil;
    firstValue = hasil.toString();
    currentInput = '';
    operator = '';
    updateDisplay();

    // Simpan hasil perhitungan ke dalam history
    saveToHistory(firstValue, hasil);
}

function saveToHistory(firstValue, hasil) {
    // Buat string perhitungan yang akan dikirimkan
    const perhitungan = `${firstValue} ${operator} ${currentInput} = ${hasil}`;

    // Data yang akan dikirimkan ke backend
    const historyData = {
        perhitungan: perhitungan, // Perhitungan lengkap
        hasil: hasil               // Hasil perhitungan
    };

    // Kirim data ke server menggunakan fetch
    fetch('home/saveHistory', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(historyData) // Mengirimkan data dalam format JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('History berhasil disimpan');
            // Panggil fungsi untuk menampilkan history atau sesuatu setelah data disimpan
            loadHistory(); // Memuat ulang history
        } else {
            console.log('Terjadi kesalahan saat menyimpan history');
        }
    })
    .catch(error => console.error('Error:', error));
}





// Hapus input terakhir
function hapusSatuAngka() {
    if (currentInput) {
        currentInput = currentInput.slice(0, -1);
    } else if (operator) {
        operator = '';
    } else if (firstValue) {
        firstValue = firstValue.slice(0, -1);
    }
    updateDisplay();
}

// Fungsi untuk mengubah tanda angka
function toggleNegatif() {
    if (currentInput) {
        currentInput = (parseFloat(currentInput) * -1).toString();
    } else if (firstValue) {
        firstValue = (parseFloat(firstValue) * -1).toString();
    } else if (hasilTerakhir !== null) {
        hasilTerakhir = (parseFloat(hasilTerakhir) * -1).toString();
    }
    updateDisplay();
}

// Fungsi untuk membersihkan display
function clearDisplay() {
    currentInput = '';
    operator = '';
    firstValue = '';
    hasilTerakhir = null;
    updateDisplay();
}
</script>

</body>
</html>
