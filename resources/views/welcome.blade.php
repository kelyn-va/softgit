<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Softgit - Panel Principal</title>

  <!-- Font Awesome + Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #ffffff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      /* Azul pastel más suave */
      background: linear-gradient(90deg, #7daee8 0%, #5b9de6 100%);
      color: white;
      padding: 22px 0;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    header h1 { margin: 0; font-size: 28px; font-weight: 700; }
    header p { margin: 6px 0 0; font-size: 13px; opacity: 0.95; }

    /* Contenedor principal */
    .menu-contenedor {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      justify-items: center;
      gap: 24px;
      margin: 36px auto;
      max-width: 1300px;
      padding: 0 16px 40px;
    }

    /* Fila centrada si hay menos de 5 */
    .menu-fila-centrada {
      display: flex;
      justify-content: center;
      gap: 24px;
      flex-wrap: wrap;
      margin-top: -40px; /* 👈 sube las últimas 3 cartas */
      margin-bottom: 50px;
    }

    /* Tarjetas */
    .card-menu {
      background: linear-gradient(180deg, #f5f9ff 0%, #e3efff 100%);
      border: 1px solid #c2dbff;
      border-radius: 16px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.06);
      width: 200px;
      height: 180px;
      padding: 16px;
      text-align: center;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-menu:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 26px rgba(33,150,243,0.18);
      background: linear-gradient(180deg, #e1efff 0%, #cbe1ff 100%);
    }

    /* Iconos */
    .icono-fallback {
      font-size: 36px;
      color: #5b9de6; /* azul pastel */
      margin-bottom: 6px;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .card-menu:hover .icono-fallback {
      transform: scale(1.2);
      color: #3a7edb;
    }

    /* Títulos y texto */
    .card-menu h5 {
      font-size: 15px;
      margin: 0;
      color: #1e3a8a;
      font-weight: 600;
    }

    .card-menu .text-muted {
      font-size: 12px;
      color: #64748b;
      margin: 4px 0 0;
      line-height: 1.2;
    }

    /* Botones */
    .btn-entrar {
      background: linear-gradient(90deg, #7daee8, #5b9de6);
      color: #fff;
      padding: 6px 12px;
      border-radius: 10px;
      font-size: 13px;
      text-decoration: none;
      border: none;
      align-self: center;
      transition: transform .18s ease, box-shadow .18s ease;
      box-shadow: 0 4px 12px rgba(123,180,255,0.25);
    }

    .btn-entrar:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 18px rgba(91,157,230,0.25);
      background: linear-gradient(90deg, #5b9de6, #3a7edb);
    }

    /* Footer */
    footer {
      background: #fff;
      text-align: center;
      padding: 12px;
      color: #4b5563;
      font-size: 13px;
      border-top: 1px solid #e3f2fd;
    }

    footer b { color: #5b9de6; }
  </style>
</head>
<body>

  <header>
    <h1>Bienvenido a Softgit</h1>
    <p>Accede fácilmente a los módulos principales del sistema</p>
  </header>

  <div class="menu-contenedor">
    <!-- Fila 1 -->
    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-users"></i></div>
        <h5>Clientes</h5>
        <p class="text-muted">Gestiona los clientes del sistema.</p>
      </div>
      <a href="{{ route('clientes.index') }}" class="btn-entrar">Ir a Clientes</a>
    </div>
    

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-cubes"></i></div>
        <h5>Productos</h5>
        <p class="text-muted">Gestiona el inventario de productos.</p>
      </div>
      <a href="{{route('productos.index')}}" class="btn-entrar">Ir a Productos</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-tags"></i></div>
        <h5>Categorías</h5>
        <p class="text-muted">Organiza las categorías de productos.</p>
      </div>
      <a href="{{ route('categorias.index') }}" class="btn-entrar">Ir a Categorías</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-warehouse"></i></div>
        <h5>Inventario</h5>
        <p class="text-muted">Controla el inventario del sistema.</p>
      </div>
      <a href="{{route('inventario.index')}}" class="btn-entrar">Ir a Inventario</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-truck"></i></div>
        <h5>Proveedores</h5>
        <p class="text-muted">Gestiona el módulo de proveedores.</p>
      </div>
      <a href="{{route('proveedor.index')}}" class="btn-entrar">Ir a Proveedores</a>
    </div>

    <!-- Fila 2 -->
    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-cash-register"></i></div>
        <h5>Ventas</h5>
        <p class="text-muted">Administra las ventas realizadas.</p>
      </div>
      <a href="#" class="btn-entrar">Ir a Ventas</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-undo-alt"></i></div>
        <h5>Devoluciones</h5>
        <p class="text-muted">Controla las devoluciones de productos.</p>
      </div>
      <a href="#" class="btn-entrar">Ir a Devoluciones</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-id-badge"></i></div>
        <h5>Empleados</h5>
        <p class="text-muted">Gestiona el personal y sus datos.</p>
      </div>
      <a href="{{route('empleados.index')}}" class="btn-entrar">Ir a Empleados</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-clock"></i></div>
        <h5>Turnos</h5>
        <p class="text-muted">Administra horarios y turnos.</p>
      </div>
      <a href="{{route('turnos.index')}}" class="btn-entrar">Ir a Turnos</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-file-invoice-dollar"></i></div>
        <h5>Detalle de Venta</h5>
        <p class="text-muted">Gestiona los detalles por venta.</p>
      </div>
      <a href="#" class="btn-entrar">Ir a Detalle de Venta</a>
    </div>
  </div>

  <!-- Fila 3 centrada -->
  <div class="menu-fila-centrada">
    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-credit-card"></i></div>
        <h5>Métodos de Pago</h5>
        <p class="text-muted">Configura formas de pago aceptadas.</p>
      </div>
      <a href="#" class="btn-entrar">Ir a Métodos de Pago</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-money-bill-wave"></i></div>
        <h5>Pagos</h5>
        <p class="text-muted">Registra y revisa pagos recibidos.</p>
      </div>
      <a href="#" class="btn-entrar">Ir a Pagos</a>
    </div>

    <div class="card-menu">
      <div>
        <div class="icono-fallback"><i class="fas fa-user-shield"></i></div>
        <h5>Auditoría</h5>
        <p class="text-muted">Revisa logs y auditorías del sistema.</p>
      </div>
      <a href="{{route('Auditoria.index')}}" class="btn-entrar">Ir a Auditoría</a>
    </div>
  </div>

  <footer>
    Realizado por <b>Karen Julieth Sepúlveda Sánchez</b> - <b>Vanessa García Corzo</b> | 2025
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
