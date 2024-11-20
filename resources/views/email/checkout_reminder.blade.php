<!-- resources/views/emails/checkout_reminder.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Check-out Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            background-color: #2196F3;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Check-out Reminder</h2>
        </div>
        <div class="content">
            <p>Hello, {{ $user->name }},</p>
            <p>This is a reminder to check out of work at your scheduled time: <strong>{{ $user->custom_checkout_time ?? '17:00' }}</strong>.</p>
            <p>Please ensure you check out on time to complete your workday records.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
