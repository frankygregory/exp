<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Kendaraan</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Nopol Kendaraan</td>
						<td><input type="text" class="input-nopol" maxlength="12" /></td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" class="input-keterangan" /></td>
					</tr>
					<tr>
						<td class="">Ketersediaan</td>
						<td>
							<select name="input-ketersediaan" class="input-ketersediaan">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah">Tambah</button>
		</div>
	</div>
</div>
<div class="content">
	<div class="section-1">
		<button type="button" class="btn-default btn-tambah">Tambah Kendaraan</button>
		<table class="table">
			<thead>
				<tr>
					<td>No.</td>
					<td>Nomor Kendaraan</td>
					<td>Nama Kendaraan</td>
					<td>Ketersediaan</td>
					<td>Jumlah Transaksi</td>
					<td>Keterangan</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-kendaraan">
			
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getKendaraan();
	
	$(".btn-tambah").on("click", function() {
		showDialog(".dialog-tambah");
		$(".input-nama").select();
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahKendaraan();
	});
	
	function tambahKendaraan() {
		var vehicle_nomor = $(".input-nopol").val();
		var vehicle_name = $(".input-nama").val();
		var vehicle_information = $(".input-keterangan").val();
		var vehicle_status = $(".input-ketersediaan").val();
		
		$.ajax({
			url: '<?= base_url("kendaraan/tambahKendaraan") ?>',
			data: {
				submit_tambah: true,
				vehicle_nomor: vehicle_nomor,
				vehicle_name: vehicle_name,
				vehicle_information: vehicle_information,
				vehicle_status: vehicle_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					resetDialogInput();
					getKendaraan();
				}
			}
		});
	}
	
	function getKendaraan() {
		$.ajax({
			url: '<?= base_url("kendaraan/getKendaraan") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-kendaraan").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addKendaraanToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addKendaraanToTable(no, result) {
		var ketersediaan = "Tersedia";
		if (result.vehicle_in_use == 1) {
			ketersediaan = "Sedang Digunakan";
		}
		
		var aktifDisabled = "disabled", tidakAktifDisabled = "";
		if (result.vehicle_status == 0) {
			aktifDisabled = "";
			tidakAktifDisabled = "disabled";
		}
		
		var btnAktif = "<button class='btn-default btn-aktif' " + aktifDisabled + ">Aktif</button>";
		var btnTidakAktif = "<button class='btn-default btn-tidak-aktif' " + tidakAktifDisabled + ">Tidak Aktif</button>";
		var element = "<tr><td>" + no + "</td><td>" + result.vehicle_nomor + "</td><td>" + result.vehicle_name + "</td><td>" + ketersediaan + "</td><td>" + result.vehicle_jumlah_transaksi + "</td><td>" + result.vehicle_information + "</td><td>" + btnAktif + btnTidakAktif + "</td><td></td></tr>";
		$(".tbody-kendaraan").append(element);
	}
	
	function resetDialogInput() {
		$(".input-nopol").val("");
		$(".input-nama").val("");
		$(".input-keterangan").val("");
		$(".input-ketersediaan").val("1");
	}
});
</script>