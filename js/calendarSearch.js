$(document).ready(function(){					   
		$('body').delegate('.eventsCalendarSearch', 'click', function()
		{		
			$("#calendar").hide();		
			$("#calendarSearch").show();	
			$('#calendar').fullCalendar({		
			header: { left: 'prev,next,today', center: 'title', right: 'month,basicWeek,basicDay' },	
			editable: false, error: function() { alert('there was an error while fetching events!'); },
			events: { url: 'eventsCal.php',
			type: 'POST', 
			data: { calendarSearch: true, userCountry: userCountry, userStateTxt: userStateTxt, userStateLst: userStateLst }							  
		},
			loading: function(bool) { if (bool) $('#loading').show(); else $('#loading').hide(); }					
		});
 });
});