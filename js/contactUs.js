$(document).ready(function(){
	$('#frmContact').submit(function(e){
		e.preventDefault();
		hasError = validateForm('frmContact');
		if(hasError){
			return false;
		} else {
			hideMessage();
		}
		$.ajax({
			type: 'post',
			url: 'contactUs.php',
			data: { sendContact:1, contactEmail:$('#contactEmail').val(), 
					contactName: $('#contactName').val(), contactSubject: $('#contactSubject').val(),
					contactMessage: $('#contactMessage').val()},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				if(response.success){
					jQuery.facebox(response.message, 'popupMessage');
					$('#contactEmail').val('');
					$('#contactSubject').val('');
					$('#contactMessage').val('');
				} else {
					showPopup(response.message);
				}
			}
		})
		return false;
	})
});