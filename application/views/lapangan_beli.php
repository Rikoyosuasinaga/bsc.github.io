<?php $this->load->view('header'); ?>

<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->

<script type="text/javascript">

  function caritgl() {

    var id_lap = document.getElementById("id_lapangan").value;
    var tgl = document.getElementById("tgl_booking").value;
    var mulai = document.getElementById("jam_mulai").value;
    var selesai = document.getElementById("jam_selesai").value;



    $.ajax({

      type: "POST",

      url: "<?php echo site_url('lapangan/cektgl'); ?>/"+id_lap+"/"+tgl+"/"+mulai+"/"+selesai,

      //dataType : "JSON",

      success: function(data) {



        var datapro = [];

        var items = '';



        //data_subloker = JSON.parse(data);

        datapro = data;

        //alert(JSON.stringify(data_subloker));



        $.each(datapro, function(index, item) {

          items = item.nama;

        });

        if (items == 'Ada') {

          $('#btnkirim').attr('disabled', True);

        } else if (items == 'Tidak') {

          $('#btnkirim').attr('disabled', false);

        }

      }

    })

  }

</script>



<main id="main">

  <section id="promo-page">

    <div class=" container">

      <div class="section-header">

        <br />

        <br />

        <h3 style="color:#082032">Booking</h3>

        <h3 style="color:#082032"><?= $ticket['nama'] ?></h3>

      </div>





      <div class="baris">

        <?php echo $this->session->flashdata('message'); ?>

        <!-- .section-header -->

        <div>

          <form class="contact-form" method="POST" action="<?= site_url() ?>buy/order">

            <input type="hidden" id="id_lapangan" name="id_lapangan" class="form-control" value="<?= $ticket['id'] ?>" />

            <input type="hidden" name="nominal" class="form-control" value="<?= $ticket['harga'] ?>" />
            
            <div class="form-group">

              <label>Harga</label>

              <input type="text" name="nama" class="form-control" value="<?= $ticket['harga'] ?>" placeholder="Harga" readonly/>

            </div>

            <div class="form-group">

              <label>Nama Lengkap / Team</label>

              <input type="text" name="nama" class="form-control" value="<?= $this->session->userdata('nama_') ?>" placeholder="Nama Lengkap" />

            </div>

            <div class="form-group">

              <label>E-Mail Aktif</label>

              <input type="email" name="email" class="form-control" value="<?= $this->session->userdata('email_') ?>" placeholder="E-Mail Aktif" />

            </div>

            <div class="form-group">

              <label>No.HP Aktif</label>

              <input type="number" name="no_hp" class="form-control" value="<?= $this->session->userdata('no_hp_') ?>" placeholder="No.HP Aktif" />

            </div>

            <div class="form-group">

              <label>Tanggal Booking</label>

              <input type="date" id="tgl_booking" min="<?= date('Y-m-d') ?>" name="tgl_booking" class="form-control" placeholder="Tanggal Booking" />

            </div>

            <div class="form-group">

              <label>Jam Booking</label>

              <select class="form-control" id="jam_mulai" name="jam_mulai">

                <option value="" selected default disabled>::: PILIH :::</option>

                <option value="00:00:00">00:00</option>

                <option value="01:00:00">01:00</option>

                <option value="02:00:00">02:00</option>

                <option value="03:00:00">03:00</option>

                <option value="04:00:00">04:00</option>

                <option value="05:00:00">05:00</option>

                <option value="06:00:00">06:00</option>

                <option value="07:00:00">07:00</option>

                <option value="08:00:00">08:00</option>

                <option value="09:00:00">09:00</option>

                <option value="10:00:00">10:00</option>

                <option value="11:00:00">11:00</option>

                <option value="12:00:00">12:00</option>

                <option value="13:00:00">13:00</option>

                <option value="14:00:00">14:00</option>

                <option value="15:00:00">15:00</option>

                <option value="16:00:00">16:00</option>

                <option value="17:00:00">17:00</option>

                <option value="18:00:00">18:00</option>

                <option value="19:00:00">19:00</option>

                <option value="20:00:00">20:00</option>

                <option value="21:00:00">21:00</option>

                <option value="22:00:00">22:00</option>

                <option value="23:00:00">23:00</option>

              </select>

            </div>

            <div class="form-group">

              <label>Lama Booking</label>

              <select class="form-control" id="jam_selesai" name="jam_selesai" onchange="caritgl()">

                <option value="" selected default disabled>::: PILIH :::</option>

                <option value="1">1 Jam</option>

                <option value="2">2 Jam</option>

                <option value="3">3 Jam</option>

                <option value="4">4 Jam</option>

                <option value="5">5 Jam</option>

              </select>

            </div>

            <div class="form-group" id="tamptgl">

            </div>

            <div class="form-group">

              <button type="reset" class="btn btn-warning">Reset</button>

              <button type="submit" id="btnkirim" disabled class="btn btn-primary">Kirim</button>

            </div>

          </form>

        </div>



      </div>



    </div>

  </section>

</main>

<?php $this->load->view('footer'); ?>