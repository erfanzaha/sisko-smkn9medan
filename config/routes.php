<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)...
     */
    $builder->connect('/', ['controller' => 'Portal', 'action' => 'display', 'display']);

    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    
    $builder->connect('/berita', 'Portal::berita');
    $builder->connect('/berita/*', 'Portal::detailBerita');
    $builder->connect('/kegiatan', 'Portal::kegiatan');

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     
 *     // Parse specified extensions from URLs
 *     // $builder->setExtensions(['json', 'xml']);
 *     
 *     // Connect API actions here.
 * });
 * ```
 */
$routes->prefix('Auth', function (RouteBuilder  $builder) {
    // login
    $builder->connect('/login', 'Login::display');
    $builder->connect('/proses-login', ['controller' => 'Login', 'action' => 'ajaxProsesLogin']);

    //forget password
    $builder->connect('/forget-password', 'ForgetPassword::display');
    $builder->connect('/proses-forget-password', ['controller' => 'ForgetPassword', 'action' => 'ajaxProsesForgetPassword']);

    //reset password
    $builder->connect('/reset-password', 'ResetPassword::display');
    $builder->connect('/proses-reset-password', ['controller' => 'ResetPassword', 'action' => 'ajaxProsesResetPassword']);

    //register
    $builder->connect('/register', 'Register::display');
    $builder->connect('/proses-register', ['controller' => 'Register', 'action' => 'ajaxProsesRegister']);

    //logout
    $builder->connect('/logout', ['controller' => 'Logout', 'action' => 'ajaxProsesLogout']);
});

/**
 * admin section
 */
$routes->prefix('Admin', function (RouteBuilder $builder) {
    //dashboard
    $builder->connect('/dashboard', 'Dashboard::display');
    $builder->connect('/view-dashboard-pembayaran', ['controller' => 'Dashboard', 'action' => 'viewDashboardPembayaran']);
    $builder->connect('/send-mail-dashboard', ['controller' => 'Dashboard', 'action' => 'ajaxSendMailDashboard']);

    //notifikasi
    $builder->connect('/notifikasi', 'Notifikasi::display');

    //administrator
    $builder->connect('/administrator', 'Administrator::display');
    $builder->connect('/save-administrator', ['controller' => 'Administrator', 'action' => 'ajaxSaveAdministrator']);
    $builder->connect('/view-administrator', ['controller' => 'Administrator', 'action' => 'ajaxViewAdministrator']);
    $builder->connect('/get-administrator', ['controller' => 'Administrator', 'action' => 'ajaxGetAdministrator']);
    $builder->connect('/delete-administrator', ['controller' => 'Administrator', 'action' => 'ajaxDeleteAdministrator']);

    //guru pegawai
    $builder->connect('/guru-pegawai', 'GuruPegawai::display');
    $builder->connect('/save-guru-pegawai', ['controller' => 'GuruPegawai', 'action' => 'ajaxSaveGuruPegawai']);
    $builder->connect('/view-guru-pegawai', ['controller' => 'GuruPegawai', 'action' => 'ajaxViewGuruPegawai']);
    $builder->connect('/get-guru-pegawai', ['controller' => 'GuruPegawai', 'action' => 'ajaxGetGuruPegawai']);
    $builder->connect('/delete-guru-pegawai', ['controller' => 'GuruPegawai', 'action' => 'ajaxDeleteGuruPegawai']);

    //kelas
    $builder->connect('/kelas', 'Kelas::display');
    $builder->connect('/save-kelas', ['controller' => 'Kelas', 'action' => 'ajaxSaveKelas']);
    $builder->connect('/view-kelas', ['controller' => 'Kelas', 'action' => 'ajaxViewKelas']);
    $builder->connect('/view-all-kelas', ['controller' => 'Kelas', 'action' => 'ajaxViewAllKelas']);
    $builder->connect('/get-kelas', ['controller' => 'Kelas', 'action' => 'ajaxGetKelas']);
    $builder->connect('/delete-kelas', ['controller' => 'Kelas', 'action' => 'ajaxDeleteKelas']);

    //tahun ajaran
    $builder->connect('/tahun-ajaran', 'TahunAjaran::display');
    $builder->connect('/save-tahun-ajaran', ['controller' => 'TahunAjaran', 'action' => 'ajaxSaveTahunAjaran']);
    $builder->connect('/view-tahun-ajaran', ['controller' => 'TahunAjaran', 'action' => 'ajaxViewTahunAjaran']);
    $builder->connect('/get-tahun-ajaran', ['controller' => 'TahunAjaran', 'action' => 'ajaxGetTahunAjaran']);
    $builder->connect('/delete-tahun-ajaran', ['controller' => 'TahunAjaran', 'action' => 'ajaxDeleteTahunAjaran']);

    //kelas yang diajar
    $builder->connect('/kelas-yang-diajar', 'KelasYangDiajar::display');
    $builder->connect('/save-kelas-yang-diajar', ['controller' => 'KelasYangDiajar', 'action' => 'ajaxSaveKelasYangDiajar']);
    $builder->connect('/view-kelas-yang-diajar', ['controller' => 'KelasYangDiajar', 'action' => 'ajaxViewKelasYangDiajar']);
    $builder->connect('/get-kelas-yang-diajar', ['controller' => 'KelasYangDiajar', 'action' => 'ajaxGetKelasYangDiajar']);
    $builder->connect('/delete-kelas-yang-diajar', ['controller' => 'KelasYangDiajar', 'action' => 'ajaxDeleteKelasYangDiajar']);

    //wali kelas    
    $builder->connect('/save-wali-kelas', ['controller' => 'WaliKelas', 'action' => 'ajaxSaveWaliKelas']);
    $builder->connect('/get-wali-kelas', ['controller' => 'WaliKelas', 'action' => 'ajaxGetWaliKelas']);

    //mata pelajaran
    $builder->connect('/mata-pelajaran', 'MataPelajaran::display');
    $builder->connect('/save-mata-pelajaran', ['controller' => 'MataPelajaran', 'action' => 'ajaxSaveMataPelajaran']);
    $builder->connect('/view-mata-pelajaran', ['controller' => 'MataPelajaran', 'action' => 'ajaxViewMataPelajaran']);
    $builder->connect('/get-mata-pelajaran', ['controller' => 'MataPelajaran', 'action' => 'ajaxGetMataPelajaran']);
    $builder->connect('/delete-mata-pelajaran', ['controller' => 'MataPelajaran', 'action' => 'ajaxDeleteMataPelajaran']);

    //siswa
    $builder->connect('/siswa', 'Siswa::display');
    $builder->connect('/save-siswa', ['controller' => 'Siswa', 'action' => 'ajaxSaveSiswa']);
    $builder->connect('/view-siswa', ['controller' => 'Siswa', 'action' => 'ajaxViewSiswa']);
    $builder->connect('/get-siswa', ['controller' => 'Siswa', 'action' => 'ajaxGetSiswa']);
    $builder->connect('/delete-siswa', ['controller' => 'Siswa', 'action' => 'ajaxDeleteSiswa']);
    $builder->connect('/save-konfirmasi-siswa', ['controller' => 'Siswa', 'action' => 'ajaxSaveKonfirmasiSiswa']);

    //orang tua
    $builder->connect('/orang-tua', 'OrangTua::display');
    $builder->connect('/save-orang-tua', ['controller' => 'OrangTua', 'action' => 'ajaxSaveOrangTua']);
    $builder->connect('/view-orang-tua', ['controller' => 'OrangTua', 'action' => 'ajaxViewOrangTua']);
    $builder->connect('/get-orang-tua', ['controller' => 'OrangTua', 'action' => 'ajaxGetOrangTua']);    

    //berita
    $builder->connect('/berita', 'Berita::display');
    $builder->connect('/save-berita', ['controller' => 'Berita', 'action' => 'ajaxSaveBerita']);
    $builder->connect('/view-berita', ['controller' => 'Berita', 'action' => 'ajaxViewBerita']);
    $builder->connect('/get-berita', ['controller' => 'Berita', 'action' => 'ajaxGetBerita']);
    $builder->connect('/delete-berita', ['controller' => 'Berita', 'action' => 'ajaxDeleteBerita']);

    //kegiatan
    $builder->connect('/kegiatan', 'Kegiatan::display');
    $builder->connect('/save-kegiatan', ['controller' => 'Kegiatan', 'action' => 'ajaxSaveKegiatan']);
    $builder->connect('/view-kegiatan', ['controller' => 'Kegiatan', 'action' => 'ajaxViewKegiatan']);
    $builder->connect('/get-kegiatan', ['controller' => 'Kegiatan', 'action' => 'ajaxGetKegiatan']);
    $builder->connect('/delete-kegiatan', ['controller' => 'Kegiatan', 'action' => 'ajaxDeleteKegiatan']);

    //profil sekolah
    $builder->connect('/profil-sekolah', 'ProfilSekolah::display');
    $builder->connect('/save-profil-sekolah', ['controller' => 'ProfilSekolah', 'action' => 'ajaxSaveProfilSekolah']);

    //jadwal pembayaran
    $builder->connect('/jadwal-pembayaran', 'JadwalPembayaran::display');
    $builder->connect('/save-jadwal-pembayaran', ['controller' => 'JadwalPembayaran', 'action' => 'ajaxSaveJadwalPembayaran']);
    $builder->connect('/view-jadwal-pembayaran', ['controller' => 'JadwalPembayaran', 'action' => 'ajaxViewJadwalPembayaran']);
    $builder->connect('/get-jadwal-pembayaran', ['controller' => 'JadwalPembayaran', 'action' => 'ajaxGetJadwalPembayaran']);
    $builder->connect('/delete-jadwal-pembayaran', ['controller' => 'JadwalPembayaran', 'action' => 'ajaxDeleteJadwalPembayaran']);

    //pembayaran
    $builder->connect('/pembayaran', 'Pembayaran::display');
    $builder->connect('/save-pembayaran', ['controller' => 'Pembayaran', 'action' => 'ajaxSavePembayaran']);
    $builder->connect('/view-pembayaran', ['controller' => 'Pembayaran', 'action' => 'ajaxViewPembayaran']);
    $builder->connect('/get-pembayaran', ['controller' => 'Pembayaran', 'action' => 'ajaxGetPembayaran']);    
    $builder->connect('/cetak-pembayaran/*', 'Pembayaran::cetakPembayaran');

    //laporan
    $builder->connect('/laporan', 'Laporan::display');

    //nilai
    $builder->connect('/nilai', 'Nilai::display');
    $builder->connect('/view-nilai', ['controller' => 'Nilai', 'action' => 'ajaxViewNilai']);
    $builder->connect('/save-nilai', ['controller' => 'Nilai', 'action' => 'ajaxSaveNilai']);
    $builder->connect('/get-nilai', ['controller' => 'Nilai', 'action' => 'ajaxGetNilai']);
});

/**
 * guru section
 */
$routes->prefix('Guru', function (RouteBuilder $builder) {
    //dashboard
    $builder->connect('/dashboard', 'Dashboard::display');
    $builder->connect('/get-guru', ['controller' => 'Dashboard', 'action' => 'ajaxGetGuru']);
    $builder->connect('/save-guru', ['controller' => 'Dashboard', 'action' => 'ajaxSaveGuru']);

    //data nilai
    $builder->connect('/nilai', 'Nilai::display');
    $builder->connect('/view-nilai', ['controller' => 'Nilai', 'action' => 'ajaxViewNilai']);
    $builder->connect('/save-nilai', ['controller' => 'Nilai', 'action' => 'ajaxSaveNilai']);
    $builder->connect('/get-nilai', ['controller' => 'Nilai', 'action' => 'ajaxGetNilai']);

    //wali kelas
    $builder->connect('/wali-kelas', 'WaliKelas::display');
    $builder->connect('/view-wali-kelas', ['controller' => 'WaliKelas', 'action' => 'ajaxViewWaliKelas']);

    //data kelas
    $builder->connect('/kelas', 'Kelas::display');
    $builder->connect('/view-kelas', ['controller' => 'Kelas', 'action' => 'ajaxViewKelas']);
});

/**
 * siswa section
 */
$routes->prefix('Siswa', function (RouteBuilder $builder) {
    //dashboard
    $builder->connect('/dashboard', 'Dashboard::display');
    $builder->connect('/get-siswa', ['controller' => 'Dashboard', 'action' => 'ajaxGetSiswa']);
    $builder->connect('/save-siswa', ['controller' => 'Dashboard', 'action' => 'ajaxSaveSiswa']);

    //notifikasi
    $builder->connect('/notifikasi', 'Notifikasi::display');

    //nilai
    $builder->connect('/nilai', 'Nilai::display');
    $builder->connect('/view-nilai', ['controller' => 'Nilai', 'action' => 'ajaxViewNilai']);

    //mata pelajaran
    $builder->connect('/mata-pelajaran', 'MataPelajaran::display');
    $builder->connect('/view-mata-pelajaran', ['controller' => 'MataPelajaran', 'action' => 'ajaxViewMataPelajaran']);

    //laporan
    $builder->connect('/laporan', 'Laporan::display');
    $builder->connect('/laporan/*', 'Laporan::display');
    $builder->connect('/view-laporan', ['controller' => 'Laporan', 'action' => 'ajaxViewLaporan']);
});


/**
 * orang tua section
 */
$routes->prefix('Orangtua', function (RouteBuilder $builder) {
    //dashboard
    $builder->connect('/dashboard', 'Dashboard::display');

    //notifikasi
    $builder->connect('/notifikasi', 'Notifikasi::display');

    //nilai
    $builder->connect('/nilai', 'NIlai::display');
    $builder->connect('/view-nilai', ['controller' => 'Nilai', 'action' => 'ajaxViewNilai']);

    //laporan
    $builder->connect('/laporan', 'Laporan::display');
    $builder->connect('/laporan/*', 'Laporan::display');
    $builder->connect('/view-laporan', ['controller' => 'Laporan', 'action' => 'ajaxViewLaporan']);
});