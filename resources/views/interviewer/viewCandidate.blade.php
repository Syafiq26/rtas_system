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

@include('interviewer.navbar')

<div class="container-fluid">
    <div class="row">
        @include('interviewer.sidebar')
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="main-content mt-4">
                <h2>Candidate Details</h2>

                @if($personal)
                <div class="section">
                    <h3 class="section-title">Personal Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $personal->name }}</p>
                            <p><strong>IC Number:</strong> {{ $personal->icNum }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst($personal->gender) }}</p>
                            <p><strong>Date of Birth:</strong> {{ $personal->dob }}</p>
                            <p><strong>Place of Birth:</strong> {{ $personal->pob }}</p>
                            <p><strong>Citizenship:</strong> {{ $personal->citizen }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $personal->email }}</p>
                            <p><strong>Phone:</strong> {{ $personal->phoneNum }}</p>
                            <p><strong>Address:</strong> {{ $personal->address }}</p>
                            <p><strong>Address 2:</strong> {{ $personal->address2 }}</p>
                            <p><strong>City:</strong> {{ $personal->city }}</p>
                            <p><strong>Postcode:</strong> {{ $personal->postcode }}</p>
                            <p><strong>State:</strong> {{ $personal->state }}</p>
                        </div>
                        @if($personal->copyIC)
                        <div class="col-md-12 mt-2">
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $personal->copyIC) }}')">
                                    View Document
                                </span>
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($academic)
                <div class="section">
                    <h3 class="section-title">Academic Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>School:</strong> {{ $academic->schoolName }}</p>
                            <p><strong>Major:</strong> {{ $academic->major }}</p>
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
                                @php
                                    $subjects = json_decode($academic->subjectName) ?? [];
                                    $grades = json_decode($academic->subjectGrade) ?? [];
                                @endphp
                                @foreach($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $subject }}</td>
                                    <td>{{ $grades[$index] ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($academic->spmCertLocation)
                    <div class="mt-2">
                        <p><strong>SPM Certificate:</strong> 
                            <span class="file-link" onclick="showDocument('{{ asset('storage/' . $academic->spmCertLocation) }}')">
                                View Document
                            </span>
                        </p>
                    </div>
                    @endif
                </div>
                @endif

                @if($cocuriculums && $cocuriculums->count() > 0)
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
                                    @if($cocuriculums->first()->copyCertLocation)
                                    <th>Certificate</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cocuriculums as $cocu)
                                <tr>
                                    <td>{{ $cocu->cocuName }}</td>
                                    <td>{{ $cocu->cocuType }}</td>
                                    <td>{{ $cocu->represent }}</td>
                                    <td>{{ $cocu->role }}</td>
                                    @if($cocu->copyCertLocation)
                                    <td>
                                        <span class="file-link" onclick="showDocument('{{ asset('storage/' . $cocu->copyCertLocation) }}')">
                                            View Certificate
                                        </span>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($father || $mother)
                <div class="section">
                    <h3 class="section-title">Parents Information</h3>
                    @if($father)
                    <h4>Father's Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $father->fatherName }}</p>
                            <p><strong>IC:</strong> {{ $father->fatherIC }}</p>
                            <p><strong>Citizenship:</strong> {{ $father->citizen }}</p>
                            <p><strong>Date of Birth:</strong> {{ $father->fatherDOB }}</p>
                            <p><strong>Place of Birth:</strong> {{ $father->fatherPOB }}</p>
                            <p><strong>Age:</strong> {{ $father->fatherAge }}</p>
                            <p><strong>Occupation:</strong> {{ $father->occupation }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone:</strong> {{ $father->fatherPhone }}</p>
                            <p><strong>Email:</strong> {{ $father->fatherEmail }}</p>
                            <p><strong>Employer:</strong> {{ $father->fatherEmployer }}</p>
                            <p><strong>Employer Address:</strong> {{ $father->addressEmployer }}</p>
                            <p><strong>Postcode:</strong> {{ $father->postcode }}</p>
                            <p><strong>Income:</strong> RM{{ number_format($father->fatherIncome, 2) }}</p>
                        </div>
                        @if($father->copyIC || $father->copySalaryLocation)
                        <div class="col-md-12 mt-2">
                            @if($father->copyIC)
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $father->copyIC) }}')">
                                    View Document
                                </span>
                            </p>
                            @endif
                            @if($father->copySalaryLocation)
                            <p><strong>Salary Slip:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $father->copySalaryLocation) }}')">
                                    View Document
                                </span>
                            </p>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($mother)
                    <h4 class="mt-3">Mother's Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $mother->motherName }}</p>
                            <p><strong>IC:</strong> {{ $mother->motherIC }}</p>
                            <p><strong>Citizenship:</strong> {{ $mother->citizen }}</p>
                            <p><strong>Date of Birth:</strong> {{ $mother->motherDOB }}</p>
                            <p><strong>Place of Birth:</strong> {{ $mother->motherPOB }}</p>
                            <p><strong>Age:</strong> {{ $mother->motherAge }}</p>
                            <p><strong>Occupation:</strong> {{ $mother->occupation }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone:</strong> {{ $mother->motherPhone }}</p>
                            <p><strong>Email:</strong> {{ $mother->motherEmail }}</p>
                            <p><strong>Employer:</strong> {{ $mother->motherEmployer }}</p>
                            <p><strong>Employer Address:</strong> {{ $mother->addressEmployer }}</p>
                            <p><strong>Postcode:</strong> {{ $mother->postcode }}</p>
                            <p><strong>Income:</strong> RM{{ number_format($mother->motherIncome, 2) }}</p>
                        </div>
                        @if($mother->copyIC || $mother->copySalaryLocation)
                        <div class="col-md-12 mt-2">
                            @if($mother->copyIC)
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $mother->copyIC) }}')">
                                    View Document
                                </span>
                            </p>
                            @endif
                            @if($mother->copySalaryLocation)
                            <p><strong>Salary Slip:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $mother->copySalaryLocation) }}')">
                                    View Document
                                </span>
                            </p>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
                @endif

                @if($guardian)
                <div class="section">
                    <h3 class="section-title">Guardian Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $guardian->name }}</p>
                            <p><strong>IC:</strong> {{ $guardian->ic }}</p>
                            <p><strong>Citizenship:</strong> {{ $guardian->citizen }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst($guardian->gender) }}</p>
                            <p><strong>Relationship:</strong> {{ $guardian->relation }}</p>
                            <p><strong>Date of Birth:</strong> {{ $guardian->dob }}</p>
                            <p><strong>Place of Birth:</strong> {{ $guardian->pob }}</p>
                            <p><strong>Age:</strong> {{ $guardian->age }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Occupation:</strong> {{ $guardian->occupation }}</p>
                            <p><strong>Phone:</strong> {{ $guardian->phoneNum }}</p>
                            <p><strong>Email:</strong> {{ $guardian->email }}</p>
                            <p><strong>Employer Name:</strong> {{ $guardian->empName }}</p>
                            <p><strong>Employer Address:</strong> {{ $guardian->empAddress }}</p>
                            <p><strong>Postcode:</strong> {{ $guardian->postcode }}</p>
                            <p><strong>Income:</strong> RM{{ number_format($guardian->income, 2) }}</p>
                        </div>
                        @if($guardian->copyIC || $guardian->copySalaryLocation)
                        <div class="col-md-12 mt-2">
                            @if($guardian->copyIC)
                            <p><strong>IC Copy:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $guardian->copyIC) }}')">
                                    View Document
                                </span>
                            </p>
                            @endif
                            @if($guardian->copySalaryLocation)
                            <p><strong>Salary Slip:</strong> 
                                <span class="file-link" onclick="showDocument('{{ asset('storage/' . $guardian->copySalaryLocation) }}')">
                                    View Document
                                </span>
                            </p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($siblings && $siblings->count() > 0)
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
                                @foreach($siblings as $sibling)
                                <tr>
                                    <td>{{ $sibling->siblingName }}</td>
                                    <td>{{ $sibling->siblingAge }}</td>
                                    <td>{{ $sibling->siblingDOB }}</td>
                                    <td>{{ $sibling->occupation }}</td>
                                    <td>{{ $sibling->emp_ins }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <div class="mt-4 mb-4">
                    <a href="{{ route('interviewer.recommendList') }}" class="btn btn-secondary">Back to List</a>
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
