<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">LAMARAN PT. Matcha Qiong</h4>
                </div>

              
                <div id="content">
                    <!-- Initial content (table of jurusan) -->
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Pelamar</th>
                                        <th>Nama Lowongan</th>
                                        <th>Umur</th>
                                        <th>Alamat</th>
                                        <th>CV</th>
                                        <th>Surat</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                        $no = 1;
                                        foreach ($oke as $okei) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= ($okei->nama_pelamar) ?></td>
                                            <td><?= ($okei->nama_lowongan) ?></td>
                                            <td><?= ($okei->umur) ?></td>
                                            <td><?= ($okei->alamat) ?></td>
                                            <td>
                <?php if(!empty($okei->cv)): ?>
                    <a href="<?= base_url('uploads/' . $okei->cv) ?>" target="_blank">Lihat CV</a>
                <?php else: ?>
                    Tidak ada CV
                <?php endif; ?>
            </td>

            <!-- Membuat tautan untuk Surat -->
            <td>
                <?php if(!empty($okei->surat)): ?>
                    <a href="<?= base_url('uploads/' . $okei->surat) ?>" target="_blank">Lihat Surat</a>
                <?php else: ?>
                    Tidak ada Surat
                <?php endif; ?>
            </td>
                                            <td><?= ($okei->status) ?></td>

                                            <td>
    <!-- Edit button -->
    <button class="btn btn-info" onclick="loadEditLamaranForm(<?= $okei->id_pelamar ?>)">
        <i class="fe fe-edit"></i> Edit
    </button>
    <?php
      if (session()->get('level') == 1 || session()->get('level') == 2){
        ?>
    <div class="dropdown d-inline-block">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="statusDropdown<?= $okei->id_pelamar ?>" data-bs-toggle="dropdown" aria-expanded="false">
            Status
        </button>
        <ul class="dropdown-menu" aria-labelledby="statusDropdown<?= $okei->id_pelamar ?>">
            <li>
            <a class="dropdown-item text-info" href="<?= base_url('home/kirim_pengumuman_diterima/' . $okei->id_pelamar) ?>">
    <i class="fe fe-check"></i> Diterima
</a>
            </li>
            <li>
            <a class="dropdown-item text-secondary" href="<?= base_url('home/kirim_pengumuman_ditolak/' . $okei->id_pelamar) ?>">
    <i class="fe fe-check"></i> Ditolak
</a>
            </li>
        </ul>
    </div>

    <?php 
      } else {

      }
?>
    
    <button class="btn btn-secondary btn-delete" data-id="<?= $okei->id_pelamar?>">Delete</button>
</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<div id="dynamicContent"></div>

<script>
    // Function to load "Tambah Jurusan" form dynamically
    


    // Function to load "Edit Jurusan" form dynamically
    function loadEditLamaranForm(id_pelamar) {
        // Fetch and load the edit form for the pelamar
        fetch('<?= base_url('home/e_lamaran') ?>/' + id_pelamar) // Endpoint for editing jurusan
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToPelamarList()">
                        <i class="fe fe-arrow-left"></i> Back to Pelamar List
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
    function backToPelamarList() {
        // Show the section again
        document.querySelector('.section').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }
</script>
