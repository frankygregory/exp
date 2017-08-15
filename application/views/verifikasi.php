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
		<div class="table-container">
			<table class="table table-user">
				<thead>
					<tr>
						<td data-col="no" data-align="center">No</td>
						<td data-col="username">Username</td>
						<td data-col="email" >Email</td>
						<td data-col="role" >Role</td>
						<td data-col="action">Action</td>
					</tr>
				</thead>
				<tbody class="tbody-user">
				</tbody>
			</table>
			<div class="table-empty-state">Tidak ada hasil</div>
		</div>
	</div>
	<div class="paging-section">
		<div class="jumlah-hasil">Menampilkan hasil <span class="result-paging">0</span> dari <span class="result-count">0</span></div>
		<div class="page-numbers">
			Halaman : 
			<div class="page-number-prev disabled" data-value="prev">Previous</div>
			<div class="available-pages" data-value="0">
				<div class="page-number-item current-page-number" data-value="1">1</div>
			</div>
			<div class="page-number-next" data-value="next">Next</div>
		</div>
		<div class="view-per-page">
			View per page :
			<select class="select-view-per-page">
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
			</select>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-verifikasi">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Verifikasi</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-verifikasi">Verifikasi</button>
			<button type="button" class="btn-neutral btn-batal">Tidak Jadi</button>
		</div>
	</div>
</div>
</div>
</div>
<script>
var filesUrl = "<?php echo base_url("assets/panel/files/"); ?>";
$(function() {
	getUnverifiedUser();

	$(document).on("click", ".btn-lihat-surat", function() {
		var tr = $(this).closest(".tr-user");
		var detailElement = $(tr).next();
		if ($(detailElement).height() == 0) {
			$(detailElement).addClass("show");
			if ($(detailElement).find(".row-detail-td-content").html().trim() == "") {
				getSuratUser(tr);
			}
		} else {
			$(detailElement).removeClass("show");
		}
	});

	$(document).on("click", ".detail-image", function() {
		var src = $(this).css('background-image');
        src = src.replace('url(','').replace(')','').replace(/\"/gi, "");
		$(".image-viewer img").attr("src", src);
		$(".image-viewer").addClass("shown");
	});

	$(".image-viewer").on("click", function(e) {
		if (!$(e.target).is("img")) {
			$(this).removeClass("shown");
		}
	});

	$(document).on("click", ".btn-verifikasi", function() {
		var tr = $(this).closest("tr").prev();
		var user_id = tr.data("id");
		var username = tr.find(".td-username").html();
		
		var email = tr.find(".td-email").html();
		var role = tr.find(".td-role").html();

		var element = "Username : " + username + "<br>Email : " + email + "<br>Role : " + role;
		$(".dialog-konfirmasi-verifikasi .dialog-body").html(element);
		$(".dialog-konfirmasi-verifikasi").data("user_id", user_id)
		
		showDialog(".dialog-konfirmasi-verifikasi");
	});

	$(document).on("click", ".btn-submit-verifikasi", function() {
		verifyUser();
	});

	$(".select-view-per-page").on("change", function() {
		getUnverifiedUser();
	});

	paginationCallback = function() {
		getUnverifiedUser(true);
	};
});

function scrollToTop() {
	$(document).scrollTop(0);
}

function verifyUser() {
	showFullscreenLoading();
	var user_id = $(".dialog-konfirmasi-verifikasi").data("user_id");
	ajaxCall("<?php echo base_url("admin/verifyUser"); ?>", {user_id: user_id}, function() {
		hideFullscreenLoading();
		closeDialog();
		getUnverifiedUser();
	});
}

function getSuratUser(tr) {
	var user_id = tr.data("id");
	ajaxCall("<?php echo base_url("admin/getSuratUser"); ?>", {user_id: user_id}, function(json) {
		var result = jQuery.parseJSON(json);
		var element = "";
		var validPoints = 0;
		if (result.user_details_npwp) {
			validPoints++;
			element += "<div class='detail-item'>";
			element += "<div class='detail-image' style='background-image: url(" + filesUrl + result.user_details_npwp + ");' ></div>";
			element += "<div class='detail-name'>NPWP</div>";
			element += "</div>";
		}

		if (result.user_details_siup) {
			validPoints++;
			element += "<div class='detail-item'>";
			element += "<div class='detail-image' style='background-image: url(" + filesUrl + result.user_details_siup + ");' ></div>";
			element += "<div class='detail-name'>SIUP</div>";
			element += "</div>";
		}

		if (result.user_details_tdp) {
			validPoints++;
			element += "<div class='detail-item'>";
			element += "<div class='detail-image' style='background-image: url(" + filesUrl + result.user_details_tdp + ");' ></div>";
			element += "<div class='detail-name'>TDP</div>";
			element += "</div>";
		}

		if (validPoints == 3) {
			element += "<button class='btn-positive btn-verifikasi'>Verifikasi</button>";
		}

		tr.next().find(".row-detail-td-content").html(element);
	});
}

function getUnverifiedUser(changePage = false) {
	abortAjaxCall();
	$(".tbody-user").html("");
	setLoading(".table-empty-state");
	var view_per_page = parseInt($(".select-view-per-page").val());
	var page = 1;
	if (changePage) {
		page = parseInt($(".page-number-item.current-page-number").data("value"));
		var availablePages = parseInt($(".available-pages").data("value"));
		if (page == availablePages) {
			disableNextPage();
		} else {
			enableNextPage();
		}

		if (page > 1) {
			enablePrevPage();
		} else {
			disablePrevPage();
		}
	}
	
	var data = {
		view_per_page: view_per_page,
		page: page,
		change_page: changePage
	};
	ajaxCall("<?= base_url("admin/getUnverifiedUser") ?>", data, function(json) {
		
		removeLoading();
		var result = jQuery.parseJSON(json);
		scrollToTop();
		if (!changePage) {
			var count = result.count;
			setAvailablePages(count, view_per_page);
		}

		var resultPagingFrom = ((page - 1) * view_per_page) + 1;
		var resultPagingTo = resultPagingFrom + view_per_page - 1;
		var count = parseInt($(".result-count").html());
		if (resultPagingTo > count) {
			resultPagingTo = count;
		}
		$(".result-paging").html(resultPagingFrom + " - " + resultPagingTo);

		$(".tbody-user").html("");
		var iLength = result.data.length;
		addUserToTable(result.data);
		
		if (iLength == 0) {
			$(".table-empty-state").addClass("shown");
		} else {
			$(".table-empty-state").removeClass("shown");
		}
	});
}

function addUserToTable(result) {
	var iLength = result.length;
	var element = "";
	for (var i = 0; i < iLength; i++) {
		var role_id = (result[i].role_id == 1) ? "Konsumen" : "Ekspedisi";
		var btn = "<button class='btn-default btn-lihat-surat'>Lihat Surat</button>";

		element += "<tr class='tr-user' data-id='" + result[i].user_id + "'>";
		element += "<td data-align='center'>" + (i + 1) + "</td>";
		element += "<td class='td-username'>" + result[i].username + "</td>";
		element += "<td class='td-email'>" + result[i].user_email + "</td>";
		element += "<td class='td-role'>" + role_id + "</td>";
		element += "<td>" + btn + "</td>";
		element += "</tr>";

		element += "<tr class='row-detail-tr'><td class='row-detail-td' colspan='20'><div class='row-detail-td-content'></div></td></tr>";
	}

	$(".tbody-user").html(element);
}
</script>