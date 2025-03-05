<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Staff - RTAS</title>
  

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
      <div class="main-content mt-4">
        <h2>Edit Staff</h2>
        <div class="form-container bg-light p-4 rounded">
        <form method="post" action="{{ route('staff.update', $staff->id) }}">
          @csrf
          @method('PUT')
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Staff ID</label>
            <div class="col-sm-10">
             <input type="text" class="form-control" value="{{ $staff->login_id }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <select name="role" class="form-control" required>
                <option value="1" {{ $staff->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $staff->role == 'interviewer' ? 'selected' : '' }}>Interviewer</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-primary">Update</button>
              <a href="{{ route('staff.assign') }}" class="btn btn-secondary">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
    
</body>
</html>