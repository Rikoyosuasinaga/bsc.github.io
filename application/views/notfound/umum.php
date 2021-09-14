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
                <h2>Klik Untuk Pesan <br /><span>E-Ticket</span></h2>
                <div>
                    <a href="<?= site_url() ?>ticket" class="btn-get-started scrollto">Beli Ticket</a>
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
                    <h3>Promo</h3>
                </header>

                <div class="row row-eq-height justify-content-center">
                    <?php foreach($promo as $p){ ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="card wow bounceInUp">
                            <a href="<?= site_url() ?>ticket/detail/<?= $p['link'] ?>">
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
                        <a href="promo.html">
                            <button type="button" class="btn wow fadeInUp">Lihat Promo Lain</button>
                        </a>
                    </p>
                </div>

            </div>

        </section>

        <section id="promo-mobile" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Promo</h3>
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
                                    <a href="<?= site_url() ?>ticket/detail/<?= $p3['link'] ?>">
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
                        <a href="page/data_promo.html">
                            <button type="button" class="btn wow fadeInUp">Lihat Promo Lain</button>
                        </a>
                    </p>
                </div>

            </div>
        </section>
        <!--==========================
      Wahana Section
    ============================-->
        <section id="wahana" class="section-bg">
            <div class="container">

                <header class="section-header">
                    <h3>Attraction</h3>
                    <p>Jogja Bay Waterpark memberikan keamanan dan kenyamanan bagi keluarga, juga menyajikan berbagai
                        wahana yang memberikan pengalaman baru dan seru yang tak terlupakan.</p>
                </header>

                <div class="row">
                    <?php $attrac = $this->crud->read('ms_attraction',[],'judul ASC'); ?>
                    <?php $ny=1; foreach($attrac as $a){
                    if($ny < 5){ ?>
                    <div class="col-md-6 col-sm-6 col-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-duration="1.4s">
                        <div class="box">
                            <a href="#">
                                <div class="icon"><img src="<?= base_url() ?>attraction/<?= $a['foto'] ?>"
                                        class="img-fluid"></div>
                                <h4 class="title"><?= $a['judul'] ?></h4>
                                <p class="description" style="color:#000"><?= $a['deskripsi'] ?></p>
                            </a>
                        </div>
                    </div>
                    <?php } $ny++;} ?>

                    <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s"
                        style="text-align:center">
                        <button class="btn btn-primary" id="buttonCollapse" type="button" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Lihat Lebih Banyak
                        </button>
                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="row">
                    <?php $ny=1; foreach($attrac as $a){
                    if($ny >= 5){ ?>
                        <div class="col-md-6 col-sm-6 col-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.2s"
                            data-wow-duration="1.4s">
                            <div class="box">
                                <a href="attraction/11.html">
                                    <div class="icon"><img src="<?= base_url() ?>attraction/<?= $a['foto'] ?>"
                                            class="img-fluid"></div>
                                    <h4 class="title"><?= $a['judul'] ?></h4>
                                    <p class="description" style="color:#000"><?= $a['deskripsi'] ?></p>
                                </a>
                            </div>
                        </div>
                    <?php } $ny++;} ?>

                    </div>
                </div>
            </div>

            </div>
        </section> <!-- #Wahana -->
        <!--==========================
      Gallery Section
    ============================-->
        <section id="gallery" class="clearfix">
            <div class="container">

                <header class="section-header">
                    <h3 class="section-title">Our Photo</h3>
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
                                        data-lightbox="gallery" data-title="Memo Racer" class="link-preview"
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
                    <h3>About Us</h3>
                    <h2>Jogja Bay</h2>
                </header>

                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">

                        <div class="icon-box wow fadeInUp">
                            <div class="icon"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            <h4 class="title">Jogja Bay Waterpark (JBW)</h4>
                            <p class="description">salah satu waterpark terbesar di asia tenggara yang berlokasi di kota
                                wisata terbesar kedua di Indonesia yaitu Yogyakarta. Dan belakangan ini sudah menjadi
                                salah satu tujuan destinasi wisata di Yogyakarta.</p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            <h4 class="title">Keunikan Jogja Bay</h4>
                            <p class="description">terdapat story telling antara Tradisi Jogja dengan para bajak laut
                                Eropa yang dituangkan melalui On-site Live Show, Karakter, Water rides dan Merchandise.
                            </p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.3s">
                            <div class="icon"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            <h4 class="title">Tema dan Nuansa Jogja Bay</h4>
                            <p class="description">Jogja Bay Waterpark menjadi sebuah perkampungan tua Bajak Laut yang
                                bernuansa Tropical Lust yang penuh dengan tanaman hijau dan thematic old pirates. Selain
                                itu di jogja bay juga terdapat 9 wahana seru yang bisa dimainkan, ini dia beberapa
                                wahana yang paling menantang.</p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            <h4 class="title">Jadwal Buka Jogja Bay</h4>
                            <div class="row">
                                <div class="col-6" style="font-size:14px">
                                    <p>
                                        <b>Weekdays</b>
                                        <br />
                                        Loket : 09.00 - 16.00 <br />
                                        Wahana : 09.00 - 18.00<br />
                                        Theater : 09.00 - 22.00*
                                    </p>
                                </div>
                                <div class="col-6" style="font-size:14px">
                                    <p>

                                        <b>Weekend</b>
                                        <br />
                                        Loket : 08.00 - 16.00 <br />
                                        Wahana : 09.00 - 18.00<br />
                                        Theater : 09.00 - 22.00*
                                    </p>
                                </div>
                            </div>
                            <p class="description"> <br />*&#41; apabila ada event </p>

                        </div>

                    </div>

                    <div class="col-lg-6 <?= base_url() ?>assets/background order-lg-2 order-1 wow fadeInUp">
                        <img src="<?= base_url() ?>assets/front/img/gallery/abut.png" class="img-fluid" alt=""
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
                    <h3 style="">Testimonials</h3>
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
                        <a href="index.html">
                            <button type="button" id="bton" class="btn wow fadeInUp" style="margin-top:20px">Berikan
                                Testimoni</button>
                        </a>
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
                    <h3 style="color:#9200be; text-shadow: 2px 1px rgba(9, 9, 50, 0.45);">Video</h3>
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