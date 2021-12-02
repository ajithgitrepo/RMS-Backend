<style>
.sorting_disabled {
    display:block !important;
}
.display-block{
     display:table-cell !important;
}
.btn-action{
     padding: 0px 0px !important;
}
.view-edit{
  padding: 10px 15px !important;
  margin: 0.3125rem 1px !important;
}

 .borderless tr, .borderless td, .borderless th {
    border: none !important;
   }

  .list-group{
          max-height: 450px;
          margin-bottom: 10px;
          overflow:scroll;
          -webkit-overflow-scrolling: touch;
           max-width: 300px;
      }

/*.card {
   
    min-height: 600px;
}*/

#map {
    margin-top: 15px !important;
}

.buttons {
  width: 200px;
}

.action_btn {
  display: inline-block;
  width: calc(50% - 4px);
  margin: 0 auto;
}

.card-title-month{
    padding: 20px;
}

.card .card-header-info .card-icon, .card .card-header-info .card-text, .card .card-header-info:not(.card-header-icon):not(.card-header-text), .card.bg-info, .card.card-rotate.bg-info .front, .card.card-rotate.bg-info .back {
   
    background: #ff9047 !important;
}

</style>


@extends('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Outlet Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">details</i>
                </div>
                <h4 class="card-title">{{ __('Outlet Details') }}</h4>
              </div>

              <div class="details" style="margin-left: 20px;margin-top: 20px;">

                <span id="store_code" style="font-weight: 400;font-size: 30px;"></span> <span id="outlet_name" style="font-weight: 400;font-size: 30px;"></span><br>

                <span id="address" style="font-size: 20px;margin-bottom: 10px;" ></span><br><br>

                <table>
                    
                    <tr><td>Contact No</td><td>:</td><td id="contact_no"></td></tr><!-- 
                    <tr><td>program Name</td><td>:</td><td id="program_name">Tang6985</td></tr>
                    <tr><td>Distance</td><td>:</td><td id="distance">-</td></tr> -->
                    <tr><td>Last Visit</td><td>:</td><td id="last_visit"></td></tr>


                </table>
              </div>


              <div class="card-body">
                <div class="row">
                   
<!--                             <button name="submit" id="check_out" class="btn btn-danger"  value="" onclick="check_out(this.value)">Check Out</button> -->
                            <button name="submit" id="check_in" class="btn btn-success ml-auto" value="" onclick="check_in(this.value)" >Check In</button>
                    
                      <div id="map" style="float:left;width:100%;"></div>
                     
                  </div>
            
              </div>
            </div>
        </div>

         <div class="col-md-12">
          <div class="card card-chart">
             <h4 class="card-title-month">Monthly No.of Visits</h4>
            <div class="card-header card-header-info">
              <div id="simpleBarChart" class="ct-chart"></div>
            </div>
            <div class="card-body">
             
            </div>
          </div>
        </div>

      </div>

     <!--  <div class="row">
        <div class="col-md-12">
          <div class="card card-chart">
             <h4 class="card-title card-title-month">Monthly No.of Visits</h4><br><br>
            <div class="card-header card-header-rose">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <div class="card-actions">
              
              </div>
             
            </div>
           
          </div>
        </div>
    </div> -->

  </div>

@endsection

<script src=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js
"></script>
	  


@push('js')
	  
 <!--  Google Maps Plugin    -->
      
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCUNTZl1vh8BheJzaGuBOGhV8FtNr7vlik"></script>

	  
  <script>


 $(function () {
                  
        $(".datepicker").datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: false
        });

        //init();
        //get_plan();

  });
  
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders

      demo.initCharts();

      //md.initDashboardPageCharts();

        var labels = new Array();
        var series = new Array();

       var dataSimpleBarChart = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul' , 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]
        ]
      };

      var optionsSimpleBarChart = {
        seriesBarDistance: 10,
        axisX: {
          showGrid: false
        }
      };

      var responsiveOptionsSimpleBarChart = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];

      var simpleBarChart = Chartist.Bar('#simpleBarChart', dataSimpleBarChart, optionsSimpleBarChart, responsiveOptionsSimpleBarChart);

      //start animation for the Emails Subscription Chart
      md.startAnimationForBarChart(simpleBarChart);
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 

      locations();

      monthly_count();
      
    }); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });


    function locations(){

        var csrf = $('meta[name="csrf-token"]').attr('content');

        var url = $(location).attr('href');

        var id = url.substr(url.lastIndexOf('/') + 1);

        //alert(id);

        $.ajax({
          url: '/outlet_detail',
          type: 'GET',
          data: {'_token': csrf, 'id':id},
          dataType: 'json',
          success: function( data ) { 
                //alert(JSON.stringify(data))

                $("#store_code").html("["+data[0]['store_code']+"]"); contact_no
                $("#outlet_name").html(data[0]['store_name']);
                $("#address").html(data[0]['address']);  
                $("#contact_no").html(data[0]['contact_number']);

                if(data[1]){
                    var dateAr = data[1].last_visit.split('-');
                    var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
                }
                
                $("#last_visit").html(newDate);
                $("#check_in").val(id);
                $("#check_out").val(id);

                google_maps(data);
            }    
        })

    }

    function monthly_count(){

        var csrf = $('meta[name="csrf-token"]').attr('content');

        var url = $(location).attr('href');

        var id = url.substr(url.lastIndexOf('/') + 1);

        //alert(id);

        $.ajax({
          url: '/monthly_count',
          type: 'GET',
          data: {'_token': csrf, 'id':id},
          dataType: 'json',
          success: function( data ) { 
               // alert(JSON.stringify(data))

                var labels = new Array();
                var series = new Array();

                 $.each(data, function(i, item) {
                    //alert(item.name);
                     var store_name = item.name;
                     var count = item.count;
                     labels.push(store_name);
                     series.push(count);

                });

                 //alert(series);

                  var dataSimpleBarChart = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul' , 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    series: [
                      series
                    ]
                  };

                  var optionsSimpleBarChart = {
                    seriesBarDistance: 10,
                    axisX: {
                      showGrid: false
                    }
                  };

                  var responsiveOptionsSimpleBarChart = [
                    ['screen and (max-width: 640px)', {
                      seriesBarDistance: 5,
                      axisX: {
                        labelInterpolationFnc: function(value) {
                          return value[0];
                        }
                      }
                    }]
                  ];

                  var simpleBarChart = Chartist.Bar('#simpleBarChart', dataSimpleBarChart, optionsSimpleBarChart, responsiveOptionsSimpleBarChart);

                  //start animation for the Emails Subscription Chart
                  md.startAnimationForBarChart(simpleBarChart);

            }    
        })

    }

  

    //  google_maps(json);
   
   
     function google_maps(data)
     {

       // alert(data[0]['outlet']['outlet_lat']);  

         const myLatLng = { lat: parseFloat(data[0]['outlet']['outlet_lat']), lng: parseFloat(data[0]['outlet']['outlet_long']) };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: myLatLng,
          });
          new google.maps.Marker({
            position: myLatLng,
            map,
            title: data[0]['outlet']['outlet_name'],
          });

        }

function check_in(id)
{
    //alert(id);

    //return false;

    var csrf = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
          url: '/outlet_check_in',
          type: 'POST',
          data: {id : id, _token: csrf},
          dataType: 'json',

          success: function( data ) {

             //alert(data);

             if(data ==1)
             {
                window.location.href = '/c-activity/'+id+' ';
             }

             if(data ==0)
             {
                alert('You cannot able to login..');
             }

          
          }       
      })

// if (navigator.geolocation) {

//     navigator.geolocation.getCurrentPosition(function(position, html5Error){
//       //alert(id);
//         geo_loc = processGeolocationResult(position);
//         currLatLong = geo_loc.split(",");
//        // initializeCurrent(currLatLong[0], currLatLong[1]);

//         currgeocoder = new google.maps.Geocoder();
//          console.log(latcurr + "-- ######## --" + longcurr);

//          if (currLatLong[0] != '' && currLatLong[1] != '') {
//              var myLatlng = new google.maps.LatLng(currLatLong[0], currLatLong[1]);
//              console.log(myLatlng);
//             // return getCurrentAddress(myLatlng);

//               currgeocoder.geocode({
//               'location': myLatlng

//                 }, function(results, status) {

//                     if (status == google.maps.GeocoderStatus.OK) {
//                         //$("#address").html(results[0].formatted_address);


//                           $.ajax({
//                               url: '/outlet_check_in',
//                               type: 'POST',
//                               data: {id : id, _token: csrf},
//                               dataType: 'json',

//                               success: function( data ) {
//                                  alert("Check In Successfully..");

                                 
//                               }       
//                           })


//                     } else {
//                         alert('Geocode was not successful for the following reason: ' + status);
//                     }

//                 });


//          }

//     });

//   } 

}

function check_out(id)
{
    //alert(id);

    var csrf = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
          url: '/outlet_check_out',
          type: 'POST',
          data: {id : id, _token: csrf},
          dataType: 'json',

          success: function( data ) {
             
             if(data ==0)
             {
                alert('Please login..');
                return false;
             }

             if(data ==1)
             {
                alert("Check Out Successfully..");
             }

          }       
      })

// if (navigator.geolocation) {

//     navigator.geolocation.getCurrentPosition(function(position, html5Error){

//         geo_loc = processGeolocationResult(position);
//         currLatLong = geo_loc.split(",");
//        // initializeCurrent(currLatLong[0], currLatLong[1]);

//         currgeocoder = new google.maps.Geocoder();
//         // console.log(latcurr + "-- ######## --" + longcurr);

//          if (currLatLong[0] != '' && currLatLong[1] != '') {
//              var myLatlng = new google.maps.LatLng(currLatLong[0], currLatLong[1]);
//              console.log(myLatlng);
//             // return getCurrentAddress(myLatlng);

//               currgeocoder.geocode({
//               'location': myLatlng

//                 }, function(results, status) {

//                     if (status == google.maps.GeocoderStatus.OK) {
//                         //$("#address").html(results[0].formatted_address);


//                           $.ajax({
//                               url: '/outlet_check_out',
//                               type: 'POST',
//                               data: {id : id, lat : position.coords.latitude, lng : position.coords.longitude, _token: csrf, address : results[0].formatted_address},
//                               dataType: 'json',

//                               success: function( data ) {
//                                  alert("Check Out Successfully..");


//                               }       
//                           })


//                     } else {
//                         alert('Geocode was not successful for the following reason: ' + status);
//                     }

//                 });


//          }

//     });

//   } 

}

 function processGeolocationResult(position) {
     html5Lat = position.coords.latitude; //Get latitude
     html5Lon = position.coords.longitude; //Get longitude
     //console.log(html5Lat);
     //console.log(html5Lon);
     html5TimeStamp = position.timestamp; //Get timestamp
     html5Accuracy = position.coords.accuracy; //Get accuracy in meters
     return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
   }

  </script>

@endpush
