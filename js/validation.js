function validateForm(frmId)
{
	var hasError = false;
	var previous = '';
	var currnet = '';
	$('#'+frmId +' :input').each(function(index){
		var thisObj = $(this);
		var thisType = thisObj.attr('type');
		var elmnt = thisObj[0].nodeName;
		//Check for the element has required class
		if(index == 0){
			previous = thisObj.attr('id');	
		} else {
			previous = current;	
		}
		current = thisObj.attr('id');
		if(hasError) return;
		var parentContainer = thisObj.parent();
		//No need to check the element in hidden block
		if(parentContainer.css('display') == 'none' || thisObj.css('display') == 'none') return;
		msg = thisObj.attr('title') ? thisObj.attr('title') : thisObj.attr('toolTip');
		if(thisObj.hasClass('required')){
			if(thisType == "radio"){
				if(!validateOption(thisObj.attr('name'))){
					showPopup(msg+' Required');
					thisObj[0].focus();
					hasError = true;
				}
			}
			//Check for select box which is more than one option and value is not selected
			else if(thisObj.is('select')){
				if($('option', thisObj).length > 1 && isEmpty(thisObj.val())){
					showPopup(msg+' Required');
					thisObj[0].focus();
					hasError = true;														  
				}
			}
			else if(!hasError && isEmpty(thisObj.val())){
				hasError = true;
				showPopup(msg+' Required');
				thisObj[0].focus();
			}
		}
		if(!hasError && thisObj.hasClass('email')){
			if(! validateEmail(thisObj.val())){
				showPopup('Enter valid email');
				hasError = true;
				thisObj[0].focus();
			}
		}
		if(!hasError && thisObj.hasClass('url')){
			if(! validateEmail(thisObj.val())){
				showPopup('Enter valid URL');
				hasError = true;
				thisObj[0].focus();
			}
		}
		if(!hasError && thisObj.hasClass('equal')){
			if(!compareEqual($('#'+previous).val(), $('#'+current).val())){
				var prevMsg = $('#'+previous).attr('title') ? $('#'+previous).attr('title') : $('#'+previous).attr('toolTip');
				var currentMsg = $('#'+current).attr('title') ? $('#'+current).attr('title') : $('#'+current).attr('toolTip');
				showPopup(prevMsg + ' and ' +  currentMsg + ' must be same');
				hasError = true;
				thisObj[0].focus();
			}
		}
		if(!hasError && thisObj.hasClass('imageFile')){
			if(! validateImageFileExtension(thisObj.val())){
				showPopup('Please Upload JPG/GIF/PNG file');
				hasError = true;
				thisObj[0].focus();
			}
		}		
		if(!hasError && thisObj.hasClass('videoLink')){
			if(! validateEmbed(thisObj.val())){
				showPopup('Enter valid embed code');
				hasError = true;
				thisObj[0].focus();
			}
		}
		
	});
	
	return hasError;
}
function validateEmail(str)
{
	str = $.trim(str);
	if(isEmpty(str)) return true;
	regex=/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
	return(regex.test(str));
	
}

function validateEmbed(str)
{
	str = $.trim(str);
	if(isEmpty(str)) return true;
	//regex =/http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/;
	youtube = /https?:\/\/www\.youtube.com\//;
	if(youtube.test(str)){
		if(/embed/.test(str)){
			return true;	
		} else if(/watch\?v=([^?&]*)/.test(str)){
			return true;
	   }
	}
	return false;
}

function validateUrl(url)
{
	return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);	
}

function validateOption(radName)
{
	var radios = document.getElementsByName(radName);
	for(cnt = 0; cnt < radios.length; cnt++){
		if(radios[cnt].checked) 
			return true;
	}
	return false;
}

function validateCheckBoxArray(checkBoxName)
{
	var valid = false;
	var checkBoxArray = $(':input[name^='+checkBoxName+']');
	checkBoxArray.each(function(){
		if($(this)[0].checked){
			valid = true;
		}
	})
	return valid;
}

function compareEqual(str1, str2)
{
	if(str1 == str2)
		return true;
	else
		return false;
}

function isEmpty(str)
{
	if($.trim(str) == ''){
		return true;
	}
	return false;
}

function isValid(obj)
{
	if($.trim(obj.val()) == ''){
		return false;
	}
	return true;
}

function isInteger(obj)
{
	value = $.trim(obj.val());
	if(isEmpty(value)) return true;
	regex=/^(\d+)$/;
	return (regex.test(value));
}

function checkDate(year, month, day)
{
	var d = new Date();
	month -= 1;
	d.setFullYear(year, month, day);
	return (d.getDate() == day && d.getMonth() == month && d.getFullYear() == year);
}

function validateImageFileExtension(fileName)
{
	var validExtension = /(.jpg|.jpeg|.gif|.png)$/i;   
	return (validExtension.test(fileName))
}
