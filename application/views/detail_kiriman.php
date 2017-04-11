
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detail Kiriman
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Detail Kiriman Barang
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->


<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Informasi Kiriman</h3>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label>Judul Kiriman</label>
                    <input class="form-control" placeholder="Judul kiriman" disabled>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <input class="form-control" placeholder="Keterangan" disabled>
                </div>

                <div class="form-group">
                    <label>Pelanggan</label>
                    <input class="form-control" placeholder="Pelanggan" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Buat</label>
                    <input class="form-control" placeholder="Tanggal Buat" disabled>
                </div>

                <div class="form-group">
                    <label>Perubahan Terakhir</label>
                    <input class="form-control" placeholder="Perubahan Terakhir" disabled>
                </div>

                <div class="form-group">
                    <label>Berakhir</label>
                    <input class="form-control" placeholder="Berakhir" disabled>
                </div>

                <div class="form-group">
                    <label>Cara Pemesanan</label>
                    <input class="form-control" placeholder="Cara Pemesanan" disabled>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <img src="<?= base_url() ?>/assets/panel/images/gambar-01.jpg">
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Infomasi Lokasi</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Lokasi Asal</label>
                    <input class="form-control" placeholder="Lokasi dari Google Maps" disabled>
                </div>

                <div class="form-group">
                    <label>Detail Lokasi Asal</label>
                    <input class="form-control" placeholder="Detail Lokasi" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Kirim</label>
                    <input class="form-control" placeholder="Tanggal Kirim" disabled>
                </div>

                <div class="form-group">
                    <label>Lokasi Tujuan</label>
                    <input class="form-control" placeholder="Lokasi dari Google Maps" disabled>
                </div>

                <div class="form-group">
                    <label>Detail Lokasi</label>
                    <input class="form-control" placeholder="Detail Lokasi" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Kirim</label>
                    <input class="form-control" placeholder="Tanggal Kirim" disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <h3>Maps</h3>
    </div>
</div>
<!-- /.row -->

<hr>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Informasi Detail</h3>
        </div>

        <div class="panel-body">
            <div class="col-md-6">

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Items</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Diskusi</a>
                    </li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab"
                                               data-toggle="tab">Penawaran</a></li>
                </ul>
                <br>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="form-group">
                            <label>Items</label>
                            <input class="form-control" placeholder="Nama Item">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input class="form-control" placeholder="Deskripsi Item">
                        </div>

                        <div class="form-group">
                            <label>Panjang</label>
                            <input class="form-control" placeholder="Panjang Item">
                        </div>

                        <div class="form-group">
                            <label>Lebar</label>
                            <input class="form-control" placeholder="Lebar Item">
                        </div>

                        <div class="form-group">
                            <label>Tinggi</label>
                            <input class="form-control" placeholder="Tinggi Item">

                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" value="">Meter
                                </label>
                            </div>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" value="">Centimeter
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Berat</label>
                            <input class="form-control" placeholder="Berat Item">

                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" value="">Kg
                                </label>
                            </div>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" value="">Ton
                                </label>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="profile">
                        <form method="post" action="#">
                            <div class="form-group">
                                <label>Pertanyaan/Jawaban</label>
                                <textarea cols="3" rows="3" class="form-control"></textarea>
                            </div>
                            <input type="button" value="Kirim" class="btn btn-success">
                        </form>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Riwayat Diskusi</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Response</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Customer One</td>
                                            <td>
                                                Lorem ipsum dollor sit amet
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Expedisi Jaya Agung</td>
                                            <td>
                                                Lorem ipsum dollor sit amet
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="messages">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Harga</th>
                                    <th>Expedisi</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>500.000</td>
                                    <td>
                                        Okebro(Posisi: Silver, gold) <br>
                                        5.0 / 5.0 ( 90% Sukses )
                                    </td>
                                    <td>
                                        <input type="button" value="Setuju" class="btn btn-success">
                                        <input type="button" value="Tolak" class="btn btn-danger"> <br> <br>
                                        <textarea class="form-control" cols="3" row="3" placeholder="Isi alasan menolak"></textarea>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        <input type="button" value="Kirim Penawaran" class="btn btn-success" data-toggle="modal" data-target="#penawaranmodal" style="float: right">

            <!-- Modal -->
            <div class="modal fade" id="penawaranmodal" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Kirim Penawaran</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Harga">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Tanggal Ambil">
                                </div>
                                <div class="form-group">

                                    <textarea class="form-control" cols="3" rows="6" placeholder="Keterangan"></textarea>
                                </div>
                                <input type="button" value="Kirim" class="btn btn-primary">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
