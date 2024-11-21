<!-- resources/views/emails/checkin_reminder.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Check-in Reminder</title>
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
            background-color: #4CAF50;
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
            <h2>Check-in Reminder</h2>
        </div>
        <div class="content">
            <p>Hello, {{ $user->name }},</p>
            <p>This is a reminder to check in to work at your scheduled time: <strong>{{ $user->custom_checkin_time ?? '08:00' }}</strong>.</p>
            <p>Please make sure to check in on time to avoid any issues.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
