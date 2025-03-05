<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('admin.navbar')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')
            
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Application Details</h4>
                    </div>
                    <div class="card-body">
                        <!-- Personal Details -->
                        <h5 class="border-bottom pb-2">Personal Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $personal->name }}</p>
                                <p><strong>IC Number:</strong> {{ $personal->icNum }}</p>
                                <p><strong>Date of Birth:</strong> {{ $personal->dob }}</p>
                                <p><strong>Gender:</strong> {{ $personal->gender }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $personal->email }}</p>
                                <p><strong>Phone:</strong> {{ $personal->phone }}</p>
                                <p><strong>Address:</strong> {{ $personal->address }}</p>
                            </div>
                        </div>

                        <!-- Academic Details -->
                        <h5 class="border-bottom pb-2">Academic Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($academic as $subject)
                                        <tr>
                                            <td>{{ $subject->subject }}</td>
                                            <td>{{ $subject->grade }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Cocurriculum Details -->
                        <h5 class="border-bottom pb-2">Cocurriculum Activities</h5>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Activity</th>
                                            <th>Position</th>
                                            <th>Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cocurriculums as $activity)
                                        <tr>
                                            <td>{{ $activity->activity }}</td>
                                            <td>{{ $activity->position }}</td>
                                            <td>{{ $activity->level }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Siblings Details -->
                        <h5 class="border-bottom pb-2">Siblings Information</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Occupation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siblings as $sibling)
                                        <tr>
                                            <td>{{ $sibling->name }}</td>
                                            <td>{{ $sibling->age }}</td>
                                            <td>{{ $sibling->occupation }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
