<?php 
use App\Libraries\Website;
$this->website     		= new Website(); 
$this->session          = \Config\Services::session();
// check
include('head.php');
include('header.php');
include('menu.php');
if($content) {
	echo view($content);
}
include('footer.php');