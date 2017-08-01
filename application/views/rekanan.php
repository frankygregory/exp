<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?><span class="tag-premium-large"></span></div>
<div class="content">
    <button class="btn-default btn-tambah">Tambah Rekanan</button>
	<div class="tabs">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1">Rekanan (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="2">Pending (<span class="tabs-item-count">0</span>)</div>
			</div>
			<div class="tabs-selection"></div>
		</div>
		<div class="tabs-body">
			<div class="tabs-content active" data-tabs-number="1">
				<div class="table-container">
					<table class="table table-rekanan">
						<thead>
							<tr>
                                <td data-col='no' data-align="center">No</td>
								<td data-col='username'>Username</td>
								<td data-col='nama'>Nama</td>
								<td data-col='status'>Status</td>
							</tr>
						</thead>
						<tbody class="tbody-rekanan">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="2">
				<div class="table-container">
					<table class="table table-rekanan">
						<thead>
							<tr>
                                <td data-col='no' data-align="center">No</td>
								<td data-col='username'>Username</td>
								<td data-col='nama'>Nama</td>
								<td data-col='status'>Status</td>
							</tr>
						</thead>
						<tbody class="tbody-rekanan">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Rekanan</div>
		</div>
		<div class="dialog-body">
			<div class="form-item">
				<div class="form-item-label">Username / Nama</div>
				<div class="form-item-value" data-count="0">
					<input type="text" class="input-search" />
				</div>
			</div>
			<div class="search-results">
				<div class="result-label">
					<span data-align="center" data-col="no">No</span>
					<span data-col="username">Username</span>
					<span data-col="nama">Nama</span>
				</div>
				<div class="result-value">
				</div>
			</div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah">Tambah</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-konfirmasi">
		<div class="dialog-header">
			<div class="dialog-title">Konfirmasi</div>
		</div>
		<div class="dialog-body">
			
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-konfirmasi">Terima</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-tolak">
		<div class="dialog-header">
			<div class="dialog-title">Tolak Permintaan Rekanan</div>
		</div>
		<div class="dialog-body">
			
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-tolak">Tolak</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-delete">
		<div class="dialog-header">
			<div class="dialog-title">Hapus Rekanan</div>
		</div>
		<div class="dialog-body">
			
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-delete">Hapus</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
</div>
</div>
<script>
var profilUrl = "<?= base_url("profil/") ?>";
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("rekanan/getRekanan") ?>";
kirimanUrl[2] = "<?= base_url("rekanan/getPendingRekanan") ?>";

var kirimanTabs = [];
kirimanTabs[1] = "rekanan";
kirimanTabs[2] = "pending";

$(function() {
    getKiriman(kirimanUrl[1], 1, "rekanan");
	getRekananCount();

    $(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});

	$(".btn-tambah").on("click", function() {
		$(".dialog-tambah .form-item-value").data("count", 0);
		deleteBadge();
		$(".search-results").removeClass("shown");
		showDialog(".dialog-tambah");
		$(".input-search").select();
	});

	$(".input-search").on("input", function() {
		var value = $(this).val().trim();
		$(".search-results").removeClass("shown");
		if (value.length > 0) {
			searchRekanan(value);
		}
	});

	$(".input-search").on("keydown", function(e) {
		if (e.keyCode == 8) {
			if ($(this).val() == "") {
				var formItemValue = $(".form-item-value");
				if (parseInt(formItemValue.data("count")) > 0) {
					deleteBadge();
				}
			}
		}
	});

	$(document).on("click", ".result-item", function() {
		var username = $(this).data("username");
		var user_id = $(this).data("user-id");

		var count = parseInt($(".form-item-value").data("count"));
		if (count > 0) {
			deleteBadge();
		}
		var element = "";
		element += "<div class='badge-result' data-user-id='" + user_id + "' data-username='" + username + "'>";
		element += username + "<div class='badge-delete'>X</div>";
		element += "</div>";
		$(".form-item-value").data("count", 1);
		$(".form-item-value").prepend(element);
		$(".input-search").val("");
		$(".search-results").removeClass("shown");
	});

	$(document).on("click", ".badge-delete", function() {
		deleteBadge();
	});

	$(".btn-submit-tambah").on("click", function() {
		var user_id = $(".badge-result").data("user-id");
		var username = $(".badge-result").data("username");
		if (user_id) {
			showFullscreenLoading();
			ajaxCall("<?php echo base_url("rekanan/requestRekanan"); ?>", {user_id: user_id}, function(json) {
				closeDialog();
				hideFullscreenLoading();
				var result = JSON.parse(json);
				
				if (result.status == "success") {
					refreshData();
					alert("Request rekanan telah dikirim ke user " + username);
				} else {
					if (result.error_message == "already_rekanan") {
						alert("User ini sudah menjadi rekanan anda");
					} else if (result.error_message == "duplicate") {
						alert("Anda sudah mengirim permintaan rekanan ke user ini");
					}
				}
			});
		}
	});

	$(document).on("click", ".btn-konfirmasi", function() {
		var trRekanan = $(this).closest(".tr-rekanan");
		var user_id = trRekanan.data("id");
		var username = trRekanan.data("username");
		$(".dialog-konfirmasi-konfirmasi").data("id", user_id);
		$(".dialog-konfirmasi-konfirmasi .dialog-body").html("Terima permintaan rekanan dari " + username + "?");
		showDialog(".dialog-konfirmasi-konfirmasi");
	});

	$(document).on("click", ".btn-submit-konfirmasi", function() {
		showFullscreenLoading();
		var user_id = $(".dialog-konfirmasi-konfirmasi").data("id");
		ajaxCall("<?php echo base_url("rekanan/konfirmasiRekanan"); ?>", {user_id: user_id}, function(json) {
			closeDialog();
			hideFullscreenLoading();
			var result = JSON.parse(json);
			if (result.status == "success") {
				refreshData();
			}
		});
	});

	$(document).on("click", ".btn-tolak", function() {
		var trRekanan = $(this).closest(".tr-rekanan");
		var user_id = trRekanan.data("id");
		var username = trRekanan.data("username");
		$(".dialog-konfirmasi-tolak").data("id", user_id);
		$(".dialog-konfirmasi-tolak .dialog-body").html("Tolak permintaan rekanan dari " + username + "?");
		showDialog(".dialog-konfirmasi-tolak");
	});

	$(document).on("click", ".btn-submit-tolak", function() {
		showFullscreenLoading();
		var user_id = $(".dialog-konfirmasi-tolak").data("id");
		ajaxCall("<?php echo base_url("rekanan/tolakRekanan"); ?>", {user_id: user_id}, function(json) {
			closeDialog();
			hideFullscreenLoading();
			var result = JSON.parse(json);
			if (result.status == "success") {
				refreshData();
			}
		});
	});

	$(document).on("click", ".btn-delete", function() {
		var trRekanan = $(this).closest(".tr-rekanan");
		var user_id = trRekanan.data("id");
		var username = trRekanan.data("username");
		$(".dialog-konfirmasi-delete").data("id", user_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Hapus " + username + " dari daftar rekanan?");
		showDialog(".dialog-konfirmasi-delete");
	});

	$(document).on("click", ".btn-submit-delete", function() {
		showFullscreenLoading();
		var user_id = $(".dialog-konfirmasi-delete").data("id");
		ajaxCall("<?php echo base_url("rekanan/deleteRekanan"); ?>", {user_id: user_id}, function(json) {
			closeDialog();
			hideFullscreenLoading();
			var result = JSON.parse(json);
			if (result.status == "success") {
				refreshData();
			}
		});
	});
});

function deleteBadge() {
	$(".form-item-value .badge-result").remove();
	$(".form-item-value").data("count", 0);
}

function searchRekanan(keyword) {
	abortAjaxCall();
	
	ajaxCall("<?php echo base_url("rekanan/searchUsernameOrName"); ?>", {keyword: keyword}, function(json) {
		var result = JSON.parse(json);
		showSearchResults(result);
	});
}

function showSearchResults(result) {
	var element = "";
	var iLength = result.length;
	for (var i = 0; i < iLength; i++) {
		element += "<div class='result-item' data-user-id='" + result[i].user_id + "' data-username='" + result[i].username + "'>";
		element += "<span data-align='center' data-col='no'>" + (i + 1) + "</span>";
		element += "<span data-col='username'>" + result[i].username + "</span>";
		element += "<span data-col='nama'>" + result[i].user_fullname + "</span>";
		element += "</div>";
	}

	if (iLength > 0) {
		$(".search-results .result-value").html(element);
		$(".search-results").addClass("shown");
	}
}

function refreshData() {
	var tabsNumber = $(".tabs-item.active").data("tabs-number");
	getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	getRekananCount();
}

function getRekananCount() {
	ajaxCall("<?= base_url("rekanan/getRekananCount") ?>", null, function(json) {
		var result = JSON.parse(json);
		assignRekananCount(result);
	});
}

function assignRekananCount(result) {
	var tabs = {
		t1: 0,
		t2: 0
	};
	
	tabs.t1 = result.rekanan_count;
	tabs.t2 = result.pending_count;
	
	for (var i = 1; i <= 2; i++) {
		updateTabsItemCount(i, tabs["t" + i]);
	}
}

function getKiriman(url, tabsNumber, tabs) {
	abortAjaxCall();
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-rekanan").html("");
	setLoading(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state");
	ajaxCall(url, null, function(json) {
		removeLoading();
		var result = JSON.parse(json);
		addRekananToTable(result, tabsNumber, tabs);
	});
}

function addRekananToTable(result, tabsNumber, tab) {
	var iLength = result.length;
	var element = {
		"rekanan": {
			value: ""
		},
		"pending": {
			value: ""
		}
	};
	
	for (var i = 0; i < iLength; i++) {
		var status = "";
		switch(result[i].user_party_status) {
			case "1":
				status = "Pending";
				break;
			case "2":
				status = "<button class='btn-default btn-konfirmasi'>Terima</button><button class='btn-negative btn-tolak'>Tolak</button>";
				break;
			case "3":
			case "4":
				status = "Rekanan<button class='btn-negative btn-delete'>Hapus</button>";
				break;
		}

		switch (tab) {
			case "rekanan":
				
				break;
			case "pending":
				
				break;
		}
		
		element[tab].value += "<tr class='tr-rekanan' data-id='" + result[i].party_id + "' data-username='" + result[i].party_username + "'>";
        element[tab].value += "<td data-align='center'>" + (i + 1) + "</td>";
        element[tab].value += "<td>" + result[i].party_username + "</td>";
        element[tab].value += "<td>" + result[i].party_fullname + "</td>";
        element[tab].value += "<td>" + status + "</td>";
		element[tab].value += "</tr>";
	}
	
	if (iLength == 0) {
        $(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-rekanan").html(element[tab].value);
}

</script>