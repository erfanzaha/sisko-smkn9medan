<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 text-center">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Berita</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Blog Post Content -->
<section class="blog_post_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="main_blog_post_content">
                    <div class="row">
                        <?php foreach ($berita as $key => $value): ?>
                        <div class="col-sm-4 col-lg-4 col-xl-4">
                            <div class="blog_grid_post mb30">
                                <div class="thumb">
                                    <img class="img-fluid" src="/portal/images/blog/<?= $value->gambar ?>">
                                    <div class="post_date">
                                        <h2>
                                        <?php
                                        $date=date_create($value->tanggal);
                                        echo date_format($date,"d"); ?>
                                        </h2> <span><?= date_format($date,"F"); ?></span>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="/berita/<?= $value->id ?>"><h3><?= $value->title ?></h3></a>
                                    <ul class="post_meta">
                                        <li><a href="#"><span class="flaticon-profile"></span></a></li>
                                        <li><a href="#"><span><?= $value->admin ?></span></a></li>
                                    </ul>
                                    <?php 
                                    $kalimat= $value->isi_berita;
                                    $jumlahkarakter=100;
                                    $cetak = substr($kalimat,$jumlahkarakter,1);
                                    if($cetak !=" "){
                                        while($cetak !=" "){
                                            $i=1;
                                            $jumlahkarakter=$jumlahkarakter+$i;
                                            $kalimat= $value->isi_berita;
                                            $cetak = substr($kalimat,$jumlahkarakter,1);
                                        }
                                    }
                                    $cetak = substr($kalimat,0,$jumlahkarakter);
                                    echo $cetak;?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>