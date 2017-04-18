<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&libraries=places" async defer></script>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?= $page_title ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Kirim
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
			<?php
			if ($role_id == 1) { ?>
				<div class="row">
						<div class="col-md-2">
							<div class="form-group">
							   <a href="<?=site_url('kirim/kirimbarang/')?>" class="btn btn-success"><i class="fa fa-send"></i> Kirim Barang</a>
							</div>
						</div>
						<form action="#" method="post">
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Lokasi Asal">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Lokasi Tujuan">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<input type="submit" value="Cari" class="btn btn-default">
								</div>
							</div>
						</form>
				</div>
	<?php	}	?>
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
                                    $data2 = $data;
                                    foreach($data2 as $data){ ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url() ?>kirim/detail/<?=$data['shipment_id']?>"><h4><?=$data['shipment_title']?></h4></a>
                                                <img src="<?= base_url().'/assets/panel/images/'.$data['shipment_pictures']?>" width="110">
                                                <h5>400 Kg</h5>
                                            </td>
                                            <td>
                                                Bid : <?= $data['bid_count'].' ('.$data['active_bid_count'].' Active)' ?><br>
                                                Low : <?= $data['min_bid_price'] ?>
                                            </td>
                                            <td>
                                                <?=$data['location_from_name']?><br>
                                                Tgl : <?=$data['shipment_delivery_date_to']?> - <?=$data['shipment_end_date']?>
                                            </td>
                                            <td>
                                                <?=$data['location_to_name']?><br>
                                                Tgl : <?=$data['shipment_delivery_date_to']?> - <?=$data['shipment_end_date']?>
                                            </td>
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
                                                var latLngA = new google.maps.LatLng({lat:(lat1*1),lng:(lng1*1)});
                                                var latLngB = new google.maps.LatLng({lat:(lat2*1),lng:(lng2*1)});
                                                //var latLngA = {lat:(lat1*1),lng:(lng1*1)};
                                                //var latLngB = {lat:(lat2*1),lng:(lng2*1)};
                                                //document.write(google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB));
                                            </script>
                                            </td>
                                            <td><?=$data['rem_date']?></td>
                                        </tr>
                                    <?php }
                                    ?>
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
                                    foreach($data2 as $data){
                                      if ($data['shipment_type']==2) { ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url() ?>kirim/detail/<?=$data['shipment_id']?>"><h4><?=$data['shipment_title']?></h4></a>
        <!--                                        <img src="--><?//= base_url() ?><!--/assets/panel/images/gambar-01.jpg" width="110">-->
                                                <h5>400 Kg</h5>
                                            </td>
                                            <td>
                                                Bid : 2 (1 Active) <br>
                                                Low : <?=$data['shipment_price']?>
                                            </td>
                                            <td>
                                                <?=$data['location_from_name']?><br>
                                                Tgl : <?=$data['shipment_delivery_date_to']?> - <?=$data['shipment_end_date']?>
                                            </td>
                                            <td>
                                                <?=$data['location_to_name']?><br>
                                                Tgl : <?=$data['shipment_delivery_date_to']?> - <?=$data['shipment_end_date']?>
                                            </td>
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
                                                var latLngA = new google.maps.LatLng({lat:(lat1*1),lng:(lng1*1)});
                                                var latLngB = new google.maps.LatLng({lat:(lat2*1),lng:(lng2*1)});
                                                //var latLngA = {lat:(lat1*1),lng:(lng1*1)};
                                                //var latLngB = {lat:(lat2*1),lng:(lng2*1)};
                                                //document.write(google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB));
                                            </script>
                                            </td>
                                            <td><?=$data['rem_date']?></td>
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
                                    foreach($data2 as $data){
                                      if ($data['shipment_type']==1) { ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url() ?>kirim/detail/<?=$data['shipment_id']?>"><h4><?=$data['shipment_title']?></h4></a>
        <!--                                        <img src="--><?//= base_url() ?><!--/assets/panel/images/gambar-01.jpg" width="110">-->
                                                <h5>400 Kg</h5>
                                            </td>
                                            <td>
                                                Bid : 2 (1 Active) <br>
                                                Low : <?=$data['shipment_price']?>
                                            </td>
                                            <td>
                                                <?=$data['location_from_name']?><br>
                                                Tgl : <?=$data['shipment_delivery_date_to']?> - <?=$data['shipment_end_date']?>
                                            </td>
                                            <td>
                                                <?=$data['location_to_name']?><br>
                                                Tgl : <?=$data['shipment_delivery_date_to']?> - <?=$data['shipment_end_date']?>
                                            </td>
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
                                                var latLngA = new google.maps.LatLng({lat:(lat1*1),lng:(lng1*1)});
                                                var latLngB = new google.maps.LatLng({lat:(lat2*1),lng:(lng2*1)});
                                                //var latLngA = {lat:(lat1*1),lng:(lng1*1)};
                                                //var latLngB = {lat:(lat2*1),lng:(lng2*1)};
                                                //document.write(google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB));
                                            </script>
                                            </td>
                                            <td><?=$data['rem_date']?></td>
                                        </tr>
                                    <?php
                                      }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="penawaran">
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
$(document).ready(function()
{
    var extraObj = $("#fileuploader").uploadFile({
        url:"upload.php",
        multiple:true,
        dragDrop:true,
        fileName:"myfile",
        sequential:true,
        sequentialCount:1,
        acceptFiles:"image/*",
        maxFileCount:3,
        maxFileSize:100*1024,
        dragDropStr: "<span><b>Drop file here</b></span>",
        abortStr:"Batal",
        cancelStr:"Batal",
        doneStr:"Sukses",
        multiDragErrorStr:"Drop file error",
        extErrorStr:"File not supported",
        sizeErrorStr:"File size too large",
        uploadErrorStr:"Error uploading file",
        uploadStr:"Uploading",
        extraHTML:function()
        {
            var html = "<div><b>File Tags:</b><input type='text' name='tags' value='' /> <br/>";
            html += "<b>Category</b>:<select name='category'><option value='1'>ONE</option><option value='2'>TWO</option></select>";
            html += "</div>";
            return html;
        },
        autoSubmit:false
    });

    $("#extrabutton").click(function()
    {

        extraObj.startUpload();
    });
});
</script>