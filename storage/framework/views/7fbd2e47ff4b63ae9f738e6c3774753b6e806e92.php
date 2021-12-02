<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
      <div class="col-md-9 ml-auto mr-auto mb-1 text-center">
        <h3><?php echo e(__('Welcome to Rhapsody Merchandising Solution')); ?> </h3>
<!-- 
        <p class="text-lead text-light mt-3 mb-0">
            <?php echo e(__('Log in and see how you can save more than 150 hours of work with CRUDs for managing: #users, #roles, #items, #categories, #tags and more.')); ?>

        </p> -->
      </div>
      <!-- <div class="col-lg-5 col-md-8 col-sm-10 ml-auto mr-auto mb-3 text-center">
          <h5 class="text-lead text-white mt-2 mb-0">
              <strong><?php echo e(__('You can log in with 3 user types:')); ?></strong>
          </h5>
          <ol class="text-lead text-light mt-3 mb-3">
              <li><?php echo __('Username <b>admin@material.com</b> Password <b>secret</b>'); ?></li>
              <li><?php echo __('Username <b>creator@material.com</b> Password <b>secret</b>'); ?></li>
              <li><?php echo __('Username <b>member@material.com</b> Password <b>secret</b>'); ?></li>
          </ol>
      </div> -->
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" method="POST" action="<?php echo e(route('login')); ?>">
          <?php echo csrf_field(); ?>

          <div class="card card-login card-hidden">
            <div class="card-header card-header-rose text-center">
              <h4 class="card-title"><?php echo e(__('Login')); ?></h4>
            <!--   <div class="social-line">
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-google-plus"></i>
                </a>
              </div> -->
            </div>
            <div class="card-body ">
              <span class="form-group  bmd-form-group email-error <?php echo e($errors->has('email') ? ' has-danger' : ''); ?>" >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">email</i>
                    </span>
                  </div>
                  <input type="email" class="form-control" id="exampleEmails" name="email" placeholder="<?php echo e(__('Email...')); ?>" value="<?php echo e(old('email', 'admin@material.com')); ?>" required>
                  <?php echo $__env->make('alerts.feedback', ['field' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </span>
              <span class="form-group bmd-form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" id="examplePassword" name="password" placeholder="<?php echo e(__('Password...')); ?>" value="secret" required>
                  <?php echo $__env->make('alerts.feedback', ['field' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </span>
              <div class="form-check mr-auto ml-3 mt-3">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo e(__('Remember me')); ?>

                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
            </div>
            <div class="card-footer justify-content-center">
              <button type="submit" class="btn btn-rose btn-link btn-lg"><?php echo e(__('Lets Go')); ?></button>
            </div>
          </div>
        </form>
        <div class="row">
<!--           <div class="col-6">
              <?php if(Route::has('password.request')): ?>
                  <a href="<?php echo e(route('password.request')); ?>" class="text-light">
                      <small><?php echo e(__('Forgot password?')); ?></small>
                  </a>
              <?php endif; ?>
          </div> -->
          <!-- <div class="col-6 text-right">
              <a href="<?php echo e(route('register')); ?>" class="text-light">
                  <small><?php echo e(__('Create new account')); ?></small>
              </a>
          </div> -->
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
  $(document).ready(function() {
    md.checkFullPageBackgroundImage();
    setTimeout(function() {
      // after 1000 ms we add the class animated to the login/register card
      $('.card').removeClass('card-hidden');
    }, 700);
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', [
  'class' => 'off-canvas-sidebar',
  'classPage' => 'login-page',
  'activePage' => 'login',
  'title' => __('Material Dashboard'),
  'pageBackground' => asset("material").'/img/login.jpg'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/auth/login.blade.php ENDPATH**/ ?>