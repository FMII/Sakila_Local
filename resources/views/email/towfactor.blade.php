<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Código de Autenticación de Dos Factores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #4e73df;
            color: #ffffff;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .code {
            font-size: 28px;
            font-weight: bold;
            color: #4e73df;
            margin: 25px 0;
            letter-spacing: 5px;
            padding: 15px;
            background-color: #f8f9fc;
            border-radius: 10px;
            display: inline-block;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #f4f4f4;
            color: #777777;
        }
        .logo {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verificación de Dos Factores</h1>
        </div>
        <div class="content">
            <div class="logo">
                <!-- <img src="URL_DE_TU_LOGO" alt="Sakila Logo" width="120"> -->
            </div>
            <p>Hola {{ $user->name }},</p>
            <p>Utiliza el siguiente código de verificación:</p>
            <div class="code">{{ $code }}</div>
            <p>Este código expirará en 5 minutos. Si no has solicitado este código, por favor ignora este correo.</p>
            <p>No compartas este código con nadie, incluyendo el personal de Sakila.</p>
        </div>
        <div class="footer">
            <p>Gracias por usar Sakila</p>
            <p>&copy; 2025 Sakila - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>