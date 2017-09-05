<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1 section">
		<?php if ($role_id == 2) { ?>
		<div class="dashboard-item kiriman-open">
			<span>Open Penawaran</span>
			<span class="value">...</span>
		</div>
		<?php } ?>
		<?php if ($role_id == 1) { ?>
		<div class="dashboard-item kiriman-total">
			<span>Total Kiriman</span>
			<span class="value">...</span>
		</div>
		<?php } ?>
		<div class="dashboard-item-separator"></div>
		<div class="dashboard-item kiriman-berjalan">
			<span>Kiriman Berjalan</span>
			<span class="value">...</span>
		</div>
		<?php if ($role_id == 2) { ?>
		<div class="rating-total">
			<span class="rating-label">Rating : </span>
			<span class="rating-total-number">...</span>
		</div>
		<?php } ?>
	</div>
	<div class="section-2 section">
		<div class="section-title">Statistik Kiriman</div>
		<div class="table-statistik-kiriman-container">
			<table class="table-statistik-kiriman">
				<tbody>
					<tr class="tr-col-header">
						<td class="td-row-header"></td>
						<td class="td">Total</td>
						<td>1 Bulan</td>
						<td>6 Bulan</td>
						<td>12 Bulan</td>
					</tr>
					<tr class="tr-kiriman-berhasil">
						<td class="td-row-header">Berhasil</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr class="tr-kiriman-gagal">
						<td class="td-row-header">Gagal</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr class="tr-kiriman-total">
						<td class="td-row-header">Total</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr class="tr-kiriman-persen">
						<td class="td-row-header">Persen</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php	if ($role_id == 2) { ?>
		<div class="section-3 section">
			<div class="section-title">Statistik Penawaran</div>
			<div class="table-statistik-bidding-container">
				<table class="table-statistik-bidding">
					<tbody>
						<tr class="tr-col-header">
							<td class="td-row-header"></td>
							<td class="td">Total</td>
							<td>1 Bulan</td>
							<td>6 Bulan</td>
							<td>12 Bulan</td>
						</tr>
						<tr class="tr-bidding-berhasil">
							<td class="td-row-header">Berhasil</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
						<tr class="tr-bidding-gagal">
							<td class="td-row-header">Gagal</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
						<tr class="tr-bidding-total">
							<td class="td-row-header">Total</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
						<tr class="tr-bidding-persen">
							<td class="td-row-header">Persen</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
<?php	}	?>
</div>
</div>
</div>
<script>
var isEkspedisi = false;
var getKirimanCountUrl = "<?php echo base_url("dashboard/getKirimanCount"); ?>";
var getMyRatingUrl = "<?php echo base_url("ulasan/getMyRating"); ?>";
var getStatistikUrl = "<?php echo base_url("statistik/getStatistik"); ?>";
<?php
	if ($role_id == 2) {
		echo "isEkspedisi = true;";
	}
?>
</script>
<script src="<?php echo base_url("assets/panel/js/dashboard.js"); ?>" defer></script>