var datepickerMonthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
(function($) {
	$.fn.datepicker = function() {
		
		var thisClass = $(this).attr("class");
		var thisElement = this;
		datepickerInitialize(thisClass, this);
		
		var datepickerElement = $(".datepicker[data-class='" + thisClass + "']");
		
		$(this).on("keydown", function(e) {
			e.preventDefault();
		});
		
		$(this).on("click", function() {
			datepickerShow(datepickerElement, thisElement);
		});
		
		$("body").on("click", function(e) {
			if (!$(e.target).is(thisElement) && $(e.target).closest(datepickerElement).length === 0) {
				datepickerHide(datepickerElement);
			}
		});
		
		$(datepickerElement).find(".datepicker-tanggal:not([data-disabled='1'])").on("click", function() {
			var value = $(this).data("value");
			$(thisElement).val(value);
			datepickerHide(datepickerElement);
		});
		
		$(datepickerElement).on("click", ".next-month-icon", function() {
			datepickerNextMonth(datepickerElement);
		});
		
		$(datepickerElement).on("click", ".prev-month-icon", function() {
			datepickerPrevMonth(datepickerElement);
		});
	};
}(jQuery));

function datepickerShow(datepickerElement, thisElement) {
	if ($(datepickerElement).data("shown") == false) {
		$(datepickerElement).data("shown", true);
		$(datepickerElement).offset({
			top: $(thisElement).offset().top + parseInt($(thisElement).css("height")) + 10,
			left: $(thisElement).offset().left
		});
		$(datepickerElement).css("visibility", "visible");
		$(datepickerElement).velocity({
			opacity: 1
		}, 100);
	}
}

function datepickerHide(datepickerElement) {
	if ($(datepickerElement).data("shown") == true) {
		$(datepickerElement).data("shown", false);
		$(datepickerElement).velocity({
			opacity: 0
		}, 150, function() {
			$(datepickerElement).css("visibility", "hidden");
		});
	}
}

function datepickerNextMonth(datepickerElement) {
	var nextMonth = parseInt($(datepickerElement).data("current-month")) + 2;
	var currentYear = parseInt($(datepickerElement).data("current-year"));
	
	changeMonth(datepickerElement, currentYear, nextMonth);
}

function datepickerPrevMonth(datepickerElement) {
	var prevMonth = parseInt($(datepickerElement).data("current-month")) - 2;
	var currentYear = parseInt($(datepickerElement).data("current-year"));
	
	changeMonth(datepickerElement, currentYear, prevMonth);
}

function changeMonth(datepickerElement, currentYear, currentMonth) {
	var date = new Date(currentYear, currentMonth, 1);
	var month = date.getMonth();
	var year = date.getFullYear();
	var secondDate = new Date(currentYear, currentMonth + 1, 1);
	
	var firstMonth = datepickerAssignDate(date, false);
	var secondMonth = datepickerAssignDate(secondDate, false);
	
	$(datepickerElement).find(".datepicker-bulan-title-name.first-month").html(datepickerMonthNames[month] + " " + year);
	$(datepickerElement).find(".datepicker-bulan-title-name.second-month").html(datepickerMonthNames[month + 1] + " " + year);
	$(datepickerElement).find(".datepicker-tanggal-container.first-month").html(firstMonth);
	$(datepickerElement).find(".datepicker-tanggal-container.second-month").html(secondMonth);
	
	$(datepickerElement).data("current-month", date.getMonth());
	$(datepickerElement).data("current-year", date.getFullYear());
}

function datepickerInitialize(thisClass, thisElement) {
	var date = new Date();
	var today = date.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	var secondDate;
	
	var monthPosition = "first";
	if (month % 2 == 1) {
		monthPosition = "second";
		secondDate = date;
		date = new Date(year, month - 1, today);
		month--;
	} else {
		secondDate = new Date(year, month + 1, 1);
	}
		
	var element =	'<div class="datepicker" data-class="' + thisClass + '" data-shown="false" data-current-month="' + month + '" data-current-year="' + year + '"><div class="datepicker-content"><div class="datepicker-bulan-container"><div class="datepicker-bulan-title"><span class="datepicker-bulan-title-name first-month">' + datepickerMonthNames[month] + ' ' + year + '</span><svg class="prev-month-icon" fill="#FFFFFF" height="35" viewBox="0 0 24 24" width="35" ><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div><div class="datepicker-hari-container"><span class="datepicker-hari-nama" data-value="0">Mi</span><span class="datepicker-hari-nama" data-value="1">Se</span><span class="datepicker-hari-nama" data-value="2">Se</span><span class="datepicker-hari-nama" data-value="3">Ra</span><span class="datepicker-hari-nama" data-value="4">Ka</span><span class="datepicker-hari-nama" data-value="5">Ju</span><span class="datepicker-hari-nama" data-value="6">Sa</span></div><div class="datepicker-tanggal-container first-month">' + datepickerAssignDate(date, true) + '</div></div><div class="datepicker-bulan-container"><div class="datepicker-bulan-title"><span class="datepicker-bulan-title-name second-month">' + datepickerMonthNames[month + 1] + ' ' + year + '</span><svg class="next-month-icon" fill="#FFFFFF" height="35" viewBox="0 0 24 24" width="35"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div><div class="datepicker-hari-container"><span class="datepicker-hari-nama" data-value="0">Mi</span><span class="datepicker-hari-nama" data-value="1">Se</span><span class="datepicker-hari-nama" data-value="2">Se</span><span class="datepicker-hari-nama" data-value="3">Ra</span><span class="datepicker-hari-nama" data-value="4">Ka</span><span class="datepicker-hari-nama" data-value="5">Ju</span><span class="datepicker-hari-nama" data-value="6">Sa</span></div><div class="datepicker-tanggal-container second-month">' + datepickerAssignDate(secondDate, false) + '</div></div></div><div class="datepicker-footer"></div></div>';
	
	$(".container-content").append(element);
	$(".datepicker[data-class='" + thisClass + "'] .datepicker-tanggal-container." + monthPosition + "-month .datepicker-tanggal[data-date-of-month='" + today + "']").attr("data-today", "1");
}

function datepickerAssignDate(date, thisMonth) {
	var today = date.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	
	var tgl1 = new Date(year, month, 1);
	var tgl1Day = tgl1.getDay();
	var tglMax = new Date(year, month + 1, 0).getDate();

	return datepickerAssignDateForMonth(today, month, year, tgl1Day, tglMax, thisMonth);
}

function datepickerAssignDateForMonth(today, month, year, tgl1Day, tglMax, thisMonth) {
	var ctrDate = 1;
	var element = "";
	
	if (thisMonth) {
		element += '<div class="datepicker-tanggal-row">';
		for (var i = 0; i < 7; i++) {
			var value = year + "-" + (month + 1) + "-" + ctrDate;
			if (i >= tgl1Day) {
				if (ctrDate < today) {
					element += '<span class="datepicker-tanggal" data-disabled="1">' + ctrDate + '</span>';
				} else {
					element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '">' + ctrDate + '</span>';
				}
				ctrDate++;
			} else {
				element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
			}
		}
		element += "</div>";
		for (var i = 1; i < 5; i++) {
			element += '<div class="datepicker-tanggal-row">';
			for (var j = 0; j < 7; j++) {
				var value = year + "-" + (month + 1) + "-" + ctrDate;
				if (ctrDate <= tglMax) {
					if (ctrDate < today) {
						element += '<span class="datepicker-tanggal" data-disabled="1">' + ctrDate + '</span>';
					} else {
						element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '">' + ctrDate + '</span>';
					}
					ctrDate++;
				} else {
					element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
				}
			}
			element += "</div>";
		}
	} else {
		element += '<div class="datepicker-tanggal-row">';
		for (var i = 0; i < 7; i++) {
			var value = year + "-" + (month + 1) + "-" + ctrDate;
			if (i >= tgl1Day) {
				element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '">' + ctrDate + '</span>';
				ctrDate++;
			} else {
				element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
			}
		}
		element += "</div>";
		for (var i = 1; i < 5; i++) {
			element += '<div class="datepicker-tanggal-row">';
			for (var j = 0; j < 7; j++) {
				var value = year + "-" + (month + 1) + "-" + ctrDate;
				if (ctrDate <= tglMax) {
					element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '">' + ctrDate + '</span>';
					ctrDate++;
				} else {
					element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
				}
			}
			element += "</div>";
		}
	}
	
	return element;
}