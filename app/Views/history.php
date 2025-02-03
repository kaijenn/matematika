<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">RIWAYAT PERHITUNGAN</h4>
                </div>

                <!-- Content area -->
                <div id="content">
                    <!-- Initial content (table of jurusan) -->
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Hasil</th>
                                        <th>Waktu</th>
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
                                            <td><?= ($okei->hasil) ?></td>
                                            <td><?= ($okei->waktu) ?></td>
                                            

                                            <td>
                                                <!-- Edit button -->
                                               
                                                <a href="<?= base_url('home/hapus_history/'.$okei->id_history) ?>">
                                            <button class="btn btn-secondary">Delete</button>
                                        </a>

                                        
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
