<!-- Home Design -->
<section class="home-three home3-overlay home3_bgi6">
    <div class="container">
        <div class="row posr">
            <div class="col-lg-12">
                <div class="home-text text-center">
                    <h2 class="fz50">SMK Negeri 9 Medan </h2>
                    <p class="color-white">SMK UNGGULAN YANG MENGHASILKAN SDM BERMUTU DAN BERDAYA SAING TINGGI</p>
                    <a class="btn home_btn" href="<?= $this->Url->build('/auth/login') ?>">Silahkan masuk</a>
                </div>
            </div>
        </div>
        <div class="row_style">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300" preserveAspectRatio="none">
                <path
                    d="M 1000 280 l 2 -253 c -155 -36 -310 135 -415 164 c -102.64 28.35 -149 -32 -235 -31 c -80 1 -142 53 -229 80 c -65.54 20.34 -101 15 -126 11.61 v 54.39 z">
                </path>
                <path
                    d="M 1000 261 l 2 -222 c -157 -43 -312 144 -405 178 c -101.11 33.38 -159 -47 -242 -46 c -80 1 -153.09 54.07 -229 87 c -65.21 25.59 -104.07 16.72 -126 16.61 v 22.39 z">
                </path>
                <path
                    d="M 1000 296 l 1 -230.29 c -217 -12.71 -300.47 129.15 -404 156.29 c -103 27 -174 -30 -257 -29 c -80 1 -130.09 37.07 -214 70 c -61.23 24 -108 15.61 -126 10.61 v 22.39 z">
                </path>
            </svg>
        </div>
    </div>
</section>

<!-- about3 home3 -->
<section class="home3_about home3_wave">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="about_home3">
                    <h3>Profil Singkat</h3>
                    <h5>SMK Negeri 9 Medan</h5>
                    <p>SMK Negeri 9 Medan berdiri pada tahun 1960, awalnya bernama SHD, kemudian berganti menjadi SPSAN, dan berganti lagi menjadi SMPS dan mulai tahun 1997 menjadi SMK Negeri 9 Medan. Merupakan lembaga pendidikan & pelatihan dibawah naungan Dinas Pendidikan Pemerintahan Kota Medan, yakni sebagai bagian yang terpadu dalam system pendidikan menegah dalam bentuk teknis pelaksanaan untuk pengembangan Sekolah Menegah Kejuruan (SMK).</p><br>
                    <p>Pada tahun 2014 di dominasi sebagai SMK Rujukan (SMK Model) dan juga satu-satunya SMK di SUMUT yang mengikuti Teleconference link dengan Direktorat PSMK Jakarta, dengan memiliki Tiga Bidang Keahlian yaitu Kesehatan, Teknologi Komunikasi dan Informasi dan Seni Rupa dan Kriya yang terdiri dari 5 Program Keahlian, yaitu :</p><br>
                    <p style='margin-left:50px;'> 1. Perawatan Sosial (PS)<br>
                        2. Teknik Komputer Jaringan (TKJ)<br>
                        3. Rekayasa Perangakat Lunak (RPL)<br>
                        4. Multimedia (MM)<br>
                        5. Animasi (AN)<br>
                        6. Disain Komunikasi Visual (DKV)</p>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="home3_about_icon_box one">
                            <span class="icon"><span class="flaticon-account"></span></span>
                            <div class="details">
                                <h4>Buat Akun</h4>
                                <p>Data aman karena membutuhkan hak akses untuk masuk ke sistem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="home3_about_icon_box two">
                            <span class="icon"><span class="flaticon-online"></span></span>
                            <div class="details">
                                <h4>Evaluasi dan Penilaian</h4>
                                <p>Lebih mudah melakukan evaluasi dan penilaian secara umum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="home3_about_icon_box three">
                            <span class="icon"><span class="flaticon-student-1"></span></span>
                            <div class="details">
                                <h4>Manajemen Data</h4>
                                <p>Sistem ini dapat membatu melakukan manajemen data yang baik, rapi, dan profesional.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="home3_about_icon_box four">
                            <span class="icon"><span class="flaticon-employee"></span></span>
                            <div class="details">
                                <h4>Efektivitas SDM</h4>
                                <p>Sistem berbasis web menyederhanakan berbagai proses administrasi dan manajemen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="about_home3_shape_container">
                    <?= $this->Html->image('portal/images/about/shape1.png', array('alt' => 'CakePHP','class'=>'about_home3_shape')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Blog Post -->
<section class="our-blog pb30 pt30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Berita</h3>
                    <p>Berita-berita seputar siswa dan sekolah.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($berita as $key => $value): ?>
            <a href="#">
                <div class="col-sm-12 col-lg-4 col-xl-4">
                    <div class="blog_post_home2 home3">
                        <div class="bph2_header">
                            <img class="img-fluid" src="/portal/images/blog/<?= $value->gambar ?>"
                                alt="<?= $value->gambar ?>">
                            <a href="#" class="bph2_date_meta">
                                <span class="year">Read</span>
                            </a>
                        </div>
                        <div class="details">
                            <h4><?= $value->title ?></h4>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="courses_all_btn text-center">
                    <a class="btn btn-transparent" href="/berita">Berita Lainnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- School category courses -->
<section class="school-category-courses pt30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Galeri Kegiatan</h3>
                    <p>Kegiatan-kegiatan yang dilakukan siswa dan yang ada di sekolah.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($kegiatan as $key => $value): ?>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="gallery_item">
                    <?= $this->Html->image('portal/images/gallery/'.$value->gambar, array('alt' => 'CakePHP','class'=>'img-fluid img-circle-rounded w100')); ?>
                    <div class="gallery_overlay">
                        <a class="icon popup-img" href="portal/images/gallery/<?= $value->gambar ?>"><span
                                class="flaticon-zoom-in"></span></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="courses_all_btn text-center">
                    <a class="btn btn-transparent" href="/kegiatan">Kegiatan Lainnya</a>
                </div>
            </div>
        </div>
    </div>
</section>