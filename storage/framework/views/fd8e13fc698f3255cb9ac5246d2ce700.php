<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTAS</title>
  

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<?php echo $__env->make('admin.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <h2>QUESTION</h2>
        <div class="form-container">
        <form method="post" action="<?php echo e(route('kiv.update', $candidate->id)); ?>" class="form-container">
          <?php echo csrf_field(); ?>
          <div class="form-group row">
            <label for="ic" class="col-sm-2 col-form-label">IC Number</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="ic" name="ic" value="<?php echo e($candidate->applicant_id); ?>" readonly>
            </div>
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="name" name="name" value="<?php echo e($personal->name ?? 'N/A'); ?>" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="remark" name="remark" value="<?php echo e($candidate->remark ?? ''); ?>">
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" name="action" value="approve" class="btn btn-success mr-2">Approve</button>
            <a href="<?php echo e(route('kiv.index')); ?>" class="btn btn-danger">Back</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/admin/editApplicant.blade.php ENDPATH**/ ?>