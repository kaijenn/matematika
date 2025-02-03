<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Lamaran PT. Matcha Qiong</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_lamaran') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">


                                <div class="col-md-7 mb-3">
                                        <label for="nama_pelamar">Nama Pelamar:</label>
                                        <input type="text" class="form-control" name="nama_pelamar"  value="<?= $oke->nama_pelamar ?>" >
                                    </div>


                                    <div class="col-md-7 mb-3">
                                        <label for="umur">Umur:</label>
                                        <input type="text" class="form-control" name="umur"  value="<?= $oke->umur ?>" >
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="alamat">Alamat:</label>
                                        <input type="text" class="form-control" name="alamat"  value="<?= $oke->alamat ?>" >
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="alamat">CV:</label>
                                        <input type="file" class="form-control" name="cv"  >
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="surat">Surat:</label>
                                        <input type="file" class="form-control" name="surat"  >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id_pelamar" value="<?= $oke->id_pelamar ?>">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
