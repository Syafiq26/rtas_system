<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTAS INTERVIEWER</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/main.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
        /* Stats Box Styles */
        .dashboard-stats {
            margin-bottom: 20px;
        }

        .dashboard-stats .card {
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
        }

        .dashboard-stats .card-body {
            padding: 20px;
            text-align: center;
        }

        .dashboard-stats .card-title {
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }

        .dashboard-stats .card-text {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff; /* Blue color for the card header */
            color: #fff; /* White color for the text */
        }
        .card-body {
            background-color: #fff; /* White color for the card body */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .card-body:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        .card-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff; /* Blue color for the text */
        }
        /* Offcanvas styles */
        .offcanvas {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
            transition: right 0.3s ease;
            z-index: 1045;
        }
        .offcanvas.show {
            right: 0;
        }
    </style>
</head>

<body>
    <!-- Top Navbar -->
    <?php echo $__env->make('interviewer.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
             <!-- Sidebar -->
            <?php echo $__env->make('interviewer.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Main Content Area -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="main-content">
                    <h1>Interviewer Dashbaord</h1>
                    <!-- Dashboard Stats -->
                    <div class="dahboard-section">
                        <div class="row mb-4">
                            <!-- Stats Cards -->
                            <div class="col-md-3">
                                <div class="card total-info-card" style="background-color: rgb(43, 43, 228)">
                                    <div class="card-body" style="background-color: rgb(43, 43, 228); color: white;">
                                        <h5 class="card-title">TOTAL CANDIDATES:</h5>
                                        <p class="card-text"style="color:white"><?php echo e($totalCandidates); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card recommend-info-card" style="background-color: green;">
                                    <div class="card-body" style="background-color: green; color: white;">
                                        <h5 class="card-title">RECOMMENDED:</h5>
                                        <p class="card-text" style="color:white"><?php echo e($recommendedCount); ?></p>
                                    </div>
                                </div>
                            </div>
        
                        <div class="card w-65">
                            <div class="card salary-info-card">
                                <div class="card-body" style="height: 300px; width: 600px;" >
                                    <h5 class="card-title">Parents/Guardian Range Salary</h5>
                                    <!-- Donut Chart Container -->
                                    <div id="salaryRange" style="height: 200px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card major-info-card">
                                <div class="card-body" >
                                    <h5 class="card-title">Field of Study</h5>
                                    <!-- Donut Chart Container -->
                                    <div id="studyContainer" style="height: 200px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card w-65">
                            <div class="card score-info-card">
                                <div class="card-body" style="height: 300px; width: 600px;">
                                    <h5 class="card-title">Score of Candidates</h5>
                                    <!-- Donut Chart Container -->
                                    <canvas id="scoreChart" style="height: 200px; width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                        
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script>
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                
                function drawChart() {
                
                // Set Data
                const data = google.visualization.arrayToDataTable([
                  ['Salary', 'Range'],
                  ['B40', <?php echo e($b40Count); ?>],
                  ['M40', <?php echo e($m40Count); ?>],
                  ['T20', <?php echo e($t20Count); ?>],
                ]);
                
                // Set Options
                const options = {
                  title:''
                };
                
                // Draw
                const chart = new google.visualization.BarChart(document.getElementById('salaryRange'));
                chart.draw(data, options);
                
                }
                </script>
                
            <script type="text/javascript">
            //Field of study chart
            
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Type of field', 'Total'],
                ['Science Religion', <?php echo e($scienceReligion); ?>],
                ['Pure Science', <?php echo e($pureScienceCount); ?>],
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = { 'width':340, 'height':200 ,is3D:true};

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('studyContainer'));
            chart.draw(data, options);
            }
            </script>

            <script>
                const xValues = ["100-90%", "89-80%", "79-70%", "69% & below"];
                const yValues = [<?php echo e($score90to100); ?>, <?php echo e($score80to89); ?>, <?php echo e($score70to79); ?>, <?php echo e($scoreBelowCount); ?>];
                const barColors = ["green", "blue","yellow","red"];
                
                new Chart("scoreChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                    display: true,
                    text: "Score of RTAS Candidates"
                    }
                }
                });
                </script>

        </div>
            <!-- End Admin Dashboard -->
                    

            </div>
        </main>
    </div>
</div>


</body>
</html>
<?php /**PATH C:\laragon\www\rtas_system\resources\views/interviewer/dashboard.blade.php ENDPATH**/ ?>