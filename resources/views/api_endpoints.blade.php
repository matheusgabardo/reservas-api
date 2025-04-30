<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Endpoints</title>
    <style>
        body { font-family: Arial, sans-serif; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Endpoints da API</h1>

    <h2>Login</h2>
    <p>Fazer login e obter um token:</p>
    <pre>
        POST /api/login
        Content-Type: application/json

        {
            "email": "usuario@example.com",
            "password": "senha123"
        }
    </pre>
</body>
</html>
