<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section">
		<div class="subsection-filter">
			<div class="subsection-title">Filter</div>
			<div class="form-item form-item-kota">
				<div class="form-item-label">Kota Asal</div>
				<input type="text" class="input-kota-asal input-kota-from" data-fromto="from" value="" />
				<div class="datalist from-city-dropdown">
				</div>
			</div>
			<div class="form-item form-item-kota">
				<div class="form-item-label">Kota Tujuan</div>
				<input type="text" class="input-kota-tujuan input-kota-to" data-fromto="to" />
				<div class="datalist to-city-dropdown">
				</div>
			</div>
			<div class="form-item form-item-jarak">
				<div class="form-item-label">Jarak (Km)</div>
				<input type="range" class="input-jarak-slider" max="2000" min="0" step="10" value="2000" />
				<input type="text" class="input-jarak-max" maxlength="4" value="2000" />
			</div>
		</div>
		<div class="subsection-sort">
			<div class="subsection-title">Sort</div>
			<div class="form-item">
				<div class="form-item-label" style="visibility: hidden">sort</div>
				<select class="select-sort">
					<option value="created_date desc">Terbaru</option>
					<option value="created_date asc">Terlama</option>
					<option value="shipment_end_date asc">Tanggal Berakhir Asc</option>
					<option value="shipment_end_date desc">Tanggal Berakhir Desc</option>
					<option value="shipment_length asc">Jarak Asc</option>
					<option value="shipment_length desc">Jarak Desc</option>
				</select>
			</div>
		</div>
	</div>
	<div class="section-1">
		<div class="table-container">
			<table class="table table-kiriman">
				<thead>
					<tr>
						<td class="td-nama-kirim" data-col="nama-kirim">Nama Kirim</td>
						<td data-col="harga" data-sortable="true" data-sort-value="">Harga 
							<svg class="tr-icon" data-value="asc" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="20" height="20" viewBox="0 0 500 500" xml:space="preserve">
								<g>
									<g>
										<path d="M260.494,219.271H388.4c2.666,0,4.855-0.855,6.563-2.57c1.715-1.713,2.573-3.9,2.573-6.567v-54.816
											c0-2.667-0.858-4.854-2.573-6.567c-1.708-1.711-3.897-2.57-6.563-2.57H260.494c-2.666,0-4.853,0.855-6.567,2.57
											c-1.71,1.713-2.568,3.9-2.568,6.567v54.816c0,2.667,0.855,4.854,2.568,6.567C255.641,218.413,257.828,219.271,260.494,219.271z"/>
										<path d="M260.497,73.089h73.087c2.666,0,4.856-0.855,6.563-2.568c1.718-1.714,2.563-3.901,2.563-6.567V9.136
											c0-2.663-0.846-4.853-2.563-6.567C338.44,0.859,336.25,0,333.584,0h-73.087c-2.666,0-4.853,0.855-6.567,2.568
											c-1.709,1.715-2.568,3.905-2.568,6.567v54.818c0,2.666,0.855,4.853,2.568,6.567C255.645,72.23,257.831,73.089,260.497,73.089z"/>
										<path d="M196.54,401.991h-54.817V9.136c0-2.663-0.854-4.856-2.568-6.567C137.441,0.859,135.254,0,132.587,0H77.769
											c-2.663,0-4.856,0.855-6.567,2.568c-1.709,1.715-2.568,3.905-2.568,6.567v392.855H13.816c-4.184,0-7.04,1.902-8.564,5.708
											c-1.525,3.621-0.855,6.95,1.997,9.996l91.361,91.365c2.094,1.707,4.281,2.562,6.567,2.562c2.474,0,4.665-0.855,6.567-2.562
											l91.076-91.078c1.906-2.279,2.856-4.571,2.856-6.844c0-2.676-0.859-4.859-2.568-6.584
											C201.395,402.847,199.208,401.991,196.54,401.991z"/>
										<path d="M504.604,441.109c-1.715-1.718-3.901-2.573-6.567-2.573H260.497c-2.666,0-4.853,0.855-6.567,2.573
											c-1.709,1.711-2.568,3.901-2.568,6.564v54.815c0,2.673,0.855,4.853,2.568,6.571c1.715,1.711,3.901,2.566,6.567,2.566h237.539
											c2.666,0,4.853-0.855,6.567-2.566c1.711-1.719,2.566-3.898,2.566-6.571v-54.815C507.173,445.011,506.314,442.82,504.604,441.109z"
											/>
										<path d="M260.494,365.445H443.22c2.663,0,4.853-0.855,6.57-2.566c1.708-1.711,2.563-3.901,2.563-6.563v-54.823
											c0-2.662-0.855-4.853-2.563-6.563c-1.718-1.711-3.907-2.566-6.57-2.566H260.494c-2.666,0-4.853,0.855-6.567,2.566
											c-1.71,1.711-2.568,3.901-2.568,6.563v54.823c0,2.662,0.855,4.853,2.568,6.563C255.641,364.59,257.828,365.445,260.494,365.445z"
											/>
									</g>
								</g>
							</svg>
						</td>
						<td data-col="asal" data-sortable="true" data-sort-value="">Asal
							<svg class="tr-icon" data-value="asc" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="20" height="20" viewBox="0 0 500 500" xml:space="preserve">
								<g>
									<g>
										<path d="M260.494,219.271H388.4c2.666,0,4.855-0.855,6.563-2.57c1.715-1.713,2.573-3.9,2.573-6.567v-54.816
											c0-2.667-0.858-4.854-2.573-6.567c-1.708-1.711-3.897-2.57-6.563-2.57H260.494c-2.666,0-4.853,0.855-6.567,2.57
											c-1.71,1.713-2.568,3.9-2.568,6.567v54.816c0,2.667,0.855,4.854,2.568,6.567C255.641,218.413,257.828,219.271,260.494,219.271z"/>
										<path d="M260.497,73.089h73.087c2.666,0,4.856-0.855,6.563-2.568c1.718-1.714,2.563-3.901,2.563-6.567V9.136
											c0-2.663-0.846-4.853-2.563-6.567C338.44,0.859,336.25,0,333.584,0h-73.087c-2.666,0-4.853,0.855-6.567,2.568
											c-1.709,1.715-2.568,3.905-2.568,6.567v54.818c0,2.666,0.855,4.853,2.568,6.567C255.645,72.23,257.831,73.089,260.497,73.089z"/>
										<path d="M196.54,401.991h-54.817V9.136c0-2.663-0.854-4.856-2.568-6.567C137.441,0.859,135.254,0,132.587,0H77.769
											c-2.663,0-4.856,0.855-6.567,2.568c-1.709,1.715-2.568,3.905-2.568,6.567v392.855H13.816c-4.184,0-7.04,1.902-8.564,5.708
											c-1.525,3.621-0.855,6.95,1.997,9.996l91.361,91.365c2.094,1.707,4.281,2.562,6.567,2.562c2.474,0,4.665-0.855,6.567-2.562
											l91.076-91.078c1.906-2.279,2.856-4.571,2.856-6.844c0-2.676-0.859-4.859-2.568-6.584
											C201.395,402.847,199.208,401.991,196.54,401.991z"/>
										<path d="M504.604,441.109c-1.715-1.718-3.901-2.573-6.567-2.573H260.497c-2.666,0-4.853,0.855-6.567,2.573
											c-1.709,1.711-2.568,3.901-2.568,6.564v54.815c0,2.673,0.855,4.853,2.568,6.571c1.715,1.711,3.901,2.566,6.567,2.566h237.539
											c2.666,0,4.853-0.855,6.567-2.566c1.711-1.719,2.566-3.898,2.566-6.571v-54.815C507.173,445.011,506.314,442.82,504.604,441.109z"
											/>
										<path d="M260.494,365.445H443.22c2.663,0,4.853-0.855,6.57-2.566c1.708-1.711,2.563-3.901,2.563-6.563v-54.823
											c0-2.662-0.855-4.853-2.563-6.563c-1.718-1.711-3.907-2.566-6.57-2.566H260.494c-2.666,0-4.853,0.855-6.567,2.566
											c-1.71,1.711-2.568,3.901-2.568,6.563v54.823c0,2.662,0.855,4.853,2.568,6.563C255.641,364.59,257.828,365.445,260.494,365.445z"
											/>
									</g>
								</g>
							</svg>
						</td>
						<td data-col="tujuan" data-sortable="true" data-sort-value="">Tujuan
							<svg class="tr-icon" data-value="asc" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="20" height="20" viewBox="0 0 500 500" xml:space="preserve">
								<g>
									<g>
										<path d="M260.494,219.271H388.4c2.666,0,4.855-0.855,6.563-2.57c1.715-1.713,2.573-3.9,2.573-6.567v-54.816
											c0-2.667-0.858-4.854-2.573-6.567c-1.708-1.711-3.897-2.57-6.563-2.57H260.494c-2.666,0-4.853,0.855-6.567,2.57
											c-1.71,1.713-2.568,3.9-2.568,6.567v54.816c0,2.667,0.855,4.854,2.568,6.567C255.641,218.413,257.828,219.271,260.494,219.271z"/>
										<path d="M260.497,73.089h73.087c2.666,0,4.856-0.855,6.563-2.568c1.718-1.714,2.563-3.901,2.563-6.567V9.136
											c0-2.663-0.846-4.853-2.563-6.567C338.44,0.859,336.25,0,333.584,0h-73.087c-2.666,0-4.853,0.855-6.567,2.568
											c-1.709,1.715-2.568,3.905-2.568,6.567v54.818c0,2.666,0.855,4.853,2.568,6.567C255.645,72.23,257.831,73.089,260.497,73.089z"/>
										<path d="M196.54,401.991h-54.817V9.136c0-2.663-0.854-4.856-2.568-6.567C137.441,0.859,135.254,0,132.587,0H77.769
											c-2.663,0-4.856,0.855-6.567,2.568c-1.709,1.715-2.568,3.905-2.568,6.567v392.855H13.816c-4.184,0-7.04,1.902-8.564,5.708
											c-1.525,3.621-0.855,6.95,1.997,9.996l91.361,91.365c2.094,1.707,4.281,2.562,6.567,2.562c2.474,0,4.665-0.855,6.567-2.562
											l91.076-91.078c1.906-2.279,2.856-4.571,2.856-6.844c0-2.676-0.859-4.859-2.568-6.584
											C201.395,402.847,199.208,401.991,196.54,401.991z"/>
										<path d="M504.604,441.109c-1.715-1.718-3.901-2.573-6.567-2.573H260.497c-2.666,0-4.853,0.855-6.567,2.573
											c-1.709,1.711-2.568,3.901-2.568,6.564v54.815c0,2.673,0.855,4.853,2.568,6.571c1.715,1.711,3.901,2.566,6.567,2.566h237.539
											c2.666,0,4.853-0.855,6.567-2.566c1.711-1.719,2.566-3.898,2.566-6.571v-54.815C507.173,445.011,506.314,442.82,504.604,441.109z"
											/>
										<path d="M260.494,365.445H443.22c2.663,0,4.853-0.855,6.57-2.566c1.708-1.711,2.563-3.901,2.563-6.563v-54.823
											c0-2.662-0.855-4.853-2.563-6.563c-1.718-1.711-3.907-2.566-6.57-2.566H260.494c-2.666,0-4.853,0.855-6.567,2.566
											c-1.71,1.711-2.568,3.901-2.568,6.563v54.823c0,2.662,0.855,4.853,2.568,6.563C255.641,364.59,257.828,365.445,260.494,365.445z"
											/>
									</g>
								</g>
							</svg>
						</td>
						<td class="td-km" data-col="km" data-sortable="true" data-sort-value="">Km
							<svg class="tr-icon" data-value="asc" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="20" height="20" viewBox="0 0 500 500" xml:space="preserve">
								<g>
									<g>
										<path d="M260.494,219.271H388.4c2.666,0,4.855-0.855,6.563-2.57c1.715-1.713,2.573-3.9,2.573-6.567v-54.816
											c0-2.667-0.858-4.854-2.573-6.567c-1.708-1.711-3.897-2.57-6.563-2.57H260.494c-2.666,0-4.853,0.855-6.567,2.57
											c-1.71,1.713-2.568,3.9-2.568,6.567v54.816c0,2.667,0.855,4.854,2.568,6.567C255.641,218.413,257.828,219.271,260.494,219.271z"/>
										<path d="M260.497,73.089h73.087c2.666,0,4.856-0.855,6.563-2.568c1.718-1.714,2.563-3.901,2.563-6.567V9.136
											c0-2.663-0.846-4.853-2.563-6.567C338.44,0.859,336.25,0,333.584,0h-73.087c-2.666,0-4.853,0.855-6.567,2.568
											c-1.709,1.715-2.568,3.905-2.568,6.567v54.818c0,2.666,0.855,4.853,2.568,6.567C255.645,72.23,257.831,73.089,260.497,73.089z"/>
										<path d="M196.54,401.991h-54.817V9.136c0-2.663-0.854-4.856-2.568-6.567C137.441,0.859,135.254,0,132.587,0H77.769
											c-2.663,0-4.856,0.855-6.567,2.568c-1.709,1.715-2.568,3.905-2.568,6.567v392.855H13.816c-4.184,0-7.04,1.902-8.564,5.708
											c-1.525,3.621-0.855,6.95,1.997,9.996l91.361,91.365c2.094,1.707,4.281,2.562,6.567,2.562c2.474,0,4.665-0.855,6.567-2.562
											l91.076-91.078c1.906-2.279,2.856-4.571,2.856-6.844c0-2.676-0.859-4.859-2.568-6.584
											C201.395,402.847,199.208,401.991,196.54,401.991z"/>
										<path d="M504.604,441.109c-1.715-1.718-3.901-2.573-6.567-2.573H260.497c-2.666,0-4.853,0.855-6.567,2.573
											c-1.709,1.711-2.568,3.901-2.568,6.564v54.815c0,2.673,0.855,4.853,2.568,6.571c1.715,1.711,3.901,2.566,6.567,2.566h237.539
											c2.666,0,4.853-0.855,6.567-2.566c1.711-1.719,2.566-3.898,2.566-6.571v-54.815C507.173,445.011,506.314,442.82,504.604,441.109z"
											/>
										<path d="M260.494,365.445H443.22c2.663,0,4.853-0.855,6.57-2.566c1.708-1.711,2.563-3.901,2.563-6.563v-54.823
											c0-2.662-0.855-4.853-2.563-6.563c-1.718-1.711-3.907-2.566-6.57-2.566H260.494c-2.666,0-4.853,0.855-6.567,2.566
											c-1.71,1.711-2.568,3.901-2.568,6.563v54.823c0,2.662,0.855,4.853,2.568,6.563C255.641,364.59,257.828,365.445,260.494,365.445z"
											/>
									</g>
								</g>
							</svg>
						</td>
						<td data-col="berakhir" data-sortable="true" data-sort-value="">Berakhir
							<svg class="tr-icon" data-value="asc" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="20" height="20" viewBox="0 0 500 500" xml:space="preserve">
								<g>
									<g>
										<path d="M260.494,219.271H388.4c2.666,0,4.855-0.855,6.563-2.57c1.715-1.713,2.573-3.9,2.573-6.567v-54.816
											c0-2.667-0.858-4.854-2.573-6.567c-1.708-1.711-3.897-2.57-6.563-2.57H260.494c-2.666,0-4.853,0.855-6.567,2.57
											c-1.71,1.713-2.568,3.9-2.568,6.567v54.816c0,2.667,0.855,4.854,2.568,6.567C255.641,218.413,257.828,219.271,260.494,219.271z"/>
										<path d="M260.497,73.089h73.087c2.666,0,4.856-0.855,6.563-2.568c1.718-1.714,2.563-3.901,2.563-6.567V9.136
											c0-2.663-0.846-4.853-2.563-6.567C338.44,0.859,336.25,0,333.584,0h-73.087c-2.666,0-4.853,0.855-6.567,2.568
											c-1.709,1.715-2.568,3.905-2.568,6.567v54.818c0,2.666,0.855,4.853,2.568,6.567C255.645,72.23,257.831,73.089,260.497,73.089z"/>
										<path d="M196.54,401.991h-54.817V9.136c0-2.663-0.854-4.856-2.568-6.567C137.441,0.859,135.254,0,132.587,0H77.769
											c-2.663,0-4.856,0.855-6.567,2.568c-1.709,1.715-2.568,3.905-2.568,6.567v392.855H13.816c-4.184,0-7.04,1.902-8.564,5.708
											c-1.525,3.621-0.855,6.95,1.997,9.996l91.361,91.365c2.094,1.707,4.281,2.562,6.567,2.562c2.474,0,4.665-0.855,6.567-2.562
											l91.076-91.078c1.906-2.279,2.856-4.571,2.856-6.844c0-2.676-0.859-4.859-2.568-6.584
											C201.395,402.847,199.208,401.991,196.54,401.991z"/>
										<path d="M504.604,441.109c-1.715-1.718-3.901-2.573-6.567-2.573H260.497c-2.666,0-4.853,0.855-6.567,2.573
											c-1.709,1.711-2.568,3.901-2.568,6.564v54.815c0,2.673,0.855,4.853,2.568,6.571c1.715,1.711,3.901,2.566,6.567,2.566h237.539
											c2.666,0,4.853-0.855,6.567-2.566c1.711-1.719,2.566-3.898,2.566-6.571v-54.815C507.173,445.011,506.314,442.82,504.604,441.109z"
											/>
										<path d="M260.494,365.445H443.22c2.663,0,4.853-0.855,6.57-2.566c1.708-1.711,2.563-3.901,2.563-6.563v-54.823
											c0-2.662-0.855-4.853-2.563-6.563c-1.718-1.711-3.907-2.566-6.57-2.566H260.494c-2.666,0-4.853,0.855-6.567,2.566
											c-1.71,1.711-2.568,3.901-2.568,6.563v54.823c0,2.662,0.855,4.853,2.568,6.563C255.641,364.59,257.828,365.445,260.494,365.445z"
											/>
									</g>
								</g>
							</svg>
						</td>
					</tr>
				</thead>
				<tbody class="tbody-kiriman">
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
</div>
</div>
<script type="text/javascript">
var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var headerHeight, sectionHeight, sectionTop, sectionPosition, theadHeight, tbodyTop, tbodyPosition;
var alreadyRefresh = false;
$(function() {
	if ($(".header").length > 0) {
		headerHeight = parseInt($(".header").css("height")) || 0;
	} else {
		headerHeight = parseInt($(".navigation-header").css("height")) || 0;
	}
	
	sectionHeight = parseInt($(".section").css("height")) || 0;
	sectionTop = $(".section").offset().top;
	sectionPosition = sectionTop - headerHeight;
	theadHeight = parseInt($(".table-kiriman thead").css("height")) || 0;
	tbodyTop = $(".table-kiriman tbody").offset().top;
	tbodyPosition = tbodyTop - headerHeight - theadHeight - sectionHeight;

	getKiriman();
	
	if ($(".container-content").length > 0) {
		$(".container-content").on("scroll", scrollDownEvent);
	} else {
		$(document).on("scroll", scrollDownEvent);
	}
	
	$(".select-sort").on("change", function() {
		getKiriman();
	});
	
	$(".input-kota-asal").on("input", function() {
		var keyword = $(this).val();
		getKota("from", keyword);
	});
	
	$(".input-kota-tujuan").on("input", function() {
		var keyword = $(this).val();
		getKota("to", keyword);
	});
	
	$(".input-kota-asal, .input-kota-tujuan, .input-jarak-max").on("keypress", function(e) {
		if (e.which == 13) {
			var datalistItem = $(this).next().find(".datalist-item.active");
			if (datalistItem.length > 0) {
				$(datalistItem).mousedown();
			}  else {
				$(this).blur();
			}
		}
	});
	
	$(".input-kota-asal, .input-kota-tujuan").on("keydown", function(e) {
		if (e.which == 40) { //DOWN
			setActiveDatalistItem(this, 1);
		} else if (e.which == 38) { //UP
			setActiveDatalistItem(this, -1);
		}
	});

	$(".input-kota-asal, .input-kota-tujuan").on("focusout", function() {
		hideDatalist();
		if (!alreadyRefresh) {
			getKiriman();
		} else {
			alreadyRefresh = false;
		}
	});

	$(".input-jarak-slider").on("input", function() {
		let value = $(this).val();
		$(".input-jarak-max").val(value);
	});

	$(".input-jarak-slider").on("change", function() {
		getKiriman();
	});
	
	$(".input-jarak-max").on("change", function(e) {
		let value = $(this).val();
		$(".input-jarak-slider").val(value);
		getKiriman();
	});

	$(".input-jarak-max").on("change", function() {
		let value = parseInt($(this).val());
		if (value > 2000) {
			$(this).val("2000");
		}
	});

	$(".input-jarak-max").on("keydown", function(e) {
		isNumber(e);
	});
	
	$(document).on("click", function(e) {
		if ($(e.target).closest(".datalist").length == 0) {
			hideDatalist();
		}
	});

	$(document).on("mousedown", ".datalist-item", function() {
		alreadyRefresh = true;
		var value = $(this).html();
		var fromto = $(this).data("fromto");
		$(".input-kota-" + fromto).val(value);
		hideDatalist();
		$(this).parent().prev().blur();
		getKiriman();
	});

	$("td[data-sortable='true']").on("click", function() {
		var col = $(this).data("col");
		var sort = $(this).data("sort-value");
		if (sort == "" || sort == "desc") {
			sort = "asc";
		} else {
			sort = "desc";
		}
	});

	$(".select-view-per-page").on("change", function() {
		getKiriman();
	});

	paginationCallback = function() {
		getKiriman(true);
	};

});

function setActiveDatalistItem(element, arah) {
	var parent = $(element).next();
	var count = $(parent).find(".datalist-item").length;
	if (count > 0) {
		var current = parseInt($(parent).find(".datalist-item.active").data("index")) || 0;
		current += arah;
		if (current <= 0) {
			current = 1;
		} else if (current >= count) {
			current = count;
		}
		
		$(parent).find(".datalist-item.active").removeClass("active");
		$(parent).find(".datalist-item[data-index='" + current + "']").addClass("active");
	}
}

function scrollDownEvent() {
	var scrollTop = $(this).scrollTop();
	if (scrollTop >= sectionPosition) {
		$(".section, .table-kiriman").addClass("fixed");
		$(".section").css("top", headerHeight);
		$(".table-kiriman thead").css("top", headerHeight + sectionHeight);
		$(this).off("scroll");
		$(this).on("scroll", scrollUpEvent);
	}
}

function scrollUpEvent() {
	var scrollTop = $(this).scrollTop();
	if (scrollTop <= sectionPosition) {
		$(".section, .table-kiriman").removeClass("fixed");
		$(this).off("scroll");
		$(this).on("scroll", scrollDownEvent);
	}
}

function getKota(fromto, keyword) {
	var data = {
		fromto: fromto,
		keyword: keyword
	};
	
	ajaxCall("<?= base_url("kirim/getKota") ?>", data, function(json) {
		var result = jQuery.parseJSON(json);
		var element = "";
		var iLength = result.length;
		if (iLength > 0) {
			for (var i = 0; i < iLength; i++) {
				element += "<div class='datalist-item " + fromto + "-city-dropdown-item' data-fromto='" + fromto + "' data-index='" + (i + 1) + "'>" + result[i].city + "</div>";
			}
		} else {
			element += "<div class='datalist-empty-state'>Tidak ada hasil</div>";
		}
		$("." + fromto + "-city-dropdown").html(element);
		showDatalist(fromto);
	});
}

function showDatalist(fromto) {
	$("." + fromto + "-city-dropdown").css("display", "block");
}

function hideDatalist() {
	$(".datalist").css("display", "none");
}

function scrollToTop() {
	if ($(".container-content").length > 0) {
		$(".container-content").scrollTop(0);
	} else {
		$(document).scrollTop(0);
	}
}

function getKiriman(changePage = false) {
	abortAjaxCall();
	$(".tbody-kiriman").html("");
	setLoading(".table-empty-state");
	var jarak_max = parseInt($(".input-jarak-max").val()) || 0;
	var order_by = $(".select-sort").val();
	var keyword_from = $(".input-kota-asal").val();
	var keyword_to = $(".input-kota-tujuan").val();
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
		keyword_from: keyword_from,
		keyword_to: keyword_to,
		shipment_length_max: jarak_max,
		order_by: order_by,
		view_per_page: view_per_page,
		page: page,
		change_page: changePage
	};
	ajaxCall("<?= base_url("kirim/getKiriman") ?>", data, function(json) {
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

		$(".tbody-kiriman").html("");
		var iLength = result.data.length;
		for (var i = 0; i < iLength; i++) {
			addKirimanToTable((i + 1), result.data[i]);
		}
		if (iLength == 0) {
			$(".table-empty-state").addClass("shown");
		} else {
			$(".table-empty-state").removeClass("shown");
		}
	});
}

function addKirimanToTable(no, result) {
	var date_from = new Date(result.shipment_delivery_date_from);
	var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2, 4);
	var date_to = new Date(result.shipment_delivery_date_to);
	var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2, 4);
	
	var shipment_picture = (result.shipment_pictures == "") ? "default.gif" : result.shipment_pictures;
	var element = "<tr class='tr-kiriman' data-id='" + result.shipment_id + "'><td class='td-title' data-col='nama-kirim'><a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + "<img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + shipment_picture + "' onerror='this.onerror=null; this.src=\"<?php echo base_url("assets/panel/images/default.gif"); ?>\";' /><span>" + result.shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result.bidding_count + "<br>Low : " + addCommas(result.low) + " IDR</td><td class='td-asal' data-col='asal'>" + result.location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result.location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-col='km'>" + parseInt(result.shipment_length) + "</td><td class='td-berakhir' data-col='berakhir'>" + result.berakhir + "</td></td></tr>";
	$(".tbody-kiriman").append(element);
}
</script>