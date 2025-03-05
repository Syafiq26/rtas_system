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
 <?php echo $__env->make('applicant.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php echo $__env->make('applicant.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content Area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="main-content">
        <div class="statement-box">
                <h4>Requirements:</h4>
                <p>1. Open to Malaysian citizens.</p>
                    <p>2. Received UniKL RCMP offer letter for Foundation in Medical Sciences</p>
                    <p>3. Pass current year SPM with minimum of 7As (science stream only).</p>
                    <p>4. Active in co-curricular activities.</p>
                    <p>5. No disciplinary records</p>
                    <p>6. Low household incomes</p>

            
        </div>


        <div class ="statement-box">
        <h4>Document That Need Uploaded</h4>
            <p><strong>All complete documents need to be <strong> verified</strong> and attech them in the form</strong></p>
            <p>1. Copy of I/Cs of applicant and parents/guardian.</p>
            <p>2. Copy of SPM examination results</p>
            <p>3. Copy of co-curicular activity certifices/testimonials</p>
            <p>4. Latest copy of parents/guardian salary slip</p>
            <p>5. Video on motivation (5minutes)</p>

       </div>

       <div class="radio-container">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    I understand and agree with the statement above
                </label>
            </div>

     </div>
            <div class="d-flex justify-content-end">
            <button class="btn btn-primary" id="agreeButton" disabled> Agree and Proceed</button>
            </div>

            <script>
            // Get the radio button and the button elements
            const radioButton = document.getElementById('flexRadioDefault1');
            const agreeButton = document.getElementById('agreeButton');

            // Add an event listener to the radio button
            radioButton.addEventListener('change', function () {
                // Enable the button if the radio button is checked
                agreeButton.disabled = !radioButton.checked;
            });

            agreeButton.addEventListener('click', function () {
            // Redirect to the personal form route
            window.location.href = "<?php echo e(route('personal.form')); ?>";
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
</html><?php /**PATH C:\xampp\htdocs\rtas_system\resources\views/applicant/home.blade.php ENDPATH**/ ?>