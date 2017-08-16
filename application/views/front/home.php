<div class="content">
	<div class="section-1">
		<?php if (isset($_SESSION["flash_message"])) { ?>
		<div class="flash-message"><?php echo $_SESSION["flash_message"]; ?></div>
		<?php } ?>
		<div class="section-1-right">
			<div class="section-1-title">
				<div class="title-description">
					<div class="title-description-1">TEMPAT BERTEMUNYA PEMILIK BARANG DENGAN PEMILIK KENDARAAN</div>
					<div class="title-description-2">Terobosan baru pengiriman barang dalam jumlah besar dan banyak</div>
				</div>
				<div class="section-1-buttons">
					<a class="btn-pemilik" href="<?= base_url("how/pemilik-barang") ?>" >SAYA PEMILIK BARANG</a>
					<a class="btn-penerima" href="<?= base_url("how/pemilik-kendaraan") ?>" >SAYA PEMILIK KENDARAAN</a>
				</div>
			</div>
		</div>
		<div class="image-container">
			<div class="background-image" style="background-image:url('<?= base_url("assets/front/images/background_1080.png") ?>');" ></div>
			<div class="image-wrapper"></div>
		</div>
	</div>
	<div class="section-2">
		<div class="section-content">
			<div class="section-2-title"><span class="section-2-title-text">Apa itu <span class="section-title-logo" style="background-image: url('<?= base_url("assets/icons/logo-text-only.png") ?>');"></span> ?</span></div>
			<div class="section-2-description">Yukirim merupakan perusahaan internet yang menyediakan layanan berbasis web/aplikasi untuk menghubungkan pemilik barang dan pemilik kendaraan. Pengiriman dalam bentuk besar atau jumlah banyak menjadi mudah karena terhubung langsung dengan pemilik kendaraan dan semuanya dibuat transparan serta jelas di awal, sehingga memberikan keuntungan bagi pemilik barang dan pemilik kendaraan. Baik untuk mengisi kekosongan tempat dalam kendaraan atau menambah potensi pengiriman muatan. </div>
		</div>
	</div>
	<div class="section-3">
		<div class="section-content">
			<div class="section-3-title"><span class="section-3-title-text">Mengapa <span class="section-title-logo" style="background-image: url('<?= base_url("assets/icons/logo-text-only.png") ?>');"></span> ?</span></div>
			<div class="section-3-description">
				<div class="mengapa-item-line-1">
					<div class="mengapa-item mengapa-item-1">
						<div class="mengapa-item-icon" style="background-image: url('<?= base_url("assets/icons/runer-silhouette-running-fast.svg") ?>');"></div>
						<div class="mengapa-item-right">
							<div class="mengapa-item-title">Cepat dan mudah</div>
							<div class="mengapa-item-description">Cukup isi lokasi serta barang yang akan dikirim</div>
						</div>
					</div>
					<div class="mengapa-item mengapa-item-2">
						<div class="mengapa-item-icon" style="background-image: url('<?= base_url("assets/icons/computer.svg") ?>');"></div>
						<div class="mengapa-item-right">
							<div class="mengapa-item-title">Otomasi dan Integrasi</div>
							<div class="mengapa-item-description">Terhubung langsung dengan pemilik kendaraan</div>
						</div>
					</div>
					<div class="mengapa-item mengapa-item-3">
						<div class="mengapa-item-icon" style="background-image: url('<?= base_url("assets/icons/ic_attach_money_black_24px.svg") ?>');"></div>
						<div class="mengapa-item-right">
							<div class="mengapa-item-title">Harga dan Layanan Terbaik</div>
							<div class="mengapa-item-description">Sistem penawaran sehingga Anda dapat memilih layanan dan harga terbaik</div>
						</div>
					</div>
				</div>
				<div class="mengapa-item-line-2">
					<div class="mengapa-item mengapa-item-4">
						<div class="mengapa-item-icon" style="background-image: url('<?= base_url("assets/icons/search.svg") ?>');"></div>
						<div class="mengapa-item-right">
							<div class="mengapa-item-title">Transparan</div>
							<div class="mengapa-item-description">Harga dan barang ditampilkan jelas di awal</div>
						</div>
					</div>
					<div class="mengapa-item mengapa-item-5">
						<div class="mengapa-item-icon" style="background-image: url('<?= base_url("assets/icons/ic_place_black_24px.svg") ?>');"></div>
						<div class="mengapa-item-right">
							<div class="mengapa-item-title">Lacak/Tracking</div>
							<div class="mengapa-item-description">Bisa langsung lihat status dan/atau lacak kiriman</div>
						</div>
					</div>
					<div class="mengapa-item mengapa-item-6">
						<div class="mengapa-item-icon" style="background-image: url('<?= base_url("assets/icons/5-stars.svg") ?>');"></div>
						<div class="mengapa-item-right">
							<div class="mengapa-item-title">Rating</div>
							<div class="mengapa-item-description">Lihat ulasan dan rating pemilik kendaraan</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section-4">
		<div class="section-4-content">
			<div class="section-4-title"><span class="section-4-title-text">Bagaimana cara kerja <span class="section-title-logo" style="background-image: url('<?= base_url("assets/icons/logo-text-only.png") ?>');"></span> ?</span></div>
			<div class="section-content">
				<div class="section-4-step step-1">
					<div class="section-4-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_assignment_black_24dp_2x.png") ?>');"></div>
					<div class="section-4-step-description">1. Isi jenis Barang serta lokasi dan tujuan</div>
				</div>
				<div class="section-4-horizontal-line"></div>
				<div class="section-4-step step-2">
					<div class="section-4-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_check_circle_black_24dp_2x.png") ?>');"></div>
					<div class="section-4-step-description">2. Bandingkan dan pesan kendaraan</div>
				</div>
				<div class="section-4-horizontal-line"></div>
				<div class="section-4-step step-3">
					<div class="section-4-step-icon" style="background-image: url('<?= base_url("assets/icons/delivery-truck.svg") ?>');"></div>
					<div class="section-4-step-description">3. Kirim barang dan selesai</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url("assets/front/js/home.js"); ?>" defer></script>