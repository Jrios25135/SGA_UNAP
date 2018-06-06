<?php

class indexController extends usuariosController
{

    private $_usuarios;
    private $_aclm;

    public function __construct($lang, $url)
    {
        parent::__construct($lang, $url);
        $this->_aclm     = $this->loadModel('index', 'acl');
        $this->_usuarios = $this->loadModel('usuario');
    }

////////////////////////// CODIGO DE JOSE //////////////////////////////////////

    public function docentes()
    {

        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre    = $this->getSql('nombre');
        $pagina    = $this->getInt('pagina');
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardardocente")) {

            $this->nuevo_detalledocente();
        }
        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY ded.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE ded.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados
        $arrayRowCount  = $this->_usuarios->getDocenteRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $this->_view->assign('maestro', $this->_usuarios->getMaestro()); //// sera para listar el combo docente

        $this->_view->assign('escue', $this->_usuarios->getescuela()); /// sera pa listar el combo escuela

        $this->_view->assign('docentes', $this->_usuarios->getDocentePaginado($pagina, CANT_REG_PAG, $soloActivos));
        $paginador->paginar($totalRegistros, "listardocente", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de docente');
        $this->_view->renderizar('docente');
    }

    public function editarDocente($Ded_IdDetalleDocente = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $docentes = $this->_usuarios->getDocenteDetalle($this->filtrarInt($Ded_IdDetalleDocente));

        if ($this->botonPress("bt_cancelardocente")) {
            $this->redireccionar('usuarios/index/docentes');
        }

        if ($this->botonPress("bt_editardocente")) {

            $id = $this->_usuarios->editarDocente($this->filtrarInt($Ded_IdDetalleDocente),
                $this->getSql('gradoacademico'),
                $this->getSql('condicion'),
                $this->getSql('dedicacion'),
                $this->getSql('categoria'),
                $this->getSql('cargo'),
                $this->getSql('seldocente'),
                $this->getSql('selescuela'), 1, 1
            );

            if ($id) {
                $this->_view->assign('_mensaje', 'Docente editado Correctamente');
                $docentes = $this->_usuarios->getDocenteDetalle($this->filtrarInt($Ded_IdDetalleDocente));
            } else {
                $this->_view->assign('_error', 'Error al editar Docente');
            }
        }

        $this->_view->assign('escue', $this->_usuarios->getescuela());
        $this->_view->assign('maestro', $this->_usuarios->getMaestro());

        $this->_view->assign('datos', $docentes);
        $this->_view->renderizar('ajax/editardocente', 'editardocente');
    }

    public function estudiantes()
    {

        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre    = $this->getSql('nombre');
        $pagina    = $this->getInt('pagina');
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardarestudiante")) {
            $this->nuevo_detallealum();
        }
        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY dea.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE dea.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados
        $arrayRowCount  = $this->_usuarios->getAlumnoRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $this->_view->assign('estudiante', $this->_usuarios->getEstudiante());

        $this->_view->assign('escue', $this->_usuarios->getescuela()); /// sera pa listar el combo escuela

        $this->_view->assign('estudiantes', $this->_usuarios->getAlumnoPaginado($pagina, CANT_REG_PAG, $soloActivos));
        $paginador->paginar($totalRegistros, "listaralumno", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de Alumnos');
        $this->_view->renderizar('alumno');
    }

    public function editarAlumno($Dea_IdDetalleAlumno = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $estudiantes = $this->_usuarios->getAlumnoDetalle($this->filtrarInt($Dea_IdDetalleAlumno));

        if ($this->botonPress("bt_cancelarestudiante")) {
            $this->redireccionar('usuarios/index/estudiantes');
        }

        if ($this->botonPress("bt_editarestudiante")) {

            $id = $this->_usuarios->editarAlumno($this->filtrarInt($Dea_IdDetalleAlumno),
                $this->getSql('codigouniveristario'),
                $this->getSql('selcurri'),
                $this->getSql('selestudi'), 1, 1
            );

            if ($id) {
                $this->_view->assign('_mensaje', 'Alumno editado Correctamente');
                $estudiantes = $this->_usuarios->getAlumnoDetalle($this->filtrarInt($Dea_IdDetalleAlumno));
            } else {
                $this->_view->assign('_error', 'Error al editar Docente');
            }
        }

        $this->_view->assign('escue', $this->_usuarios->getescuela());

        $idescuela = $estudiantes['Esc_IdEscuela'];
        $condicion = " WHERE Cui_Estado = 1 AND Esc_IdEscuela = $idescuela";
        $this->_view->assign('curri', $this->_usuarios->getcurricula($condicion));

        $this->_view->assign('estudiante', $this->_usuarios->getEstudiante());

        $this->_view->assign('datos', $estudiantes);
        $this->_view->renderizar('ajax/editaralumno', 'editaralumno');
    }

    public function actualizarcurricula()
    {

        $Esc_IdEscuela = $this->getInt('Esc_IdEscuela');
        $condicion     = " WHERE Cui_Estado = 1 AND Esc_IdEscuela = $Esc_IdEscuela";
        $this->_view->assign('curri', $this->_usuarios->getcurricula($condicion));
        $this->_view->renderizar('ajax/Cui_IdCurricula', false, true);
    }

    public function nuevo_detalledocente($usu = false)
    {
        $this->_acl->acceso('agregar_rol');
        /*echo "/" . $this->getSql('gradoacademico') . "/" . $this->getSql('condicion') . "/" . $this->getSql('dedicacion') . "/" . $this->getSql('categoria') . "/" . $this->getSql('cargo') . "/" . $this->getSql('seldocente') . "/" . $this->getSql('selescuela') . "/";*/
        $iddetalledo = $this->_usuarios->insertardetalledocente(
            $this->getSql('gradoacademico'),
            $this->getSql('condicion'),
            $this->getSql('dedicacion'),
            $this->getSql('categoria'),
            $this->getSql('cargo'),
            $this->getSql('seldocente'),
            $this->getSql('selescuela'), 1, 1
        );
        if (is_array($iddetalledo)) {

            if ($iddetalledo[0] > 0) {

                $this->_view->assign('_mensaje', 'Registro Completado..!!');

            } else {

                $this->_view->assign('_error', 'Error al registrar el Docente');
            }

        } else {

            $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
        }

        if ($usu) {

            $this->_view->renderizar('ajax/listardocente', false, true);
        }

    }

    public function nuevo_detallealum($usu = false)
    {
        $this->_acl->acceso('agregar_rol');

        /*echo "/" . $this->getSql('codigouniveristario') . "/" . $this->getSql('selcurri') . "/" . $this->getSql('selestudiante') . "/";*/

        $iddetallealum = $this->_usuarios->insertardetallealumno(
            $this->getSql('codigouniveristario'),
            $this->getSql('selcurri'),
            $this->getSql('selestudiante'), 1, 1
        );
        if (is_array($iddetallealum)) {

            if ($iddetallealum[0] > 0) {

                $this->_view->assign('_mensaje', 'Registro Completado..!!');

            } else {

                $this->_view->assign('_error', 'Error al registrar el Alumno');

            }
        } else {

            $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');

        }

        if ($usu) {

            $this->_view->renderizar('ajax/listaralumno', false, true);
        }

    }

    public function cambiarEstadoDocente()
    {

        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Variables de Ajax_JavaScript
        $nombre               = $this->getSql('palabra');
        $formulario           = $this->getSql('formulario');
        $pagina               = $this->getInt('pagina');
        $filas                = $this->getInt('filas');
        $Ded_IdDetalleDocente = $this->getInt('_Ded_IdDetalleDocente');
        $Ded_Estado           = $this->getInt('_Ded_Estado');

        if (!$Ded_IdDetalleDocente) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('docentes');
            exit;
        } else {

            //Actualizacion de estado en la BD

            $rowCountEstado = $this->_usuarios->cambiarEstadoDocente($Ded_IdDetalleDocente, $Ded_Estado);
            //Mensaje de Actualizacion
            if ($rowCountEstado > 0) {
                if ($Ded_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';
                }
                if ($Ded_Estado == 0) {
                    $contenido = ' Se cambio de estado correctamente a <b>Habilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" title="Habilitado" style=" background: #FFF;  color: #088A08; padding: 2px;"/> ...!! ';
                }
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $this->_view->assign('_error', 'Error de variable(s) en consulta..!!');
            }
        }
        //Mensaje JSON
        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        $soloActivos = 0;
        $condicion   = "";

        $paginador = new Paginador();

        $arrayRowCount  = $this->_usuarios->getDocenteRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listardocente' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$nombre", $pagina, $filas, true);

        $this->_view->assign('docentes', $this->_usuarios->getDocenteCondicion($pagina, $filas, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listardocente' . $formulario, false, true);
    }

    public function cambiarEstadoAlumno()
    {

        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Variables de Ajax_JavaScript
        $txtBuscar           = $this->getSql('palabra');
        $formulario          = $this->getSql('formulario');
        $pagina              = $this->getInt('pagina');
        $filas               = $this->getInt('filas');
        $Dea_IdDetalleAlumno = $this->getInt('_Dea_IdDetalleAlumno');
        $Dea_Estado          = $this->getInt('_Dea_Estado');

        if (!$Dea_IdDetalleAlumno) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('alumnos');
            exit;
        } else {

            //Actualizacion de estado en la BD

            $rowCountEstado = $this->_usuarios->cambiarEstadoAlumno($Dea_IdDetalleAlumno, $Dea_Estado);
            //Mensaje de Actualizacion
            if ($rowCountEstado > 0) {
                if ($Dea_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';
                }
                if ($Dea_Estado == 0) {
                    $contenido = ' Se cambio de estado correctamente a <b>Habilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" title="Habilitado" style=" background: #FFF;  color: #088A08; padding: 2px;"/> ...!! ';
                }
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $this->_view->assign('_error', 'Error de variable(s) en consulta..!!');
            }
        }
        //Mensaje JSON
        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        $soloActivos = 0;
        $condicion   = "";
        /*  if ($txtBuscar) {
        $condicion = "  ";
        //Filtro por Activos/Eliminados
        if (!$this->_acl->permiso('ver_eliminados')) {
        $soloActivos = 1;
        $condicion .= " AND Row_Estado = $soloActivos ";
        }

        } else {
        //Filtro por Activos/Eliminados
        $condicion = " ORDER BY Row_Estado DESC ";
        if (!$this->_acl->permiso('ver_eliminados')) {
        $soloActivos = 1;
        $condicion   = " WHERE Row_Estado = $soloActivos  ";
        }
        }*/

        $paginador = new Paginador();

        $arrayRowCount  = $this->_usuarios->getAlumnoRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listaralumno' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('estudiantes', $this->_usuarios->getAlumnoCondicion($pagina, $filas, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listaralumno' . $formulario, false, true);
    }

    public function buscarDocente()
    {

        $nombre    = $this->getSql('palabra');
        $condicion = "";
        // echo $nombre;exit;

        if ($nombre) {
            $condicion .= " WHERE Usu.Usu_Nombre liKe '%$nombre%' ";
        }

        $paginador = new Paginador();

        $this->_view->assign('docentes', $paginador->paginar($this->_usuarios->getDocenteBusqueda($condicion), "listardocente", "$nombre", false, 25));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax'));
        $this->_view->renderizar('ajax/listardocente', false, true);
    }

    public function buscarAlumno()
    {
        ;
        $nombre    = $this->getSql('palabra');
        $condicion = "";
        // echo $nombre;exit;

        if ($nombre) {
            $condicion .= " WHERE Usu.Usu_Nombre liKe '%$nombre%' ";
        }

        $paginador = new Paginador();

        $this->_view->assign('estudiantes', $paginador->paginar($this->_usuarios->getAlumnoBusqueda($condicion), "listaralumno", "$nombre", false, 25));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax'));
        $this->_view->renderizar('ajax/listaralumno', false, true);
    }

    public function eliminarHabilitarDocente()
    {
        $this->_acl->acceso('editar_rol');

        //Variables Ajax_Javascript
        $iDed_IdDetalleDocente = $this->getInt('_Ded_IdDetalleDocente');
        $Row_Estado            = $this->getInt('_Row_Estado');
        $nombre                = $this->getSql('palabra');
        $formulario            = $this->getSql('formulario');
        $pagina                = $this->getInt('pagina');
        $filas                 = $this->getInt('filas');
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if (!$iDed_IdDetalleDocente) {
                $contenido = 'Error parametro ID ..!!';
                $mensaje   = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {

                $rowCount = $this->_usuarios->eliminarHabilitarDocente($iDed_IdDetalleDocente, $Row_Estado);
                // echo $rowCount3;//exit;
                if ($rowCount && $rowCount > 0) {
                    $contenido = 'El Docente fue eliminado correctamente...!!!';
                    $mensaje   = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                } else {
                    echo "aquii 2......!!!";
                    echo "$iDed_IdDetalleDocente";
                    echo "$Row_Estado";
                    $contenido = 'No se pudo eliminar el Docente, error de consulta...!!!';
                    $mensaje   = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                }

            }
        } else {

            $rowCount = $this->_usuarios->eliminarHabilitarDocente($iDed_IdDetalleDocente, $Row_Estado);

            if ($rowCount && $rowCount > 0) {
                $contenido = 'El Docente fue activado correctamente...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {

                $contenido = 'No se pudo activar el Docente, error en consulta...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }

        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        // Para la busqueda
        $soloActivos = 0;
        $condicion   = "";

        $paginador = new Paginador();

        $arrayRowCount  = $this->_usuarios->getDocenteRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listardocente' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$nombre", $pagina, $filas, true);

        $this->_view->assign('docentes', $this->_usuarios->getDocenteCondicion($pagina, $filas, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listardocente' . $formulario, false, true);
    }

    public function eliminarHabilitarAlumno()
    {
        $this->_acl->acceso('editar_rol');

        //Variables Ajax_Javascript
        $iDea_IdDetalleAlumno = $this->getInt('_Dea_IdDetalleAlumno');
        $Row_Estado           = $this->getInt('_Row_Estado');
        $nombre               = $this->getSql('palabra');
        $formulario           = $this->getSql('formulario');
        $pagina               = $this->getInt('pagina');
        $filas                = $this->getInt('filas');
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if (!$iDea_IdDetalleAlumno) {
                $contenido = 'Error parametro ID ..!!';
                $mensaje   = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {

                $rowCount = $this->_usuarios->eliminarHabilitarAlumno($iDea_IdDetalleAlumno, $Row_Estado);
                // echo $rowCount3;//exit;
                if ($rowCount && $rowCount > 0) {
                    $contenido = 'El Alumno fue eliminado correctamente...!!!';
                    $mensaje   = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                } else {

                    $contenido = 'No se pudo eliminar el Alumno, error de consulta...!!!';
                    $mensaje   = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                }

            }
        } else {

            $rowCount = $this->_usuarios->eliminarHabilitarAlumno($iDea_IdDetalleAlumno, $Row_Estado);

            if ($rowCount && $rowCount > 0) {
                $contenido = 'El Alumno fue activado correctamente...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {

                $contenido = 'No se pudo activar al Alumno, error en consulta...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }

        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        // Para la busqueda
        $soloActivos = 0;
        $condicion   = "";

        $paginador = new Paginador();

        $arrayRowCount  = $this->_usuarios->getAlumnoRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listaralumno' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$nombre", $pagina, $filas, true);

        $this->_view->assign('estudiantes', $this->_usuarios->getAlumnoCondicion($pagina, $filas, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listaralumno' . $formulario, false, true);
    }

///////////////////////////// CODIGO DE JOSE ///////////////////////////////////////////////////////////////////////////

    public function index($PermisoVacio = false)
    {
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->assign('titulo', 'Usuarios');
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));

        $pagina = $this->getInt('pagina');
        //$registros = $this->getInt('registros');
        $nombre = $this->getSql('nombre');
        // $this->_acl->acceso('admin');
        if ($this->botonPress("bt_guardar")) {
            $this->registrarUsuario();
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY u.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE u.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados
        $condicion .= " LIMIT 0," . CANT_REG_PAG . " ";
        // echo $condicion; exit;
        $arrayRowCount = $this->_usuarios->getUsuariosRowCount($condicion);
        // print_r($arrayRowCount);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador = new Paginador();

        $this->_view->assign('usuarios', $this->_usuarios->getUsuariosPaginado($condicion));

        $paginador->paginar($totalRegistros, "listaregistros", "", $pagina, CANT_REG_PAG, true);

        // $this->_view->assign('usuarios', $paginador->paginar($this->_usuarios->getUsuarios(), "listaregistros", "$nombre", $pagina, 25));

        $this->_view->assign('roles', $this->_aclm->getRolesCompleto());
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        // if($PermisoVacio){
        //     $this->_view->assign('_error', 'Error al editar Debe agregar permisos al Usuario');
        // }
        $this->_view->renderizar('index', 'usuarios');
    }

    public function _paginacion_listaregistros($nombre = false)
    {
        //$this->validarUrlIdioma();
        $pagina = $this->getInt('pagina');
        //$registros = $this->getInt('registros');

        $condicion = "";
        //$nombre = $this->getSql('nombre');
        if ($nombre) {
            $condicion .= " AND Usu_Usuario liKe '%$nombre%' ";
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY u.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE u.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados
        $condicion .= " LIMIT 0," . CANT_REG_PAG . " ";
        // echo $condicion; exit;
        $arrayRowCount = $this->_usuarios->getUsuariosRowCount($condicion);
        // print_r($arrayRowCount);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador = new Paginador();

        $this->_view->assign('usuarios', $this->_usuarios->getUsuariosPaginado($condicion));

        $paginador->paginar($totalRegistros, "listaregistros", "", $pagina, CANT_REG_PAG, true);

        // $this->_view->assign('usuarios', $paginador->paginar($this->_usuarios->getUsuarios(), "listaregistros", "$nombre", $pagina, 25));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listaregistros', false, true);
    }

    public function _buscarUsuario()
    {
        //$this->validarUrlIdioma();
        $nombre = $this->getSql('palabra');
        $idRol  = $this->getInt('idrol');
        //echo $idRol."/".$nombre;exit;
        $condicion = "";

        if ($nombre) {
            $condicion .= " AND Usu_Usuario liKe '%$nombre%' ";
        }
        if ($idRol > 0) {
            $condicion .= " AND u.Rol_IdRol = $idRol ";
        }
        // echo $condicion;exit;
        // print_r($this->_usuarios->getUsuarios($condicion));exit;
        $paginador = new Paginador();

        $this->_view->assign('usuarios', $paginador->paginar($this->_usuarios->getUsuarios($condicion), "listaregistros", "$nombre", false, 25));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax'));
        $this->_view->renderizar('ajax/listaregistros', false, true);
    }

    public function registrarUsuario()
    {
        $i      = 0;
        $error  = "";
        $error1 = "";
        if ($this->_usuarios->verificarUsuario($this->getSql('usuario'))) {
            $error = ' El usuario <b style="font-size: 1.15em;">' . $this->getAlphaNum('usuario') . '</b> ya existe. ';
            $i     = 1;
        }

        if ($this->_usuarios->verificarEmail($this->getSql('email'))) {
            if ($i != 0) {
                $error1 = '<br> La direccion de correo <b style="font-size: 1.15em;">' . $this->getSql('email') . '</b> ya esta registrada. ';
            } else {
                $error1 = ' La direccion de correo <b style="font-size: 1.15em;">' . $this->getSql('email') . '</b> ya esta registrada. ';
            }
            $i = 2;
        }

//        $this->getLibrary('class.phpmailer');
        //        $mail = new PHPMailer();
        if ($i == 0) {
            $random    = rand(1782598471, 9999999999);
            $idUsuario = $this->_usuarios->registrarUsuario(
                $this->getSql('nombre'),
                $this->getSql('apellidos'),
                $this->getInt('dni'),
                $this->getSql('direccion'),
                $this->getSql('telefono'),
                $this->getSql('institucion'),
                $this->getSql('cargo'),
                $this->getAlphaNum('usuario'),
                $this->getSql('contrasena'),
                $this->getSql('email'), 1, $random
            );
        }

        if (is_array($idUsuario)) {
            if ($idUsuario[0] > 0) {
                $this->_view->assign('_mensaje', 'Usuario <b style="font-size: 1.15em;">' . $this->getAlphaNum('usuario') . '</b> registrado..!!');
            } else {
                $this->_view->assign('_error', 'Error al registrar el Usuario');
            }
        } else {
            if ($i != 0) {
                $this->_view->assign('_error', $error . $error1);
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        }
    }

    public function _cambiarEstado($idUsusario = false, $estado = false)
    {
        if (!$this->filtrarInt($idUsusario)) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('index');
            exit;
        }
        $this->_usuarios->cambiarEstadoUsuario($this->filtrarInt($idUsusario), $this->filtrarInt($estado));
        $this->redireccionar('usuarios');
    }
    public function _eliminarUsuario($Usu_IdUsuario = false)
    {
        if (!$this->filtrarInt($Usu_IdUsuario)) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('index');exit;
        } else {
            $this->_usuarios->eliminarUsuario($this->filtrarInt($Usu_IdUsuario));
        }
        $this->redireccionar('usuarios');
    }
    public function divRol()
    {
        $this->_view->renderizar('ajax/div_rol', false, true);
    }
    public function divEditContra()
    {
        $this->_view->assign('idusuario', $this->getPostParam('idusuario'));
        $this->_view->renderizar('ajax/editarContrasena', false, true);
    }

    public function rol($usuarioID, $nuevoRol = false)
    {

        if ($nuevoRol) {
            $rolID = $this->_usuarios->insertarRol($nuevoRol, '', 1);
            if (is_array($rolID)) {
                if ($rolID[0] > 0) {
                    $this->_view->assign('_mensaje', 'El Rol <b>' . $nuevoRol . '</b> fue registrado correctamente..!!');
                } else {
                    $this->_view->assign('_error', 'Error al registrar el Rol');
                }
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        } else {
            $this->validarUrlIdioma();
            $this->_view->getLenguaje("index_inicio");
        }
        $this->_view->setJs(array('index'));

        $id        = $this->filtrarInt($usuarioID);
        $condicion = '';
        if ($this->botonPress("bt_guardarUsuario")) {
            $this->editarUsuario();
        }
        if ($this->botonPress("bt_guardarContrasena")) {
            $this->editarUsuario($id);
        }
        $usu = $this->_usuarios->getUsuario($id);
        //if ($usu['Rol_IdRol']) {
        //    $condicion .= " and u.Rol_IdRol = ".$usu['Rol_IdRol']." ";
        //}
        //$rolUsuario = $this->_usuarios->getUsuarios($condicion);
        $this->_view->assign('titulo', 'Editar Usuario');
        $this->_view->assign('idusuario', $id);
        $this->_view->assign('datos', $usu);
        //print_r($usu);
        //$this->_view->assign('rol', $rolUsuario['Rol_role']);
        $this->_view->assign('roles', $this->_usuarios->getRoles());
        if ($nuevoRol) {
            $this->_view->renderizar('ajax/rol_usuario', false, true);
        } else {
            $this->_view->renderizar('rol');
        }
    }

//Modificado Jhon Martinez
    public function permisos($usuarioID)
    {
        $this->_acl->acceso('agregar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        //   $this->_acl->acceso('admin');
        $id = $this->filtrarInt($usuarioID);

        if (!$id) {
            $this->redireccionar('usuarios');
        }
        if ($this->getInt('guardar') == 1) {
            $values   = array_keys($_POST);
            $replace  = array();
            $eliminar = array();

            for ($i = 0; $i < count($values); $i++) {
                if (substr($values[$i], 0, 5) == 'perm_') {
                    $permiso = (strlen($values[$i]) - 5);

                    if ($_POST[$values[$i]] == 'x') {
                        $eliminar[] = array(
                            'usuario' => $id,
                            'permiso' => substr($values[$i], -$permiso),
                        );
                    } else {
                        if ($_POST[$values[$i]] == 1) {
                            $v = 1;
                        } else {
                            $v = 0;
                        }
                        $replace[] = array(
                            'usuario' => $id,
                            'permiso' => substr($values[$i], -$permiso),
                            'valor'   => $v,
                        );
                    }
                }
            }

            for ($i = 0; $i < count($eliminar); $i++) {
                $this->_usuarios->eliminarPermiso(
                    $eliminar[$i]['usuario'], $eliminar[$i]['permiso']);
            }

            for ($i = 0; $i < count($replace); $i++) {
                $this->_usuarios->editarPermiso(
                    $replace[$i]['usuario'], $replace[$i]['permiso'], $replace[$i]['valor']);
            }
            $this->redireccionar('usuarios');
        }

        $permisosUsuario = $this->_usuarios->getPermisosUsuario($id);
        $permisosRole    = $this->_usuarios->getPermisosRoles($id);

        if (!$permisosUsuario || !$permisosRole) {
            $this->redireccionar('usuarios/index/index/vacio');
        }
        ///print_r($permisosUsuario);exit;
        $this->_view->assign('titulo', 'Permisos de usuario');
        $this->_view->assign('permisos', array_keys($permisosUsuario));
        $this->_view->assign('usuario', $permisosUsuario);
        $this->_view->assign('roles', $permisosRole);
        $this->_view->assign('info', $this->_usuarios->getUsuario($id));
        $this->_view->assign('numeropagina', 1);

        $this->_view->renderizar('permisos', 'permisos');
    }

    public function editarUsuario($Usu_IdUsuario = false)
    {
        $i      = 0;
        $error  = "";
        $error1 = "";
        /* $usu = $this->_usuarios->verificarUsuario($this->getSql('usuario'));
        // print_r($usu);exit;
        if($usu[0]!=$this->getInt('idusuario')){
        $error = ' El usuario <b style="font-size: 1.15em;">' . $this->getSql('usuario') . '</b> ya existe. ';
        $i=1;
        }
         */
        if ($Usu_IdUsuario) {
            $idUsuario = $this->_usuarios->editarUsuarioClave(
                $this->getSql('contrasena'),
                $this->getInt('idusuario')
            );

            if ($idUsuario > 0) {
                $this->_view->assign('_mensaje', 'Contraseña cambiado correctamente...!!');
            } else {
                $this->_view->assign('_error', 'Error al editar el Contraseña');
            }
        } else {
            $usuEmail = $this->_usuarios->verificarEmail($this->getSql('email'));

            if (!empty($usuEmail) && $usuEmail['Usu_IdUsuario'] != $this->getInt('idusuario')) {
                if ($i != 0) {
                    $error1 = '<br> La direccion de correo <b style="font-size: 1.15em;">' . $this->getSql('email') . '</b> ya esta registrada. ';
                } else {
                    $error1 = ' La direccion de correo <b style="font-size: 1.15em;">' . $this->getSql('email') . '</b> ya esta registrada. ';
                }
                $i = 2;
            }
            // $random = rand(1782598471, 9999999999);
            if ($i == 0) {
                $idUsuario = $this->_usuarios->editarUsuario(
                    $this->getSql('nombre'),
                    $this->getSql('apellidos'),
                    $this->getSql('dni'),
                    $this->getSql('direccion'),
                    $this->getSql('telefono'),
                    $this->getSql('institucion'),
                    $this->getSql('cargo'),
                    $this->getSql('email'),
                    $this->getInt('Rol_IdRol'),
                    $this->getInt('idusuario')
                );

                if ($idUsuario) {
                    $this->_view->assign('_mensaje', 'Edición del Usuario <b style="font-size: 1.15em;">' . $this->getAlphaNum('usuario') . '</b> completado..!!');
                } else {
                    $this->_view->assign('_error', 'Error al editar el Usuario');
                }
            } else {
                $this->_view->assign('_error', $error . $error1);
            }
        }
    }
}
