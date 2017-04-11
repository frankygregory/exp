
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        User
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> User
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
			    <button class="btn btn-success" onclick="addUser()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
				
                <button class="btn btn-default" onclick="reloadTableUser()"><i class="glyphicon glyphicon-refresh"></i>
                    Reload
                </button>                
            </div>

            <div class="row" style="margin-top:10px">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="user_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row" style="margin-top:30px">
                <button class="btn btn-success" onclick="addGroup()"><i class="glyphicon glyphicon-plus"></i> Tambah Group</button>
				<button class="btn btn-default" onclick="reloadTableGroup()"><i class="glyphicon glyphicon-refresh"></i>
                    Reload
                </button>
            </div>

            <div class="row" style="margin-top:10px">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table id="groupTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Group</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
	
	<script type="text/javascript">
    var save_method; //for save method string
    var table1, table2;

    $(document).ready(function () {
        //datatables
        table1 = $('#user_table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('user/ajaxUserList')?>",
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
		
		    table2 = $('#groupTable').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('user/ajaxGroupList')?>",
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

	
	// group
	
    function addGroup() {
        save_method = 'add';
        $('#form_group')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form_group').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Data Group'); // Set Title to Bootstrap modal title
    }

	function editGroup(id) {
        save_method = 'update';
        $('#form_group')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('panel/user/ajaxGroupLoad')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="group_id"]').val(data.group_id);
                $('[name="group_name"]').val(data.group_name);
                $('#modal_form_group').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Data Group'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error dalam mengunduh data');
            }
        });
    }
	
	function saveGroup() {
        $('#btnGroupSave').text('Proses...'); //change button text
        $('#btnGroupSave').attr('disabled', true); //set button disable
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('user/ajaxGroupAdd')?>";
        } else {
            url = "<?php echo site_url('user/ajaxGroupUpdate')?>";
        }

		// ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_group').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form_group').modal('hide');
                    reloadTable();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('#btnGroupSave').text('Simpan'); //change button text
                $('#btnGroupSave').attr('disabled', false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Penyimpanan data gagal.');
                $('#btnGroupSave').text('Simpan'); //change button text
                $('#btnGroupSave').attr('disabled', false); //set button enable

            }
        });

    }
	
	function reloadTableGroup() {
        table2.ajax.reload(null, false); //reload datatable ajax
    }

 // user

    function addUser() {
        save_method = 'add';
        $('#form_user')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form_user').modal('show'); // show bootstrap modal
        $('.modal-title').text('Undang User Baru'); // Set Title to Bootstrap modal title
    }

	function editUser(id) {
        save_method = 'update';
        $('#form_user_')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('panel/user/ajaxUserLoad/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="user_sub_id"]').val(data.user_sub_id);
                $('[name="user_sub_email"]').val(data.user_sub_email);
                $('[name="username"]').val(data.username);
                $('[name="password"]').val(data.password);
                $('[name="user_sub_fullname"]').val(data.user_sub_fullname);
                $('[name="user_group"]').val(data.user_group);
                $('#modal_form_user_').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Data Group'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error dalam mengunduh data');
            }
        });
    }

    function saveUser() {
        $('#btnUserSave').text('Proses...'); //change button text
        $('#btnUserSave').attr('disabled', true); //set button disable
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('user/ajaxUserAdd')?>";
        } else {
            url = "<?php echo site_url('user/ajaxUserUpdate')?>";
        }

		// ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_user').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form_user').modal('hide');
                    reloadTable();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('#btnUserSave').text('Undang'); //change button text
                $('#btnUserSave').attr('disabled', false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Penyimpanan data gagal.');
                $('#btnUserSave').text('Undang'); //change button text
                $('#btnUserSave').attr('disabled', false); //set button enable

            }
        });

    }


    function toggleActive(id, newStatus) {
        var url = "<?php echo site_url('panel/user/ajaxToggleActive/"+id+"/"+newStatus+"')?>";
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
	
	function reloadTableUser() {
        table1.ajax.reload(null, false); //reload datatable ajax
    }
</script>
	
<!-- Bootstrap modal Group-->
<div class="modal fade" id="modal_form_group" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form User Group</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_group" class="form-horizontal">
                    <input type="hidden" value="" name="group_id"/>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Group</label>

                            <div class="col-md-9">
                                <input id="group_name" name="group_name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnGroupSave" onclick="saveGroup()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal Group-->

<!-- Bootstrap modal User-->
<div class="modal fade" id="modal_form_user" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form User</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_user" class="form-horizontal">
                    <input type="hidden" value="" name="user_id"/>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>

                            <div class="col-md-9">
                                <input id="user_sub_email" name="user_sub_email" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Group</label>

                            <div class="col-md-9">
                                <select name="user_group">
								  <option selected></option>
								  <option value="1">Magetan</option>
								  <option value="2">Malang</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUserSave" onclick="saveUser()" class="btn btn-primary">Undang</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal User-->

<!-- Bootstrap modal User Full-->
<div class="modal fade" id="modal_form_user_" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form User</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_user_" class="form-horizontal">
                    <input type="hidden" value="" name="user_id"/>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Username</label>

                            <div class="col-md-9">
                                <input id="username" name="username" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Password</label>

                            <div class="col-md-9">
                                <input id="password" name="password" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
						<div class="form-group">
                            <label class="control-label col-md-3">Email</label>

                            <div class="col-md-9">
                                <input id="user_sub_email" name="user_sub_email" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Group</label>

                            <div class="col-md-9">
                                <select name="group" id="group">
									<option selected></option>
									<option value="1">Malang</option>
									<option value="2">Magetan</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUserSave" onclick="saveUser()" class="btn btn-primary">Ubah</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal User-->


