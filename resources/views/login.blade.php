<!DOCTYPE html>
<html>

<head>
    <title>RTAS Login</title>
    <link rel="stylesheet" href="style.css">

    <style>
    /*style.css*/
body {
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    line-height: 1.5;
    min-height: 100vh;
    background: #f3f3f3;
    background-image: url('rcmp.jpg');
    flex-direction: column;
    margin: 0;
}

.main {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    padding: 10px 20px;
    transition: transform 0.2s;
    width: 500px;
    text-align: center;
}

h1 {
    color: #4CAF50;
}

label {
    display: block;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 5px;
    text-align: left;
    color: #555;
    font-weight: bold;
}

input {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    border: none;
    color: white;
    cursor: pointer;
    background-color: #4CAF50;
    width: 720%;
    font-size: 16px;
}

.wrap {
    display: flex;
    justify-content: left;
    align-items: center;
}
    </style>
</head>


<body>
    <div class="main">
        <h1>RTAS</h1>
        <h3>RCMP TOP ACHIEVERS SCHOLARSHIP</h3>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <label for="login_id">
                I/C Number :
            </label>
            <input type="text" id="login_id" name="login_id" 
                placeholder="Enter your I/C No" required>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add the staff login link here -->
            <p style="margin-top: 10px; text-align: right;">
                <a href=" " style="font-size: 14px; color: blue; text-decoration: underline;">
                    Staff
                </a>
            </p>

            <div class="wrap">
                <button type="submit">
                    Login
                </button>
            </div>

            
             <!-- Add the help text here -->
             <p style="margin-top: 15px; font-size: 14px; color: gray; text-align: center;">
                For help, contact:
            </p>
            <ul style="list-style-type: disc; padding-left: 0; text-align: center; font-size: 14px; color: gray;">
                <li>Azrul Nazir Zahir (05-24322635 ext 246 / azrulnazir@unikl.edu.my)</li>
                <li>Wan Norazlina Abdul Rani (05-2432635 ext 151 / wannorazlina@unikl.edu.my)</li>
            </ul>
            
        </form>
          
    </div>
</body>

</html>