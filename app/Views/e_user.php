<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User PT. Matcha Qiong</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_user') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">

                                    <div class="col-md-7 mb-3">
                                        <label for="nama_siswa">Username:</label>
                                        <input type="text" class="form-control" name="username" value="<?= $oke->username ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="nama_siswa">Email:</label>
                                        <input type="text" class="form-control" name="email" value="<?= $oke->email ?>" required>
                                    </div>

                                   

                                    <div class="col-md-7 mb-3">
    <label for="level">Level:</label>
    <select class="form-control" name="level" id="level">
        <option value="">Pilih</option>
        <option value="admin" <?= ($currentLevel == 'admin') ? 'selected' : '' ?>>Admin</option>
        <option value="pengguna" <?= ($currentLevel == 'pengguna') ? 'selected' : '' ?>>Pengguna</option>
    </select>
</div>



                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id_user" value="<?= $oke->id_user ?>">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
