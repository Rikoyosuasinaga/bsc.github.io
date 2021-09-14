<?php $this->load->view('header'); ?>
<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->

<script type="text/javascript">
    function save()
    {
        $('.help-block').empty(); // clear error string
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;
        url = "<?php echo site_url('user/verifikasi') ?>";

        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    alert("Pendaftaran Berhasil :)");
                    window.location.href= "<?= site_url() ?>user";
                } else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Daftar'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('Daftar'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
</script>
<main id="main">
    <section id="promo-page">
        <div class=" container">
            <div class="section-header">
                <br/>
                <br/>
                <h3 style="color:#082032">Daftar</h3>
            </div>
            

            <div class="baris">
            <?php echo $this->session->flashdata('message'); ?>
                            <!-- .section-header -->
                <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <form class="contact-form" id="form" enctype="multipart/form-data" method="POST" action="">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_user" class="form-control" placeholder="Nama"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="" selected default disabled>::: Pilih :::</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3"></textarea>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>No. HP/WA</label>
                            <input type="number" name="no_hp" class="form-control" placeholder="No. HP/WA"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-Mail"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="test" name="username" class="form-control" placeholder="Username"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_" class="form-control" placeholder="Konfirmasi Password"/>
                            <span class="help-block" style="color : red"></span>
                        </div>
                        <div class="form-group">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary" >Daftar</button>
                            Sudah Punya Akun? <a href="<?= site_url() ?>user">Login</a>
                        </div>
                    </form>
                </div>
                </div>

            </div>

        </div>
    </section>
</main>
<?php $this->load->view('footer'); ?>