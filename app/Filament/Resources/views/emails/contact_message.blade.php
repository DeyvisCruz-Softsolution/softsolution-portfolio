<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje</title>
</head>
<body>
    <h2>📬 Nuevo mensaje recibido</h2>
    <p><strong>Nombre:</strong> {{ $messageData->name }}</p>
    <p><strong>Email:</strong> {{ $messageData->email }}</p>
    <p><strong>Asunto:</strong> {{ $messageData->subject }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $messageData->message }}</p>
</body>
</html>
