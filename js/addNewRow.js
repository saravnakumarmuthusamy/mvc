$(document).ready(function(){
	$('#addRow').click(function(){
		table = $('#inviteTable');
		var rowCount = table[0].rows.length;
		var row = table[0].insertRow(rowCount);
		var firstName = $('<div class="col-sm-12 col-xs-12 M0 P5"><input type="text" class="input-block-level"></div>');
		firstName.attr('name', 'inviteFirstName[]');
		var cell1 = row.insertCell(0);
		cell1.appendChild(firstName[0])
		var lastName = $('<div class="col-sm-12 col-xs-12 M0 P5"><input type="text" class="input-block-level"></div>');
		lastName.attr('name', 'inviteLastName[]');
		var cell2 = row.insertCell(1);
		cell2.appendChild(lastName[0]);
		var email = $('<div class="col-sm-12 col-xs-12 M0 P5"><input type="text" class="input-block-level"></div>');
		email.attr('name', 'inviteEmail[]');
		var cell3 = row.insertCell(2);
		cell3.appendChild(email[0]);
	});
});