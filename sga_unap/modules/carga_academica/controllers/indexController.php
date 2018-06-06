<?php

class indexController extends carga_academicaController
{
    private $_indexModel;

    public function __construct($lang, $url)
    {
        parent::__construct($lang, $url);
        $this->_indexModel = $this->loadModel('index');
    }

    public function index()
    {
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        // $this->_view->setCss(array('base','layout'));

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        if ($this->botonPress("bt_guardarCargaAcademica")) {
            $this->nuevo_cargaAcademica();
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY ca.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE ca.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount  = $this->_indexModel->getCargasAcademicasRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador  = new Paginador();
        $formulario = "CargasAcademicas";
        $escuela    = $this->_indexModel->getEscuelaXUsuarioRol(Session::get('id_usuario'));
        // print_r($escuela);
        $this->_view->assign('semestres', $this->_indexModel->getSemestres());
        $this->_view->assign('docentes', $this->_indexModel->getDocentes());
        $this->_view->assign('curriculas', $this->_indexModel->getCurriculasXEscuelaID($escuela['Esc_IdEscuela']));
        $this->_view->assign('escuela', $escuela);
        $this->_view->assign('listaDatos', $this->_indexModel->getCargasAcademicasPaginado($pagina, CANT_REG_PAG, $soloActivos));

        $paginador->paginar($totalRegistros, "listar" . $formulario, "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de Carga Académica');
        $this->_view->renderizar($formulario);
    }

    //Modificado por Jhon Martinez
    public function _actualizarCurso()
    {
        $Cui_IdCurricula = $this->getInt('Cui_IdCurricula');

        $this->_view->assign('cursos', $this->_indexModel->getCursoXCurriculaID($Cui_IdCurricula));

        $this->_view->renderizar('ajax/Cur_IdCurso', false, true);
    }
    //Modificado por Jhon Martinez
    public function nuevo_cargaAcademica($usu = false)
    {
        $this->_acl->acceso('agregar_rol');
        if ($this->_indexModel->verificarCargaAcademica($this->getSql('Cur_IdCurso'), $this->getSql('Usr_IdUsuarioRol'), $this->getSql('Sem_IdSemestre'))) {
            $this->_view->assign('_error', 'Carga Académica ya existe');
        } else {
            // echo $this->getSql('nuevoFacultad').$this->getSql('nuevoDireccion').$this->getSql('nuevoTelefono');
            $ArrayId = $this->_indexModel->insertarCargaAcademica(
                $this->getSql('nuevoSelGrupo'), $this->getSql('nuevoSelTipoCargaAcademica'), $this->getSql('nuevoVacantes'), $this->getSql('Cur_IdCurso'), $this->getSql('Usr_IdUsuarioRol'), $this->getSql('Sem_IdSemestre'), 1, 1
            );
            // print_r($idRol);
            if (is_array($ArrayId)) {
                if ($ArrayId[0] > 0) {

                    $this->_view->assign('_mensaje', 'Registro Completado..!!');
                } else {
                    $this->_view->assign('_error', 'Error al registrar Facultad');
                }
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        }

        if ($usu) {
            $this->_view->renderizar('ajax/nuevo_cargaAcademica', false, true);
        }
    }
    //Modificado por Jhon Martinez
    public function editarHorarioCargaAcademica($Caa_IdCargaAcademica = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        // $HorariosCargaAcademica = $this->_indexModel->getHorariosXIdCargaAcademica($this->filtrarInt($Caa_IdCargaAcademica));
        $CargasAcademica = $this->_indexModel->getCargaAcademicaCurso($this->filtrarInt($Caa_IdCargaAcademica));

        if ($this->botonPress("bt_cancelarEditarHorarioCarga")) {
            $this->redireccionar('carga_academica');
        }

        if ($this->botonPress("bt_cancelarHorario")) {
            $this->redireccionar('carga_academica');
        }

        if ($this->botonPress("bt_editarHorarioCarga")) {
            // if($this->getSql('idIdiomaSeleccionado') == $facultad['Idi_IdIdioma'])
            // {
            $id = $this->_indexModel->editarCargaAcademica($this->filtrarInt($Caa_IdCargaAcademica), $this->getSql('editarSelGrupo'), $this->getSql('editarSelTipoCargaAcademica'), $this->getSql('editarVacantes'), $this->getSql('Cur_IdCurso'), $this->getSql('Usr_IdUsuarioRol'), $this->getSql('Sem_IdSemestre'));
            // echo($id);
            if ($id > 0) {
                $this->_view->assign('_mensaje', 'Carga Academica editado Correctamente');
                $CargasAcademica = $this->_indexModel->getCargaAcademicaCurso($this->filtrarInt($Caa_IdCargaAcademica));
            } else {
                $this->_view->assign('_error', 'Error al editar Carga Academica');
            }
        }
        // $this->_view->assign('idiomas',$this->_indexModel->getIdiomas());
        if ($this->botonPress("bt_guardarHorario")) {
            // if($this->getSql('idIdiomaSeleccionado') == $facultad['Idi_IdIdioma'])
            // {
            $ArrayId = $this->_indexModel->registrarHorario($this->filtrarInt($Caa_IdCargaAcademica), $this->getSql('Hor_Dia'), $this->getSql('Hor_Inicio'), $this->getSql('Hor_Fin'), $this->getSql('Hor_Tipo'), $this->getSql('Amb_IdAmbiente'));
            // print_r($ArrayId); echo("aaaa"); exit;
            if ($ArrayId[0] > 0) {
                $CargasAcademica = $this->_indexModel->agregarHorarioCargaAcademica($this->filtrarInt($Caa_IdCargaAcademica), $ArrayId[0]);
                $this->_view->assign('_mensaje', 'Horario editado Correctamente');
                // $CargasAcademica = $this->_indexModel->getCargaAcademicaCurso($this->filtrarInt($Caa_IdCargaAcademica));
            } else {
                $this->_view->assign('_error', 'Error al editar Horario');
            }
        }

        $escuela = $this->_indexModel->getEscuelaXUsuarioRol(Session::get('id_usuario'));
        // print_r($this->_indexModel->getCurriculasXEscuelaID($escuela['Esc_IdEscuela']));
        $this->_view->assign('formulario', 'HorariosCarga');
        $this->_view->assign('listaDatos', $this->_indexModel->getHorariosXIdCargaAcademica($Caa_IdCargaAcademica));
        $this->_view->assign('ambientes', $this->_indexModel->getAmbientes());
        $this->_view->assign('semestres', $this->_indexModel->getSemestres());
        $this->_view->assign('docentes', $this->_indexModel->getDocentes());
        $this->_view->assign('cursos', $this->_indexModel->getCursoXCurriculaID($escuela['Cui_IdCurricula']));
        $this->_view->assign('curriculas', $this->_indexModel->getCurriculasXEscuelaID($escuela['Esc_IdEscuela']));
        $this->_view->assign('escuela', $escuela);
        // print_r($CargasAcademica);

        $this->_view->assign('datos', $CargasAcademica);
        $this->_view->assign('numeropagina', 1);
        $this->_view->assign('titulo', 'Administración de Carga Académica');
        $this->_view->renderizar('ajax/editarHorarioCargaAcademica', 'editarHorarioCargaAcademica');
    }

// CURSOS
    //Modificado por Jose
    public function curso()
    {
        //echo("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre    = $this->getSql('nombre');
        $pagina    = $this->getInt('pagina');
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardarCurso")) {
            $this->nuevo_curso();
        }
        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY cur.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE cur.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados
        $arrayRowCount  = $this->_indexModel->getCursoRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        // $this->_view->assign('roles', $paginador->paginar($this->_indexModel->getRoles(), "listarRoles", "$nombre", $pagina, 25));
        // $this->_view->assign('facultad', $this->_indexModel->getFacultades());
        $this->_view->assign('escuelas', $this->_indexModel->getEscuelas());
        $this->_view->assign('curso', $this->_indexModel->getCursoPaginado($pagina, CANT_REG_PAG, $soloActivos));
        $paginador->paginar($totalRegistros, "listarCurso", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de cursos');
        $this->_view->renderizar('curso');
    }
    public function actualizarcurricula()
    {

        $Esc_IdEscuela = $this->getInt('Esc_IdEscuela');
        $condicion     = " WHERE Cui_Estado = 1 AND Esc_IdEscuela = $Esc_IdEscuela";
        $this->_view->assign('curricula', $this->_indexModel->getCurriculas($condicion));
        $this->_view->renderizar('ajax/Cui_IdCurricula', false, true);
    }
    public function actualizarciclo_curricula()
    {
        $Cui_IdCurricula = $this->getInt('Cui_IdCurricula');
        // $condicion = " WHERE ciu.Ciu_IdCurricula = $Cui_IdCurricula";
        // $condicion = "WHERE ciu.Cui_IdCurricula = $Cui_IdCurricula";
        //$Cui_IdCurricula
        $this->_view->assign('ciclo_curricula', $this->_indexModel->getCicloCurricula($Cui_IdCurricula));
        $this->_view->renderizar('ajax/Ciclo_Curricula', false, true);
    }
    public function actualizarcursorequi()
    {
        $Cui_IdCurricula = $this->getInt('Cui_IdCurricula');
        //   $condicion = " WHERE Cur_Estado = 1 AND Cui_IdCurricula = $Cui_IdCurricula";
        $this->_view->assign('cursor', $this->_indexModel->getCur_Requisito($Cui_IdCurricula));
        $this->_view->renderizar('ajax/Cur_requi', false, true);
    }
    public function nuevo_curso($usu = false)
    {
        $this->_acl->acceso('agregar_rol');

        $idCurso = $this->_indexModel->insertarCurso(
            $this->getSql('nombre_curso'),
            $this->getSql('codigo_curso'),
            $this->getSql('credito_curso'),
            $this->getSql('hora_teoria'),
            $this->getSql('hora_practica'),
            $this->getSql('dura_curso'),
            $this->getSql('tipo_curso'),
            $this->getSql('selciclo_curricula'),
            //$this->getSql('cursor'),
            1, 1
        );
        if (is_array($idCurso)) {
            if ($idCurso[0] > 0) {
                $this->_indexModel->insertarCursoRequisito($idCurso[0], $this->getSql('cursor'));
                $this->_view->assign('_mensaje', 'Registro Completado..!!');
            } else {
                $this->_view->assign('_error', 'Error al registrar el curso');
            }
        } else {
            $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
        }

        if ($usu) {
            $this->_view->renderizar('ajax/nuevo_curso', false, true);
        }

    }

    public function editarCurso($Cur_IdCurso = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $curso = $this->_indexModel->getCurso($this->filtrarInt($Cur_IdCurso));

        if ($this->botonPress("bt_cancelarEditarCurso")) {
            $this->redireccionar('carga_academica/index/curso');
        }

        if ($this->botonPress("bt_editarCurso")) {

            $id = $this->_indexModel->editarCurso($this->filtrarInt($Cur_IdCurso),
                $this->getSql('nombre_curso'),
                $this->getSql('codigo_curso'),
                $this->getSql('credito_curso'),
                $this->getSql('hora_teoria'),
                $this->getSql('hora_practica'),
                $this->getSql('dura_curso'),
                $this->getSql('tipo_curso'),
                $this->getSql('selciclo_curricula'),
                //$this->getSql('cursor'),
                1, 1
            );
            if ($id) {
                $this->_indexModel->update_curso_requisito($this->filtrarInt($Cur_IdCurso), $this->getSql('cursor'));
                $this->_view->assign('_mensaje', 'Curso editado Correctamente');
                $curso = $this->_indexModel->getCurso($this->filtrarInt($Cur_IdCurso));
                //  $this->redireccionar('acl/index/listarcurso');
                //exit;
            } else {
                $this->_view->assign('_error', 'Error al editar Curso');
            }

            //$this->redireccionar('acl/index/roles');
            //exit;
        }

        $this->_view->assign('escuelas', $this->_indexModel->getEscuelas());

        $idescuela = $curso['Esc_IdEscuela'];
        $condicion = " WHERE Cui_Estado = 1 AND Esc_IdEscuela = $idescuela";
        $this->_view->assign('curricula', $this->_indexModel->getCurriculas($condicion));

        $Cui_IdCurricula = $curso['Cui_IdCurricula'];
        $this->_view->assign('ciclo_curricula', $this->_indexModel->getCicloCurricula($Cui_IdCurricula));

        $Cur_IdCurso        = $curso['Cur_IdCurso'];
        $id_curso_requisito = $this->_indexModel->getCur_Requisito_uno($Cur_IdCurso);
        $id_curso_requisito = $id_curso_requisito[0]["Cur_IdRequisito"];

        $curso['id_curso_requisito'] = $id_curso_requisito;
        $this->_view->assign('cursor', $this->_indexModel->getCur_Requisito($Cui_IdCurricula));

        // $this->_view->assign('escuelas',$this->_indexModel->getEscuelas());
        $this->_view->assign('datos', $curso);
        $this->_view->renderizar('ajax/editarCurso', 'editarCurso');
    }
    public function _buscarCurso()
    {

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cur_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND cur.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY cur.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY cur.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE cur.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getCursoRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar($totalRegistros, "listarcurso", "$txtBuscar", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('curso', $this->_indexModel->getCursoCondicion($pagina, CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarcurso', false, true);
    }

// FACULTADES
    //Modificado por Jhon Martinez
    public function facultades()
    {
        // echo $id ." ////// ". $nombre;
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        $this->_view->setJs(array('index'));
        // $this->_view->setCss(array('base','layout'));

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        if ($this->botonPress("bt_guardarFacultad")) {
            $this->nuevo_facultad();
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY f.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE f.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount  = $this->_indexModel->getFacultadesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador  = new Paginador();
        $formulario = "Facultades";
        $this->_view->assign('listaDatos', $this->_indexModel->getFacultadesPaginado($pagina, CANT_REG_PAG, $soloActivos));

        $paginador->paginar($totalRegistros, "listar" . $formulario, "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de Facultades');
        $this->_view->renderizar($formulario);
    }
    //Modificado por Jhon Martinez
    public function nuevo_facultad($usu = false)
    {
        $this->_acl->acceso('agregar_rol');

        if ($this->_indexModel->verificarFacultad($this->getSql('nuevoFacultad'))) {
            $this->_view->assign('_error', 'La Facultad <b style="font-size: 1.15em;">' . $this->getSql('nuevoFacultad') . '</b> ya existe');
        } else {
            // echo $this->getSql('nuevoFacultad').$this->getSql('nuevoDireccion').$this->getSql('nuevoTelefono');
            $idRol = $this->_indexModel->insertarFacultad(
                $this->getSql('nuevoFacultad'), $this->getSql('nuevoDireccion'), $this->getSql('nuevoTelefono'), 1, 1
            );
            // print_r($idRol);
            if (is_array($idRol)) {
                if ($idRol[0] > 0) {
                    $this->_view->assign('_mensaje', 'Registro Completado..!!');
                } else {
                    $this->_view->assign('_error', 'Error al registrar Facultad');
                }
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        }

        if ($usu) {
            $this->_view->renderizar('ajax/nuevo_facultad', false, true);
        }
    }
    //Modificado por Jhon Martinez
    public function _buscarFacultades()
    {
        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        // Para Busqueda
        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Fac_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND f.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY f.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY f.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE f.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getFacultadesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getFacultadesCondicion($pagina, CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _paginacion_listarFacultades($txtBuscar = false)
    {
        //$this->validarUrlIdioma();
        // $pagina = $this->getInt('pagina');
        //$registros = $this->getInt('registros');

        // $nombre = $this->getSql('nombre');
        // if ($nombre) {
        //     $condicion .= " where Fac_Nombre liKe '%$nombre%' ";
        // }

        //Variables de Ajax_JavaScript
        $pagina         = $this->getInt('pagina');
        $nombreLista    = $this->getSql('nombrelista');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Fac_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND f.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY f.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY f.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE f.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        // $this->_view->assign('facultades', $paginador->paginar($this->_indexModel->getfacultades($condicion), "listarFacultades", "$nombre", $pagina, 25));

        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getFacultadesCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _cambiarEstadoFacultades()
    {
        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $IdRegistro     = $this->getInt('_IdRegistro');
        $EstadoRegistro = $this->getInt('_EstadoRegistro');

        if (!$IdRegistro) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('index');
            exit;
        } else {
            //Actualizacion de estado en la BD
            // echo $IdRegistro.$EstadoRegistro;exit;
            $rowCountEstado = $this->_indexModel->cambiarEstadoFacultad($IdRegistro, $EstadoRegistro);
            //Mensaje de Actualizacion
            if ($rowCountEstado > 0) {
                if ($EstadoRegistro == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';
                }
                if ($EstadoRegistro == 0) {
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
        if ($txtBuscar) {
            $condicion = " WHERE Fac_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND f.Row_Estado = $soloActivos ";
            }

        } else {
            //Filtro por Activos/Eliminados
            $condicion = " ORDER BY f.Row_Estado DESC ";
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE f.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getFacultadesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('listaDatos', $this->_indexModel->getFacultadesCondicion($pagina, $filas, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar' . $formulario, false, true);
    }
    //Modificado por Jhon Martinez
    public function editarFacultades($Fac_IdFacultad = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $facultad = $this->_indexModel->getFacultad($this->filtrarInt($Fac_IdFacultad));

        if ($this->botonPress("bt_cancelarEditarFacultad")) {
            $this->redireccionar('carga_academica/index/facultades');
        }

        if ($this->botonPress("bt_editarFacultad")) {
            // if($this->getSql('idIdiomaSeleccionado') == $facultad['Idi_IdIdioma'])
            // {
            $id = $this->_indexModel->editarFacultad($this->filtrarInt($Fac_IdFacultad),
                $this->getSql('Fac_Nombre'),
                $this->getSql('Fac_Direccion'),
                $this->getSql('Fac_Telefono'));

            if ($id) {
                $this->_view->assign('_mensaje', 'Facultad editado Correctamente');
                $facultad = $this->_indexModel->getFacultad($this->filtrarInt($Fac_IdFacultad));
            } else {
                $this->_view->assign('_error', 'Error al editar Facultad');
            }
        }
        // $this->_view->assign('idiomas',$this->_indexModel->getIdiomas());
        $this->_view->assign('datos', $facultad);
        $this->_view->renderizar('ajax/editarFacultad', 'editarFacultad');
    }
    //Modificado por Jhon Martinez
    public function _eliminarFacultades()
    {
        //Variables Ajax_Javascript
        $IdRegistro = $this->getInt('_IdRegistro');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar  = $this->getSql('palabra');
        $formulario = $this->getSql('formulario');
        $pagina     = $this->getInt('pagina');
        $filas      = $this->getInt('filas');
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if (!$IdRegistro) {
                $contenido = 'Error parametro ID ..!!';
                $mensaje   = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $relacion = $this->_indexModel->getEscuelaFacultad($IdRegistro);
                // print_r($facultade);
                if ($relacion <= 0) {
                    $rowCount = $this->_indexModel->eliminarHabilitarFacultad($IdRegistro, $Row_Estado);
                    // echo $rowCount3;//exit;
                    if ($rowCount && $rowCount > 0) {
                        $contenido = 'La Facultad fue eliminado correctamente...!!!';
                        $mensaje   = "ok";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                    } else {
                        $contenido = 'No se pudo eliminar Facultad, error de consulta...!!!';
                        $mensaje   = "error";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                    }

                } else {
                    $contenido = 'No se pudo eliminar Facultad asignado a escuela...!!!';
                    $mensaje   = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                }
                // echo $error;exit;
            }
        } else {
            $rowCount = $this->_indexModel->eliminarHabilitarFacultad($IdRegistro, $Row_Estado);

            if ($rowCount && $rowCount > 0) {
                $contenido = 'La Facultad fue activado correctamente...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar Facultad, error en consulta...!!! id=' . $IdRegistro . "/" . $Row_Estado;
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
        if ($txtBuscar) {
            $condicion = " WHERE Fac_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND f.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY f.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY f.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE f.Row_Estado = $soloActivos  ";
            }
        }
        // Para la busqueda

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getFacultadesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getFacultadesCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }

// ESCUELA
    public function escuelas()
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        $paginador = new Paginador();
        if ($this->botonPress("bt_guardarEscuela")) {
            $this->nueva_escuela();
        }

        $this->_view->assign('titulo', 'Administar Escuelas');
        $this->_view->assign('facultades', $this->_indexModel->getFacultades());
        $this->_view->assign('escuelas', $paginador->paginar($this->_indexModel->getEscuelas(), "listarEscuelas", "$nombre", $pagina, 25));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax'));
        $this->_view->renderizar('escuelas');
    }
    public function nueva_escuela($usu = false)
    {
        $this->_acl->acceso('editar_rol');
        // if(!$this->getSql('nuevoEscuela'))
        // {
        //     if(!$usu)
        //     {
        //         $this->_view->assign('_error','Debe llenar el campo Reino Taxonómico.');
        //         $this->_view->renderizar('ajax/nuevo_rol', false, true);
        //     }
        // }
        if ($this->_indexModel->getEscuela(" WHERE Esc_Nombre = '" . $this->getSql('nuevoEscuela') . "'")) {
            $this->_view->assign('_error', 'La Escuela <b style="font-size: 1.15em;">' . $this->getSql('nuevoEscuela') . '</b> ya existe');
        } else {
            $idEscuela = $this->_indexModel->insertarEscuela(
                $this->getSql('nuevoEscuela'), $this->getSql('nuevoDescripcion'), $this->getSql('nuevoDireccion'), $this->getSql('nuevoTelefono'), $this->getSql('selFacultad'), 1, 1
            );
            if (is_array($idEscuela)) {
                if ($idEscuela[0] > 0) {
                    $this->_view->assign('_mensaje', 'Registro Completado..!!');
                } else {
                    $this->_view->assign('_error', 'Error al registrar la Escuela');
                }
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        }

        // if($usu)
        // {
        //     $this->_view->renderizar('ajax/nuevo_rol', false, true);
        // }
    }
    public function _paginacion_listarEscuelas($nombre = false)
    {
        //$this->validarUrlIdioma();
        $pagina = $this->getInt('pagina');
        //$registros = $this->getInt('registros');

        $condicion = "";
        //$nombre = $this->getSql('nombre');
        if ($nombre) {
            $condicion .= " WHERE Esc_Nombre LIKE '%$nombre%' ";
        }

        $paginador = new Paginador();

        $this->_view->assign('escuelas', $paginador->paginar($this->_indexModel->getEscuelas($condicion), "listarEscuelas", "$nombre", $pagina, 25));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax'));
        $this->_view->renderizar('ajax/listarEscuelas', false, true);
    }
    public function _buscarEscuela()
    {
        //$this->validarUrlIdioma();
        $nombre    = $this->getSql('palabra');
        $condicion = "";
        // echo $nombre;exit;

        if ($nombre) {
            $condicion .= " WHERE e.Esc_Nombre liKe '%$nombre%' ";
        }

        $paginador = new Paginador();

        $this->_view->assign('escuelas', $paginador->paginar($this->_indexModel->getEscuelas($condicion), "listarEscuelas", "$nombre", false, 25));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax'));
        $this->_view->renderizar('ajax/listarEscuelas', false, true);
    }

    public function editarEscuela($Esc_IdEscuela = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $escuela    = $this->_indexModel->getEscuela(" WHERE Esc_IdEscuela = " . $this->filtrarInt($Esc_IdEscuela));
        $facultades = $this->_indexModel->getFacultades();

        if ($this->botonPress("bt_cancelarEditarEscuela")) {
            $this->redireccionar('carga_academica/index/escuelas');
        }
        if ($this->botonPress("bt_editarEscuela")) {
            // if($this->getSql('idIdiomaSeleccionado') == $rol['Idi_IdIdioma'])
            // {
            $id = $this->_indexModel->editarEscuela($this->filtrarInt($Esc_IdEscuela), $this->getSql('editarNombre'), $this->getSql('editarDescripcion'), $this->getSql('editarDireccion'), $this->getSql('editarTelefono'), $this->getSql('selFacultad'));
            if ($id) {
                $this->_view->assign('_mensaje', 'Escuela editado Correctamente');
                $escuela = $this->_indexModel->getEscuela(" WHERE Esc_IdEscuela = " . $this->filtrarInt($Esc_IdEscuela));
            } else {
                $this->_view->assign('_error', 'Error al editar Escuela');
            }

        }
        if ($this->botonPress("bt_cancelarEditarEscuela")) {

        }
        // $this->_view->assign('idiomas',$this->_indexModel->getIdiomas());
        $this->_view->assign('datos', $escuela);
        $this->_view->assign('facultades', $facultades);
        $this->_view->renderizar('ajax/editarEscuela', 'editarEscuela');
    }
    public function _cambiarEstadoEscuela($Esc_IdEscuela = false, $estado = 0)
    {
        $this->_acl->acceso('editar_rol');

        if (!$this->filtrarInt($Esc_IdEscuela)) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('index');
            exit;
        }

        $this->_indexModel->cambiarEstadoEscuela($this->filtrarInt($Esc_IdEscuela), $this->filtrarInt($estado));
        $this->escuelas();
    }

// CURRICULAS
    //Modificado por Jhon Martinez
    public function curriculas()
    {
        // echo $id ." ////// ". $nombre;
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        $this->_view->setJs(array('index'));
        // $this->_view->setCss(array('base','layout'));

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        if ($this->botonPress("bt_guardarNuevo")) {
            $this->nueva_curricula();
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY c.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE c.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount  = $this->_indexModel->getCurriculasRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $this->_view->assign('escuelas', $this->_indexModel->getEscuelas());

        $paginador  = new Paginador();
        $formulario = "Curriculas";
        $this->_view->assign('listaDatos', $this->_indexModel->getCurriculasPaginado($pagina, CANT_REG_PAG, $soloActivos));
        $paginador->paginar($totalRegistros, 'listar' . $formulario, "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de Curriculas');
        $this->_view->renderizar($formulario);
    }
    //Modificado por Jhon Martinez
    public function nueva_curricula()
    {
        $this->_acl->acceso('agregar_rol');
        if ($this->_indexModel->verificarCurricula($this->getSql('nuevoCurricula'), $this->getSql('nuevoCodigo'), $this->getSql('nuevoResolucion'))) {
            $this->_view->assign('_error', 'La Curricula <b style="font-size: 1.15em;">' . $this->getSql('nuevoCurricula') . '</b> ya existe');
        } else {
            // echo $this->getSql('nuevoCurricula').$this->getSql('nuevoDescripcion').$this->getSql('nuevoCodigo')."/".$this->getSql('nuevoResolucion')."/".$this->getSql('nuevoSelEscuela'); exit;
            $idRegistro = $this->_indexModel->insertarCurricula(
                $this->getSql('nuevoCurricula'), $this->getSql('nuevoDescripcion'), $this->getSql('nuevoCodigo'), $this->getSql('nuevoResolucion'), $this->getSql('nuevoSelEscuela'), 1, 1
            );
            // print_r($idRol);
            if (is_array($idRegistro)) {
                if ($idRegistro[0] > 0) {
                    $this->_view->assign('_mensaje', 'Registro Completado..!!');
                } else {
                    $this->_view->assign('_error', 'Error al registrar Curricula');
                }
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        }

    }
    //Modificado por Jhon Martinez
    public function _buscarCurriculas()
    {

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cui_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY c.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY c.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getCurriculasRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('listaDatos', $this->_indexModel->getCurriculasCondicion($pagina, CANT_REG_PAG, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _paginacion_listarCurriculas($txtBuscar = false)
    {

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $nombreLista    = $this->getSql('nombrelista');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        // Para la busqueda
        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cui_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY c.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY c.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCurriculasCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _cambiarEstadoCurriculas()
    {
        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $IdRegistro     = $this->getInt('_IdRegistro');
        $EstadoRegistro = $this->getInt('_EstadoRegistro');

        if (!$IdRegistro) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('index');
            exit;
        } else {
            //Actualizacion de estado en la BD
            // echo $Fac_IdFacultad.$EstadoRegistro;exit;
            $rowCountEstado = $this->_indexModel->cambiarEstadoCurricula($IdRegistro, $EstadoRegistro);
            //Mensaje de Actualizacion
            if ($rowCountEstado > 0) {
                if ($EstadoRegistro == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';
                }
                if ($EstadoRegistro == 0) {
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
        if ($txtBuscar) {
            $condicion = " WHERE Cui_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            }

        } else {
            //Filtro por Activos/Eliminados
            $condicion = " ORDER BY c.Row_Estado DESC ";
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }

        $arrayRowCount  = $this->_indexModel->getCurriculasRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador = new Paginador();

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCurriculasCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function editarCurriculas($Cui_IdCurricula = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        // echo $this->filtrarInt($Cui_IdCurricula);
        $Curricula = $this->_indexModel->getCurricula($this->filtrarInt($Cui_IdCurricula));

        if ($this->botonPress("bt_cancelarEditarCurricula")) {
            $this->redireccionar('carga_academica/index/curriculas');
        }

        if ($this->botonPress("bt_editarCurricula")) {

            $id = $this->_indexModel->editarCurricula($this->filtrarInt($Cui_IdCurricula), $this->getSql('editarCurricula'), $this->getSql('editarDescripcion'), $this->getSql('editarCodigo'), $this->getSql('editarResolucion'), $this->getSql('editarSelEscuela'));

            if ($id) {
                $this->_view->assign('_mensaje', 'Curricula editado Correctamente');
                $Curricula = $this->_indexModel->getCurricula($this->filtrarInt($Cui_IdCurricula));
            } else {
                $this->_view->assign('_error', 'Error al editar Curricula');
            }

            // print_r($Curricula);
            $this->_view->assign('escuelas', $this->_indexModel->getEscuelas());
            // $this->_view->assign('idiomas',$this->_indexModel->getIdiomas());
            $this->_view->assign('datos', $Curricula);
            $this->_view->renderizar('ajax/editarCurricula', 'editarCurricula');
        }
    }

    public function _eliminarCurriculas()
    {
        $this->_acl->acceso('editar_rol');

        //Variables Ajax_Javascript
        $IdRegistro = $this->getInt('_IdRegistro');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar  = $this->getSql('palabra');
        $formulario = $this->getSql('formulario');
        $pagina     = $this->getInt('pagina');
        $filas      = $this->getInt('filas');
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if (!$IdRegistro) {
                $contenido = 'Error parametro ID ..!!';
                $mensaje   = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                // $relacion = $this->_indexModel->getEscuelaCurricula($IdRegistro);
                // print_r($facultade);
                // if ($relacion <= 0)
                // {
                $rowCount = $this->_indexModel->eliminarHabilitarCurricula($IdRegistro, $Row_Estado);
                // echo $rowCount3;//exit;
                if ($rowCount && $rowCount > 0) {
                    $contenido = 'La curricula fue eliminado correctamente...!!!';
                    $mensaje   = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                } else {
                    $contenido = 'No se pudo eliminar curricula, error de consulta...!!!';
                    $mensaje   = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                }

            }
        } else {
            $rowCount = $this->_indexModel->eliminarHabilitarCurricula($IdRegistro, $Row_Estado);

            if ($rowCount && $rowCount > 0) {
                $contenido = 'La curricula fue activado correctamente...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar curricula, error en consulta...!!!';
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
        if ($txtBuscar) {
            $condicion = " WHERE Cui_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY c.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY c.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }
        // Para la busqueda

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getCurriculasRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCurriculasCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }

// CICLOS
    //Modificado por Jhon Martinez
    public function ciclos()
    {
        // echo $id ." ////// ". $nombre;
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        $this->_view->setJs(array('index'));
        // $this->_view->setCss(array('base','layout'));

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        if ($this->botonPress("bt_guardarNuevo")) {
            $this->nuevo_ciclo();
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY c.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE c.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount  = $this->_indexModel->getCiclosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador  = new Paginador();
        $formulario = "Ciclos";

        $this->_view->assign('escuelas', $this->_indexModel->getEscuelas());
        // print_r($this->_indexModel->getCiclosPaginado($pagina,CANT_REG_PAG,$soloActivos));exit;
        $this->_view->assign('listaDatos', $this->_indexModel->getCiclosPaginado($pagina, CANT_REG_PAG, $soloActivos));
        $paginador->paginar($totalRegistros, 'listar' . $formulario, "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de Curriculas');
        $this->_view->renderizar($formulario);
    }
    //Modificado por Jhon Martinez
    public function nuevo_ciclo()
    {
        $this->_acl->acceso('agregar_rol');
        if ($this->_indexModel->verificarCiclo($this->getSql('nuevoNombre'))) {
            $this->_view->assign('_error', 'Ciclo <b style="font-size: 1.15em;">' . $this->getSql('nuevoNombre') . '</b> ya existe');
        } else {
            // echo $this->getSql('nuevoCurricula').$this->getSql('nuevoDescripcion').$this->getSql('nuevoCodigo')."/".$this->getSql('nuevoResolucion')."/".$this->getSql('nuevoSelEscuela'); exit;
            $idRegistro = $this->_indexModel->insertarCiclo(
                $this->getSql('nuevoNombre'), $this->getSql('nuevoNumero'), $this->getInt('nuevoSelEscuela'), 1, 1
            );
            // print_r($idRol);
            if (is_array($idRegistro)) {
                if ($idRegistro[0] > 0) {
                    $this->_view->assign('_mensaje', 'Registro Completado..!!');
                } else {
                    $this->_view->assign('_error', 'Error al registrar Ciclo');
                }
            } else {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        }

        // if($usu)
        // {
        //     $this->_view->renderizar('ajax/nuevo_facultad', false, true);
        // }
    }

    public function editarCiclo($Cic_IdCiclo = false)
    {

        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $ciclo = $this->_indexModel->getCiclo($this->filtrarInt($Cic_IdCiclo));

        if ($this->botonPress("bt_cancelareditarciclo")) {
            $this->redireccionar('carga_academica/index/Ciclos');
        }

        if ($this->botonPress("bt_editarciclo")) {
            // if($this->getSql('idIdiomaSeleccionado') == $facultad['Idi_IdIdioma'])
            // {
            $id = $this->_indexModel->editarciclo($this->filtrarInt($Cic_IdCiclo), $this->getSql('nuevoNombre'), $this->getSql('nuevoNumero'), $this->getSql('nuevoSelEscuela'));

            if ($id) {
                $this->_view->assign('_mensaje', 'Ciclo editado Correctamente');
                $ciclo = $this->_indexModel->getCiclo($this->filtrarInt($Cic_IdCiclo));
            } else {
                $this->_view->assign('_error', 'Error al editar Ciclo');
            }
        }
        // $this->_view->assign('idiomas',$this->_indexModel->getIdiomas());
        $this->_view->assign('datos', $ciclo);
        $this->_view->renderizar('ajax/editarciclo', 'editarciclo');
    }

    //Modificado por Jhon Martinez
    public function _buscarCiclos()
    {

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cic_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY c.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY c.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getCiclosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCiclosCondicion($pagina, CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _paginacion_listarCiclos($txtBuscar = false)
    {

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $nombreLista    = $this->getSql('nombrelista');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        // Para la busqueda
        $soloActivos = 0;
        $condicion   = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cic_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY c.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY c.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }

        $paginador = new Paginador();

        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCiclosCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _cambiarEstadoCiclos()
    {
        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";

        echo "hola";

        //Variables de Ajax_JavaScript
        $txtBuscar      = $this->getSql('palabra');
        $formulario     = $this->getSql('formulario');
        $pagina         = $this->getInt('pagina');
        $filas          = $this->getInt('filas');
        $IdRegistro     = $this->getInt('_IdRegistro');
        $EstadoRegistro = $this->getInt('_EstadoRegistro');

        if (!$IdRegistro) {
            $this->_view->assign('_error', 'Error parametro ID ..!!');
            $this->_view->renderizar('index');
            exit;
        } else {
            //Actualizacion de estado en la BD
            // echo $Fac_IdFacultad.$EstadoRegistro;exit;
            $rowCountEstado = $this->_indexModel->cambiarEstadoCiclo($IdRegistro, $EstadoRegistro);
            //Mensaje de Actualizacion
            if ($rowCountEstado > 0) {
                if ($EstadoRegistro == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';
                }
                if ($EstadoRegistro == 0) {
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
        if ($txtBuscar) {
            $condicion = " WHERE Cic_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            }

        } else {
            //Filtro por Activos/Eliminados
            $condicion = " ORDER BY c.Row_Estado DESC ";
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }

        $arrayRowCount  = $this->_indexModel->getCiclosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador = new Paginador();

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCiclosCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _eliminarCiclos()
    {
        $this->_acl->acceso('editar_rol');

        //Variables Ajax_Javascript
        $IdRegistro = $this->getInt('_IdRegistro');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar  = $this->getSql('palabra');
        $formulario = $this->getSql('formulario');
        $pagina     = $this->getInt('pagina');
        $filas      = $this->getInt('filas');
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje   = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if (!$IdRegistro) {
                $contenido = 'Error parametro ID ..!!';
                $mensaje   = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                // $relacion = $this->_indexModel->getEscuelaCurricula($IdRegistro);
                // print_r($facultade);
                // if ($relacion <= 0)
                // {
                $rowCount = $this->_indexModel->eliminarHabilitarCiclo($IdRegistro, $Row_Estado);
                // echo $rowCount3;//exit;
                if ($rowCount && $rowCount > 0) {
                    $contenido = 'Ciclo fue eliminado correctamente...!!!';
                    $mensaje   = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                } else {
                    $contenido = 'No se pudo eliminar Ciclo, error de consulta...!!!';
                    $mensaje   = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                }

                // } else {
                //     $contenido = 'No se pudo eliminar curricula asignado a escuela...!!!';
                //     $mensaje = "error";
                //     array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                // }
                // echo $error;exit;
            }
        } else {
            $rowCount = $this->_indexModel->eliminarHabilitarCiclo($IdRegistro, $Row_Estado);

            if ($rowCount && $rowCount > 0) {
                $contenido = 'La curricula fue activado correctamente...!!!';
                $mensaje   = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar curricula, error en consulta...!!! id=' . $IdRegistro . "/" . $Row_Estado;
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
        if ($txtBuscar) {
            $condicion = " WHERE Cui_Nombre LIKE '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND c.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY c.Row_Estado DESC ";
            }

        } else {
            $condicion = " ORDER BY c.Row_Estado DESC ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion   = " WHERE c.Row_Estado = $soloActivos  ";
            }
        }
        // Para la busqueda

        $paginador = new Paginador();

        $arrayRowCount  = $this->_indexModel->getCiclosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar' . $formulario;
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getCiclosCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }

/*Facultades*/
    //Modificado por Jhon Martinez
    public function horarios()
    {
        // echo $id ." ////// ". $nombre;
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        $this->_view->setJs(array('index'));
        // $this->_view->setCss(array('base','layout'));

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        if ($this->botonPress("bt_guardarHorario")) {
            $this->nuevo_horario();
        }

        //Filtro por Activos/Eliminados
        $condicion   = " ORDER BY h.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion   = " WHERE h.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount  = $this->_indexModel->getHorariosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador  = new Paginador();
        $formulario = "Horarios";
        $this->_view->assign('listaDatos', $this->_indexModel->getHorariosPaginado($pagina, CANT_REG_PAG, $soloActivos));

        $paginador->paginar($totalRegistros, "listar" . $formulario, "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de Facultades');
        $this->_view->renderizar($formulario);
    }

}
