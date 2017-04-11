<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Kendaraan
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Kendaraan
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-3">
                <input type="button" value="Tambah" class="btn btn-primary">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table2" name="table" class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Kendaraan</th>
                            <th>Nama Kendaraan</th>
                            <th>Tersedia</th>
                            <th>Reff.Shipment</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0; $n = sizeof($data);
                        while ($i<$n) {
                            echo
                                "<tr>".
                                    "<td>".$data[$i]['vehicle_id']."</td>".
                                    "<td>".$data[$i]['vehicle_nomor']."</td>".
                                    "<td>".$data[$i]['vehicle_name']."</td>".
                                    "<td>".$data[$i]['available_status']."</td>".
                                    "<td>".$data[$i]['ref_transaksi']."</td>".
                                    "<td>".$data[$i]['vehicle_information']."</td>";

                            if ($data[$i]['available_status']=='Ya') {
                                if ($data[$i]['vehicle_status']==1) {
                                    //echo "<td><a href='".base_url()."panel/kendaraan/toggleActive/".$data[$i]['vehicle_id']."/0/' class='btn btn-success'>Aktif</a></td>";
                                    echo "<td id='status".$data[$i]['vehicle_id']."'><a href='javascript:void(0)' onclick='toggleActive(".$data[$i]['vehicle_id'].",0);' class='btn btn-success'>Aktif</a></td>";
                                }
                                else {
                                    //echo "<td><a href='".base_url()."panel/kendaraan/toggleActive/".$data[$i]['vehicle_id']."/1/' class='btn btn-danger'>Tidak Aktif</a></td>";
                                    echo "<td id='status".$data[$i]['vehicle_id']."'><a href='javascript:void(0)' onclick='toggleActive(".$data[$i]['vehicle_id'].",1);' class='btn btn-danger'>Tidak Aktif</a></td>";
                                }
                            }
                            else {
                                if ($data[$i]['vehicle_status']==1) {
                                    echo "<td id='status".$data[$i]['vehicle_id']."'><a href='".base_url()."panel/kendaraan/toggleActive/".$data[$i]['vehicle_id']."/0/' class='btn btn-success disabled'>Aktif</a></td>";
                                }
                                else {
                                    echo "<td id='status".$data[$i]['vehicle_id']."'><a href='".base_url()."panel/kendaraan/toggleActive/".$data[$i]['vehicle_id']."/1/' class='btn btn-danger disabled'>Tidak Aktif</a></td>";
                                }
                            }
/*                            <td>W123 ER</td>
                            <td>Toyota 123</td>
                            <td>21234</td>
                            <td>10</td>
                            <td>Baik</td>
                            <td><a href="#" class="btn btn-success">Aktif</a> <a href="#" class="btn btn-danger">Tidak Aktif</a> </td>*/
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Add</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <br />
                    <br />
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Kendaraan</th>
                                <th>Nama Kendaraan</th>
                                <th>Tersedia</th>
                                <th>Reff.Shipment</th>
                                <th>Keterangan</th>
                                <th style="width:125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Kendaraan</th>
                            <th>Nama Kendaraan</th>
                            <th>Tersedia</th>
                            <th>Reff.Shipment</th>
                            <th>Keterangan</th>
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
<?php
//var_dump($data);
//echo current_url();
?>
</div>
<!-- /#page-wrapper -->

<script src="<?=base_url('assets/panel/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?=base_url('assets/panel/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/panel/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/panel/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?=base_url('assets/panel/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {
    //datatables
    table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kendaraan/ajaxList')?>",
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
    alert($('#table').html());

    //datepicker
/*    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });*/
});

function add_data()
{
    alert('insert');
/*    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title*/
}

function edit_person(id)
{
/*    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });*/
}

function reload_table()
{
    alert('reload');
    table.ajax.reload(null,false); //reload datatable ajax 
    alert('aaa');
}

function save()
{
/*    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('person/ajax_add')?>";
    } else {
        url = "<?php echo site_url('person/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });*/
}

function delete_person(id)
{
/*    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }*/
}

function toggleActive(id,newStatus)
{
    var url = "<?php echo site_url('panel/kendaraan/ajaxToggleActive/"+id+"/"+newStatus+"')?>";
 
     // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if (newStatus==1) {
                $('#status'+id).html("<a href='javascript:void(0)' onclick='toggleActive("+id+",0);' class='btn btn-success'>Aktif</a>");
            }
            else {
                $('#status'+id).html("<a href='javascript:void(0)' onclick='toggleActive("+id+",1);' class='btn btn-danger'>Tidak Aktif</a>");
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input name="firstName" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gender</label>
                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date of Birth</label>
                            <div class="col-md-9">
                                <input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->