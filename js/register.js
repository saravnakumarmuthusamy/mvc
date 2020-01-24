$(document).ready(function(){
	$('#frmRegister').submit(function(){
		hasError = validateForm('frmRegister');
		if(hasError){
			return false;
		} else {
			if($('#userCountry').val() == 'US'){
				if(isEmpty($('#userStateLst').val())){
					showPopup($('#userStateLst').attr('title')+ ' Required');
					return false;
				}  
			} else {
				if(isEmpty($('#userStateTxt').val())){
					showPopup($('#userStateTxt').attr('title')+ ' Required');
					return false;
				}   
			}
		}
		return true;
	});
	
	$('#userEmail').blur(function(){
		var email = $(this).val();
		var emailFld = $(this)[0];
		if(isEmpty(email)){
			emailFld.focus();
			showPopup($(this).attr('title')+ ' Required');
			return false;
		}
		if(!validateEmail(email)){
			emailFld.focus();
			showPopup('Enter valid email');
			return false;
		}
		//Check the email already in registered
		$.ajax({
			url: 'register.php',
			type: 'post',
			data: {chkEmail: 1, emailAddress: email},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				if(!response.success) {
					emailFld.focus();
					showPopup('An account already exists with that email address');
				} else {
					hidePopup();	
				}
			}
		});		
	});
	
	$('#userFullName').blur(function(){
			var uName = $(this).val();
			var nameFld = $(this)[0];
			if(isEmpty(uName)){
				nameFld.focus();
				showPopup($(this).attr('title')+ ' Required');
				return false;
			}
			//Check the email already in registered
			$.ajax({
				url: 'register.php',
				type: 'post',
				data: {chkName: 1, userFullName: uName},
				dataType: 'json',
				success: function(response){
					checkResponseRedirect(response);
					if(!response.success) {
						nameFld.focus();
						showPopup('An account already exists with that user name');
					} else {
						hidePopup();	
					}
				}
			});
		});
	
	
	// band profile script and script added by venkatesh added on 06/feb/2012
	$('#bandName').blur(function(){
			var bName = $(this).val();
			var nameFld = $(this)[0];
			if(isEmpty(bName)){
				nameFld.focus();
				showPopup($(this).attr('title')+ ' Required');
				return false;
			}
			//Check the email already in registered
			$.ajax({
				url: 'groupRegister.php',
				type: 'post',
				data: {chkName: 1, bandName: bName},
				dataType: 'json',
				success: function(response){
					checkResponseRedirect(response);
					if(!response.success) {
						nameFld.focus();
						showPopup('An Band Name already exists with that Band profile');
					} else {
						hidePopup();	
					}
				}
			});
		});
	
	$('#bandUserEmail').blur(function(){
		var email = $(this).val();
		var emailFld = $(this)[0];
		if(isEmpty(email)){
			emailFld.focus();
			showPopup($(this).attr('title')+ ' Required');
			return false;
		}
		if(!validateEmail(email)){
			emailFld.focus();
			showPopup('Enter valid email');
			return false;
		}
		//Check the email already in registered
		$.ajax({
			url: 'groupRegister.php',
			type: 'post',
			data: {chkEmail: 1, emailAddress: email},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				if(!response.success) {
					emailFld.focus();
					showPopup('An account already exists with that email address');
				} else {
					hidePopup();	
				}
			}
		});		
	});


/* Start Events */
	$('#frmCEvents').submit(function(){
		hasError = validateForm('frmCEvents');
		if(hasError){
			return false;
		} else {
			if($('#userCountry').val() == 'US'){
				if(isEmpty($('#userStateLst').val())){
					showPopup($('#userStateLst').attr('title')+ ' Required');
					return false;
				}  
			} else {
				if(isEmpty($('#userStateTxt').val())){
					showPopup($('#userStateTxt').attr('title')+ ' Required');
					return false;
				}   
			}
		}
		return true;
	});
/* End Events*/
	
})