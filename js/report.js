$(document).ready(function(){
	$('#frmReportVideo').submit(function(e){
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: root+'/report.php',
			data: { reportVideo:1, videoId:$('#videoId').val()},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				if(response.success){
					jQuery.facebox(response.message, 'popupMessage');
				} else {
					showMessage(response.message);
				}
			}
		})
		return false;
	})
})