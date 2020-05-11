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

Route::get('index.php/', 'Home@inicio')->name('home');

Route::post('index.php/', 'PagesController@cambiar')->name('cambiar');

Route::get('index.php/login', 'PagesController@login')->name('login');

Route::get('index.php/registro', 'PagesController@registro')->name('registro');

Route::get('index.php/perfil', 'ProfileController@perfil')->name('perfil');

Route::put('index.php/perfil/{id}', 'ProfileController@editar')->name('miPerfil.editar');

Route::get('index.php/perfil/cambio', 'ProfileController@cambio')->name('perfil.cambio');

Route::post('index.php/perfil', 'ProfileController@cambiar')->name('perfil.cambiar');


/*********************************************
 *********************************************
 * Creacion y administracion de conductores***
 *********************************************
 *********************************************/


Route::get('index.php/conductores', 'DriversController@conductor')->name('conductor');

Route::get('index.php/conductores/detalle/{id?}', 'DriversController@detalle')->name('conductor.detalle');

Route::get('index.php/conductores/create', 'DriversController@creaCond')->name('conductor.crea');

Route::post('index.php/conductores', 'DriversController@crearCond')->name('conductor.crear');

Route::get('index.php/conductores/edita/{id?}', 'DriversController@editaCon')->name('conductor.edita');

Route::put('index.php/conductores/{id}', 'DriversController@editarCond')->name('conductor.editar');

Route::get('index.php/conductores/{id}', 'DriversController@permitir')->name('conductor.permitir');

Route::delete('index.php/conductores/{id}', 'DriversController@negar')->name('conductor.negar');


/*************************************************
 *************************************************
 * Creacion y administracion de Administradores***
 *************************************************
 *************************************************/

Route::get('index.php/administradores', 'AdministratorsController@administrador')->name('admin');

Route::get('index.php/administradores/create', 'AdministratorsController@creaAdmin')->name('admin.crea');

Route::post('index.php/administradores', 'AdministratorsController@crearAdmin')->name('admin.crear');

Route::get('index.php/administradores/detalle/{id?}', 'AdministratorsController@detalleAdmin')->name('admin.detalle');

Route::get('index.php/administradores/edita/{id?}', 'AdministratorsController@editaAdmin')->name('admin.edita');

Route::put('index.php/administradores/{id}', 'AdministratorsController@editarAdmin')->name('admin.editar');


/*********************************************
 *********************************************
 * Creacion y administracion de taxis*********
 *********************************************
 *********************************************/

Route::get('index.php/taxis', 'TaxisController@taxi')->name('taxis');

Route::get('index.php/taxis/detalle/{id}/{inicio?}/{fin?}', 'TaxisController@detalleTax')->name('taxi.detalle');

Route::get('index.php/taxis/create', 'TaxisController@creaTax')->name('taxi.crea');

Route::post('index.php/taxis', 'TaxisController@crearTax')->name('taxi.crear');

Route::get('index.php/taxis/edita/{id?}', 'TaxisController@editaTax')->name('taxi.edita');

Route::put('index.php/taxis/{id}', 'TaxisController@editarTax')->name('taxi.editar');

Route::get('index.php/taxis/asigna/{id}', 'TaxisController@asignaTax')->name('taxi.asigna');

Route::post('index.php/taxis/asigna/{id}', 'TaxisController@asignarTax')->name('taxi.asignar');

Route::get('index.php/taxis/documento/{id}', 'TaxisController@documento')->name('taxi.documentos');

Route::post('index.php/taxis/documento/{id?}', 'TaxisController@cargarDocumento')->name('taxi.cargardocumento');

Route::get('index.php/taxis/reporta/{id}', 'TaxisController@reporta')->name('taxi.reporta');

Route::put('index.php/taxis/reporta/{id}', 'TaxisController@reportar')->name('taxi.reportar');

Route::get('index.php/taxis/gastos/{id}/{w}/{val}', 'TaxisController@gastos')->name('taxi.gasto');

Route::post('index.php/taxis/gasto/{id}', 'TaxisController@gastosIngresar')->name('taxi.gastos');

Route::get('index.php/taxi/exporta/historico/{id}', 'TaxisController@excel')->name('taxi.excel');

Route::get('index.php/taxi/exporta/gastos/{id}', 'TaxisController@excelGastos')->name('taxi.excelGastos');

Route::delete('index.php/taxis/detalle/{id}', 'TaxisController@eliminarReporte')->name('taxi.eliminar');

Route::get('index.php/detalle/{id}/gastos/{w}', 'TaxisController@detalleGasto')->name('taxi.gastos.detalle');

Route::get('index.php/taxi/edita/descarga/{document}', 'TaxisController@download')->name('taxi.descargar');


/**********************************************
 **********************************************
 * Creacion y administracion de marcas taxis***
 **********************************************
 **********************************************/

Route::get('index.php/marcas', 'BrandsController@marca')->name('marcas');

Route::get('index.php/marcas/create', 'BrandsController@creaMarca')->name('marca.crea');

Route::post('index.php/marcas', 'BrandsController@crearMarca')->name('marca.crear');

Route::get('index.php/marcas/detalle/{id?}', 'BrandsController@detalleMarca')->name('marca.detalle');

Route::get('index.php/marcas/edita/{id?}', 'BrandsController@editaMarca')->name('marca.edita');

Route::put('index.php/marcas/{id?}', 'BrandsController@editarMarca')->name('marca.editar');


/**********************************************
 **********************************************
 * Creacion y administracion de autenticacion**
 **********************************************
 **********************************************/

Auth::routes();

Route::get('index.php/home', 'HomeController@index')->name('home');

/**********************************************
 **********************************************
 ******************Calendario******************
 **********************************************
 **********************************************/

//Route::get('/calendar', 'PagesController@Calendario')->name('calendario');

Route::get('index.php/calendario/form','CalendarController@formulario');

Route::post('index.php/evento/create','CalendarController@crearEvento');

Route::get('index.php/calendario/details/{id}','CalendarController@detalles');

Route::get('index.php/calendario','CalendarController@index')->name('calendario');

Route::get('index.php/calendario/{month}','CalendarController@mes');

Route::post('index.php/evento/calendario','CalendarController@calendario');

Route::get('index.php/calendario/delete/{id}','CalendarController@eliminarEvento')->name('calendario.delete');
Route::get('index.php/calendario/edit/{id}','CalendarController@editaCalendario')->name('calendario.edita');
Route::put('index.php/calendario/{id}', 'CalendarController@editarCalendario')->name('calendario.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Socios************
 *************************************************
 *************************************************/

Route::get('index.php/socios', 'PartnerController@socio')->name('socios');

Route::get('index.php/socios/crear', 'PartnerController@creaSocio')->name('socio.crea');

Route::post('index.php/socios', 'PartnerController@crearSocio')->name('socio.creado');

Route::get('index.php/socios/editar/{id}', 'PartnerController@editaSocio')->name('socio.edita');

Route::put('index.php/socios/{id}', 'PartnerController@editarSocio')->name('socio.editar');

Route::get('index.php/socios/configura', 'PartnerController@configura')->name('socio.configura');

Route::post('index.php/socios/configura', 'PartnerController@configurar')->name('socio.configurar');

/*************************************************
 *************************************************
 * Creacion y administracion de Tarifas***********
 *************************************************
 *************************************************/

Route::get('index.php/tarifa', 'RatesController@tarifa')->name('tarifa');

Route::get('index.php/tarifa/edita', 'RatesController@editaTarifa')->name('tarifa.edita');

Route::put('index.php/tarifa', 'RatesController@editarTarifa')->name('tarifa.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Categorias********
 *************************************************
 *************************************************/

Route::get('index.php/categoria', 'ExpensesCategoryController@categoria')->name('categoria');

Route::get('index.php/categoria/detalle/{id?}', 'ExpensesCategoryController@destalleCategoria')->name('categoria.detalle');

Route::get('index.php/categoria/crear', 'ExpensesCategoryController@crea')->name('categoria.crea');

Route::post('index.php/categoria', 'ExpensesCategoryController@crear')->name('categoria.crear');

Route::get('index.php/categoria/edita/{id}', 'ExpensesCategoryController@edita')->name('categoria.edita');

Route::put('index.php/categoria/{id}', 'ExpensesCategoryController@editar')->name('categoria.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Categorias********
 *************************************************
 *************************************************/

Route::get('index.php/descripcion', 'ExpensesDescriptionController@descripcion')->name('descripcion');

Route::get('index.php/descripcion/crear', 'ExpensesDescriptionController@crea')->name('descripcion.crea');

Route::post('index.php/descripcion', 'ExpensesDescriptionController@crear')->name('descripcion.crear');

Route::get('index.php/descripcion/editar/{id}', 'ExpensesDescriptionController@edita')->name('descripcion.edita');

Route::put('index.php/descripcion/{id}', 'ExpensesDescriptionController@editar')->name('descripcion.editar');

Route::get('index.php/descripcion/crear/{id}', 'ExpensesDescriptionController@creaDes')->name('descripcion.creaDes');

/*************************************************
 *************************************************
 * Creacion y administracion de Menus*************
 *************************************************
 *************************************************/

Route::get('index.php/administrativo/menus', 'MenusController@menus')->name('menus');

Route::get('index.php/administrativo/menus/edita/{id?}', 'MenusController@editamenu')->name('menu.edita');

Route::put('index.php/administrativo/menus/{id}', 'MenusController@editarMenu')->name('menu.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Separadores*******
 *************************************************
 *************************************************/

Route::get('index.php/administrativo/separadores', 'MenusController@separadores')->name('separador');

Route::get('index.php/administrativo/separadores/edita/{id?}', 'MenusController@editaSepara')->name('separador.edita');

Route::put('index.php/administrativo/separadores/{id}', 'MenusController@editarSepara')->name('separador.editar');

Route::get('index.php/administrativo/separadores/crea', 'MenusController@creaSepara')->name('separador.crea');

Route::post('index.php/administrativo/separadores', 'MenusController@crearSepara')->name('separador.crear');

/*************************************************
 *************************************************
 * Creacion y administracion de Perfiles**********
 *************************************************
 *************************************************/

Route::get('index.php/administrativo/perfiles', 'ProfilesController@perfiles')->name('perfil');

Route::get('index.php/administrativo/perfiles/crea', 'ProfilesController@creaPerfil')->name('perfil.crea');

Route::post('index.php/administrativo/perfiles/{id}', 'ProfilesController@crearPerfil')->name('perfil.crear');

Route::get('index.php/administrativo/perfiles/edita/{id}', 'ProfilesController@editaPerfil')->name('perfil.edita');

Route::put('index.php/administrativo/perfiles/{id}', 'ProfilesController@editarPerfil')->name('perfil.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Permisos**********
 *************************************************
 *************************************************/

Route::get('index.php/administrativo/permisos', 'PermissionsController@permisos')->name('permisos');

Route::get('index.php/administrativo/permisos/configurar/{id}', 'PermissionsController@configuraPermisos')->name('permisos.configura');

Route::put('index.php/administrativo/permisos/{id}', 'PermissionsController@configurar')->name('permisos.configurar');

/*************************************************
 *************************************************
 * Manejo de notificaciones y mensajes************
 *************************************************
 *************************************************/

Route::get('index.php/buzon', 'MessagesController@buzon')->name('buzon');

Route::get('index.php/buzon/leidas', 'MessagesController@leidas')->name('leidas');

Route::get('index.php/buzon/pendientes', 'MessagesController@porLeer')->name('pendientes');

Route::post('index.php/leido', 'MessagesController@leido');

/*************************************************
 *************************************************
 * Creacion y administracion de Servicios*********
 *************************************************
 *************************************************/

Route::get('index.php/servicios', 'ServicesController@servicios')->name('servicios');

Route::get('index.php/servicios/crear', 'ServicesController@crea')->name('servicio.crea');

Route::post('index.php/servicios', 'ServicesController@crear')->name('servicio.crear');

Route::get('index.php/servicios/editar/{id}', 'ServicesController@edita')->name('servicio.edita');

Route::put('index.php/servicios/{id}', 'ServicesController@editar')->name('servicio.editar');

Route::get('index.php/servicios/tipos', 'ServicesController@tipos')->name('tipos');

Route::get('index.php/servicios/tipos/crear', 'ServicesController@tiposCrea')->name('tipos.crea');

Route::post('index.php/servicios/tipos', 'ServicesController@tiposCrear')->name('tipos.crear');

Route::get('index.php/servicios/tipos/editar/{id}', 'ServicesController@tiposEdita')->name('tipos.edita');

Route::put('index.php/servicios/tipos/{id}', 'ServicesController@tiposEditar')->name('tipos.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Legales***********
 *************************************************
 *************************************************/

Route::get('index.php/administrativo/legales', 'LegalsController@legales')->name('legales');

Route::put('index.php/administrativo/legales/tratamiento', 'LegalsController@tratamiento')->name('legales.tratamiento');

Route::put('index.php/administrativo/legales/terminos', 'LegalsController@terminos')->name('legales.terminos');

/*************************************************
 *************************************************
 * Creacion y administracion de Reportes**********
 *************************************************
 *************************************************/

Route::get('index.php/reportes', 'ReportsController@reporte')->name('reportes');

Route::get('index.php/reportes/exporta/historico', 'ReportsController@historico')->name('reportes.excel');

Route::get('index.php/reportes/exporta/gastos', 'ReportsController@gastos')->name('reportes.excel2');

Route::get('index.php/reportes/exporta/socios/{id}', 'ReportsController@socios')->name('reportes.socios');

Route::get('index.php/error', 'ErrorController@error');

Route::resource('index.php/archivos', 'FilesController', ['only' => ['store']]);