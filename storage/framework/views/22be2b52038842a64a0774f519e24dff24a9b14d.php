<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="<?php echo e(route('home')); ?>"><?php echo e($title); ?></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="<?php echo e(route('home')); ?>" class="nav-link">
            <i class="material-icons">dashboard</i> <?php echo e(__('Dashboard')); ?>

          </a>
        </li>
       <!--  <li class="nav-item<?php echo e($activePage == 'pricing' ? ' active' : ''); ?> ">
            <a href="<?php echo e(route('page.pricing')); ?>" class="nav-link">
              <i class="material-icons">shopping_basket</i> <?php echo e(__('Pricing')); ?>

            </a>
          </li> -->
       <!--  <li class="nav-item<?php echo e($activePage == 'register' ? ' active' : ''); ?>">
          <a href="<?php echo e(route('register')); ?>" class="nav-link">
            <i class="material-icons">person_add</i> <?php echo e(__('Register')); ?>

          </a>
        </li> -->
        <li class="nav-item<?php echo e($activePage == 'login' ? ' active' : ''); ?>">
          <a href="<?php echo e(route('login')); ?>" class="nav-link">
            <i class="material-icons">fingerprint</i> <?php echo e(__('Login')); ?>

          </a>
        </li>
       <!--  <li class="nav-item<?php echo e($activePage == 'lock' ? ' active' : ''); ?> ">
          <a href="<?php echo e(route('page.lock')); ?>" class="nav-link">
            <i class="material-icons">lock_open</i> <?php echo e(__('Lock')); ?>

          </a>
        </li> -->
        <?php if(auth()->guard()->check()): ?>
          <li class="nav-item">
              <a href="<?php echo e(route('logout')); ?>" class="nav-link" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                  <i class="material-icons">directions_run</i>
                  <span><?php echo e(__('Logout')); ?></span>
              </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/layouts/navbars/navs/guest.blade.php ENDPATH**/ ?>