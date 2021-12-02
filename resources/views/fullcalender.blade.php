
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
 .fc th, .fc td {
    border-style: solid;
    border-width: 1px;
    padding: 0;
    vertical-align: top;
    border-color: #65B7AB !important;
}

span.fc-icon.fc-icon-left-single-arrow {
    color: brown;
}
span.fc-icon.fc-icon-right-single-arrow {
    color: brown;
}
button.fc-next-button.fc-button.fc-state-default.fc-corner-right {
    /* color: blue; */
    background: turquoise;
}
button.fc-prev-button.fc-button.fc-state-default.fc-corner-left {
    background: turquoise;
}

h2 {
    color: #E67E22 !important;
    font-weight: 900 !important;;
}

button.fc-today-button.fc-button.fc-state-default.fc-corner-left.fc-corner-right {
    color: beige;
    background: deeppink;
}

th.fc-day-header.fc-widget-header {
    background: radial-gradient(black, transparent);
    color: cornsilk;
}

a.fc-day-grid-event.fc-h-event.fc-event.fc-start.fc-end {
    background: currentColor;
}

/* #calendar {
    overflow-x: scroll; 
    overflow-y: scroll; 
} */
/* .fc-scroller { 
	overflow-y: auto !important;
	overflow-x: hidden  !important;
} */

/* #container{
width: 100%;
height: 500px;  
overflow: hidden !important;
}

.list {
  
  height: 100%;  
  width: 900px;
  overflow-y: auto !important;;
  overflow-x: hidden;
} */


    </style>

    @extends('layouts.app', ['activePage' => 'employee', 'menuParent' => 'Employee', 'titlePage' => __('Events & Calendar')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
    <!-- <h1>Laravel FullCalender </h1> -->
    <!-- <div id="calendarContainer" style="border:solid 2px red;"> -->
    <div class="list">
    <div id='calendar' ></div>
    </div>
    <!-- </div> -->
</div>
</div>
</div>
</div>
   
@endsection
@push('js')
<script>
$(document).ready(function () {
   
var SITEURL = "{{ url('/') }}";  //alert(SITEURL);
  
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
var calendar = $('#calendar').fullCalendar({
                    editable: false,
                    events: SITEURL + "/fullcalender",
                    displayEventTime: false,
                    editable: false,
                    eventRender: function (event, element, view) {
                       // alert(view);
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    eventRender: function(event, element, view, info) {  //alert(view.name);
                     if(element.find(".fc-title").text() != "present" && element.find(".fc-title").text() != "leave")
                     {
                        if (view.name == 'monthd') {
                            element.find(".fc-list-item-time").append("<a style='float: right;' class='closeon'><i class='fa fa-trash'></i></a>");
                        } else {
                            element.find(".fc-content").prepend("<a style='float: right;' class='closeon'><i class='fa fa-trash'></i></a>");
                        }
                     }
                     var eventId = event.id; //alert(eventId);
                    // if (eventId != '1')
                    //     {
                    //     $(eventId.el).css("border-style", "dashed");
                    //     $(eventId.el).css("border-color", "#ffff00");
                    //     }
       		element.find(".closeon").on('click', function() {
        	//	$('#calendar').fullCalendar('removeEvents',event._id);
        		//alert('delete');
                var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                        id: event.id,
                                        type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Event Deleted Successfully");
                                }
                            });
                        }
        		});
        },
                    select: function (start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                            $.ajax({
                                url: SITEURL + "/fullcalenderAjax",
                                data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    type: 'add'
                                },
                                type: "POST",
                                success: function (data) {
                                    displayMessage("Event Created Successfully");
  
                                    calendar.fullCalendar('renderEvent',
                                        {
                                            id: data.id,
                                            title: title,
                                            start: start,
                                            end: end,
                                            allDay: allDay
                                        },true);
  
                                    calendar.fullCalendar('unselect');
                                }
                            });
                        }
                    },
                    eventDrop: function (event, delta) {  
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
  
                        $.ajax({
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Event Updated Successfully");
                            }
                        });
                    },
                    eventClick: function (event) { //alert(event.color);
                       /////
                    }
 
                });
 
});
 
function displayMessage(message) {
    toastr.success(message, 'Event');
} 
  
</script>
  
@endpush