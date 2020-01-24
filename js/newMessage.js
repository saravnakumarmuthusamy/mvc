$(document).ready(function(){
	
	$('#frmNewMessage').submit(function(){							
		hasError = validateForm('frmNewMessage');
		if(hasError)
		{
		  return false;
		}
		return true;
	});
	
	
						   
	$('body').delegate('.reply', 'click', function(){
		replyMsgId = $(this).attr('id').split('_')[1];
		if($('#replyMsg_'+replyMsgId).length == 0) {
			newDiv = $('#replyMsg').clone();
			newDiv.attr('id', 'replyMsg_'+replyMsgId);
			$('textarea', newDiv).attr('id', 'replyText_'+replyMsgId);
			$('.save-btn', newDiv).attr('id', 'saveReply_'+replyMsgId);
			$('#bottomMsg_'+replyMsgId).before(newDiv);
			newDiv.show();
		}
		return false;
	});

	$('body').delegate('.save-btn', 'click', function(){
		msgId = $(this).attr('id').split('_')[1];
		$.ajax({
		  url: '/message.php',
		  type: 'post',
		  dataType:'json',
		  data: {message: $('#replyText_'+msgId).val(), rplyMsgId: msgId, replyMsg: 1},
		  success: function(response){
			checkResponseRedirect(response);
		  	$('#replyMsg_'+msgId).remove();
			$('#bottomMsg_'+msgId).before(response.message);
		  }
		})
	});
	
	$('body').delegate('.delete', 'click', function(){
		msgDelete = $(this).attr('id').split('_');
		msgDiv = msgDelete[0];
		msgId = msgDelete[2];
		$('#delMsgId').val(msgId);
		$('#delMsgDivId').val(msgDiv);
		var data=$('#delMessageDiv').html();
		jQuery.facebox(data);
		return false;
	})
	

	$('body').delegate('#replyMsg', 'keypress', function(event){
	/*$('body').delegate('.sendreply', 'click', function(){		*/
		if(event.keyCode != 13 || event.shiftKey != 0)  {
			return;
		}
		var msgId = $("#msgId").val();
		var FromId = $("#FromId").val();		
		//msgId = $(this).attr('id').split('_')[1];			
		var Msg = $("#replyMsg").val();		
		
		if(Msg=='') 
		{
			showPopup('Please enter message');				
			return;
		}
		if(msgId && Msg)
			{
				$.ajax({
				  url: '/message.php',
				  type: 'post',
				  dataType:'json',
				  data: {message: Msg, rplyMsgId: msgId, replyMsg: 1},
				  success: function(response){
					checkResponseRedirect(response);
					$('#replyMsg').val('');
					/*$('#msgListcomm_'+msgId).after(response.message);*/
					$('#msgDetail .sp-container').append(response.message.content);
					$('#msgId').val(response.message.msgId);
				  }
				})
			}	
	});													
	$('body').delegate('.NewMessage', 'click', function(){
	$("#default").fadeOut();		
	$.ajax({
		url: '/message.php',
		type: 'post',
		dataType: 'json', 
		data: 'newMessage=true',
		success: function(response){
			$('#msgBox').hide();
			$('#replyBox').hide();
			$("#NewMessage").css('display','block');
			$("#NewMessage").html(response.newMessage);
		}
	})		
	});																									   

	$('body').delegate('.NewMsgSubmit', 'click', function(){
		$.ajax({
				url: '/message.php',
				type: 'post',
				dataType: 'json', 
				data: 'delMsgId='+msgId,
				success: function(response){
					checkResponseRedirect(response);
					$('#'+msgDiv+'_'+msgId).slideUp();
					jQuery.facebox('Message Deleted', 'popupMessage');
				}
			})
	});												
})

function deleteMessage()
{
	msgId = $('#delMsgId').val();
	msgDiv = $('#delMsgDivId').val();	
	$.ajax({
		url: '/message.php',
		type: 'post',
		dataType: 'json', 
		data: 'delMsgId='+msgId,
		success: function(response){
			checkResponseRedirect(response);
			$('#'+msgDiv+'_'+msgId).slideUp();
			jQuery.facebox('Message Deleted', 'popupMessage');
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
		data:{module: moduleName, page: page},
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			moduleArea.html(response.message);
		}
	});
}												
function sendReply()
	{		
		var msgId = $("#msgId").val();
		var FromId = $("#FromId").val();		
		//msgId = $(this).attr('id').split('_')[1];			
		var Msg = $("#replyMsg").val();		
		
		if(Msg=='') 
		{
			showPopup('Please enter message');			
			return;
		}
		if(msgId && Msg)
			{
				$.ajax({
				  url: '/message.php',
				  type: 'post',
				  dataType:'json',
				  data: {message: Msg, rplyMsgId: msgId, replyMsg: 1},
				  success: function(response){
					checkResponseRedirect(response);
					$('#replyMsg_'+msgId).remove();
					$('#bottomMsg_'+msgId).before(response.message);
				  }
				})
			}
	
	}
function DeleteMsgById(msgId)
	{		
	msgDiv = $('#delMsgDivId').val();	
	$.ajax({
		url: '/message.php',
		type: 'post',
		dataType: 'json', 
		data: 'delMsgId='+msgId,
		success: function(response){
			checkResponseRedirect(response);
		//	$('#'+msgDiv+'_'+msgId).slideUp();
			$('#msgListcomm_'+msgId).slideUp();					
			jQuery.facebox('Message Deleted', 'popupMessage');
		}
	})		
	}

function loadUserMsgById(userId)
	{		
	if(userId){
	$.ajax({
		url: '/message.php',
		type: 'post',
		dataType: 'json', 
		data: 'communicationAreaByUserId='+userId,
		success: function(response){
			$('.userMsg').removeClass('active');
			$('#userMsg_'+userId).addClass('active');
			$("#msgDetail .sp-container").html(response.communicationArea);
			//$("#msgDetail .sp-container").scrollpanel();
		}
	})		
		
		}
	}
