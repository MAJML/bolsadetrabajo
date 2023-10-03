<?php

App::setLocale('es');

/* BORRAR CACHE */
Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
 });

Route::get('/', 'App\HomeController@index')->name('index');
//Route::get('/actualizar', 'App\HomeController@actualizar')->name('actualizar');
Route::get('/filtro_distritos/{id}', 'App\HomeController@filtro_distritos')->name('filtro_distritos');

Route::get('/buscar_reniec/{data}', 'App\LoginEmpresaController@consultar_reniec')->name('buscar_reniec');
Route::get('/buscar_sunat/{data}', 'App\LoginEmpresaController@consultar_sunat')->name('buscar_sunat');

Route::group(['middleware' => 'auth:alumnos'], function () {
    Route::group(['prefix' => 'alumno'], function () {

        Route::get('/avisos', 'App\AvisoController@avisos')->name('alumno.avisos');
        Route::get('/{empresa}/informacion', 'App\AvisoController@empresa_informacion')->name('alumno.empresa_informacion');
        Route::get('/{empresa}/aviso/{slug}', 'App\AvisoController@informacion')->name('alumno.informacion');
        Route::post('/aviso/postular', 'App\AvisoController@postular')->name('alumno.postular');

        //Route::group(['middleware' => 'alumno'], function () {});

        Route::get('/perfil', 'App\AlumnoController@index')->name('alumno.perfil');
        Route::post('/perfil', 'App\AlumnoController@store')->name('alumno.store');

        Route::get('/perfil/validacion', 'App\AlumnoController@perfil_validacion')->name('alumno.perfil_validacion');

        Route::get('/perfil/educaciones', 'App\AlumnoController@educaciones')->name('alumno.perfil.educaciones');
        Route::get('/perfil/partialViewEducacion/{id}', 'App\AlumnoController@educacion')->name('alumno.perfil.educacion');
        Route::post('/perfil/educacion', 'App\AlumnoController@educacion_store')->name('alumno.perfil.educacion_store');
        Route::post('/perfil/educacion/delete', 'App\AlumnoController@educacion_delete')->name('alumno.perfil.educacion_delete');

        Route::get('/perfil/experiencias', 'App\AlumnoController@experiencias')->name('alumno.perfil.experiencias');
        Route::get('/perfil/partialViewExperienciaLaboral/{id}', 'App\AlumnoController@experiencia_laboral')->name('alumno.perfil.experiencia_laboral');
        Route::post('/perfil/experiencia', 'App\AlumnoController@experiencia_store')->name('alumno.perfil.experiencia_store');
        Route::post('/perfil/experiencia/delete', 'App\AlumnoController@experiencia_delete')->name('alumno.perfil.experiencia_delete');

        Route::get('/perfil/referencias', 'App\AlumnoController@referencias')->name('alumno.perfil.referencias');
        Route::get('/perfil/partialViewReferenciaLaboral/{id}', 'App\AlumnoController@referencia_laboral')->name('alumno.perfil.referencia_laboral');
        Route::post('/perfil/referencia', 'App\AlumnoController@referencia_store')->name('alumno.perfil.referencia_store');
        Route::post('/perfil/referencia/delete', 'App\AlumnoController@referencia_delete')->name('alumno.perfil.referencia_delete');

        Route::get('/perfil/habilidades', 'App\AlumnoController@habilidades')->name('alumno.perfil.habilidades');
        Route::get('/perfil/partialViewHabilidad/{id}', 'App\AlumnoController@habilidad')->name('alumno.perfil.habilidad');
        Route::get('/perfil/partialViewHabilidadProfesional/{id}', 'App\AlumnoController@habilidad_profesional')->name('alumno.perfil.habilidad_profesional');
        Route::post('/perfil/habilidad', 'App\AlumnoController@habilidad_store')->name('alumno.perfil.habilidad_store');
    });
});

Route::get('/{empresa}/aviso/{slug}/postulantes/{alumno}', 'App\AvisoController@donwloadCValumno')->name('empresa.cv_postulante');

Route::get('/alumno/pdf', 'App\AlumnoController@donwloadCValumno');

Route::group(['middleware' => 'auth:empresasw'], function () {
    Route::group(['prefix' => 'empresa'], function () {

        Route::get('/perfil', 'App\EmpresaController@index')->name('empresa.perfil');
        Route::post('/perfil', 'App\EmpresaController@store')->name('empresa.store');

        Route::get('/avisos', 'App\EmpresaController@listar_aviso')->name('empresa.avisos');
        Route::get('/{empresa}/aviso/{slug}', 'App\AvisoController@informacion')->name('empresa.informacion');
        Route::get('/{empresa}/aviso/{slug}/postulantes', 'App\AvisoController@postulantes')->name('empresa.postulantes');
        Route::get('/{empresa}/aviso/{slug}/postulantes/{alumno}', 'App\AvisoController@postulante_informacion')->name('empresa.postulante_informacion');
        Route::get('/avisos/registrar', 'App\EmpresaController@registrar_aviso')->name('empresa.registrar_aviso');
        Route::get('/avisos/listar', 'App\EmpresaController@listar_aviso')->name('empresa.listar_aviso');
        Route::get('/avisos/listar_json', 'App\EmpresaController@listar_aviso_json')->name('empresa.listar_aviso_json');
        Route::get('/avisos/partialView/{id}', 'App\EmpresaController@partialView_aviso')->name('empresa.partialView_aviso');
        Route::get('/avisos/partialViewPostulante/{id}', 'App\EmpresaController@partialViewAvisoPostulantes')->name('empresa.aviso.postulantes');
        Route::get('/avisos/list_all_postulantes', 'App\EmpresaController@list_avisoPostulantes')->name('empresa.aviso.list_postulantes');

        Route::post('/avisos/storeAviso', 'App\EmpresaController@store_aviso')->name('empresa.store_aviso');
        Route::post('/avisos/updateAviso', 'App\EmpresaController@update_aviso')->name('empresa.update_aviso');
        Route::post('/avisos/alumno/clasificar', 'App\AvisoController@clasificar_aviso')->name('empresa.clasificar_aviso');
        Route::post('/avisos/delete', 'Auth\AvisoController@delete')->name('empresa.aviso.delete');
    });
});



Route::post('empresa/login', 'App\LoginEmpresaController@login')->name('empresa.login.post');
Route::post('empresa/logout', 'App\LoginEmpresaController@logout')->name('empresa.logout');

Route::get('empresa/registrar', 'App\HomeController@crear_empresa')->name('empresa.crear_empresa');
Route::post('empresa/registrar', 'App\HomeController@registrar_empresa')->name('empresa.registrar_empresa.post');

Route::post('alumno/login', 'App\LoginAlumnoController@login')->name('alumno.login.post');
Route::post('alumno/logout', 'App\LoginAlumnoController@logout')->name('alumno.logout');

Route::get('alumno/registrar', 'App\HomeController@crear_alumno')->name('alumno.crear_alumno');
Route::post('alumno/registrar', 'App\HomeController@registrar_alumno')->name('alumno.registrar_alumno.post');

/* ADMINISTRADOR */

Route::group(['prefix' => 'auth', 'middleware' => 'auth:web'], function () {
    Route::get('/home', 'Auth\HomeController@index')->name('auth.index');

    Route::group(['prefix' => 'alumno'], function () {
        Route::get('/', 'Auth\AlumnoController@index')->name('auth.alumno');
        Route::get('/list_all', 'Auth\AlumnoController@list')->name('auth.alumno.list');
        Route::get('/partialView/{id}', 'Auth\AlumnoController@partialView')->name('auth.alumno.create');
        Route::get('/print_cv_pdf/{id}/', 'Auth\AlumnoController@print_cv_pdf')->name('auth.alumno.print_cv_pdf');
        Route::post('/update', 'Auth\AlumnoController@update')->name('auth.alumno.update');
        Route::post('/delete', 'Auth\AlumnoController@delete')->name('auth.alumno.delete');
    });

    Route::group(['prefix' => 'empresa'], function () {
        Route::get('/', 'Auth\EmpresaController@index')->name('auth.empresa');
        Route::get('/list_all', 'Auth\EmpresaController@list')->name('auth.empresa.list');
        Route::get('/partialView/{id}', 'Auth\EmpresaController@partialView')->name('auth.empresa.create');
        Route::post('/update', 'Auth\EmpresaController@update')->name('auth.empresa.update');
        Route::post('/delete', 'Auth\EmpresaController@delete')->name('auth.empresa.delete');
    });

    Route::group(['prefix' => 'aviso'], function () {
        Route::get('/', 'Auth\AvisoController@index')->name('auth.aviso');
        Route::get('/list_all', 'Auth\AvisoController@list')->name('auth.aviso.list');
        Route::get('/partialViewPostulante/{id}', 'Auth\AvisoController@partialViewPostulantes')->name('auth.aviso.postulantes');

        Route::get('/partialViewAviso/{id}', 'Auth\AvisoController@partialViewAviso')->name('auth.aviso.postulantes2');

        Route::get('/ajax_list', 'Auth\AvisoController@partialViewPostulantesEstudiantes')->name('auth.aviso.ajax_list');

        Route::get('/ajax_list2', 'Auth\AvisoController@partialViewPostulantesEstudiantes2')->name('auth.aviso.ajax_list2');

        Route::get('/list_all_postulantes', 'Auth\AvisoController@list_postulantes')->name('auth.aviso.list_postulantes');
        Route::post('/delete', 'Auth\AvisoController@delete')->name('auth.aviso.delete');
        
    });

    Route::post('store_estudiante_aviso', 'Auth\AvisoController@store_estudiante_aviso')->name('auth.aviso.store_estudiante_aviso');

    Route::post('store_seguimiento', 'Auth\AvisoController@store_seguimiento')->name('auth.aviso.store_seguimiento');


    Route::group(['prefix' => 'area'], function () {
        Route::get('/', 'Auth\AreaController@index')->name('auth.area');
        Route::get('/list_all', 'Auth\AreaController@list_all')->name('auth.area.list_all');
        Route::get('/partialView/{id}', 'Auth\AreaController@partialView')->name('auth.area.create');
        Route::post('/store', 'Auth\AreaController@store')->name('auth.area.store');
        Route::post('/delete', 'Auth\AreaController@delete')->name('auth.area.delete');
    });

    // SECTION USUARIO

    Route::group(['prefix' => 'usuario'], function () {
        Route::get('/', 'Auth\UsuarioController@index')->name('auth.usuario');
        Route::get('/list_all', 'Auth\UsuarioController@list_all')->name('auth.usuario.list_all');
        Route::post('/store', 'Auth\UsuarioController@store')->name('auth.usuario.store');
    });

    // END SECTION USUARIO

    Route::group(['prefix' => 'cargo'], function () {
        Route::get('/', 'Auth\CargoController@index')->name('auth.cargo');
        Route::get('/list_all', 'Auth\CargoController@list_all')->name('auth.cargo.list_all');
        Route::get('/partialView/{id}', 'Auth\CargoController@partialView')->name('auth.cargo.create');
        Route::post('/store', 'Auth\CargoController@store')->name('auth.cargo.store');
        Route::post('/delete', 'Auth\CargoController@delete')->name('auth.cargo.delete');
    });

    Route::group(['prefix' => 'horario'], function () {
        Route::get('/', 'Auth\HorarioController@index')->name('auth.horario');
        Route::get('/list_all', 'Auth\HorarioController@list_all')->name('auth.horario.list_all');
        Route::get('/partialView/{id}', 'Auth\HorarioController@partialView')->name('auth.horario.create');
        Route::post('/store', 'Auth\HorarioController@store')->name('auth.horario.store');
        Route::post('/delete', 'Auth\HorarioController@delete')->name('auth.horario.delete');
    });

    Route::group(['prefix' => 'modalidad'], function () {
        Route::get('/', 'Auth\ModalidadController@index')->name('auth.modalidad');
        Route::get('/list_all', 'Auth\ModalidadController@list_all')->name('auth.modalidad.list_all');
        Route::get('/partialView/{id}', 'Auth\ModalidadController@partialView')->name('auth.modalidad.create');
        Route::post('/store', 'Auth\ModalidadController@store')->name('auth.modalidad.store');
        Route::post('/delete', 'Auth\ModalidadController@delete')->name('auth.modalidad.delete');
    });

    Route::group(['prefix' => 'habilidad'], function () {
        Route::get('/', 'Auth\HabilidadController@index')->name('auth.habilidad');
        Route::get('/profesional', 'Auth\HabilidadController@index_profesional')->name('auth.habilidad_profesional');
        Route::get('/list_all', 'Auth\HabilidadController@list_all')->name('auth.habilidad.list_all');
        Route::get('/partialView/{id}', 'Auth\HabilidadController@partialView')->name('auth.habilidad.create');
        Route::post('/store', 'Auth\HabilidadController@store')->name('auth.habilidad.store');
        Route::post('/delete', 'Auth\HabilidadController@delete')->name('auth.habilidad.delete');
    });

});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('login', 'Auth\LoginController@login')->name('auth.login.post');
    Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

    Route::get('/changePassword/partialView', 'Auth\LoginController@partialView_change_password')->name('auth.login.partialView_change_password');
    Route::post('/changePassword', 'Auth\LoginController@change_password')->name('auth.login.change_password');

    /*Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');*/
});

Route::get('publicar_oferta', 'Auth\LoginController@view_publicar_oferta');