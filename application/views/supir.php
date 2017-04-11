
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Supir
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Supir
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-3">
                <button class="btn btn-success" onclick="addData()"><i class="glyphicon glyphicon-plus"></i> Tambah
                </button>
                <button class="btn btn-default" onclick="reloadTable()"><i class="glyphicon glyphicon-refresh"></i>
                    Reload
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supir</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
						<tfoot>
						<tr>
                            <th>No</th>
                            <th>Nama Supir</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
						</tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        //datatables
        table = $('#table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('supir/ajaxList')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });

        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
    });

    function addData() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Data Supir'); // Set Title to Bootstrap modal title
    }

    function editData(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('panel/supir/ajaxLoad/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="driver_id"]').val(data.driver_id);
                $('[name="driver_name"]').val(data.driver_name);
                $('[name="driver_handphone"]').val(data.driver_handphone);
                $('[name="driver_address"]').val(data.driver_address);
                $('[name="driver_information"]').val(data.driver_information);
                $('[name="driver_status"]').val(data.driver_status);
                $('[name="user_id"]').val(data.user_id);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Data Supir'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error dalam mengunduh data');
            }
        });
    }

    function reloadTable() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function save() {
        $('#btnSave').text('Proses...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('supir/ajaxAdd')?>";
        } else {
            url = "<?php echo site_url('supir/ajaxUpdate')?>";
        }

		// ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reloadTable();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Penyimpanan data gagal.');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });

    }
	
	function deleteData(id) {
        if (confirm('Apakah Anda yakin hendak menghapus data ini?')) {
// ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('panel/supir/ajaxDelete')?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reloadTable();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    function toggleActive(id, newStatus) {
        var url = "<?php echo site_url('panel/supir/ajaxToggleActive/"+id+"/"+newStatus+"')?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (newStatus == 1) {
                    $('#status' + id).html("<a href='javascript:void(0)' onclick='toggleActive(" + id + ",0);' class='btn btn-success'>Aktif</a>");
                }
                else {
                    $('#status' + id).html("<a href='javascript:void(0)' onclick='toggleActive(" + id + ",1);' class='btn btn-danger'>Tidak Aktif</a>");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Supir</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="driver_id"/>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>

                            <div class="col-md-9">
                                <input id="driver_name" name="driver_name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Handphone</label>

                            <div class="col-md-9">
                                <input id="driver_handphone" name="driver_handphone" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>

                            <div class="col-md-9">
                                <textarea id="driver_address" name="driver_address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>

                            <div class="col-md-9">
                                <textarea id="driver_information" name="driver_information" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>

                            <div class="col-md-9">
                                <select id="driver_status" name="driver_status" class="form-control">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->