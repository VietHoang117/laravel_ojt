<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Email</title>
</head>
<body>
    <div class="container">
        <h1>
            {{ $data['name'] }}
        </h1>
        <p>
            {{ $data['content'] }}
        </p>
        <p class="text-red">
            <a href="{{ $data['link'] }}" class="button">Nhấn vào đây để chuyển kênh</a>
        </p>
    </div>
</body>
</html>
