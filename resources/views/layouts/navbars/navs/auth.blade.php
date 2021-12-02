<style type="text/css">
    #Notify_link_btn{
        padding: 0px 5px;
        min-width: 300px;
    }
    .span-class{
        position: relative;
        width: auto;
        display: flex;
        flex-flow: nowrap;
        align-items: center;
        color: #333;
        font-weight: normal;
        text-decoration: none;
        font-size: .8125rem;
        border-radius: 0.125rem;
        margin: 0 0.3125rem;
        -webkit-transition: all 150ms linear;
        -moz-transition: all 150ms linear;
        -o-transition: all 150ms linear;
        -ms-transition: all 150ms linear;
        transition: all 150ms linear;
        min-width: 7rem;
        padding: 0.625rem 1.25rem;
        overflow: hidden;
        line-height: 1.428571;
        text-overflow: ellipsis;
        word-wrap: break-word;
        font-size: 10px;
        margin-top: -1px;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
          </button>
        </div>
        <a class="navbar-brand" href="#pablo">{{ $titlePage }}</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
       <!-- <form class="navbar-form">
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
              <i class="material-icons">search</i>
              <div class="ripple-container"></div>
            </button>
          </div>
        </form> -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="material-icons">dashboard</i>
              <p class="d-lg-none d-md-block">
                {{ __('Stats') }}
              </p>
            </a>
          </li>  
			 <li class="nav-item">
            <a class="nav-link" href="fullcalender">
              <i class="material-icons">calendar_today</i>
              <p class="d-lg-none d-md-block">
                {{ __('Stats') }}
              </p>
            </a>
          </li>   
          <li class="nav-item dropdown notify_bell" >
        
           <a class="nav-link" note_id="" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="material-icons">notifications</i>
           <span class="notification">0</span> <p class="d-lg-n">  Some Actions</p></a>
           <div id="notify_dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink"> 
           <!-- <a class="dropdown-item" href="#">Mike John responded to your email</a>
           <a class="dropdown-item" href="#">You have 5 new tasks</a>
            <a class="dropdown-item" href="#">Mike John responded to your email</a>
          <a class="dropdown-item" href="#">You have 5 new tasks</a> -->

           </div> 
          </li>
			
			<li class="nav-item">
            <a class="nav-link" href="{{ route('profile.edit') }}">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                {{ __('Stats') }}
              </p>
            </a>
          </li>   
			
			<li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="material-icons">logout</i>
              <p class="d-lg-none d-md-block">
                {{ __('Stats') }}
              </p>
            </a>
          </li>   

         <!-- <li class="nav-item dropdown">
            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                  {{ __('Account') }}
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
            </div>
          </li> -->
			 
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  @push('js')
<script>
$(document).ready(function () {
   
     bind_notification();
});
  function bind_notification()
 {
  var SITEURL = "{{ url('/') }}";  //alert(SITEURL);
  
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  var csrf = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                      url: SITEURL + "/notification",
                      data: {
                        _token: csrf
                      },
                      type: "POST",
                      dataType: 'json',
                      success: function (data) {
              //alert(data);
                        var SITEURL = "{{ url('/') }}";
                     //  var arr = JSON.parse(data);
                        var count = 0; //data.length;  //alert(count);
                        var html = "";
                        var note_id = "";
                        $('#notify_dropdown').html(""); 
                        $("#navbarDropdownMenuLink").attr("note_id", 0);         
                  $.each(data, function(index, value) {
                  //  alert(value.read_at);
                      var title = (value.title);
                      var url = SITEURL + "/" +  value.page_url;
                      if(value.read_at != 0)
                      {
                        count ++;
                        //alert(value.read_at);
                        note_id +=  value.id + ",";
                      }

                      var time =  value.time;
                      var MySQL_date = value.date + " " + value.time;  // '2017-12-31 11:55:17';
                      var jsDate = new Date(Date.parse(MySQL_date.replace(/[-]/g,'/')));
                      var tes_time =  time_ago(jsDate);

                      html +=  '<div class="modal-header" style="padding:5px;">';
                      html +=  '<div class="row">';
                      html +=  '<div class="col-lg-10">';
                      html += "<a id='Notify_link_btn' name="  + value.id  + " class='dropdown-item' href=" + url + ">" + title + " </a>";
                      html += "</div>";
                      html +=  '<div class="col-lg-2">';
                      html +=  '<button id="popop_close_btn" name='  + value.id  + ' type="submit" class="close" data-dismiss="modalsss" aria-hidden="true">×</button>';
                      html += "</div>";
                      //html += '<div class="row">';
                      html += "<span class='span-class float-right'>" + tes_time + "</span>";
                     // html += "</div>";
                      html += "</div>";
                      html += "</div>";

                     //  html +=  '<div class="modal-header">';
                     // html += "<a id='Notify_link_btn' name="  + value.id  + " class='dropdown-item' href=" + url + ">" + title + " </a>";
                     //  html +=  '<button id="popop_close_btn" name='  + value.id  + ' type="submit" class="close" data-dismiss="modalsss" aria-hidden="true">×</button>';

                     //  html += "</div>";

                     //   html += "</br><span class='dropdown-item'>" + tes_time + "</span>";
  
                     
                  

                     });
                   


                  $('#notify_dropdown').html(html);  
                  $("#navbarDropdownMenuLink").attr("note_id", note_id);   
                  $('.notification').html(count);     
  
               //  alert(html);
                      }
                  });
        }

       function time_ago(time) {
            switch (typeof time) {
              case 'number':
                break;
              case 'string':
                time = +new Date(time);
                break;
              case 'object':
                if (time.constructor === Date) time = time.getTime( );
                break;
              default:
                time = +new Date();
            }
             //alert(new Date());
            var time_formats = [
              [60, 'seconds', 1], // 60
              [120, '1 minute ago', '1 minute from now'], // 60*2
              [3600, 'minutes', 60], // 60*60, 60
              [7200, '1 hour ago', '1 hour from now'], // 60*60*2
              [86400, 'hours', 3600], // 60*60*24, 60*60
              [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
              [604800, 'days', 86400], // 60*60*24*7, 60*60*24
              [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
              [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
              [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
              [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
              [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
              [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
              [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
              [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
            ];
            var seconds = (+new Date() - time) / 1000,
              token = 'ago',
              list_choice = 1;
            if (seconds == 0) {
              return 'Just now'
            }
            if (seconds < 0) {
              seconds = Math.abs(seconds);
              token = 'from now';
              list_choice = 2;
            }
            var i = 0,
              format;
            while (format = time_formats[i++])
              if (seconds < format[0]) {
                if (typeof format[2] == 'string')
                  return format[list_choice];
                else
                  return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
              }
            return time;
        }


    $(document).ready(function() {
      $("#navbarDropdownMenuLink").click(function(){ 
        if($('.notification').html() != 0)
        {
            var id = $(this).attr('note_id');
            var csrf = $('meta[name="csrf-token"]').attr('content');
            $('.notification').html(0);
            $.ajax({
                url: '/notificationviwed',
                type: 'POST',
                data: {id : id, '_token': csrf},
                dataType: 'json',
                success: function( data ) {
                
                }       
            })
        }
    }); 
})


$(document).on('click', '#popop_close_btn', function(e){
  e.preventDefault();
  var id = $(this).attr('name'); 
  view_notif(id);
  $(this).closest('.modal-header').remove();
 
});

$(document).on('click', '#Notify_link_btn', function(){
  var id = $(this).attr('name'); 
  view_notif(id);
 
});


function view_notif($id)
{
  var id = $(this).attr('note_id');
   var csrf = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
              url: '/notification_single_viewdd',
              type: 'POST',
              data: {id : $id, '_token': csrf},
              dataType: 'json',
              success: function( data ) {
              
              }       
            })
}
</script>
  
@endpush