<?php $__env->startSection('content'); ?>
  <div class="container text-center">
    <div class="row">
      <div class="col-md-12">
        <h1 class="title">401</h1>
        <h2><?php echo e(__('Unauthenticated')); ?></h2>
        <h4><?php echo e(__('Ooooups! Looks like you got lost.')); ?></h4>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors.layout', ['classPage' => 'error-page', 'activePage' => '401', 'title' => __('Material Dashboard'), 'pageBackground' => asset("material").'/img/clint-mckoy.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/errors/401.blade.php ENDPATH**/ ?>