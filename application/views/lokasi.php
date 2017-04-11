
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Lokasi
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Lokasi
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row" style="margin-bottom:10px">
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
                                <th>Nama Lokasi</th>
                                <th>Alamat</th>
                                <th>Detail Lokasi</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
							<tfoot>
						<tr>
								<th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Alamat</th>
                                <th>Detail Lokasi</th>
                                <th>Contact</th>
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
                "url": "<?php echo site_url('lokasi/ajaxList')?>",
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
        $('.modal-title').text('Tambah Data Lokasi'); // Set Title to Bootstrap modal title
    }

    function editData(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('panel/lokasi/ajaxLoad/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="location_id"]').val(data.location_id);
                $('[name="location_name"]').val(data.location_name);
                $('[name="location_address"]').val(data.location_address);
                $('[name="location_x"]').val(data.location_lat);
                $('[name="location_y"]').val(data.location_lng);
                $('[name="location_detail"]').val(data.location_detail);
                $('[name="location_contact"]').val(data.location_contact);
                $('[name="location_from"]').val(data.location_from);
                $('[name="location_to"]').val(data.location_to);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Data Lokasi'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('lokasi/ajaxAdd')?>";
        } else {
            url = "<?php echo site_url('lokasi/ajaxUpdate')?>";
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
                url: "<?php echo site_url('panel/lokasi/ajaxDelete')?>/" + id,
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

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Lokasi</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="location_id"/>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>

                            <div class="col-md-9">
                                <input id="location_name" name="location_name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>

                            <div class="col-md-9">
                                <textarea id="location_address" name="location_address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
							<div class="col-md-9">
								<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap" async defer></script>
								<script type="text/javascript">
							        window.onload = function () {
							            var mapOptions = {
							                center: new google.maps.LatLng(-7.381704255354987, 112.57390022277832),
							                zoom: 14,
							                mapTypeId: google.maps.MapTypeId.ROADMAP
							            };
										
										var myLatLng = {lat: -7.381704255354987, lng: 112.57390022277832};
										
										var marker = new google.maps.Marker({
										    position: myLatLng,
										    map: map,
										    title: 'Hello World!'
										});

							            var infoWindow = new google.maps.InfoWindow();
							            var latlngbounds = new google.maps.LatLngBounds();
							            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
							            google.maps.event.addListener(map, 'click', function (e) {
											document.getElementById("location_x").value = e.latLng.lat() ;
											document.getElementById("location_y").value = e.latLng.lng() ;
							            });
							        }
							    </script>
							    <div id="dvMap" style="width: 570px; height: 300px"></div>
							</div>
						</div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Latitude (x)</label>

                            <div class="col-md-9">
                                <input type="text" id="location_x" name="location_x" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Longitude (y)</label>

                            <div class="col-md-9">
                                <input type="text" id="location_y" name="location_y" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Detail</label>

                            <div class="col-md-9">
                                <textarea id="location_detail" name="location_detail" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Contact</label>

                            <div class="col-md-9">
                                <textarea id="location_contact" name="location_contact" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">From</label>

                            <div class="col-md-9">
                                <textarea id="location_from" name="location_from" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">To</label>

                            <div class="col-md-9">
                                <textarea id="location_to" name="location_to" class="form-control"></textarea>
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
