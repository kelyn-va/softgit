<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Softgit - Panel Principal</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    /* 🎨 Estilos Generales */
    body {
      background-color: #eef7fc; 
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      color: #333333;
      display: flex; 
      flex-direction: column;
      align-items: center; 
      justify-content: center; 
      min-height: 100vh; 
    }

    /* 🌟 Contenedor Principal */
    .contenedor-principal {
      background-color: #ffffff;
      max-width: 1100px; 
      width: 90%; 
      margin: 25px auto; 
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18); 
      border-radius: 20px; 
      overflow: hidden;
      
      display: flex; 
      flex-wrap: wrap; 
      min-height: 650px; 
    }

    /* 🔵 Sección de Bienvenida */
    .hero-header {
      background: linear-gradient(135deg, #a7d9e4 0%, #76bada 100%); 
      padding: 35px; 
      display: flex;
      flex-direction: column;
      align-items: center; 
      justify-content: center; 
      position: relative;
      overflow: hidden;
      border-right: 5px solid #5b9de6; 
      box-sizing: border-box; 
      text-align: center; 

      flex: 1; 
      min-width: 380px; 
      max-width: 40%; 
    }
    
    /* Efecto de burbujas en el header */
    .hero-header::before, .hero-header::after {
        content: '';
        position: absolute;
        background-color: rgba(255, 255, 255, 0.25); 
        border-radius: 50%;
        z-index: 0;
    }
    .hero-header::before {
        width: 150px; height: 150px; top: -60px; right: -60px;
    }
    .hero-header::after {
        width: 90px; height: 90px; bottom: -30px; left: -30px;
    }

    .hero-header .logo-container {
      background-color: #f0f8fa; 
      border-radius: 50%;
      padding: 10px; 
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); 
      margin-bottom: 20px; 
      display: flex; 
      flex-direction: column; 
      align-items: center;
      justify-content: center;
      position: relative; z-index: 1;
      
      width: 180px; 
      height: 180px;
      animation: bounceFloat 1s ease-in-out infinite; /* Animación de salto rápida */
    }
    
    /* Estilos para el texto "Softgit" dentro del logo */
    .hero-header .logo-text-inner {
      font-family: 'Roboto', sans-serif; /* Fuente Roboto, no cursiva */
      font-size: 45px; /* Tamaño del texto "Softgit" */
      color: #337ab7; /* Color azul para Softgit */
      font-weight: 700;
      line-height: 1;
      text-align: center;
    }

    /* Definición de la animación de salto */
    @keyframes bounceFloat {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-15px); } /* Se mueve 15px hacia arriba */
    }

    .hero-header h1 {
      font-size: 40px; 
      font-weight: 700;
      color: #333333; 
      margin-bottom: 8px;
      position: relative; z-index: 1;
      letter-spacing: 0.8px; 
    }
    
    .hero-header .subtitulo {
        font-size: 15px; 
        font-weight: 400; 
        color: #555555; 
        margin-top: 5px;
        margin-bottom: 25px;
        position: relative; z-index: 1;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .hero-header p {
      font-size: 15px; 
      color: #555555; 
      line-height: 1.6;
      max-width: 420px; 
      margin-top: 15px;
      position: relative; z-index: 1;
    }
    
    /* 🎨 Estilos del Menú */
    .menu-contenedor {
      flex: 1; 
      min-width: 550px; 
      max-width: 60%; 
      
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
      gap: 20px; 
      padding: 35px; 
      box-sizing: border-box;
      background-color: #ffffff; 
    }

    .card-menu {
      background: linear-gradient(145deg, #e3f2f7 0%, #c1e0e8 100%); 
      border: 1px solid #a7d9e4; 
      border-radius: 15px; 
      box-shadow: 0 5px 18px rgba(0,0,0,0.1); 
      padding: 20px; 
      text-align: center;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 170px; 
    }

    .card-menu:hover {
      transform: translateY(-5px); 
      box-shadow: 0 12px 25px rgba(91,157,230,0.2); 
      border-color: #5b9de6; 
      background: linear-gradient(145deg, #c1e0e8 0%, #9bcada 100%); 
    }

    .icono-fallback {
      font-size: 40px; 
      color: #3498db; 
      margin-bottom: 8px;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .card-menu:hover .icono-fallback {
      transform: scale(1.1); 
      color: #217dbb;
    }

    .card-menu h5 {
      font-size: 15px; 
      margin: 0;
      color: #333333; 
      font-weight: 600; 
    }

    .card-menu .text-muted {
      font-size: 12px; 
      color: #666666; 
      margin: 4px 0 8px;
      line-height: 1.3;
    }

    .btn-entrar {
      background: linear-gradient(90deg, #64b5f6, #42a5f5); 
      color: #fff;
      padding: 6px 15px; 
      border-radius: 8px; 
      font-size: 12px; 
      text-decoration: none;
      border: none;
      align-self: center;
      transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
      box-shadow: 0 4px 12px rgba(91,157,230,0.3);
      font-weight: 500;
    }

    .btn-entrar:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 15px rgba(91,157,230,0.4);
      background: linear-gradient(90deg, #42a5f5, #2196f3);
      opacity: 0.9;
    }

    /* 🦶 Estilos del Footer */
    footer {
      background: #eef7fc; 
      text-align: center;
      padding: 15px; 
      color: #6a7c8c; 
      font-size: 13px; 
      border-top: 1px solid #d4edf6; 
      border-radius: 0 0 20px 20px; 
      width: 90%; 
      max-width: 1100px; 
      margin-top: -25px; 
      z-index: -1; 
      position: relative; 
    }

    footer b { color: #5b9de6; }

    /* 📱 Media Queries para Responsividad */
    @media (max-width: 1150px) {
        .contenedor-principal {
            max-width: 900px; 
            min-height: 600px;
        }
        .hero-header {
            min-width: 320px;
            max-width: 45%;
            padding: 30px;
        }
        .menu-contenedor {
            min-width: 450px;
            max-width: 55%;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 18px;
            padding: 30px;
        }
        .hero-header .logo-container {
            width: 160px;
            height: 160px;
            padding: 10px; 
        }
        .hero-header .logo-text-inner {
            font-size: 40px; 
        }
        .hero-header h1 {
            font-size: 36px;
        }
        .card-menu {
            height: 160px;
            padding: 18px;
        }
        .icono-fallback {
            font-size: 36px;
        }
        footer {
            max-width: 900px;
        }
    }
    
    @media (max-width: 768px) {
        .contenedor-principal {
            flex-direction: column; 
            min-height: unset; 
            margin: 15px auto;
            border-radius: 12px;
            width: calc(100% - 30px); 
        }
        .hero-header, .menu-contenedor {
            max-width: 100%; 
            min-width: unset; 
            border-right: none; 
            border-bottom: 4px solid #6cb3e0; 
        }
        .hero-header {
            padding: 25px 18px; 
        }
        .hero-header .logo-container { 
            width: 150px;
            height: 150px;
            padding: 8px;
        }
        .hero-header .logo-text-inner { 
            font-size: 35px;
        }
        .menu-contenedor {
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); 
            gap: 12px;
            padding: 20px;
        }
        .card-menu {
            height: 150px;
        }
        footer {
            max-width: calc(100% - 30px);
            border-radius: 0 0 12px 12px; 
            margin-top: -10px; 
        }
    }

    @media (max-width: 576px) {
        .menu-contenedor {
            grid-template-columns: repeat(2, 1fr); 
            gap: 10px;
            padding: 15px;
        }
        .hero-header {
            padding: 20px 10px;
        }
        .hero-header .logo-container {
            width: 120px; 
            height: 120px;
            padding: 5px;
        }
        .hero-header .logo-text-inner {
            font-size: 30px; 
        }
        .hero-header h1 {
            font-size: 28px;
        }
        .contenedor-principal {
            margin: 0;
            border-radius: 0;
            box-shadow: none;
            width: 100%;
        }
        footer {
            width: 100%;
            border-radius: 0;
            margin-top: 0;
        }
    }

  </style>
</head>

<body>

  <div class="contenedor-principal">
    
    <div class="hero-header">
      
      <div class="logo-container">
        <span class="logo-text-inner">Softgit</span>
      </div>

      <h1>Bienvenido a Softgit</h1>
     
      <p>
        Softgit es un sistema diseñado para gestionar y controlar de forma eficiente el inventario, los productos, las ventas y los proveedores.
        Centraliza toda la información en un solo lugar, facilitando la administración del negocio y mejorando la organización en cada proceso.
        Con Softgit podrás llevar un control preciso de tu mercancía y agilizar las operaciones del día a día de manera rápida, sencilla y confiable.
      </p>
    </div>

    <div class="menu-contenedor">

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-cubes"></i></div>
          <h5>Productos</h5>
          <p class="text-muted">Gestiona el inventario.</p>
        </div>
        <a href="{{route('productos.index')}}" class="btn-entrar">Ir a Productos</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-tags"></i></div>
          <h5>Categorías</h5>
          <p class="text-muted">Organiza las categorías.</p>
        </div>
        <a href="{{ route('categorias.index') }}" class="btn-entrar">Ir a Categorías</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-warehouse"></i></div>
          <h5>Inventario</h5>
          <p class="text-muted">Controla el stock.</p>
        </div>
        <a href="{{route('inventario.index')}}" class="btn-entrar">Ir a Inventario</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-truck"></i></div>
          <h5>Proveedores</h5>
          <p class="text-muted">Gestiona proveedores.</p>
        </div>
        <a href="{{route('proveedor.index')}}" class="btn-entrar">Ir a Proveedores</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-cash-register"></i></div>
          <h5>Ventas</h5>
          <p class="text-muted">Administra las ventas.</p>
        </div>
        <a href="{{route('ventas.index')}}" class="btn-entrar">Ir a Ventas</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-undo-alt"></i></div>
          <h5>Devoluciones</h5>
          <p class="text-muted">Controla devoluciones.</p>
        </div>
        <a href="#" class="btn-entrar">Ir a Devoluciones</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-file-invoice-dollar"></i></div>
          <h5>Detalle Venta</h5>
          <p class="text-muted">Detalles por venta.</p>
        </div>
        <a href="{{route('DetalleVenta.index')}}" class="btn-entrar">Ir a Detalle Venta</a>
      </div>

      <div class="card-menu">
        <div>
          <div class="icono-fallback"><i class="fas fa-user"></i></div>
          <h5>Empleados</h5>
          <p class="text-muted">Gestiona empleados.</p>
        </div>
        <a href="{{route('empleados.index')}}" class="btn-entrar">Ir a Empleados</a>
      </div>

    </div>
  </div>

  <footer>
    Realizado por <b>Karen Julieth Sepúlveda Sánchez</b> - <b>Vanessa García Corzo</b> | 2025
  </footer>

</body>
</html>