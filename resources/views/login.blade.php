<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - DCP System</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 36px 32px 28px 32px;
            width: 100%;
            max-width: 370px;
            margin: 32px auto;
        }

        .login-card .links {
            text-align: center;
            margin-bottom: 18px;
        }

        .login-card .links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            margin: 0 4px;
            font-size: 15px;
        }

        .login-card .links a:hover {
            text-decoration: underline;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 6px;
            color: #1e293b;
            font-size: 1.4rem;
        }

        .login-card p {
            text-align: center;
            color: #64748b;
            margin-bottom: 22px;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: 500;
            color: #334155;
            margin-bottom: 6px;
            font-size: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
            background: #f1f5f9;
            transition: border 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border: 1.5px solid #2563eb;
            outline: none;
            background: #fff;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 18px;
        }

        .btn {
            width: 100%;
            padding: 10px 0;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 6px;
        }

        .btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="login-card">
       
        <h2>DepEd Computerization Program (DCP)</h2>
        <p>Inventory Management System</p>
        <form method="POST" action="{{route('submit-login')}}">
            @csrf
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="margin-bottom:0; font-weight:400; color:#64748b;">Remember me</label>
            </div>
            <button type="submit" class="btn">Sign in</button>
        </form>
    </div>
</body>
</html>
