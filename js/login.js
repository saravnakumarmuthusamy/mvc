$(document).ready(function(){
	$('#frmLogin').submit(function(){
		hasError = validateForm('frmLogin');
		if(hasError){
			return false;
		}
		return true;
	});
	
})