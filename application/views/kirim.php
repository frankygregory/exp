<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
		<a class="btn-kirim-barang" href="<?= base_url("kirim/kirimbarang") ?>">
			<button type="button" class="btn-default">Kirim Barang</button>
		</a>
		<table class="table">
			<thead>
				<tr>
					<td>Nama Kirim</td>
					<td>Harga</td>
					<td>Asal</td>
					<td>Tujuan</td>
					<td>KM</td>
					<td>Berakhir</td>
				</tr>
			</thead>
			<tbody class="tbody-kiriman">
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	getKiriman();
	
	$(".btn-tambah").on("click", function() {
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahKendaraan();
	});
	
	$(document).on("click", ".btn-edit", function() {
		editKendaraan(this);
	});
	
	$(".btn-batal").on("click", function() {
		closeDialog();
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateKendaraan();
	});
	
	$(document).on("click", ".btn-toggle", function() {
		toggleKendaraanAktif(this);
	});
	
	$(document).on("click", ".btn-delete", function() {
		var namaKendaraan = $(this).closest(".tr-kendaraan").children(".td-name").html();
		var vehicle_id = $(this).closest(".tr-kendaraan").data("id");
		$(".dialog-konfirmasi-delete").data("id", vehicle_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Delete " + namaKendaraan + "?");
		showDialog(".dialog-konfirmasi-delete");
	});
	
	$(".btn-submit-delete").on("click", function() {
		deleteKendaraan(this);
	});
	
	function toggleKendaraanAktif(element) {
		var vehicle_status = $(element).data("value");
		var vehicle_id = $(element).closest(".tr-kendaraan").data("id");
		
		$.ajax({
			url: '<?= base_url("kendaraan/toggleKendaraanAktif") ?>',
			data: {
				vehicle_id: vehicle_id,
				vehicle_status: vehicle_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKiriman();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function editKendaraan(element) {
		var id = $(element).data("id");
		var vehicle_nomor = $(".tr-kendaraan[data-id='" + id + "'] .td-nomor").html();
		var vehicle_name = $(".tr-kendaraan[data-id='" + id + "'] .td-name").html();
		var vehicle_information = $(".tr-kendaraan[data-id='" + id + "'] .td-information").html();
		var vehicle_status = $(".tr-kendaraan[data-id='" + id + "'] .btn-aktif").prop("disabled");
		
		if (vehicle_status) {
			vehicle_status = "1";
		} else {
			vehicle_status = "0";
		}
		
		$(".dialog-edit").data("id", id);
		$(".dialog-edit .input-nopol").val(vehicle_nomor);
		$(".dialog-edit .input-nama").val(vehicle_name);
		$(".dialog-edit .input-keterangan").val(vehicle_information);
		$(".dialog-edit .input-status").val(vehicle_status);
		
		showDialog(".dialog-edit");
	}
	
	function updateKendaraan() {
		var vehicle_id = $(".dialog-edit").data("id");
		var vehicle_nomor = $(".dialog-edit .input-nopol").val();
		var vehicle_name = $(".dialog-edit .input-nama").val();
		var vehicle_information = $(".dialog-edit .input-keterangan").val();
		var vehicle_status = $(".dialog-edit .input-status").val();
		
		$.ajax({
			url: '<?= base_url("kendaraan/updateKendaraan") ?>',
			data: {
				submit_update: true,
				vehicle_id: vehicle_id,
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
					getKiriman();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function tambahKendaraan() {
		var vehicle_nomor = $(".dialog-tambah .input-nopol").val();
		var vehicle_name = $(".dialog-tambah .input-nama").val();
		var vehicle_information = $(".dialog-tambah .input-keterangan").val();
		var vehicle_status = $(".dialog-tambah .input-status").val();
		
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
					getKiriman();
				}
			}
		});
	}
	
	function deleteKendaraan(element) {
		var vehicle_id = $(".dialog-konfirmasi-delete").data("id");
		$.ajax({
			url: '<?= base_url("kendaraan/deleteKendaraan") ?>',
			data: {
				submit_delete: true,
				vehicle_id: vehicle_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getKiriman();
				}
			}
		});
	}
	
	function getKiriman() {
		$.ajax({
			url: '<?= base_url("kirim/getKiriman") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-kiriman").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addKirimanToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addKirimanToTable(no, result) {
		var date_from = new Date(result.shipment_delivery_date_from);
		var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
		var date_to = new Date(result.shipment_delivery_date_to);
		var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
		
		var element = "<tr class='tr-kiriman' data-id='" + result.shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + result.shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result.shipment_pictures + "' /></td><td class='td-price'>Bid : " + result.bidding_count + "</td><td class='td-asal'>" + result.location_from_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result.location_to_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + result.shipment_length + "</td><td class='td-berakhir'>" + result.berakhir + "</td></td></tr>";
		$(".tbody-kiriman").append(element);
	}
	
});
</script>