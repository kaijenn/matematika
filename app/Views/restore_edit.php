<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">RESTORE EDIT </h4>
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
                                        <th>Nama Lowongan</th>
                                        <th>Deskripsi</th>
                                      
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
                                            <td><?= ($okei->nama_lowongan) ?></td>
                                            <td><?= ($okei->deskripsi) ?></td>
                                         

                                            <td>
                                                <!-- Edit button -->
                                                <a href="<?= base_url('home/aksi_restore_edit_lowongan/'.$okei->id_lowongan) ?>">
                                            <button class="btn btn-info">Restore</button>
                                        </a>

                                        <a href="<?= base_url('home/hapus_lowongan_permanent/'.$okei->id_lowongan) ?>">
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
