<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlmaceneController;
use App\Http\Controllers\ProveedoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Compra_productoController;
use App\Http\Controllers\Ver_detalle_productoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\Unidad_productoController;
use App\Http\Controllers\Grupo_clienteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CotizacioneController;
use App\Http\Controllers\PDFController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::redirect('/','login');

Route::resource('categorias',CategoriaController::class)->names('categorias');
Route::resource('almacenes',AlmaceneController::class)->names('almacenes');
Route::resource('proveedores',ProveedoreController::class)->names('proveedores');
Route::resource('marcas',MarcaController::class)->names('marcas');
Route::resource('unidades',Unidad_productoController::class)->names('unidades');

//Rutas del modulo de administracion de Clientes
Route::resource('grupo_clientes', Grupo_clienteController::class)->names('grupo_clientes');
Route::resource('clientes', ClienteController::class)->names('clientes');
Route::post('rclientes', [ClienteController::class, 'registrar_cliente'])->name('rclientes.registrar_cliente');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Rutas del modulo de Administracion de Usuarios y Roles
Route::resource('users', UserController::class)->names('users');
Route::resource('personas', PersonaController::class)->names('personas');
Route::resource('roles', RoleController::class)->names('roles');
Route::get('asignar/{user}', [UserController::class,'asignar_roles'])->name('asignar.asignar_roles');

//ruta de Admin Productos
Route::resource('productos', ProductoController::class)->names('productos')->middleware('auth');
Route::post('rproductos', [ProductoController::class, 'registrar'])->name('rproductos.registrar');
Route::resource('verproductos', Ver_detalle_productoController::class)->names('verproductos');

//Rutas del Modulo Admin Compras Ingreso de productos
Route::resource('compra_productos', Compra_productoController::class)->names('compra_productos');
Route::post('buscar_proveedor', [Compra_productoController::class, 'search'])->name('buscar_proveedor.search');
Route::get('buscar_producto/{producto}', [Compra_productoController::class, 'bproducto'])->name('buscar_producto.bproducto');
Route::get('generar_pdf/{compra}', [Compra_productoController::class, 'generarPDF'])->name('generar_pdf.generarPDF');

//Rutas del Modulo de Admin Ventas Salida de Productos
Route::post('buscar_cliente', [VentaController::class, 'search'])->name('buscar_cliente.search');
Route::get('buscar_producto_venta/{producto}', [VentaController::class, 'bproducto'])->name('buscar_producto_venta.bproducto');
Route::resource('ventas', VentaController::class)->names('ventas');

//ruta de generar cotizaciones
Route::resource('cotizaciones', CotizacioneController::class)->names('cotizaciones');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('home','dashboard');

Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview');
Route::get('pdf/generate', [PDFController::class, 'generatePDF'])->name('pdf.generate');
