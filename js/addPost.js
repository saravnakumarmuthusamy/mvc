$(document).ready(function(){

	$('#frmAddPost').submit(function(){
		 hasError = validateForm('frmAddPost');
		   var text = $('#postDescription').html();
		   if(hasError){
				return false;
		   } else if(text == "")
		   {
				showPopup($('#postDescription').attr('title')+ ' Required');
				return false;
		   }
			return true;
	});
	
	$('#forumId').blur(function(){
		var email = $(this).val();
		var emailFld = $(this)[0];
		if(isEmpty(email)){
			emailFld.focus();
			showPopup($(this).attr('title')+ ' Required');
			return false;
	}
	});
	
});
	