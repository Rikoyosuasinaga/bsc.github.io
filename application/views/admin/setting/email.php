<div class="col-sm-12">
    <!-- Default Date-Picker card start -->
    <div class="card">
        <div class="card-header">
            <h5>Setting Template Email</h5>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="show-hide-res" class="table table-hover dataTable nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Banner</th>
                            <th>Nama System</th>
                            <th>Email</th>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Twitter</th>
                            <th>Footer</th>
                            <th></th>
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
                "url": "<?php echo site_url('admin/setting_template_email/listdata') ?>",
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




    function editdata(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/setting_template_email/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id_config"]').val(data.id_config);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="facebook"]').val(data.facebook);
                $('[name="instagram"]').val(data.instagram);
                $('[name="twitter"]').val(data.twitter);
                $('[name="footer"]').val(data.footer);
                $('#tambah').modal('show'); // show bootstrap modal
                $('.modal-title').text('Edit Setting Template Email'); // Set Title to Bootstrap modal title
                $('#btnSave').text('Update');
                $('#photo-preview').show(); // hide photo preview modal
                if (data.logo)
                {
                    $('#label-photo').text('Change Logo'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'logo/' + data.logo + '" class="img-fluid">'); // show photo
                } else
                {
                    $('#label-photo').text('Upload Logo'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/no-image.png" class="img-fluid">');
                }
                if (data.banner)
                {
                    $('#label-photo_').text('Change Banner'); // label photo upload
                    $('#photo-preview_ div').html('<img src="' + base_url + 'logo/' + data.banner + '" class="img-fluid">'); // show photo
                } else
                {
                    $('#label-photo_').text('Upload Banner'); // label photo upload
                    $('#photo-preview_ div').html('<img src="' + base_url + 'assets/no-image.png" class="img-fluid">');
                }

                


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
            url = "<?php echo site_url('admin/setting_template_email/save') ?>";
        } else {
            url = "<?php echo site_url('admin/setting_template_email/update') ?>";
        }

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
                    $('#tambah').modal('hide');
                    reload_table();
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
                url: "<?php echo site_url('admin/sponsor/hapus') ?>/" + id,
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

<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-material" id="form" enctype="multipart/form-data" method="POST" action="">
                    <input type="hidden" name="id_config" value="">

                    

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-presentation-alt"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="nama" class="form-control" type="text" value="" placeholder="Nama Aplikasi">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Nama Aplikasi</label>
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
                                    <input class="form-control" id="fileup" style="display: none" name="logo" type="file" onchange="document.getElementById('namafile').value=this.value">
                                    <input class="form-control" id="namafile" type="text" onclick="document.getElementById('fileup').click()" placeholder="Insert File Logo">
                                    <span class="form-bar"></span>
                                    <label class="float-label" id="label-photo">Upload Logo </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="photo-preview_">
                        <div class="col-sm-12">
                            [No Banner]
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <a><i class="icofont icofont-ui-image" onclick="document.getElementById('fileup_').click()"></i></a>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input class="form-control" id="fileup_" style="display: none" name="banner" type="file" onchange="document.getElementById('namafile_').value=this.value">
                                    <input class="form-control" id="namafile_" type="text" onclick="document.getElementById('fileup_').click()" placeholder="Insert File Logo">
                                    <span class="form-bar"></span>
                                    <label class="float-label" id="label-photo_">Upload Logo </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-email"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="email" class="form-control" type="email" value="" placeholder="Email">
                                    <span class="form-bar"></span>
                                    <label class="float-label">email</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-social-facebook"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="facebook" class="form-control" type="text" value="" placeholder="Nama Facebook">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Facebook</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-social-instagram"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="instagram" class="form-control" type="text" value="" placeholder="Nama Instagram">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Instagram</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-social-twitter"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="twitter" class="form-control" type="text" value="" placeholder="Nama Twitter">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Twitter</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="material-group material-group-danger">
                                <div class="material-addone">
                                    <i class="icofont icofont-foot-print"></i>
                                </div>
                                <div class="form-group form-danger form-static-label">
                                    <input name="footer" class="form-control" type="text" value="" placeholder="Nama Aplikasi">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Footer</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSave" onclick="save()">Simpan</button>
            </div>
        </div>
    </div>
</div>