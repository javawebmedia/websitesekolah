<?php 
use App\Libraries\Simple_login;
use App\Libraries\Website;
$this->simple_login     = new Simple_login(); 
$this->website     		= new Website(); 
$this->session          = \Config\Services::session();
// check
$this->simple_login->checklogin();
include('head.php');
include('header.php');
include('menu.php');
if($content) {
	echo view($content);
}
include('footer.php');