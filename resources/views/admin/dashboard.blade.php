<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTAS ADMIN</title>
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
     @include('admin.navbar')

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
             <!-- Sidebar -->
              @include('admin.sidebar')

            <!-- Main Content Area -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="main-content">
                    <h1>Admin Dashboard</h1>
                    <!-- Dashboard Stats -->
                    <!-- Reservation Section -->
                    <div class="reservation-section">
                        <div class="row mb-4">
                            <!-- Stats Cards -->
                            <div class="col-md-3">
                                <div class="card asset-info-card" style="background-color: rgb(43, 43, 228)">
                                    <div class="card-body" style="background-color: rgb(43, 43, 228); color: white;">
                                        <h5 class="card-title">TOTAL CANDIDATES:</h5>
                                        <p class="card-text"style="color:white">{{ $totalCandidates }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card asset-info-card" style="background-color: green;">
                                    <div class="card-body" style="background-color: green; color: white;">
                                        <h5 class="card-title">RECOMMENDED:</h5>
                                        <p class="card-text" style="color:white">{{ $recommendedCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card asset-info-card"style="background-color: rgb(194, 206, 60);">
                                    <div class="card-body" style="background-color: rgb(194, 206, 60); color: white;">
                                        <h5 class="card-title2">KIV:</h5>
                                        <p class="card-text"style="color:white">{{ $kivCount }}</p>
                                    </div>
                                </div>
                            </div>
                        <div class="card w-65">
                            <div class="card asset-info-card">
                                <div class="card-body" style="height: 300px; width: 600px;" >
                                    <h5 class="card-title">Parents/Guardian Range Salary</h5>
                                    <!-- Donut Chart Container -->
                                    <div id="salaryRange" style="height: 200px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card asset-info-card">
                                <div class="card-body" >
                                    <h5 class="card-title">Field of Study</h5>
                                    <!-- Donut Chart Container -->
                                    <div id="studyContainer" style="height: 200px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card w-65">
                            <div class="card asset-info-card">
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
                  ['B40', {{ $b40Count }}],
                  ['M40', {{ $m40Count }}],
                  ['T20', {{ $t20Count }}],
                ]);
                
                // Set Options
                const options = {
                  title:''
                };
                
                // Draw
                const chart = new google.visualization.BarChart(document.getElementById('salaryRange'));
                chart.draw(data, options);
                }

            // Field of study chart
            google.charts.setOnLoadCallback(drawStudyChart);
            function drawStudyChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Type of field', 'Total'],
                    ['Science Religion', {{ $scienceReligion }}],
                    ['Pure Science', {{ $pureScienceCount }}],
                ]);

                var options = { 'width':340, 'height':200, is3D:true };
                var chart = new google.visualization.PieChart(document.getElementById('studyContainer'));
                chart.draw(data, options);
            }

            // Score chart
            const xValues = ["100-90%", "89-80%", "79-70%", "69% & below"];
            const yValues = [{{ $score90to100 }}, {{ $score80to89 }}, {{ $score70to79 }}, {{ $scoreBelowCount }}];
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
