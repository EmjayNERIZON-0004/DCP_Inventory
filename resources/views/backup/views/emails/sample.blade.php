<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .email-wrapper {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            background-color: #0069d9;
            color: white;
            padding: 2px;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
            background-color: #ffffff;
        }

        .button {
            display: inline-block;
            margin: 10px 0;
            padding: 12px 20px;
            background-color: #0069d9;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: normal;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="header">
            <h2> SDO DCP Inventory Management System</h2>
        </div>

        <div class="content">
            <h3>Hello, {{ $details['name'] }}</h3>
            <p>{{ $details['message'] }}</p>

            <p>To access your account or check your inventory reports, click the button below:</p>

            <a href="https://sccpdcpmis.site/" class="button" style="color:white">Login to SDO DCP System</a>


            <p>Here is your password: <span style="color:#0069d9">{{ $details['password'] }}</span></p>

            <hr>

            <p><strong>About:</strong></p>
            <p>The SDO DCP Inventory Management System helps schools and division offices monitor, manage, and report
                computer packages distributed under the DCP program. Ensure accurate updates and proper submission of
                inventory reports every quarter.</p>

            <p>If you have any questions, please contact the ICT Coordinator.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} SDO SCCP - DCP Inventory Team. All rights reserved.
        </div>
    </div>
</body>

</html>
