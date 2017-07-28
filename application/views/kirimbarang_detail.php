<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="image-viewer">
		<svg class="image-viewer-close-icon" fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</svg>
		<img onerror="this.onerror=null; this.src='<?php echo base_url("assets/panel/images/default.gif"); ?>';"/>
	</div>
	<div class="section-1">
		<div class="section-1a">
			<table class="table-section-1a">
				<tbody>
					<tr>
						<td class="td-label">Keterangan</td>
						<td class="td-titikdua">:</td>
						<td><?= $shipment_information ?></td>
					</tr>
					<tr>
						<td class="td-label">Pelanggan</td>
						<td class="td-titikdua">:</td>
						<td><a href="<?= base_url("profil/") . $shipment_user_id ?>"><?= $shipment_owner_username ?></a></td>
					</tr>
					<tr>
						<td class="td-label">Harga yang ditawarkan</td>
						<td class="td-titikdua">:</td>
						<td><?php echo ($shipment_price == 0) ? "Tidak ditentukan" : number_format($shipment_price, 0, ".", ",") . " IDR" ?></td>
					</tr>
					<tr>
						<td class="td-label">Penawaran terendah</td>
						<td class="td-titikdua">:</td>
						<td><?php echo ($bidding_price == 0) ? "Belum ada penawaran" : number_format($bidding_price, 0, ".", ",") . " IDR" ?></td>
					</tr>
					<tr>
						<td class="td-label">Tanggal Kirim</td>
						<td class="td-titikdua">:</td>
						<td><?= date_format(new DateTime($shipment_delivery_date_from), "d-m-Y H:i") ?> s/d <?= date_format(new DateTime($shipment_delivery_date_to), "d-m-Y H:i") ?></td>
					</tr>
					<tr>
						<td class="td-label">Berakhir</td>
						<td class="td-titikdua">:</td>
						<td><?= date_format(new DateTime($shipment_end_date), "d-m-Y H:i") ?></td>
					</tr>
					<tr>
						<td class="td-label">Dibuat Tanggal</td>
						<td class="td-titikdua">:</td>
						<td><?= date_format(new DateTime($created_date), "d-m-Y H:i") ?></td>
					</tr>
					<tr>
						<td class="td-label">Update terakhir</td>
						<td class="td-titikdua">:</td>
						<td><?= date_format(new DateTime($modified_date), "d-m-Y H:i") ?></td>
					</tr>
					<tr>
						<td class="td-label">Cara Pesan</td>
						<td class="td-titikdua">:</td>
						<td><?= $order_type_name ?></td>
					</tr>
				</tbody>
			</table>
			<div class="subsection">
				<div class="section-title">Item</div>
				<?php
				for ($i = 0; $i < sizeof($items); $i++)
				{	
					$item_dimension = "";
					if ($items[$i]["item_length"] != "") {
						$item_dimension = number_format($items[$i]["item_length"], 0, ".", ",") . " " . $items[$i]["item_dimension_unit"] . " X " . number_format($items[$i]["item_width"], 0, ".", ",") . " " . $items[$i]["item_dimension_unit"] . " X " . number_format($items[$i]["item_height"], 0, ".", ".") . " " . $items[$i]["item_dimension_unit"];
					}
					?>
					<div class="item">
						<table class="table-section-left">
							<tbody>
								<tr>
									<td class="td-item-label">Nama</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_name'] ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Deskripsi</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_desc'] ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Qty</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_qty'] ?></td>
								</tr>
							</tbody>
						</table>
						<table class="table-section-right">
							<tbody>
								<tr>
									<td class="td-item-label">Dimensi</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $item_dimension ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Total Kubikasi</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?php echo ($items[$i]['item_kubikasi'] == "") ? "" : number_format($items[$i]['item_kubikasi'], 0, ".", ",") ?>  <?php echo ($items[$i]['item_kubikasi_unit'] == "") ? "" : substr($items[$i]['item_kubikasi_unit'], 0, 2) . "&sup3" ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Total Berat</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?php echo ($items[$i]['item_weight'] == "") ? "" : number_format($items[$i]['item_weight'], 0, ".", ",") ?>  <?= $items[$i]['item_weight_unit'] ?></td>
								</tr>
							</tbody>
						</table>
					</div>
		<?php	}	?>
			</div>
		</div>
		<div class="section-1b">
			<div class="image-container">
				<img class="shipment_picture" src="<?= base_url("assets/panel/images/") . $shipment_pictures ?>" onerror="this.onerror=null; this.src='<?php echo base_url("assets/panel/images/default.gif"); ?>';"/>
			</div>
			<div class="asal">
				<div class="asal-title">Lokasi</div>
				<table class="table-lokasi">
					<tbody>
						<?php
							$detail_lokasi = false;
							if ($user_id && ($isOwner OR $expedition_id == $user_id)) {
								$detail_lokasi = true;
							}
						?>
						<tr>
							<td class="td-address-label">Asal</td>
							<td class="td-titikdua">:</td>
							<td><?php echo ($detail_lokasi) ? $location_from_address : $location_from_city; ?></td>
						</tr>
						<?php if ($detail_lokasi) { ?>
							<tr>
								<td class="td-address-label">Detail</td>
								<td class="td-titikdua">:</td>
								<td><?php echo $location_from_detail ?></td>
							</tr>
							<tr>
								<td class="td-address-label">Kontak</td>
								<td class="td-titikdua">:</td>
								<td><?php echo $location_from_contact ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<table class="table-lokasi">
					<tbody>
						<tr>
							<td class="td-address-label">Tujuan</td>
							<td class="td-titikdua">:</td>
							<td><?php echo ($detail_lokasi) ? $location_to_address : $location_to_city; ?></td>
						</tr>
						<?php if ($detail_lokasi) { ?>
							<tr>
								<td class="td-address-label">Detail</td>
								<td class="td-titikdua">:</td>
								<td><?php echo $location_to_detail ?></td>
							</tr>
							<tr>
								<td class="td-address-label">Kontak</td>
								<td class="td-titikdua">:</td>
								<td><?php echo $location_to_contact ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<table class="table-lokasi">
					<tbody>
						<tr>
							<td class="td-address-label">Jarak</td>
							<td class="td-titikdua">:</td>
							<td><?php echo number_format(intval($shipment_length), 0, ".", ",") ?> Km</td>
						</tr>
					</tbody>
				</table>
				<div class="form-group" id="map_asal" style="width: 100%; height: 200px"></div>
			</div>
			
		</div>
	
		
	</div>
	<div class="section-3">
		<div class="section-title">Diskusi</div>
		<div class="section-3-content">
			<div class="discussions"></div>
	<?php	if ($role_id == 2 && $shipment_status == -1) { ?>
			<div class="detail-pertanyaan">
				<div class="form-item">
					<div class="form-item-label">Pertanyaan</div>
					<textarea class="input-pertanyaan"></textarea>
				</div>
				<button class="btn-default btn-submit-pertanyaan">Submit Pertanyaan</button>
			</div>
	<?php	}	?>
			<div class="default-empty-state section-3-empty-state">Tidak ada diskusi</div>
		</div>
	</div>
	<div class="section-4">
		<div class="section-title">Penawaran</div>
		<?php
		if ($role_id == 2 && $shipment_status == -1) { ?>
			<button type="button" class="btn-default btn-tawar" disabled>Kirim Penawaran</button>
			<div class="detail-penawaran">
				<table class="table-detail-penawaran">
					<tbody>
						<tr>
							<td class="td-label">Jenis</td>
							<td class="td-titikdua"> : </td>
							<td>
								<label class="label-bidding-type"><input type="radio" class="input-bidding-type" name="input-bidding-type" value="1" checked="checked" /> Darat</label>
								<label class="label-bidding-type"><input type="radio" class="input-bidding-type" name="input-bidding-type" value="2" /> Laut</label>
								<div class="error penawaran-error error-bidding-type"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label">Harga</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-bidding-price" data-type="number" maxlength="11"/>
								<div class="error penawaran-error error-bidding-price"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label">Tanggal Ambil</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-bidding-pickupdate" />
								<div class="error penawaran-error error-bidding-pickupdate"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label td-label-list-kendaraan">Kendaraan</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-kendaraan" />
								<div class="error penawaran-error error-kendaraan"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label">Keterangan</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-bidding-information" />
								<div class="error penawaran-error error-bidding-information"></div>
							</td>
						</tr>
					</tbody>
				</table>
				<button type="button" class="btn-default btn-kirim-penawaran">Kirim Penawaran</button>
				<button type="button" class="btn-neutral btn-batal-kirim-penawaran">Batal</button>
				<div class="default-loading-container default-loading-container-kirim-penawaran">
					<div class="default-empty-state"></div>
				</div>
			</div>
<?php	}	?>
		<div class="table-list-penawaran-container">
			<table class='table table-list-penawaran'>
				<thead>
					<tr>
						<td class="td-harga">Harga</td>
						<td>Jenis</td>
						<td>Ekspedisi</td>
						<td>Detail</td>
						<td class="td-action">Status</td>
						<td class="td-tanggal">Tanggal Penawaran</td>
					</tr>
				</thead>
				<tbody class="tbody-list-penawaran">
				
				</tbody>
			</table>
			<div class="table-empty-state">Tidak ada penawaran</div>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-setuju">
		<div class="dialog-header">
			<div class="dialog-title">Setuju Bid</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-setuju">Setuju</button>
			<button type="button" class="btn-neutral btn-batal">Batal Setuju</button>
		</div>
		<div class="default-loading-container default-loading-container-setuju-penawaran">
			<div class="default-empty-state"></div>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-cancel-bidding">
		<div class="dialog-header">
			<div class="dialog-title">Batal Penawaran</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-cancel-bidding">Batalkan Penawaran</button>
			<button type="button" class="btn-neutral btn-batal">Tidak Jadi</button>
		</div>
		<div class="default-loading-container default-loading-container-cancel-bidding">
			<div class="default-empty-state"></div>
		</div>
	</div>
</div>
<script>
var map;
var marker;
var lat, lng, center_from;
var location_from_lat = <?= $location_from_lat ?>;
var location_from_lng = <?= $location_from_lng ?>;
var location_to_lat = <?= $location_to_lat ?>;
var location_to_lng = <?= $location_to_lng ?>;
var user_id;
var profilUrl = "<?= base_url("profil/") ?>";
var shipment_user_id = "<?= $shipment_user_id ?>";

var data_shipment_id = <?= $shipment_id ?>;

$(function() {
	getDiscussions();
	getBiddingList();

	$(".shipment_picture").on("click", function() {
		let src = $(this).attr("src");
		$(".image-viewer img").attr("src", src);
		$(".image-viewer").addClass("shown");
	});

	$(".image-viewer").on("click", function(e) {
		if (!$(e.target).is("img")) {
			$(this).removeClass("shown");
		}
	});
<?php
$btnJawabPertanyaan = "";
$detailJawabPertanyaan = "";
$divQuestions = "element += \"<div class='questions'>\";";
$tr_bidding = "";
$btnSetujuBidding = "";
$btnCancelBidding = "";

if ($role_id == 1 && $isOwner && $shipment_status == -1) { 
	$btnJawabPertanyaan = "element += \"<button class='btn-neutral btn-jawab-pertanyaan'>Jawab</button>\";";
	$detailJawabPertanyaan = "element += \"<div class='detail-jawab-pertanyaan'>\";" .
		"element += \"<textarea class='input-jawab-pertanyaan'></textarea>\";" .
		"element += \"<button class='btn-default btn-submit-jawab-pertanyaan'>Submit Jawaban</button>\";" .
		"element += \"</div>\";";
	$divQuestions = "element += \"<div class='questions' data-questions-id='\" + questions[i].questions_id + \"'>\";";

	$tr_bidding = "data-bidding_id='\" + result.data[i].bidding_id + \"'";
	$btnSetujuBidding = "element += \"";
	$btnSetujuBidding .= "<button class='btn-default btn-setuju'>Setuju</button>";
	$btnSetujuBidding .= "<button class='btn-negative btn-tolak'>Tolak</button>";
	$btnSetujuBidding .= "<div class='container-tolak'>";
	$btnSetujuBidding .= "<textarea class='input-alasan' data-bidding_id='\" + result.data[i].bidding_id + \"'></textarea>";
	$btnSetujuBidding .= "<button class='btn-negative btn-submit-tolak' data-bidding_id='\" + result.data[i].bidding_id + \"'>Tolak</button>";
	$btnSetujuBidding .= "<button class='btn-neutral btn-batal-tolak'>Batal Tolak</button>";
	$btnSetujuBidding .= "</div>";
	$btnSetujuBidding .= "\";";
?>
	
	$(document).on("click", ".btn-tolak", function() {
		showAlasanTolak(this);
	});
	
	$(document).on("click", ".btn-batal-tolak", function() {
		hideAlasanTolak(this);
	});
	
	$(document).on("click", ".btn-submit-tolak", function() {
		submitTolak(this);
	});
	
	$(document).on("click", ".btn-jawab-pertanyaan", function() {
		showDetailJawabPertanyaan(this);
	});
	
	$(document).on("click", ".btn-submit-jawab-pertanyaan", function() {
		jawabPertanyaan(this);
	});
	
	$(document).on("click", ".btn-setuju", function() {
		
		var tr_bidding = $(this).closest(".tr-bidding");
		var bidding_id = $(tr_bidding).data("bidding_id");
		var username = $(tr_bidding).children(".td-bidding-username").html();
		var harga = $(tr_bidding).children(".td-bidding-price").html();
		var text = "Setuju penawaran " + username + " seharga " + harga + "?";
		
		$(".dialog-konfirmasi-setuju").data("bidding_id", bidding_id);
		$(".dialog-konfirmasi-setuju .dialog-body").html(text);
		showDialog(".dialog-konfirmasi-setuju");
	});
	
	$(".btn-submit-setuju").on("click", function() {
		setujuBidding(this);
	});
	
	function setujuBidding(element) {
		setLoading(".default-loading-container-setuju-penawaran");
		var bidding_id = $(element).closest(".dialog-konfirmasi-setuju").data("bidding_id");
		var shipment_id = data_shipment_id;
		var form = "<form action='<?= base_url("kirim/setujuPenawaran") ?>' method='POST'>";
		var input_shipment = "<input type='hidden' name='shipment_id' value='" + shipment_id + "' />";
		var input_bidding = "<input type='hidden' name='bidding_id' value='" + bidding_id + "' />";
		form += "</form>";
		
		$("<form>", {
			"action": "<?= base_url("kirim/setujuPenawaran") ?>",
			"method": "POST",
			"html": input_shipment + input_bidding
		}).appendTo(document.body).submit();
		
		//$(form).appendTo("body").submit();
	}
	
	function jawabPertanyaan(element) {
		var discussions_item = $(element).closest(".discussions-item");
		var questions_id = $(discussions_item).children(".questions").data("questions-id");
		var answers_text = $(discussions_item).find("textarea").val();
		
		if (answers_text != "") {
			$(".discussions").html("");
			setLoading(".section-3-content .default-empty-state");

			var data = {
				submit_jawaban: true,
				questions_id: questions_id,
				answers_text: answers_text
			};
			ajaxCall("<?= base_url("kirim/jawabPertanyaan") ?>", data, function(result) {
				if (result == "success") {
					getDiscussions(false);
				}
			});
		} else {
			alert("Jawaban tidak boleh kosong");
			$(discussions_item).find("textarea").select();
		}
	}
	
	function showDetailJawabPertanyaan(element) {
		$(".detail-jawab-pertanyaan").css("display", "none");
		var detailJawabPertanyaan = $(element).closest(".discussions-item").children(".detail-jawab-pertanyaan");
		$(detailJawabPertanyaan).css("display", "block");
		$(detailJawabPertanyaan).children("textarea").select();
	}
	
	function closeDetailJawabPertanyaan() {
		$(".detail-jawab-pertanyaan").css("display", "none");
	}
	
	function submitTolak(element) {
		$(".tbody-list-penawaran").html("");
		setLoading(".table-list-penawaran-container .table-empty-state");

		var bidding_id = $(element).data("bidding_id");
		var bidding_reason = $(element).siblings(".input-alasan").val();
		
		var data = {
			submit_tolak: true,
			bidding_id: bidding_id,
			bidding_reason: bidding_reason
		};
		ajaxCall("<?= base_url("kirim/tolakPenawaran") ?>", data, function(result) {
			if (result == "success") {
				getBiddingList(false);
			}
		});
	}
	
	function showAlasanTolak(element) {
		$(element).next().css("display", "block");
		$(element).next().children(".input-alasan").select();
	}
	
	function hideAlasanTolak(element) {
		$(element).parent().css("display", "none");
	}
<?php
} else if ($role_id == 2 && $shipment_status == -1) {
	$tr_bidding = "data-bidding_id='\" + result.data[i].bidding_id + \"'";

	$btnCancelBidding = "if (user_id == result.data[i].user_id) {";
	$btnCancelBidding .= "element += \"";
	$btnCancelBidding .= "<button class='btn-negative btn-cancel-bidding'>Batalkan</button>";
	$btnCancelBidding .= "\";";
	$btnCancelBidding .= "}";
	?>
	user_id = <?= $this->session->userdata("user_id") ?>;
	var detailPenawaranShown = false;
	
	$(document).on("click", ".btn-tawar", function() {
		showDetailPenawaran(this);
	});

	$(".input-bidding-type").on("change", function() {
		var value = $(this).val();
		if (value == "1") {
			$(".td-label-list-kendaraan").html("Kendaraan");
		} else {
			$(".td-label-list-kendaraan").html("Kapal");
		}
	});
	
	$(".input-bidding-price").on("keydown", function(e) {
		isNumber(e);
	});
	
	$(document).on("click", ".btn-batal-kirim-penawaran", function() {
		hideDetailPenawaran();
	});
	
	$(document).on("keydown", "input[data-type='number']", function(e) {
		isNumber(e);
	});
	
	$( ".input-bidding-pickupdate" ).datepicker({
		disableDateBefore: new Date()
	});
	
	$(document).on("click", ".btn-kirim-penawaran", function() {
		kirimPenawaran();
	});
	
	$(".btn-submit-pertanyaan").on("click", function() {
		kirimPertanyaan();
	});

	$(document).on("input", ".input-bidding-price", function() {
		var value = $(this).val().replace(/,/g, "");
		value = addCommas(value);
		$(this).val(value);
	});

	$(document).on("click", ".btn-cancel-bidding", function() {
		var trBidding = $(this).closest(".tr-bidding");
		var bidding_id = $(trBidding).data("bidding_id");
		$(".dialog-konfirmasi-cancel-bidding").data("id", bidding_id);
		var bidding_price = $(trBidding).find(".td-bidding-price").data("value");
		var bidding_type = $(trBidding).find(".td-bidding-type").data("value");
		var bidding_information = $(trBidding).find(".td-bidding-tanggal-ambil").html();
		var text = "Penawaran : <br>Harga : " + addCommas(bidding_price) + " IDR<br>Tipe : " + bidding_type + "<br>" + bidding_information;
		$(".dialog-konfirmasi-cancel-bidding .dialog-body").html(text);
		showDialog(".dialog-konfirmasi-cancel-bidding");
	});

	$(document).on("click", ".btn-submit-cancel-bidding", function() {
		cancelBidding();
	});

	function cancelBidding() {
		setLoading(".default-loading-container-cancel-bidding");
		var bidding_id = $(".dialog-konfirmasi-cancel-bidding").data("id");
		ajaxCall("<?= base_url("kirim/cancelBidding") ?>", {bidding_id: bidding_id}, function(result) {
			if (result == "success") {
				location.reload();
			} else {
				removeLoading(".default-loading-container-cancel-bidding");
				alert(result);
			}
		});
	}
	
	function kirimPertanyaan() {
		var questions_text = $(".input-pertanyaan").val();
		var shipment_id = data_shipment_id;
		
		if (questions_text != "") {
			$(".detail-pertanyaan").css("display", "none");
			$(".discussions").html("");
			setLoading(".section-3-content .default-empty-state");

			var data = {
				submit_pertanyaan: true,
				questions_text: questions_text,
				shipment_id: shipment_id
			};
			ajaxCall("<?= base_url("kirim/kirimPertanyaan") ?>", data, function(result) {
				$(".detail-pertanyaan").css("display", "block");
				if (result == "success") {
					clearQuestion();
					getDiscussions(false);
				}
			});
		} else {
			alert("Pertanyaan tidak boleh kosong");
			$(".input-pertanyaan").select();
		}
	}
	
	function clearQuestion() {
		$(".input-pertanyaan").val("");
	}
	
	function getKendaraan() {
		ajaxCall("<?= base_url("kirim/getKendaraan") ?>", null, function(json) {
			var result = jQuery.parseJSON(json);
			addKendaraanToOption(result);
		});
	}
	
	function addKendaraanToOption(result) {
		var element = "";
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			element += "<option value='" + result[i].vehicle_id + "'>" + result[i].vehicle_name + "</option>";
		}
		$(".input-kendaraan").html("");
		$(".input-kendaraan").append(element);
	}
	
	function showDetailPenawaran(element) {
		$(element).css("display", "none");
		$(".detail-penawaran").css("display", "block");
		$(".input-bidding-price").select();
	}
	
	function hideDetailPenawaran() {
		$(".btn-tawar").css("display", "block");
		$(".detail-penawaran").css("display", "none");
		clearErrors();
	}
	
	function kirimPenawaran() {
		var bidding_type = $(".input-bidding-type:checked").val();
		var bidding_price = $(".input-bidding-price").val().replace(/,/g, "");
		var bidding_pickupdate = $(".input-bidding-pickupdate").val();
		var bidding_vehicle = $(".input-kendaraan").val();
		var bidding_information = $(".input-bidding-information").val();
		
		var data = {
			bidding_type: bidding_type,
			bidding_price: bidding_price,
			bidding_pickupdate: bidding_pickupdate,
			bidding_vehicle: bidding_vehicle,
			bidding_information: bidding_information
		};
		var valid = cekInputPenawaran(data);
		
		if (valid) {
			setLoading(".default-loading-container-kirim-penawaran");
			var shipment_id = data_shipment_id;
			var user_id = <?= $user_id ?>;
			data = {
				submit_bid: true,
				bidding_type: bidding_type,
				bidding_price: bidding_price,
				bidding_pickupdate: bidding_pickupdate,
				bidding_information: bidding_information,
				shipment_id: shipment_id,
				user_id: user_id
			};
			ajaxCall("<?= base_url("kirim/kirimPenawaran") ?>", data, function(result) {
				removeLoading(".default-loading-container-kirim-penawaran");
				if (result == "success") {
					$(".btn-tawar").prop("disabled", true);
					hideDetailPenawaran();
					getBiddingList();
				}
			});
		}
	}
	
	function cekInputPenawaran(data) {
		clearErrors();
		
		var valid = true;
		if (data.bidding_price == "") {
			valid = false;
			$(".error-bidding-price").html("Harga harus diisi");
		}
		if (data.bidding_pickupdate == "") {
			valid = false;
			$(".error-bidding-pickupdate").html("Tanggal Ambil harus diisi");
		}
		if (data.bidding_vehicle == "") {
			valid = false;
			$(".error-kendaraan").html("Kendaraan harus diisi");
		}
		return valid;
	}
	
	function clearErrors() {
		$(".error").html("");
	}
	
<?php } ?>
});

function getDiscussions(load = true) {
	if (load) {
		$(".discussions").html("");
		setLoading(".section-3-content .default-empty-state");
	}

	var shipment_id = data_shipment_id;
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall("<?= base_url("kirim/getDiscussions") ?>", data, function(json) {
		removeLoading(".section-3-content .default-empty-state");
		var result = jQuery.parseJSON(json);
		addDiscussionToTable(result);
	});
}

function addDiscussionToTable(result) {
	var questions = result.questions;
	var iLength = questions.length;
	var element = "";
	for (var i = 0; i < iLength; i++) {
		var icon = (questions[i].user_verified == 0) ? "" : "<span class='verified-icon' style='background-image: url(" + verifiedIconUrl + ");'><div></div></span>";

		element += "<div class='discussions-item'>";
		<?= $divQuestions ?>
		element += "<div class='questions-user-id'><a href='" + profilUrl + questions[i].user_id + "'>" + questions[i].username + "</a>" + icon + "</div>";
		element += "<div class='questions-text'>" + questions[i].questions_text + "</div>";
		<?= $btnJawabPertanyaan ?>
		element += "<div class='discussion-item-time'>" + questions[i].created_date + "</div>";
		element += "</div>";
		
		var answers = result.answers[i];
		var jLength = answers.length;
		for (var j = 0; j < jLength; j++) {
			element += "<div class='answers'>";
			element += "<div class='answers-user-id'><a href='" + profilUrl + shipment_user_id + "'><?= $shipment_owner_username ?></a></div>";
			element += "<div class='answers-text'>" + answers[j].answers_text + "</div>";
			element += "<div class='discussion-item-time'>" + answers[j].created_date + "</div>";
			element += "</div>";
		}
		<?= $detailJawabPertanyaan ?>
		element += "</div>";
	}
	
	if (iLength == 0) {
		$(".section-3-content .default-empty-state").addClass("shown");
	} else {
		$(".section-3-content .default-empty-state").removeClass("shown");
	}
	
	$(".discussions").html(element);
}

function getBiddingList(load = true) {
	if (load) {
		$(".tbody-list-penawaran").html("");
		setLoading(".table-list-penawaran-container .table-empty-state");
	}
	var shipment_id = data_shipment_id;
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall("<?= base_url("kirim/getBiddingList") ?>", data, function(json) {
		removeLoading(".table-list-penawaran-container .table-empty-state");
		var result = jQuery.parseJSON(json);
		addBiddingListToTable(result);
	});
}

function addBiddingListToTable(result) {
	var iLength = result.data.length;
	var element = "";
	for (var i = 0; i < iLength; i++) {
		var bidding_type = "Darat";
		if (result.data[i].bidding_type == 2) {
			bidding_type = "Laut";
		}
		
		var icon = (result.data[i].user_verified == 0) ? "" : "<span class='verified-icon' style='background-image: url(" + verifiedIconUrl + ");'></span>";
		
		element += "<tr class='tr-bidding' data-status='" + result.data[i].bidding_status + "' <?= $tr_bidding ?>>";
		element += "<td class='td-bidding-price' data-value='" + result.data[i].bidding_price + "'>" + addCommas(result.data[i].bidding_price) + " IDR</td>";
		element += "<td class='td-bidding-type' data-value='" + bidding_type + "'>" + bidding_type + "</td>";
		element += "<td class='td-bidding-username'><a href='" + profilUrl + result.data[i].user_id + "'>" + result.data[i].username + "</a>" + icon + "</td>";
		element += "<td class='td-bidding-tanggal-ambil'>";
		element += "<div>Tanggal Ambil : " + result.data[i].bidding_pickupdate + "</div>";
		element += "<div>Keterangan : " + result.data[i].bidding_information + "</div>";
		element += "</td>";
		element += "<td>";
		if (result.data[i].bidding_status == 1) {
			element += "DITERIMA <span class='bidding-tanggal-batal'>" + result.data[i].modified_date + "</span>";
		}
		else if (result.data[i].bidding_status == 2) {
			element += "<div class='alasan-tolak'>DITOLAK <span class='bidding-tanggal-batal'>" + result.data[i].modified_date + "</span><br><strong>Alasan : </strong>" + result.data[i].bidding_reason + "</div>";
		} else if (result.data[i].bidding_status == -1) {
			element += "DIBATALKAN <span class='bidding-tanggal-batal'>" + result.data[i].modified_date + "</span>";
		} else {
		<?= $btnSetujuBidding ?>
		<?= $btnCancelBidding ?>
		}
		element += "</td>";
		element += "<td>" + result.data[i].created_date + "</td>";
		element += "</tr>";
	}

	if (iLength == 0) {
		$(".table-list-penawaran-container .table-empty-state").addClass("shown");
	} else {
		$(".table-list-penawaran-container .table-empty-state").removeClass("shown");
	}
	
	$(".tbody-list-penawaran").html(element);
	if (result["canBid"]) {
		$(".btn-tawar").prop("disabled", false);
	}
}

function initMap() {	
	lat = location_from_lat;
	lng = location_from_lng;
	center_from = {lat: lat, lng: lng};
	
	map = new google.maps.Map(document.getElementById('map_asal'), {
		scrollwheel: false,
		disableDoubleClickZoom: true,
		draggable: false,
		panControl: false,
		clickableIcons: false,
		streetViewControl: false,
		disableDefaultUI: true
	});
	
	map.addListener("click", function(e) {
		return false;
	});

	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
	directionsDisplay.setMap(map);
	calculateAndDisplayRoute(directionsService, directionsDisplay);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	directionsService.route({
		origin: new google.maps.LatLng(location_from_lat, location_from_lng),
		destination: new google.maps.LatLng(location_to_lat, location_to_lng),
		travelMode: "DRIVING"
	}, function(response, status) {
		if (status === "OK") {
			directionsDisplay.setDirections(response);
		} else {
			if (status != "ZERO_RESULTS") {
				alert(status);
			}
		}
	});
}
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCt0M5ZsAQf8_sLJXsviGEOJHQn15QUKXM&callback=initMap" async defer></script>
</div>
</div>