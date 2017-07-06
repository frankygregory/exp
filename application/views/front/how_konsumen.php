<div class="content">
	<div class="section-1">
		<div class="section-1-image" style="background-image: url('<?= base_url("assets/front/images/konsumen.jpg") ?>');"></div>
		<div class="section-1-text">
			<div class="section-1-title">KIRIM BARANG DALAM JUMLAH BESAR MENJADI LEBIH MUDAH DAN CEPAT</div>
			<div class="section-1-description">Daftarkan kiriman barang Anda dan rasakan manfaatnya.</div>
			<a href="<?= base_url("register") ?>" class="btn btn-daftar">DAFTAR SEKARANG</a>
		</div>
	</div>
	<div class="section-2">
		<div class="section-title">Bagaimana Caranya ?</div>
		<div class="section-content">
			<div class="section-2-step step-1">
				<div class="section-2-step-description"></div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_assignment_black_24dp_2x.png") ?>');"></div>
				<div class="section-2-step-description">1. Isi jenis barang serta lokasi dan tujuan</div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-2">
				<div class="section-2-step-description">2. Bandingkan ulasan<br>serta rating</div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_check_circle_black_24dp_2x.png") ?>');"></div>
				<div class="section-2-step-description"></div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-3">
				<div class="section-2-step-description"></div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/delivery-truck.svg") ?>');"></div>
				<div class="section-2-step-description">3. Pilih dan pesan kendaraan</div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-4">
				<div class="section-2-step-description">4. Lihat status dan/atau lacak kiriman</div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_place_black_24px.svg") ?>');"></div>
				<div class="section-2-step-description"></div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-5">
				<div class="section-2-step-description"></div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/confirm.png") ?>');"></div>
				<div class="section-2-step-description">5. Konfirmasi kiriman yang sudah selesai</div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-6">
				<div class="section-2-step-description">6. Berikan ulasan dan rating</div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/1-star.svg") ?>');"></div>
				<div class="section-2-step-description"></div>
			</div>
		</div>
	</div>
</div>
<script>
var section2Top = 0;
var scrollTop = 0;
var innerHeight = window.innerHeight;
$(function() {
	initialize();

	$(document).on("scroll", function() {
		scrollTop = window.scrollY;
	});

	$(document).on("scroll", showSection2);
});

function initialize() {
	scrollTop = window.scrollY;
	section2Top = $(".section-2").offset().top;
	
	showSection2();
}

function showSection2() {
	var section2 = section2Top - scrollTop;
	if (section2 < innerHeight - 400) {
		$(".section-2 .section-content").addClass("show");
		$(document).off("scroll", showSection2);
	}
}

</script>