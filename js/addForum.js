$(document).ready(function(){
		 $('#frmAddforum').submit(function(){
		   hasError = validateForm('frmAddforum');
		   var text = $('#forumDescription').html();
		   if(hasError){
				return false;
		   } else if(text == "")
		   {
				showPopup($('#forumDescription').attr('title')+ ' Required');
				return false;
		   }
			return true;
		  });
});
	