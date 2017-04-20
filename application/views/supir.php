<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td><input type="text" class="input-alamat" /></td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td><input type="text" class="input-hp" maxlength="12" /></td>
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
		<button type="button" class="btn-default btn-tambah">Tambah Driver</button>
		<table class="table">
			<thead>
				<tr>
					<td>No.</td>
					<td>Nama Driver</td>
					<td>No. HP</td>
					<td>Ketersediaan</td>
					<td>Rating</td>
					<td>Jumlah Transaksi</td>
					<td>Keterangan</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-supir">
			
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getSupir();
	
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
		tambahSupir();
	});
	
	function tambahSupir() {
		var driver_name = $(".input-nama").val();
		var driver_handphone = $(".input-hp").val();
		var driver_address = $(".input-alamat").val();
		var driver_information = $(".input-keterangan").val();
		var driver_status = $(".input-ketersediaan").val();
		
		$.ajax({
			url: '<?= base_url("supir/tambahSupir") ?>',
			data: {
				submit_tambah: true,
				driver_name: driver_name,
				driver_handphone: driver_handphone,
				driver_address: driver_address,
				driver_information: driver_information,
				driver_status: driver_status
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
					getSupir();
				}
			}
		});
	}
	
	function getSupir() {
		
		$.ajax({
			url: '<?= base_url("supir/getSupir") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-supir").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addSupirToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addSupirToTable(no, result) {
		var ketersediaan = "Tersedia";
		if (result.driver_in_use == 1) {
			ketersediaan = "Sedang Digunakan";
		}
		
		if (result.driver_rating == null) {
			result.driver_rating = "Unrated";
		}
		
		var aktifDisabled = "disabled", tidakAktifDisabled = "";
		if (result.driver_status == 0) {
			aktifDisabled = "";
			tidakAktifDisabled = "disabled";
		}
		
		var btnAktif = "<button class='btn-default btn-aktif' " + aktifDisabled + ">Aktif</button>";
		var btnTidakAktif = "<button class='btn-default btn-tidak-aktif' " + tidakAktifDisabled + ">Tidak Aktif</button>";
		var element = "<tr><td>" + no + "</td><td>" + result.driver_name + "</td><td>" + result.driver_handphone + "</td><td>" + ketersediaan + "</td><td>" + result.driver_rating + "</td><td>" + result.driver_jumlah_transaksi + "</td><td>" + result.driver_information + "</td><td>" + btnAktif + btnTidakAktif + "</td><td></td></tr>";
		$(".tbody-supir").append(element);
	}
	
	function resetDialogInput() {
		$(".input-nama").val("");
		$(".input-hp").val("");
		$(".input-alamat").val("");
		$(".input-keterangan").val("");
		$(".input-ketersediaan").val("1");
	}
});
</script>