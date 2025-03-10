 <!-- Our Footer -->
 <section class="footer_one home3">
     <div class="container">
         <div class="row">
             <div class="col-sm-6 col-md-3 col-md-3 col-lg-3">
                 <div class="footer_contact_widget home3">
                     <h4>ALAMAT</h4>
                     <p><?= $alamat->deskripsi ?> </p>
                 </div>
             </div>
             <div class="col-sm-6 col-md-3 col-md-3 col-lg-3">
                 <div class="footer_company_widget home3">
                     <h4>KONTAK</h4>
                     <p><?= $no_telp->deskripsi ?> </p>
                 </div>
             </div>
             <div class="col-sm-6 col-md-3 col-md-3 col-lg-3">
                 <div class="footer_program_widget home3">
                     <h4>EMAIL</h4>
                     <p><?= $email->deskripsi ?> </p>
                 </div>
             </div>
             <div class="col-sm-6 col-md-3 col-md-3 col-lg-3">
                 <div class="footer_support_widget home3">
                     <h4>WEBSITE</h4>
                     <p><?= $website->deskripsi ?> </p>
                 </div>
             </div>
             
         </div>
     </div>
 </section>

 <!-- Our Footer Middle Area -->
 <section class="footer_middle_area home3 p0">
     <div class="container">
         <div class="row">
             <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb15 pt15">
                 <div class="logo-widget home3">
                     <?= $this->Html->image('logo-SMK9-2.png', array('alt' => 'CakePHP','class'=>'img-fluid','style'=>'width:50px;')); ?>
                     <span>SMK Negeri 9 Medan </span>
                 </div>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb15 pt15">
                 <div class="footer_social_widget mt15">
                     <ul>
                         <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                         <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                         <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                         <li class="list-inline-item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                         <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- Our Footer Bottom Area -->
 <section class="footer_bottom_area home3 pt30 pb30">
     <div class="container">
         <div class="row">
             <div class="col-lg-6 offset-lg-3">
                 <div class="copyright-widget text-center">
                     <p>Copyright SMK Negeri 9 Medan © 2022. All Rights Reserved.</p>
                 </div>
             </div>
         </div>
     </div>
 </section>