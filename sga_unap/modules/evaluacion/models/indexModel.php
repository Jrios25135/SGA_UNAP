<?php

class indexModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function cambiarEstadoCriterioEvaluacionAcademica($Cea_IdEstado, $Cea_Estado){

        try{
            if($Cea_Estado==0){
                $sql = "call s_u_cambiar_estado_criterio_evaluacion_academica_docente(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Cea_IdEstado, PDO::PARAM_INT);
                $result->execute();
                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Cea_Estado==1){
                $sql = "call s_u_cambiar_estado_criterio_evaluacion_academica_docente(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Cea_IdEstado, PDO::PARAM_INT);
                $result->execute();
                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "cambiarEstadoCriterio", "Error Model", 
                $exception);
            return $exception->getTraceAsString();
        }
    }  

    public function cambiarEstadoCriterioEvaluacionParticipacion($Cep_IdEstado, $Cep_Estado){

        try{
            if($Cep_Estado==0){
                $sql = "call s_u_cambiar_estado_criterio_evaluacion_participacion_docente(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Cep_IdEstado, PDO::PARAM_INT);
                $result->execute();
                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Cep_Estado==1){
                $sql = "call s_u_cambiar_estado_criterio_evaluacion_participacion_docente(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Cep_IdEstado, PDO::PARAM_INT);
                $result->execute();
                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "cambiarEstadoCriterioEvaluacionParticipacion", "Error Model", 
                $exception);
            return $exception->getTraceAsString();
        }
    }   

    public function cambiarEstadoCriterioEvaluacionEncuesta($Cee_IdEstado, $Cee_Estado){

        try{
            if($Cee_Estado==0){
                $sql = "call s_u_cambiar_estado_criterio_evaluacion_encuesta_docente(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Cee_IdEstado, PDO::PARAM_INT);
                $result->execute();
                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Cee_Estado==1){
                $sql = "call s_u_cambiar_estado_criterio_evaluacion_encuesta_docente(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Cee_IdEstado, PDO::PARAM_INT);
                $result->execute();
                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "cambiarEstadoCriterioEvaluacionEncuesta", "Error Model", 
                $exception);
            return $exception->getTraceAsString();
        }
    }  
        
    public function editarCriterioEvaluacionAcademica($iCea_IdCriterio,$iCea_Nombre,
        $iCea_Tipo){
        try {            
            $sql = "call s_u_cambiar_criterio_evaluacion_academica_docente(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCea_IdCriterio, PDO::PARAM_STR);            
            $result->bindParam(2, $iCea_Nombre, PDO::PARAM_STR);            
            $result->bindParam(3, $iCea_Tipo, PDO::PARAM_STR);            
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarCriterioEvaluacionAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarCriterioEvaluacionEncuesta($iCee_IdCriterio,$iCee_Nombre,
        $iCee_Tipo){        
        try {            
            $sql = "call s_u_cambiar_criterio_evaluacion_encuesta_docente(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCee_IdCriterio, PDO::PARAM_STR);            
            $result->bindParam(2, $iCee_Nombre, PDO::PARAM_STR);            
            $result->bindParam(3, $iCee_Tipo, PDO::PARAM_STR);            
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarCriterioEvaluacionEncuesta", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarCriterioEvaluacionParticipacion($iCea_IdCriterio,$iCea_Nombre){

        echo $iCea_IdCriterio;
        try {            
            $sql = "call s_u_cambiar_criterio_evaluacion_participacion_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCea_IdCriterio, PDO::PARAM_STR);            
            $result->bindParam(2, $iCea_Nombre, PDO::PARAM_STR);                        
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarCriterioEvaluacionParticipacion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function eliminarCriterioEvaluacionAcademica($criterioID){
        try{
            $this->_db->query(
                " DELETE FROM criterio_evaluacion_academica_docente 
                WHERE Cea_IdCriterioEvaluacion = $criterioID "               
                );
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarCriterioEvaluacionAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function eliminarHabilitarCriterioEvaluacionAcademica($iCea_IdCriterio = 0, $iRow_Estado = 0){
        try{
            $sql = "call s_u_habilitar_deshabilitar_criterio_evaluacion_academica_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCea_IdCriterio, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->rowCount(PDO::FETCH_ASSOC); 
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarCriterioEvaluacionAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function eliminarHabilitarCriterioEvaluacionEncuesta($iCee_IdCriterio = 0, $iRow_Estado = 0){
        try{
            $sql = "call s_u_habilitar_deshabilitar_criterio_evaluacion_encuesta_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCee_IdCriterio, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->rowCount(PDO::FETCH_ASSOC); 
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarCriterioEvaluacionEncuesta", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

     public function eliminarHabilitarCriterioEvaluacionParticipacion($iCea_IdCriterio = 0, $iRow_Estado = 0){
        try{
            $sql = "call s_u_habilitar_deshabilitar_criterio_evaluacion_participacion_doc(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCea_IdCriterio, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->rowCount(PDO::FETCH_ASSOC); 
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarCriterioEvaluacionParticipacion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionAcademicaPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1){
        try{
            $sql = "call s_s_listar_criterios_evaluacion_academica_docente(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionAcademicaPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionEncuestaPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1){
        try{
            $sql = "call s_s_listar_criterios_evaluacion_encuesta_docente(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionEncuestaPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionParticipacionPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1){                    
        try{
            $sql = "call s_s_listar_criterios_evaluacion_participacion_docente(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionParticipacionPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getTiposCriterioEvaluacionAcademica(){
        try{
            $sql = "call s_s_listar_tipos_criterio_evaluacion_academica()";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getTiposcriterioEvaluacionAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getTiposCriterioEvaluacionEncuesta(){
        try{
            $sql = "call s_s_listar_tipos_criterio_evaluacion_encuesta()";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getTiposcriterioEvaluacionAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionAcademicaRowCount($condicion = ""){
        try{            
            $sql = " SELECT COUNT(c.Cea_IdCriterioEvaluacionAcademicaDocente) AS CantidadRegistros 
            FROM criterio_evaluacion_academica_docente c  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();            
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionAcademicaRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }  

     public function getCriteriosEvaluacionEncuestaRowCount($condicion = ""){
        try{            
            $sql = " SELECT COUNT(c.Cee_IdCriterioEvaluacionEncuestaDocente) AS CantidadRegistros 
            FROM criterio_evaluacion_encuesta_docente c  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();            
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionAcademicaRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }  

    public function getCriteriosEvaluacionParticipacionRowCount($condicion = ""){
        try{            
            $sql = " SELECT COUNT(c.Cep_IdCriterioEvaluacionParticipacionDocente) AS CantidadRegistros 
            FROM criterio_evaluacion_participacion_docente c  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();            
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionParticipacionRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    } 

    public function getDocentesPorEscuela($idEscuela){
        try{
            $sql = "call s_s_listar_docentes_escuela(?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idEscuela, PDO::PARAM_INT);            
            $result->execute();            
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getDocentesPorEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCursosDocenteEscuela($idEscuela,$idUsuarioRol){
        try{
            $sql = "call s_s_listar_cursos_docente_escuela(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idEscuela, PDO::PARAM_INT);            
            $result->bindParam(2, $idUsuarioRol, PDO::PARAM_INT);            
            $result->execute();            
            return $result->fetchAll(PDO::FETCH_ASSOC);            
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursosDocenteEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getEscuelas(){
        try{
            $sql = "call s_s_listar_escuelas()";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getEscuelas", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }    

    public function getReportesEvaluacionesRowCount($condicion = "")
    {
        try{
            $sql = " SELECT COUNT(c.Cea_IdCriterioEvaluacion) AS CantidadRegistros 
            FROM criterio_evaluacion_docente c  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getReportesEvaluacionesRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    } 
   
    public function getReportesEvaluacionesPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try{
            $sql = "call s_s_listar_reportes_evaluaciones(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getReportesEvaluacionesPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertarCriterioEvaluacionAcademica($iCea_Nombre,$iTce_IdTipoCriterioEvaluacion){
        try {            
            $sql = "call s_i_criterio_evaluacion_academica_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCea_Nombre, PDO::PARAM_STR);            
            $result->bindParam(2, $iTce_IdTipoCriterioEvaluacion, PDO::PARAM_INT);                                   
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCriterioEvaluacionAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    } 

    public function insertarCriterioEvaluacionEncuesta($iCee_Nombre,$iTcv_IdTipoCriterioEvaluacion){
        try {            
            $sql = "call s_i_criterio_evaluacion_encuesta_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCee_Nombre, PDO::PARAM_STR);            
            $result->bindParam(2, $iTcv_IdTipoCriterioEvaluacion, PDO::PARAM_INT);                                   
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCriterioEvaluacionEncuesta", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    } 

    public function insertarCriterioEvaluacionParticipacion($iCep_Nombre){
        try {            
            $sql = "call s_i_criterio_evaluacion_participacion_docente(?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCep_Nombre, PDO::PARAM_STR);                        
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCriterioEvaluacionParticipacion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    } 

    public function insertarEvaluacionAcademicaDocente($idUsuarioRol,$idCurso){        
        try {            
            $sql = "call s_i_evaluacion_academica_docente(?,?)";                         
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idUsuarioRol, PDO::PARAM_INT);                        
            $result->bindParam(2, $idCurso, PDO::PARAM_INT);                        
            $result->execute();
            return $result->fetch();            
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarEvaluacionAcademicaDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }   

     public function insertarEvaluacionEncuestaDocente($idUsuarioRol,$idCurso){        
        try {            
            $sql = "call s_i_evaluacion_encuesta_docente(?,?)";                         
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idUsuarioRol, PDO::PARAM_INT);                        
            $result->bindParam(2, $idCurso, PDO::PARAM_INT);                        
            $result->execute();
            return $result->fetch();            
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarEvaluacionEncuestaDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    } 

    public function insertarEvaluacionParticipacionDocente($idUsuarioRol){        
        try {            
            $sql = "call s_i_evaluacion_participacion_docente(?)";                         
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idUsuarioRol, PDO::PARAM_INT);                                    
            $result->execute();
            return $result->fetch();            
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarEvaluacionParticipacionDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }     

    public function insertarDetalleEvaluacionAcademicaDocente($idEvaluacion,$idCriterio,$puntaje){
        try {            
            $sql = "call s_i_detalle_evaluacion_academica_docente(?,?,?)";                         
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idEvaluacion, PDO::PARAM_INT);                        
            $result->bindParam(2, $idCriterio, PDO::PARAM_INT);                        
            $result->bindParam(3, $puntaje, PDO::PARAM_INT);                        
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarDetalleEvaluacionAcademicaDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertarDetalleEvaluacionParticipacionDocente($idEvaluacion,$idCriterio,$puntaje){
        try {            
            $sql = "call s_i_detalle_evaluacion_participacion_docente(?,?,?)";                         
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idEvaluacion, PDO::PARAM_INT);                        
            $result->bindParam(2, $idCriterio, PDO::PARAM_INT);                        
            $result->bindParam(3, $puntaje, PDO::PARAM_INT);                        
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarDetalleEvaluacionParticipacionDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertarDetalleEvaluacionEncuestaDocente($idEvaluacion,$idCriterio,$puntaje){
        try {            
            $sql = "call s_i_detalle_evaluacion_encuesta_docente(?,?,?)";                         
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $idEvaluacion, PDO::PARAM_INT);                        
            $result->bindParam(2, $idCriterio, PDO::PARAM_INT);                        
            $result->bindParam(3, $puntaje, PDO::PARAM_INT);                        
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarDetalleEvaluacionEncuestaDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriterioEvaluacionAcademica($Cea_IdCriterio){
        try{
            $Cea_IdCriterio = (int) $Cea_IdCriterio;        
            $criterio = $this->_db->query(" SELECT * FROM criterio_evaluacion_academica_docente WHERE 
                Cea_IdCriterioEvaluacionAcademicaDocente = {$Cea_IdCriterio}");
            return $criterio->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriterio", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriterioEvaluacionEncuesta($Cee_IdCriterio){
        try{
            $Cee_IdCriterio = (int) $Cee_IdCriterio;        
            $criterio = $this->_db->query(" SELECT * FROM criterio_evaluacion_encuesta_docente WHERE 
                Cee_IdCriterioEvaluacionEncuestaDocente = {$Cee_IdCriterio}");
            return $criterio->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriterio", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriterioEvaluacionParticipacion($Cea_IdCriterio){
        try{
            $Cea_IdCriterio = (int) $Cea_IdCriterio;        
            $criterio = $this->_db->query(" SELECT * FROM criterio_evaluacion_participacion_docente WHERE 
                Cep_IdCriterioEvaluacionParticipacionDocente = {$Cea_IdCriterio}");
            return $criterio->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriterio", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    

    public function habilitarDeshabilitarCriterioEvaluacionAcademicaDocente($iCea_IdCriterio=0, $iRow_Estado = 0){
        try{
            $sql = "call s_u_habilitar_deshabilitar_criterio_evaluacion_academica_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCea_IdCriterio, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->rowCount(PDO::FETCH_ASSOC); 
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "habilitarDeshabilitarCriterioEvaluacionAcademicaDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionAcademicaCondicion($pagina, $registrosXPagina, $condicion = ""){
        try{
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;                
            }
            $sql = " SELECT c.*,t.Tce_Nombre FROM criterio_evaluacion_academica_docente c INNER JOIN tipo_criterio_evaluacion_academica t 
            ON c.Tce_IdTipoCriterioEvaluacionAcademica=t.Tce_IdTipoCriterioEvaluacionAcademica
                 $condicion 
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionAcademicaCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionParticipacionCondicion($pagina, $registrosXPagina, $condicion = ""){
        try{
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;                
            }
            $sql = " SELECT c.* FROM criterio_evaluacion_participacion_docente c             
                 $condicion 
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionAcademicaCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCriteriosEvaluacionEncuestaCondicion($pagina, $registrosXPagina, $condicion = ""){
        try{
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;                
            }
            $sql = " SELECT c.*,t.Tcv_Nombre  FROM criterio_evaluacion_encuesta_docente c 
            INNER JOIN tipo_criterio_evaluacion_encuesta t 
            ON c.Tcv_IdTipoCriterioEvaluacionEncuesta=t.Tcv_IdTipoCriterioEvaluacionEncuesta             
                 $condicion 
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCriteriosEvaluacionAcademicaCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
}


?>
