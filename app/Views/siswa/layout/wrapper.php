<?php 
$session = \Config\Services::session();
if($session->get('username_siswa')=="") {
	$session->setFlashdata('sukses','Ooops... Anda belum login');
	return redirect()->to(base_url('signin'));
}
// gabungkan semua bagian file
require_once('head.php');
require_once('header.php');
require_once('menu.php');
require_once('content.php');
require_once('footer.php');
