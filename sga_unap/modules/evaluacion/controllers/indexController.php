<?php

class indexController extends evaluacionController
{
    private $_evaluacionm;
    private $_reporte_evaluacionm;
    
    public function __construct($lang,$url){
        parent::__construct($lang,$url);
        $this->_evaluacionm = $this->loadModel('index');        
        $this->_reporte_evaluacionm = $this->loadModel('index');        
    }
    
    public function index(){       
        $this->_acl->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->assign('titulo', 'Listas de acceso');
        $this->_view->renderizar('index');
    }    

    public function _buscarCriterioEvaluacionAcademicaAdministracion() {  

        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar){
            $condicion = " WHERE Cea_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }            
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);        
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        echo $totalRegistros."BEAA";        
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_academica_administracion", "$txtBuscar", $pagina,CANT_REG_PAG, true);
        $this->_view->assign('criterios_evaluacion_academica_administracion', $this->_evaluacionm->getCriteriosEvaluacionAcademicaCondicion($pagina,CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_academica_administracion', false, true);
    }
    
    public function _buscarCriterioEvaluacionAcademicaFicha() {  
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar){
            $condicion = " WHERE Cea_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }            
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);        
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_academica_ficha", "$txtBuscar", $pagina,CANT_REG_PAG, true);
        $this->_view->assign('criterios_evaluacion_academica_ficha', $this->_evaluacionm->getCriteriosEvaluacionAcademicaCondicion($pagina,CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_academica_ficha', false, true);
    }

    public function _buscarCriterioEvaluacionParticipacionFicha() {  
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar){
            $condicion = " WHERE Cep_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }            
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionParticipacionRowCount($condicion);        
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_participacion_ficha", "$txtBuscar", $pagina,CANT_REG_PAG, true);
        $this->_view->assign('criterios_evaluacion_participacion_ficha', $this->_evaluacionm->getCriteriosEvaluacionParticipacionCondicion($pagina,CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_participacion_ficha', false, true);
    }

    public function _cargarDocentesPorEscuela() {     
        $idEscuela = $this->getSql('idEscuela');      
        $this->_view->assign('docentes_escuela', $this->_evaluacionm->getDocentesPorEscuela($idEscuela));                        
        $this->_view->renderizar('ajax/cargar_docentes_escuela',false,true);
    }

    public function _cargarCursosDocenteEscuela() {     
        $idEscuela = $this->getSql('idEscuela');      
        $idUsuarioRol = $this->getSql('idUsuarioRol');           
        $this->_view->assign('cursos_docente_escuela',$this->_evaluacionm->getCursosDocenteEscuela($idEscuela,$idUsuarioRol));                        
        print_r($this->_evaluacionm->getCursosDocenteEscuela($idEscuela,$idUsuarioRol));
        $this->_view->renderizar('ajax/cargar_cursos_docente_escuela',false,true);
    }

    public function _cambiarEstadoCriterioEvaluacionAcademica(){        
        $this->_acl->acceso('editar_rol');        
        $resultado = array();
        $mensaje = "error";
        $contenido = "";        
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $Cea_IdCriterio = $this->getInt('_Cea_IdCriterio');        
        $Cea_Estado = $this->getInt('_Cea_Estado');         
        if(!$Cea_IdCriterio){                                    
            $this->_view->assign('_error', 'Error parametro ID');              
            $this->_view->renderizar('index');                        
            exit;          
        } else {                       
            $rowCountEstado = $this->_evaluacionm->cambiarEstadoCriterioEvaluacionAcademica($Cea_IdCriterio, $Cea_Estado);            
            if ($rowCountEstado > 0) {                                
                if ($Cea_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/>';              
                }if ($Cea_Estado == 0) {
                     $contenido = ' Se cambio de estado correctamente a <b>Habilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" title="Habilitado" style=" background: #FFF;  color: #088A08; padding: 2px;"/>';
                }     
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));       
            } else {
                $this->_view->assign('_error', 'Error de variable(s) en consulta!');
            }        
        }
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar){
            $condicion = " WHERE Cea_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            }
        } else {            
            $condicion = " ORDER BY Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];                
        $this->_view->assign('criterios_evaluacion_academica_administracion',                        
            $this->_evaluacionm->getCriteriosEvaluacionAcademicaCondicion($pagina,$filas, $condicion));
        $paginador->paginar( $totalRegistros ,"listar_criterios_evaluacion_academica_administracion", "$txtBuscar",$pagina, $filas, true);                                               
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_academica_administracion', false, true);

    }

    public function _cambiarEstadoCriterioEvaluacionParticipacion(){      
        $this->_acl->acceso('editar_rol');        
        $resultado = array();
        $mensaje = "error";
        $contenido = "";        
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $Cea_IdCriterio = $this->getInt('_Cep_IdCriterio');        
        $Cea_Estado = $this->getInt('_Cep_Estado');         
        if(!$Cea_IdCriterio){                                    
            $this->_view->assign('_error', 'Error parametro ID');              
            $this->_view->renderizar('index');                        
            exit;          
        } else {                       
            $rowCountEstado = $this->_evaluacionm->cambiarEstadoCriterioEvaluacionParticipacion($Cea_IdCriterio, $Cea_Estado);            
            if ($rowCountEstado > 0) {                                
                if ($Cea_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/>';              
                }if ($Cea_Estado == 0) {
                     $contenido = ' Se cambio de estado correctamente a <b>Habilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" title="Habilitado" style=" background: #FFF;  color: #088A08; padding: 2px;"/>';
                }     
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));       
            } else {
                $this->_view->assign('_error', 'Error de variable(s) en consulta!');
            }        
        }
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar){
            $condicion = " WHERE Cep_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            }
        } else {            
            $condicion = " ORDER BY Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionParticipacionRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];                
        $this->_view->assign('criterios_evaluacion_participacion_administracion',                        
            $this->_evaluacionm->getCriteriosEvaluacionParticipacionCondicion($pagina,$filas, $condicion));
        $paginador->paginar( $totalRegistros ,"listar_criterios_evaluacion_participacion_administracion", "$txtBuscar",$pagina, $filas, true);                                               
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_participacion_administracion', false, true);
    }

     public function _cambiarEstadoCriterioEvaluacionEncuesta(){ 
     
        $this->_acl->acceso('editar_rol');        
        $resultado = array();
        $mensaje = "error";
        $contenido = "";        
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $Cee_IdCriterio = $this->getInt('_Cee_IdCriterio');        
        $Cee_Estado = $this->getInt('_Cee_Estado');         
        if(!$Cee_IdCriterio){                                    
            $this->_view->assign('_error', 'Error parametro ID');              
            $this->_view->renderizar('index');                        
            exit;          
        } else {                       
            $rowCountEstado = $this->_evaluacionm->cambiarEstadoCriterioEvaluacionEncuesta($Cee_IdCriterio, $Cee_Estado);            
            if ($rowCountEstado > 0) {                                
                if ($Cee_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/>';              
                }if ($Cee_Estado == 0) {
                     $contenido = ' Se cambio de estado correctamente a <b>Habilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" title="Habilitado" style=" background: #FFF;  color: #088A08; padding: 2px;"/>';
                }     
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));       
            } else {
                $this->_view->assign('_error', 'Error de variable(s) en consulta!');
            }        
        }
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar){
            $condicion = " WHERE Cee_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            }
        } else {            
            $condicion = " ORDER BY Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionEncuestaRowCount($condicion);        
        $totalRegistros = $arrayRowCount['CantidadRegistros'];                
        $this->_view->assign('criterios_evaluacion_encuesta_administracion',                        
            $this->_evaluacionm->getCriteriosEvaluacionEncuestaCondicion($pagina,$filas, $condicion));
        $paginador->paginar( $totalRegistros ,"listar_criterios_evaluacion_encuesta_administracion", "$txtBuscar",$pagina, $filas, true);                                               
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_encuesta_administracion', false, true);
    }

    public function editarCriterioEvaluacionAcademica($Cea_IdCriterio = false){        
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $criterio = $this->_evaluacionm->getCriterioEvaluacionAcademica($this->filtrarInt($Cea_IdCriterio));
        if ($this->botonPress("bt_cancelar_editar_criterio")) {
            $this->redireccionar('evaluacion/index/criterios_evaluacion_academica_administracion');
        }if ($this->botonPress("bt_editar_criterio_evaluacion_academica")) {            
            $id = $this->_evaluacionm->editarCriterioEvaluacionAcademica($this->filtrarInt($Cea_IdCriterio),
                 $this->getSql('criterio'),$this->getSql('id_tipo_criterio'));
            if($id){
                $this->_view->assign('_mensaje', 'Criterio editado correctamente');  
                $criterio = $this->_evaluacionm->getCriterioEvaluacionAcademica($this->filtrarInt($Cea_IdCriterio));
            }else{
                $this->_view->assign('_error', 'Error al editar criterio');
            }                                        
        }
        $this->_view->assign('datos',$criterio);          
        $this->_view->assign('tipos_criterio_evaluacion', $this->_evaluacionm->getTiposCriterioEvaluacionAcademica());  
        $this->_view->renderizar('ajax/editar_criterio_evaluacion_academica','editar_criterio_evaluacion_academica');
    }

    public function editarCriterioEvaluacionEncuesta($Cee_IdCriterio = false){        
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $criterio = $this->_evaluacionm->getCriterioEvaluacionEncuesta($this->filtrarInt($Cee_IdCriterio));
        if ($this->botonPress("bt_cancelar_editar_criterio")) {
            $this->redireccionar('evaluacion/index/criterios_evaluacion_encuesta_administracion');
        }if ($this->botonPress("bt_editar_criterio_evaluacion_encuesta")) {            
            echo $this->getSql('id_tipo_criterio')."TIPOOOO";
            if ($this->getSql('id_tipo_criterio')!==null) {
                echo "1.0";
                $id = $this->_evaluacionm->editarCriterioEvaluacionEncuesta($this->filtrarInt($Cee_IdCriterio),
                $this->getSql('criterio'),$this->getSql('id_tipo_criterio'));
                if($id){
                    $this->_view->assign('_mensaje', 'Criterio editado correctamente');  
                    $criterio = $this->_evaluacionm->getCriterioEvaluacionEncuesta($this->filtrarInt($Cee_IdCriterio));
                }else{
                    $this->_view->assign('_error', 'Error al editar criterio');
                }                  
            }else{
                echo "2.0";
                 $this->_view->assign('_error', 'Seleccione el tipo');
            }                                                             
        }
        $this->_view->assign('datos',$criterio);          
        $this->_view->assign('tipos_criterio_evaluacion', $this->_evaluacionm->getTiposCriterioEvaluacionEncuesta());  
        $this->_view->renderizar('ajax/editar_criterio_evaluacion_encuesta','editar_criterio_evaluacion_encuesta');
    }

    public function editarCriterioEvaluacionParticipacion($Cea_IdCriterio = false){        
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $criterio = $this->_evaluacionm->getCriterioEvaluacionParticipacion($this->filtrarInt($Cea_IdCriterio));
        if ($this->botonPress("bt_cancelar_editar_criterio")) {
            $this->redireccionar('evaluacion/index/criterios_evaluacion_participacion_administracion');
        }if ($this->botonPress("bt_editar_criterio_evaluacion_participacion")) {            
            $id = $this->_evaluacionm->editarCriterioEvaluacionParticipacion($this->filtrarInt($Cea_IdCriterio),
                 $this->getSql('criterio'));
            if($id){
                $this->_view->assign('_mensaje', 'Criterio editado correctamente');  
                $criterio = $this->_evaluacionm->getCriterioEvaluacionParticipacion($this->filtrarInt($Cea_IdCriterio));
            }else{
                $this->_view->assign('_error', 'Error al editar criterio');
            }                                        
        }
        $this->_view->assign('datos',$criterio);                  
        $this->_view->renderizar('ajax/editar_criterio_evaluacion_participacion','editar_criterio_evaluacion_participacion');
    }

    public function criterios_evaluacion_academica_administracion(){
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardar_criterio")) {
            $this->nuevoCriterioEvaluacionAcademica();                
        }                      
        $condicion = " ORDER BY Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE Row_Estado = $soloActivos ";
        }        
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('criterios_evaluacion_academica_administracion', $this->_evaluacionm->getCriteriosEvaluacionAcademicaPaginado($pagina,CANT_REG_PAG,$soloActivos));
        $this->_view->assign('tipos_criterio_evaluacion', $this->_evaluacionm->getTiposCriterioEvaluacionAcademica());
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_academica_administracion", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Ficha de evaluacion al docente');
        $this->_view->renderizar('criterios_evaluacion_academica_administracion');
    }   

    public function criterios_evaluacion_encuesta_administracion(){
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardar_criterio")) {
            $this->nuevoCriterioEvaluacionEncuesta();                
        }                      
        $condicion = " ORDER BY Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE Row_Estado = $soloActivos ";
        }        
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionEncuestaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('criterios_evaluacion_encuesta_administracion', $this->_evaluacionm->getCriteriosEvaluacionEncuestaPaginado($pagina,CANT_REG_PAG,$soloActivos));
        $this->_view->assign('tipos_criterio_evaluacion', $this->_evaluacionm->getTiposCriterioEvaluacionEncuesta());
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_encuesta_administracion", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Ficha de evaluacion al docente');
        $this->_view->renderizar('criterios_evaluacion_encuesta_administracion');
    }  

    public function criterios_evaluacion_academica_ficha(){ 
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();             
        if ($this->botonPress("bt_guardar_evaluacion")) {                                   
            $this->guardarEvaluacionAcademica();                            
        }       
        $condicion = " ORDER BY Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE Row_Estado = $soloActivos ";
        }        
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('escuelas', $this->_evaluacionm->getEscuelas(0,0));
        $this->_view->assign('criterios_evaluacion_academica_ficha', $this->_evaluacionm->getCriteriosEvaluacionAcademicaPaginado($pagina,CANT_REG_PAG,$soloActivos));
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_academica_ficha", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Ficha de evaluacion al docente');
        $this->_view->renderizar('criterios_evaluacion_academica_ficha');
    }  

    public function criterios_evaluacion_encuesta_ficha(){ 
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();             
        if ($this->botonPress("bt_guardar_evaluacion")) {        
            $this->guardarEvaluacionEncuesta();                            
        }       
        $condicion = " ORDER BY Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE Row_Estado = $soloActivos ";
        }        
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionEncuestaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('escuelas', $this->_evaluacionm->getEscuelas(0,0));
        $this->_view->assign('criterios_evaluacion_encuesta_ficha', $this->_evaluacionm->getCriteriosEvaluacionEncuestaPaginado($pagina,CANT_REG_PAG,$soloActivos));
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_encuesta_ficha", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Ficha de evaluacion al docente');
        $this->_view->renderizar('criterios_evaluacion_encuesta_ficha');
    }  

    public function criterios_evaluacion_participacion_ficha(){ 
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();             
        if ($this->botonPress("bt_guardar_evaluacion")) {        
            $this->guardarEvaluacionParticipacion();                            
        }       
        $condicion = " ORDER BY Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE Row_Estado = $soloActivos ";
        }                
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionParticipacionRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('escuelas', $this->_evaluacionm->getEscuelas(0,0));
        $this->_view->assign('criterios_evaluacion_participacion_ficha', $this->_evaluacionm->getCriteriosEvaluacionParticipacionPaginado($pagina,CANT_REG_PAG,$soloActivos));
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_participacion_ficha", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Ficha de evaluacion al docente');
        $this->_view->renderizar('criterios_evaluacion_participacion_ficha');
    }  

    public function criterios_evaluacion_participacion_administracion(){
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardar_criterio")) {
            $this->nuevoCriterioEvaluacionParticipacion();                
        }                      
        $condicion = " ORDER BY Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE Row_Estado = $soloActivos ";
        }        
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionParticipacionRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('criterios_evaluacion_participacion_administracion',
        $this->_evaluacionm->getCriteriosEvaluacionParticipacionPaginado($pagina,CANT_REG_PAG,$soloActivos));        
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_participacion_administracion", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Ficha de evaluacion al docente');
        $this->_view->renderizar('criterios_evaluacion_participacion_administracion');                                    
    }  

    public function _eliminarCriterioEvaluacionAcademica(){        
        $this->_acl->acceso('editar_rol');        
        $Cea_IdCriterio = $this->getInt('_Cea_IdCriterio');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');               
        $resultado = array();
        $mensaje = "error";
        $contenido = "";               
        if ($Row_Estado == 0) {
            if(!$Cea_IdCriterio){            
                $contenido = 'Error parametro ID'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));          
            }else {
                $rowCount = 
                $this->_evaluacionm->eliminarHabilitarCriterioEvaluacionAcademica($Cea_IdCriterio,$Row_Estado);
                if($rowCount && $rowCount > 0){
                    $contenido = 'El criterio fue elimnado correctamente'; 
                    $mensaje = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));  
                } else {
                    $contenido = 'No se pudo eliminar criterio, error de consulta'; 
                    $mensaje = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                }                 
            }
        } else {            
            $rowCount = $this->_evaluacionm->eliminarHabilitarCriterioEvaluacionAcademica($Cea_IdCriterio,
                $Row_Estado);            
            if($rowCount){
                $contenido = 'El criterio fue activado correctamente'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar criterio, error en consulta'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cea_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_academica_administracion", "$txtBuscar", $pagina,$filas, true);
        $this->_view->assign('criterios_evaluacion_academica_administracion', 
            $this->_evaluacionm->getCriteriosEvaluacionAcademicaCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_academica_administracion', false, true);
    } 

    public function _eliminarCriterioEvaluacionEncuesta(){        
        $this->_acl->acceso('editar_rol');        
        $Cee_IdCriterio = $this->getInt('_Cee_IdCriterio');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');               
        $resultado = array();
        $mensaje = "error";
        $contenido = "";               
        if ($Row_Estado == 0) {
            if(!$Cee_IdCriterio){            
                $contenido = 'Error parametro ID'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));          
            }else {
                $rowCount = 
                $this->_evaluacionm->eliminarHabilitarCriterioEvaluacionEncuesta($Cee_IdCriterio,$Row_Estado);
                if($rowCount && $rowCount > 0){
                    $contenido = 'El criterio fue elimnado correctamente'; 
                    $mensaje = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));  
                } else {
                    $contenido = 'No se pudo eliminar criterio, error de consulta'; 
                    $mensaje = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                }                 
            }
        } else {            
            $rowCount = $this->_evaluacionm->eliminarHabilitarCriterioEvaluacionEncuesta($Cee_IdCriterio,
                $Row_Estado);            
            if($rowCount){
                $contenido = 'El criterio fue activado correctamente'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar criterio, error en consulta'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cee_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionEncuestaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_encuesta_administracion", "$txtBuscar", $pagina,$filas, true);
        $this->_view->assign('criterios_evaluacion_encuesta_administracion', 
            $this->_evaluacionm->getCriteriosEvaluacionEncuestaCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_encuesta_administracion', false, true);
    } 

    public function _eliminarCriterioEvaluacionParticipacion(){        
        $this->_acl->acceso('editar_rol');        
        $Cep_IdCriterio = $this->getInt('_Cep_IdCriterio');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');               
        $resultado = array();
        $mensaje = "error";
        $contenido = "";               
        if ($Row_Estado == 0) {
            if(!$Cep_IdCriterio){            
                $contenido = 'Error parametro ID'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));          
            }else {
                $rowCount = 
                $this->_evaluacionm->eliminarHabilitarCriterioEvaluacionParticipacion($Cep_IdCriterio,$Row_Estado);
                if($rowCount && $rowCount > 0){
                    $contenido = 'El criterio fue elimnado correctamente'; 
                    $mensaje = "ok";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));  
                } else {
                    $contenido = 'No se pudo eliminar criterio, error de consulta'; 
                    $mensaje = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                }                 
            }
        } else {            
            $rowCount = $this->_evaluacionm->eliminarHabilitarCriterioEvaluacionParticipacion($Cep_IdCriterio,
                $Row_Estado);            
            if($rowCount){
                $contenido = 'El criterio fue activado correctamente'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar criterio, error en consulta'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cep_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionParticipacionRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_participacion_administracion", "$txtBuscar", $pagina,$filas, true);
        $this->_view->assign('criterios_evaluacion_participacion_administracion', 
            $this->_evaluacionm->getCriteriosEvaluacionParticipacionCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_participacion_administracion', false, true);
    }

    public function guardarEvaluacionAcademica(){                            
        $idUsuarioRol=$this->getSql('docentes_escuela');
        $idCurso=$this->getSql('cursos_docente_escuela');
        $idEvaluacion = $this->_evaluacionm->insertarEvaluacionAcademicaDocente($idUsuarioRol,$idCurso);                     
        $idCriterio=0;
        $escala=0;                
        for ($i = 1; $i <= $this->getSql("contador"); $i=$i+1) {                        
            $idCriterio = substr($this->getSql('criterio'.$i),0,-1);
            $escala =substr($this->getSql('criterio'.$i),-1);
            $this->_evaluacionm->
            insertarDetalleEvaluacionAcademicaDocente($idEvaluacion[0],$idCriterio,$escala);                                 
        }
        $resultado = array();
        $contenido = 'La evaluación se guardó correctamente'; 
        $mensaje = "ok";
        array_push($resultado, array(0 => $mensaje, 1 => $contenido));
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        
        $filas=$this->getInt('filas');               
        $pagina = $this->getInt('pagina');
        $txtBuscar="";
        $condicion="";
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionAcademicaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_academica_ficha", "$txtBuscar", $pagina,$filas, true);
        $this->_view->assign('criterios_evaluacion_academica_ficha', 
            $this->_evaluacionm->getCriteriosEvaluacionAcademicaCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_academica_ficha', false, true);
    }

    public function guardarEvaluacionEncuesta(){    
    echo "HOLA";                                                           
        echo $this->getSql("radio");         
        $idUsuarioRol=$this->getSql('docentes_escuela');
        $idCurso=$this->getSql('cursos_docente_escuela');

        $idEvaluacion = $this->_evaluacionm->insertarEvaluacionEncuestaDocente($idUsuarioRol,$idCurso);                     
        $idCriterio=0;
        $puntaje=0;               
        for ($i = 1; $i <= $this->getSql("contador"); $i=$i+1) {                        
            $idCriterio = substr($this->getSql('puntaje'.$i),0,-1);
            $puntaje =substr($this->getSql('puntaje'.$i),-1);
            $this->_evaluacionm->
            insertarDetalleEvaluacionEncuestaDocente($idEvaluacion[0],$idCriterio,$puntaje);                                 
        }
        $resultado = array();
        $contenido = 'La evaluación se guardó correctamente'; 
        $mensaje = "ok";
        array_push($resultado, array(0 => $mensaje, 1 => $contenido));
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);        
        $filas=$this->getInt('filas');               
        $pagina = $this->getInt('pagina');
        $txtBuscar="";
        $condicion="";
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionEncuestaRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_encuesta_ficha", "$txtBuscar", $pagina,$filas, true);
        $this->_view->assign('criterios_evaluacion_encuesta_ficha', 
            $this->_evaluacionm->getCriteriosEvaluacionEncuestaCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_encuesta_ficha', false, true);
    }

    public function guardarEvaluacionParticipacion(){   
        $idUsuarioRol=$this->getSql('docentes_escuela');        
        $idEvaluacion = $this->_evaluacionm->insertarEvaluacionParticipacionDocente($idUsuarioRol);                     
        $idCriterio=0;
        $escala=0;                
        for ($i = 1; $i <= $this->getSql("contador"); $i=$i+1) {                                    
            $idCriterio = substr($this->getSql('criterio'.$i),0,-1);
            $escala =substr($this->getSql('criterio'.$i),-1);
            $this->_evaluacionm->
            insertarDetalleEvaluacionParticipacionDocente($escala,$idCriterio,$idEvaluacion[0]);                                 
        }
        $resultado = array();
        $contenido = 'La evaluación se guardó correctamente'; 
        $mensaje = "ok";
        array_push($resultado, array(0 => $mensaje, 1 => $contenido));
        $mensaje_json = json_encode($resultado);        
        $this->_view->assign('_mensaje_json', $mensaje_json);
        
        $filas=$this->getInt('filas');               
        $pagina = $this->getInt('pagina');
        $txtBuscar="";
        $condicion="";
        $paginador = new Paginador();
        $arrayRowCount = $this->_evaluacionm->getCriteriosEvaluacionParticipacionRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion_participacion_ficha", "$txtBuscar", $pagina,$filas, true);
        $this->_view->assign('criterios_evaluacion_participacion_ficha', 
            $this->_evaluacionm->getCriteriosEvaluacionParticipacionCondicion($pagina, $filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion_participacion_ficha', false, true);
    }


    public function nuevoCriterioEvaluacionAcademica($usu=false){
        $this->_acl->acceso('agregar_rol');
        $idCriterio = $this->_evaluacionm->insertarCriterioEvaluacionAcademica(
                $this->getSql('nuevo_criterio'),$this->getSql('tipos_criterio_evaluacion'));  
        if (is_array($idCriterio)) {
            if ($idCriterio[0] > 0){
                    $this->_view->assign('_mensaje', 'Registro completado');
            }else{
                    $this->_view->assign('_error', 'Error al registrar el criterio');
            }
        }else {
               $this->_view->assign('_error', 'Seleccione el tipo');               
        }
        if($usu){
            $this->_view->renderizar('ajax/nuevo_criterio', false, true);
        }
    }

    public function nuevoCriterioEvaluacionEncuesta($usu=false){
        $this->_acl->acceso('agregar_rol');
        $idCriterio = $this->_evaluacionm->insertarCriterioEvaluacionEncuesta(
                $this->getSql('nuevo_criterio'),$this->getSql('tipos_criterio_evaluacion'));  
        if (is_array($idCriterio)) {
            if ($idCriterio[0] > 0){
                    $this->_view->assign('_mensaje', 'Registro completado');
            }else{
                    $this->_view->assign('_error', 'Error al registrar el criterio');
            }
        }else {
               $this->_view->assign('_error', 'Seleccione el tipo');               
        }
        if($usu){
            $this->_view->renderizar('ajax/nuevo_criterio', false, true);
        }
    }

    public function nuevoCriterioEvaluacionParticipacion($usu=false){
        $this->_acl->acceso('agregar_rol');
        $idCriterio = $this->_evaluacionm->insertarCriterioEvaluacionParticipacion(
            $this->getSql('nuevo_criterio'));  
        if (is_array($idCriterio)) {
            if ($idCriterio[0] > 0){
                    $this->_view->assign('_mensaje', 'Registro completado');
            }else{
                    $this->_view->assign('_error', 'Error al registrar el criterio');
            }
        }else {
               $this->_view->assign('_error', 'Seleccione el tipo');               
        }
        if($usu){
            $this->_view->renderizar('ajax/nuevo_criterio', false, true);
        }
    }

    public function reporte_evaluacion(){    
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $paginador = new Paginador();            
        $condicion = " ORDER BY r.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE r.Row_Estado = $soloActivos ";
        }        
        $arrayRowCount = $this->$_reporte_evaluacionm->getReportesEvaluacionesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];        
        $this->_view->assign('modulos', $this->$_reporte_evaluacionm->getModulos(0,0));
        $this->_view->assign('reportes_evaluaciones', $this->$_reporte_evaluacionm->getReportesEvaluacionesPaginado($pagina,CANT_REG_PAG,$soloActivos));
        $paginador->paginar( $totalRegistros,"listarReportesEvaluaciones", "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Reporte evaluacion al docente');
        $this->_view->renderizar('reportes_evaluaciones');    
    }    

    public function reporte_encuesta()
    {        
    }  

    public function reporte_participacion()
    {        
    }  
           
    
    public function _paginacion_listarCriteriosAdministracion($txtBuscar = false) {        
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cea_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();        
        $paginador->paginar( $totalRegistros,"listar_criterios_administracion", "$txtBuscar", $pagina, $filas, true);
        $this->_view->assign('criterios_administracion', $this->_aclm->getCriteriosCondicion($pagina,$filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_administracion', false, true);
    }

    public function _paginacion_listarCriteriosEvaluacion($txtBuscar = false) {        
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) {
            $condicion = " WHERE Cea_Nombre liKe '%$txtBuscar%' ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY Row_Estado DESC ";
            }
        } else {
            $condicion = " ORDER BY Row_Estado DESC ";            
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE Row_Estado = $soloActivos  ";
            }
        }  
        $paginador = new Paginador();        
        $paginador->paginar( $totalRegistros,"listar_criterios_evaluacion", "$txtBuscar", $pagina, $filas, true);
        $this->_view->assign('criterios_evaluacion', $this->_aclm->getCriteriosCondicion($pagina,$filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());        
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listar_criterios_evaluacion', false, true);
    }

}
?>