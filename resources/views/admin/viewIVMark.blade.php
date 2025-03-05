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
@include("admin.navbar")

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
   @include("admin.sidebar")
    

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <h2>INTERVIEWER MARKS DETAILS</h2>
        <div class="form-container">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">I/C Number</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="{{ $candidate->applicant_id }}" readonly>
            </div>
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="{{ $candidate->personal->name ?? 'N/A' }}" readonly>
            </div>
          </div>

          <div class="table-responsive mt-4">
            @foreach($questionsByInterviewer as $interviewer_id => $questions)
              <h5>Interviewer Name: {{ $questions->first()->interviewer_name }}</h5><!-- Add interviewer name as a header -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Marks (/5)</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ ucfirst(str_replace('_', ' ', $question->category)) }}</td>
                                <td>{{ $question->marks }}</td>
                                <td>{{ $question->comment }}</td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td><strong>Interviewer Total</strong></td>
                            <td><strong>{{ $questions->sum('marks') }}/30</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
            <div class="table-success mt-4">
                <h4><strong>Final Average Score: {{ $totalScore }}/30</strong></h4>
            </div>
        </div>
        

          <!-- Buttons -->
          <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('admin.interviewerMark') }}" class="btn btn-danger">Back</a>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
    
</body>
</html>