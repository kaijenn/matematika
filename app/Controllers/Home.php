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
        
        // Hash the password using MD5
        $hashedPassword = md5($password);

        $darren = array(
            'username' => $username,
            'password' => $hashedPassword, 
            'email' => $email, 
            'level' => 'pengguna', 
        );

        // Initialize the model
        $model = new M_siapake;
        $model->tambah('user', $darren);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/login');
    
}

public function l_persegi()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('l_persegi');
    echo view('footer');
	}

    public function simpan_history_l_persegi()
    {
        $model = new M_siapake();
        
        // Ambil ID User dari session
        $id_user = session()->get('id');
    
        // Ambil nilai sisi dari form
        $sisi = $this->request->getPost('sisi');
    
        // Buat format hasil
        $hasil = "L = {$sisi} x {$sisi} = " . ($sisi * $sisi);
    
        // Data yang akan disimpan ke dalam tabel history
        $yoga = [
            'id_user' => $id_user,
            'hasil'   => $hasil, // Memasukkan hasil langsung
            'waktu'   => date('Y-m-d H:i:s')
        ];
    
        // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
        $model->tambah('history', $yoga);
    
        // Redirect kembali ke halaman perhitungan luas persegi
        return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
    }


    public function l_persegi_panjang()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('l_persegi_panjang');
    echo view('footer');
	}

    public function simpan_history_l_persegi_panjang()
{
    $model = new M_siapake();
    
    // Ambil ID User dari session
    $id_user = session()->get('id');

    // Ambil nilai sisi dari form
    $panjang = $this->request->getPost('panjang');
    $lebar = $this->request->getPost('lebar');

    $luas = $panjang * $lebar;

    // Format hasil
    $hasil = "L = P ={$panjang} x L ={$lebar} = {$luas}";

    // Data yang akan disimpan ke dalam tabel history
    $yoga = [
        'id_user' => $id_user,
        'hasil'   => $hasil, // Memasukkan hasil langsung
        'waktu'   => date('Y-m-d H:i:s')
    ];

    // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
    $model->tambah('history', $yoga);

    // Redirect kembali ke halaman perhitungan luas persegi
    return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
}



public function l_segitiga()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('l_segitiga');
    echo view('footer');
	}

    public function simpan_history_l_segitiga()
{
    $model = new M_siapake();
    
    // Ambil ID User dari session
    $id_user = session()->get('id');

    // Ambil nilai sisi dari form
    // Ambil nilai alas dan tinggi dari form
    $alas = $this->request->getPost('alas');
    $tinggi = $this->request->getPost('tinggi');

    $luas = 0.5 * $alas * $tinggi;

    // Format hasil
    $hasil = "L = ½ × {$alas} × {$tinggi} = {$luas}";

    // Data yang akan disimpan ke dalam tabel history
    $yoga = [
        'id_user' => $id_user,
        'hasil'   => $hasil, // Memasukkan hasil langsung
        'waktu'   => date('Y-m-d H:i:s')
    ];

    // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
    $model->tambah('history', $yoga);

    // Redirect kembali ke halaman perhitungan luas persegi
    return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
}



public function l_jajar_genjang()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('l_jajar_genjang');
    echo view('footer');
	}

    public function simpan_history_l_jajar_genjang()
{
    $model = new M_siapake();
    
    // Ambil ID User dari session
    $id_user = session()->get('id');

    // Ambil nilai sisi dari form
    // Ambil nilai alas dan tinggi dari form
    $alas = $this->request->getPost('alas');
    $tinggi = $this->request->getPost('tinggi');

    $luas = $alas * $tinggi;

    // Format hasil
    $hasil = "L = L ={$alas} × t ={$tinggi} = {$luas}";

    // Data yang akan disimpan ke dalam tabel history
    $yoga = [
        'id_user' => $id_user,
        'hasil'   => $hasil, // Memasukkan hasil langsung
        'waktu'   => date('Y-m-d H:i:s')
    ];

    // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
    $model->tambah('history', $yoga);

    // Redirect kembali ke halaman perhitungan luas persegi
    return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
}




public function v_kubus()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('v_kubus');
    echo view('footer');
	}

    public function simpan_history_v_kubus()
    {
        $model = new M_siapake();
        
        // Ambil ID User dari session
        $id_user = session()->get('id');
    
        // Ambil nilai sisi dari form
        $sisi = $this->request->getPost('sisi');
    
        // Buat format hasil
        $volume = pow($sisi, 3); // Volume = sisi^3

        // Buat format hasil
        $hasil = "V = {$sisi}³ = {$volume}";
    
        // Data yang akan disimpan ke dalam tabel history
        $yoga = [
            'id_user' => $id_user,
            'hasil'   => $hasil, // Memasukkan hasil langsung
            'waktu'   => date('Y-m-d H:i:s')
        ];
    
        // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
        $model->tambah('history', $yoga);
    
        // Redirect kembali ke halaman perhitungan luas persegi
        return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
    }


    public function v_balok()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('v_balok');
    echo view('footer');
	}

    public function simpan_history_v_balok()
    {
        $model = new M_siapake();
        
        // Ambil ID User dari session
        $id_user = session()->get('id');
    
        // Ambil nilai sisi dari form
        $panjang = $this->request->getPost('panjang');
        $lebar = $this->request->getPost('lebar');
        $tinggi = $this->request->getPost('tinggi');
    
        // Buat format hasil
        $volume = $panjang * $lebar * $tinggi; // Volume = panjang × lebar × tinggi

    // Buat format hasil
    $hasil = "V = p ={$panjang} × L ={$lebar} × t ={$tinggi} = {$volume}";
    
        // Data yang akan disimpan ke dalam tabel history
        $yoga = [
            'id_user' => $id_user,
            'hasil'   => $hasil, // Memasukkan hasil langsung
            'waktu'   => date('Y-m-d H:i:s')
        ];
    
        // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
        $model->tambah('history', $yoga);
    
        // Redirect kembali ke halaman perhitungan luas persegi
        return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
    }



    public function v_tabung()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('v_tabung');
    echo view('footer');
	}

    public function simpan_history_v_tabung()
    {
        $model = new M_siapake();
        
        // Ambil ID User dari session
        $id_user = session()->get('id');
    
        // Ambil nilai sisi dari form
        $jariJari = $this->request->getPost('jariJari');
    $tinggi = $this->request->getPost('tinggi');
    
        // Buat format hasil
        $volume = M_PI * pow($jariJari, 2) * $tinggi; // Volume = π × r² × t

    // Format hasil perhitungan
    $hasil = "V = π × r² × t = π × ({$jariJari}²) × {$tinggi} = " . round($volume, 2);
    
        // Data yang akan disimpan ke dalam tabel history
        $yoga = [
            'id_user' => $id_user,
            'hasil'   => $hasil, // Memasukkan hasil langsung
            'waktu'   => date('Y-m-d H:i:s')
        ];
    
        // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
        $model->tambah('history', $yoga);
    
        // Redirect kembali ke halaman perhitungan luas persegi
        return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
    }


    public function v_kerucut()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('v_kerucut');
    echo view('footer');
	}

    public function simpan_history_v_kerucut()
    {
        $model = new M_siapake();
        
        // Ambil ID User dari session
        $id_user = session()->get('id');
    
        // Ambil nilai sisi dari form
        $jariJari = $this->request->getPost('jariJari');
        $tinggi = $this->request->getPost('tinggi');
    
        // Buat format hasil
        $volume = (1 / 3) * M_PI * pow($jariJari, 2) * $tinggi;

    // Format hasil perhitungan
    $hasil = "V = (1/3) × π × r² × t = (1/3) × π × ({$jariJari}²) × {$tinggi} = " . round($volume, 2);
    
        // Data yang akan disimpan ke dalam tabel history
        $yoga = [
            'id_user' => $id_user,
            'hasil'   => $hasil, // Memasukkan hasil langsung
            'waktu'   => date('Y-m-d H:i:s')
        ];
    
        // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
        $model->tambah('history', $yoga);
    
        // Redirect kembali ke halaman perhitungan luas persegi
        return redirect()->to(base_url('home/l_persegi'))->with('success', 'Perhitungan berhasil disimpan.');
    }


    public function v_bola()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('v_bola');
    echo view('footer');
	}

    public function simpan_history_v_bola()
{
    $model = new M_siapake();
    
    // Ambil ID User dari session
    $id_user = session()->get('id');

    // Ambil nilai jari-jari dari form
    $jariJari = $this->request->getPost('jariJari');

    // Hitung volume bola
    $volume = (4 / 3) * M_PI * pow($jariJari, 3); // Volume = (4/3) × π × r³

    // Format hasil perhitungan
    $hasil = "V = (4/3) × π × r³ = (4/3) × π × ({$jariJari}³) = " . round($volume, 2);
    
    // Data yang akan disimpan ke dalam tabel history
    $yoga = [
        'id_user' => $id_user,
        'hasil'   => $hasil, // Memasukkan hasil langsung
        'waktu'   => date('Y-m-d H:i:s')
    ];

    // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
    $model->tambah('history', $yoga);

    // Mengirimkan respons ke client
    return $this->response->setJSON([
        'success' => true,
        'id' => $model->insertID(),
        'hasil' => $hasil
    ]);
}



public function turunan()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('turunan');
    echo view('footer');
	}

    public function simpan_history_turunan()
{
    $model = new M_siapake();
    
    // Ambil ID User dari session
    $id_user = session()->get('id');

    // Ambil nilai fungsi dan hasil turunan dari form
    $fungsi = $this->request->getPost('fungsi');
    $turunan = $this->request->getPost('turunan');

    // Format hasil turunan
    $hasil = "Turunan dari fungsi {$fungsi} adalah: {$turunan}";

    // Data yang akan disimpan ke dalam tabel history
    $data_history = [
        'id_user' => $id_user,
        'hasil'   => $hasil, // Memasukkan hasil turunan langsung
        'waktu'   => date('Y-m-d H:i:s')
    ];

    // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
    $model->tambah('history', $data_history);

    // Redirect kembali ke halaman perhitungan turunan
    return redirect()->to(base_url('home/l_perhitungan_turunan'))->with('success', 'Perhitungan turunan berhasil disimpan.');
}


public function limit()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('history');
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
    echo view('limit');
    echo view('footer');
	}

    public function simpan_history_limit()
{
    $model = new M_siapake();

    // Ambil ID User dari session
    $id_user = session()->get('id');

    // Ambil nilai fungsi dan hasil limit dari form
    $fungsi = $this->request->getPost('fungsi');
    $hasil = $this->request->getPost('hasil'); // Hasil limit perhitungan

    // Format hasil limit
    $hasil_limit = "Limit dari fungsi {$fungsi} adalah: {$hasil}";

    // Data yang akan disimpan ke dalam tabel history
    $data_history = [
        'id_user' => $id_user,
        'hasil'   => $hasil_limit, // Menyimpan hasil limit perhitungan
        'waktu'   => date('Y-m-d H:i:s')
    ];

    // Simpan data ke tabel 'history' menggunakan method 'tambah' dari model
    $model->tambah('history', $data_history);

    // Redirect kembali ke halaman perhitungan limit
    return redirect()->to(base_url('home/l_perhitungan_limit'))->with('success', 'Perhitungan limit berhasil disimpan.');
}



public function kalkulator()
	{
		$model= new M_siapake();

		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Kalkulator',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('kalkulator');
    echo view('footer');
	}


    public function saveHistory()
{
    $model = new M_siapake(); // Memanggil model M_siapake

    // Mengambil data JSON yang dikirimkan dari frontend
    $data = $this->request->getJSON();

    if ($data) {
        // Ambil data perhitungan dan hasil dari request JSON
        $perhitungan = $data->perhitungan;
        $hasil = $data->hasil;

        // Menyusun data yang akan disimpan ke dalam tabel history_perhitungan
        $data_history = [
            'id_user' => session()->get('id'),      // ID User dari session
            'tanggal' => date('Y-m-d H:i:s'),       // Waktu saat ini
            'hasil'   => $perhitungan . ' = ' . $hasil // Menyimpan hasil perhitungan dalam format "perhitungan = hasil"
        ];

        // Simpan data ke dalam tabel 'history_perhitungan' menggunakan method 'tambah' dari model
        $saveStatus = $model->tambah('history_perhitungan', $data_history);

        // Mengembalikan respons sukses atau gagal
        if ($saveStatus) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    // Jika data tidak valid
    return $this->response->setJSON(['success' => false]);
}







public function history()
	{
		$model= new M_siapake();

        $id_user = session()->get('id');
    
    // Ambil data history berdasarkan id_user
    $data['oke'] = $model->tampilwhere('history', ['id_user' => $id_user]);
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
    echo view('history');
    echo view('footer');
	}

    public function hapus_history($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_history' => $id);
        $model->hapus('history', $where);
    
        return redirect()->to('home/history');
    }



public function get_history()
{
    $model = new M_siapake();

    // Ambil id_user dari session
    $id_user = session()->get('id');
    
    // Ambil data history berdasarkan id_user
    $data['history'] = $model->tampilwhere('history', ['id_user' => $id_user]);

    // Ambil data setting jika diperlukan
    $where = ['id_setting' => '1'];
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Log aktivitas user
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Melihat History Perhitungan Luas Persegi',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Debug: Log data history yang didapat
    log_message('debug', 'Data History: ' . print_r($data['history'], true));

    // Return data history dalam format JSON
    return $this->response->setJSON($data['history']);
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
  
        $data['oke'] = $model->tampilActive('user');
        
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
        $where = array('id_user' => $id);
        $array = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        $model->edit('user', $array, $where);
        // $this->logUserActivity('Menghapus Pemesanan');

        return redirect()->to('home/user');
    }
    

    public function hapus_user_permanent($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_user' => $id);
        $model->hapus('user', $where);
    
        return redirect()->to('Home/user');
    }


    public function restore_user($id)
    {
        $model = new M_siapake();
        $where = array('id_user' => $id);
        $array = array(
            'deleted_at' => NULL, // Mengatur deleted_at menjadi null
        );
        $model->edit('user', $array, $where);
    
        return redirect()->to('home/user');
    }


    public function soft_delete(){

        $model = new M_siapake;
        $data['oke'] = $model->tampilrestore('user');
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

   




   
    

    public function t_user()
	{
		$model= new M_siapake();
  
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
    $level = $this->request->getPost('level');

    $password = md5('1');

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'level' => $level,
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
        $email = $this->request->getPost('email');
        $level = $this->request->getPost('level');
        $id = $this->request->getPost('id_user');
        // Hash the deskripsi using MD5
        $model = new M_siapake;
    $oldData = $model->getWhere('user', ['id_user' => $id]);

        // Simpan data lama ke tabel backup
        if ($oldData) {
            $backupData = [
                'id_user' => $oldData->id_user,  // integer
                'username' => $oldData->username,     
                'email' => $oldData->email,    
                'level' => $oldData->level,     // integer
                'backup_by' => $oldData->backup_by,         // integer
                'backup_at' => $oldData->backup_at,         // datetime
            ];

            // Debug: cek hasil insert ke tabel backup
            if ($model->saveToBackup('user_backup', $backupData)) {
                echo "Data backup berhasil disimpan!";
            } else {
                echo "Gagal menyimpan data ke backup.";
            }
        } else {
            echo "Data lama tidak ditemukan.";
        }

        // Data baru yang akan diupdate
        $yoga = array(
           'username' => $username,
           'email' => $email,
                'level' => $level,
                'updated_by' => session()->get('id'),
                'updated_at' => date('Y-m-d H:i:s'),
        );

        // Update data di tabel pemesanan
        $where = array('id_user' => $id);
        $model->edit('user', $yoga, $where);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/user');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}



public function restore_edit(){

    $model = new M_siapake;
    $data['oke'] = $model->tampil('user_backup');
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Restore Edit User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('restore_edit', $data);
    echo view('footer');
}

public function aksi_restore_edit_user($id)
{
$model = new M_siapake();

$backupData = $model->getWhere('user_backup', ['id_user' => $id]);

if ($backupData) {
   
    $restoreData = [
        'username' => $backupData->username,
        'email' => $backupData->email,
        'level' => $backupData->level,
       
        // tambahkan field lainnya sesuai dengan struktur tabel menu
    ];
    unset($restoreData['id_user']);
    $model->edit('user', $restoreData, ['id_user' => $id]);
}

return redirect()->to('home/user');
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
