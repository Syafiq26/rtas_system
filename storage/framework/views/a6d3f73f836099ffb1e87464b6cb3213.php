<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Details - RTAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        
        .section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .section:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .section-title {
            background-color: #f8f9fa;
            padding: 0.8rem 1.2rem;
            margin: -1.5rem -1.5rem 1rem -1.5rem;
            border-bottom: 1px solid #e0e0e0;
            color: #2c3e50;
            font-weight: 600;
            border-radius: 8px 8px 0 0;
        }

        .table {
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f4f6f8;
            border-bottom: 2px solid #dee2e6;
            color: #2c3e50;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.02);
        }

        .file-link {
            color: #007bff;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            display: inline-block;
        }

        .file-link:hover {
            background-color: #f0f7ff;
            color: #0056b3;
            text-decoration: none;
        }

        .modal-xl {
            max-width: 95%;
            margin: 1.75rem auto;
        }

        .document-frame {
            width: 100%;
            height: 85vh;
            border: none;
            border-radius: 4px;
        }

        .modal-content {
            border-radius: 8px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            border-radius: 8px 8px 0 0;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-1px);
        }

        /* Information styling */
        .row strong {
            color: #495057;
            font-weight: 600;
        }

        .row p {
            margin-bottom: 0.8rem;
            padding: 0.3rem 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .section {
                padding: 1rem;
            }
            
            .modal-xl {
                max-width: 100%;
                margin: 0;
            }
            
            .document-frame {
                height: 75vh;
            }
        }
    </style>
</head>
<body>

<?php echo $__env->make('interviewer.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('interviewer.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="main-content mt-4">
                <h2>Candidate Details</h2>

                <?php if($personal): ?>
                <div class="section">
                    <h3 class="section-title">Personal Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo e($personal->name); ?></p>
                            <p><strong>IC Number:</strong> <?php echo e($personal->icNum); ?></p>
                            <p><strong>Gender:</strong> <?php echo e(ucfirst($personal->gender)); ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo e($personal->dob); ?></p>
                            <p><strong>Place of Birth:</strong> <?php echo e($personal->pob); ?></p>
                            <p><strong>Citizenship:</strong> <?php echo e($personal->citizen); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> <?php echo e($personal->email); ?></p>
                            <p><strong>Phone:</strong> <?php echo e($personal->phoneNum); ?></p>
                            <p><strong>Address:</strong> <?php echo e($personal->address); ?></p>
                            <p><strong>Address 2:</strong> <?php echo e($personal->address2); ?></p>
                            <p><strong>City:</strong> <?php echo e($personal->city); ?></p>
                            <p><strong>Postcode:</strong> <?php echo e($personal->postcode); ?></p>
                            <p><strong>State:</strong> <?php echo e($personal->state); ?></p>
                        </div>
                        <?php if($personal->copyIC): ?>
                        <div class="col-md-12 mt-2">
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $personal->copyIC)); ?>')">
                                    View Document
                                </span>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($academic): ?>
                <div class="section">
                    <h3 class="section-title">Academic Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>School:</strong> <?php echo e($academic->schoolName); ?></p>
                            <p><strong>Major:</strong> <?php echo e($academic->major); ?></p>
                        </div>
                    </div>
                    <h4>Academic Results:</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects = json_decode($academic->subjectName) ?? [];
                                    $grades = json_decode($academic->subjectGrade) ?? [];
                                ?>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($subject); ?></td>
                                    <td><?php echo e($grades[$index] ?? 'N/A'); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($academic->spmCertLocation): ?>
                    <div class="mt-2">
                        <p><strong>SPM Certificate:</strong> 
                            <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $academic->spmCertLocation)); ?>')">
                                View Document
                            </span>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if($cocuriculums && $cocuriculums->count() > 0): ?>
                <div class="section">
                    <h3 class="section-title">Co-Curriculum Activities</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th>Role</th>
                                    <?php if($cocuriculums->first()->copyCertLocation): ?>
                                    <th>Certificate</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cocuriculums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cocu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($cocu->cocuName); ?></td>
                                    <td><?php echo e($cocu->cocuType); ?></td>
                                    <td><?php echo e($cocu->represent); ?></td>
                                    <td><?php echo e($cocu->role); ?></td>
                                    <?php if($cocu->copyCertLocation): ?>
                                    <td>
                                        <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $cocu->copyCertLocation)); ?>')">
                                            View Certificate
                                        </span>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($father || $mother): ?>
                <div class="section">
                    <h3 class="section-title">Parents Information</h3>
                    <?php if($father): ?>
                    <h4>Father's Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo e($father->fatherName); ?></p>
                            <p><strong>IC:</strong> <?php echo e($father->fatherIC); ?></p>
                            <p><strong>Citizenship:</strong> <?php echo e($father->citizen); ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo e($father->fatherDOB); ?></p>
                            <p><strong>Place of Birth:</strong> <?php echo e($father->fatherPOB); ?></p>
                            <p><strong>Age:</strong> <?php echo e($father->fatherAge); ?></p>
                            <p><strong>Occupation:</strong> <?php echo e($father->occupation); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone:</strong> <?php echo e($father->fatherPhone); ?></p>
                            <p><strong>Email:</strong> <?php echo e($father->fatherEmail); ?></p>
                            <p><strong>Employer:</strong> <?php echo e($father->fatherEmployer); ?></p>
                            <p><strong>Employer Address:</strong> <?php echo e($father->addressEmployer); ?></p>
                            <p><strong>Postcode:</strong> <?php echo e($father->postcode); ?></p>
                            <p><strong>Income:</strong> RM<?php echo e(number_format($father->fatherIncome, 2)); ?></p>
                        </div>
                        <?php if($father->copyIC || $father->copySalaryLocation): ?>
                        <div class="col-md-12 mt-2">
                            <?php if($father->copyIC): ?>
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $father->copyIC)); ?>')">
                                    View Document
                                </span>
                            </p>
                            <?php endif; ?>
                            <?php if($father->copySalaryLocation): ?>
                            <p><strong>Salary Slip:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $father->copySalaryLocation)); ?>')">
                                    View Document
                                </span>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if($mother): ?>
                    <h4 class="mt-3">Mother's Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo e($mother->motherName); ?></p>
                            <p><strong>IC:</strong> <?php echo e($mother->motherIC); ?></p>
                            <p><strong>Citizenship:</strong> <?php echo e($mother->citizen); ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo e($mother->motherDOB); ?></p>
                            <p><strong>Place of Birth:</strong> <?php echo e($mother->motherPOB); ?></p>
                            <p><strong>Age:</strong> <?php echo e($mother->motherAge); ?></p>
                            <p><strong>Occupation:</strong> <?php echo e($mother->occupation); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone:</strong> <?php echo e($mother->motherPhone); ?></p>
                            <p><strong>Email:</strong> <?php echo e($mother->motherEmail); ?></p>
                            <p><strong>Employer:</strong> <?php echo e($mother->motherEmployer); ?></p>
                            <p><strong>Employer Address:</strong> <?php echo e($mother->addressEmployer); ?></p>
                            <p><strong>Postcode:</strong> <?php echo e($mother->postcode); ?></p>
                            <p><strong>Income:</strong> RM<?php echo e(number_format($mother->motherIncome, 2)); ?></p>
                        </div>
                        <?php if($mother->copyIC || $mother->copySalaryLocation): ?>
                        <div class="col-md-12 mt-2">
                            <?php if($mother->copyIC): ?>
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $mother->copyIC)); ?>')">
                                    View Document
                                </span>
                            </p>
                            <?php endif; ?>
                            <?php if($mother->copySalaryLocation): ?>
                            <p><strong>Salary Slip:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $mother->copySalaryLocation)); ?>')">
                                    View Document
                                </span>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if($guardian): ?>
                <div class="section">
                    <h3 class="section-title">Guardian Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo e($guardian->name); ?></p>
                            <p><strong>IC:</strong> <?php echo e($guardian->ic); ?></p>
                            <p><strong>Citizenship:</strong> <?php echo e($guardian->citizen); ?></p>
                            <p><strong>Gender:</strong> <?php echo e(ucfirst($guardian->gender)); ?></p>
                            <p><strong>Relationship:</strong> <?php echo e($guardian->relation); ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo e($guardian->dob); ?></p>
                            <p><strong>Place of Birth:</strong> <?php echo e($guardian->pob); ?></p>
                            <p><strong>Age:</strong> <?php echo e($guardian->age); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Occupation:</strong> <?php echo e($guardian->occupation); ?></p>
                            <p><strong>Phone:</strong> <?php echo e($guardian->phoneNum); ?></p>
                            <p><strong>Email:</strong> <?php echo e($guardian->email); ?></p>
                            <p><strong>Employer Name:</strong> <?php echo e($guardian->empName); ?></p>
                            <p><strong>Employer Address:</strong> <?php echo e($guardian->empAddress); ?></p>
                            <p><strong>Postcode:</strong> <?php echo e($guardian->postcode); ?></p>
                            <p><strong>Income:</strong> RM<?php echo e(number_format($guardian->income, 2)); ?></p>
                        </div>
                        <?php if($guardian->copyIC || $guardian->copySalaryLocation): ?>
                        <div class="col-md-12 mt-2">
                            <?php if($guardian->copyIC): ?>
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $guardian->copyIC)); ?>')">
                                    View Document
                                </span>
                            </p>
                            <?php endif; ?>
                            <?php if($guardian->copySalaryLocation): ?>
                            <p><strong>Salary Slip:</strong> 
                                <span class="file-link" onclick="showDocument('<?php echo e(asset('storage/' . $guardian->copySalaryLocation)); ?>')">
                                    View Document
                                </span>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($siblings && $siblings->count() > 0): ?>
                <div class="section">
                    <h3 class="section-title">Siblings Information</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Date of Birth</th>
                                    <th>Education/Occupation</th>
                                    <th>Employment/Institution</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $siblings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sibling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sibling->siblingName); ?></td>
                                    <td><?php echo e($sibling->siblingAge); ?></td>
                                    <td><?php echo e($sibling->siblingDOB); ?></td>
                                    <td><?php echo e($sibling->occupation); ?></td>
                                    <td><?php echo e($sibling->emp_ins); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-4 mb-4">
                    <a href="<?php echo e(route('interviewer.recommendList')); ?>" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Document Viewer Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe class="document-frame" id="documentFrame" src=""></iframe>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showDocument(url) {
    $('#documentFrame').attr('src', url);
    $('#documentModal').modal('show');
}

// Handle modal close
$('#documentModal').on('hidden.bs.modal', function () {
    $('#documentFrame').attr('src', '');
});
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\rtas_system\resources\views/interviewer/viewCandidate.blade.php ENDPATH**/ ?>