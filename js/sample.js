// JavaScript Document
$(document).ready(function(){
	$('#sample_frm').submit(function(){
		hasError = validateForm('sample_frm');
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
	
	

	
	
	
});