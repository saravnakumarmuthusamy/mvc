$(document).ready(function(){
	$('#frmComment').submit(function(e){
		hasError = validateForm('frmComment');
		if(hasError){
			return false;
		} else {
			hideMessage();
		}
		e.preventDefault();
		$.ajax({
			type:'post',
			url: 'photoView.php',
			data: {postComment:1, comment: $('#comment').val(), photoId: $('#photoId').val()},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				$('#noComments').hide();
				$('#comments').html(response.message);
				$('#comment').val('');
			}
		})
		return false;
	})
	//Delete a video comment
	$('body').delegate('.delButton', 'click', function(){
		delId = $(this).attr('id').split('_')[1];
		$('#delCommentId').val(delId);
		var data=$('#delCommentDiv').html();
		jQuery.facebox(data);
	})
})

function deleteComment()
{
	delId = $('#delCommentId').val();
	$.ajax({
		type:'post',
		url: 'photoView.php',
		data: 'delCommentId='+delId,
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			if(response.success){
				$('#comment_'+delId).remove();
			}
			if($('.comments-row').length == 0){
				$('#noComments').show();	
			}
			jQuery.facebox(response.message, 'popupMessage');
		}
	})
}