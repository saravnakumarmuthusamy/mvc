var page = 0;
var catList = [];
$(document).ready(function() {
	if($('.scroll-pane').length) {
		$('.scroll-pane').jScrollPane();
	}
	if($('.contentleftlist').length) {
		$('.contentleftlist').jScrollPane();
	}
	$.ajaxSetup({
		data: {ajaxMode:1}
	});
	
	swapValues=[];
	$(".swapValue").each(function(i){
	   swapValues[i]=$(this).val();
	   $(this).focus(function(){
			if($(this).val()==swapValues[i]){
				$(this).val("")
			}
	   }).blur(function(){
		   if($.trim($(this).val())==""){
			   $(this).val(swapValues[i])
		   }
	  })
	});
	
	$('body').on('click', '.auditionPage, .learnPage, .listenPage, .searchPage', function(event){
		var pageArr = $(this).attr('id').split('_');
		page = pageArr[2];
		var model = pageArr[0];
		getVideos();
	})
	
	$('body').on('change', '.auditionPageSelect, .learnPageSelect, .listenPageSelect, .searchPageSelect', function(event){
		page = $(this).val();
		var model = $(this).attr('id').split('_')[0];
		getVideos();
	})
	
	$('body').on('click', '.bandsPage', function(event){
		event.preventDefault();
		var pageArr = $(this).attr('id').split('_');
		page = pageArr[2];
		getBands();
	});
	
	$('body').on('change', '.bandsPageSelect', function(event){
		page = $(this).val();
		var model = $(this).attr('id').split('_')[0];
		getBands();
	})
		
	
	$('body').on('click', '.catListBox', function(){
		catList = [];
		$('.catListBox').each(function(){
			if($(this).prop('checked')){
				newVal = $(this).val();
				catList.push(newVal);
			}
		})
		console.log(catList);
		page = 0;
		if($(this).hasClass('bands')){
			getBands();
		} else if($(this).hasClass('memberSearch')) {
			getMembers();
		} else {
			getVideos();
		}
	});
	/* Set the message to be displayed in centre of the window */
	if(!$('#Messages').is(':hidden')) {
		positionPopup(false);
		$('#Messages').show();
	}
});

function showPopup(msg)
{
	jQuery.facebox(msg, 'popupMessage');	
}

function hidePopup()
{
	$('.close_image').trigger('click');
}

function getVideos()
{
	if(!page) page = 1;
	var moduleArea = $('#'+model+'Video');
	moduleArea.html('<p align="center"> <img src="/images/preloader_1.gif"> </p>');
	$.ajax({
		type:'post', 
		url: 'getModuleInfo.php?rand='+Math.random(),
		data:{module: 'videoList', page: page, model: model, catList: catList},
		dataType: 'json',
		success: function(response){
			//console.log(response);
			moduleArea.html(response.message.content);
			$('#'+model+'Pagination').html(response.message.paging);
			$('#totalVideo').html(response.message.totalVideo);
		}
	});	
}

function getBands()
{
	if(!page) page = 1;
	var moduleArea = $('#bandsList');
	moduleArea.html('<p align="center"> <img src="/images/preloader_1.gif"> </p>');
	$.ajax({
		type:'post', 
		url: '/getModuleInfo.php?rand='+Math.random(),
		data:{module: 'bands', page: page, model: model, catList: catList},
		dataType: 'json',
		success: function(response){
			//console.log(response);
			moduleArea.html(response.message.content);
			$('#'+model+'Pagination').html(response.message.paging);
			$('#totalBand').html(response.message.totalBand);
		}
	});	
}

// get video comment list by page
function getVideoComments()
{
	if(!page) page = 1;
	var moduleArea = $('#comments');
	moduleArea.html('<p align="center"> <img src="/images/preloader_1.gif"> </p>');
	$.ajax({
		type:'post', 
		url: '/getModuleInfo.php?rand='+Math.random(),
		data:{module: 'comment', page: page,  videoId: videoId},
		dataType: 'json',
		success: function(response){
			moduleArea.html(response.message.content);
			$('#'+model+'Pagination').html(response.message.paging);
		}
	});	
}

function positionPopup(centerWindow){
	var winX = $(window).width();
	var winY = $(window).height();
	var x= (winX - $('#Messages').width()) / 2 + getScrX();
	var y = (winY - $('#Messages').height()) / 2;
	if(centerWindow){
		$('#Messages').css({'left': x+'px', 'top': y+'px'});
	} else {
		$('#Messages').css({'left': x+'px'});
	}
}

function showMessage(msg)
{
	$('#inner_message').html(msg);
	positionPopup(false);
	$('#Messages').show();
	$('#Messages .close').show();
}
function hideMessage(timeOut)
{
	if(!timeOut) timeOut = 8000;
	$('#Messages').fadeOut(timeOut);
}

//Check the ajax response make any redirects
function checkResponseRedirect(response)
{
	if(response.redirect){
		if (window.top != window.self) {
			window.top.location = response.redirect;
		} else if(window.opener) {
			window.opener.location = response.redirect;
		} else if(window.parent) {
			window.parent.location = response.redirect;
		} else {
			window.location = response.redirect;
		}
	}
	return false;
}

//function to get argument from url.
function getUserParameter( name )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return results[1];
}

/* Get Screen Width */
function getScrX() {
  var offset = 0;
  if(window.pageXOffset)
    offset = window.pageXOffset;
  else if(document.documentElement && document.documentElement.scrollLeft)
    offset = document.documentElement.scrollLeft;
  else if(document.body && document.body.scrollLeft)
    offset = document.body.scrollLeft;
  return offset;
}
/* Get Screen Height */
function getScrY() {
  var offset = 0;
  if(window.pageYOffset)
    offset = window.pageYOffset;
  else if(document.documentElement && document.documentElement.scrollTop)
    offset = document.documentElement.scrollTop;
  else if(document.body && document.body.scrollTop)
    offset = document.body.scrollTop;
  return offset;
}