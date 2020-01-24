$(document).ready(function(){
	$('#frmRegister').submit(function(){
		hasError = validateForm('frmRegister');
		if(hasError){
			return false;
		} else {
			if($('#bandUserCountry').val() == 'US'){
				if(isEmpty($('#bandUserStateLst').val())){
					showPopup($('#bandUserStateLst').attr('title')+ ' Required');
					return false;
				}  
			} else {
				if(isEmpty($('#bandUserStateTxt').val())){
					showPopup($('#bandUserStateTxt').attr('title')+ ' Required');
					return false;
				}   
			}
		}
		return true;
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
				url: 'createBand.php',
				type: 'post',
				data: {chkName: 1, bandName: bName},
				dataType: 'json',
				success: function(response){
					checkResponseRedirect(response);
					if(response.success) {
						nameFld.focus();
						showPopup('An Band Name already exists with that Bandjamit group profile');
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
	
//start
		$('body').delegate('.CreateBand', 'click', function(){																			
				$.ajax({
					url: 'band.php',
					type: 'post',
					dataType: 'json', 
					data: 'newBand=true',
					success: function(response){			
						$("#default").fadeOut();
						$("#CreateNewBand").css('display','block');									
						$("#CreateNewBand").html(response.message);
						
						//checkResponseRedirect(response);
					//	$('#'+msgDiv+'_'+msgId).slideUp();	
					}
				})				
		});																									   
//end




	
})