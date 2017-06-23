var datepickerMonthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
(function($) {
	$.fn.datepicker = function(options) {
		
		var thisClass = $(this).attr("class");
		var thisElement = this;
		var settings = $.extend({
			disableDateBefore: false,
			disableDateAfter: false
		}, options);
		datepickerInitialize(thisClass, this, settings);
		
		var datepickerElement = $(".datepicker[data-class='" + thisClass + "']");
		
		$(this).prop("readonly", true);
		$(this).css("cursor", "text");
		
		$(this).on("click", function() {
			datepickerShow(datepickerElement, thisElement, settings);
		});
		
		$("body").on("click", function(e) {
			if (!$(e.target).is(thisElement) && $(e.target).closest(datepickerElement).length === 0) {
				datepickerHide(datepickerElement);
			}
		});
		
		$(datepickerElement).on("click", ".datepicker-tanggal:not([data-disabled='1'])", function() {
			var value = $(this).data("value");
			$(thisElement).val(value);
			datepickerHide(datepickerElement);
		});
		
		$(datepickerElement).on("click", ".next-month-icon:not([data-disabled='1'])", function() {
			datepickerNextMonth(datepickerElement, settings);
		});
		
		$(datepickerElement).on("click", ".prev-month-icon:not([data-disabled='1'])", function() {
			datepickerPrevMonth(datepickerElement, settings);
		});
	};
}(jQuery));

function datepickerShow(datepickerElement, thisElement, settings) {
	if ($(datepickerElement).data("shown") == false) {
		var value = $(thisElement).val();
		if (value != "") {
			alert($(datepickerElement).find(".datepicker-tanggal[data-value='" + value + "']").length);
			$(datepickerElement).find(".datepicker-tanggal[data-value='" + value + "']").attr("data-set", "1");
			var item = value.split("-");
			var date = parseInt(item[2]);
			var month = parseInt(item[1]);
			var year = parseInt(item[0]);
			month--;
			if (month < 0) {
				month = 11;
			}
			if (month % 2 == 1) {
				month--;
			}

			changeMonth(datepickerElement, year, month, settings);
		}

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

function datepickerNextMonth(datepickerElement, settings) {
	var nextMonth = parseInt($(datepickerElement).data("current-month")) + 2;
	var currentYear = parseInt($(datepickerElement).data("current-year"));
	
	changeMonth(datepickerElement, currentYear, nextMonth, settings);
}

function datepickerPrevMonth(datepickerElement, settings) {
	var prevMonth = parseInt($(datepickerElement).data("current-month")) - 2;
	var currentYear = parseInt($(datepickerElement).data("current-year"));
	
	changeMonth(datepickerElement, currentYear, prevMonth, settings);
}

function changeMonth(datepickerElement, currentYear, currentMonth, settings) {
	var date = new Date(currentYear, currentMonth, 1);
	var month = date.getMonth();
	var year = date.getFullYear();
	var secondDate = new Date(currentYear, currentMonth + 1, 1);
	var month2 = secondDate.getMonth();
	var year2 = secondDate.getFullYear();
	
	var isThisMonth = false;
	if (month == new Date().getMonth() && year == new Date().getFullYear()) {
		isThisMonth = true;
		date = new Date();
		$(datepickerElement).find(".prev-month-icon").attr("data-disabled", "1");
	} else {
		$(datepickerElement).find(".prev-month-icon").removeAttr("data-disabled");
	}
	
	var firstMonth = datepickerAssignDate(date, isThisMonth, settings);
	
	var isThisMonth2 = false;
	if (month2 == new Date().getMonth() && year2 == new Date().getFullYear()) {
		isThisMonth2 = true;
		secondDate = new Date();
	}
	var secondMonth = datepickerAssignDate(secondDate, isThisMonth2, settings);
	
	$(datepickerElement).find(".datepicker-bulan-title-name.first-month").html(datepickerMonthNames[month] + " " + year);
	$(datepickerElement).find(".datepicker-bulan-title-name.second-month").html(datepickerMonthNames[month + 1] + " " + year);
	$(datepickerElement).find(".datepicker-tanggal-container.first-month").html(firstMonth);
	$(datepickerElement).find(".datepicker-tanggal-container.second-month").html(secondMonth);
	
	$(datepickerElement).data("current-month", date.getMonth());
	$(datepickerElement).data("current-year", date.getFullYear());
	
	if (isThisMonth || isThisMonth2) {
		var monthPosition = "first";
		if (isThisMonth2) {
			monthPosition = "second";
		}
		var today = new Date().getDate();
		$(datepickerElement).find(".datepicker-tanggal-container." + monthPosition + "-month .datepicker-tanggal[data-date-of-month='" + today + "']").attr("data-today", "1");
	}
}

function datepickerInitialize(thisClass, thisElement, settings) {
	var date = new Date();
	var today = date.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	var secondDate;
	var isThisMonth = true;
	var monthPosition = "first";
	if (month % 2 == 1) {
		isThisMonth = false;
		monthPosition = "second";
		secondDate = date;
		date = new Date(year, month - 1, today);
		month--;
	} else {
		secondDate = new Date(year, month + 1, 1);
	}

	var element =	'<div class="datepicker" data-class="' + thisClass + '" data-shown="false" data-current-month="' + month + '" data-current-year="' + year + '"><div class="datepicker-content"><div class="datepicker-bulan-container"><div class="datepicker-bulan-title"><span class="datepicker-bulan-title-name first-month">' + datepickerMonthNames[month] + ' ' + year + '</span><svg class="prev-month-icon" fill="#FFFFFF" height="35" viewBox="0 0 24 24" width="35" ><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div><div class="datepicker-hari-container"><span class="datepicker-hari-nama" data-value="0">Mi</span><span class="datepicker-hari-nama" data-value="1">Se</span><span class="datepicker-hari-nama" data-value="2">Se</span><span class="datepicker-hari-nama" data-value="3">Ra</span><span class="datepicker-hari-nama" data-value="4">Ka</span><span class="datepicker-hari-nama" data-value="5">Ju</span><span class="datepicker-hari-nama" data-value="6">Sa</span></div><div class="datepicker-tanggal-container first-month">' + datepickerAssignDate(date, isThisMonth, settings) + '</div></div><div class="datepicker-bulan-container"><div class="datepicker-bulan-title"><span class="datepicker-bulan-title-name second-month">' + datepickerMonthNames[month + 1] + ' ' + year + '</span><svg class="next-month-icon" fill="#FFFFFF" height="35" viewBox="0 0 24 24" width="35"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div><div class="datepicker-hari-container"><span class="datepicker-hari-nama" data-value="0">Mi</span><span class="datepicker-hari-nama" data-value="1">Se</span><span class="datepicker-hari-nama" data-value="2">Se</span><span class="datepicker-hari-nama" data-value="3">Ra</span><span class="datepicker-hari-nama" data-value="4">Ka</span><span class="datepicker-hari-nama" data-value="5">Ju</span><span class="datepicker-hari-nama" data-value="6">Sa</span></div><div class="datepicker-tanggal-container second-month">' + datepickerAssignDate(secondDate, !isThisMonth, settings) + '</div></div></div><div class="datepicker-footer"></div></div>';
	
	$(".container-content").append(element);
	$(".datepicker[data-class='" + thisClass + "'] .datepicker-tanggal-container." + monthPosition + "-month .datepicker-tanggal[data-date-of-month='" + today + "']").attr("data-today", "1");
}

function datepickerAssignDate(date, thisMonth, settings = null) {
	var today = date.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	
	var tgl1 = new Date(year, month, 1);
	var tgl1Day = tgl1.getDay();
	var tglMax = new Date(year, month + 1, 0).getDate();

	var disableDateBeforeToday = false, disableDateAfterToday = false;
	if (settings) {
		disableDateBeforeToday = settings.disableDateBefore;
		disableDateAfterToday = settings.disableDateAfter;
	}

	return datepickerAssignDateForMonth(today, month, year, tgl1Day, tglMax, thisMonth, disableDateBeforeToday, disableDateAfterToday);
}

function datepickerAssignDateForMonth(today, month, year, tgl1Day, tglMax, thisMonth, disableDateBeforeToday, disableDateAfterToday) {
	var element = "";
	
	if (thisMonth) {
		element += datepickerSetAvailableDateWithToday(today, month, year, tgl1Day, tglMax, disableDateBeforeToday, disableDateAfterToday);
	} else {
		element += datepickerSetAvailableDate(month, year, tgl1Day, tglMax, disableDateBeforeToday, disableDateAfterToday);
	}
	
	return element;
}

function datepickerSetAvailableDateWithToday(today, month, year, tgl1Day, tglMax, disableDateBeforeToday, disableDateAfterToday) {
	var thisMonth = new Date().getMonth();
	var thisYear = new Date().getFullYear();
	var disabledBefore = "", disabledAfter = "";
	if (disableDateBeforeToday) {
		disabledBefore = "data-disabled='1'";
	}

	if (disableDateAfterToday) {
		disabledAfter = "data-disabled='1'";
	}

	var ctrDate = 1;
	var element = "";
	element += '<div class="datepicker-tanggal-row">';
	for (var i = 0; i < 7; i++) {
		var value = year + "-" + (month + 1) + "-" + ctrDate;
		if (i >= tgl1Day) {
			if (ctrDate < today) {
				element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '" ' + disabledBefore + '>' + ctrDate + '</span>';
			} else if (ctrDate > today) {
				element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '" ' + disabledAfter + '>' + ctrDate + '</span>';
			} else {
				element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '">' + ctrDate + '</span>';
			}
			ctrDate++;
		} else {
			element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
		}
	}
	element += "</div>";
	for (var i = 1; i < 6; i++) {
		element += '<div class="datepicker-tanggal-row">';
		for (var j = 0; j < 7; j++) {
			var value = year + "-" + (month + 1) + "-" + ctrDate;
			if (ctrDate <= tglMax) {
				if (ctrDate < today) {
					element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '" ' + disabledBefore + '>' + ctrDate + '</span>';
				} else if (ctrDate > today) {
					element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '" ' + disabledAfter + '>' + ctrDate + '</span>';
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
	return element;
}

function datepickerSetAvailableDate(month, year, tgl1Day, tglMax, disableDateBeforeToday, disableDateAfterToday) {
	var thisMonth = new Date().getMonth();
	var thisYear = new Date().getFullYear();
	var disabled = "";
	if (disableDateBeforeToday) {
		if (month < thisMonth) {
			disabled = "data-disabled='1'";
		} else if (year < thisYear) {
			disabled = "data-disabled='1'";
		}
	}

	if (disableDateAfterToday) {
		if (month > thisMonth) {
			disabled = "data-disabled='1'";
		} else if (year > thisYear) {
			disabled = "data-disabled='1'";
		}
	}
	
	var ctrDate = 1;
	var element = "";
	element += '<div class="datepicker-tanggal-row">';
	for (var i = 0; i < 7; i++) {
		var value = year + "-" + (month + 1) + "-" + ctrDate;
		if (i >= tgl1Day) {
			element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '" ' + disabled + '>' + ctrDate + '</span>';
			ctrDate++;
		} else {
			element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
		}
	}
	element += "</div>";
	for (var i = 1; i < 6; i++) {
		element += '<div class="datepicker-tanggal-row">';
		for (var j = 0; j < 7; j++) {
			var value = year + "-" + (month + 1) + "-" + ctrDate;
			if (ctrDate <= tglMax) {
				element += '<span class="datepicker-tanggal" data-date-of-month="' + ctrDate + '" data-value="' + value + '" ' + disabled + '>' + ctrDate + '</span>';
				ctrDate++;
			} else {
				element += '<span class="datepicker-tanggal" data-current-month="0"></span>';
			}
		}
		element += "</div>";
	}
	return element;
}