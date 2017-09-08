<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-cancel-transaction">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Pembatalan Kiriman</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-cancel-transaction">Batalkan Kiriman</button>
			<button type="button" class="btn-neutral btn-batal">Tidak</button>
		</div>
	</div>
</div>
<div class="content">
	<div class="tabs" data-id="asd">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1" data-label="open">Open (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="2" data-label="on-progress">On Progress (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="3" data-label="selesai">Selesai (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="4" data-label="cancel">Cancel (<span class="tabs-item-count">0</span>)</div>
			</div>
			<div class="tabs-selection"></div>
		</div>
		<div class="tabs-body">
			<div class="tabs-content active" data-tabs-number="1">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-align="center" data-col='km'>KM</td>
								<td data-col='berakhir'>Berakhir</td>
								<td data-align="center" data-col='action'>Action</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="2">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-col='km' data-align="center">Km</td>
								<td data-col='status' data-align='center'>Status</td>
								<td data-col='action' data-align='center'>Action</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="3">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-col='km' data-align="center">Km</td>
								<td data-col='status' data-align='center'>Status</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="4">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-align="center" data-col='km'>KM</td>
								<td data-col='cancel-by'>Cancel by</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var profilUrl = "<?= base_url("profil/") ?>";
var getAllStatusKirimanUrl = "<?php echo base_url("kiriman-saya/getAllStatusKiriman"); ?>";
var getDetailPengirimUrl = "<?php echo base_url("kiriman-saya/getInfoEkspedisi"); ?>";
var cancelShipmentUrl = "<?php echo base_url("kiriman-saya/cancelShipment"); ?>";
var submitRatingUrl = "<?php echo base_url("kiriman-saya/submitRating"); ?>";
var getKirimanCountUrl = "<?php echo base_url("kiriman-saya/getKirimanCount"); ?>";
var shipmentUrl = "<?php echo base_url("kirim/detail/"); ?>";
var shipmentPictureUrl = "<?php echo base_url("assets/panel/images/"); ?>";
var defaultPictureUrl = "<?php echo base_url("assets/panel/images/default.gif"); ?>";
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("kiriman-saya/getOpenKiriman") ?>";
kirimanUrl[2] = "<?= base_url("kiriman-saya/getProgressKiriman") ?>";
kirimanUrl[3] = "<?= base_url("kiriman-saya/getSelesaiKiriman") ?>";
kirimanUrl[4] = "<?= base_url("kiriman-saya/getCancelKiriman") ?>";

var kirimanTabs = [];
kirimanTabs[1] = "open";
kirimanTabs[2] = "progress";
kirimanTabs[3] = "selesai";
kirimanTabs[4] = "cancel";

var statusDetail = {
	"-1": "Open",
	"0": {
		"darat": "Pending",
		"laut": "Pending"
	},
	"1": {
		"darat": "Konfirmasi",
		"laut": "Konfirmasi"
	},
	"2": {
		"darat": "Pesanan",
		"laut": "Door 1"
	},
	"3": {
		"darat": "Dikirim",
		"laut": "Port 1"
	},
	"4": {
		"darat": "Diambil",
		"laut": "Port 2"
	},
	"5": {
		"darat": "Diterima",
		"laut": "Door 2"
	},
	"6": "Selesai",
	"7": "Cancel"
};
</script>
<script src="<?php echo base_url("assets/panel/js/kiriman.js"); ?>" defer></script>