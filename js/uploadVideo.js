$(document).ready(function(){
	$('#frmUploadVideo').submit(function(){
		hasError = validateForm('frmUploadVideo');
		if(hasError){
			return false;
		}
		return true;
	});
	/* Get the parent categories based on type */
	$('#videoOne').change(function(){
		$('#videoCategory option').remove();
		$('#videoSubCategory option').remove();
		$('#videoSubCategory').append($("<option>").attr("value",'').text(''));
		if($('#videoOne').val() == ''){
			$('#videoCategory').append($("<option>").attr("value",'').text(''));
			return;
		} else {
			$('#videoCategory').append($("<option>").attr("value",'').text('Loading...'));	
		}
		$.ajax({
			type:'post',
			url:'/uploadVideo.php',
			dataType: 'json',
			data: {categoryType: $('#videoOne').val()},
			success: function(response){
				checkResponseRedirect(response);
				$('#videoCategory option').remove();
				$('#videoCategory').append($("<option>").attr("value",'').text('')); 
				var categoryList = response.catList;
				for(index in categoryList){
					$('#videoCategory').append($("<option>").attr("value",categoryList[index].cat_id).text(categoryList[index].cat_name)); 
				}
			}
		})
	})
	/* Get sub categories based on category */
	$('#videoCategory').change(function(){
		$('#videoSubCategory option').remove();
		if($('#videoCategory').val() == ''){
			$('#videoSubCategory').append($("<option>").attr("value",'').text(''));
			return;
		} else {
			$('#videoSubCategory').append($("<option>").attr("value",'').text('Loading...'));
		}
		$.ajax({
			type:'post',
			url:'/uploadVideo.php',
			dataType: 'json',
			data: { catParentId : $('#videoCategory').val(), getCategory: 1},
			success: function(response){
				checkResponseRedirect(response);
				$('#videoSubCategory option').remove();
				$('#videoSubCategory').append($("<option>").attr("value",'').text('')); 
				var categoryList = response.subCatList;
				for(index in categoryList){
					$('#videoSubCategory').append($("<option>").attr("value",categoryList[index].cat_id).text(categoryList[index].cat_name)); 
				}
			}
		})
	})
})