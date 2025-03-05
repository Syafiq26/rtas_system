<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTAS</title>
  

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
  <style>
    /* Adjust styles as needed */
    body {
      font-family: Arial, sans-serif;
    }
    .navbar {
      background-color: #343a40; /* Dark color for the top navbar */
    }
    .navbar-brand {
      color: #fff; /* White color for the brand/logo */
    }
    .navbar-nav .nav-link {
      color: #fff; /* White color for the navbar links */
    }
    .main-content {
      padding: 20px;
    }

    .form-container {
      background-color: #f8f9fa; /* Light grey */
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px; /* Optional: for rounded corners */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: for subtle shadow */
    }

  </style>
</head>
<body>

<!-- Top Navbar -->
<?php echo $__env->make('applicant.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php echo $__env->make('applicant.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <div class="form-container">
        <h2>Personal Details</h2>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo e(route('personal.store')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <!-- Add hidden input for personal_id -->
          <input type="hidden" name="personal_id" value="<?php echo e($personal->id ?? ''); ?>">
          
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $personal->name ?? '')); ?>">
            </div>
            <label for="ic" class="col-sm-2 col-form-label">I/C No</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="ic" name="ic" value="<?php echo e(old('ic', $personal->icNum ?? '')); ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="icFile" class="col-sm-2 col-form-label">Copy of Your I/C</label>
            <div class="col-sm-4">
            <input class="form-control" type="file" id="icFile" name="icFile">         
          </div> 
          </div>
          <div class="form-group row">
            <label for="citizen" class="col-sm-2 col-form-label">Citizenship</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="citizen" name="citizen" value="<?php echo e(old('citizen', $personal->citizen ?? '')); ?>">
            </div>
            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-4">
              <select class="form-control" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-4">
              <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e(old('dob', $personal->dob ?? '')); ?>">
            </div>
            <label for="pob" class="col-sm-2 col-form-label">Place of Birth</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="pob" name="pob" value="<?php echo e(old('pob', $personal->pob ?? '')); ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">Address Line 1</label>
            <div class="col-sm-4">
              <input type="longtext" class="form-control" id="address" name="address" value="<?php echo e(old('address', $personal->address ?? '')); ?>">
            </div>
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-4">
              <input type="longtext" class="form-control" id="city" name="city" value="<?php echo e(old('city', $personal->city ?? '')); ?>">
            </div>
          </div>

            <div class="form-group row">
              <label for="address2" class="col-sm-2 col-form-label">Address Line 2</label>
            <div class="col-sm-4">
              <input type="longtext" class="form-control" id="address2" name="address2" value="<?php echo e(old('address2', $personal->address2 ?? '')); ?>">
            </div>
              <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo e(old('postcode', $personal->postcode ?? '')); ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="state" class="col-sm-2 col-form-label">State</label>
              <div class="col-sm-4">
                <select class="form-control" id="state" name="state">
                  <option value="perak">Perak</option>
                  <option value="melaka">Melaka</option>
                  <option value="selangor">Selangor</option>
                  <option value="kedah">Kedah</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="email" name="email" value="<?php echo e(old('email', $personal->email ?? '')); ?>">
              </div>
              <label for="phone" class="col-sm-2 col-form-label">Phone No</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone', $personal->phoneNum ?? '')); ?>">
              </div>
            </div>

          <!-- Additional fields can be added here -->

          <!-- Buttons -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-2" name="submit">Save & Next</button>
            <button type="reset" class="btn btn-secondary" name="reset">Reset</button>
          </div>
        </form>
      </div>
        
      </div>
    </main>
  </div>
</div>

<?php if(session('success')): ?>
<script>
    Swal.fire({
        title: 'Success!',
        text: '<?php echo e(session('success')); ?>',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?php echo e(route('academic.form')); ?>';
        }
    });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
    Swal.fire({
        title: 'Error!',
        text: '<?php echo e(session('error')); ?>',
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
<?php endif; ?>
    
</body>
</html><?php /**PATH C:\laragon\www\rtas_system\resources\views/applicant/personalForm.blade.php ENDPATH**/ ?>