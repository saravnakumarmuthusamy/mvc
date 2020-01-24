$(document).ready(function(){
	$('#frmSendMessage').submit(function(e){									
		e.preventDefault();
		hasError = validateForm('frmSendMessage');
		if(hasError){
			return false;
		} else {
			hideMessage();
		}
		$.ajax({
			type: 'post',
			url: 'sendMessage.php',
			data: {sendMessage:1, mailSubject:$('#mailSubject').val(), 
					mailMessage: $('#mailMessage').val(), toUserId: $('#toUserId').val()},
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