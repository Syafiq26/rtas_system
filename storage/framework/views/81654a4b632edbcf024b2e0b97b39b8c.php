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
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
    
    .navbar {
      background-color: #343a40;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .main-content {
      padding: 25px;
    }

    .table-container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
      padding: 20px;
      margin-top: 20px;
    }

    .table {
      margin-bottom: 0;
    }

    .table thead th {
      background-color: #f8f9fa;
      border-bottom: 2px solid #dee2e6;
      color: #495057;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.9rem;
    }

    .table td, .table th {
      vertical-align: middle;
      padding: 12px;
    }

    .form-control {
      border: 1px solid #e0e0e0;
      border-radius: 4px;
      font-size: 0.9rem;
      background-color: #f8f9fa;
    }

    .form-control:read-only {
      background-color: #f8f9fa;
      border-color: #e9ecef;
    }

    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
      padding: 8px 20px;
      font-weight: 500;
      margin-bottom: 20px;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0a58ca;
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-info, .btn-warning {
      padding: 4px 12px;
      font-size: 0.875rem;
      margin: 0 2px;
      transition: all 0.2s;
    }

    .btn-info:hover, .btn-warning:hover {
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .alert {
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .alert-success {
      background-color: #d1e7dd;
      border-color: #badbcc;
      color: #0f5132;
    }

    h2 {
      color: #344767;
      font-weight: 600;
      margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 15px;
      }
      
      .table-container {
        padding: 10px;
      }
      
      .btn {
        padding: 6px 12px;
      }
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
      <div class="d-flex justify-content-between align-items-center">
        <h2>ASSIGN STAFF</h2>
        <a href="<?php echo e(route('staff.add')); ?>" class="btn btn-primary">Add New</a>
      </div>
      
      <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <div class="table-container">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Staff Id</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <th scope="row"><?php echo e($key + 1); ?></th>
                <td>
                    <input type="text" class="form-control" value="<?php echo e($staff->login_id); ?>" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" value="<?php echo e($staff->name); ?>" readonly>
                </td>
                <td>
                    <a href="<?php echo e(route('staff.view', $staff->id)); ?>" class="btn btn-info btn-sm">View</a>
                    <a href="<?php echo e(route('staff.edit', $staff->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('staff.destroy', $staff->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this staff?')">Delete</button>
                    </form>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>
</div>


  
</body>
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/admin/assignStaff.blade.php ENDPATH**/ ?>