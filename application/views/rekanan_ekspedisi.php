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
                                <td data-col='no'>No</td>
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
                                <td data-col='no'>No</td>
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
</div>
</div>
<script>
var profilUrl = "<?= base_url("profil/") ?>";
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("rekanan-ekspedisi/getRekanan") ?>";
kirimanUrl[2] = "<?= base_url("rekanan-ekspedisi/getPendingRekanan") ?>";

var kirimanTabs = [];
kirimanTabs[1] = "rekanan";
kirimanTabs[2] = "pending";

$(function() {
    getKiriman(kirimanUrl[1], 1, "rekanan");

    $(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});
});

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
		
		switch (tab) {
			case "rekanan":
				
				break;
			case "pending":
				
				break;
		}
		
        element[tab].value += "<td data-align='center'>" + (i + 1) + "</td>";
        element[tab].value += "<td>" + result[i].party_username + "</td>";
        element[tab].value += "<td>" + result[i].party_fullname + "</td>";
        element[tab].value += "<td>" + result[i].user_party_status + "</td>";
	}
	
	if (iLength == 0) {
        $(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-rekanan").html(element[tab].value);
}

</script>