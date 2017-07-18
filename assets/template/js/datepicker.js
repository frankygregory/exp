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
		$(this).data("value-date", "");
		$(this).data("value-time", "");
		
		$(this).on("click", function() {
			datepickerShow(datepickerElement, thisElement, settings);
		});
		
		$("body").on("click", function(e) {
			if (!$(e.target).is(thisElement) && $(e.target).closest(datepickerElement).length === 0) {
				datepickerHide(datepickerElement);
			}
		});
		
		datepickerElement.on("click", ".datepicker-tanggal:not([data-disabled='1'])", function() {
			var value = $(this).data("value");
			thisElement.data("value-date", value);

			datepickerSetDate(datepickerElement, thisElement);
			datepickerSetTime(datepickerElement, thisElement);
		});
		
		datepickerElement.on("click", ".next-month-icon:not([data-disabled='1'])", function() {
			datepickerNextMonth(datepickerElement, settings);
		});
		
		datepickerElement.on("click", ".prev-month-icon:not([data-disabled='1'])", function() {
			datepickerPrevMonth(datepickerElement, settings);
		});

		datepickerElement.on("click", ".datepicker-up-icon", function() {
			datepickerUpClick($(this), datepickerElement, thisElement);
		});

		datepickerElement.on("click", ".datepicker-down-icon", function() {
			datepickerDownClick($(this), datepickerElement, thisElement);
		});

		datepickerElement.on("focusout", ".datepicker-input-jam, .datepicker-input-menit", function(e) {
			datepickerSetDate(datepickerElement, thisElement);
			datepickerSetTime(datepickerElement, thisElement);
		});

		datepickerElement.on("keydown", ".datepicker-input-jam, .datepicker-input-menit", function(e) {
			isNumber(e);
		});

		datepickerElement.on("click", ".datetimepicker-btn-ok", function() {
			datepickerHide(datepickerElement);
		})
	};
}(jQuery));

function datepickerUpClick(element, datepickerElement, thisElement) {
	var type = $(element).data("value");
	var limit = (type == "jam" ? 23 : 59);
	var time = parseInt($(element).next().val());
	time++;
	time = (time > limit ? 0 : time) + "";
	time = (time.length == 1 ? "0" + time : time);
	$(element).next().val(time);

	datepickerSetDate(datepickerElement, thisElement);
	datepickerSetTime(datepickerElement, thisElement);
}

function datepickerDownClick(element, datepickerElement, thisElement) {
	var type = $(element).data("value");
	var limit = (type == "jam" ? 23 : 59);
	var time = parseInt($(element).prev().val());
	time--;
	time = (time < 0 ? limit : time) + "";
	time = (time.length == 1 ? "0" + time : time);
	$(element).prev().val(time);

	datepickerSetDate(datepickerElement, thisElement);
	datepickerSetTime(datepickerElement, thisElement);
}

function datepickerSetDate(datepickerElement, thisElement) {
	var value = $(thisElement).data("value-date");
	
	if (value == "") {
		value = $(datepickerElement).data("today-date");
		let dateItem = value.split("-");
		var dateItemMonth = parseInt(dateItem[1]) + 1;
		value = dateItem[0] + "-" + dateItemMonth + "-" + dateItem[2];
	}
	var item = value.split("-");
	var date = (item[2].length == 1) ? "0" + item[2] : item[2];
	var month = (item[1].length == 1) ? "0" + item[1] : item[1];
	var year = item[0];

	thisElement.val(date + "-" + month + "-" + year);
	datepickerElement.find(".datepicker-tanggal[data-set='1']").removeAttr("data-set");
	datepickerElement.find(".datepicker-tanggal[data-value='" + value + "']").attr("data-set", "1");
}

function datepickerSetTime(datepickerElement, thisElement) {
	var jam = $(datepickerElement).find(".datepicker-input-jam").val();
	var menit = $(datepickerElement).find(".datepicker-input-menit").val();
	var waktu = jam + ":" + menit;
	
	thisElement.val(function(index, val) {
		return val + " " + waktu;
	});
	thisElement.data("value-time", waktu);
}

function datepickerShow(datepickerElement, thisElement, settings) {
	if (datepickerElement.data("shown") == false) {
		var valueDate = thisElement.data("value-date");
		if (valueDate != "") {
			var item = valueDate.split("-");
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
			datepickerElement.find(".datepicker-tanggal[data-value='" + valueDate + "']").attr("data-set", "1");
		}

		var valueTime = thisElement.data("value-time");
		if (valueTime != "") {
			var item = valueTime.split(":");
			var hour = parseInt(item[0]) + "";
			var minute = parseInt(item[1]) + "";
			hour = (hour.length == 1 ? "0" + hour : hour);
			minute = (minute.length == 1 ? "0" + minute : minute);
			datepickerElement.find(".datepicker-input-jam").val(hour);
			datepickerElement.find(".datepicker-input-menit").val(minute);
		} else {
			var hour = new Date().getHours() + "";
			var minute = new Date().getMinutes() + "";
			thisElement.data("value-time", hour + ":" + minute);
			hour = (hour.length == 1 ? "0" + hour : hour);
			minute = (minute.length == 1 ? "0" + minute : minute);
			datepickerElement.find(".datepicker-input-jam").val(hour);
			datepickerElement.find(".datepicker-input-menit").val(minute);
		}

		datepickerElement.data("shown", true);
		datepickerElement.offset({
			top: thisElement.offset().top + parseInt(thisElement.css("height")) + 10,
			left: thisElement.offset().left
		});
		datepickerElement.css("visibility", "visible");
		datepickerElement.velocity({
			opacity: 1
		}, 100);
	}
}

function datepickerHide(datepickerElement) {
	if (datepickerElement.data("shown") == true) {
		datepickerElement.data("shown", false);
		datepickerElement.velocity({
			opacity: 0
		}, 150, function() {
			datepickerElement.css("visibility", "hidden");
		});
	}
}

function datepickerNextMonth(datepickerElement, settings) {
	var nextMonth = parseInt(datepickerElement.data("current-month")) + 2;
	var currentYear = parseInt(datepickerElement.data("current-year"));
	
	changeMonth(datepickerElement, currentYear, nextMonth, settings);
}

function datepickerPrevMonth(datepickerElement, settings) {
	var prevMonth = parseInt(datepickerElement.data("current-month")) - 2;
	var currentYear = parseInt(datepickerElement.data("current-year"));
	
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

	var element =	'<div class="datepicker" data-class="' + thisClass + '" data-shown="false" data-today-date="' + year + '-' + month + '-' + today + '" data-current-month="' + month + '" data-current-year="' + year + '"><div class="datepicker-content"><div class="datepicker-bulan-container"><div class="datepicker-bulan-title"><span class="datepicker-bulan-title-name first-month">' + datepickerMonthNames[month] + ' ' + year + '</span><svg class="prev-month-icon" fill="#FFFFFF" height="35" viewBox="0 0 24 24" width="35" ><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div><div class="datepicker-hari-container"><span class="datepicker-hari-nama" data-value="0">Mi</span><span class="datepicker-hari-nama" data-value="1">Se</span><span class="datepicker-hari-nama" data-value="2">Se</span><span class="datepicker-hari-nama" data-value="3">Ra</span><span class="datepicker-hari-nama" data-value="4">Ka</span><span class="datepicker-hari-nama" data-value="5">Ju</span><span class="datepicker-hari-nama" data-value="6">Sa</span></div><div class="datepicker-tanggal-container first-month">' + datepickerAssignDate(date, isThisMonth, settings) + '</div></div><div class="datepicker-bulan-container"><div class="datepicker-bulan-title"><span class="datepicker-bulan-title-name second-month">' + datepickerMonthNames[month + 1] + ' ' + year + '</span><svg class="next-month-icon" fill="#FFFFFF" height="35" viewBox="0 0 24 24" width="35"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div><div class="datepicker-hari-container"><span class="datepicker-hari-nama" data-value="0">Mi</span><span class="datepicker-hari-nama" data-value="1">Se</span><span class="datepicker-hari-nama" data-value="2">Se</span><span class="datepicker-hari-nama" data-value="3">Ra</span><span class="datepicker-hari-nama" data-value="4">Ka</span><span class="datepicker-hari-nama" data-value="5">Ju</span><span class="datepicker-hari-nama" data-value="6">Sa</span></div><div class="datepicker-tanggal-container second-month">' + datepickerAssignDate(secondDate, !isThisMonth, settings) + '</div></div><div class="datepicker-waktu-container"><div class="datepicker-waktu-content"><div class="datepicker-waktu-jam"><div class="datepicker-waktu-jam-title">Jam</div><svg class="datepicker-up-icon" data-value="jam" fill="#000000" height="35" viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/><path d="M0 0h24v24H0z" fill="none"/></svg><input class="datepicker-input-jam" type="text" maxlength="2" /><svg class="datepicker-down-icon" data-value="jam" fill="#000000" height="35" viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/><path d="M0-.75h24v24H0z" fill="none"/></svg></div><div class="datepicker-waktu-titik-dua">:</div><div class="datepicker-waktu-menit"><div class="datepicker-waktu-menit-title">Menit</div><svg class="datepicker-up-icon" data-value="menit" fill="#000000" height="35" viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/><path d="M0 0h24v24H0z" fill="none"/></svg><input class="datepicker-input-menit" type="text" maxlength="2" /><svg class="datepicker-down-icon" data-value="menit" fill="#000000" height="35" viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/><path d="M0-.75h24v24H0z" fill="none"/></svg></div></div><button class="btn-default datetimepicker-btn-ok">OK</button></div></div><div class="datepicker-footer"></div></div>';
	
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