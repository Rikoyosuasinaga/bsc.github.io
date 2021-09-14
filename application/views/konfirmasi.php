<?php $this->load->view('header'); ?>
<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->
<main id="main">
    <section id="promo-page">
        <div class=" container">
            <div class="section-header">
                <br/>
                <br/>
                <h3 style="color:#9200be">Form Konfirmasi Pembayaran</h3>
            </div>
            
            <div class="baris">
            <?php echo $this->session->flashdata('message'); ?>
                            <!-- .section-header -->
                <div>
                    <form class="contact-form" method="POST" action="<?= site_url() ?>konfirmasi/cek">
                                    
                        <div class="form-group">
                            <label>Tanggal Pesan</label>
                            <input type="text" name="tgl" class="form-control" id="date" placeholder="Tanggal Pesan"/>
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-Mail Untuk Memesan"/>
                        </div>
                        <div class="form-group">
                            <label>Kode Keamanan</label>
                            <input type="text" name="kode" class="form-control" placeholder="Kode Keamanan"/>
                        </div>
                        <div class="form-group">
                            <button type="reset" class="btn btn-primary" >Reset</button>
                            <button type="submit" class="btn btn-danger" >Kirim</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>
</main>
<?php $this->load->view('footer'); ?>