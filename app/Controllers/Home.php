<?php

namespace App\Controllers;
Use App\Models\M_siapake;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Home extends BaseController
{



    public function profile()
    {
        if (session()->get('id') > 0) {

            $model = new M_siapake();
           
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();

            $where = array('id_user' => session()->get('id'));
            $data['yoga'] = $model->getwhere('user', $where);
            helper('permission'); // Pastikan helper dimuat

            echo view('header', $data);
            echo view('menu', $data);
            echo view('profile', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function editfoto()
    {
        $model = new M_siapake();
        
        $userData = $model->getById(session()->get('id'));

        if ($this->request->getFile('foto')) {

            $file = $this->request->getFile('foto');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/img', $newFileName);

            if ($userData->foto && file_exists(ROOTPATH . 'public/img/' . $userData->foto)) {
                unlink(ROOTPATH . 'public/img/' . $userData->foto);
            }
            $userId = ['id_user' => session()->get('id')];
            $userData = ['foto' => $newFileName];
            $model->edit('user', $userData, $userId);
        }
        return redirect()->to('home/profile');
    }
    public function aksi_e_profile()
    {
        if (session()->get('id') > 0) {
            $model = new M_siapake();
           
            $yoga = $this->request->getPost('username');
            $id = $this->request->getPost('id');

            $where = array('id_user' => $id); // Jika id_user adalah kunci utama untuk menentukan record


            $isi = array(
                'username' => $yoga,
            );

            $model->edit('user', $isi, $where);
            return redirect()->to('home/profile');
            // print_r($yoga);
            // print_r($id);
        } else {
            return redirect()->to('home/login');
        }
    }
    public function changepassword()
    {
        if (session()->get('id') > 0) {

            $model = new M_siapake();
            
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
            $where = array('id_user' => session()->get('id'));
            $data['darren'] = $model->getwhere('user', $where);
            helper('permission'); // Pastikan helper dimuat

            echo view('header', $data);
            echo view('menu', $data);
            echo view('changepassword', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function aksi_changepass()
    {
        $model = new M_siapake();
        $oldPassword = $this->request->getPost('old');
        $newPassword = $this->request->getPost('new');
        $userId = session()->get('id');

        // Dapatkan password lama dari database
        $currentPassword = $model->getPassword($userId);

        // Verifikasi apakah password lama cocok
        if (md5($oldPassword) !== $currentPassword) {
            // Set pesan error jika password lama salah
            session()->setFlashdata('error', 'Password lama tidak valid.');
            return redirect()->back()->withInput();
        }

        // Update password baru
        $data = [
            'password' => md5($newPassword),
            'updated_by' => $userId,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $where = ['id_user' => $userId];

        $model->edit('user', $data, $where);

        // Set pesan sukses
        session()->setFlashdata('success', 'Password berhasil diperbarui.');
        return redirect()->to('home/changepassword');
    }




	public function dashboard()
{
    $model = new M_siapake();
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil nama pengguna dari session
    $session = session();
    $data['username'] = $session->get('username');

    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Dashboard',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('dashboard', $data);
    echo view('footer');
}

public function logout()

    {
        session()->destroy();
        return redirect()->to('home/login');
    }

	public function login()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Login',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('login');
	}




public function aksi_login()
{
    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if (session()->get('captcha_code') !== $captcha_code) {
            session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6LefTYMqAAAAAC1hYWZVpC0-nPwlZkdDZaDXlKi1'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            session()->setFlashdata('toast_message', 'Captcha validation failed');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }


    
    // Proses login seperti biasa
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    $where = array(
        'username' => $u,
        'password' => md5($p),
    );
    $model = new M_siapake;
    $cek = $model->getWhere('user', $where);

    if ($cek) {
        session()->set('nama', $cek->username);
        session()->set('id', $cek->id_user);
        session()->set('level', $cek->level);
        return redirect()->to('home/dashboard');
    } else {
        session()->setFlashdata('toast_message', 'Invalid login credentials');
        session()->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}



public function generateCaptcha()
{
    // Create a string of possible characters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    
    // Generate a random CAPTCHA code with letters and numbers
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store CAPTCHA code in session
    session()->set('captcha_code', $captcha_code);
    
    // Create an image for CAPTCHA
    $image = imagecreate(120, 40); // Increased size for better readability
    $background = imagecolorallocate($image, 200, 200, 200);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    
    imagefilledrectangle($image, 0, 0, 120, 40, $background);
    
    // Add some random lines to the CAPTCHA image for added complexity
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
    }
    
    // Add the CAPTCHA code to the image
    imagestring($image, 5, 20, 10, $captcha_code, $text_color);
    
    // Output the CAPTCHA image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}




public function checkInternetConnection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}



public function register()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Register',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('register');
	}


	public function aksi_t_register()
{
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');
        $nohp = $this->request->getPost('nohp');
        
        // Hash the password using MD5
        $hashedPassword = md5($password);

        $darren = array(
            'username' => $username,
            'password' => $hashedPassword, 
            'email' => $email, 
            'nohp' => $nohp, 
            'id_level' => 3, 
        );

        // Initialize the model
        $model = new M_siapake;
        $model->tambah('user', $darren);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/login');
    
}

public function persegi()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('rumus');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Rumus persegi',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('persegi');
    echo view('footer');
	}


    public function t_persegi()
	{
		$model= new M_siapake();

		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah Rumus persegi',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('t_persegi');
	}



    public function aksi_t_persegi()
    {
        if(session()->get('id') > 0) {
            $nama_rumus = $this->request->getPost('nama_rumus');
            $rumus = $this->request->getPost('rumus');
            
    
            $yoga = array(
                'nama_rumus' => $nama_rumus,
                'rumus' => $rumus, 
            );
    
            // Initialize the model
            $model = new M_siapake;
            $model->tambah('rumus', $yoga);
    
            // Redirect to the 'tb_user' page
            return redirect()->to('home/persegi');
        } else {
            // If no session or user is logged in, redirect to the login page
            return redirect()->to('home/login');
        }
    }

    




    public function soft_delete(){

        $model = new M_siapake;
        $data['oke'] = $model->tampilrestore('lowongan');
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Soft Delete',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
        echo view('header', $data);
        echo view('menu');
        echo view('soft_delete', $data);
        echo view('footer');
    }

    public function restore_edit(){

        $model = new M_siapake;
        $data['oke'] = $model->tampil('lowongan_backup');
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Restore Edit Lowongan',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
        echo view('header', $data);
        echo view('menu');
        echo view('restore_edit', $data);
        echo view('footer');
    }



    public function hapus_lowongan($id)
    {
        $model = new M_siapake();
        $where = array('id_lowongan' => $id);
        $array = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        $model->edit('lowongan', $array, $where);
        // $this->loglowonganActivity('Menghapus Pemesanan');

        return redirect()->to('home/lowongan');
    }

    public function hapus_lowongan_permanent($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_lowongan' => $id);
        $model->hapus('lowongan', $where);
    
        return redirect()->to('home/lowongan');
    }


    public function restore_lowongan($id)
    {
        $model = new M_siapake();
        $where = array('id_lowongan' => $id);
        $array = array(
            'deleted_at' => NULL, // Mengatur deleted_at menjadi null
        );
        $model->edit('lowongan', $array, $where);
    
        return redirect()->to('home/lowongan');
    }



   

public function e_lowongan($id_lowongan)
	{
		$model= new M_siapake();
        $whereuser = array('id_lowongan' => $id_lowongan);
        $data['oke'] = $model->getWhere1('lowongan', $whereuser)->getRow();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit Lowongan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('e_lowongan');
	}


    public function aksi_e_lowongan()
    {
        if(session()->get('id') > 0) {
            $nama_lowongan = $this->request->getPost('nama_lowongan');
            $deskripsi = $this->request->getPost('deskripsi');
            $id = $this->request->getPost('id_lowongan');
            // Hash the deskripsi using MD5
            $model = new M_siapake;
            $oldData = $model->getWhere('lowongan', ['id_lowongan' => $id]);
        
                // Simpan data lama ke tabel backup
                if ($oldData) {
                    $backupData = [
                        'id_lowongan' => $oldData->id_lowongan,  // integer
                        'nama_lowongan' => $oldData->nama_lowongan,     
                        'deskripsi' => $oldData->deskripsi,    
                        'backup_by' => $oldData->backup_by,         // integer
                        'backup_at' => $oldData->backup_at,         // datetime
                    ];
        
                    // Debug: cek hasil insert ke tabel backup
                    if ($model->saveToBackup('lowongan_backup', $backupData)) {
                        echo "Data backup berhasil disimpan!";
                    } else {
                        echo "Gagal menyimpan data ke backup.";
                    }
                } else {
                    echo "Data lama tidak ditemukan.";
                }
        
                // Data baru yang akan diupdate
                $yoga = array(
                   'nama_lowongan' => $nama_lowongan,
                   'deskripsi' => $deskripsi,
                        'updated_by' => session()->get('id'),
                        'updated_at' => date('Y-m-d H:i:s'),
                );
        
                // Update data di tabel pemesanan
                $where = array('id_lowongan' => $id);
                $model->edit('lowongan', $yoga, $where);
    
            // Redirect to the 'tb_user' page
            return redirect()->to('home/lowongan');
        } else {
            // If no session or user is logged in, redirect to the login page
            return redirect()->to('home/login');
        }
    }

    public function aksi_restore_edit_lowongan($id)
    {
        $model = new M_siapake();
        
        $backupData = $model->getWhere('lowongan_backup', ['id_lowongan' => $id]);
    
        if ($backupData) {
           
            $restoreData = [
                'nama_lowongan' => $backupData->nama_lowongan,
                'deskripsi' => $backupData->deskripsi,
               
               
                // tambahkan field lainnya sesuai dengan struktur tabel menu
            ];
            unset($restoreData['id_lowongan']);
            $model->edit('lowongan', $restoreData, ['id_lowongan' => $id]);
        }
        
        return redirect()->to('home/lowongan');
    }
   

    public function karyawan()
	{
		$model= new M_siapake();

       // Mengambil ID dari session

       $data['oke'] = $model->tampil_karyawan();
// $data['oke'] = $model->tampil('pelamar');


		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Karyawan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('karyawan');
    echo view('footer');
	}


    public function aksi_e_karyawan()
    {
        if(session()->get('id') > 0) {
            $gaji = $this->request->getPost('gaji');
            $id = $this->request->getPost('id_karyawan');
            // Hash the deskripsi using MD5
            $where = array('id_karyawan' => $id);


            $yoga = array(
                'gaji' => $gaji,
            );
    
            // Initialize the model
            $model = new M_siapake;
            $model->edit('karyawan', $yoga, $where);
    
            // Redirect to the 'tb_user' page
            return redirect()->to('home/karyawan');
        } else {
            // If no session or user is logged in, redirect to the login page
            return redirect()->to('home/login');
        }
    }


    public function lamaran()
{
    $model = new M_siapake();
    $id_user = session()->get('id');
    $id_level = session()->get('level'); // Ambil id_level dari session

    // Cek apakah user adalah admin (id_level 1)
    if ($id_level == 1 || $id_level == 2) {
        // Jika admin, ambil semua pelamar
        $data['oke'] = $model->tampilpelamar('pelamar');
    } else {
        // Jika bukan admin, ambil pelamar milik user tersebut
        $where = array('id_user' => $id_user);
        $data['oke'] = $model->tampilwherepelamar('pelamar', $where);
    }

    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Lamaran',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    echo view('header', $data);
    echo view('menu');
    echo view('lamaran');
    echo view('footer');
}





    public function aksi_t_lamaran()
{
    if (session()->get('id') > 0) {
        // Mengambil data dari input
        $nama_pelamar = $this->request->getPost('nama_pelamar');
        $umur = $this->request->getPost('umur');
        $alamat = $this->request->getPost('alamat');
        
        // Mengambil file CV dan Surat
        $cvFile = $this->request->getFile('cv');
        $suratFile = $this->request->getFile('surat');

        // Menyimpan file ke dalam folder uploads
        $cvFileName = null;
        $suratFileName = null;

        if ($cvFile->isValid() && !$cvFile->hasMoved()) {
            $cvFileName = $cvFile->getRandomName(); // Nama file acak untuk CV
            $cvFile->move(FCPATH . 'uploads', $cvFileName); // Memindahkan file CV
        }

        if ($suratFile->isValid() && !$suratFile->hasMoved()) {
            $suratFileName = $suratFile->getRandomName(); // Nama file acak untuk Surat
            $suratFile->move(FCPATH . 'uploads', $suratFileName); // Memindahkan file Surat
        }

        // Mendapatkan id_lowongan dari permintaan
        $id_lowongan = $this->request->getPost('id_lowongan');
        $id_user = session()->get('id');

        // Membuat array data untuk disimpan
        $yoga = array(
            'nama_pelamar' => $nama_pelamar,
            'umur' => $umur, 
            'alamat' => $alamat, 
            'cv' => $cvFileName,  // Nama file CV
            'surat' => $suratFileName,  // Nama file Surat
            'id_user' => $id_user,
            'id_lowongan' => $id_lowongan, 
            'status' => 'Pending',
        );

        // Inisialisasi model
        $model = new M_siapake;
        $model->tambah('pelamar', $yoga); // Menyimpan data ke database

        // Redirect ke halaman 'lowongan'
        return redirect()->to('home/lamaran');
    } else {
        // Redirect ke halaman login jika session tidak ada
        return redirect()->to('home/login');
    }
}


public function e_lamaran($id_pelamar)
	{
		$model= new M_siapake();
        $whereuser = array('id_pelamar' => $id_pelamar);
        $data['oke'] = $model->getWhere1('pelamar', $whereuser)->getRow();

		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit Lamaran',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('e_lamaran');
	}

    public function aksi_e_lamaran()
{
    if(session()->get('id') > 0) {
        $nama_pelamar = $this->request->getPost('nama_pelamar');
        $umur = $this->request->getPost('umur');
        $alamat = $this->request->getPost('alamat');
        $id = $this->request->getPost('id_pelamar');

        // Ambil data pelamar sebelumnya
        $model = new M_siapake;
        $pelamarLama = $model->get_detail('pelamar', ['id_pelamar' => $id]);

        $cvFile = $this->request->getFile('cv');
        $suratFile = $this->request->getFile('surat');

        // Menyimpan file ke dalam folder uploads
        $cvFileName = $pelamarLama->cv; // Gunakan CV lama sebagai default
        $suratFileName = $pelamarLama->surat; // Gunakan surat lama sebagai default

        // Proses file CV baru jika ada
        if ($cvFile->isValid() && !$cvFile->hasMoved()) {
            $cvFileName = $cvFile->getRandomName(); // Nama file acak untuk CV
            $cvFile->move(FCPATH . 'uploads', $cvFileName); // Memindahkan file CV

            // Hapus file CV lama jika ada
            if (!empty($pelamarLama->cv)) {
                $oldCvPath = FCPATH . 'uploads/' . $pelamarLama->cv;
                if (file_exists($oldCvPath)) {
                    unlink($oldCvPath);
                }
            }
        }

        // Proses file surat baru jika ada
        if ($suratFile->isValid() && !$suratFile->hasMoved()) {
            $suratFileName = $suratFile->getRandomName(); // Nama file acak untuk Surat
            $suratFile->move(FCPATH . 'uploads', $suratFileName); // Memindahkan file Surat

            // Hapus file surat lama jika ada
            if (!empty($pelamarLama->surat)) {
                $oldSuratPath = FCPATH . 'uploads/' . $pelamarLama->surat;
                if (file_exists($oldSuratPath)) {
                    unlink($oldSuratPath);
                }
            }
        }

        $where = array('id_pelamar' => $id);

        $yoga = array(
            'nama_pelamar' => $nama_pelamar,
            'umur' => $umur, 
            'alamat' => $alamat, 
            'cv' => $cvFileName, 
            'surat' => $suratFileName,  
        );

        $model->edit('pelamar', $yoga, $where);

        // Redirect to the 'lamaran' page
        return redirect()->to('home/lamaran');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}
// public function kirim_pengumuman_diterima($id_lamaran)
// {
//     $model = new M_siapake;

//     // 1. Ambil data pelamar
//     $pelamar = $model->get_pelamar_by_id($id_lamaran);

//     // 2. Ambil email dari user
//     $user = $model->get_user_by_id($pelamar->id_user);

//     // 3. Update status pelamar menjadi Diterima
//     $model->edit('pelamar', 
//         ['status' => 'Diterima'], 
//         ['id_pelamar' => $id_lamaran]
//     );

//     // 4. Update id_level user menjadi 4
//     $model->edit('user', 
//         ['id_level' => 4], 
//         ['id' => $pelamar->id_user]
//     );

//     // 5. Tambah data ke tabel karyawan
//     $data_karyawan = [
//         'id_pelamar' => $id_lamaran,
//         'id_user' => $pelamar->id_user
//     ];
//     $model->tambah('karyawan', $data_karyawan);

//     // 6. Kirim email dengan nama_pelamar
//     $email_terkirim = $this->kirim_email_penerimaan($user->email, $pelamar->nama_pelamar);

//     // 7. Berikan respon
//     if ($email_terkirim) {
//         session()->setFlashdata('success', 'Email penerimaan berhasil dikirim, status user diupdate, dan data karyawan ditambahkan');
//     } else {
//         session()->setFlashdata('error', 'Gagal mengirim email penerimaan');
//     }

//     // 8. Redirect kembali
//     return redirect()->back();
// }

// public function kirim_pengumuman_ditolak($id_lamaran)
// {


// $model = new M_siapake;

// $pelamar = $model->get_pelamar_by_id($id_lamaran);

// // Ambil email dari user
// $user = $model->get_user_by_id($pelamar->id_user);

// $model->edit('pelamar', 
// ['status' => 'Ditolak'], 
// ['id_pelamar' => $id_lamaran]
// );

// // Kirim email dengan nama_pelamar
// $email_terkirim = $this->kirim_email_penerimaan_ditolak($user->email, $pelamar->nama_pelamar);

//     // 4. Berikan respon
//     if ($email_terkirim) {
//         session()->setFlashdata('success', 'Email penerimaan berhasil dikirim');
//     } else {
//         session()->setFlashdata('error', 'Gagal mengirim email penerimaan');
//     }

//     // 5. Redirect kembali
//     return redirect()->back();
// }

// private function kirim_email_penerimaan($email, $nama)
// {
//     $mail = new PHPMailer(true);

//     try {
//         $mail->isSMTP();
//         $mail->Host       = 'smtp.gmail.com';
//         $mail->SMTPAuth   = true;
//         $mail->Username   = 'kaizenesia@gmail.com';
//         $mail->Password   = 'kjmc gjkt bzuh qglc';
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port       = 587;

//         $mail->setFrom('kaizenesia@gmail.com', 'PT. Matcha Qiong');
//         $mail->addAddress($email, $nama);

//         $mail->isHTML(true);
//         $mail->Subject = 'Selamat! Anda Diterima di PT. Matcha Qiong';
//         $mail->Body    = "
//             <html>
//             <body>
//                 <h2>Selamat, $nama!</h2>
//                 <p>Kami dengan senang hati mengumumkan bahwa Anda DITERIMA bekerja di PT. Matcha Qiong.</p>
//                 <p>Silakan menunggu informasi lebih lanjut untuk proses selanjutnya.</p>
//                 <br>
//                 <p>Salam hangat,<br>Tim Rekrutmen PT. Matcha Qiong</p>
//             </body>
//             </html>
//         ";

//         $mail->send();
//         return true;
//     } catch (\Exception $e) {
//         log_message('error', 'Gagal mengirim email: ' . $e->getMessage());
//         return false;
//     }
// }


// private function kirim_email_penerimaan_ditolak($email, $nama)
// {
//     $mail = new PHPMailer(true);

//     try {
//         $mail->isSMTP();
//         $mail->Host       = 'smtp.gmail.com';
//         $mail->SMTPAuth   = true;
//         $mail->Username   = 'kaizenesia@gmail.com';
//         $mail->Password   = 'kjmc gjkt bzuh qglc';
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port       = 587;

//         $mail->setFrom('kaizenesia@gmail.com', 'PT. Matcha Qiong');
//         $mail->addAddress($email, $nama);

//         $mail->isHTML(true);
//         $mail->Subject = 'Informasi Hasil Seleksi Lamaran di PT. Matcha Qiong';
//         $mail->Body    = "
//             <html>
//             <body>
//                 <h2>Kepada Yth. $nama,</h2>
//                 <p>Terima kasih atas minat Anda untuk bergabung dengan PT. Matcha Qiong.</p>
//                 <p>Setelah melalui proses seleksi yang komprehensif, kami sampaikan bahwa saat ini lamaran Anda belum dapat kami terima.</p>
//                 <p>Kami menghargai waktu dan usaha yang telah Anda berikan dalam proses lamaran ini.</p>
//                 <br>
//                 <p>Kami mendorong Anda untuk terus mengembangkan kemampuan dan tidak menyerah. Kesempatan lain mungkin akan datang di masa depan.</p>
//                 <br>
//                 <p>Terima kasih,<br>Tim Rekrutmen PT. Matcha Qiong</p>
//             </body>
//             </html>
//         ";

//         $mail->send();
//         return true;
//     } catch (\Exception $e) {
//         log_message('error', 'Gagal mengirim email: ' . $e->getMessage());
//         return false;
//     }
// }


public function resetpassword($id)
    {
        $model = new M_siapake();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Melakukan Reset Password',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
        $model->resetPassword($id);
        return redirect()->to('home/user');
    }


public function user()
	{
		$model= new M_siapake();
  
        $data['oke'] = $model->tampil_user();
        
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('user');
    echo view('footer');
	}


    

    public function hapus_user($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_user' => $id);
        $model->hapus('user', $where);
    
        return redirect()->to('Home/user');
    }


   
    

    public function t_user()
	{
		$model= new M_siapake();
  
        $data['yoga'] = $model->tampil('level');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_user');
	}

    public function aksi_t_user()
{
if(session()->get('id') > 0){
    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $nohp = $this->request->getPost('nohp');
    $level = $this->request->getPost('level');

    $password = md5('1');

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'nohp' => $nohp,
        'id_level' => $level,
    );

    $model = new M_siapake;

    $model->tambah('user', $yoga); // Menyimpan data kelas ke database
    return redirect()->to('home/user');
} else {
    return redirect()->to('home/login');
}
}

public function e_user($id_user)
{
    $model = new M_siapake();

    $whereuser = array('id_user' => $id_user);
    $data['oke'] = $model->getWhere1('user', $whereuser)->getRow();
    $data['yoga'] = $model->tampil('level');
    // Tambahkan currentLevel dari data pengguna
    $data['currentLevel'] = $data['oke']->level ?? ''; // Pastikan defaultnya kosong jika tidak ada data

    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit User',
        'time' => date('Y-m-d H:i:s'),
    ];
    $model->logActivity($activityLog);

    echo view('header', $data);
    echo view('menu');
    echo view('e_user', $data); // Pastikan $data dikirim ke view
}


public function aksi_e_user()
{
    if(session()->get('id') > 0) {
        $username = $this->request->getPost('username');
        $nohp = $this->request->getPost('nohp');
        $email = $this->request->getPost('email');
        $level = $this->request->getPost('level');
        $id = $this->request->getPost('id_user');
        // Hash the deskripsi using MD5
        $where = array('id_user' => $id);


        $yoga = array(
            'username' => $username,
            'nohp' => $nohp,
            'email' => $email,
            'id_level' => $level,
        );

        // Initialize the model
        $model = new M_siapake;
        $model->edit('user', $yoga, $where);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/user');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}






public function log_activity(){

	$model = new M_siapake;
	$data['users'] = $model->getAllUsers();

	$userId = $this->request->getGet('user_id');

	// Fetch logs with optional filtering
	if (!empty($userId)) {
		$data['logs'] = $model->getLogsByUser($userId);
	} else {
		$data['logs'] = $model->getLogs();
	}
	$where = array('id_setting' => '1');
	$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
	$id_user = session()->get('id');
	$activityLog = [
		'id_user' => $id_user,
		'menu' => 'Masuk ke Log Activity',
		'time' => date('Y-m-d H:i:s')
	];
	$model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
	echo view('log_activity', $data);
	echo view('footer');
}


public function setting()
    {
      
                $model = new M_siapake;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

                $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Setting',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
                echo view('header', $data);
                echo view('menu');
                echo view('setting', $data);
                echo view('footer');
           
    }

    public function aksi_e_setting()
    {
        $model = new M_siapake();
        // $this->logUserActivity('Melakukan Setting');
        $namaWebsite = $this->request->getPost('namawebsite');
        $id = $this->request->getPost('id');
        $id_user = session()->get('id');
        $where = array('id_setting' => '1');

        $data = array(
            'nama_website' => $namaWebsite,
            'update_by' => $id_user,
            'update_at' => date('Y-m-d H:i:s')
        );

        // Cek apakah ada file yang diupload untuk favicon
        $favicon = $this->request->getFile('img');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
            // Beri nama file unik
            $faviconNewName = $favicon->getRandomName();
            // Pindahkan file ke direktori public/images
            $favicon->move(WRITEPATH . '../public/images', $faviconNewName);

            // Tambahkan nama file ke dalam array data
            $data['tab_icon'] = $faviconNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            // Beri nama file unik
            $logoNewName = $logo->getRandomName();
            // Pindahkan file ke direktori public/images
            $logo->move(WRITEPATH . '../public/images', $logoNewName);

            // Tambahkan nama file ke dalam array data
            $data['logo_website'] = $logoNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $login = $this->request->getFile('login');
        if ($login && $login->isValid() && !$login->hasMoved()) {
            // Beri nama file unik
            $loginNewName = $login->getRandomName();
            // Pindahkan file ke direktori public/images
            $login->move(WRITEPATH . '../public/images', $loginNewName);

            // Tambahkan nama file ke dalam array data
            $data['login_icon'] = $loginNewName;
        }

        $model->edit('setting', $data, $where);

        // Optionally set a flash message here
        return redirect()->to('home/setting');
    }
}
