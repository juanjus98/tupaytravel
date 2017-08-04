$.getDataJson = function(url, data, callback) {
	return $.ajax({
		method: 'POST',
		url: url,
		data: data,
		dataType: 'json',
		success: callback
	});
};

function getDate(element) {
	var date;
	try {
		date = $.datepicker.parseDate(dateFormat, element.value);
	} catch( error ) {
		date = null;
	}
	return date;
};