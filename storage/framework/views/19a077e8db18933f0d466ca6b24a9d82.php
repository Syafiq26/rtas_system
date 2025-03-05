<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTAS</title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      background-color: #343a40;
    }

    .main-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .form-control {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 8px;
      margin-bottom: 10px;
    }

    .form-control:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn {
      padding: 8px 20px;
      margin-left: 10px;
    }

    .table {
      margin-bottom: 20px;
    }

    .table thead th {
      background-color: #343a40;
      color: white;
      border: none;
      padding: 12px;
    }

    .table tbody td {
      vertical-align: middle;
      padding: 12px;
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }

    .remove-row {
      padding: 5px 10px;
      margin: 0;
    }

    /* Alert styling */
    .alert {
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 4px;
    }

    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }

    /* Responsive table */
    @media screen and (max-width: 768px) {
      .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
    }

    /* Animation */
    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #555;
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
        <h2>Details of Siblings</h2>
        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('siblings.store')); ?>">
          <?php echo csrf_field(); ?>
          <div class="table-responsive">
            <!-- Table -->
            <table class="table table-striped" id="siblings-table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Age</th>
                  <th scope="col">Date of Birth</th>
                  <th scope="col">Occupation</th>
                  <th scope="col">Employer/Institution</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($siblings) && $siblings->count() > 0): ?>
                    <?php $__currentLoopData = $siblings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sibling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-id="<?php echo e($sibling->id); ?>">
                            <td data-label="No"><?php echo e($index + 1); ?></td>
                            <td data-label="Name"><input type="text" class="form-control" name="name[]" value="<?php echo e($sibling->siblingName); ?>" required></td>
                            <td data-label="Age"><input type="number" class="form-control" name="age[]" value="<?php echo e($sibling->siblingAge); ?>" required></td>
                            <td data-label="Date of Birth"><input type="date" class="form-control" name="dob[]" value="<?php echo e($sibling->siblingDOB); ?>" required></td>
                            <td data-label="Occupation"><input type="text" class="form-control" name="occupation[]" value="<?php echo e($sibling->occupation); ?>" required></td>
                            <td data-label="Employer/Institution"><input type="text" class="form-control" name="emp_institude[]" value="<?php echo e($sibling->emp_ins); ?>" required></td>
                            <td data-label="Action">
                                <button type="button" class="btn btn-danger btn-sm remove-row" data-id="<?php echo e($sibling->id); ?>">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td data-label="No">1</td>
                        <td data-label="Name"><input type="text" class="form-control" name="name[]" ></td>
                        <td data-label="Age"><input type="number" class="form-control" name="age[]" ></td>
                        <td data-label="Date of Birth"><input type="date" class="form-control" name="dob[]" ></td>
                        <td data-label="Occupation"><input type="text" class="form-control" name="occupation[]" ></td>
                        <td data-label="Employer/Institution"><input type="text" class="form-control" name="emp_institude[]" ></td>
                        <td data-label="Action"><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                    </tr>
                <?php endif; ?>
              </tbody>
            </table>
            
            <div class="mt-3">
                <button type="button" class="btn btn-success mb-3" id="add-sibling">Add Sibling</button>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary mr-2">Save & Next</button>
                <a href="<?php echo e(route('parent.form')); ?>" class="btn btn-danger">Back</a>
            </div>
          </div>
          
        </form>
      </div>
    </main>
  </div>
</div>

<script>
$(document).ready(function() {
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add sibling row
    $('#add-sibling').click(function() {
        var rowCount = $('#siblings-table tbody tr').length + 1;
        var newRow = `
            <tr>
                <td>${rowCount}</td>
                <td><input type="text" class="form-control" name="name[]" required></td>
                <td><input type="number" class="form-control" name="age[]" required></td>
                <td><input type="date" class="form-control" name="dob[]" required></td>
                <td><input type="text" class="form-control" name="occupation[]" required></td>
                <td><input type="text" class="form-control" name="emp_institude[]" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
            </tr>
        `;
        $('#siblings-table tbody').append(newRow);
    });

    // Remove sibling row
    $(document).on('click', '.remove-row', function() {
        var button = $(this);
        var row = button.closest('tr');
        var id = button.data('id');

        if (id) {
            // Existing record - delete from database
            if (confirm('Are you sure you want to delete this sibling?')) {
                $.ajax({
                    url: "<?php echo e(url('/siblings')); ?>/" + id,  // Update this line
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        row.remove();
                        renumberRows();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);  // Add this for debugging
                        alert('Error deleting record: ' + (xhr.responseJSON ? xhr.responseJSON.error : 'Unknown error'));
                    }
                });
            }
        } else {
            // New row - just remove from DOM
            row.remove();
            renumberRows();
        }
    });

    // Helper function to renumber rows
    function renumberRows() {
        $('#siblings-table tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }
});
</script>

</body>
</html><?php /**PATH C:\laragon\www\rtas_system\resources\views/applicant/siblingsForm.blade.php ENDPATH**/ ?>