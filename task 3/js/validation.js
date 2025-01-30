function validate() {
	var valid = true;
	$(".info").html('');

	if (!$("#name").val()) {
		$("#name-info").html("required.");
		valid = false;
	}
	if (!$("#email").val()) {
		$("#email-info").html("required.");
		valid = false;
	}
	if (!$("#city").val()) {
		$("#city-info").html("required.");
		valid = false;
	}
	return valid;
}
