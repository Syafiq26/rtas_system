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
@include('interviewer.navbar')

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    @include('interviewer.sidebar')
    
    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <h2>QUESTION</h2>
        <form method="post" action="{{ route('interview.store', $candidate->id) }}" id="questionsForm">
          @csrf
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif

          <div class="form-container">
            <div class="form-group row">
              <label for="gender" class="col-sm-2 col-form-label">IC Number</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="ic" name="ic" value="{{ $candidate->applicant_id }}" readonly>
                </div>
              <label for="ic" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="name" value="{{ $candidate->name }}" readonly>
              </div>
            </div>
          </div>

          <div class="card-header">
              Interview Questions (Your Marks Only)
          </div>
          <div class="card-body">
              <form action="{{ route('interview.store', $candidate->id) }}" method="POST">
                  @csrf
                  <div class="form-group">
                      @foreach(['self_introduction', 'appearance', 'communication', 'attitude', 'general', 'selfMotivation'] as $category)
                          <div class="mb-4">
                              <h5>{{ ucfirst(str_replace('_', ' ', $category)) }}</h5>
                              <div class="row">
                                  <div class="col-md-3">
                                      <label>Marks (0-5):</label>
                                      <input type="number" 
                                          name="questions[{{ $category }}][marks]" 
                                          class="form-control" 
                                          min="0" 
                                          max="5" 
                                          value="{{ $questions[$category]->marks ?? '' }}" 
                                          required>
                                  </div>
                                  <div class="col-md-9">
                                      <label>Comments:</label>
                                      <input type="text" 
                                          name="questions[{{ $category }}][comment]" 
                                          class="form-control" 
                                          value="{{ $questions[$category]->comment ?? '' }}">
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
                  <button type="submit" class="btn btn-primary">Save Marks</button>
              </form>
          </div>

          <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{ route('interviewer.recommendList') }}" class="btn btn-danger">Back</a>
          </div>
        </form>
        <script>
          $(document).ready(function() {
              // Add input validation
              $('input[type="number"]').attr({
                  'min': '0',
                  'max': '10',
                  'required': true
              });

              $('#questionsForm').on('submit', function(e) {
                  let isValid = true;
                  $('input[type="number"]').each(function() {
                      const value = parseInt($(this).val());
                      if (isNaN(value) || value < 0 || value > 10) {
                          alert('Marks must be between 0 and 10');
                          isValid = false;
                          return false;
                      }
                  });
                  return isValid;
              });
          });
        </script>
      </div>
    </main>
  </div>
</div>
    
</body>
</html>