<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Sub_categoriaController;
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
use App\Http\Controllers\Reporte_ventasController;
use App\Http\Controllers\Reporte_comprasController;
use App\Http\Controllers\Datos_empresaController;
use App\Http\Controllers\Imprimir_codigoController;
use App\Http\Controllers\Ajuste_cantidad_productoController;
use App\Http\Controllers\Reporte_productosController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::redirect('/','login');

Route::resource('categorias',CategoriaController::class)->names('categorias')->middleware('auth');
Route::resource('sub_categorias',Sub_categoriaController::class)->names('sub_categorias')->middleware('auth');
Route::get('mSubCategorias/{categoria}', [Sub_categoriaController::class, 'mostrar_subcategorias'])->name('mSubCategorias.mostrar_subcategorias');

Route::resource('almacenes',AlmaceneController::class)->names('almacenes')->middleware('auth');
Route::resource('proveedores',ProveedoreController::class)->names('proveedores')->middleware('auth');
Route::resource('marcas',MarcaController::class)->names('marcas')->middleware('auth');
Route::resource('unidades',Unidad_productoController::class)->names('unidades')->middleware('auth');

//Rutas del modulo de administracion de Clientes
Route::resource('grupo_clientes', Grupo_clienteController::class)->names('grupo_clientes')->middleware('auth');
Route::resource('clientes', ClienteController::class)->names('clientes')->middleware('auth');
Route::post('rclientes', [ClienteController::class, 'registrar_cliente'])->name('rclientes.registrar_cliente')->middleware('auth');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//Rutas del modulo de Administracion de Usuarios y Roles
Route::resource('users', UserController::class)->names('users')->middleware('auth');
Route::resource('personas', PersonaController::class)->names('personas')->middleware('auth');
Route::resource('roles', RoleController::class)->names('roles')->middleware('auth');
Route::get('asignar/{user}', [UserController::class,'asignar_roles'])->name('asignar.asignar_roles')->middleware('auth');

//ruta de Admin Productos
Route::resource('productos', ProductoController::class)->names('productos')->middleware('auth');
Route::post('rproductos', [ProductoController::class, 'registrar'])->name('rproductos.registrar')->middleware('auth');
Route::resource('verproductos', Ver_detalle_productoController::class)->names('verproductos')->middleware('auth');
Route::resource('imprimir_codigos', Imprimir_codigoController::class)->names('imprimir_codigos')->middleware('auth');
Route::resource('ajuste_cantidad', Ajuste_cantidad_productoController::class)->names('ajuste_cantidad')->middleware('auth');
Route::get('subCategoriasPorCategoria/{id}', [ProductoController::class,'listaSubcatPorCategoria'])->name('subCategoriasPorCategoria.listaSubcatPorCategoria');

//Rutas del Modulo Admin Compras Ingreso de productos
Route::resource('compra_productos', Compra_productoController::class)->names('compra_productos')->middleware('auth');
Route::post('buscar_proveedor', [Compra_productoController::class, 'search'])->name('buscar_proveedor.search')->middleware('auth');
Route::get('buscar_producto/{producto}', [Compra_productoController::class, 'bproducto'])->name('buscar_producto.bproducto')->middleware('auth');
Route::get('generar_pdf/{compra}', [Compra_productoController::class, 'generarPDF'])->name('generar_pdf.generarPDF')->middleware('auth');
Route::get('pagar_credito/{compra}', [Compra_productoController::class, 'registrar_pago'])->name('pagar_credito.registrar_pago')->middleware('auth');

//Rutas del Modulo de Admin Ventas Salida de Productos
Route::post('buscar_cliente', [VentaController::class, 'search'])->name('buscar_cliente.search')->middleware('auth');
Route::get('buscar_producto_venta/{producto}', [VentaController::class, 'bproducto'])->name('buscar_producto_venta.bproducto')->middleware('auth');
Route::resource('ventas', VentaController::class)->names('ventas')->middleware('auth');

//ruta de generar cotizaciones
Route::resource('cotizaciones', CotizacioneController::class)->names('cotizaciones')->middleware('auth');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::redirect('home','dashboard');

Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview')->middleware('auth');
Route::get('pdf/generate', [PDFController::class, 'generatePDF'])->name('pdf.generate')->middleware('auth');

//Reportes
Route::resource('reporte_ventas', Reporte_ventasController::class)->names('reporte_ventas')->middleware('auth');
Route::resource('reporte_compras', Reporte_comprasController::class)->names('reporte_compras')->middleware('auth');
Route::resource('reporte_productos', Reporte_productosController::class)->names('reporte_productos')->middleware('auth');


//Configuracion del sistema
Route::resource('datos_empresa', Datos_empresaController::class)->names('datos_empresa')->middleware('auth');

