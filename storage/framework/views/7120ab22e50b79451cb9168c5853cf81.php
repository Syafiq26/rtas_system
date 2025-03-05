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
        <h2>INTERVIEWER MARKS DETAILS</h2>
        <div class="form-container">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">I/C Number</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="<?php echo e($candidate->applicant_id); ?>" readonly>
            </div>
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="<?php echo e($candidate->personal->name ?? 'N/A'); ?>" readonly>
            </div>
          </div>

          <div class="table-responsive mt-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Interviewer</th>
                  <th>Marks (/5)</th>
                  <th>Comments</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $questionsByInterviewer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interviewer_id => $questions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(ucfirst(str_replace('_', ' ', $question->category))); ?></td>
                    <td><?php echo e($question->interviewer_name); ?></td>
                    <td><?php echo e($question->marks); ?></td>
                    <td><?php echo e($question->comment); ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <tr class="table-info">
                    <td><strong>Interviewer Total</strong></td>
                    <td></td>
                    <td><strong><?php echo e($questions->sum('marks')); ?>/30</strong></td>
                    <td></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="table-success">
                  <td colspan="2"><strong>Final Average Score</strong></td>
                  <td colspan="2"><strong><?php echo e($totalScore); ?>/30</strong></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-end mt-3">
            <a href="<?php echo e(route('admin.interviewerMark')); ?>" class="btn btn-danger">Back</a>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/admin/viewIVMark.blade.php ENDPATH**/ ?>