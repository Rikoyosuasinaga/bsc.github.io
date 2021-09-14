<?php $this->load->view('header'); ?>
<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->
<main id="main">
    <section id="promo-page">
        <div class=" container">
            <div class="section-header">
                <br/>
                <br/>
                <h3 style="color:#082032">Login</h3>
            </div>
            

            <div class="baris">
            <?php echo $this->session->flashdata('message'); ?>
                            <!-- .section-header -->
                <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <form class="contact-form" method="POST" action="<?= site_url() ?>user/validasi">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" >Login</button>
                            Belum Punya Akun? <a href="<?= site_url() ?>user/daftar">Daftar</a> 
                            <p><p class="margin right-align medium-small"><a href="<?= site_url() ?>login/lupapassword">Lupa Password ?</a></p></p>
                        </div>
                    </form>
                </div>
                </div>

            </div>

        </div>
    </section>
</main>
<?php $this->load->view('footer'); ?>