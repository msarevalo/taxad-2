<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Home@inicio')->name('home');

Route::post('/', 'PagesController@cambiar')->name('cambiar');

Route::get('/login', 'PagesController@login')->name('login');

Route::get('/registro', 'PagesController@registro')->name('registro');

Route::get('/perfil', 'ProfileController@perfil')->name('perfil');

Route::put('/perfil/{id}', 'ProfileController@editar')->name('miPerfil.editar');

Route::get('/perfil/cambio', 'ProfileController@cambio')->name('perfil.cambio');

Route::post('/perfil', 'ProfileController@cambiar')->name('perfil.cambiar');


/*********************************************
 *********************************************
 * Creacion y administracion de conductores***
 *********************************************
 *********************************************/


Route::get('/conductores', 'DriversController@conductor')->name('conductor');

Route::get('/conductores/detalle/{id?}', 'DriversController@detalle')->name('conductor.detalle');

Route::get('/conductores/create', 'DriversController@creaCond')->name('conductor.crea');

Route::post('/conductores', 'DriversController@crearCond')->name('conductor.crear');

Route::get('/conductores/edita/{id?}', 'DriversController@editaCon')->name('conductor.edita');

Route::put('/conductores/{id}', 'DriversController@editarCond')->name('conductor.editar');

Route::get('/conductores/{id}', 'DriversController@permitir')->name('conductor.permitir');

Route::delete('/conductores/{id}', 'DriversController@negar')->name('conductor.negar');


/*************************************************
 *************************************************
 * Creacion y administracion de Administradores***
 *************************************************
 *************************************************/

Route::get('/administradores', 'AdministratorsController@administrador')->name('admin');

Route::get('/administradores/create', 'AdministratorsController@creaAdmin')->name('admin.crea');

Route::post('/administradores', 'AdministratorsController@crearAdmin')->name('admin.crear');

Route::get('/administradores/detalle/{id?}', 'AdministratorsController@detalleAdmin')->name('admin.detalle');

Route::get('/administradores/edita/{id?}', 'AdministratorsController@editaAdmin')->name('admin.edita');

Route::put('/administradores/{id}', 'AdministratorsController@editarAdmin')->name('admin.editar');


/*********************************************
 *********************************************
 * Creacion y administracion de taxis*********
 *********************************************
 *********************************************/

Route::get('/taxis', 'TaxisController@taxi')->name('taxis');

Route::get('/taxis/detalle/{id}/{inicio?}/{fin?}', 'TaxisController@detalleTax')->name('taxi.detalle');

Route::get('/taxis/create', 'TaxisController@creaTax')->name('taxi.crea');

Route::post('/taxis', 'TaxisController@crearTax')->name('taxi.crear');

Route::get('/taxis/edita/{id?}', 'TaxisController@editaTax')->name('taxi.edita');

Route::put('/taxis/{id}', 'TaxisController@editarTax')->name('taxi.editar');

Route::get('/taxis/asigna/{id}', 'TaxisController@asignaTax')->name('taxi.asigna');

Route::post('/taxis/asigna/{id}', 'TaxisController@asignarTax')->name('taxi.asignar');

Route::get('/taxis/documento/{id}', 'TaxisController@documento')->name('taxi.documentos');

Route::post('/taxis/documento/{id?}', 'TaxisController@cargarDocumento')->name('taxi.cargardocumento');

Route::get('/taxis/reporta/{id}', 'TaxisController@reporta')->name('taxi.reporta');

Route::put('/taxis/reporta/{id}', 'TaxisController@reportar')->name('taxi.reportar');

Route::get('/taxis/gastos/{id}/{w}/{val}', 'TaxisController@gastos')->name('taxi.gasto');

Route::post('/taxis/gasto/{id}', 'TaxisController@gastosIngresar')->name('taxi.gastos');

Route::get('/taxi/exporta/historico/{id}', 'TaxisController@excel')->name('taxi.excel');

Route::get('/taxi/exporta/gastos/{id}', 'TaxisController@excelGastos')->name('taxi.excelGastos');

Route::delete('/taxis/detalle/{id}', 'TaxisController@eliminarReporte')->name('taxi.eliminar');


/**********************************************
 **********************************************
 * Creacion y administracion de marcas taxis***
 **********************************************
 **********************************************/

Route::get('/marcas', 'BrandsController@marca')->name('marcas');

Route::get('/marcas/create', 'BrandsController@creaMarca')->name('marca.crea');

Route::post('/marcas', 'BrandsController@crearMarca')->name('marca.crear');

Route::get('/marcas/detalle/{id?}', 'BrandsController@detalleMarca')->name('marca.detalle');

Route::get('/marcas/edita/{id?}', 'BrandsController@editaMarca')->name('marca.edita');

Route::put('/marcas/{id?}', 'BrandsController@editarMarca')->name('marca.editar');


/**********************************************
 **********************************************
 * Creacion y administracion de autenticacion**
 **********************************************
 **********************************************/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**********************************************
 **********************************************
 ******************Calendario******************
 **********************************************
 **********************************************/

//Route::get('/calendar', 'PagesController@Calendario')->name('calendario');

Route::get('calendario/form','CalendarController@formulario');

Route::post('evento/create','CalendarController@crearEvento');

Route::get('calendario/details/{id}','CalendarController@detalles');

Route::get('calendario','CalendarController@index')->name('calendario');

Route::get('calendario/{month}','CalendarController@mes');

Route::post('evento/calendario','CalendarController@calendario');

Route::get('calendario/delete/{id}','CalendarController@eliminarEvento')->name('calendario.delete');
Route::get('calendario/edit/{id}','CalendarController@editaCalendario')->name('calendario.edita');
Route::put('/calendario/{id}', 'CalendarController@editarCalendario')->name('calendario.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Socios************
 *************************************************
 *************************************************/

Route::get('/socios', 'PartnerController@socio')->name('socios');

Route::get('/socios/crear', 'PartnerController@creaSocio')->name('socio.crea');

Route::post('/socios', 'PartnerController@crearSocio')->name('socio.creado');

Route::get('/socios/editar/{id}', 'PartnerController@editaSocio')->name('socio.edita');

Route::put('/socios/{id}', 'PartnerController@editarSocio')->name('socio.editar');

Route::get('/socios/configura', 'PartnerController@configura')->name('socio.configura');

Route::post('/socios/configura', 'PartnerController@configurar')->name('socio.configurar');

/*************************************************
 *************************************************
 * Creacion y administracion de Tarifas***********
 *************************************************
 *************************************************/

Route::get('/tarifa', 'RatesController@tarifa')->name('tarifa');

Route::get('/tarifa/edita', 'RatesController@editaTarifa')->name('tarifa.edita');

Route::put('/tarifa', 'RatesController@editarTarifa')->name('tarifa.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Categorias********
 *************************************************
 *************************************************/

Route::get('/categoria', 'ExpensesCategoryController@categoria')->name('categoria');

Route::get('/categoria/detalle/{id?}', 'ExpensesCategoryController@destalleCategoria')->name('categoria.detalle');

Route::get('/categoria/crear', 'ExpensesCategoryController@crea')->name('categoria.crea');

Route::post('/categoria', 'ExpensesCategoryController@crear')->name('categoria.crear');

Route::get('/categoria/edita/{id}', 'ExpensesCategoryController@edita')->name('categoria.edita');

Route::put('/categoria/{id}', 'ExpensesCategoryController@editar')->name('categoria.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Categorias********
 *************************************************
 *************************************************/

Route::get('/descripcion', 'ExpensesDescriptionController@descripcion')->name('descripcion');

Route::get('/descripcion/crear', 'ExpensesDescriptionController@crea')->name('descripcion.crea');

Route::post('/descripcion', 'ExpensesDescriptionController@crear')->name('descripcion.crear');

Route::get('/descripcion/editar/{id}', 'ExpensesDescriptionController@edita')->name('descripcion.edita');

Route::put('/descripcion/{id}', 'ExpensesDescriptionController@editar')->name('descripcion.editar');

Route::get('/descripcion/crear/{id}', 'ExpensesDescriptionController@creaDes')->name('descripcion.creaDes');

/*************************************************
 *************************************************
 * Creacion y administracion de Menus*************
 *************************************************
 *************************************************/

Route::get('/administrativo/menus', 'MenusController@menus')->name('menus');

Route::get('/administrativo/menus/edita/{id?}', 'MenusController@editamenu')->name('menu.edita');

Route::put('/administrativo/menus/{id}', 'MenusController@editarMenu')->name('menu.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Separadores*******
 *************************************************
 *************************************************/

Route::get('/administrativo/separadores', 'MenusController@separadores')->name('separador');

Route::get('/administrativo/separadores/edita/{id?}', 'MenusController@editaSepara')->name('separador.edita');

Route::put('/administrativo/separadores/{id}', 'MenusController@editarSepara')->name('separador.editar');

Route::get('/administrativo/separadores/crea', 'MenusController@creaSepara')->name('separador.crea');

Route::post('/administrativo/separadores', 'MenusController@crearSepara')->name('separador.crear');

/*************************************************
 *************************************************
 * Creacion y administracion de Perfiles**********
 *************************************************
 *************************************************/

Route::get('/administrativo/perfiles', 'ProfilesController@perfiles')->name('perfil');

Route::get('/administrativo/perfiles/crea', 'ProfilesController@creaPerfil')->name('perfil.crea');

Route::post('/administrativo/perfiles/{id}', 'ProfilesController@crearPerfil')->name('perfil.crear');

Route::get('/administrativo/perfiles/edita/{id}', 'ProfilesController@editaPerfil')->name('perfil.edita');

Route::put('/administrativo/perfiles/{id}', 'ProfilesController@editarPerfil')->name('perfil.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Permisos**********
 *************************************************
 *************************************************/

Route::get('/administrativo/permisos', 'PermissionsController@permisos')->name('permisos');

Route::get('/administrativo/permisos/configurar/{id}', 'PermissionsController@configuraPermisos')->name('permisos.configura');

Route::put('/administrativo/permisos/{id}', 'PermissionsController@configurar')->name('permisos.configurar');

/*************************************************
 *************************************************
 * Manejo de notificaciones y mensajes************
 *************************************************
 *************************************************/

Route::get('/buzon', 'MessagesController@buzon')->name('buzon');

Route::get('/buzon/leidas', 'MessagesController@leidas')->name('leidas');

Route::get('/buzon/pendientes', 'MessagesController@porLeer')->name('pendientes');

Route::post('leido', 'MessagesController@leido');

/*************************************************
 *************************************************
 * Creacion y administracion de Servicios*********
 *************************************************
 *************************************************/

Route::get('/servicios', 'ServicesController@servicios')->name('servicios');

Route::get('/servicios/crear', 'ServicesController@crea')->name('servicio.crea');

Route::post('/servicios', 'ServicesController@crear')->name('servicio.crear');

Route::get('/servicios/editar/{id}', 'ServicesController@edita')->name('servicio.edita');

Route::put('/servicios/{id}', 'ServicesController@editar')->name('servicio.editar');

Route::get('/servicios/tipos', 'ServicesController@tipos')->name('tipos');

Route::get('/servicios/tipos/crear', 'ServicesController@tiposCrea')->name('tipos.crea');

Route::post('/servicios/tipos', 'ServicesController@tiposCrear')->name('tipos.crear');

Route::get('/servicios/tipos/editar/{id}', 'ServicesController@tiposEdita')->name('tipos.edita');

Route::put('/servicios/tipos/{id}', 'ServicesController@tiposEditar')->name('tipos.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Legales***********
 *************************************************
 *************************************************/

Route::get('/administrativo/legales', 'LegalsController@legales')->name('legales');

/*************************************************
 *************************************************
 * Creacion y administracion de Reportes**********
 *************************************************
 *************************************************/

Route::get('/reportes', 'ReportsController@reporte')->name('reportes');

Route::get('/reportes/exporta/historico', 'ReportsController@historico')->name('reportes.excel');

Route::get('/reportes/exporta/gastos', 'ReportsController@gastos')->name('reportes.excel2');

Route::get('/reportes/exporta/socios/{id}', 'ReportsController@socios')->name('reportes.socios');