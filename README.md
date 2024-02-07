# Website Profil dan Manajemen Sekolah menguunakan CodeIgniter 4 Framework
Aplikasi website profil dan manajemen sekolah dari [Java Web Media](https://javawebmedia.com/) dengan berbagai fitur yang semoga bermanfaat. 

Demo unofficial sementara http://sekolah.down.my.id/

Spesifikasi Teknis Source Code
Website ini dikembangkan dengan beberapa spesifikasi:
1. Dikembangan dengan Codeigniter 4. Pastikan teman-teman membaca Server Requirements dari CI4 ini yah.
2. Template Admin menggunakan AdminLTE 3.2.0. Bisa diakses di https://adminlte.io/
3. Template front end menggunakan Sandbox - Modern & Multipurpose Bootstrap 5 Template 3.4.0 dari https://sandbox.elemisthemes.com/.
4. Notifikasi menggunakan Sweetalert
5. Datatables dan plugin export

# Fitur-fitur Website meliputi:

## HALAMAN FRONT END:

1. Halaman Beranda/Homepage
2. Banner
3. Halaman berita (update,pengumuman,indeks)
4.  Halaman profile (Profil staf team, Layanan & produk, Prestasi & penghargaan, Ekstrakurikuler, Fasilitas sarana dan prasarana)
5. Halaman Karya
6. Halaman galeri gambar
7. Halaman galeri video
8. Halaman file download
9. Halaman Tautan
10. Halaman kontak
11. Floating whatsapp button
12. Login Siswa & Calon Siswa
13. Pendaftaran

## HALAMAN BACK END:
1. Login dan logout
2. Halaman update profile dan ganti password
3. Halaman Dashboard
4. Halaman kelola pendaftar
5. Halaman kelola berita dan kategorinya
6. Halaman kelola Galeri dan Banner dan kategorinya
7. Halaman kelola staff and team dan kategorinya
8. Halaman kelola Peestasi dan penghargaan dan kategorinya
9. Halaman kelola Event dan Agenda dan kategorinya
10. Halaman kelola upload/download file dan kategorinya
11. Halaman kelola video youtube
12. Halaman kelola Karya dan kategorinya
13. Halaman kelola Fasilitas dan kategorinya
14. Halaman kelola Ekstrakurikuler dan kategorinya
15. Halaman kelola Manajemen Siswa (Rombongan Belajar, Tahun Ajaran, Kelas)
16. Halaman kelola Mitra dan kategorinya
17. Halaman kelola Master Data (Link website, Jenjang Pendidikan, Agama, Hubungan Keluarga, Jenis pekerjaan)
18. Halaman kelola menu front end
19. Halaman kelola pengguna sistem
20. Halaman kelola konfigurasi (website, logo dan icon, about us, banner, email, informasi detail sekolah)
21. Dan fitur lainnya

## Mengakses Halaman Website dan Login ke Admin
1. Buka browser Anda
2. Ketik alamat http://websitekamu.com
3. Untuk Login ke halaman Back End, silakan buka http://websitekamu.com/login
4. Username admin: andoyo
6. Password admin: andoyo
5. Untuk Login siswa dan pendaftar, silahkan buka http://websitekamu.com/signin

Catatan : Beberapa fitur masih dalam tahap pengembangan, dan mungkin belum bekerja dengan baik

# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> **Warning**
> The end of life date for PHP 7.4 was November 28, 2022. If you are
> still using PHP 7.4, you should upgrade immediately. The end of life date
> for PHP 8.0 will be November 26, 2023.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
