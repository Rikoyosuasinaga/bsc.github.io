<?php 
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
if ($this->session->userdata('id_pengunjung') == '') {
    redirect('konfirmasi');
}

?>
<?php $this->load->view('header'); ?>
<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->
<main id="main">
    <section id="promo-page">
        <div class=" container">
            <div class="section-header">
                <br/>
                <br/>
                <h3 style="color:#9200be">Upload Butki Pembayaran</h3>
            </div>
            
            <div class="baris">
            <?php echo $this->session->flashdata('message'); ?>
                            <!-- .section-header -->
                <div>
                    <form enctype="multipart/form-data" class="contact-form" method="POST" action="<?= site_url() ?>konfirmasi/proses">
                        <?php $rekening = $this->crud->read('ms_rekening'); ?>
                                    
                        <div class="form-group">
                            <label>Pembayaran ke-</label>
                            <select name="pembayaran_ke" class="form-control">
                                <option value="" selected disabled default>- Pilih -</option>
                                <?php foreach ($rekening as $r) { ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['bank'] ?> <?= $r['no'] ?> a.n <?= $r['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemilik Rekening / Nama Akun (OVO, Gopay, Dll)</label>
                            <input type="text" name="nama_norek" class="form-control" placeholder="Nama Pemilik Rekening / Nama Akun (OVO, Gopay, Dll)"/>
                        </div>
                        <div class="form-group">
                            <label>Pembayaran Via (Bank BRI, Bank BNI, OVO, Gopay, Dll)</label>
                            <input type="text" name="bank" class="form-control" placeholder="Pembayaran Via (Bank BRI, Bank BNI, OVO, Gopay, Dll)"/>
                        </div>
                        <div class="form-group">
                            <label>No Rekening / Nomor Akun OVO, Gopay, Dll</label>
                            <input type="number" name="norek" class="form-control" placeholder="No Rekening / Nomor Akun OVO, Gopay, Dll"/>
                        </div>
                        <?php 
                            $pengunjung = $this->crud->read('ms_pengunjung',['id_pengunjung' => $this->session->userdata('id_pengunjung')])[0]; 
                            $ticket = $this->crud->read('ms_ticket',['id' => $pengunjung['id_ticket']])[0];
                        ?>
                        <div class="form-group">
                            <label>Nominal</label>
                            <input disabled type="number" name="nominal" class="form-control" value ="<?= $pengunjung['jumlah']*$ticket['harga'] ?>" placeholder="Nominal"/>
                        </div>
                        <div class="form-group">
                            <label>Bukti Pembayaran</label>
                            <input type="file" name="resi" class="form-control"/>
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