<div class="content">
	<div class="section-1">
		<div class="section-1-image" style="background-image: url('<?= base_url("assets/front/images/ekspedisi.jpg") ?>');"></div>
		<div class="section-1-text">
			<div class="section-1-title">KENDARAAN ANDA MENJADI LEBIH EFISIEN DAN EFEKTIF</div>
			<div class="section-1-description">Isi kekosongan tempat dalam kendaraan serta tambah potensi pengiriman muatan Anda.</div>
			<a href="<?= base_url("register#pemilik-kendaraan") ?>" class="btn btn-daftar">DAFTAR SEKARANG</a>
		</div>
	</div>
	<div class="section-2">
		<div class="section-title">Bagaimana Caranya ?</div>
		<div class="section-content">
			<div class="section-2-step step-1">
				<div class="section-2-step-description"></div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/list-black-round.svg") ?>');"></div>
				<div class="section-2-step-description">1. Cari kiriman barang yang sesuai</div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-2">
				<div class="section-2-step-description">2. Kirim penawaran</div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/price-tag.svg") ?>');"></div>
				<div class="section-2-step-description"></div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-3">
				<div class="section-2-step-description"></div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_check_circle_black_24dp_2x.png") ?>');"></div>
				<div class="section-2-step-description">3. Konfirmasi kiriman yang telah disepakati</div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-4">
				<div class="section-2-step-description">4. Ubah status kiriman sesuai dengan posisi kendaraan</div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/ic_place_black_24px.svg") ?>');"></div>
				<div class="section-2-step-description"></div>
			</div>
			<div class="section-2-vertical-line"></div>
			<div class="section-2-step step-5">
				<div class="section-2-step-description"></div>
				<div class="section-2-step-icon" style="background-image: url('<?= base_url("assets/icons/delivery-truck.svg") ?>');"></div>
				<div class="section-2-step-description">5. Kirimkan barang sampai di lokasi dan selesai</div>
			</div>
		</div>
	</div>
</div>
<script>
var section2Top = 0;
var scrollTop = 0, showOffset = 300;
var innerHeight = window.innerHeight;
$(function() {
	initialize();

	$(document).on("scroll", function() {
		scrollTop = window.scrollY;
	});

	$(document).on("scroll", showSection2);
});

function initialize() {
	if (isMobile) {
		showOffset = 150;
	}
	scrollTop = window.scrollY;
	section2Top = $(".section-2").offset().top;
	
	showSection2();
}

function showSection2() {
	var section2 = section2Top - scrollTop;
	if (section2 < innerHeight - showOffset) {
		$(".section-2 .section-content").addClass("show");
		$(document).off("scroll", showSection2);
	}
}

</script>