<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTAS - Guardian Details</title>

    <!-- External CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Copy the exact same styles from parentForm.blade.php -->
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f5f7fa;
            color: #2c3e50;
        }

        .navbar {
            background-color: #2c3e50;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #fff !important;
        }

        .main-content {
            padding: 30px;
            margin-top: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .form-container h5 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
            position: relative;
        }

        .form-container h5::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background-color: #3498db;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .col-form-label {
            color: #34495e;
            font-weight: 500;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-1px);
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

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
            color: white;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .alert {
            border-radius: 6px;
            padding: 15px 20px;
        }

        .alert-danger {
            background-color: #fdf3f2;
            border-color: #f5c6cb;
            color: #721c24;
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

        /* Document Modal styles */
        .document-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 20px;
            width: 80%;
            max-width: 900px;
            height: 80vh;
            background: white;
            border-radius: 8px;
            margin-top: 50px;
        }

        .modal-close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }

        .modal-close:hover {
            color: #000;
        }

        .document-frame {
            width: 100%;
            height: calc(100% - 40px);
            border: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .form-container {
                padding: 15px;
            }

            .col-form-label {
                margin-bottom: 5px;
            }
        }

        .document-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 20px;
            width: 90%;
            max-width: 1000px;
            height: 90vh;
            background: white;
            border-radius: 8px;
            margin-top: 2vh;
        }

        .modal-close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
            z-index: 1001;
        }

        .modal-close:hover {
            color: #000;
        }

        .document-frame {
            width: 100%;
            height: calc(100% - 40px);
            border: none;
            border-radius: 4px;
        }

        #documentTitle {
            margin-bottom: 15px;
            color: #2c3e50;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php echo $__env->make('applicant.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid">
        <div class="row">
            <?php echo $__env->make('applicant.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="main-content">
                    <div class="form-container">
                        <h5>Details of Guardian *</h5>
                        <form method="post" action="<?php echo e(route('guardian.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $guardian->name ?? '')); ?>">
                                </div>
                                <label for="ic" class="col-sm-2 col-form-label">I/C No</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="ic" name="ic" value="<?php echo e(old('ic', $guardian->ic ?? '')); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="citizenship" class="col-sm-2 col-form-label">Citizenship</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo e(old('citizenship', $guardian->citizen ?? '')); ?>">
                                </div>
                                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="male" <?php echo e(old('gender', $guardian->gender ?? '') == 'male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="female" <?php echo e(old('gender', $guardian->gender ?? '') == 'female' ? 'selected' : ''); ?>>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="relation" class="col-sm-2 col-form-label">Relation</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="relation" name="relation">
                                        <option value="">--Choose One--</option>
                                        <option value="btiri" <?php echo e(old('relation', $guardian->relation ?? '') == 'btiri' ? 'selected' : ''); ?>>Bapak Tiri</option>
                                        <option value="mtiri" <?php echo e(old('relation', $guardian->relation ?? '') == 'mtiri' ? 'selected' : ''); ?>>Mak Tiri</option>
                                        <option value="bsaudara" <?php echo e(old('relation', $guardian->relation ?? '') == 'bsaudara' ? 'selected' : ''); ?>>Bapak Saudara</option>
                                        <option value="msaudara" <?php echo e(old('relation', $guardian->relation ?? '') == 'msaudara' ? 'selected' : ''); ?>>Mak Saudara</option>
                                        <option value="beradik" <?php echo e(old('relation', $guardian->relation ?? '') == 'beradik' ? 'selected' : ''); ?>>Adik Beradik</option>
                                        <option value="sepupu" <?php echo e(old('relation', $guardian->relation ?? '') == 'sepupu' ? 'selected' : ''); ?>>Sepupu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e(old('dob', $guardian->dob ?? '')); ?>">
                                </div>
                                <label for="pob" class="col-sm-2 col-form-label">Place of Birth</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="pob" name="pob" value="<?php echo e(old('pob', $guardian->pob ?? '')); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="age" class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="age" name="age" value="<?php echo e(old('age', $guardian->age ?? '')); ?>">
                                </div>
                                <label for="copyIC" class="col-sm-2 col-form-label">Copy of Guardian's I/C</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="file" id="copyIC" name="copyIC">
                                    <?php if($guardian && $guardian->copyIC): ?>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-info view-document" 
                                                    data-document="<?php echo e(asset('storage/' . $guardian->copyIC)); ?>"
                                                    data-title="Guardian's IC Document">
                                                <i class="fas fa-eye"></i> View IC Document
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="occupation" class="col-sm-2 col-form-label">Occupation</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo e(old('occupation', $guardian->occupation ?? '')); ?>">
                                </div>
                                <label for="phoneNum" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="<?php echo e(old('phoneNum', $guardian->phoneNum ?? '')); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="empName" class="col-sm-2 col-form-label">Name Employer</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="empName" name="empName" value="<?php echo e(old('empName', $guardian->empName ?? '')); ?>">
                                </div>
                                <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo e(old('postcode', $guardian->postcode ?? '')); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="empAddress" class="col-sm-2 col-form-label">Address Employer</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="empAddress" name="empAddress" value="<?php echo e(old('empAddress', $guardian->empAddress ?? '')); ?>">
                                </div>
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $guardian->email ?? '')); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="income" class="col-sm-2 col-form-label">Monthly Income (RM)</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="income" name="income" value="<?php echo e(old('income', $guardian->income ?? '')); ?>">
                                </div>
                                <label for="copySalary" class="col-sm-2 col-form-label">Copy of Latest Salary</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="file" id="copySalary" name="copySalary">
                                    <?php if($guardian && $guardian->copySalaryLocation): ?>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-info view-document" 
                                                    data-document="<?php echo e(asset('storage/' . $guardian->copySalaryLocation)); ?>"
                                                    data-title="Guardian's Salary Slip">
                                                <i class="fas fa-eye"></i> View Salary Slip
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
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
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-2">Save & Next</button>
                                <button type="reset" class="btn btn-secondary mr-2">Reset</button>
                                <a href="<?php echo e(route('parent.form')); ?>" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('documentModal');
            const modalClose = document.querySelector('.modal-close');
            const documentFrame = document.getElementById('documentFrame');
            const documentTitle = document.getElementById('documentTitle');
            
            document.querySelectorAll('.view-document').forEach(button => {
                button.addEventListener('click', function() {
                    const documentUrl = this.dataset.document;
                    const title = this.dataset.title;
                    
                    documentFrame.src = documentUrl;
                    documentTitle.textContent = title;
                    modal.style.display = 'block';
                });
            });

            modalClose.addEventListener('click', function() {
                modal.style.display = 'none';
                documentFrame.src = '';
            });

            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                    documentFrame.src = '';
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.style.display === 'block') {
                    modal.style.display = 'none';
                    documentFrame.src = '';
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/applicant/guardian.blade.php ENDPATH**/ ?>