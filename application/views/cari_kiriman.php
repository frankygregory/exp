    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Cari Kiriman
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Cari Kiriman
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <form role="form" action="#">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!--<label>Lokasi Asal</label>-->
                            <input type="text" class="form-control" placeholder="Lokasi Asal">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <!--<label>Lokasi Tujuan</label>-->
                            <input type="text" class="form-control" placeholder="Lokasi Tujuan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="submit" value="Cari" class="btn btn-default">
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a>
                        </li>
                        <li role="private">
                            <a href="#private" aria-controls="private" role="tab" data-toggle="tab">Private</a>
                        </li>
                        <li role="public">
                            <a href="#public" aria-controls="public" role="tab" data-toggle="tab">Public</a>
                        </li>
                        <li role="penawaran">
                            <a href="#penawaran" aria-controls="penawaran" role="tab" data-toggle="tab">Penawaran</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="all">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nama Kiriman</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Berakhir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($kiriman_data as $data) {
                                        ?>
                                        <tr>
                                            <td>
                                                <h4><?= $data['shipment_title'] ?></h4>
                                                <img src="<?= base_url().'/assets/panel/images/'.$data['shipment_pictures']; ?>" width="110">
                                                <?= $data['tot_weight_kg']." Kg"; ?>
                                            </td>
                                            <td>
                                                Bid : <?= $data['bid_count'].' ('.$data['active_bid_count'].' Active)' ?><br>
                                                Low : <?= $data['min_bid_price'] ?>
                                            </td>
                                            <td><?= $data['location_from_address'].'<br>Tgl : '.$data['ship_date_from'].' s/d '.$data['ship_date_to'] ?></td>
                                            <td><?= $data['location_to_address'].'<br>Tgl : '.$data['ship_date_from'].' s/d '.$data['ship_date_to'] ?></td>
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
                                            <td><?= $data['rem_date'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url() ?>panel/cari_kiriman/detail"><h4>Lemari 2 Pintu</h4></a>
                                            <img src="<?= base_url() ?>/assets/panel/images/gambar-01.jpg" width="110">
                                            <h5>400 Kg</h5>
                                        </td>
                                        <td>
                                            Bid : 2 (1 Active) <br>
                                            Low : 5.000.000
                                        </td>
                                        <td>
                                            Surabaya<br>
                                            Tgl : 10oct - 12oct 16.
                                        </td>
                                        <td>
                                            Bandung<br>
                                            Tgl : 10oct - 12oct 16.
                                        </td>
                                        <td>1000</td>
                                        <td>5 Jam</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="private">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nama Kiriman</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Berakhir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($kiriman_data as $data) {
                                        if ($data['shipment_type']==2) {
                                    ?>
                                        <tr>
                                            <td>
                                                <h4><?= $data['shipment_title'] ?></h4>
                                                <img src="<?= base_url().'/assets/panel/images/'.$data['shipment_pictures']; ?>" width="110">
                                                <?= $data['tot_weight_kg']." Kg"; ?>
                                            </td>
                                            <td>
                                                Bid : <?= $data['bid_count'].' ('.$data['active_bid_count'].' Active)' ?><br>
                                                Low : <?= $data['min_bid_price'] ?>
                                            </td>
                                            <td><?= $data['location_from_address'].'<br>Tgl : '.$data['ship_date_from'].' s/d '.$data['ship_date_to'] ?></td>
                                            <td><?= $data['location_to_address'].'<br>Tgl : '.$data['ship_date_from'].' s/d '.$data['ship_date_to'] ?></td>
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
                                            <td><?= $data['rem_date'] ?></td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="public">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nama Kiriman</th>
                                        <th>Harga</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>KM</th>
                                        <th>Berakhir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($kiriman_data as $data) {
                                        if ($data['shipment_type']==1) {
                                    ?>
                                        <tr>
                                            <td>
                                                <h4><?= $data['shipment_title'] ?></h4>
                                                <img src="<?= base_url().'/assets/panel/images/'.$data['shipment_pictures']; ?>" width="110">
                                                <?= $data['tot_weight_kg']." Kg"; ?>
                                            </td>
                                            <td>
                                                Bid : <?= $data['bid_count'].' ('.$data['active_bid_count'].' Active)' ?><br>
                                                Low : <?= $data['min_bid_price'] ?>
                                            </td>
                                            <td><?= $data['location_from_address'].'<br>Tgl : '.$data['ship_date_from'].' s/d '.$data['ship_date_to'] ?></td>
                                            <td><?= $data['location_to_address'].'<br>Tgl : '.$data['ship_date_from'].' s/d '.$data['ship_date_to'] ?></td>
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
                                            <td><?= $data['rem_date'] ?></td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane active" id="penawaran">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
