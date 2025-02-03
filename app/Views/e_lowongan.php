<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Lowongan PT. Matcha Qiong</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_lowongan') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">

                                    <div class="col-md-7 mb-3">
                                        <label for="nama_siswa">Nama Lowongan:</label>
                                        <input type="text" class="form-control" name="nama_lowongan"  value="<?= $oke->nama_lowongan ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="email_siswa">Deskripsi:</label>
                                        <input type="text" class="form-control" name="deskripsi"  value="<?= $oke->deskripsi ?>" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id_lowongan" value="<?= $oke->id_lowongan ?>">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
