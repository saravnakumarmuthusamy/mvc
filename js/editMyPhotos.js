//Delete a user photo
$(document).ready(function(){
	$('.deletePhoto').click(function(){
		delId = $(this).attr('id').split('_')[1];
		$('#delImageId').val(delId);
		var data=$('#delImageDiv').html();
		jQuery.facebox(data);
	});
});

function deleteImage()
{
	delId = $('#delImageId').val();
	$.ajax({
		type:'post',
		url: '/deleteUserImage.php',
		data: 'delImageId='+delId,
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			if(response.success){
				$('#photo_'+delId).remove();
			}
			jQuery.facebox(response.message, 'popupMessage');
		}
	})
}

function makeProfileImage()
{
	imageId = $('#makeProfileImage').val();
	$.ajax({
		type:'post',
		url: '/editImage.php',
		data: 'editImageId='+imageId,
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			if(response.success){

			}
			jQuery.facebox(response.message, 'popupMessage');
		}
	})
}


