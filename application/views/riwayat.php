<?php $this->load->view('header'); ?>

<!-- margin-top:-70px; margin-bottom:-222px; z-index:9999 -->

<main id="main">

  <section id="promo-page">

    <div class=" container">

      <div class="section-header">
        <br />
        <br />
        <h3 style="color:#082032">Riwayat</h3>
      </div>





      <div class="baris">
        <div class="dt-responsive table-responsive">

          <table class="table table-hover dataTable">

            <thead>

              <tr>

                <th>Lapangan</th>

                <th>Waktu Booking</th>

                <th>Status</th>

                <th></th>

              </tr>

            </thead>
            <tbody>
            </tbody>
          </table>
        </div>





      </div>

    </section>

  </main>

  <script type="text/javascript">





    var save_method; //for save method string

    var table;

    var base_url = '<?php echo base_url(); ?>';



    $(document).ready(function() {



      //datatables

      table = $('.dataTable').DataTable({

        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +

        "<'row'<'col-sm-12'tr>>" +

        "<'row'<'col-sm-6'Bi><'col-sm-6'p>>",

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        "pagingType": "full_numbers",

        responsive: false,

        buttons: [

          'excel', 'copy', 'pdf'

        ],

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.



        // Load data for the table's content from an Ajax source

        "ajax": {

          "url": "<?php echo site_url('riwayat/listdata') ?>",

          "type": "POST"

        },

        //Set column definition initialisation properties.

        "columnDefs": [{

          "targets": [-1, -2], //last column

          "orderable": false, //set not orderable

        },

        ],

        language: {

          "sProcessing": "Sedang memproses...",

          "sLengthMenu": "Tampilkan _MENU_ baris",

          "sZeroRecords": "Tidak ditemukan data yang sesuai",

          "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

          "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 Data",

          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",

          "sInfoPostFix": "",

          "sSearch": "Cari:",

          "sUrl": "",

          "oPaginate": {

            "sFirst": "&laquo;",

            "sPrevious": "&lsaquo;",

            "sNext": "&rsaquo;",

            "sLast": "&raquo;"

          }

        }

      });







      //datepicker

      $('.datepicker').datepicker({

        autoclose: true,

        format: "yyyy-mm-dd",

        todayHighlight: true,

        orientation: "top auto",

        todayBtn: true,

        todayHighlight: true,

      });



      //set input/textarea/select event when change value, remove class error and remove text help block

      $("input").change(function() {

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();

      });

      $("textarea").change(function() {

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();

      });

      $("select").change(function() {

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();

      });



    });







    function add() {

      save_method = 'add';

      $('#form')[0].reset(); // reset form on modals

      $('.form-group').removeClass('has-error'); // clear error class

      $('.help-block').empty(); // clear error string

      $('#tambah').modal('show'); // show bootstrap modal

      $('.modal-title').text('Tambah Kompetisi Pertandingan'); // Set Title to Bootstrap modal title

      $('#btnSave').text('Simpan');

      $('#photo-preview').hide(); // hide photo preview modal

      $('#label-photo').text('Upload Logo'); // label photo upload

    }



    function edit(id) {

      save_method = 'update';

      $('#form')[0].reset(); // reset form on modals

      $('.form-group').removeClass('has-error'); // clear error class

      $('.help-block').empty(); // clear error string



      //Ajax Load data from ajax

      $.ajax({

        url: "<?php echo site_url('riwayat/edit/') ?>/" + id,

        type: "GET",

        dataType: "JSON",

        success: function(data) {



          $('[name="id_booking"]').val(data.id_booking);
          $('[name="nominal"]').val(data.nominal);
          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded

          $('.modal-title').text('Kirim Bukti Pembayaran'); // Set title to Bootstrap modal title



        },

        error: function (jqXHR, textStatus, errorThrown) {

          alert('Error get data from ajax');

        }

      });

    }





    function reload_table() {

      table.ajax.reload(null, false); //reload datatable ajax

    }



    function save() {

      $('#btnSave').text('Menyimpan...'); //change button text

      $('#btnSave').attr('disabled', true); //set button disable

      var url;

        url = "<?php echo site_url('riwayat/kirimresi') ?>";

      



      // ajax adding data to database



      var formData = new FormData($('#form')[0]);

      $.ajax({

        url: url,

        type: "POST",

        data: formData,

        contentType: false,

        processData: false,

        dataType: "JSON",

        success: function(data) {



          if (data.status) //if success close modal and reload ajax table

          {

            $('#modal_form').modal('hide');

            reload_table();

          } else

          {

            for (var i = 0; i < data.inputerror.length; i++) {

              $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class

              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string

            }

          }

          $('#btnSave').text('Simpan'); //change button text

          $('#btnSave').attr('disabled', false); //set button enable





        },

        error: function(jqXHR, textStatus, errorThrown) {

          alert('Error adding / update data');

          $('#btnSave').text('Simpan'); //change button text

          $('#btnSave').attr('disabled', false); //set button enable



        }

      });

    }

  </script>



  <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title"></h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <form id="form" class="form-horizontal" enctype="multipart/form-data" action="" method="POST">

            <input type="hidden" class="form-control" name="id_booking">
            <div class="form-group">
              <label>Jumlah Pembayaran</label>
              <input type="text" name="nominal" class="form-control" placeholder="Jumlah Pembayaran" readonly />
            </div>
            <div class="form-group">
              <label>Pembayaran Ke</label>
              <select class="form-control" name="pembayaran_ke">
                <option value="" selected default disabled>::: PILIH :::</option>
                <?php $bank = $this->crud->read('ms_rekening'); ?>
                <?php foreach ($bank as $b) {
                  ?>
                  <option value="<?= $b['id'] ?>"><?= $b['bank'].' '.$b['no'].' an '.$b['nama'] ?></option>
                  <?php
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Bank Pengirim</label>
              <select class="form-control" name="bank">
                <option value="" selected default disabled>::: PILIH :::</option>
                <option value="Gopay">Gopay</option>
                <option value="Ovo">Ovo</option>
                <option value="Bank BRI">Bank BRI</option>
                <option value="Bank BNI">Bank BNI</option>
                <option value="Bank Mandiri">Bank Mandiri</option>
                <option value="Bank BCA">Bank BCA</option>
              </select>
            </div>
            <div class="form-group">
              <label>No. Rekening / Akun</label>
              <input class="form-control" type="number" name="norek" placeholder="No. Rekening / Akun" />
            </div>
            <div class="form-group">
              <label>Nama Pemegang Rekening / Akun</label>
              <input class="form-control" type="text" name="nama_norek"  placeholder="Nama Pemegang Rekening / Akun"/>
            </div>
            <div class="form-group">
              <label>Bukti Kirim / Resi</label>
              <input class="form-control" type="file" name="resi" />
            </div>
          </form>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>

          <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="save()">Kirim</button>

        </div>

      </div>

    </div>

  </div>

  <?php $this->load->view('footer'); ?>