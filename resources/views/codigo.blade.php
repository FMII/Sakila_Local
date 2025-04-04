<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificación de dos factores | Sakila</title>
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
        .verification-box {
            max-width: 550px;
            width: 90%;
            margin: 0 auto;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .verification-logo {
            margin-bottom: 25px;
        }
        .verification-logo a {
            color: #ffffff;
            font-size: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }
        .verification-card-body {
            border-radius: 15px;
            padding: 40px;
        }
        .verification-box-msg {
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-control {
            padding: 12px;
            font-size: 1.1rem;
            text-align: center;
            letter-spacing: 5px;
            font-weight: bold;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.25);
            border-color: #bac8f3;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
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
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 0.85rem;
        }
        .code-instructions {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }
        .code-timer {
            font-size: 1.1rem;
            color: #4e73df;
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }
        .code-group {
            max-width: 250px;
            margin: 0 auto 25px;
        }
    </style>
</head>
<body class="hold-transition verification-page">
    <div class="verification-box">
        <div class="verification-logo">
            <a href="#"><b>Sakila</b> Verificación</a>
        </div>

        <div class="card">
            <div class="card-body verification-card-body">
                <div class="text-center mb-4">
                    <i class="fas fa-shield-alt fa-4x text-primary mb-3"></i>
                    <h3>Verificación de dos factores</h3>
                </div>
                
                <p class="verification-box-msg">
                    Hemos enviado un código de verificación a tu correo electrónico.
                </p>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i> Por razones de seguridad, ingresa el código de 6 dígitos enviado para continuar.
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('twofa', ['user' => $user->staff_id]) }}" method="post">
                    @csrf
                    <div class="code-group">
                        <div class="input-group">
                            <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" 
                                   placeholder="000000" maxlength="6" inputmode="numeric" pattern="[0-9]*" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="code-timer">
                        <i class="fas fa-stopwatch"></i> <span id="countdown">05:00</span>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-lock-open mr-2"></i> Verificar y continuar
                            </button>
                        </div>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="mb-1">
                        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
                    </p>
                    <p class="mb-0">
                        <a href="#" id="resendCode" data-user="{{ $user->staff_id }}">No recibí mi código, reenviar</a>
                    </p>
                </div>
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
        // Animación de entrada
        $(document).ready(function() {
            $('.verification-card-body').hide().fadeIn(1000);
            
            // Configurar CSRF token para solicitudes AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Contador regresivo de 5 minutos
            let timeLeft = 5 * 60; // 5 minutos en segundos
            
            function updateCountdown() {
                const minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                $('#countdown').text(`${minutes}:${seconds}`);
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    $('#countdown').html('<span class="text-danger">Tiempo expirado</span>');
                    $('button[type="submit"]').prop('disabled', true).addClass('btn-secondary').removeClass('btn-primary');
                }
                timeLeft--;
            }
            
            // Actualizar cada segundo
            updateCountdown();
            const timer = setInterval(updateCountdown, 1000);
            
            // Formatear automáticamente el campo de entrada
            $('input[name="code"]').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            
            // Manejar el reenvío de código
            $('#resendCode').on('click', function(e) {
                e.preventDefault();
                const userId = $(this).data('user');
                
                // Mostrar mensaje de carga
                $(this).html('<i class="fas fa-spinner fa-spin"></i> Enviando código...');
                const $button = $(this);
                
                $.ajax({
                    url: `/resend-code/${userId}`,
                    method: 'POST',
                    success: function(response) {
                        // Restaurar texto original del botón
                        $button.html('No recibí mi código, reenviar');
                        
                        // Mostrar mensaje de éxito
                        $('<div class="alert alert-success mt-3">')
                            .html('<i class="fas fa-check-circle mr-2"></i> Se ha enviado un nuevo código a tu correo electrónico.')
                            .insertAfter($button.parent());
                        
                        // Desaparecer el mensaje después de 5 segundos
                        setTimeout(function() {
                            $('.alert-success').fadeOut(500, function() {
                                $(this).remove();
                            });
                        }, 5000);
                        
                        // Reiniciar temporizador
                        timeLeft = 5 * 60;
                        $('button[type="submit"]').prop('disabled', false).addClass('btn-primary').removeClass('btn-secondary');
                    },
                    error: function(xhr) {
                        // Restaurar texto original del botón
                        $button.html('No recibí mi código, reenviar');
                        
                        // Mostrar mensaje de error
                        let errorMsg = 'Error al reenviar el código. Por favor, inténtalo nuevamente.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMsg = xhr.responseJSON.error;
                        }
                        
                        $('<div class="alert alert-danger mt-3">')
                            .html('<i class="fas fa-exclamation-circle mr-2"></i>' + errorMsg)
                            .insertAfter($button.parent());
                        
                        // Desaparecer el mensaje después de 5 segundos
                        setTimeout(function() {
                            $('.alert-danger').fadeOut(500, function() {
                                $(this).remove();
                            });
                        }, 5000);
                    }
                });
            });
        });
    </script>
</body>
</html>