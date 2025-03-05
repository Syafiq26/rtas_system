<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Staff - RTAS</title>

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
    .section {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<!-- Top Navbar -->
<?php echo $__env->make("admin.navbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
   <?php echo $__env->make("admin.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <h2>Staff Details</h2>
        <div class="section">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Staff ID:</strong> <?php echo e($staff->login_id); ?></p>
              <p><strong>Name:</strong> <?php echo e($staff->name); ?></p>
              <p><strong>Role:</strong> 
                <?php if($staff->role == 1): ?>
                  Admin
                <?php elseif($staff->role == 2): ?>
                  Interviewer
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
        <div>
          <a href="<?php echo e(route('staff.assign')); ?>" class="btn btn-secondary">Back</a>
        </div>
      </div>
    </main>
  </div>
</div>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/admin/viewStaff.blade.php ENDPATH**/ ?>