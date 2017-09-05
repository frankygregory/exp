<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?><span class="tag-premium-large"></span></div>
<div class="content">
	<div class="tabs" data-id="">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1">Berjalan (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="2">Berakhir (<span class="tabs-item-count">0</span>)</div>
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
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state shown">tidak ada data</div>
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
								<td data-align="center" data-col='km'>KM</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state shown">tidak ada data</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
var month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
var profilUrl = "<?= base_url("profil/") ?>";
var getKirimanCountUrl = "<?php echo base_url("penawaran-bisnis/getKirimanCount"); ?>";
var shipmentUrl = "<?php echo base_url("kirim/detail/"); ?>";
var shipmentPictureUrl = "<?php echo base_url("assets/panel/images/"); ?>";
var defaultPictureUrl = "<?php echo base_url("assets/panel/images/default.gif"); ?>";
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("penawaran-bisnis/getOpenKiriman") ?>";
kirimanUrl[2] = "<?= base_url("penawaran-bisnis/getClosedKiriman") ?>";

var kirimanTabs = [];
kirimanTabs[1] = "open";
kirimanTabs[2] = "closed";
</script>
<script src="<?php echo base_url("assets/panel/js/penawaran_pro.js"); ?>" defer></script>