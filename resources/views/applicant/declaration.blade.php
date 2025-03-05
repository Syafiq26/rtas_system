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

    

  </style>
</head>
<body>

<!-- Top Navbar -->
    @include("applicant.navbar")
<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    @include("applicant.sidebar")
    
    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <h3>Terms and Conditions</h3>
                <h5>Declaration</h5>
                <p>I hereby declare that all information furnsihed above are accurate and true to the best of my knowledge.</p>
                <ul>
                    <li>UniKL reserves its right to terminate/withdraw this application should any information furnished be discovered as inaccurate and untrue.</li>
                </ul>

                <h5>Privacy Policy</h5>
                <p>We are committed to protecting your privacy. The following outlines our privacy policy:</p>
                <ul>
                    <li>We collect personal information for the purpose of processing application and providing better services.</li>
                    <li>We will not share your personal information with third parties without your consent, except as required by law.</li>
                    <li>We use secure measures to protect your information from unauthorized access and disclosure.</li>
                    <li>You have the right to access and update your personal information at any time.</li>
                </ul>
            </div>
            <div class="d-flex justify-content-end">
             <button type="button" class="btn btn-primary" id="understoodButton">Confirm and Submit</button>
              </div>

              <script>
                  document.getElementById('understoodButton').addEventListener('click', function () {
                      // Display the thank-you notification
                      alert('Thank you! Your form has been submitted successfully.');

                      // Redirect to the applicant.home route
                      window.location.href = "{{ route('applicant.home') }}";
                  });
              </script>

            </div>
        </div>
        </div>
      </div>
    </main>
  </div>
</div>


    
</body>
</html>