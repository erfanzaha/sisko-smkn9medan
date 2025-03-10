<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 text-center">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Gallery</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="school-category-courses pt30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Galeri Kegiatan</h3>
                    <p>Kegiatan yang dilakukan siswa dan yang ada di sekolah.</p>
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
    </div>
</section>