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
                    <div class="mbp_thumb_post">
                        <div class="thumb">
                            <img class="img-fluid" src="/portal/images/blog/<?= $berita->gambar ?>" style="width:100%;">
                            <div class="post_date">
                                <h2>
                                    <?php
                                        $date=date_create($berita->tanggal);
                                        echo date_format($date,"d"); ?>
                                </h2> <span><?= date_format($date,"F"); ?></span>
                            </div>
                        </div>
                        <div class="details">
                            <h3><?= $berita->title ?></h3>
                            <ul class="post_meta">
                                <li><a href="#"><span class="flaticon-profile"></span></a></li>
                                <li><a href="#"><span><?= $berita->admin ?></span></a></li>                                
                            </ul>
                            <?php echo $berita->isi_berita; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>