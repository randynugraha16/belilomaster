

<?php $__env->startSection('title'); ?>
    Edit User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div
            data-aos="fade-up"
            class="section-content section-dashboard-home"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">User</h2>
                <p class="dashboard-subtitle">Tax Center Marketplace</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-12">
                      <?php if($errors->any()): ?>
                          <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                          </div>
                      <?php endif; ?>
                    <div class="card">
                      <div class="card-body">
                        <form action="<?php echo e(route('user.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
                          <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Nama User</label>
                                      <input type="text" name="name" class="form-control" required value="<?php echo e($item->name); ?>">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Email</label>
                                      <input type="email" name="email" class="form-control" required value="<?php echo e($item->email); ?>">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" name="password" class="form-control">
                                      <small>kosongkan jika tidak ingin mengganti password</small>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Roles</label>
                                      <select name="roles" class="form-control" required>
                                        <option value="<?php echo e($item->roles); ?>" selected>Tidak diganti</option>
                                        <option value="ADMIN">Admin</option>
                                        <option value="USER">User</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">Save Now</button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bwastore-laravel\resources\views/pages/admin/user/edit.blade.php ENDPATH**/ ?>