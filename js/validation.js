function validate() {
	var valid = true;
	$(".info").html('');

	if (!$("#typ").val()) {
		$("#typ-info").html("benötigt.");
		valid = false;
	}
	if (!$("#bezeichnung").val()) {
		$("#bezeichnung-info").html("benötigt.");
		valid = false;
	}
	if (!$("#artikelnr").val()) {
		$("#artikelnr-info").html("benötigt.");
		valid = false;
	}
	if (!$("#zusatz").val()) {
		$("#zusatz-info").html("benötigt.");
		valid = false;
	}
	if (!$("#anlage").val()) {
		$("#anlage-info").html("benötigt.");
		valid = false;
	}
	if (!$("#zeichnung").val()) {
		$("#zeichnung-info").html("benötigt.");
		valid = false;
	}
	return valid;
}