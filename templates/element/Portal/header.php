<!-- Main Header Nav -->
<header class="header-nav menu_style_home_three navbar-scrolltofixed stricky main-menu">
    <div class="container-fluid">
        <!-- Ace Responsive Menu -->
        <nav>
            <!-- Menu Toggle btn-->
            <div class="menu-toggle">
                <?= $this->Html->image('Logo-SMK9-2.png', array('alt' => 'CakePHP','class'=>'nav_logo_img img-fluid')); ?>
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a href="/" class="navbar_brand float-left dn-smd">
                <?php 
            echo $this->Html->image('Logo-SMK9-2.png', array('alt' => 'CakePHP','class'=>'logo1 img-fluid','style'=>'width:50px;'));
            echo $this->Html->image('Logo-SMK9-2.png', array('alt' => 'CakePHP','class'=>'logo2 img-fluid','style'=>'width:50px;')); ?>
            <span>SMK Negeri 9 Medan </span>
            </a>
            <!-- Responsive Menu Structure-->
            <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
            <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                <li class="list_two">
                    <a href="#"><span class="title"><?= $no_telp->deskripsi ?></span></a>
                </li>
                <li class="list_one">
                    <a href="#"><span class="title"><?= $email->deskripsi ?></span></a>
                </li>
            </ul>
        </nav>
        <!-- End of Responsive Menu -->
    </div>
</header>
<!-- Main Header Nav For Mobile -->
<div id="page" class="stylehome1 home3 h0">
    <div class="mobile-menu">
        <div class="header stylehome1">
            <div class="main_logo_home2">
                <?= $this->Html->image('logo.jpg', array('alt' => 'CakePHP','class'=>'nav_logo_img img-fluid float-left mt20')); ?>
            </div>
            <ul class="menu_bar_home2">
                <li class="list-inline-item">
                    <div class="search_overlay">
                        <a id="search-button-listener2" class="mk-search-trigger mk-fullscreen-trigger" href="#">
                            <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
                        </a>
                        <div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
                            <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i
                                    class="fa fa-times"></i></a>
                            <div id="mk-fullscreen-search-wrapper2">
                                <form method="get" id="mk-fullscreen-searchform2">
                                    <input type="text" value="" placeholder="Search courses..."
                                        id="mk-fullscreen-search-input2">
                                    <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value=""
                                            type="submit"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-inline-item"><a href="#menu"><span></span></a></li>
            </ul>
        </div>
    </div><!-- /.mobile-menu -->
    <nav id="menu" class="stylehome1">
        <ul>
            <li><a href="<?= $this->Url->build('/') ?>">Beranda</a></li>
        </ul>
    </nav>
</div>