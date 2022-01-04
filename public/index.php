<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApartadoController;
use Controllers\APIController;
use Controllers\LoginController;
use Controllers\ComponenteController;
use Controllers\UsuarioController;
use MVC\Router;

$router = new Router();

// Iniciar Sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// AREA PRIVADA
$router->get('/apartado', [ApartadoController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);
$router->post('/admin/actualizar', [AdminController::class, 'actualizar']);
$router->post('/admin/eliminar', [AdminController::class, 'eliminar']);

$router->get('/usuarios', [UsuarioController::class, 'index']);
$router->post('/usuarios/admin', [UsuarioController::class, 'admin']);
$router->post('/usuarios/eliminar', [UsuarioController::class, 'eliminar']);

// API de Apartados
$router->get('/api/componentes', [APIController::class, 'index']);
$router->get('/api/apartados', [APIController::class, 'apartadosComponentes']);
$router->post('/api/apartados', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD de Componentes
$router->get('/inventario', [ComponenteController::class, 'index']);
$router->get('/inventario/crear', [ComponenteController::class, 'crear']);
$router->post('/inventario/crear', [ComponenteController::class, 'crear']);
$router->get('/inventario/actualizar', [ComponenteController::class, 'actualizar']);
$router->post('/inventario/actualizar', [ComponenteController::class, 'actualizar']);
$router->post('/inventario/eliminar', [ComponenteController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
