var section1Top = 0, section2Top = 0, section3Top = 0, section4Top = 0;
$(function() {
	section2Top = $(".section-2").offset().top - 70;
	section3Top = $(".section-3").offset().top - 70;
	section4Top = $(".section-4").offset().top - 70;

	$(".input-tanggal-kirim-awal").datepicker({
		disableDateBefore: new Date()
	});
	$(".input-tanggal-kirim-akhir").datepicker({
		disableDateBefore: new Date()
	});
	$(".input-tanggal-deadline").datepicker({
		disableDateBefore: new Date()
	});

	$(".input-tanggal-kirim-awal").on("datetimeSelected", function() {
		var value = $(this).data("value-date");
		var date = new Date(value);

		var firstValue;
		var akhirValue = $(".input-tanggal-kirim-akhir").data("value-date");
		if (akhirValue != "") {
			var akhirDate = new Date(akhirValue);
			if (akhirDate >= date) {
				var akhirValueTime = $(".input-tanggal-kirim-akhir").data("value-time");
				firstValue = akhirValue + " " + akhirValueTime;
			}
		}

		$(".input-tanggal-kirim-akhir").datepicker({
			disableDateBefore: date,
			firstValue: firstValue
		});

		firstValue = null;
		var berakhirValue = $(".input-tanggal-deadline").data("value-date");
		if (berakhirValue != "") {
			var berakhirDate = new Date(berakhirValue);
			if (berakhirDate <= date) {
				var berakhirValueTime = $(".input-tanggal-deadline").data("value-time");
				firstValue = berakhirValue + " " + berakhirValueTime;
			}
		}

		$(".input-tanggal-deadline").datepicker({
			disableDateAfter: date,
			firstValue: firstValue
		});
	});

	$(".input-tanggal-kirim-awal").on("datetimeOkSelected", function() {
		if ($(this).val() != "") {
			var akhirValue = $(".input-tanggal-kirim-akhir").data("value-date");
			if (akhirValue == "") {
				$(".input-tanggal-kirim-akhir").focus();
			}
		}
	});

	$(".input-tanggal-kirim-akhir").on("datetimeOkSelected", function() {
		if ($(this).val() != "") {
			var berakhirValue = $(".input-tanggal-deadline").data("value-date");
			if (berakhirValue == "") {
				$(".input-tanggal-deadline").focus();
			}
		}
	});

	$(".section-5-left input").on("datetimeShow", function() {
		$(this).addClass("focus");
	});

	$(".section-5-left input").on("datetimeHidden", function() {
		$(this).removeClass("focus");
	});

	$(".btn-show-tambah-barang").on("click", function() {
		if ($(".section-3").css("display") == "none") {
			$(".section-3").css("display", "block");
		} else {
			$(".section-3").css("display", "none");
		}
	});
	
	$(document).on("keypress", function(e) {
		if (e.which == 13) { //ENTER
			e.preventDefault();
		}
	});
	
	$("input[type='radio'][name='pilihan-pengisian']").on("change", function() {
		var value = $(this).data("value");
		clearPilihanError();
		$(".pilihan[data-checked='1']").removeAttr("data-checked");
		switch (value) {
			case 1:
				$(".pilihan-dimensi").attr("data-checked", "1");
				$(".pilihan-berat").attr("data-checked", "1");
				break;
			case 2:
				$(".pilihan-kubikasi").attr("data-checked", "1");
				$(".pilihan-berat").attr("data-checked", "1");
				break;
			case 3:
				$(".pilihan-kubikasi").attr("data-checked", "1");
				break;
			case 4:
				$(".pilihan-berat").attr("data-checked", "1");
				break;
		}
	});
	
	$(".saved-location").on("click", function(e) {
		toggleSavedLocation(this);
		e.stopPropagation();
	});
	
	$(document).on("click", function(e) {
		if ($(e.target).attr("class") !== "saved-location-container") {
			$(".saved-location-container").css("display", "none");
		}
	});
	
	$(document).on("click", ".saved-location-item", function() {
		var fromto = $(this).data("fromto");
		var detail = $(this).data("detail");
		var contact = $(this).data("contact");
		var name = $(this).html();
		var lat = $(this).data("lat");
		var lng = $(this).data("lng");
		var latlng = new google.maps.LatLng(lat,lng);
		
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === "OK") {
				var city = getCityFromPlace(results[0]);
				var formatted_address = results[0].formatted_address;
				
				$("#location_" + fromto + "_address").val(name + ", " + formatted_address);
				$("#location_" + fromto + "_name").val(name);
				$("#location_" + fromto + "_city").val(city);
				$("#location_" + fromto + "_detail").val(detail);
				$("#location_" + fromto + "_contact").val(contact);
				get_lat_long('location', latlng, "location_" + fromto + "_latlng");

				if (fromto == "from") {
					var to_address = $("#location_to_address").val();
					if (to_address != "") {
						var to_latlng = $("#location_to_latlng").val().split(",");
						var to_lat = parseFloat(to_latlng[0]);
						var to_lng = parseFloat(to_latlng[1]);
						
						to_latlng = new google.maps.LatLng(to_lat, to_lng);
						callDistanceMatrixService(latlng, to_latlng);
					}
				} else {
					var from_address = $("#location_from_address").val();
					if (from_address != "") {
						var from_latlng = $("#location_from_latlng").val().split(",");
						var from_lat = parseFloat(from_latlng[0]);
						var from_lng = parseFloat(from_latlng[1]);
						
						from_latlng = new google.maps.LatLng(from_lat, from_lng);
						callDistanceMatrixService(latlng, from_latlng);
					}
				}
			}
		});
	});
	
	$(".input-gambar").on("change", function() {
		var reader = new FileReader();
		reader.onload = function(e) {
			$(".image-preview").attr("src", e.target.result);
		};
		reader.readAsDataURL($(this)[0].files[0]);
	});
	
	$(document).on("click", "table .btn-remove-item", function() {
		var no = $(this).data("no");
		$(".section-4-table tr[data-no='" + no + "']").remove();
		var count = parseInt($(".detail-count").val());
		$(".detail-count").val((count - 1));
	});
	
	$("input[data-type='number']").on("keydown", function(e) {
		isNumber(e);
	});

	$(".input-harga").on("input", function() {
		var value = $(this).val().replace(/,/g, "");
		value = addCommas(value);
		$(this).val(value);
	});
	
	$(".btn-submit").on("click", function(e) {
		clearAllErrors();
		
		var valid = true;
		var judul = $(".input-judul").val().trim();
		if (judul == "") {
			$(".input-judul").next().html("Judul harus diisi");
			if (valid) $(".container-content").scrollTop(section1Top);
			valid = false;
		}
		var keterangan = $(".input-keterangan").val().trim();
		if (keterangan == "") {
			$(".input-keterangan").next().html("Keterangan harus diisi");
			if (valid) $(".container-content").scrollTop(section1Top);
			valid = false;
		}
		var lokasi_awal = $("#location_from_address").val().trim();
		var location_from_name = $("#location_from_name").val().trim();
		if (lokasi_awal == "") {
			$("#location_from_address").next().html("Lokasi Asal harus diisi");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		} else if (location_from_name == "") {
			$("#location_from_address").next().html("Lokasi Asal harus dipilih dari Google Maps");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		}
		var detail_awal = $("#location_from_detail").val().trim();
		if (detail_awal == "") {
			$("#location_from_detail").next().html("Detail Lokasi harus diisi");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		}
		var kontak_awal = $("#location_from_contact").val().trim();
		if (kontak_awal == "") {
			$("#location_from_contact").next().html("Kontak harus diisi");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		}
		var lokasi_tujuan = $("#location_to_address").val().trim();
		var location_to_name = $("#location_to_name").val().trim();
		if (lokasi_tujuan == "") {
			$("#location_to_address").next().html("Lokasi Tujuan harus diisi");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		} else if (location_to_name == "") {
			$("#location_to_address").next().html("Lokasi Tujuan harus dipilih dari Google Maps");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		}
		var detail_tujuan = $("#location_to_detail").val().trim();
		if (detail_tujuan == "") {
			$("#location_to_detail").next().html("Detail Lokasi harus diisi");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		}
		var kontak_tujuan = $("#location_to_contact").val().trim();
		if (kontak_tujuan == "") {
			$("#location_to_contact").next().html("Kontak harus diisi");
			if (valid) $(".container-content").scrollTop(section2Top);
			valid = false;
		}
		var itemCount = parseInt($(".detail-count").val());
		if (itemCount == 0) {
			$(".section-4-content").next().html("List Barang harus diisi");
			if (valid) $(".container-content").scrollTop(section4Top);
			valid = false;
		}
		var tanggal_kirim = $(".input-tanggal-kirim-awal").val();
		if (tanggal_kirim == "") {
			valid = false;
			$(".input-tanggal-kirim-awal").next().html("Tanggal harus diisi");
		}
		var sampai_dengan = $(".input-tanggal-kirim-akhir").val();
		if (sampai_dengan == "") {
			valid = false;
			$(".input-tanggal-kirim-akhir").next().html("Tanggal harus diisi");
		}
		var berakhir = $(".input-tanggal-deadline").val();
		if (berakhir == "") {
			valid = false;
			$(".input-tanggal-deadline").next().html("Tanggal harus diisi");
		}

		var harga = $(".input-harga").val();
		var shipment_type = $(".radio-shipment-type:checked").data("text");
		
		e.preventDefault();

		if (valid) {
			var data = {
				judul: judul,
				keterangan: keterangan,
				lokasi_awal: lokasi_awal,
				detail_awal: detail_awal,
				kontak_awal: kontak_awal,
				lokasi_tujuan: lokasi_tujuan,
				detail_tujuan: detail_tujuan,
				kontak_tujuan: kontak_tujuan,
				tanggal_kirim: tanggal_kirim,
				sampai_dengan: sampai_dengan,
				berakhir: berakhir,
				harga: harga,
				shipment_type: shipment_type
			};
			getGroupIds(data);
		}
	});

	$("#kirimForm").on("submit", function() {
		showFullscreenLoading();
		var harga = $(".input-harga").val().replace(/,/g, "");
		$(".input-harga").val(harga);
		var group_id = $(".select-group").val();
		$(this).append("<input type='hidden' name='group_id' value='" + group_id + "' />");
	});

	$(".btn-submit-submit").on("click", function() {
		$("#kirimForm").submit();
	});

	$(".select-group").on("change", function() {
		var value = $(this).val();
		if (value == 0) {
			$(".btn-submit-submit").prop("disabled", true);
		} else {
			$(".btn-submit-submit").prop("disabled", false);
		}
	});
});

function getGroupIds(data) {
	showFullscreenLoading();
	ajaxCall(getGroupIdsUrl, null, function(json) {
		hideFullscreenLoading();
		var result = jQuery.parseJSON(json);
		var dialog = $(".dialog-konfirmasi-submit");
		dialog.find(".dialog-value[data-label='judul']").html(data.judul);
		dialog.find(".dialog-value[data-label='keterangan']").html(data.keterangan);
		dialog.find(".dialog-image").attr("src", $(".image-preview").attr("src"));
		dialog.find(".dialog-value[data-label='nama-lokasi-asal']").html(data.lokasi_awal);
		dialog.find(".dialog-value[data-label='detail-lokasi-asal']").html(data.detail_awal);
		dialog.find(".dialog-value[data-label='kontak-asal']").html(data.kontak_awal);
		dialog.find(".dialog-value[data-label='nama-lokasi-tujuan']").html(data.lokasi_tujuan);
		dialog.find(".dialog-value[data-label='detail-lokasi-tujuan']").html(data.detail_tujuan);
		dialog.find(".dialog-value[data-label='kontak-tujuan']").html(data.kontak_tujuan);
		dialog.find(".dialog-value[data-label='tanggal-kirim']").html(data.tanggal_kirim);
		dialog.find(".dialog-value[data-label='sampai-dengan']").html(data.sampai_dengan);
		dialog.find(".dialog-value[data-label='berakhir-tanggal']").html(data.berakhir);
		var harga = data.harga;
		if (harga != "") {
			harga += " IDR";
		}
		dialog.find(".dialog-value[data-label='harga']").html(harga);
		dialog.find(".dialog-value[data-label='tipe-penawaran']").html(data.shipment_type);
		$(".btn-submit-submit").prop("disabled", true);
		var element = "<option value='0'>Pilih Group...</option>";
		for (var i = 0; i < result.length; i++) {
			var group_name = (result[i].group_name != "") ? result[i].group_name : "default";
			element += "<option value='" + result[i].group_id + "'>" + group_name + "</option>";
		}
		dialog.find(".select-group").html(element);
		showDialog(".dialog-konfirmasi-submit");
	});
}

function toggleSavedLocation(element) {
	var container = $(element).next();
	if ($(container).css("display") == "none") {
		$(container).css("display", "block");
		var fromto = $(element).data("fromto");
		var itemFromto = "from";
		if (fromto == "location_to") {
			itemFromto = "to";
		}
		ajaxCall(toggleSavedLocationUrl, {fromto: fromto}, function(json) {
			var result = jQuery.parseJSON(json);
			var item = "";
			var iLength = result.length;
			for (var i = 0; i < iLength; i++) {
				item += "<div class='saved-location-item' data-detail='" + result[i].location_detail + "' data-contact='" + result[i].location_contact + "' data-fromto='" + itemFromto + "' data-lat='" + result[i].location_lat + "' data-lng='" + result[i].location_lng + "'>" + result[i].location_name + "</div>";
			}
			
			if (iLength == 0) {
				item = "<div class='saved-location-empty-state'>Tidak ada lokasi yang didaftarkan</div>";
			}
			
			$(container).html("");
			$(container).append(item);
		});
	} else {
		$(container).css("display", "none");
	}
}
	
function addItem() {
	valid = true;
	clearAllErrors();
	
	var nama = $(".input-nama-barang").val();
	var qty = $(".input-qty-barang").val();
	var deskripsi = $(".input-deskripsi-barang").val();
	var panjang, lebar, tinggi, dimensi_satuan, kubikasi, kubikasi_satuan, berat, berat_satuan;
	var select_dimensi = "", select_kubikasi = "", select_berat = "";
	
	if (nama == "") {
		error.nama = "Nama harus diisi";
		valid = false;
	}
	if (qty == "") {
		error.qty = "Qty harus diisi";
		valid = false;
	}
	if (deskripsi == "") {
		error.deskripsi = "Deskripsi harus diisi";
		valid = false;
	}
	
	var checked = $("input[name='pilihan-pengisian']:checked").data("value");
	switch (checked) {
		case 1:
			panjang = parseInt($(".input-panjang-barang").val().trim()) || 0;
			lebar = parseInt($(".input-lebar-barang").val().trim()) || 0;
			tinggi = parseInt($(".input-tinggi-barang").val().trim()) || 0;
			dimensi_satuan = $(".input-satuan-dimensi-barang").val();
			select_dimensi = panjang + " " + dimensi_satuan + "<br>" + lebar + " " + dimensi_satuan + "<br>" + tinggi + " " + dimensi_satuan;
			
			if (panjang == 0 || lebar == 0 || tinggi == 0) {
				valid = false;
				error.dimensi = "Panjang, Lebar, dan Tinggi harus diisi";
			}

			berat = parseInt($(".input-berat-barang").val().trim()) || 0;
			berat_satuan = $(".input-satuan-berat-barang").val();
			select_berat = berat + " " + berat_satuan;
			if (berat == 0) {
				valid = false;
				error.berat = "Berat harus diisi";
			}
			
			break;
		case 2:
			kubikasi = parseInt($(".input-kubikasi-barang").val().trim()) || 0;
			kubikasi_satuan = $(".input-satuan-kubikasi-barang").val();
			select_kubikasi = kubikasi + " " + kubikasi_satuan;
			if (kubikasi == 0) {
				valid = false;
				error.kubikasi = "Kubikasi harus diisi";
			}

			berat = parseInt($(".input-berat-barang").val().trim()) || 0;
			berat_satuan = $(".input-satuan-berat-barang").val();
			select_berat = berat + " " + berat_satuan;
			if (berat == 0) {
				valid = false;
				error.berat = "Berat harus diisi";
			}

			break;
		case 3:
			kubikasi = parseInt($(".input-kubikasi-barang").val().trim()) || 0;
			kubikasi_satuan = $(".input-satuan-kubikasi-barang").val();
			select_kubikasi = kubikasi + " " + kubikasi_satuan;
			if (kubikasi == 0) {
				valid = false;
				error.kubikasi = "Kubikasi harus diisi";
			}

			break;
		case 4:
			berat = parseInt($(".input-berat-barang").val().trim()) || 0;
			berat_satuan = $(".input-satuan-berat-barang").val();
			select_berat = berat + " " + berat_satuan;
			if (berat == 0) {
				valid = false;
				error.berat = "Berat harus diisi";
			}

			break;
	}
	
	showErrors();
	
	if (valid) {
		var count = parseInt($(".detail-count").val());
		
		var input_nama = "<input type='hidden' value='" + nama + "' name='item-name-" + count + "' />";
		var input_qty = "<input type='hidden' value='" + qty + "' name='item-qty-" + count + "' />";
		var input_deskripsi = "<input type='hidden' value='" + deskripsi + "' name='item-deskripsi-" + count + "' />";
		
		var input_panjang = "", input_lebar = "", input_tinggi = "", input_dimensi_satuan = "", input_kubikasi = "", input_kubikasi_satuan = "", input_berat = "", input_berat_satuan = "";
		
		if (select_dimensi != "") {
			input_panjang = "<input type='hidden' value='" + panjang + "' name='item-panjang-" + count + "' />";
			input_lebar = "<input type='hidden' value='" + lebar + "' name='item-lebar-" + count + "' />";
			input_tinggi = "<input type='hidden' value='" + tinggi + "' name='item-tinggi-" + count + "' />";
			input_dimensi_satuan = "<input type='hidden' value='" + dimensi_satuan + "' name='item-dimensi-satuan-" + count + "' />";

			kubikasi = panjang * lebar * tinggi;
			kubikasi_satuan = dimensi_satuan + "3";
			select_kubikasi = kubikasi + " " + kubikasi_satuan;
			input_kubikasi = "<input type='hidden' value='" + kubikasi + "' name='item-kubikasi-" + count + "' />";
			input_kubikasi_satuan = "<input type='hidden' value='" + kubikasi_satuan + "' name='item-kubikasi-satuan-" + count + "' />";
		}
		if (select_kubikasi != "") {
			input_kubikasi = "<input type='hidden' value='" + kubikasi + "' name='item-kubikasi-" + count + "' />";
			input_kubikasi_satuan = "<input type='hidden' value='" + kubikasi_satuan + "' name='item-kubikasi-satuan-" + count + "' />";
		}
		if (select_berat != "") {
			input_berat = "<input type='hidden' value='" + berat + "' name='item-berat-" + count + "' />";
			input_berat_satuan = "<input type='hidden' value='" + berat_satuan + "' name='item-berat-satuan-" + count + "' />";
		}
		
		var btnRemove = "<button type='button' class='btn-negative btn-remove-item' data-no='" + (count + 1) + "'>Remove</button>";
		
		$(".section-4-table tbody").append("<tr data-no='" + (count + 1) + "'><td>" + nama + input_nama + "</td><td>" + qty + input_qty + "</td><td>" + deskripsi + input_deskripsi + "</td><td>" + select_dimensi + input_panjang + input_lebar + input_tinggi + input_dimensi_satuan + "</td><td>" + select_kubikasi + input_kubikasi + input_kubikasi_satuan + "</td><td>" + select_berat + input_berat + input_berat_satuan + "</td><td>" + btnRemove + "</td></tr>");
		
		$(".detail-count").val((count + 1));
		
		clearTambahBarang();

		$(".section-3").css("display", "none");
	}
}

function clearTambahBarang() {
	$(".input-nama-barang").val("");
	$(".input-qty-barang").val("");
	$(".input-deskripsi-barang").val("");
	$(".input-panjang-barang").val("");
	$(".input-lebar-barang").val("");
	$(".input-tinggi-barang").val("");
	$(".input-kubikasi-barang").val("");
	$(".input-berat-barang").val("");

	clearAllErrors();
}

function clearAllErrors() {
	error.nama = "";
	error.qty = "";
	error.deskripsi = "";
	error.dimensi = "";
	error.kubikasi = "";
	error.berat = "";

	$(".error").html("");
}

function clearPilihanError() {
	error.dimensi = "";
	error.kubikasi = "";
	error.berat = "";
	$(".error[data-type='dimensi'], .error[data-type='kubikasi'], .error[data-type='berat']").html("");
}

function showErrors() {
	$(".error[data-type='nama']").html(error.nama);
	$(".error[data-type='qty']").html(error.qty);
	$(".error[data-type='deskripsi']").html(error.deskripsi);
	$(".error[data-type='dimensi']").html(error.dimensi);
	$(".error[data-type='kubikasi']").html(error.kubikasi);
	$(".error[data-type='berat']").html(error.berat);
}

var map_asal,map_tujuan, placeService;
var marker_asal,marker_tujuan;
var autocomplete_asal, autocomplete_tujuan;
var map_from_latlng, map_to_latlng;
var center_from = {lat: -2.4153238, lng: 108.8510806};
var center_to = {lat: -2.4153238, lng: 108.8510806};

function updatePosition(div, lat, lng) {
	$("#"+div).val(lat +', '+lng);
}

function initialize() {
	input = document.getElementById('location_from_address');
	autocomplete_asal = new google.maps.places.Autocomplete(input);
	input = document.getElementById('location_to_address');
	autocomplete_tujuan = new google.maps.places.Autocomplete(input);
	
	autocomplete_asal.addListener('place_changed', function() {
		var place = autocomplete_asal.getPlace();
		var city = getCityFromPlace(place);
		
		$("#location_from_name").val(place.name);
		$("#location_from_city").val(city);
		var latlng = place.geometry.location;
		get_lat_long('location', latlng, "location_from_latlng");
		
		var to_address = $("#location_to_address").val();
		if (to_address != "") {
			var to_latlng = $("#location_to_latlng").val().split(",");
			var to_lat = parseFloat(to_latlng[0]);
			var to_lng = parseFloat(to_latlng[1]);
			
			to_latlng = new google.maps.LatLng(to_lat, to_lng);
			callDistanceMatrixService(latlng, to_latlng);
		}
	});
	
	autocomplete_tujuan.addListener('place_changed', function() {
		var place = autocomplete_tujuan.getPlace();
		var city = "";
		var address_components = place.address_components;
		for (var i in address_components) {
			if ( address_components.hasOwnProperty(i) ) {
				var types = address_components[i].types;
				for (var j in types) {
					if (types[j] == "administrative_area_level_2") {
						city = address_components[i].long_name;
					}
				}
			}
		}
		
		$("#location_to_name").val(place.name);
		$("#location_to_city").val(city);
		var latlng = place.geometry.location;
		get_lat_long('location', latlng, "location_to_latlng");
		
		var from_address = $("#location_from_address").val();
		if (from_address != "") {
			var from_latlng = $("#location_from_latlng").val().split(",");
			var from_lat = parseFloat(from_latlng[0]);
			var from_lng = parseFloat(from_latlng[1]);
			
			from_latlng = new google.maps.LatLng(from_lat, from_lng);
			callDistanceMatrixService(latlng, from_latlng);
		}
	});
}

function getCityFromPlace(place) {
	var city = "";
	var text = "";
	var address_components = place.address_components;
	for (var i = 0; i < address_components.length; i++) {
		var ac = address_components[i];
		if (ac.types.indexOf("administrative_area_level_2") >= 0) {
			city = ac.long_name;
			break;
		} else if (ac.types.indexOf("administrative_area_level_1") >= 0) {
			city = ac.long_name;
			break;
		}
	}
	
	return city;
}

function callDistanceMatrixService(from_latlng, to_latlng) {
	map_from_latlng = from_latlng;
	map_to_latlng = to_latlng;
	var distanceMatrix = new google.maps.DistanceMatrixService();
	distanceMatrix.getDistanceMatrix({
		origins: [from_latlng],
		destinations: [to_latlng],
		travelMode: "DRIVING",
		avoidHighways: false,
		avoidTolls: false
	}, distanceMatrixCallback);
}

function distanceMatrixCallback(response, status) {
	if (status == "OK") {
		var origins = response.originAddresses;
		var destinations = response.destinationAddresses;
				
		var results = response.rows[0].elements;
		var distance = 0;
		var element = results[0];
		if (element.status != "ZERO_RESULTS") {
			distance = element.distance.value; //distance in meter
		} else {
			distance = google.maps.geometry.spherical.computeDistanceBetween(map_from_latlng, map_to_latlng);
		}
		distance /= 1000;
		
		$("#shipment_length").val(distance);
	}
}

function initMap() {
	geocoder = new google.maps.Geocoder;

	map_asal = new google.maps.Map(document.getElementById('map_asal'), {
	  center: center_from,
	  streetViewControl: false,
	  disableDefaultUI: true,
	  scrollwheel: false,
	  zoom: 17
	});
	
	placeService = new google.maps.places.PlacesService(map_asal);

	marker_asal = new google.maps.Marker({
		position: center_from,
		draggable: true,
		map: map_asal
	});

	google.maps.event.addListener(marker_asal, 'dragend', function () {
		map_asal.setCenter(this.getPosition()); // Set map center to marker position
		updatePosition("location_from_latlng",this.getPosition().lat(), this.getPosition().lng()); // update position display
		latlng = {lat: parseFloat(this.getPosition().lat()),lng: parseFloat(this.getPosition().lng())};
		var geocoder = new google.maps.Geocoder;
		geocoder.geocode({'location': latlng}, function(results, status) {
		  if (status === 'OK') {
			if (results[1]) {
			  $("#location_from_address").val(results[0].formatted_address);
			} else {
			  window.alert('No results found');
			}
		  } else {
			window.alert('Geocoder failed due to: ' + status);
		  }
		});
	});

	map_tujuan = new google.maps.Map(document.getElementById('map_tujuan'), {
	  center: center_to,
	  streetViewControl: false,
	  disableDefaultUI: true,
	  scrollwheel: false,
	  zoom: 17
	});

	marker_tujuan = new google.maps.Marker({
		position: center_to,
		draggable: true,
		map: map_tujuan
	});

	google.maps.event.addListener(marker_tujuan, 'dragend', function () {
		map_tujuan.setCenter(this.getPosition()); // Set map center to marker position
		updatePosition("location_to_latlng",this.getPosition().lat(), this.getPosition().lng()); // update position display
		latlng = {lat: parseFloat(this.getPosition().lat()),lng: parseFloat(this.getPosition().lng())};
		var geocoder = new google.maps.Geocoder;
		geocoder.geocode({'location': latlng}, function(results, status) {
		  if (status === 'OK') {
			if (results[1]) {
			  $("#location_to_address").val(results[0].formatted_address);
			} else {
			  window.alert('No results found');
			}
		  } else {
			window.alert('Geocoder failed due to: ' + status);
		  }
		});
	});

	updatePosition("location_from_latlng",center_from.lat,center_from.lng);
	updatePosition("location_to_latlng",center_to.lat,center_to.lng);
	google.maps.event.addDomListener(window, 'load', initialize);
}

function get_lat_long(mode, value, div) {
	var lat, lng, city;
	if (mode == "location") {
		lat = value.lat();
		lng = value.lng();
	} else if (mode == "address") {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({address: value}, function(results, status) {
			lat = results[0].geometry.location.lat()*1;
			lng = results[0].geometry.location.lng()*1;
			
			if (div == "location_from_latlng") {
				$("#location_from_latlng").val(lat + ", " + lng);
				marker_asal.setPosition( new google.maps.LatLng(lat,lng) );
				map_asal.panTo( new google.maps.LatLng(lat,lng) );
			}
			else if (div == "location_to_latlng") {
				$("#location_to_latlng").val(lat + ", " + lng);
				marker_tujuan.setPosition( new google.maps.LatLng(lat,lng) );
				map_tujuan.panTo( new google.maps.LatLng(lat,lng) );
			}
		});
	}
	
	if (div == "location_from_latlng") {
		$("#location_from_latlng").val(lat + ", " + lng);
		marker_asal.setPosition( new google.maps.LatLng(lat,lng) );
		map_asal.panTo( new google.maps.LatLng(lat,lng) );
	}
	else if (div == "location_to_latlng") {
		$("#location_to_latlng").val(lat + ", " + lng);
		marker_tujuan.setPosition( new google.maps.LatLng(lat,lng) );
		map_tujuan.panTo( new google.maps.LatLng(lat,lng) );
	}
}

$("#location_from_address").on("change", function() {
	location_from_address.changed = true;
});

$("#location_to_address").on("change", function() {
	location_to_address.changed = true;
});

$("#location_from_address").on("focusout", function() {
	
	location_from_address.autocomplete_clicked = false;
	location_from_address.changed = false;
});

$("#location_to_address").on("focusout", function() {
	location_to_address.autocomplete_clicked = false;
	location_to_address.changed = false;
});

function setMarkerFromLatlng() {
	latlng = $("#location_latlng").val();
	lat = latlng.substring(0, latlng.indexOf(","));
	lng = latlng.substring(latlng.indexOf(" "), latlng.length - 1);
	marker.setPosition( new google.maps.LatLng(lat,lng) );
	map.panTo( new google.maps.LatLng(lat,lng) );
}