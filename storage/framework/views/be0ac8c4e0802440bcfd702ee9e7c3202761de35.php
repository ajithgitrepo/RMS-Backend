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

.card {
   
    min-height: 600px;
}

#map {
    margin-top: 15px !important;
}

</style>




<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Journey Plan')); ?></h4>
              </div>
              
              
              <div class="card-body">
             
                    <div class="row">

                        <div class="col-lg-3">

                        </div>

                        <div class="col-lg-3">

                        </div>

                        <div class="col-lg-3">
                         <div class="row">
                          <label class="col-sm-2 col-form-label"><?php echo e(__('Date : ')); ?></label>
                          <div class="col-sm-7">
                            <div class="form-group<?php echo e($errors->has('date') ? ' has-danger' : ''); ?>">
                              <input class="form-control datepicker" name="date" id="get_by_date" type="text" placeholder="" value=""  aria-required="true"/>
                              <?php echo $__env->make('alerts.feedback', ['field' => 'date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>
                        </div>  
                       </div>

                       
                       
                    <div class="col-lg-3">
                         <button class="btn btn-info" onclick="get_by_date(' ', false);" >Submit</button>
                    </div>
                     
                </div>

                <hr>

                <h3 class="text-center">Journey Plan</h3>

                <div class="table-responsive">
                  <table id="datatables" class="table">
                  
                    <thead class="text-primary">
                    
                      <th>
                          <?php echo e(__('#')); ?>

                      </th>
                      
                      <th>
                          <?php echo e(__('Date')); ?>

                      </th>
                      
                      <th>
                          <?php echo e(__('Outlet Id')); ?>

                      </th>

                       <th>
                          <?php echo e(__('Outlet Name')); ?>

                      </th>

                      <th>
                          <?php echo e(__('Type')); ?>

                      </th>

                      <th>
                          <?php echo e(__('Status')); ?>

                     </th>
                     
                      <th>
                          <?php echo e(__('Action')); ?>

                     </th>
                     
                    </thead>
                    
                    <tbody id="load_table" >



                    </tbody>
                  </table>

                     
                  </div>
               
                     <h3 class="text-center">Map View</h3>

                     <div id="map" style="float:left;width:100%;"></div>
            
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<script src=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js
"></script>



<?php $__env->startPush('js'); ?>

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
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
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

   
    var csrf = $('meta[name="csrf-token"]').attr('content');

    var stations = $.ajax({
          url: '/get_journey_plan',
          type: 'GET',
          data: {'_token': csrf},
          dataType: 'json',
          async:false,
    }).responseJSON;

   // alert(JSON.stringify(stations));

    var optimizes = false;

     var json = [];

     var id = 1;

     var html = '';

      $.each(stations, function (i, val) {

        //alert(stations[i]['outlet']['outlet_lat']);

         // console.log(stations[i]['outlet_login'].length >0)
          //alert(data[i]['employee']['first_name'])
          // json.push({lat : stations[i]['outlet']['outlet_lat'], lng : stations[i]['outlet']['outlet_long'], name: stations[i]['store_name'], merchant_id: stations[i]['id'], checkin_time: stations[i]['outlet_login']['checkin_time'], checkout_time: stations[i]['outlet_login']['checkout_time'] });

          
            json.push({lat : stations[i]['outlet']['outlet_lat'], lng : stations[i]['outlet']['outlet_long'], name: stations[i]['store_name'], merchant_id: stations[i]['id'], checkin_time: stations[i]['checkin_time'], checkout_time: stations[i]['checkout_time'] });
         
           html += '<tr>';
               html += '<td>' + id++ + '</td>';
              
                html += '<td>' + stations[i].date + '</td>';
               
               html += '<td>' + stations[i].store_code + '</td>';
               html += '<td>' + stations[i]['store_name']+ '</td>';

               if(stations[i].is_defined == 1)
               {
                html += '<td> Schedule </td>';
               }
 
               if(stations[i].is_defined == 0)
               {
                html += '<td> UnSchedule </td>';
               }

               if(stations[i].is_completed == 1)
               {
                html += '<td title="Completed"> <i class="fa fa-check  btn-success" aria-hidden="true" ></i>';
               }

               if(stations[i].is_completed == 0)
               {
                html += '<td title="Not Completed"> <i class="fa fa-times btn-danger" aria-hidden="true"></i> </td>';
               }

               html += '<td title="View"><button class="btn-success" onclick="check_in(' + stations[i].id + ')" > View </button></td>';

                // html += '<td> <i class="fa fa-eye btn-info" aria-hidden="true" onclick="check_in(' + stations[i].id + ')">View</i> </td>';

           html += '</tr>';

         });

      $("#load_table").html(html);

      //alert(json);

     google_maps(json);
   
    // function get_plan()
    // {
    //   var csrf = $('meta[name="csrf-token"]').attr('content');
    //   $.ajax({
    //       url: '/get_journey_plan',
    //       type: 'GET',
    //       data: {'_token': csrf},
    //       dataType: 'json',
    //       async:false,
    //       success: function( data ) {
    //          //alert(data[0].date);
               
    //          stations.push(data);  
            
    //          $.each(data, function (i, val) {

    //           //alert(data[i]['outlet']['outlet_name'])
    //           //alert(data[i]['employee']['first_name'])
    //           stations.push({ lat : data[i]['outlet']['outlet_lat'], lng : data[i]['outlet']['outlet_long'], name: data[i]['outlet']['outlet_name'] })

    //          });

    //           google_maps(stations);

    //       }       
    //   })
    // }

    //alert(JSON.stringify(stations));
    
    //var stations = new Array();

    function get_by_date(date,optimizes)
    {
      //alert(optimizes);
      var date = $("#get_by_date").val();
      var day = $("#day").val();
      //alert(day);
      if(date !=="" || day !=="")
      {
        var csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/get_by_date',
            type: 'GET',
            data: {'date': date, 'day': day, '_token': csrf},
            dataType: 'json',

            success: function( data ) {
               //alert(JSON.stringify(data));
                var json = [];

                var id = 1;

                var html = '';

                if(optimizes == false)
                {
                  $.each(data, function (i, val) {

                      //alert(data[i]['outlet']['outlet_name'])
                      //alert(data[i]['employee']['first_name'])
                      // json.push({ lat : data[i]['outlet']['outlet_lat'], lng : data[i]['outlet']['outlet_long'], name: data[i]['outlet']['outlet_name'], merchant_id: data[i]['id'], checkin_time: data[i]['checkin_time'], checkout_time: data[i]['checkout_time'] })

                   
                        json.push({lat : data[i]['outlet']['outlet_lat'], lng : data[i]['outlet']['outlet_long'], name: data[i]['store_name'], merchant_id: data[i]['id'], checkin_time: data[i]['checkin_time'], checkout_time: data[i]['checkout_time'] });


                     
                       html += '<tr>';
                           html += '<td>' + id++ + '</td>';
                         
                            html += '<td>' + data[i].date + '</td>';
                          
                           html += '<td>' + data[i].store_code + '</td>';
                           html += '<td>' + data[i]['store_name'] + '</td>';
                            if(data[i].is_defined == 1)
                           {
                            html += '<td> Schedule </td>';
                           }

                           if(data[i].is_defined == 0)
                           {
                            html += '<td> UnSchedule </td>';
                           }

                           if(data[i].is_completed == 1)
                           {
                            html += '<td title="Completed"> <i class="fa fa-check  btn-success" aria-hidden="true" ></i>';
                           }

                           if(data[i].is_completed == 0)
                           {
                            html += '<td title="Not Completed"> <i class="fa fa-times btn-danger" aria-hidden="true"></i> </td>';
                           }

                          
                            // html += '<td> <i class="fa fa-eye" aria-hidden="true" onclick="check_in(' + data[i].id + ')"></i> </td>';

                            html += '<td title="View"><button class="btn-success" onclick="check_in(' + data[i].id + ')" > View </button></td>';

                       html += '</tr>';


                     });

                  $("#load_table").html(html);

                  google_maps(json);
                }

                if(optimizes == true)
                {
                  $.each(data, function (i, val) {

                      //alert(data[i]['outlet']['outlet_name'])
                      //alert(data[i]['employee']['first_name'])
                      json.push({ lat : data[i]['outlet']['outlet_lat'], lng : data[i]['outlet']['outlet_long'], name: data[i]['store_name'], merchant_id: data[i]['id'], checkin_time: data[i]['checkin_time'], checkout_time: data[i]['checkout_time'] })

                     });

                   function calculateDistance(lat1, lon1, lat2, lon2, unit) {
                      var radlat1 = Math.PI * lat1/180
                      var radlat2 = Math.PI * lat2/180
                      var radlon1 = Math.PI * lon1/180
                      var radlon2 = Math.PI * lon2/180
                      var theta = lon1-lon2
                      var radtheta = Math.PI * theta/180
                      var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                      dist = Math.acos(dist)
                      dist = dist * 180/Math.PI
                      dist = dist * 60 * 1.1515
                      if (unit=="K") { dist = dist * 1.609344 }
                      if (unit=="N") { dist = dist * 0.8684 }
                      return dist
                    }

                    for ( i = 0; i < json.length; i++) {
                      json[i]["distance"] = calculateDistance(json[0]["lat"],json[0]["lng"],json[i]["lat"],json[i]["lng"],"K");
                    }

                    json.sort(function(a, b) { 
                      return a.distance - b.distance;
                    });

                    console.log(json)

                    google_maps(json)
                }

            }       
        })
      }
   
    }
      //alert(JSON.stringify(stations));

    function CenterControl(controlDiv, map) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Click to recenter the map";
        controlDiv.appendChild(controlUI);


        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "16px";
        controlText.style.lineHeight = "38px";
        controlText.style.paddingLeft = "5px";
        controlText.style.paddingRight = "5px";
        controlText.innerHTML = "Optimize";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
          optimize();
        });
    }
     
     function google_maps(stations)
     {

         // alert(JSON.stringify(stations));

          const waypts = [];

          if(stations.length >2){
           var way_points = stations.slice(1, -1)
          // alert(way_points);

           for (let i = 0; i < way_points.length; i++) { 
             var latitude = way_points[i].lat; 
             var longtitude = way_points[i].lng;
             //alert(way_points[i].name);
             // if (checkboxArray.options[i].selected) {
                waypts.push({
                  location: {lat: parseFloat(latitude), lng: parseFloat(longtitude) }, 
                  stopover: true, 
                });
             // } 
            } 

          }

          //alert(waypts);

          
         //google.maps.event.addDomListener(window, 'load', init);

         directionsService = new google.maps.DirectionsService();

         
           var firstObj = stations[0];
           var lastObj = stations.slice(-1)[0];

          // alert(parseFloat(firstObj.lat));

            var pos = new google.maps.LatLng(41.218624, -73.748358);
            var myOptions = {
                zoom: 13,
                center: { lat: 12.92, lng: 79.13 },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

             map = new google.maps.Map(document.getElementById('map'), myOptions);
             directionsDisplay = new google.maps.DirectionsRenderer({map: map, suppressMarkers: true});

             const centerControlDiv = document.createElement("div");
             CenterControl(centerControlDiv, map);
             map.controls[google.maps.ControlPosition.TOP_RIGHT].push(centerControlDiv)


            directionsService.route({
                origin: {lat: parseFloat(firstObj.lat), lng: parseFloat(firstObj.lng)},//document.getElementById("start").value,
                destination: {lat: parseFloat(lastObj.lat), lng: parseFloat(lastObj.lng)},//document.getElementById("end").value,
                waypoints: waypts,  
                //optimizeWaypoints: optimizes,
                travelMode: google.maps.TravelMode.DRIVING
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                var my_route = response.routes[0];

             // alert(JSON.stringify(my_route));

                   // var summaryPanel = document.getElementById("directions_panel");
                    //summaryPanel.innerHTML = "";


                    // Create info window
                    var infowindow = new google.maps.InfoWindow({
                        maxWidth: 500,
                        pixelOffset: new google.maps.Size(-10,-25)
                    });

                    var infoFn = function (stations) {
                        //alert(stations.name);
                        return function (e) {

                            

                            if(stations.checkin_time == null && stations.checkout_time == null)
                            {
                                var content = '<div>' +
                                '<h5 style="color:#3eb9de;"><b>Address: ' + stations.name + '</b></h5>' +
                                '<span> Check In: - </span><br>' +
                                '<span> Check Out: - </span>' +
                                // '<button type="Submit" id="check_id" onclick="check_in(' + stations.merchant_id + ')" class="btn btn-success" > Check In </button>' +
                                // '<button type="Submit" id="check_out" onclick="check_out(' + stations.merchant_id + ')" class="btn btn-danger" > Check Out </button>' +
                                '</div>';
                            }

                            if(stations.checkin_time !== null && stations.checkout_time == null)
                            {

                                var cin_time = tConv12(stations.checkin_time);

                                var content = '<div>' +
                                '<h5 style="color:#3eb9de;"><b>Address: ' + stations.name + '</b></h5>' +
                                 '<span> Check In: ' + cin_time + '</span><br>' +
                                 '<span> Check Out: - </span>' +
                              
                                '</div>';
                            }

                            if(stations.checkin_time !== null && stations.checkout_time !== null)
                            {

                                var cin_time = tConv12(stations.checkin_time);
                                var cout_time = tConv12(stations.checkout_time);

                                var content = '<div>' +
                                '<h5 style="color:#3eb9de;"><b>Address: ' + stations.name + '</b></h5>' +
                                 '<span> Check In: ' + cin_time + '</span><br>' +
                                 '<span> Check Out: ' + cout_time + '</span>' +
                                
                                '</div>';
                            }

                            infowindow.setContent(content);
                            infowindow.open(map);
                            infowindow.setPosition(new google.maps.LatLng(stations.lat, stations.lng));
                        }
                    };


                    for (var i = 0; i < my_route.legs.length; i++) {

                        //alert(stations[i].checkout_time);

                        var marker = new google.maps.Marker({
                            position: my_route.legs[i].start_location,
                            label: ""+(i+1),
                            map: map,
                            title: stations[i].name,
                        });

                        marker.setMap(map);

                        let fn = infoFn(stations[i]);
                        google.maps.event.addListener(marker, 'click', fn);

                    }
                        var marker = new google.maps.Marker({
                            position: my_route.legs[i-1].end_location,
                            label: ""+(i+1),
                            map: map,
                            title: lastObj.name,
                        });

                        marker.setMap(map);

                        let fn = infoFn(stations[i]);
                        google.maps.event.addListener(marker, 'click', fn);

                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });

        }


function tConv12(time12) {
  var ts = time12;
  var H = +ts.substr(0, 2);
  var h = (H % 12) || 12;
  h = (h < 10)?("0"+h):h;  // leading 0 at the left for 1 digit hours
  var ampm = H < 12 ? " AM" : " PM";
  ts = h + ts.substr(2, 3) + ampm;
  return ts;
};


function optimize()
{
  
  //alert(stations);
  var optimizes = true;
  //google_maps(stations,optimizes)


  var date = $("#get_by_date").val();
  //alert(date);

  if(date !==""){
    //alert();
    get_by_date(date,optimizes)
  }
  if(date ==""){

    var json = [];


    $.each(stations, function (i, val) {

      //alert(data[i]['outlet']['outlet_name'])
      //alert(data[i]['employee']['first_name'])
         if(stations[i]['checkin_time'] !=="" && stations[i]['checkout_time'] !=="" )
          {
            json.push({lat : stations[i]['outlet']['outlet_lat'], lng : stations[i]['outlet']['outlet_long'], name: stations[i]['store_name'], merchant_id: stations[i]['id'], checkin_time: stations[i]['checkin_time'], checkout_time: stations[i]['checkout_time'] });
          }

          if(stations[i]['checkin_time'] =="" && stations[i]['checkout_time'] =="" )
          {
             json.push({lat : stations[i]['outlet']['outlet_lat'], lng : stations[i]['outlet']['outlet_long'], name: stations[i]['store_name'], merchant_id: stations[i]['id'], checkin_time: null, checkout_time: null });
          }

     });

    // alert(JSON.stringify(json));

    function calculateDistance(lat1, lon1, lat2, lon2, unit) {
      var radlat1 = Math.PI * lat1/180
      var radlat2 = Math.PI * lat2/180
      var radlon1 = Math.PI * lon1/180
      var radlon2 = Math.PI * lon2/180
      var theta = lon1-lon2
      var radtheta = Math.PI * theta/180
      var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
      dist = Math.acos(dist)
      dist = dist * 180/Math.PI
      dist = dist * 60 * 1.1515
      if (unit=="K") { dist = dist * 1.609344 }
      if (unit=="N") { dist = dist * 0.8684 }
      return dist
    }

    for ( i = 0; i < json.length; i++) {
      json[i]["distance"] = calculateDistance(json[0]["lat"],json[0]["lng"],json[i]["lat"],json[i]["lng"],"K");
    }

    json.sort(function(a, b) { 
      return a.distance - b.distance;
    });

    console.log(json)

    google_maps(json)
  }

}

function check_in(id)
{
    //alert(id);

    window.location.href = '/outlet_details/'+id+' ';

// if (navigator.geolocation) {
//     //alert();
//     navigator.geolocation.getCurrentPosition(function(position, html5Error){
//        // alert();
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

//                     ale

//                     if (status == google.maps.GeocoderStatus.OK) {
//                         $("#address").html(results[0].formatted_address);


//                         window.location.href = '/outlet_details/'+id+' ';

//                           // $.ajax({
//                           //     url: '/outlet_check_in',
//                           //     type: 'POST',
//                           //     data: {id : id, lat : position.coords.latitude, lng : position.coords.longitude, _token: csrf, address : results[0].formatted_address},
//                           //     dataType: 'json',

//                           //     success: function( data ) {
//                           //       // alert(data);

//                           //         window.location.href = '/outlet_details/'+id+' ';


//                           //     }       
//                           // })


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

if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(position, html5Error){

        geo_loc = processGeolocationResult(position);
        currLatLong = geo_loc.split(",");
       // initializeCurrent(currLatLong[0], currLatLong[1]);

        currgeocoder = new google.maps.Geocoder();
        // console.log(latcurr + "-- ######## --" + longcurr);

         if (currLatLong[0] != '' && currLatLong[1] != '') {
             var myLatlng = new google.maps.LatLng(currLatLong[0], currLatLong[1]);
             console.log(myLatlng);
            // return getCurrentAddress(myLatlng);

              currgeocoder.geocode({
              'location': myLatlng

                }, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        $("#address").html(results[0].formatted_address);


                          $.ajax({
                              url: '/outlet_check_out',
                              type: 'POST',
                              data: {id : id, lat : position.coords.latitude, lng : position.coords.longitude, _token: csrf, address : results[0].formatted_address},
                              dataType: 'json',

                              success: function( data ) {
                                 //alert(data);

                                 // alert(JSON.stringify(data[0]['id']));


                              }       
                          })


                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }

                });

            }

    });

  } 

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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Journey Plan')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/journey_plan/index.blade.php ENDPATH**/ ?>