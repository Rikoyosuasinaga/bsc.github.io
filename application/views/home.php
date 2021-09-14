<?php $this->load->view('header'); ?>
    <!--==========================
    Intro Section
  ============================-->
    <section id="intro" class="clearfix">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $no=1; foreach($slider as $s){ ?>
                    <div class="carousel-item <?php if($no==1){echo 'active';}else{echo 'nonactive';} ?>">
                        <img class="d-block w-100 mh-100" src="<?= base_url() ?>slider/<?= $s['banner_slider'] ?>"
                            alt="<?= $s['banner_slider'] ?>">
                    </div>
                <?php $no++; } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- </div> -->
    </section><!-- #intro -->
    <!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->
    <main id="main">
        <!--==========================
      Ticket Button
    ============================-->
        <section id="tickets">
            <div class="tickets-content">
                <h2>Klik Untuk Booking <br /><span>di <?= mainweb('nama') ?></span></h2>
                <div>
                    <a href="<?= site_url() ?>lapangan" class="btn-get-started scrollto">Booking</a>
                </div>
            </div>

        </section>
        <!--==========================
      Berita Event
    ============================-->
        <img src="<?= base_url() ?>assets/front/img/gallery/line.png" alt="" class="img-fluid line">
        <section id="promo" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Lapangan</h3>
                </header>

                <div class="row row-eq-height justify-content-center">
                    <?php foreach($promo as $p){ ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="card wow bounceInUp">
                            <a href="<?= site_url() ?>lapangan/detail/<?= $p['link'] ?>">
                                <img src="<?= base_url() ?>banner/<?= $p['banner'] ?>" class="img-fluid">
                                <div class="card-body">

                                    <h5 class="card-title"><?= $p['nama'] ?></h5>

                                </div>
                            </a>

                        </div>
                    </div>
                    <?php } ?>

                    
                </div>
                <div class="button wow bounceInUp text-center">
                    <p>
                        <a href="<?= site_url() ?>lapangan">
                            <button type="button" class="btn wow fadeInUp">Lapangan Lain</button>
                        </a>
                    </p>
                </div>

            </div>

        </section>

        <section id="promo-mobile" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Lapangan</h3>
                </header>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $no2 = 0; foreach($promo as $p2){ ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $no2 ?>" class="<?php if($no2==0){echo 'active';} ?>"></li>
                        <?php $no2++; } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php $no3 = 0; foreach($promo as $p3){ ?>
                            <div class="carousel-item <?php if($no3==0){echo 'active';}else{echo 'nonactive';} ?>">
                                <div class="card">
                                    <a href="<?= site_url() ?>lapangan/detail/<?= $p3['link'] ?>">
                                        <img class="d-block w-100 mh-100 img-fluid" src="<?= base_url() ?>banner/<?= $p3['banner'] ?>" alt="">
                                        <div class="card-body">

                                            <h5 class="card-title"><?= $p3['nama'] ?></h5>

                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php $no3++; } ?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="button wow bounceInUp">
                    <p align="center" style="margin-top:20px;margin-bottom:-30px">
                        <a href="<?= site_url() ?>lapangan">
                            <button type="button" class="btn wow fadeInUp">Lapangan Lain</button>
                        </a>
                    </p>
                </div>

            </div>
        </section>
        <!--==========================
      Wahana Section
    ============================-->
        <!--==========================
      Gallery Section
    ============================-->
        <section id="gallery" class="clearfix">
            <div class="container">

                <header class="section-header">
                    <h3 class="section-title">Geleri</h3>
                    <br />
                </header>

                <div class="row gallery-container">
                    <?php $gal = $this->crud->read('ms_gallery'); ?>
                    <?php foreach($gal as $g){?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-6 gallery-item filter-atraction" data-wow-delay="0.1s">
                        <div class="gallery-wrap">
                            <img src="<?= base_url() ?>gallery/<?= $g['foto'] ?>" class="img-fluid"
                                alt="">
                            <div class="gallery-info">
                                <h4 style="color:#fff"><?= $g['judul'] ?></h4>
                                <div>
                                    <a href="<?= base_url() ?>gallery/<?= $g['foto'] ?>"
                                        data-lightbox="gallery" data-title="<?= $g['judul'] ?>" class="link-preview"
                                        title="Preview"><i class="ion ion-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>

            </div>
        </section> <!-- #Gallery -->
        <!--==========================
      About Us Section
    ============================-->
        <section id="about">
            <div class="container">

                <header class="section-header">
                    <h3>Tentang Kami</h3>
                    <h2><?= mainweb('nama') ?></h2>
                </header>

                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">

                        <div class="icon-box wow fadeInUp">
                            <div class="icon"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            <h4 class="title"><?= mainweb('nama') ?></h4>
                            <p class="description"><?= mainweb('nama')?>merupakan salah satu sarana olahraga yang berletak dikota Bandar Lampung,<?= mainweb('nama')?> menyediakan beberapa sarana olahraga diantaranya: Futsal, Badminton, dan Basket. </p>
                        </div>




                    </div>

                    <div class="col-lg-6 <?= base_url() ?>assets/background order-lg-2 order-1 wow fadeInUp">
                        <img src="<?= base_url() ?>logo/<?= mainweb('logo') ?>" class="img-fluid" alt=""
                            style="z-index:9999;bottom:0px">
                    </div>
                </div>

            </div>
        </section>
        <!-- #about -->
        <!--==========================
      Testimonial Section
    ============================-->
        <section id="testimonials" class="section-bg">
            <div class="container">
                <header class="section-header">
                    <h3 style="">Marchandise</h3>
                </header>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="owl-carousel testimonials-carousel wow fadeInUp">
                            <?php $testi = $this->crud->read('ms_testimonials',[],'nama ASC'); ?>
                            <?php foreach($testi as $t){ ?>
                            <div class="testimonial-item">
                                <img src="<?= base_url() ?>testimonials/<?= $t['foto'] ?>"
                                    class="testimonial-img" alt="">
                                <h3><?= $t['nama'] ?></h3>
                                <p style="color:#fff"><?= $t['testi'] ?></p>
                            </div>
                            <?php } ?>

                        </div>
                        <!--<a href="index.html">
                            <button type="button" id="bton" class="btn wow fadeInUp" style="margin-top:20px">Berikan
                                Testimoni</button>
                        </a>-->
                    </div>
                </div>
            </div>
        </section>
        <script>
        document.getElementById('bton').style.display = "none";
        </script> <!-- #testimonials -->
        <!--==========================
        Video Section
    ============================-->
        <section id="video">
            <div class="container">
                <header class="section-header">
                    <h3 style="color:#082032; text-shadow: 2px 1px rgba(9, 9, 50, 0.45);">Video</h3>
                </header>

                <div class="row">
                    <?php $video = $this->crud->read('ms_video'); ?>
                    <?php foreach($video as $v){ ?>
                    <div class="col-lg-6 col-md-6 wow fadeInUp">
                        <div class="member">
                            <iframe width="100%" height="315" src="<?= $v['link'] ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <div>
                                <h4 style="color:#000"><?= $v['judul'] ?></h4>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>

            </div>
        </section> <!-- #video -->
    </main>
<?php $this->load->view('footer'); ?>