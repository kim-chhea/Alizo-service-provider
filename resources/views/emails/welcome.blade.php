<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Alizo</title>
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
            font-size: 32px;
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
        .highlight {
            background-color: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #667eea;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
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
            <h1>🎉 Welcome to Alizo</h1>
        </div>
        
        <div class="content">
            <h2>Hello {{ $user->name ?? $user->first_name }}! 👋</h2>
            
            <p>Thank you for joining <strong>Alizo</strong>! We're thrilled to have you as part of our community.</p>
            
            <div class="highlight">
                <p style="margin: 0; color: #333333;">
                    <strong>Your account has been successfully created!</strong><br>
                    Email: <strong>{{ $user->email }}</strong>
                </p>
            </div>
            
            <p>With Alizo, you can:</p>
            <ul style="color: #666666; line-height: 1.8;">
                <li>Browse and book professional services</li>
                <li>Manage your bookings and wishlist</li>
                <li>Connect with service providers</li>
                <li>Leave reviews and ratings</li>
            </ul>
            
            <p>We're here to help you get the best service experience possible.</p>
            
            <center>
                <a href="{{ config('app.url') }}" class="button">Get Started</a>
            </center>
            
            <p>If you have any questions, feel free to reach out to our support team.</p>
            
            <p>Welcome aboard!</p>
            <p style="margin-top: 20px;">
                <strong>The Alizo Team</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Alizo. All rights reserved.</p>
            <p>
                <a href="{{ config('app.url') }}">Visit Website</a> | 
                <a href="mailto:{{ config('mail.from.address') }}">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
