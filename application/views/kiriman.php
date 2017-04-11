    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?=$this->typography->auto_typography($title); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> <?=$title;?>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending</a>
                        </li>
                        <li role="presentation">
                            <a href="#pesanan" aria-controls="pesanan" role="tab" data-toggle="tab">Pesanan</a>
                        </li>
                        <li role="presentation">
                            <a href="#dikirim" aria-controls="dikirim" role="tab" data-toggle="tab">Dikirim</a>
                        </li>
                        <li role="presentation">
                            <a href="#diambil" aria-controls="diambil" role="tab" data-toggle="tab">Diambil</a>
                        </li>
                        <li role="presentation">
                            <a href="#diterima" aria-controls="diterima" role="tab" data-toggle="tab">DIterima</a>
                        </li>
                        <li role="presentation">
                            <a href="#selesai" aria-controls="selesai" role="tab" data-toggle="tab">Selesai</a>
                        </li>
                    </ul>
                    <br>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pending">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama Kirim</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Supir</th>
                                        <th>Kendaraan</th>
                                        <th>Lacak</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($pending_data as $data) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?= $data['shipment_title'] ?></td>
                                            <td><?= $data['shipment_price'] ?></td>
                                            <td><?= $data['location_from_address'] ?></td>
                                            <td><?= $data['location_to_address'] ?></td>
                                            <td>
                                            <script>
                                                var lat1 = "<?=$data['location_from_lat'] ?>";
                                                if (lat1.length==0) {lat1="0";}
                                                var lng1 = "<?=$data['location_from_lng'] ?>";
                                                if (lng1.length==0) {lng1="0";}
                                                var lat2 = "<?=$data['location_to_lat'] ?>";
                                                if (lat2.length==0) {lat2="0";}
                                                var lng2 = "<?=$data['location_to_lng'] ?>";
                                                if (lng2.length==0) {lng2="0";}
                                                var dist = getDistanceFromLatLonInKm(lat1*1,lng1*1,lat2*1,lng2*1).toFixed(2);
                                                document.write(dist);
                                            </script>
                                            </td>
                                            <td>
                                            <select class="selectpicker" id="driver_<?=$data['shipment_id'];?>">
                                                <option selected></option>
                                                <?php
                                                foreach ($driver_data as $driver) {
                                                    echo "<option value='".$driver['driver_id']."'>".$driver['driver_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            </td>
                                            <td>
                                            <select class="selectpicker" id="vehicle_<?=$data['shipment_id'];?>">
                                                <option selected></option>
                                                <?php
                                                foreach ($vehicle_data as $vehicle) {
                                                    echo "<option value='".$vehicle['vehicle_id']."'>".$vehicle['vehicle_name']." (".$vehicle['vehicle_nomor'].")</option>";
                                                }
                                                ?>
                                            </select>
                                            </td>
                                            <td>
                                            <select class="selectpicker" id="device_<?=$data['shipment_id'];?>">
                                                <option selected></option>
                                                <?php
                                                foreach ($device_data as $device) {
                                                    echo "<option value='".$device['device_id']."'>".$device['device_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            </td>
                                            <td><input type="button" class="btn btn-success" value="Pesan" onclick="doAction(<?=$data['shipment_id']?>,'PESAN');"></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="pesanan">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama Kirim</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Supir</th>
                                        <th>Kendaraan</th>
                                        <th>Lacak</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($pesanan_data as $data) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?= $data['shipment_title'] ?></td>
                                            <td><?= $data['shipment_price'] ?></td>
                                            <td><?= $data['location_from_address'] ?></td>
                                            <td><?= $data['location_to_address'] ?></td>
                                            <td>
                                            <script>
                                                var lat1 = "<?=$data['location_from_lat'] ?>";
                                                if (lat1.length==0) {lat1="0";}
                                                var lng1 = "<?=$data['location_from_lng'] ?>";
                                                if (lng1.length==0) {lng1="0";}
                                                var lat2 = "<?=$data['location_to_lat'] ?>";
                                                if (lat2.length==0) {lat2="0";}
                                                var lng2 = "<?=$data['location_to_lng'] ?>";
                                                if (lng2.length==0) {lng2="0";}
                                                var dist = getDistanceFromLatLonInKm(lat1*1,lng1*1,lat2*1,lng2*1).toFixed(2);
                                                document.write(dist);
                                            </script>
                                            </td>
                                            <td><?=$data['driver_name'];?></td>
                                            <td><?=$data['vehicle_name'];?></td>
                                            <td><?=$data['device_name'];?></td>
                                            <td><input type="button" class="btn btn-success" value="Dikirim" onclick="doAction(<?=$data['shipment_id']?>,'KIRIM');"> </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="dikirim">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama Kirim</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Supir</th>
                                        <th>Kendaraan</th>
                                        <th>Lacak</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($dikirim_data as $data) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?= $data['shipment_title'] ?></td>
                                            <td><?= $data['shipment_price'] ?></td>
                                            <td><?= $data['location_from_address'] ?></td>
                                            <td><?= $data['location_to_address'] ?></td>
                                            <td>
                                            <script>
                                                var lat1 = "<?=$data['location_from_lat'] ?>";
                                                if (lat1.length==0) {lat1="0";}
                                                var lng1 = "<?=$data['location_from_lng'] ?>";
                                                if (lng1.length==0) {lng1="0";}
                                                var lat2 = "<?=$data['location_to_lat'] ?>";
                                                if (lat2.length==0) {lat2="0";}
                                                var lng2 = "<?=$data['location_to_lng'] ?>";
                                                if (lng2.length==0) {lng2="0";}
                                                var dist = getDistanceFromLatLonInKm(lat1*1,lng1*1,lat2*1,lng2*1).toFixed(2);
                                                document.write(dist);
                                            </script>
                                            </td>
                                            <td><?=$data['driver_name'];?></td>
                                            <td><?=$data['vehicle_name'];?></td>
                                            <td><?=$data['device_name'];?></td>
                                            <td><input type="button" class="btn btn-success" value="Diambil" onclick="doAction(<?=$data['shipment_id']?>,'AMBIL');"> </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="diambil">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama Kirim</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Supir</th>
                                        <th>Kendaraan</th>
                                        <th>Lacak</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($diambil_data as $data) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?= $data['shipment_title'] ?></td>
                                            <td><?= $data['shipment_price'] ?></td>
                                            <td><?= $data['location_from_address'] ?></td>
                                            <td><?= $data['location_to_address'] ?></td>
                                            <td>
                                            <script>
                                                var lat1 = "<?=$data['location_from_lat'] ?>";
                                                if (lat1.length==0) {lat1="0";}
                                                var lng1 = "<?=$data['location_from_lng'] ?>";
                                                if (lng1.length==0) {lng1="0";}
                                                var lat2 = "<?=$data['location_to_lat'] ?>";
                                                if (lat2.length==0) {lat2="0";}
                                                var lng2 = "<?=$data['location_to_lng'] ?>";
                                                if (lng2.length==0) {lng2="0";}
                                                var dist = getDistanceFromLatLonInKm(lat1*1,lng1*1,lat2*1,lng2*1).toFixed(2);
                                                document.write(dist);
                                            </script>
                                            </td>
                                            <td><?=$data['driver_name'];?></td>
                                            <td><?=$data['vehicle_name'];?></td>
                                            <td><?=$data['device_name'];?></td>
                                            <td><input type="button" class="btn btn-success" value="Diterima" onclick="doAction(<?=$data['shipment_id']?>,'TERIMA');"> </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="diterima">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama Kirim</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Supir</th>
                                        <th>Kendaraan</th>
                                        <th>Lacak</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($diterima_data as $data) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?= $data['shipment_title'] ?></td>
                                            <td><?= $data['shipment_price'] ?></td>
                                            <td><?= $data['location_from_address'] ?></td>
                                            <td><?= $data['location_to_address'] ?></td>
                                            <td>
                                            <script>
                                                var lat1 = "<?=$data['location_from_lat'] ?>";
                                                if (lat1.length==0) {lat1="0";}
                                                var lng1 = "<?=$data['location_from_lng'] ?>";
                                                if (lng1.length==0) {lng1="0";}
                                                var lat2 = "<?=$data['location_to_lat'] ?>";
                                                if (lat2.length==0) {lat2="0";}
                                                var lng2 = "<?=$data['location_to_lng'] ?>";
                                                if (lng2.length==0) {lng2="0";}
                                                var dist = getDistanceFromLatLonInKm(lat1*1,lng1*1,lat2*1,lng2*1).toFixed(2);
                                                document.write(dist);
                                            </script>
                                            </td>
                                            <td><?=$data['driver_name'];?></td>
                                            <td><?=$data['vehicle_name'];?></td>
                                            <td><?=$data['device_name'];?></td>
                                            <td><input type="button" class="btn btn-success" value="Selesai" onclick="doAction(<?=$data['shipment_id']?>,'SELESAI');"> </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="selesai">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama Kirim</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Supir</th>
                                        <th>Kendaraan</th>
                                        <th>Lacak</th>
                                        <th>Durasi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($selesai_data as $data) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?= $data['shipment_title'] ?></td>
                                            <td><?= $data['shipment_price'] ?></td>
                                            <td><?= $data['location_from_address'] ?></td>
                                            <td><?= $data['location_to_address'] ?></td>
                                            <td>
                                            <script>
                                                var lat1 = "<?=$data['location_from_lat'] ?>";
                                                if (lat1.length==0) {lat1="0";}
                                                var lng1 = "<?=$data['location_from_lng'] ?>";
                                                if (lng1.length==0) {lng1="0";}
                                                var lat2 = "<?=$data['location_to_lat'] ?>";
                                                if (lat2.length==0) {lat2="0";}
                                                var lng2 = "<?=$data['location_to_lng'] ?>";
                                                if (lng2.length==0) {lng2="0";}
                                                var dist = getDistanceFromLatLonInKm(lat1*1,lng1*1,lat2*1,lng2*1).toFixed(2);
                                                document.write(dist);
                                            </script>
                                            </td>
                                            <td><?=$data['driver_name'];?></td>
                                            <td><?=$data['vehicle_name'];?></td>
                                            <td><?=$data['device_name'];?></td>
                                            <td><?=$data['delivery_date'].' => '.$data['end_date'].' ['.$data['ship_duration'].']';?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<script>
function doAction(id,method) {
    if ($('#driver_'+id).val()=='') {
        alert('Driver tidak boleh kosong.');
    }
    else if ($('#vehicle_'+id).val()=='') {
        alert('Vehicle tidak boleh kosong.');
    }
    else if ($('#device_'+id).val()=='') {
        alert('Device tidak boleh kosong.');
    }
    else {
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        driver = $('#driver_'+id).val();
        vehicle = $('#vehicle_'+id).val();
        device = $('#device_'+id).val();
        param = {driver:driver,vehicle:vehicle,device:device};

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('panel/kiriman/ajaxProses/')?>/" + id + "/" + method,
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function (data) {
                alert('Sukses');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error dalam mengunduh data');
            }
        });
    }
}
</script>