	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			//defaultDate: todays,
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
			$('#start').text(start);
			$('#end').text(end);
			$('#popup')[0].reset();
			$( "#dialog" ).dialog( "open" );
			$('#update_event').css("display","none");  
			$('#delete_event').css("display","none"); 
                        $('#add_event').css("display","block");			

			},
			editable: false,  /* true for sliding  */
			events:	{
				url: baseUrl +'group_events/get_events/'+jsVars.wall_id,
				error: function() {
					$('#script-warning').show();
				}
			},
			eventClick: function(event) {
                            if (event.url){
                                window.open(event.url,'_blank');
                            }
			console.log('going to fetch event details from get_event_det.php with id=' + event.id );
			// ajax call
                                        var ata = {event_id:event.id};
				       $.ajax({
					   url: baseUrl +'group_events/get_this_events',
					   data: ata  ,
					   type: "POST",
					   success: function(json) {
					   console.log(json);
					   obj = JSON.parse(json);
					   
					  
					    $('#popup')[0].reset();
						$('#title').val(obj.event_name);
						$('#url').val(obj.url);
						$('#color').val(obj.color);
						$('#event_id').val(obj.id);
						$( "#dialog" ).dialog( "open" );
						$('#add_event').css("display","none");
						$('#update_event').css("display","block");
						$('#delete_event').css("display","block");

					   }
					          });
			
			
			}
		});
		

		

	});
	


	

	
            function update_todb(remove)
            {

alert(remove);
                    $( "#dialog" ).dialog( "close" );		
                    var title=$('#title').val();
                    var color=$('#color').val().substring(1, 7);
                    var eURL=$('#url').val();		
                    var event_id=$('#event_id').val();		
                        if (title || remove == 1) {

                                var start1 =$('#start').text();
                                var end1 =$('#end').text();


                                var myDate1 = new Date(start1);
                                var start = myDate1.getTime();
                                var myDate2 = new Date(end1);
                                var end = myDate2.getTime();
alert('ssss');
                event = {name : title, group_id : jsVars.wall_id, event_start :start , event_end :end , color : color, event_id : event_id, dele : remove, url : '', user_id : jsVars.user_id };
                console.log(event);
               $.ajax({
               url: baseUrl+'group_events/add_events',
               data: event,
               type: "POST",
               success: function(json) {
               //alert('Added Successfully');
               $('#popup')[0].reset();
               return false;
               }
               });
                                                    eventData = {
                                                            title: title,
                                                            start: start,
                                                            end: end,
                                                            textColor:$('#color').val()
                                                    };
                                                    console.log(eventData);
                                                    if(event_id==''){
                                                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                                                    }
                            }
                                            $('#calendar').fullCalendar('unselect');
            }

Number.prototype.padLeft = function(base,chr){
    var  len = (String(base || 10).length - String(this).length)+1;
    return len > 0? new Array(len).join(chr || '0')+this : this;
}	



//************** new added one **********************//

$(function() {
$( "#dialog" ).dialog({
autoOpen: false,
show: {
effect: "blind",
duration: 1000
},
hide: {
effect: "blind",
duration: 1000
}

});

$( "#opener" ).click(function() {
$( "#dialog" ).dialog( "open" );

});
});

$(document).ready(function(){
$('#add_event').click(function(){

update_todb(0);
    alert('d');
return false;
});

});
$(document).ready(function(){
$('#update_event').click(function(){
update_todb(0); 
return false;
});

});
$(document).ready(function(){
$('#delete_event').click(function(){
    alert('delete clicked');
update_todb(1); 
return false;
});

});