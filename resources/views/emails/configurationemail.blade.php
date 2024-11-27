<!-- resources/views/emails/checkin_reminder.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Nhắc Nhở Check-in (Đừng Lười!)</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #333;
            background-color: #ffe0b3;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px dashed #ff6347;
            border-radius: 10px;
            background-color: #fffbe6;
        }
        .header {
            text-align: center;
            background-color: #ffcc00;
            color: #333;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            font-size: 18px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #555;
            margin-top: 10px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #ff6347;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .button:hover {
            background-color: #ff4500;
        }
        .emoji {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            🕒 **Nhắc Nhở Check-in Cực Quan Trọng!** 🕒
        </div>
        <div class="content">
            <p><strong>Kính Gửi: {{$data['name']}}</strong>,</p>
            <p>Đồng hồ đã điểm, hãy nhanh tay check-in kẻo trễ giờ nha! ⏰</p>
            <p>Đừng để hệ thống phải khóc vì bạn quên check-in đấy! 😢</p>
            <a href="{{$data['checkin_url']}}" class="button">👉 Check-in Ngay 👈</a>
            <p class="emoji">🚀 Làm xong rồi thì nhớ ngồi thưởng trà thư giãn nhé! ☕</p>
        </div>
        <div class="footer">
            <p>Nhắc nhở này được gửi từ hệ thống. Đừng cố gắng lơ nó, vì nó sẽ quay lại! 🤖</p>
        </div>
    </div>
</body>
</html>
