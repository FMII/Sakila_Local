<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | Sakila</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
        }

        .login-box {
            max-width: 650px;
            width: 90%;
            margin: 0 auto;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .login-logo {
            margin-bottom: 25px;
        }

        .login-logo a {
            color: #ffffff;
            font-size: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }

        .login-card-body {
            border-radius: 15px;
            padding: 40px;
        }

        .login-box-msg {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            padding: 12px 15px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #3a5ccc;
            border-color: #3a5ccc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            background-color: #f8f9fc;
        }

        .form-control {
            padding: 12px;
            font-size: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            border-color: #bac8f3;
        }

        .links-container {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eee;
        }

        .logo-image {
            max-width: 120px;
            margin-bottom: 15px;
        }

        /* Estilo para enlaces */
        .links-container a {
            font-size: 1.05rem;
            color: #4e73df;
            transition: color 0.3s;
        }

        .links-container a:hover {
            color: #3a5ccc;
            text-decoration: none;
        }

        /* Para que los elementos dentro del formulario respiren mejor */
        .input-group {
            margin-bottom: 25px !important;
        }

        .btn-submit {
            margin-top: 10px;
        }

        /* Estilos para mensajes de error */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .is-invalid {
            border-color: #e74a3b !important;
        }

        .invalid-feedback {
            display: block;
            color: #e74a3b;
            margin-top: -15px;
            margin-bottom: 15px;
            font-size: 0.85rem;
        }

        /* Icono para alerta de credenciales */
        .credentials-error-icon {
            margin-right: 8px;
            color: #721c24;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- Puedes agregar un logo aquí -->
            <!-- <img src="/path/to/logo.png" alt="Logo" class="logo-image"> -->
            <a href="#"><b>Sakila</b> Login</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>

                @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
                @endif

                @if ($errors->has('credentials'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle credentials-error-icon"></i>
                    {{ $errors->first('credentials') }}
                </div>
                @elseif ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('login.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-4">
                        <input type="email" class="form-control {{ $errors->has('email') || $errors->has('credentials') ? 'is-invalid' : '' }}"
                            name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-4">
                        <input type="password" class="form-control {{ $errors->has('password') || $errors->has('credentials') ? 'is-invalid' : '' }}"
                            name="password" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-submit">Entrar</button>
                        </div>
                    </div>
                </form>

                <div class="links-container text-center">
                    <p class="mb-1">
                        <a href="#" id="forgot-password-link">¿Olvidaste tu contraseña?</a>
                    </p>
                </div>
                <!-- Añade un formulario oculto para el restablecimiento de contraseña -->
                <form id="reset-password-form" action="{{ route('resetPassword') }}" method="post" style="display: none;">
                    @csrf
                    <input type="hidden" name="email" id="reset-email">
                             
                </form>
            </div>
        </div>

        <div class="text-center mt-3">
            <p style="color: white;">© 2025 Sakila - Todos los derechos reservados</p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        // Animación simple para el formulario
        $(document).ready(function() {
            $('.login-card-body').hide().fadeIn(1000);
            $('#forgot-password-link').click(function(e) {
                e.preventDefault();

                // Obtener el email del formulario principal
                var email = $('input[name="email"]').val();


                // Establecer el email en el formulario de restablecimiento
                $('#reset-email').val(email);

                // Enviar el formulario de restablecimiento
                $('#reset-password-form').submit();
            });
        });
    </script>
</body>

</html>