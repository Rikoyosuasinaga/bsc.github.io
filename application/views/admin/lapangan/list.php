<div class="col-sm-12">
    <!-- Default Date-Picker card start -->
    <div class="card">
        <div class="card-header">
            <h5>Lapangan</h5>
        </div>
        <div class="card-block">
            <button type="button" class="btn btn-primary btn-round waves-effect waves-light" data-toggle="modal" onclick="add()"><i class="icofont icofont-plus-circle"></i> Tambah</button>
            <div class="dt-responsive table-responsive">
                <table  class="table table-hover dataTable nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th width='25%'>Nama Lapangan</th>
                            <th width='25%'>Harga</th>
                            <th width='25%'>Banner</th>
                            <th width='30%'></th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
            responsive: true,
            buttons: [
                'excel', 'copy', 'pdf'
            ],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/lapangan/listdata') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [-2], //2 last column (photo)
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



    function add()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#tambah').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Lapangan'); // Set Title to Bootstrap modal title
        $('#btnSave').text('Simpan');
        $('#photo-preview').hide(); // hide photo preview modal
        $('#label-photo').text('Upload Logo'); // label photo upload
        $(function() {
            CKEDITOR.replace('ckeditor'); 
        });
    }

    function tutup(){
        $('#tambah').modal('hide');
        for(ckeditor in CKEDITOR.instances)
        {
            CKEDITOR.instances[ckeditor].destroy(true);
        } 
    }

    function editdata(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/lapangan/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="batas"]').val(data.batas);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="harga"]').val(data.harga);
                $('[name="booklet"]').val(data.booklet);
                $('[name="promo"]').val(data.promo);
                $('#tambah').modal('show'); // show bootstrap modal
                $('.modal-title').text('Edit Lapangan'); // Set Title to Bootstrap modal title
                $('#btnSave').text('Update');
                $('#photo-preview').show(); // hide photo preview modal
                if (data.banner)
                {
                    $('#label-photo').text('Change Banner'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'banner/' + data.banner + '" class="img-fluid">'); // show photo
                } else
                {
                    $('#label-photo').text('Upload Banner'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/no-image.png" class="img-fluid">');
                }
                $(function() {
                    CKEDITOR.replace('ckeditor'); 
                });

                


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    

    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function save()
    {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/lapangan/save') ?>";
        } else {
            url = "<?php echo site_url('admin/lapangan/update') ?>";
        }

        // ajax adding data to database
        CKEDITOR.instances['ckeditor'].updateElement();
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
                    $('#tambah').modal('hide');
                    reload_table();
                    for(ckeditor in CKEDITOR.instances)
                    {
                        CKEDITOR.instances[ckeditor].destroy(true);
                    }
                } else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
    
    
    

    function deletedata(id)
    {
        
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/lapangan/hapus') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        
    }
    
    
         
         
    


</script>

<div class="modal fade" id="tambah" aria-labelledby="" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <script type="text/javascript" src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
            <div class="modal-body">
                <form class="form-material" id="form" enctype="multipart/form-data" method="POST" action="">
                    <input type="hidden" name="id" value="">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-plane-ticket"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="nama" class="form-control" type="text" value="" placeholder="Nama Ticket / Promo">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Nama Lapangan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-listine-dots"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <textarea class="form-control" id="ckeditor" name="deskripsi" ></textarea>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Deskirpsi Lapangan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-plane-ticket"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="harga" class="form-control" type="number" value="" placeholder="Harga Ticket / Promo">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Harga Sewa</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="form-group row" id="photo-preview">
                        <div class="col-sm-12">
                            [No Logo]
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <a><i class="icofont icofont-ui-image" onclick="document.getElementById('fileup').click()"></i></a>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input class="form-control" id="fileup" style="display: none" name="banner" type="file" onchange="document.getElementById('namafile').value=this.value">
                                    <input class="form-control" id="namafile" type="text" onclick="document.getElementById('fileup').click()" placeholder="Insert File Banner">
                                    <span class="form-bar"></span>
                                    <label class="float-label" id="label-photo">Upload Banner </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="tutup()" class="btn btn-secondary">Tutup</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="save()">Simpan</button>
            </div>
        </div>
    </div>
</div>