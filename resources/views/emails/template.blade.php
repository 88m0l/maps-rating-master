<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>بلاغ جديد</title>
</head>
<body>
    <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
    <p><strong>البريد الإلكتروني:</strong> {{ $data['email'] }}</p>
    <p><strong>رابط الموقع:</strong> <a href="{{ $data['place_url'] }}">{{ $data['place_url'] }}</a></p>

</body>
</html>
