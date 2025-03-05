<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTAS</title>
  

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Add FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f5f7fa;
    }

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

    .form-container h5 {
      color: #2c3e50;
      font-weight: 600;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #eee;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

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

    .file-preview {
      margin-top: 0.5rem;
      padding: 0.5rem;
      background-color: #f8f9fa;
      border-radius: 4px;
      font-size: 0.875rem;
    }

    /* Modal styles */
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
  </style>
</head>
<body>

<!-- Top Navbar -->
@include('applicant.navbar')

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    @include('applicant.sidebar')

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <form method="post" action="{{ route('parent.store') }}" enctype="multipart/form-data">
          @csrf
          
          <!-- Father Details -->
          <div class="form-container">
            <h5>Details of Father *</h5>
            <!-- Update field names to match validation rules -->
            <div class="form-group row">
              <label for="fatherName" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherName" name="fatherName" value="{{ old('fatherName', $father->fatherName ?? '') }}">
              </div>
              <label for="fatherIC" class="col-sm-2 col-form-label">I/C No</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherIC" name="fatherIC" value="{{ old('fatherIC', $father->fatherIC ?? '') }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="fatherCitizen" class="col-sm-2 col-form-label">Citizenship</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherCitizen" name="fatherCitizen" value="{{ old('fatherCitizen', $father->citizen ?? '') }}">
              </div>
              <label for="fatherGender" class="col-sm-2 col-form-label">Gender</label>
              <div class="col-sm-4">
                <select class="form-control" id="fatherGender" name="fatherGender">
                  <option value="male" {{ old('fatherGender', $father->fatherGender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('fatherGender', $father->fatherGender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="fatherDOB" class="col-sm-2 col-form-label">Date of Birth</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="fatherDOB" name="fatherDOB" value="{{ old('fatherDOB', $father->fatherDOB ?? '') }}">
              </div>
              <label for="fatherPOB" class="col-sm-2 col-form-label">Place of Birth</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherPOB" name="fatherPOB" value="{{ old('fatherPOB', $father->fatherPOB ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="fatherAge" class="col-sm-2 col-form-label">Age</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" id="fatherAge" name="fatherAge" min="1" max="150" value="{{ old('fatherAge', $father->fatherAge ?? '') }}">
              </div>
              <label for="fatherOccupation" class="col-sm-2 col-form-label">Occupation</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation" value="{{ old('fatherOccupation', $father->occupation ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="fatherEmployerName" class="col-sm-2 col-form-label">Name Employer</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherEmployerName" name="fatherEmployerName" value="{{ old('fatherEmployerName', $father->fatherEmployer ?? '') }}">
              </div>
              <label for="fatherEmpAddress" class="col-sm-2 col-form-label">Address Employer</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherEmpAddress" name="fatherEmpAddress" value="{{ old('fatherEmpAddress', $father->addressEmployer ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="fatherPhone" class="col-sm-2 col-form-label">Phone Number</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherPhone" name="fatherPhone" value="{{ old('fatherPhone', $father->fatherPhone ?? '') }}">
              </div>
              <label for="fatherEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherEmail" name="fatherEmail" value="{{ old('fatherEmail', $father->fatherEmail ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="fatherSalary" class="col-sm-2 col-form-label">GrossIncome (RM)</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" id="fatherSalary" name="fatherSalary" value="{{ old('fatherSalary', $father->fatherIncome ?? '') }}">
              </div>
              <label for="fatherPostcode" class="col-sm-2 col-form-label">Postcode</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="fatherPostcode" name="fatherPostcode" value="{{ old('fatherPostcode', $father->postcode ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="fatherIcFile" class="col-sm-2 col-form-label">Copy of Father's I/C</label>
              <div class="col-sm-4">
                <input class="form-control" type="file" id="fatherIcFile" name="fatherIcFile">
                @if($father && $father->copyIC)
                  <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-info view-document" 
                            data-document="{{ asset('storage/' . $father->copyIC) }}"
                            data-title="Father's IC Document">
                      <i class="fas fa-eye"></i> View IC Document
                    </button>
                  </div>
                @endif
              </div>
              <label for="fatherSalaryFile" class="col-sm-2 col-form-label">Copy of Salary Slip</label>
              <div class="col-sm-4">
                <input class="form-control" type="file" id="fatherSalaryFile" name="fatherSalaryFile">
                @if($father && $father->copySalaryLocation)
                  <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-info view-document" 
                            data-document="{{ asset('storage/' . $father->copySalaryLocation) }}"
                            data-title="Father's Salary Slip">
                      <i class="fas fa-eye"></i> View Salary Slip
                    </button>
                  </div>
                @endif
              </div>
            </div>
          </div>
  
          <!-- Mother Details -->
          <div class="form-container">
            <h5>Details of Mother *</h5>
            <div class="form-group row">
              <label for="motherName" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherName" name="motherName" value="{{ old('motherName', $mother->motherName ?? '') }}">
              </div>
              <label for="motherIC" class="col-sm-2 col-form-label">I/C No</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherIC" name="motherIC" value="{{ old('motherIC', $mother->motherIC ?? '') }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="motherCitizen" class="col-sm-2 col-form-label">Citizenship</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherCitizen" name="motherCitizen" value="{{ old('motherCitizen', $mother->citizen ?? '') }}">
              </div>
              <label for="motherGender" class="col-sm-2 col-form-label">Gender</label>
              <div class="col-sm-4">
                <select class="form-control" id="motherGender" name="motherGender">
                  <option value="male" {{ old('motherGender', $mother->motherGender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('motherGender', $mother->motherGender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="motherDOB" class="col-sm-2 col-form-label">Date of Birth</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="motherDOB" name="motherDOB" value="{{ old('motherDOB', $mother->motherDOB ?? '') }}">
              </div>
              <label for="motherPOB" class="col-sm-2 col-form-label">Place of Birth</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherPOB" name="motherPOB" value="{{ old('motherPOB', $mother->motherPOB ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="motherAge" class="col-sm-2 col-form-label">Age</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" id="motherAge" name="motherAge" min="1" max="150" value="{{ old('motherAge', $mother->motherAge ?? '') }}">
              </div>
              <label for="motherOccupation" class="col-sm-2 col-form-label">Occupation</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherOccupation" name="motherOccupation" value="{{ old('motherOccupation', $mother->occupation ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="motherEmployerName" class="col-sm-2 col-form-label">Name Employer</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherEmployerName" name="motherEmployerName" value="{{ old('motherEmployerName', $mother->motherEmployer ?? '') }}">
              </div>
              <label for="motherEmpAddress" class="col-sm-2 col-form-label">Address Employer</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherEmpAddress" name="motherEmpAddress" value="{{ old('motherEmpAddress', $mother->addressEmployer ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="motherPhone" class="col-sm-2 col-form-label">Phone Number</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherPhone" name="motherPhone" value="{{ old('motherPhone', $mother->motherPhone ?? '') }}">
              </div>
              <label for="motherEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherEmail" name="motherEmail" value="{{ old('motherEmail', $mother->motherEmail ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="motherSalary" class="col-sm-2 col-form-label">Gross Income (RM)</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" id="motherSalary" name="motherSalary" value="{{ old('motherSalary', $mother->motherIncome ?? '') }}">
              </div>
              <label for="motherPostcode" class="col-sm-2 col-form-label">Postcode</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="motherPostcode" name="motherPostcode" value="{{ old('motherPostcode', $mother->postcode ?? '') }}">
              </div>
            </div>
  
            <div class="form-group row">
              <label for="motherIcFile" class="col-sm-2 col-form-label">Copy of Mother's I/C</label>
              <div class="col-sm-4">
                <input class="form-control" type="file" id="motherIcFile" name="motherIcFile">
                @if($mother && $mother->copyIC)
                  <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-info view-document" 
                            data-document="{{ asset('storage/' . $mother->copyIC) }}"
                            data-title="Mother's IC Document">
                      <i class="fas fa-eye"></i> View IC Document
                    </button>
                  </div>
                @endif
              </div>
              <label for="motherSalaryFile" class="col-sm-2 col-form-label">Copy of Salary Slip</label>
              <div class="col-sm-4">
                <input class="form-control" type="file" id="motherSalaryFile" name="motherSalaryFile">
                @if($mother && $mother->copySalaryLocation)
                  <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-info view-document" 
                            data-document="{{ asset('storage/' . $mother->copySalaryLocation) }}"
                            data-title="Mother's Salary Slip">
                      <i class="fas fa-eye"></i> View Salary Slip
                    </button>
                  </div>
                @endif
              </div>
            </div>
          </div>

          <!-- Guardian Button Section -->
          <div class="form-container">
            <div class="d-flex align-items-center">
              <p class="mb-0 mr-3">If you have guardian, click this button</p>
              <a href="{{ route('guardian.form') }}" class="btn btn-info">
                <i class="fas fa-user-plus"></i> Add Guardian Details
              </a>
            </div>
          </div>

          <!-- Display validation errors -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
  
          <!-- Buttons -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-2">Save & Next</button>
            <button type="reset" class="btn btn-secondary mr-2">Reset</button>
            <a href="{{ route('cocuriculum.form') }}" class="btn btn-danger">Back</a>
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

<!-- Add this JavaScript before closing body tag -->
<script>
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
</html>