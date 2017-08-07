<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title"></div>
		</div>
		<div class="dialog-body">
			<table class="table-tambah-lokasi">
				<tbody>
					<tr>
						<td class="td-label">Nama Lokasi</td>
						<td>
							<input type="text" class="input-nama" id="location_address" />
							<div class="error"></div>
							<input type="hidden" name="location_name" id="location_name" value="" />
							<input type="hidden" name="location_city" id="location_city" value="" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td class="td-map">
							<div id="map" style="width: 100%; height: 200px"></div>
							<input type="hidden" id="location_latlng" name="location_latlng" value="" />
						</td>
					</tr>
					<tr>
						<td class="td-label">Detail Lokasi</td>
						<td>
							<textarea class="input-detail" id="location_detail"></textarea>
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="td-label">Kontak</td>
						<td>
							<input type="text" class="input-kontak" id="location_contact" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="td-label">Jenis</td>
						<td>
							<label class="label-asal">
								<input type="checkbox" class="input-asal" id="location_from" checked="checked" /> Asal
							</label class="label-tujuan">
							<label>
								<input type="checkbox" class="input-tujuan" id="location_to" checked="checked" /> Tujuan
							</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah">Tambah</button>
			<button type="button" class="btn-default btn-submit-edit">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-delete">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Delete Lokasi</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-delete">Delete</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="content">
	<div class="section-1">
		<button type="button" class="btn-default btn-tambah">Tambah Lokasi</button>
		<div class="table-container">
			<table class="table table-lokasi">
				<thead>
					<tr>
						<td data-col='no' data-align='center'>No.</td>
						<td data-col='nama-lokasi'>Nama Lokasi</td>
						<td data-col='lokasi-google-map'>Lokasi Google Map</td>
						<td data-col='detail-lokasi'>Detail Lokasi</td>
						<td data-col='kontak'>Kontak</td>
						<td data-col='asal' data-align='center'>Asal</td>
						<td data-col='tujuan' data-align='center'>Tujuan</td>
						<td data-col='action' data-align='center'>Action</td>
					</tr>
				</thead>
				<tbody class="tbody-lokasi">
				
				</tbody>
			</table>
			<div class="table-empty-state">Anda belum menambahkan lokasi</div>
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript">
var map, marker, autocomplete, lat, lng;
var center = {lat: 0, lng: 0};

$(function() {
	getMyLocation();
	
	$(".btn-tambah").on("click", function() {
		$(".dialog-tambah .dialog-title").html("Tambah Lokasi");
		$(".dialog-tambah .btn-submit-tambah").css("display", "block");
		$(".dialog-tambah .btn-submit-edit").css("display", "none");
		$(".dialog-tambah .btn-batal").css("display", "none");
		clearErrors();
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
		google.maps.event.trigger(map, 'resize');
	});
	
	$(".btn-submit-tambah").on("click", function() {
		addLocation();
	});
	
	$(document).on("click", ".btn-edit", function() {
		$(".dialog-tambah .dialog-title").html("Edit Lokasi");
		$(".dialog-tambah .btn-submit-tambah").css("display", "none");
		$(".dialog-tambah .btn-submit-edit").css("display", "block");
		$(".dialog-tambah .btn-batal").css("display", "block");
				
		var location_id = $(this).closest(".tr-lokasi").data("id");
		var location_city = $(this).closest(".tr-lokasi").data("city");
		var location_name = $(this).closest(".tr-lokasi").find(".td-location_name").html();
		var location_address = $(this).closest(".tr-lokasi").find(".td-location_address").html();
		var location_detail = $(this).closest(".tr-lokasi").find(".td-location_detail").html();
		var location_contact = $(this).closest(".tr-lokasi").find(".td-location_contact").html();
		var location_lat = $(this).closest(".tr-lokasi").data("lat");
		var location_lng = $(this).closest(".tr-lokasi").data("lng");
		
		var asal = $(this).closest(".tr-lokasi").find(".td-location_asal").html();
		var asalChecked = true;
		if (asal == "Tidak") {
			asalChecked = false;
		}
		
		var tujuan = $(this).closest(".tr-lokasi").find(".td-location_tujuan").html();
		var tujuanChecked = true;
		if (tujuan == "Tidak") {
			tujuanChecked = false;
		}
		
		$(".dialog-tambah").data("id", location_id);
		$("#location_city").val(location_city);
		$("#location_address").val(location_address);
		$("#location_latlng").val(location_lat + ", " + location_lng);
		$("#location_name").val(location_name);
		$("#location_detail").val(location_detail);
		$("#location_contact").val(location_contact);
		$("#location_from").prop("checked", asalChecked);
		$("#location_to").prop("checked", tujuanChecked);
		
		showDialog(".dialog-tambah");
		google.maps.event.trigger(map, 'resize');
		setMarkerFromLatlng();
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateLocation();
	});
	
	$(document).on("click", ".btn-delete", function() {
		var nama = $(this).closest(".tr-lokasi").children(".td-location_name").html();
		var location_id = $(this).closest(".tr-lokasi").data("id");
		$(".dialog-konfirmasi-delete").data("id", location_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Delete " + nama + "?");
		showDialog(".dialog-konfirmasi-delete");
	});
	
	$(".btn-submit-delete").on("click", function() {
		deleteLocation();
	});
});

function deleteLocation() {
	showFullscreenLoading();
	var location_id = $(".dialog-konfirmasi-delete").data("id");
	ajaxCall("lokasi/deleteLocation", {location_id: location_id}, function() {
		hideFullscreenLoading();
		closeDialog();
		getMyLocation();
	});
}

function updateLocation() {
	var location_id = $(".dialog-tambah").data("id");
	var location_name = $("#location_name").val();
	var location_city = $("#location_city").val();
	var location_address = $("#location_address").val();
	var location_detail = $("#location_detail").val();
	var location_contact = $("#location_contact").val();
	var location_latlng = $("#location_latlng").val();
	var location_from = 0, location_to = 0;
	if ($("#location_from").is(":checked")) {
		location_from = 1;
	}
	if ($("#location_to").is(":checked")) {
		location_to = 1;
	}
	
	clearErrors();
	var valid = cekInputError(location_address, location_latlng, location_detail, location_contact);
	if (valid) {
		showFullscreenLoading();
		var data = {
			location_id: location_id,
			location_name: location_name,
			location_city: location_city,
			location_address: location_address,
			location_detail: location_detail,
			location_contact: location_contact,
			location_latlng: location_latlng,
			location_from: location_from,
			location_to: location_to
		};
		
		ajaxCall("lokasi/updateLocation", data, function(result) {
			hideFullscreenLoading();
			closeDialog();
			getMyLocation();
		});
	}
}

function cekInputError(location_address, location_latlng, location_detail, location_contact) {
	var valid = true;
		if (location_address == "") {
			valid = false;
			$("#location_address").next().html("Nama lokasi harus diisi");
		} else if (location_latlng == "0, 0") {
			valid = false;
			$("#location_address").next().html("Lokasi harus dipilih dari google maps");
		}
		if (location_detail == "") {
			valid = false;
			$("#location_detail").next().html("Detail lokasi harus diisi");
		}
		if (location_contact == "") {
			valid = false;
			$("#location_contact").next().html("Kontak harus diisi");
		}
	return valid;
}

function clearErrors() {
	$(".error").html("");
}

function addLocation() {
	var location_name = $("#location_name").val();
	var location_address = $("#location_address").val().trim();
	var location_city = $("#location_city").val();
	var location_latlng = $("#location_latlng").val();
	var location_detail = $("#location_detail").val().trim();
	var location_contact = $("#location_contact").val().trim();
	var location_from = 0, location_to = 0;
	if ($("#location_from").is(":checked")) {
		location_from = 1;
	}
	if ($("#location_to").is(":checked")) {
		location_to = 1;
	}
	
	clearErrors();
	var valid = cekInputError(location_address, location_latlng, location_detail, location_contact);
	if (valid) {
		showFullscreenLoading();
		var data = {
			location_name: location_name,
			location_address: location_address,
			location_city: location_city,
			location_latlng: location_latlng,
			location_detail: location_detail,
			location_contact: location_contact,
			location_from: location_from,
			location_to: location_to
		};
		ajaxCall("lokasi/addLocation", data, function(json) {
			hideFullscreenLoading();
			var result = jQuery.parseJSON(json);
			if (result.status == "success") {
				getMyLocation();
				closeDialog();
			} else {
				if (result.status_message == "duplicate") {
					alert("Lokasi ini sudah ada di daftar");
				} else {
					closeDialog();
				}
			}
			
		});
	}
}

function getMyLocation() {
	$(".tbody-lokasi").html("");
	setLoading(".table-empty-state");
	ajaxCall("lokasi/getMyLocation", null, function(json) {
		removeLoading();
		var result = jQuery.parseJSON(json);
		addLocationToTable(result);
	});
}

function addLocationToTable(result) {
	var element = "";
	var iLength = result.length;
	for (var i = 0; i < iLength; i++) {
		var asal = "Ya", tujuan = "Ya";
		if (result[i].location_from == 0) {
			asal = "Tidak";
		}
		if (result[i].location_to == 0) {
			tujuan = "Tidak";
		}
		
		var btnEdit = "<button class='btn-action btn-edit' title='edit' style='background-image: url(" + editIconUrl + ");'></button>";
		var btnDelete = "<button class='btn-action btn-delete' title='delete' style='background-image: url(" + deleteIconUrl + ");'></button>";
		element += "<tr class='tr-lokasi' data-id='" + result[i].location_id + "' data-lat='" + result[i].location_lat + "' data-lng='" + result[i].location_lng + "' data-city='" + result[i].location_city + "'>";
		element += "<td data-align='center'>" + (i + 1) + "</td>";
		element += "<td class='td-location_name'>" + result[i].location_name + "</td>";
		element += "<td class='td-location_address'>" + result[i].location_address + "</td>";
		element += "<td class='td-location_detail'>" + result[i].location_detail + "</td>";
		element += "<td class='td-location_contact'>" + result[i].location_contact + "</td>";
		element += "<td class='td-location_asal' data-align='center'>" + asal + "</td>";
		element += "<td class='td-location_tujuan' data-align='center'>" + tujuan + "</td>";
		element += "<td data-align='center'>" + btnEdit + btnDelete + "</td>";
		element += "</tr>";
	}
	
	if (iLength == 0) {
		$(".table-empty-state").addClass("shown");
	} else {
		$(".table-empty-state").removeClass("shown");
	}
	$(".tbody-lokasi").html(element);
}

function updatePosition(div, lat, lng) {
	$("#"+div).val(lat +', '+lng);
}

function initialize() {
	input = document.getElementById('location_address');
	autocomplete = new google.maps.places.Autocomplete(input);
	
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
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
		
		$("#location_name").val(place.name);
		$("#location_city").val(city);
		var latlng = place.geometry.location;
		get_lat_long('location', latlng, "location_latlng");
	});
}

function initMap() {
	
	map = new google.maps.Map(document.getElementById('map'), {
	  center: center,
	  streetViewControl: false,
	  disableDefaultUI: true,
	  zoom: 17
	});

	marker = new google.maps.Marker({
		position: center,
		draggable: true,
		map: map
	});

	google.maps.event.addListener(marker, 'dragend', function () {
		map.setCenter(this.getPosition()); // Set map center to marker position
		updatePosition("location_latlng", this.getPosition().lat(), this.getPosition().lng()); // update position display
		latlng = {lat: parseFloat(this.getPosition().lat()), lng: parseFloat(this.getPosition().lng())};
		var geocoder = new google.maps.Geocoder;
		geocoder.geocode({'location': latlng}, function(results, status) {
		  if (status === 'OK') {
			if (results[1]) {
			  $("#location_address").val(results[0].formatted_address);
			} else {
			  window.alert('No results found');
			}
		  } else {
			window.alert('Geocoder failed due to: ' + status);
		  }
		});
	});

	updatePosition("location_latlng", center.lat, center.lng);
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
			
			$("#" + div).val(lat + ", " + lng);
			setMarkerFromLatlng();
		});
	}
	
	$("#" + div).val(lat + ", " + lng);
	setMarkerFromLatlng();
}

function setMarkerFromLatlng() {
	latlng = $("#location_latlng").val();
	lat = latlng.substring(0, latlng.indexOf(","));
	lng = latlng.substring(latlng.indexOf(" "), latlng.length - 1);
	marker.setPosition( new google.maps.LatLng(lat,lng) );
	map.panTo( new google.maps.LatLng(lat,lng) );
}

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap&libraries=places" async defer></script>