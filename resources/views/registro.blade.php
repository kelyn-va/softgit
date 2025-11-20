<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Softgit - Registro</title>

  <!-- Font Awesome + Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    body {
      background: linear-gradient(135deg, #e3efff 0%, #f5f9ff 100%);
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    /* Contenedor principal */
    .register-container {
      background: #ffffff;
      border: 1px solid #c2dbff;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 480px;
      padding: 40px 35px;
      margin: 20px;
    }

    /* Header del registro */
    .register-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .register-header .logo-icon {
      font-size: 56px;
      color: #5b9de6;
      margin-bottom: 12px;
      display: inline-block;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    .register-header h1 {
      font-size: 28px;
      font-weight: 700;
      color: #1e3a8a;
      margin: 0 0 8px;
    }

    .register-header p {
      font-size: 14px;
      color: #64748b;
      margin: 0;
    }

    /* Formulario */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-size: 14px;
      font-weight: 600;
      color: #1e3a8a;
      margin-bottom: 8px;
      display: block;
    }

    .input-wrapper {
      position: relative;
    }

    .input-wrapper i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #7daee8;
      font-size: 16px;
    }

    .form-control {
      width: 100%;
      padding: 12px 12px 12px 45px;
      border: 1.5px solid #c2dbff;
      border-radius: 12px;
      font-size: 14px;
      transition: all 0.3s ease;
      background-color: #f5f9ff;
    }

    .form-control:focus {
      outline: none;
      border-color: #5b9de6;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(91, 157, 230, 0.1);
    }

    /* Botón de registro */
    .btn-register {
      width: 100%;
      background: linear-gradient(90deg, #7daee8, #5b9de6);
      color: #fff;
      padding: 14px;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      box-shadow: 0 6px 16px rgba(123,180,255,0.3);
      margin-top: 10px;
    }

    .btn-register:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 24px rgba(91,157,230,0.35);
      background: linear-gradient(90deg, #5b9de6, #3a7edb);
    }

    .btn-register:active {
      transform: translateY(-1px);
    }

    /* Link de login */
    .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #64748b;
    }

    .login-link a {
      color: #5b9de6;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .login-link a:hover {
      color: #3a7edb;
      text-decoration: underline;
    }

    /* Mensajes de error */
    .text-danger {
      color: #dc2626;
      font-size: 12px;
      margin-top: 4px;
      display: block;
    }

    /* Indicador de fuerza de contraseña */
    .password-strength {
      margin-top: 8px;
      height: 4px;
      background-color: #e2e8f0;
      border-radius: 2px;
      overflow: hidden;
      display: none;
    }

    .password-strength-bar {
      height: 100%;
      width: 0%;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .password-strength.show {
      display: block;
    }

    .strength-weak { background-color: #ef4444; width: 33%; }
    .strength-medium { background-color: #f59e0b; width: 66%; }
    .strength-strong { background-color: #10b981; width: 100%; }

    .password-hint {
      font-size: 12px;
      color: #64748b;
      margin-top: 4px;
      display: none;
    }

    .password-hint.show {
      display: block;
    }

    /* Footer */
    footer {
      text-align: center;
      margin-top: 30px;
      color: #64748b;
      font-size: 13px;
    }

    footer b {
      color: #5b9de6;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .register-container {
        padding: 30px 25px;
      }

      .register-header h1 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>

  <div class="register-container">
    <!-- Header -->
    <div class="register-header">
      <div class="logo-icon">
        <i class="fas fa-user-plus"></i>
      </div>
      <h1>Crear Cuenta</h1>
      <p>Completa el formulario para registrarte</p>
    </div>

    <!-- Formulario de registro -->
    <form action="{{ route('registro.submit') }}" method="POST" id="registerForm">
      @csrf

      <!-- Campo Nombre -->
      <div class="form-group">
        <label for="name">Nombre Completo</label>
        <div class="input-wrapper">
          <i class="fas fa-user"></i>
          <input 
            type="text" 
            class="form-control" 
            id="name" 
            name="name" 
            placeholder="Ingresa tu nombre completo"
            value="{{ old('name') }}"
            required
          />
        </div>
        @error('name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Campo Email -->
      <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <div class="input-wrapper">
          <i class="fas fa-envelope"></i>
          <input 
            type="email" 
            class="form-control" 
            id="email" 
            name="email" 
            placeholder="ejemplo@correo.com"
            value="{{ old('email') }}"
            required
          />
        </div>
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Campo Password -->
      <div class="form-group">
        <label for="password">Contraseña</label>
        <div class="input-wrapper">
          <i class="fas fa-lock"></i>
          <input 
            type="password" 
            class="form-control" 
            id="password" 
            name="password" 
            placeholder="Mínimo 8 caracteres"
            required
          />
        </div>
        <div class="password-strength" id="passwordStrength">
          <div class="password-strength-bar" id="strengthBar"></div>
        </div>
        <small class="password-hint" id="passwordHint"></small>
        @error('password')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Campo Confirmar Password -->
      <div class="form-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <div class="input-wrapper">
          <i class="fas fa-lock"></i>
          <input 
            type="password" 
            class="form-control" 
            id="password_confirmation" 
            name="password_confirmation" 
            placeholder="Repite tu contraseña"
            required
          />
        </div>
        <small class="text-danger" id="passwordMatchError" style="display: none;">
          Las contraseñas no coinciden
        </small>
      </div>

      <!-- Botón de registro -->
      <button type="submit" class="btn-register">
        <i class="fas fa-user-check"></i> Registrarse
      </button>
    </form>

    <!-- Link a login -->
    <div class="login-link">
      ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    Realizado por <b>Karen Julieth Sepúlveda Sánchez</b> - <b>Vanessa García Corzo</b> | 2025
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Validador de fuerza de contraseña
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const passwordHint = document.getElementById('passwordHint');
    const confirmPassword = document.getElementById('password_confirmation');
    const passwordMatchError = document.getElementById('passwordMatchError');

    passwordInput.addEventListener('input', function() {
      const password = this.value;
      
      if (password.length === 0) {
        passwordStrength.classList.remove('show');
        passwordHint.classList.remove('show');
        return;
      }

      passwordStrength.classList.add('show');
      passwordHint.classList.add('show');

      // Calcular fuerza
      let strength = 0;
      if (password.length >= 8) strength++;
      if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
      if (password.match(/[0-9]/)) strength++;
      if (password.match(/[^a-zA-Z0-9]/)) strength++;

      // Actualizar barra
      strengthBar.className = 'password-strength-bar';
      if (strength <= 2) {
        strengthBar.classList.add('strength-weak');
        passwordHint.textContent = 'Contraseña débil';
        passwordHint.style.color = '#ef4444';
      } else if (strength === 3) {
        strengthBar.classList.add('strength-medium');
        passwordHint.textContent = 'Contraseña media';
        passwordHint.style.color = '#f59e0b';
      } else {
        strengthBar.classList.add('strength-strong');
        passwordHint.textContent = 'Contraseña fuerte';
        passwordHint.style.color = '#10b981';
      }
    });

    // Validar coincidencia de contraseñas
    confirmPassword.addEventListener('input', function() {
      if (this.value.length > 0) {
        if (this.value !== passwordInput.value) {
          passwordMatchError.style.display = 'block';
          this.style.borderColor = '#ef4444';
        } else {
          passwordMatchError.style.display = 'none';
          this.style.borderColor = '#10b981';
        }
      } else {
        passwordMatchError.style.display = 'none';
        this.style.borderColor = '#c2dbff';
      }
    });

    // Validar formulario antes de enviar
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      if (passwordInput.value !== confirmPassword.value) {
        e.preventDefault();
        passwordMatchError.style.display = 'block';
        confirmPassword.focus();
      }
    });
  </script>
</body>
</html>