<?php $this->load->view('header'); ?>
<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->
<main id="main">
    <section id="promo-page">
        <div class=" container">
            <div class="section-header">
                <h3>Lapangan Detail</h3>
            </div>
            <br />

            <div class="baris row">

                <div class="col-lg-9 col-md-9 wow fadeInUp" data-wow-delay="0.1s">
                    <img src="<?= base_url() ?>banner/<?= $ticket['banner'] ?>" class="img-fluid"
                        style="display: block;margin-left: auto; margin-right: auto; margin-bottom:20px">
                    <h2 style=" color:#000; font-weight:bold; text-align:center"><?= $ticket['nama'] ?></h2>
                    <p>
                    <p><?= $ticket['deskripsi'] ?></p>
                    <div class="text-center">
                        <a href="<?= site_url() ?>lapangan/beli/<?= $ticket['link'] ?>" class="btn btn-primary wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; color:#fff">Booking Sekarang</a>
                    </div>

                </div>

                <div class="col-lg-3 col-md-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s"
                        style="border: 1px solid #0288d1; border-radius: 20px;">
                        <h6 style="text-align:center; margin-top:20px;"><strong>Lapangan Lainnya</strong></h6>
                        <hr style="border:1px solid #0288d1" />
                        <div class="list-berita">
                            <ul>
                                <?php foreach($promo as $p){ ?>
                                <li>
                                    <a href="<?= site_url() ?>ticket/detail/<?= $p['link'] ?>"><?= $p['nama'] ?></a>
                                    <hr />
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</main>
<?php $this->load->view('footer'); ?>