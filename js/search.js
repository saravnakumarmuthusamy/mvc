$(document).ready(function(){
	$('#frmSearchMember').submit(function(e){
		var userNameEmpty = isEmpty($('#srchUserName').val());
		var userEmailEmpty = isEmpty($('#srchUserEmail').val());
		if(!userNameEmpty){
				return true;	
		}
		if(!userEmailEmpty){
			if(validateEmail($('#srchUserEmail').val())) {
				return true
			} else {
				showPopup('Please Enter Valid Email');
				return false;
			}
		}
		showPopup('Please Enter User Name or User Email');
		return false;	
	});
	
	$('#frmSearchDetail').submit(function(e){
		var firstNameValid = isValid($('#userFirstNameSrch'));
		if(firstNameValid) return true;
		var lastNameValid = isValid($('#userLastNameSrch'));
		if(lastNameValid) return true;
		var genderValid = validateOption('userGenderSrch');
		if(genderValid) return true;
		var minAgeValid = isInteger($('#minAgeSrch'));
		var maxAgeValid = isInteger($('#maxAgeSrch'));
		if(minAgeValid) return true;
		if(maxAgeValid) return true;
		var state = $('#userStateSrch').val();
		if(state) return true;
		var zipCode = $('#userZipSrch').val();
		if(zipCode) return true;
		var playListValid = validateCheckBoxArray('playListSrch');
		if(genderValid) return true;
		if(playListValid) return true;
		showPopup('Please Select Any Condition To Search');
		return false;
	})
})