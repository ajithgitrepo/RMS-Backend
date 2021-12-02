<?php echo $__env->make('layouts.navbars.navs.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="wrapper wrapper-full-page">
    <div class="page-header <?php echo e($classPage); ?> header-filter" filter-color="black" style="background-image: url('<?php echo e($pageBackground); ?>'); background-size: cover; background-position: top center;align-items: center;">
  <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('layouts.footers.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</div>
<?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/layouts/page_templates/guest.blade.php ENDPATH**/ ?>