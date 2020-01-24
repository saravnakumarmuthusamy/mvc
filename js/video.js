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
			url: 'video.php',
			data: {postComment:1, comment: $('#comment').val(), videoId: $('#videoId').val(), id: $('#videoId').val()},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				// moduleArea.html(response.content);
				// $('#'+model+'Pagination').html(response.paging);
				$('#comments').html(response.content);
				$('#comment').val('');
			}
		})
		return false;
	})
})
