<div class="content">
    <div class="section-1">
        <div class="username"><?php echo $user[0]->username; echo ($user[0]->user_verified == 0) ? "" : "<span class='verified-icon' style='background-image: url(" . base_url("assets/icons/ic_verified_user_black_24px.svg") . ");'><div></div></span>"; ?></div>
	</div>
	<div class="section-2 section">
		<div>
			<pre><?php echo $user[0]->user_details_information ?></pre>
		</div>
	</div>
    <div class="section-3 section">
        <div class="subsection subsection-kiriman">
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
    <?php	if ($user[0]->role_id == 2) { ?>
		<div class="subsection">
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
 <?php	if ($user[0]->role_id == 2) { ?>
    <div class="section-4">
        <div class="subsection-rating-total">
            <div class="rating-total">
                <span class="rating-label">Rating : </span>
                <span class="rating-total-number"></span>
            </div>
        </div>
        <div class="subsection-rating-feedback">
            <div class="sort">
                <span class="sort-label">Urutkan : </span>
                <select class="select-sort">
                    <option value="created_date_desc">Tanggal Terbaru</option>
                    <option value="created_date_asc">Tanggal Terlama</option>
                    <option value="user_details_rating_number_desc">Rating Tertinggi</option>
                    <option value="user_details_rating_number_asc">Rating Terendah</option>
                </select>
            </div>
            <div class="feedback-section">
				<div class="feedback-data"></div>
				<div class="default-empty-state">Tidak ada ulasan</div>
            </div>
        </div>
    </div>
<?php   }   ?>
</div>
<script>
var getStatistikUrl = "<?php echo base_url("home/getStatistik"); ?>";
var user_id = <?php echo $user[0]->user_id; ?>;
var isEkspedisi = <?php echo ($user[0]->role_id == 2) ? "true" : "false"; ?>;
var profilUrl = "<?= base_url("profil/") ?>";
var getMyRatingUrl = "<?php echo base_url("home/getProfilRating"); ?>";
var getMyFeedbackUrl = "<?php echo base_url("home/getProfilFeedback"); ?>";
var shipmentUrl = "<?php echo base_url("kirim/detail/"); ?>";
</script>
<script src="<?php echo base_url("assets/front/js/profil.js"); ?>" defer></script>