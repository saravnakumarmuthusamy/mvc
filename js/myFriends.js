$(document).ready(function(){
	$('#tabmenu a').click(function(){
		$('#tabmenu a.active').removeClass('active');
		$(this).addClass('active');
		var tabId = $(this).attr('id');
		if(tabId == 'tab_friends'){
			getModule('friend');
		} else if(tabId == 'tab_pending')
		{
			getModule('pendingRequest');
		} else if(tabId == 'tab_newBand')
		{
			getModule('newBandRequest');
		}else{
			getModule('newRequest');
		}
	});
	
	//Accept or reject an invitation
	$('body').on('click', '.accept, .reject', function(){
															 
		invitationId = $(this).attr('id').split('_')[1];
		if($(this).hasClass('accept')){
			request= 'accept'
		} else {
			request= 'reject'
		}
		$.ajax({
			type:'post',
			url: '/manageInvitation.php',
			data: {inviteId: invitationId, request: request},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				jQuery.facebox(response.message, 'popupMessage');
				getModule('newRequest');
				getNotification();
			}
		})
		
	});
	
	$('body').on( 'click', '#friendPage li a', function(e){
		e.preventDefault();
		page= $(this).attr('title');
		console.log('Title: '+ page);
		getModule('friend', page);
	});
	
	$('body').on( 'click', '#pendingFriendPage li a', function(e){
		e.preventDefault();
		page= $(this).attr('title');
		getModule('pendingRequest', page);
	});
	
	$('body').on( 'click', '#newFriendPage li a', function(e){
		e.preventDefault();
		page= $(this).attr('title');
		getModule('pendingRequest', page);
	});
	
	$('body').on('change', '#pendingFriendPage .pageDropDown', function(e){
		e.preventDefault();
		page= $(this).val();
		getModule('newRequest', page);
	});
	
	$('body').on('change', '#friendPage .pageDropDown', function(e){
		e.preventDefault();
		page= $(this).val();
		getModule('friend', page);
	});
	
	$('body').on('change', '#newFriendPage .pageDropDown', function(e){
		e.preventDefault();
		page= $(this).val();
		getModule('newRequest', page);
	});
	
	$('body').on('click', '.aceptGroup, .rejectGroup', function(){
		invitationId = $(this).attr('id').split('_')[1];
		if($(this).hasClass('aceptGroup')){
			request= 'aceptGroup'
		} else {
			request= 'rejectGroup'
		}
		$.ajax({
			type:'post',
			url: '/manageBandGroup.php',
			data: {inviteId: invitationId, request: request},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				jQuery.facebox(response.message, 'popupMessage');
				getModule('newBandRequest');
				getNotification();
			}
		})
	});
	
	//Delete an invitation
	$('body').on('click', '.delInvite', function(){
		delInviteId = $(this).attr('id').split('_')[1];
		$('#delInviteId').val(delInviteId);
		var data=$('#delInvitationDiv').html();
		jQuery.facebox(data);
	});
	
	$('body').on('click', '.sendInviteAgain', function(){
		sendAgainId = $(this).attr('id').split('_')[1];
		$('#sendAgainId').val(sendAgainId);
		var data=$('#sendAgainDiv').html();
		jQuery.facebox(data);
	});
	
	//Delete a Friend
	$('body').on('click', '.delFriend', function(){
		frndId = $(this).attr('id').split('_')[1];
		$('#delFriendId').val(frndId);
		var data=$('#delFriendDiv').html();
		jQuery.facebox(data);
	})
})

function deleteFriend()
{
	frndId = $('#delFriendId').val();
	$.ajax({
		type:'post',
		url: '/manageInvitation.php',
		data: {friendId: frndId, deleteFriend: 1},
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			jQuery.facebox(response.message, 'popupMessage');
			getModule('friend');
		}
	})
}

function deleteInvitation()
{
	delInviteId = $('#delInviteId').val();
	$.ajax({
		type:'post',
		url: '/manageInvitation.php',
		data: {inviteId: delInviteId, request: 'delete'},
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			jQuery.facebox(response.message, 'popupMessage');
			getModule('pendingRequest');
		}
	})
}


function sendMessageAgain()
{
	sendAgainId = $('#sendAgainId').val();
	$.ajax({
		type:'post',
		url: '/manageInvitation.php',
		data: {id: sendAgainId, request: 'sendMessageAgain'},
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			jQuery.facebox(response.message, 'popupMessage');
			getModule('pendingRequest');
		}
	})
	
}

function getModule(moduleName, page)
{
	if(!page) page = 1;
	var moduleArea = $('#resultRow');
	moduleArea.html('<p align="center"> <img src="/images/preloader_1.gif"> </p>');
	$.ajax({
		type:'post', 
		url: '/getModuleInfo.php?rand='+Math.random(),
		data:{module: moduleName, page: page, id: id},
		dataType: 'json',
		success: function(response){
			moduleArea.html(response.message);
			$('a[rel*=facebox]').facebox();
		}
	});
}
