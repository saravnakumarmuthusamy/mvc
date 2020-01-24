$(document).ready(function()
{	
		$('body').on('submit', '#frmUploadVideo', function(event){

			hasError = validateForm('frmUploadVideo');
			if(hasError)
			{
				return false;
			}
			return true;
		});
		
		$('body').on('change', '.videoOne', function(event){
			event.preventDefault();
			var arr =$('.editBandVideo').attr('id').split('_');
			modName = arr[0];
			bandId = arr[1];
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
				url:'/getModuleInfo.php?rand='+Math.random(),
				dataType: 'json',
				data: {module: modName, categoryType: $('#videoOne').val(), bandId: bandId},
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
		
	    });	
		
		$('body').on('change', '.videoCategory', function(event){
			event.preventDefault();
			var arr =$('.editBandVideo').attr('id').split('_');
			modName = arr[0];
			bandId = arr[1];
			$('#videoSubCategory option').remove();
			if($('#videoCategory').val() == ''){
				$('#videoSubCategory').append($("<option>").attr("value",'').text(''));
				return;
			} else {
				$('#videoSubCategory').append($("<option>").attr("value",'').text('Loading...'));
			}
			$.ajax({
				type:'post',
				url:'/getModuleInfo.php?rand='+Math.random(),
				dataType: 'json',
				data: {module: modName, bandId: bandId, catParentId : $('#videoCategory').val(), getCategory: 1},
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
		});			
})