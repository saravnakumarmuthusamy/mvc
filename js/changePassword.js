$(document).ready(function(){
	$('#frmChangePassword').submit(function(e){
		e.preventDefault();
		hasError = validateForm('frmChangePassword');
		if(hasError){
			return false;
		} else {
			hideMessage();
		}
		$.ajax({
			type: 'post',
			url: 'changePassword.php',
			data: {changePassword:1, userOldPassword:$('#userOldPassword').val(), 
					userNewPassword: $('#userNewPassword').val()},
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
	
	$('#cancel').click(function(){
		$('.close_image').trigger('click');
	})
})