function cancelBidding() {
	setLoading(".default-loading-container-cancel-bidding");
	var bidding_id = $(".dialog-konfirmasi-cancel-bidding").data("id");
	ajaxCall(cancelBiddingUrl, {bidding_id: bidding_id}, function(result) {
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
		ajaxCall(kirimPertanyaanUrl, data, function(result) {
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
	ajaxCall(getKendaraanUrl, null, function(json) {
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
		var user_id = current_user_id;
		data = {
			submit_bid: true,
			bidding_type: bidding_type,
			bidding_price: bidding_price,
			bidding_pickupdate: bidding_pickupdate,
			bidding_vehicle: bidding_vehicle,
			bidding_information: bidding_information,
			shipment_id: shipment_id,
			user_id: user_id
		};
		ajaxCall(kirimPenawaranUrl, data, function(result) {
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

function setujuBidding(element) {
	setLoading(".default-loading-container-setuju-penawaran");
	var bidding_id = $(element).closest(".dialog-konfirmasi-setuju").data("bidding_id");
	var shipment_id = data_shipment_id;
	var input_shipment = "<input type='hidden' name='shipment_id' value='" + shipment_id + "' />";
	var input_bidding = "<input type='hidden' name='bidding_id' value='" + bidding_id + "' />";
	
	$("<form>", {
		"action": setujuBiddingUrl,
		"method": "POST",
		"html": input_shipment + input_bidding
	}).appendTo(document.body).submit();
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
		ajaxCall(jawabPertanyaanUrl, data, function(result) {
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
    
	ajaxCall(submitTolakUrl, data, function(result) {
        removeLoading(".table-list-penawaran-container .table-empty-state");
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

function getDiscussions(load) {
	if (load === undefined) load = false;
	if (load) {
		$(".discussions").html("");
		setLoading(".section-3-content .default-empty-state");
	}

	var shipment_id = data_shipment_id;
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(getDiscussionsUrl, data, function(json) {
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
		element += "<div class='questions' data-questions-id='" + questions[i].questions_id + "'>";
		element += "<div class='questions-user-id'><a href='" + profilUrl + questions[i].user_id + "'>" + questions[i].username + "</a>" + icon + "</div>";
		element += "<div class='questions-text'>" + questions[i].questions_text + "</div>";
		if (btnJawabPertanyaan) {
			element += "<button class='btn-neutral btn-jawab-pertanyaan'>Jawab</button>";
		}
		element += "<div class='discussion-item-time'>" + questions[i].created_date + "</div>";
		element += "</div>";
		
		var answers = result.answers[i];
		var jLength = answers.length;
		for (var j = 0; j < jLength; j++) {
			element += "<div class='answers'>";
			element += "<div class='answers-user-id'><a href='" + profilUrl + shipment_user_id + "'>" + shipment_owner_username + "</a>" + verified_icon + "</div>";
			element += "<div class='answers-text'>" + answers[j].answers_text + "</div>";
			element += "<div class='discussion-item-time'>" + answers[j].created_date + "</div>";
			element += "</div>";
		}
		
		if (btnJawabPertanyaan) {
			element += "<div class='detail-jawab-pertanyaan'>";
			element += "<textarea class='input-jawab-pertanyaan'></textarea>";
			element += "<button class='btn-default btn-submit-jawab-pertanyaan'>Submit Jawaban</button>";
			element += "</div>";
			element += "</div>";
		}
	}
	
	if (iLength == 0) {
		$(".section-3-content .default-empty-state").addClass("shown");
	} else {
		$(".section-3-content .default-empty-state").removeClass("shown");
	}
	
	$(".discussions").html(element);
}

function getBiddingList(load) {
	if (load === undefined) load = false;
	if (load) {
		$(".tbody-list-penawaran").html("");
		setLoading(".table-list-penawaran-container .table-empty-state");
	}
	var shipment_id = data_shipment_id;
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(getBiddingListUrl, data, function(json) {
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
		
		element += "<tr class='tr-bidding' data-status='" + result.data[i].bidding_status + "' data-bidding_id='" + result.data[i].bidding_id + "'>";
		element += "<td class='td-bidding-price' data-value='" + result.data[i].bidding_price + "'>" + addCommas(result.data[i].bidding_price) + " IDR</td>";
		element += "<td class='td-bidding-type' data-value='" + bidding_type + "'>" + bidding_type + "</td>";
		element += "<td class='td-bidding-username'><a href='" + profilUrl + result.data[i].user_id + "'>" + result.data[i].username + "</a>" + icon + "</td>";
		element += "<td class='td-bidding-tanggal-ambil'>";
		element += "<div>Tanggal Ambil : " + result.data[i].bidding_pickupdate + "</div>";
		element += "<div>Keterangan : " + result.data[i].bidding_information + "</div>";
		if (result.data[i].bidding_vehicle !== null) {
			element += "<div>Kendaraan : " + result.data[i].bidding_vehicle + "</div>";
		}
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
			if (btnJawabPertanyaan) {
				element += "<button class='btn-default btn-setuju'>Setuju</button>";
				element += "<button class='btn-negative btn-tolak'>Tolak</button>";
				element += "<div class='container-tolak'>";
				element += "<textarea class='input-alasan' data-bidding_id='" + result.data[i].bidding_id + "'></textarea>";
				element += "<button class='btn-negative btn-submit-tolak' data-bidding_id='" + result.data[i].bidding_id + "'>Tolak</button>";
				element += "<button class='btn-neutral btn-batal-tolak'>Batal Tolak</button>";
				element += "</div>";
			} else if (btnCancelBidding) {
				if (user_id == result.data[i].user_id) {
					element += "<button class='btn-negative btn-cancel-bidding'>Batalkan</button>";
				}
			}
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

	marker_from = new google.maps.Marker({
		position: new google.maps.LatLng(location_from_lat, location_from_lng),
		map: map,
		icon: "https://maps.google.com/mapfiles/marker_greenA.png"
	});

	marker_to = new google.maps.Marker({
		position: new google.maps.LatLng(location_to_lat, location_to_lng),
		map: map,
		label: "B"
	});

	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
	directionsDisplay.setMap(map);
	directionsDisplay.setOptions({suppressMarkers: true});
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
			if (status == "ZERO_RESULTS") {
				var bounds = new google.maps.LatLngBounds();
				var infowindow = new google.maps.InfoWindow();

				bounds.extend(marker_from.position);
				bounds.extend(marker_to.position);

				map.fitBounds(bounds);
			}
		}
	});
}