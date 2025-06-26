<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - DCP System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f8f8f8;
        }

        .container {
            width: 360px;
            margin: auto;
            padding: 25px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 7px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .captcha {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .captcha img {
            height: 40px;
            margin-right: 10px;
            border: 1px solid #ccc;
        }

        .refresh-btn {
            margin-top: 10px;
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
            color: #007bff;
            text-decoration: underline;
        }

        .remember {
            margin-top: 10px;
        }

        .btn {
            width: 100%;
            padding: 8px;
            background-color: #007bff;
            color: white;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .links {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="links">
            <a href="#">NID Data Collection Submission Dashboard</a><br>
            <a href="#">Login</a>
        </div>

        <h2>DepEd Computerization Program (DCP) </h2>
        <p class="text-center" style="text-align: center;">Inventory Management System</p>

        <form method="POST" action="{{route('submit-login')}}" >
            @csrf

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

           

            <div class="form-group remember">
                <input type="checkbox" name="remember"> Remember me
            </div>

            <button type="submit" class="btn">Sign in</button>
        </form>
    </div>
</body>
</html>
