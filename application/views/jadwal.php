<?php $this->load->view('header'); ?>

<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->

<main id="main">

  <section id="promo-page">

    <div class=" container">

      <div class="section-header">
        <br />
        <br />
        <h3 style="color:#082032">Jadwal</h3>
      </div>





      <div class="baris">
        <div class="dt-responsive table-responsive">

          <table class="table table-hover dataTable">

            <thead>

              <tr>

                <th>Tanggal</th>
                <?php $lapangan = $this->crud->read('ms_lapangan'); ?>
                <?php foreach($lapangan as $l){ ?>
                    <th><?= $l['nama'] ?></th>
                <?php } ?>

              </tr>

            </thead>
            <tbody>
                <?php 
                for($i=0; $i<=30; $i++){ ?>
                    <tr>
                        <td><?= tanggal(substr(date("Y-m-d H:i:s", strtotime(date("Y-m-d 00:00:00"))+(60*60*24*$i)),0,10)) ?></td>
                        <?php $lapangan = $this->crud->read('ms_lapangan'); ?>
                        <?php foreach($lapangan as $l){ ?>
                            <td>
                                <?php $transaksi = $this->crud->read('tr_booking',['id_lapangan'=>$l['id'],'tgl_booking'=>substr(date("Y-m-d H:i:s", strtotime(date("Y-m-d 00:00:00"))+(60*60*24*$i)),0,10),'status'=>'Sukses']); ?>
                                <?php foreach($transaksi as $t){ ?>
                                    <?= $t['nama'] ?> | <?= substr($t['jam_mulai'],0,5) ?>-<?= substr($t['jam_selesai'],0,5) ?><br/>
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>





      </div>

    </section>

  </main>




  <?php $this->load->view('footer'); ?>