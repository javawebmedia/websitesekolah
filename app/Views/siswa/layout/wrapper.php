<?php 
$session = \Config\Services::session();
if($session->get('username_siswa')=="") {
	$session->setFlashdata('sukses','Ooops... Anda belum login');
	return redirect()->to(base_url('signin'));
}

// gabungkan semua bagian file
echo view('admin/layout/head');

require_once('header.php');
require_once('menu.php');

if($content) {
	echo view($content);
}

echo view('admin/layout/footer');
