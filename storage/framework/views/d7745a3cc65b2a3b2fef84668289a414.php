<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Form</title>
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
<?php echo $__env->make('applicant.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php echo $__env->make('applicant.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <h2>Academic Details</h2>
        <div class="form-container">
          <form method="POST" action="<?php echo e(route('academic.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group row">
              <label for="major" class="col-sm-2 col-form-label">Major/Stream</label>
              <div class="col-sm-4">
                <select class="form-control" id="major" name="major">
                  <option value="">--Choose one--</option>
                  <option value="tulen" <?php echo e(old('major', $academic->major ?? '') == 'pure' ? 'selected' : ''); ?>>Pure Science</option>
                  <option value="agama" <?php echo e(old('major', $academic->major ?? '') == 'religious' ? 'selected' : ''); ?>>Religious Science</option>
                  <option value="agama" <?php echo e(old('major', $academic->major ?? '') == 'mix' ? 'selected' : ''); ?>>Mix Stream</option>
                </select>
              </div>
              <label for="schoolName" class="col-sm-2 col-form-label">School Name:</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="schoolName" name="schoolName" value="<?php echo e(old('schoolName', $academic->schoolName ?? '')); ?>">
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <!-- Table -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Grade</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $subjects = ['Bahasa Melayu', 'Sejarah', 'English', 'Mathematic', 'Physic', 'Chemistry', 'Biology'];
                  $grades = json_decode($academic->subjectGrade ?? '[]', true);
                ?>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th scope="row"><?php echo e($index + 1); ?></th>
                  <td>
                    <input type="text" class="form-control" name="subject[]" value="<?php echo e($subject); ?>" readonly>
                  </td>
                  <td>
                    <select class="form-control" name="grade[]">
                      <option value="">--Select the Grade</option>
                      <?php $__currentLoopData = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'E', 'F']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($grade); ?>" <?php echo e(old('grade.' . $index, $grades[$index] ?? '') == $grade ? 'selected' : ''); ?>><?php echo e($grade); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>

            <div class="row mb-3">
              <label for="spmCert" class="col-sm-2 col-form-label">Certified True Copy of Your SPM *</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="spmCert" name="spmCert">
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save & Next</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <a href="<?php echo e(route('personal.form')); ?>" class="btn btn-danger">Back</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

</body>
</html><?php /**PATH C:\laragon\www\rtas_system\resources\views/applicant/academicForm.blade.php ENDPATH**/ ?>