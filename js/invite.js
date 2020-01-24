$(document).ready(function(){
	$('#frmInvitation').submit(function(e){
		e.preventDefault();
		var memberId = $('#memberId').val();
		$.ajax({
			type: 'post',
			url: 'invite.php',
			data: {sendInvitation:1, id: memberId},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				if(response.success){
					jQuery.facebox(response.message, 'popupMessage');
					$('#sendInvitation_'+memberId).hide();
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