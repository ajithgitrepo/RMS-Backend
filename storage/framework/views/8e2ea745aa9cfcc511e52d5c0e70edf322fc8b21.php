
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('material')); ?>/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo e(asset('material')); ?>/img/rms-fevi-icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Rhapsody Merchandising Solution
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->

   <link href="<?php echo e(asset('material')); ?>/css/meterial-icon.css" rel="stylesheet" />
   
   <link href="<?php echo e(asset('material')); ?>/css/flag-icon.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo e(asset('material')); ?>/css/material-dashboard.css?v=2.1.3" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo e(asset('material')); ?>/demo/demo.css" rel="stylesheet" />
  
  <link href="<?php echo e(asset('material')); ?>/dist/imageuploadify.min.css" rel="stylesheet">

   <link href="<?php echo e(asset('material')); ?>/dist/monthly_chart/bar.chart.min.css" rel="stylesheet">

  <!--  <link href="<?php echo e(asset('material')); ?>/dist/pie_chart/components.min.css" rel="stylesheet">
 -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
 -->
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

     <link href="https://cdn.datatables.net/rowgroup/1.0.2/css/rowGroup.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

 <style>

    table.dataTable thead .sorting, 
    table.dataTable thead .sorting_asc, 
    table.dataTable thead .sorting_desc {
        background : none;
    }

input.parsley-success,
select.parsley-success,
textarea.parsley-success {
  color: #468847;
  background-color: #DFF0D8;
  border: 1px solid #D6E9C6;
}

input.parsley-error,
select.parsley-error,
textarea.parsley-error {
  color: #B94A48;
  /*background-color: #F2DEDE;*/
  /*border: 1px solid #EED3D7;*/
}

.parsley-errors-list {
  margin: 5px 0 5px;
  padding: 0;
  list-style-type: none;
  font-size: 0.9em;
  line-height: 0.9em;
  opacity: 0;
  color: #B94A48;

  transition: all .3s ease-in;
  -o-transition: all .3s ease-in;
  -moz-transition: all .3s ease-in;
  -webkit-transition: all .3s ease-in;
}

.parsley-errors-list.filled {
  opacity: 1;
}

.kv-file-upload{
    color:#fff !important;
    visibility: hidden !important;
}

.bootstrap-select .btn.dropdown-toggle.select-with-transition {
    background-image: linear-gradient(to top, #ecb314 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #fffefe 1px, rgba(210, 210, 210, 0) 1px);
   
}

 </style>

</head>
<body class="<?php echo e($class ?? ''); ?>">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
        <?php if(auth()->check() && !in_array(request()->route()->getName(), ['welcome', 'page.pricing', 'page.lock', 'page.error'])): ?>
            <?php echo $__env->make('layouts.page_templates.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('layouts.page_templates.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!-- <?php if(auth()->check()): ?>
        <div class="fixed-plugin">
          <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
              <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
              <li class="header-title"> Sidebar Filters</li>
              <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                  <div class="badge-colors ml-auto mr-auto">
                    <span class="badge filter badge-purple" data-color="purple"></span>
                    <span class="badge filter badge-azure" data-color="azure"></span>
                    <span class="badge filter badge-green" data-color="green"></span>
                    <span class="badge filter badge-warning" data-color="orange"></span>
                    <span class="badge filter badge-danger" data-color="danger"></span>
                    <span class="badge filter badge-rose active" data-color="rose"></span>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="header-title">Sidebar Background</li>
              <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                  <div class="ml-auto mr-auto">
                    <span class="badge filter badge-black active" data-background-color="black"></span>
                    <span class="badge filter badge-white" data-background-color="white"></span>
                    <span class="badge filter badge-red" data-background-color="red"></span>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                  <p>Sidebar Mini</p>
                  <label class="ml-auto">
                    <div class="togglebutton switch-sidebar-mini">
                      <label>
                        <input type="checkbox">
                        <span class="toggle"></span>
                      </label>
                    </div>
                  </label>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                  <p>Sidebar Images</p>
                  <label class="switch-mini ml-auto">
                    <div class="togglebutton switch-sidebar-image">
                      <label>
                        <input type="checkbox" checked="">
                        <span class="toggle"></span>
                      </label>
                    </div>
                  </label>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="header-title">Images</li>
              <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="<?php echo e(asset('material')); ?>/img/sidebar-1.jpg" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="<?php echo e(asset('material')); ?>/img/sidebar-2.jpg" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="<?php echo e(asset('material')); ?>/img/sidebar-3.jpg" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="<?php echo e(asset('material')); ?>/img/sidebar-4.jpg" alt="">
                </a>
              </li>
              <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-pro-laravel" target="_blank" class="btn btn-rose btn-block btn-fill">Buy Now</a>
                <a href="https://material-dashboard-pro-laravel.creative-tim.com/docs/getting-started/laravel-setup.html" target="_blank" class="btn btn-default btn-block">
                  Documentation
                </a>
                <a href="https://www.creative-tim.com/product/material-dashboard-laravel" target="_blank" class="btn btn-info btn-block">
                  Get Free Demo!
                </a>
              </li>
              <li class="button-container github-star">
                <a class="github-button" style="display: inline;" href="https://github.com/creativetimofficial/ct-material-dashboard-pro-laravel" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
              </li>
              <li class="header-title">Thank you for 95 shares!</li>
              <li class="button-container text-center">
                <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
                <br>
                <br>
              </li>
            </ul>
          </div>
        </div>
        <?php endif; ?> -->
        <!--   Core JS Files   -->
        <script src="<?php echo e(asset('material')); ?>/js/core/jquery.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/core/popper.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/core/bootstrap-material-design.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
       <!-- <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery.dataTables.min.js"></script>-->


         <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

          <script src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script>

           <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
     <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>


      <!--    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>

       <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      
       <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

       <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script> -->
       

        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
      
        <!--  <script src="https://maps.google.com/maps/api/js?key=AIzaSyCUNTZl1vh8BheJzaGuBOGhV8FtNr7vlik"></script> -->
        <!-- Chartist JS -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?php echo e(asset('material')); ?>/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="<?php echo e(asset('material')); ?>/demo/demo.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/application.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js"></script>
        <!-- <script src="<?php echo e(asset('material')); ?>/js/parsley/parsley.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/parsley/parsley.js"></script> -->
        <script src="<?php echo e(asset('material')); ?>/dist/imageuploadify.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/dist/monthly_chart/d3js.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/dist/monthly_chart/jquery.bar.chart.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/dist/pie_chart/echarts.min.js"></script>


         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

         <!-- dev URL -->
        <script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.templates.min.js"></script>
       
        <script>
          // $(document).ready(function () {
          //   <?php if(session('status')): ?>
          //     $.notify({
          //       icon: "done",
          //       message: "<?php echo e(session('status')); ?>"
          //     }, {
          //       type: 'success',
          //       timer: 3000,
          //       placement: {
          //         from: 'top',
          //         align: 'right'
          //       }
          //     });
          //   <?php endif; ?>
          // });

          $(document).ready(function () {
               <?php if(session('status')): ?>
                var str1 = "<?php echo e(session('status')); ?>";
                var str2 = "error";
                $type = "success";
                if(str1.indexOf(str2) != -1)
                {
                  $type = "danger";
                  var data = str1;
                  var arr = data.split('-');
                  str1 = arr[1];
                }
                notification($type, str1);
                <?php endif; ?>
            });

           function notification($type, $message)
              {  // alert($type );  alert($message );
                    $.notify({
                      icon: "done",
                      message: $message
                    }, {
                      type: $type,
                      timer: 3000,
                      placement: {
                        from: 'top',
                        align: 'right'
                      }
                    });
            }

        </script>
        <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/layouts/app.blade.php ENDPATH**/ ?>