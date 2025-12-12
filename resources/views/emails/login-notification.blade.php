<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Notification - Alizo</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 40px 30px;
        }
        .content h2 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content p {
            color: #666666;
            line-height: 1.6;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .info-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #667eea;
            margin: 20px 0;
        }
        .info-box p {
            margin: 5px 0;
            color: #333333;
        }
        .alert-box {
            background-color: #fff3cd;
            padding: 15px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
        .alert-box p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #999999;
            font-size: 14px;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🔐 Login Notification</h1>
        </div>
        
        <div class="content">
            <h2>Hello {{ $user->name ?? $user->first_name }}!</h2>
            
            <p>We noticed a new login to your <strong>Alizo</strong> account.</p>
            
            <div class="info-box">
                <p><strong>Login Details:</strong></p>
                <p>📅 Time: <strong>{{ $loginTime }}</strong></p>
                <p>🌐 IP Address: <strong>{{ $ipAddress }}</strong></p>
                <p>✉️ Email: <strong>{{ $user->email }}</strong></p>
            </div>
            
            <p>If this was you, you can safely ignore this email.</p>
            
            <div class="alert-box">
                <p><strong>⚠️ Didn't recognize this login?</strong></p>
                <p>If you didn't log in at this time, please secure your account immediately by changing your password and contacting our support team.</p>
            </div>
            
            <p>For your security, we recommend:</p>
            <ul style="color: #666666; line-height: 1.8;">
                <li>Use a strong, unique password</li>
                <li>Never share your password with anyone</li>
                <li>Log out from shared or public devices</li>
            </ul>
            
            <p>Thank you for using Alizo!</p>
            <p style="margin-top: 20px;">
                <strong>The Alizo Security Team</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Alizo. All rights reserved.</p>
            <p>
                <a href="{{ config('app.url') }}">Visit Website</a> | 
                <a href="mailto:{{ config('mail.from.address') }}">Contact Support</a>
            </p>
            <p style="margin-top: 10px; font-size: 12px;">
                This is an automated security notification. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
