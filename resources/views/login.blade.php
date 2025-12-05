<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Softgit - Iniciar Sesión</title>

  <!-- Font Awesome + Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
                                                                                                             
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
    .login-container {
      background: #ffffff;
      border: 1px solid #c2dbff;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 440px;
      padding: 40px 35px;
      margin: 20px;
    }

    /* Header del login */
    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-header .logo-icon {
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

    .login-header h1 {
      font-size: 28px;
      font-weight: 700;
      color: #1e3a8a;
      margin: 0 0 8px;
    }

    .login-header p {
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

    /* Checkbox remember */
    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      font-size: 13px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #475569;
    }

    .remember-me input[type="checkbox"] {
      width: 16px;
      height: 16px;
      cursor: pointer;
      accent-color: #5b9de6;
    }

    .forgot-password {
      color: #5b9de6;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }

    .forgot-password:hover {
      color: #3a7edb;
      text-decoration: underline;
    }

    /* Botón de login */
    .btn-login {
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
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 24px rgba(91,157,230,0.35);
      background: linear-gradient(90deg, #5b9de6, #3a7edb);
    }

    .btn-login:active {
      transform: translateY(-1px);
    }

    /* Mensajes de error */
    .error-message {
      background-color: #fee2e2;
      border: 1px solid #fecaca;
      color: #dc2626;
      padding: 12px;
      border-radius: 10px;
      font-size: 13px;
      margin-bottom: 20px;
      display: none;
    }

    .error-message.show {
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
      .login-container {
        padding: 30px 25px;
      }

      .login-header h1 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Header -->
    <div class="login-header">
      <div class="logo-icon">
        <i class="fas fa-user-circle"></i>
      </div>
      <h1>Bienvenido a Softgit</h1>
      <p>Ingresa tus credenciales para continuar</p>
    </div>

    <!-- Mensaje de error (oculto por defecto) -->
    <div class="error-message" id="errorMessage">
      <i class="fas fa-exclamation-circle"></i> Credenciales incorrectas. Intenta nuevamente.
    </div>

    <!-- Formulario de login -->
    <form action="{{ route('login.submit') }}" method="POST">
      @csrf

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
            placeholder="Ingresa tu contraseña"
            required
          />
        </div>
        @error('password')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Remember me & Forgot password -->
      <div class="remember-forgot">
        <label class="remember-me">
          <input type="checkbox" name="remember" id="remember" />
          <span>Recuérdame</span>
        </label>
        <a href="{{ route('registro') }}" class="forgot-password">
          ¿No tienes cuenta? Regístrate
        </a>
      </div>

      <!-- Botón de login -->
      <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
      </button>
    </form>
  </div>

  <!-- Footer -->
  <footer>
    Realizado por <b>Karen Julieth Sepúlveda Sánchez</b> - <b>Vanessa García Corzo</b> | 2025
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>