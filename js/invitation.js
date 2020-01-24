$(document).ready(function(){
						   
	$('body').on('click', '.submitInvite', function(){
		$('#frmInvite').submit();
	});
	$('#frmInvite').submit(function(event){
		var hasError = false;
		var frmEntered = 0;
		//Check each each invite name has valid email address
		$('.inviteName').each(function(){
			var invName = $(this).val();
			var rowId = $(this).attr('id').split('_')[1];
			var email = $('#inviteEmail_'+rowId).val();
			var emailObj = $('#inviteEmail_'+rowId)[0];
			var nameObj = $(this)[0];
			var validEntry = false;
			//Check for the email when invitation entered
			if(!isEmpty(invName)){
				//Check email is not empty & valid
				if(isEmpty(email)){
					showPopup('Enter Email Address');
					hasError = true;
					emailObj.focus();
				} else if(!validateEmail(email)){
					showPopup('Enter Valid Email Address');
					hasError = true;
					emailObj.focus();
				} else {
					validEntry = true;
				}
			}
			//Check for name when email is entered
			if(!isEmpty(email)){
				//Check email is valid
				if(!validateEmail(email)){
					showPopup('Enter Valid Email Address');
					hasError = true;
					emailObj.focus();
				} else if(isEmpty(invName)){
					showPopup('Enter Name');
					hasError = true;
					nameObj.focus();
				} else {
					validEntry = true;
				}
			}
			if(validEntry) frmEntered++;
			if(hasError) return;
		})
		
		if(hasError) {
			event.preventDefault();
			return false;
		} else if(frmEntered) {
			return true;
		} 
		if(!frmEntered){
			event.preventDefault();
			showPopup('Please fill any invite information');
			$('.inviteName')[0].focus();
			return false;
		}
		return true;
	})
})