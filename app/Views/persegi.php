<section class="section">
    <div class="row justify-content-center" id="basic-table">
        <div class="col-12 col-md-6"> <!-- Center the card within the row -->
            <div class="card bg-light-gray">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px; text-align: center;">MENGHITUNG LUAS PERSEGI</h4>
                </div>
                <!-- <button class="btn btn-primary m-3" id="btnTambahLowongan" onclick="loadTambahLuasForm()">
                    <i class="fe fe-plus"></i> ADD RUMUS
                </button> -->
                <div id="content">
                    <!-- Initial content (cards of rumus) -->
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" id="cardContainer">
                                <?php
                                    $no = 1;
                                    foreach ($oke as $okei) {
                                ?>
                                    <div class="col-md-12 mb-4">
    <div class="card bg-light-gray">
        <div class="card-body">
            <!-- Add Image with center alignment -->
            <div class="image-container">
            <img src="<?= base_url('images/persegi.png') ?>" alt="image description" class="center-image" />
            </div>
            <h4>Rumus Luas Persegi adalah</h4>
            <p class="card-text large-text"><?= $okei->rumus ?></p>

            <div class="d-flex justify-content-between">
                <button class="btn btn-primary btn-sm" data-id="<?= $okei->id_rumus ?>" data-bs-toggle="modal" data-bs-target="#lamaranModal" 
                    onclick="document.getElementById('id_rumus').value='<?= $okei->id_rumus ?>'">
                    <i class="fe fe-paper-plane"></i> Edit
                </button>

                <button class="btn btn-info btn-sm" onclick="pilihRumus(<?= $okei->id_rumus ?>)">
                    Pilih
                </button>

                <a href="<?= base_url('home/hapus_rumus/'.$okei->id_rumus) ?>">
                    <button class="btn btn-secondary btn-sm">Delete</button>
                </a>
            </div>
        </div>
    </div>
</div>

                                <?php } ?>
                            </div>
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
</script>

<style>
    .bg-light-gray {
    background-color: #f5f5f5; /* Light gray background */
}

#cardContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    width: 100%;
    max-width: 800px; /* Increased max width for a larger card */
    margin: 20px auto; /* Optional: Adds space around the card */
    padding: 20px; /* Optional: Adds padding inside the card */
}

.image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px; /* Optional: Adjust space below the image */
}

.center-image {
    max-width: 50%; /* Ensures the image doesn't overflow its container */
    height: auto; /* Maintains aspect ratio */
}

.large-text {
    font-size: 1.5em; /* Increase the font size, adjust as necessary */
    justify-content: center;
}

.card-text {
    font-size: 1.5em; /* Adjust size as necessary */
    font-weight: bold; /* Optional */
    justify-content: center;
}

</style>