<?php

namespace App\Controllers;
use App\Models\User_model;
use App\Models\Konfigurasi_model;

class Login extends BaseController
{
    // login
    public function index()
    {
        // Start validasi
        if($this->request->getMethod() === 'post' && $this->validate(
            [
            'username'  => 'required|min_length[3]',
            'password'  => 'required|min_length[3]',
            ])) 
        {           
            $username       = $this->request->getPost('username');
            $password       = $this->request->getPost('password');
            $pengalihan     = $this->request->getPost('pengalihan');
            $this->simple_login->login($username,$password,$pengalihan);
        }
        $m_site     = new Konfigurasi_model();
        $site       = $m_site->listing();
        
        $data = [   'title'     => 'Login Administrator',
                    'site'      => $site
                ];
        return view('login/index',$data);
    }

    // lupa
    public function lupa()
    {
        $m_site     = new Konfigurasi_model();
        $m_user     = new User_model();
        $site       = $m_site->listing();
        // Start validasi
        if($this->request->getMethod() === 'post' && $this->validate(
            [
            'email'  => 'required|min_length[3]',
            ])) 
        {           
            $email  = $this->request->getPost('email');
            $check  = $m_user->check($email);
            if($check) {
                $pesan  = '';
                $kirim  = \Config\Services::email();
                $kirim->setFrom($site->email, $site->namaweb);
                $kirim->setTo($email);
                $kirim->setSubject('Reset Password - '.$site->email);
                $kirim->setMessage($pesan);
                $kirim->send();
                return redirect()->to(base_url('login/lupa'))->with('sukses', 'Link reset password telah dikirimkan email. Silakan check folder spam email jika email tidak ditemukan.');
            }else{
                return redirect()->to(base_url('login/lupa'))->with('warning', 'Oops... Email tidak ditemukan');
            }
            
        }
        // end validasi
        
        $data = [   'title'     => 'Lupa Password',
                    'site'      => $site
                ];
        return view('login/lupa',$data);
    }

    // logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login?logout=sukses'));
    }
}
