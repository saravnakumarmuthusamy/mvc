$(document).ready(function(){
	$('#frmForgotPassword').submit(function(e){
		e.preventDefault();
		hasError = validateForm('frmForgotPassword');
		if(hasError){
			return false;
		} else {
			hideMessage();
		}
		$.ajax({
			type: 'post',
			url: 'forgotPassword.php',
			data: { sendPassword:1, userEmail:$('#userEmail').val()},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				if(response.success){
					jQuery.facebox(response.message, 'popupMessage');
				} else {
					showPopup(response.message);
				}
			}
		})
		return false;
	})
})