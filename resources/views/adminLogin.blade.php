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

        <form action="" method="POST">
            @csrf
            <label for="login_id">
                Staff Id:
            </label>
            <input type="text" id="login_id" name="login_id" 
                placeholder="Enter your Staff Id" required>

            <label for="password">
                Password:
            </label>
            <input type="text" id="login_id" name="login_id" 
                placeholder="Enter your password" required>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="wrap">
                <button type="submit">
                    Login
                </button>
            </div>
        </form>
          
    </div>
</body>

</html>