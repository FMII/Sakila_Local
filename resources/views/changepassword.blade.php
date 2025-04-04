<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña | Sakila</title>
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
        
        .password-box {
            max-width: 650px;
            width: 90%;
            margin: 0 auto;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding-top: 40px;
        }
        
        .password-logo {
            margin-bottom: 25px;
        }
        
        .password-logo a {
            color: #ffffff;
            font-size: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        .card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }
        
        .card-body {
            border-radius: 15px;
            padding: 40px;
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
        
        .btn-secondary {
            padding: 12px 15px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-control {
            padding: 12px;
            font-size: 1rem;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            border-color: #bac8f3;
        }
        
        .input-group {
            margin-bottom: 25px !important;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 3px;
            transition: all 0.3s ease;
            width: 0%;
        }
        
        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .invalid-feedback {
            display: block;
            color: #e74a3b;
            margin-top: -15px;
            margin-bottom: 15px;
            font-size: 0.85rem;
        }
    </style>
</head>

<body class="hold-transition">
    <div class="password-box d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="password-logo text-center">
                <a href="#"><b>Sakila</b> Cambio de Contraseña</a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>{{ session('success') }}</strong>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>{{ session('error') }}</strong>
            </div>
            @endif

            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        <i class="fas fa-key mr-2"></i>
                        Actualizar Contraseña
                    </h3>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('updatePassword', ['user' => $user->staff_id]) }}" id="password-form">
                        @csrf
                        
                        <div class="form-group">
                            <label for="password">Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="password-strength bg-secondary mt-2"></div>
                            <small id="passwordStrengthText" class="form-text text-muted">
                                La contraseña debe tener al menos 8 caracteres y contener letras, números y caracteres especiales.
                            </small>
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" data-target="password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save mr-1"></i> Actualizar Contraseña
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-arrow-left mr-1"></i> Volver al Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p style="color: white;">© 2025 Sakila - Todos los derechos reservados</p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
    <script>
        $(document).ready(function() {
           
            $('.card').hide().fadeIn(1000);
            
            
            $('.toggle-password').click(function() {
                const targetId = $(this).data('target');
                const input = $('#' + targetId);
                const icon = $(this).find('i');
                
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
            
          
            $('#password, #password_confirmation').on('keyup', function() {
                if ($('#password').val() && $('#password_confirmation').val()) {
                    if ($('#password').val() != $('#password_confirmation').val()) {
                        $('#password_confirmation').addClass('is-invalid');
                        if (!$('#password_confirmation').siblings('.invalid-feedback').length) {
                            $('#password_confirmation').after('<div class="invalid-feedback">Las contraseñas no coinciden</div>');
                        }
                    } else {
                        $('#password_confirmation').removeClass('is-invalid').addClass('is-valid');
                        $('#password_confirmation').siblings('.invalid-feedback').remove();
                    }
                }
            });
            
            
            $('#password').on('keyup', function() {
                const password = $(this).val();
                let strength = 0;
                const $strengthBar = $('.password-strength');
                const $strengthText = $('#passwordStrengthText');
                
                if (password.length > 7) strength += 1;
                if (password.match(/[A-Z]/)) strength += 1;
                if (password.match(/[a-z]/)) strength += 1;
                if (password.match(/[0-9]/)) strength += 1;
                if (password.match(/[^A-Za-z0-9]/)) strength += 1;
                
                switch (strength) {
                    case 0:
                        $strengthBar.css('width', '0%').removeClass().addClass('password-strength bg-secondary');
                        $strengthText.text('La contraseña debe tener al menos 8 caracteres y contener letras, números y caracteres especiales.');
                        break;
                    case 1:
                        $strengthBar.css('width', '20%').removeClass().addClass('password-strength bg-danger');
                        $strengthText.text('Contraseña muy débil');
                        break;
                    case 2:
                        $strengthBar.css('width', '40%').removeClass().addClass('password-strength bg-warning');
                        $strengthText.text('Contraseña débil');
                        break;
                    case 3:
                        $strengthBar.css('width', '60%').removeClass().addClass('password-strength bg-info');
                        $strengthText.text('Contraseña media');
                        break;
                    case 4:
                        $strengthBar.css('width', '80%').removeClass().addClass('password-strength bg-primary');
                        $strengthText.text('Contraseña fuerte');
                        break;
                    case 5:
                        $strengthBar.css('width', '100%').removeClass().addClass('password-strength bg-success');
                        $strengthText.text('Contraseña muy fuerte');
                        break;
                }
            });
            
           
            $('#password-form').on('submit', function(e) {
                if ($('#password').val() !== $('#password_confirmation').val()) {
                    e.preventDefault();
                    $('#password_confirmation').addClass('is-invalid');
                    if (!$('#password_confirmation').siblings('.invalid-feedback').length) {
                        $('#password_confirmation').after('<div class="invalid-feedback">Las contraseñas no coinciden</div>');
                    }
                }
            });
        });
    </script>
</body>
</html>