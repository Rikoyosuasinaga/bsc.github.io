<?php $this->load->view('header'); ?>
    <!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->
    <main id="main">
        <img src="<?= base_url() ?>assets/front/img/gallery/line.png" alt="" class="img-fluid line">
        <section id="promo" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Daftar Lapangan</h3>
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

            </div>

        </section>

        <section id="promo-mobile" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Daftar Lapangan</h3>
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

            </div>
        </section>

    </main>
<?php $this->load->view('footer'); ?>