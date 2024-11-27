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
    <h1>Kính Gửi: {{$data['name']}}</h1>
    <p>{{$data['content']}}</p>
</body>
</html>
