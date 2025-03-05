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
<?php echo $__env->make("admin.navbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
   <?php echo $__env->make("admin.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="main-content">
      <h2>RECOMMENDED CANDIDATE RESULTS</h2>
      <form method="post" action=" ">
        <div class="table-responsive">
          <!-- Table -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">I/C No</th>
                <th scope="col">Name</th>
                <th scope="col">Average Score (/30)</th>  <!-- Updated column header -->
                <th scope="col">Interviewers</th>  <!-- Added column -->
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <th scope="row"><?php echo e($index + 1); ?></th>
                <td>
                    <input type="text" class="form-control" value="<?php echo e($candidate['ic']); ?>" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" value="<?php echo e($candidate['name']); ?>" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" value="<?php echo e($candidate['score']); ?>" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" value="<?php echo e($candidate['interviewer_count']); ?>/3" readonly>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.viewIVMark', $candidate['ic'])); ?>" class="btn btn-secondary btn-sm">View</a>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>

        <!-- Buttons -->
        
      </form>
    </div>
  </main>
</div>
</div>
    
</body>
</html><?php /**PATH C:\laragon\www\rtas_system\resources\views/admin/interviewerMark.blade.php ENDPATH**/ ?>