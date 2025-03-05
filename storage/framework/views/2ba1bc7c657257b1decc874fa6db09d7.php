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
    /* Base styles */
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f5f7fa;
    }

    /* Layout */
    .main-content {
      padding: 30px;
      margin-top: 20px;
    }

    .form-container {
      background-color: #ffffff;
      padding: 25px;
      margin-bottom: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: box-shadow 0.3s ease;
    }

    .form-container:hover {
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Navigation */
    .navbar {
      background-color: #2c3e50;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-brand {
      color: #fff;
      font-weight: 600;
    }

    .navbar-nav .nav-link {
      color: #fff;
      opacity: 0.9;
      transition: opacity 0.2s;
    }

    .navbar-nav .nav-link:hover {
      opacity: 1;
    }

    /* Table styles */
    .table {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      border-radius: 8px;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .table thead th {
      background-color: #2c3e50;
      color: white;
      border: none;
      padding: 15px;
      font-weight: 500;
    }

    .table tbody td {
      vertical-align: middle;
      padding: 12px;
      border-bottom: 1px solid #eee;
    }

    /* Form elements */
    .form-control {
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 8px 12px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    input[type="file"] {
      padding: 6px;
      border: 1px dashed #ddd;
      background-color: #f8f9fa;
    }

    select.form-control {
      padding-right: 30px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M0 2l4 4 4-4z' fill='%23888'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 8px 8px;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }

    /* Buttons */
    .btn {
      padding: 8px 20px;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
    }

    .btn-primary {
      background-color: #3498db;
      border-color: #3498db;
    }

    .btn-primary:hover {
      background-color: #2980b9;
      border-color: #2980b9;
    }

    .btn-secondary {
      background-color: #95a5a6;
      border-color: #95a5a6;
    }

    .btn-danger {
      background-color: #e74c3c;
      border-color: #e74c3c;
    }

    .btn-info {
      background-color: #17a2b8;
      border-color: #17a2b8;
      color: white;
      font-size: 0.875rem;
      padding: 0.25rem 0.5rem;
    }

    .btn-success {
      background-color: #2ecc71;
      border-color: #2ecc71;
    }

    .btn-success:hover {
      background-color: #27ae60;
      border-color: #27ae60;
    }

    /* Input groups */
    .input-group {
      border-radius: 6px;
      overflow: hidden;
    }

    .input-group-append .btn {
      padding: 8px 12px;
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    /* Alerts */
    .alert {
      border-radius: 8px;
      padding: 15px 20px;
      margin-bottom: 20px;
    }

    .alert-danger {
      background-color: #fdf3f2;
      border-color: #f5c6cb;
      color: #721c24;
    }

    /* Modal */
    .document-modal {
      display: none;
      position: fixed;
      z-index: 1050;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.75);
      backdrop-filter: blur(5px);
    }

    .modal-content {
      position: relative;
      margin: 30px auto;
      padding: 25px;
      width: 90%;
      max-width: 1000px;
      height: 85vh;
      background: white;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .document-frame {
      width: 100%;
      height: calc(100% - 50px);
      border: none;
      border-radius: 8px;
    }

    /* Loading animation */
    .loading {
      position: relative;
      opacity: 0.6;
      pointer-events: none;
    }

    .loading::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 24px;
      height: 24px;
      margin: -12px 0 0 -12px;
      border: 2px solid #fff;
      border-top-color: #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    /* Animations */
    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        padding: 15px;
      }

      .form-container {
        padding: 15px;
      }

      .table-responsive {
        overflow-x: auto;
      }

      .btn {
        width: 100%;
        margin: 5px 0;
      }

      .modal-content {
        width: 95%;
        margin: 10px auto;
      }
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
        <h2>Co-Curiculum Information</h2>
        <form method="post" action="<?php echo e(route('cocuriculum.store')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <h5>Club/Association Involvement and Competition</h5>
          
          <div class="table-responsive">
            <table class="table table-striped" id="cocu-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Activity Name</th>
                  <th>Type</th>
                  <th>Level</th>
                  <th>Role</th>
                  <th>Certificate</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($cocuriculums && $cocuriculums->count() > 0): ?>
                  <?php $__currentLoopData = $cocuriculums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cocu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-id="<?php echo e($cocu->id); ?>">
                      <td><?php echo e($index + 1); ?></td>
                      <input type="hidden" name="cocu_id[]" value="<?php echo e($cocu->id); ?>">
                      <td><input type="text" class="form-control" name="cocuName[]" value="<?php echo e($cocu->cocuName); ?>" required></td>
                      <td>
                        <select class="form-control" name="cocuType[]" required>
                          <option value="">--Choose one--</option>
                          <option value="sports" <?php echo e($cocu->cocuType == 'sports' ? 'selected' : ''); ?>>Sports</option>
                          <option value="club" <?php echo e($cocu->cocuType == 'club' ? 'selected' : ''); ?>>Club/Society</option>
                          <option value="competition" <?php echo e($cocu->cocuType == 'competition' ? 'selected' : ''); ?>>Competition</option>
                        </select>
                      </td>
                      <td>
                        <select class="form-control" name="represent[]" required>
                          <option value="">--Choose one--</option>
                          <option value="international" <?php echo e($cocu->represent == 'international' ? 'selected' : ''); ?>>International</option>
                          <option value="country" <?php echo e($cocu->represent == 'country' ? 'selected' : ''); ?>>National</option>
                          <option value="state" <?php echo e($cocu->represent == 'state' ? 'selected' : ''); ?>>State</option>
                          <option value="district" <?php echo e($cocu->represent == 'district' ? 'selected' : ''); ?>>District</option>
                          <option value="school" <?php echo e($cocu->represent == 'school' ? 'selected' : ''); ?>>School</option>
                        </select>
                      </td>
                      <td>
                        <select class="form-control" name="role[]" required>
                          <option value="">--Choose one--</option>
                          <option value="president" <?php echo e($cocu->role == 'president' ? 'selected' : ''); ?>>President</option>
                          <option value="vice_president" <?php echo e($cocu->role == 'vice_president' ? 'selected' : ''); ?>>Vice President</option>
                          <option value="secretary" <?php echo e($cocu->role == 'secretary' ? 'selected' : ''); ?>>Secretary</option>
                          <option value="committee" <?php echo e($cocu->role == 'committee' ? 'selected' : ''); ?>>Committee</option>
                          <option value="member" <?php echo e($cocu->role == 'member' ? 'selected' : ''); ?>>Member</option>
                        </select>
                      </td>
                      <td>
                        <div class="input-group">
                          <input type="file" class="form-control" name="copyCertLocation[]">
                          <?php if($cocu->copyCertLocation): ?>
                            <div class="input-group-append">
                              <button type="button" class="btn btn-info view-document" 
                                      data-document="<?php echo e(asset('storage/' . $cocu->copyCertLocation)); ?>"
                                      data-title="Certificate for <?php echo e($cocu->cocuName); ?>">
                                <i class="fas fa-eye"></i>
                              </button>
                            </div>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td><button type="button" class="btn btn-danger btn-sm remove-row" data-id="<?php echo e($cocu->id); ?>">Remove</button></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td>1</td>
                    <input type="hidden" name="cocu_id[]" value="">
                    <td><input type="text" class="form-control" name="cocuName[]" required></td>
                    <td>
                      <select class="form-control" name="cocuType[]" required>
                        <option value="">--Choose one--</option>
                        <option value="sports">Sports</option>
                        <option value="club">Club/Society</option>
                        <option value="competition">Competition</option>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="represent[]" required>
                        <option value="">--Choose one--</option>
                        <option value="international">International</option>
                        <option value="country">National</option>
                        <option value="state">State</option>
                        <option value="district">District</option>
                        <option value="school">School</option>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="role[]" required>
                        <option value="">--Choose one--</option>
                        <option value="president">President</option>
                        <option value="vice_president">Vice President</option>
                        <option value="secretary">Secretary</option>
                        <option value="committee">Committee</option>
                        <option value="member">Member</option>
                      </select>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="file" class="form-control" name="copyCertLocation[]">
                      </div>
                    </td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>

            <button type="button" class="btn btn-success mb-3" id="add-activity">Add Activity</button>
          </div>

          <!-- Display validation errors -->
          <?php if($errors->any()): ?>
            <div class="alert alert-danger">
              <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          <?php endif; ?>

          <!-- Buttons -->
          <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary mr-2">Save & Next</button>
            <button type="reset" class="btn btn-secondary mr-2">Reset</button>
            <a href="<?php echo e(route('academic.form')); ?>" class="btn btn-danger">Back</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

<!-- Document Modal -->
<div id="documentModal" class="document-modal">
  <div class="modal-content">
    <span class="modal-close">&times;</span>
    <h4 id="documentTitle" class="mb-3"></h4>
    <iframe class="document-frame" id="documentFrame"></iframe>
  </div>
</div>
<script>
$(document).ready(function() {
    // Add new row
    $('#add-activity').click(function() {
        var rowCount = $('#cocu-table tbody tr').length + 1;
        var newRow = `<tr>
            <td>${rowCount}</td>
            <input type="hidden" name="cocu_id[]" value="">
            <td><input type="text" class="form-control" name="cocuName[]" required></td>
            <td>
              <select class="form-control" name="cocuType[]" required>
                <option value="">--Choose one--</option>
                <option value="sports">Sports</option>
                <option value="club">Club/Society</option>
                <option value="competition">Competition</option>
              </select>
            </td>
            <td>
              <select class="form-control" name="represent[]" required>
                <option value="">--Choose one--</option>
                <option value="international">International</option>
                <option value="country">National</option>
                <option value="state">State</option>
                <option value="district">District</option>
                <option value="school">School</option>
              </select>
            </td>
            <td>
              <select class="form-control" name="role[]" required>
                <option value="">--Choose one--</option>
                <option value="president">President</option>
                <option value="vice_president">Vice President</option>
                <option value="secretary">Secretary</option>
                <option value="committee">Committee</option>
                <option value="member">Member</option>
              </select>
            </td>
            <td>
              <div class="input-group">
                <input type="file" class="form-control" name="copyCertLocation[]">
              </div>
            </td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
        </tr>`;
        $('#cocu-table tbody').append(newRow);
    });

    // Remove row
    $(document).on('click', '.remove-row', function() {
        var button = $(this);
        var row = button.closest('tr');
        var id = button.data('id');

        if (id) {
            if (confirm('Are you sure you want to delete this activity?')) {
                $.ajax({
                    url: "<?php echo e(url('/cocuriculum')); ?>/" + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        row.remove();
                        renumberRows();
                    },
                    error: function(xhr) {
                        alert('Error deleting record');
                    }
                });
            }
        } else {
            row.remove();
            renumberRows();
        }
    });

    // Renumber rows
    function renumberRows() {
        $('#cocu-table tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    // Add file input change handler
    $(document).on('change', 'input[type="file"]', function() {
        const input = $(this);
        const file = input.get(0).files[0];
        const viewButton = input.closest('.input-group').find('.view-document');
        
        if (file) {
            const url = URL.createObjectURL(file);
            if (!viewButton.length) {
                const button = $(`
                    <div class="input-group-append">
                        <button type="button" class="btn btn-info view-document" data-title="Preview">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                `);
                input.closest('.input-group').append(button);
                
                button.find('.view-document').click(function() {
                    const modal = document.getElementById('documentModal');
                    const documentFrame = document.getElementById('documentFrame');
                    const documentTitle = document.getElementById('documentTitle');
                    
                    documentFrame.src = url;
                    documentTitle.textContent = file.name;
                    modal.style.display = 'block';
                });
            } else {
                viewButton.data('document', url);
            }
        }
    });
});

// Add this to your existing script section or create new script tags
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('documentModal');
  const modalClose = document.querySelector('.modal-close');
  const documentFrame = document.getElementById('documentFrame');
  const documentTitle = document.getElementById('documentTitle');
  
  // Open modal when clicking view buttons
  document.querySelectorAll('.view-document').forEach(button => {
    button.addEventListener('click', function() {
      const documentUrl = this.dataset.document;
      const title = this.dataset.title;
      
      documentFrame.src = documentUrl;
      documentTitle.textContent = title;
      modal.style.display = 'block';
    });
  });

  // Close modal when clicking X
  modalClose.addEventListener('click', function() {
    modal.style.display = 'none';
    documentFrame.src = '';
  });

  // Close modal when clicking outside
  window.addEventListener('click', function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
      documentFrame.src = '';
    }
  });

  // Close modal when pressing ESC key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal.style.display === 'block') {
      modal.style.display = 'none';
      documentFrame.src = '';
    }
  });
});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/applicant/cocuriculumForm.blade.php ENDPATH**/ ?>