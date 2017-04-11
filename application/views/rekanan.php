
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Rekanan
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Rekanan
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <!--th>No</th-->
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Rekanan</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
						<tfoot>
						<tr>
	                        <!--th>No</th-->
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Rekanan</th>
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
                "url": "<?php echo site_url('rekanan/ajaxList')?>",
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

    

    function reloadTable() {
        table.ajax.reload(null, false); //reload datatable ajax
    }
    
    function toggleActive(id, newStatus) {
        var url = "<?php echo site_url('panel/rekanan/ajaxToggleActive/"+id+"/"+newStatus+"')?>";
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
				reloadTable();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>
