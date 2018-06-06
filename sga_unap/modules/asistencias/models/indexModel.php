<?php

class indexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //-----------------------------*Presmisos*-----------------------------------------
    //Util_Permiso Jhon Martinez
    public function getPermisos($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try{
            $sql = "call s_s_listar_permisos_con_modulo(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getPermisos", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util Jhon Martinez
    public function getEscuelaXUsuarioRol($Usu_IdUsuario = '')
    {
        try{
            $result = $this->_db->query(
             "  SELECT esc.Esc_Nombre, esc.Esc_IdEscuela, cui.Cui_IdCurricula FROM escuela esc
                INNER JOIN curricula cui ON esc.Esc_IdEscuela = cui.Esc_IdEscuela 
                INNER JOIN detalle_docente ded ON esc.Esc_IdEscuela = ded.Esc_IdEscuela 
                INNER JOIN usuario_rol usr ON ded.Usr_IdUsuarioRol = usr.Usr_IdUsuarioRol 
                WHERE usr.Usu_IdUsuario = $Usu_IdUsuario "
            );
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    

    public function getDocentes($Esc_IdEscuela = '')
    {
        try{
            $result = $this->_db->query(
             "  SELECT esc.Esc_Nombre, esc.Esc_IdEscuela, cui.Cui_IdCurricula FROM escuela esc
                INNER JOIN curricula cui ON esc.Esc_IdEscuela = cui.Esc_IdEscuela 
                INNER JOIN detalle_docente ded ON esc.Esc_IdEscuela = ded.Esc_IdEscuela 
                INNER JOIN usuario_rol usr ON ded.Usr_IdUsuarioRol = usr.Usr_IdUsuarioRol 
                WHERE usr.Usu_IdUsuario = $Usu_IdUsuario "
            );
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function verificarHorario($idCarga)
    {
        try{
            $permiso = $this->_db->query("SELECT * FROM horario h INNER JOIN horario_carga_academica hca ON h.Hor_IdHorario=hca.Hor_IdHorario WHERE
                hca.Caa_IdCargaAcademica='$idCarga' AND h.Hor_Dia=(WEEKDAY(NOW())+1)");
            return $permiso->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "verificarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function listar_asistencias($fechaI, $fechaF, $Caa_CargaAcademica)
    {
        try{

            $sql = "SELECT * FROM asistencia a INNER JOIN usuario_rol usr ON a.Usr_IdUsuarioRol=usr.Usr_IdUsuarioRol INNER JOIN usuario u ON usr.Usu_IdUsuario=u.Usu_IdUsuario WHERE Asi_fecha BETWEEN $fechaI AND $fechaF AND Caa_CargaAcademica=$Caa_CargaAcademica ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function obtener_fechas($fechaI, $fechaF, $Caa_CargaAcademica)
    {
        try{
            $sql = "SELECT DISTINCT(Asi_fecha) FROM asistencia WHERE Asi_fecha BETWEEN :fechaI AND :fechaF AND Caa_CargaAcademica=:Caa_CargaAcademica ORDER BY Asi_fecha";
            $result = $this->_db->prepare($sql);
            $result->bindParam(':fechaI', $fechaI, PDO::PARAM_STR);
            $result->bindParam(':fechaF', $fechaF, PDO::PARAM_STR);
            $result->bindParam('Caa_CargaAcademica', $Caa_CargaAcademica, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function obtener_alumnos($fechaI, $fechaF, $Caa_CargaAcademica)
    {
        try{

            $sql = "SELECT DISTINCT(u.Usu_IdUsuario), CONCAT (u.Usu_Apellidos,' ',u.Usu_Nombre) as Nombres FROM asistencia a INNER JOIN usuario_rol usr ON a.Usr_IdUsuarioRol=usr.Usr_IdUsuarioRol INNER JOIN usuario u ON usr.Usu_IdUsuario=u.Usu_IdUsuario WHERE Asi_fecha BETWEEN :fechaI AND :fechaF AND Caa_CargaAcademica=:Caa_CargaAcademica ORDER BY u.Usu_Apellidos";
            $result = $this->_db->prepare($sql);
            $result->bindParam(':fechaI', $fechaI, PDO::PARAM_STR);
            $result->bindParam(':fechaF', $fechaF, PDO::PARAM_STR);
            $result->bindParam('Caa_CargaAcademica', $Caa_CargaAcademica, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

     public function obtener_asistencias($fechaI, $fechaF, $Caa_CargaAcademica, $Usu_IdUsuario)
    {
        try{

            $sql = "SELECT Asi_Asistio FROM asistencia a
            INNER JOIN usuario_rol usr ON a.Usr_IdUsuarioRol=usr.Usr_IdUsuarioRol
            INNER JOIN usuario u ON usr.Usu_IdUsuario=u.Usu_IdUsuario
            WHERE Asi_fecha BETWEEN :fechaI AND :fechaF AND Caa_CargaAcademica=:Caa_CargaAcademica AND u.Usu_IdUsuario=:Usu_IdUsuario ORDER BY Asi_fecha";
            $result = $this->_db->prepare($sql);
            $result->bindParam(':fechaI', $fechaI, PDO::PARAM_STR);
            $result->bindParam(':fechaF', $fechaF, PDO::PARAM_STR);
            $result->bindParam('Caa_CargaAcademica', $Caa_CargaAcademica, PDO::PARAM_INT);
            $result->bindParam('Usu_IdUsuario', $Usu_IdUsuario, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function detallar_curso($condicion = "")
    {
        try{

            $sql = "SELECT * FROM carga_academica ca INNER JOIN curso c ON ca.Cur_IdCurso = c.Cur_IdCurso $condicion";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

     public function registrar_asistencia($Asi_Asistio,$Usr_IdUsuarioRol,$Caa_CargaAcademica)
    {
        try {             
                $sql = "INSERT INTO asistencia VALUES ('',NOW(),:Asi_Asistio,:Usr_IdUsuarioRol,:Caa_CargaAcademica) ";
                $result = $this->_db->prepare($sql);
                $result -> bindParam(':Asi_Asistio',$Asi_Asistio,PDO::PARAM_STR);
                $result -> bindParam(':Usr_IdUsuarioRol',$Usr_IdUsuarioRol,PDO::PARAM_STR);
                $result -> bindParam(':Caa_CargaAcademica',$Caa_CargaAcademica,PDO::PARAM_STR);
                $result->execute();

                return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "registrar_asistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function registrar_asistencia_comp($nombre,$asistencia,$nro)
    {
        try {             
                $sql = "INSERT INTO competencias VALUES ('',:nombre,:asistencia,:nro) ";
                $result = $this->_db->prepare($sql);
                $result -> bindParam(':asistencia',$asistencia,PDO::PARAM_STR);
                $result -> bindParam(':nombre',$nombre,PDO::PARAM_STR);
                $result -> bindParam(':nro',$nro,PDO::PARAM_STR);
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_ultimo_asistencia()
    {
        try{

            $sql = "SELECT Sil_Idasistencia FROM asistencia ORDER BY Sil_Idasistencia DESC LIMIT 1";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_ultimas_comp(){
        try{

            $sql = "SELECT * FROM competencias ORDER BY Com_IdCompetencias DESC LIMIT 3";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


     public function registrar_asistencia2($nombre,$asistencia)
    {
        try {             
                $sql = "INSERT INTO capacidades VALUES ('',:nombre,'0',:asistencia,'1') ";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':nombre',$nombre,PDO::PARAM_STR);
                $result -> bindParam(':asistencia',$asistencia,PDO::PARAM_STR);
                
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_cap_comp($condicion)
    {
        try{

            $sql = "SELECT * FROM capacidades c INNER JOIN competencias co ON c.Com_IdCompetencias=co.Com_IdCompetencias $condicion";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_existe_cap_proceso_id_cap($dato)
    {
        try{

            $sql = "SELECT * FROM proceso_aprendizaje WHERE Cap_IdCapacidades=:dato";
            $result = $this->_db->prepare($sql);
            $result -> bindParam(':dato',$dato,PDO::PARAM_STR);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function registrar_asistencia3($capa,$contenidos,$estra,$ind,$proc_es,$proc_oral,$proc_obs,$proc_otros,$instr_c
        ,$instr_ru,$instr_fi,$instr_otros,$pond_c, $pond_p, $pond_i,$pond_a)
    {
        try {    
                $sql = "INSERT INTO proceso_aprendizaje VALUES ('',:contenidos,:estra,:ind,:proc_es,:proc_oral,:proc_obs,:proc_otros,:instr_c
        ,:instr_ru,:instr_fi,:instr_otros,:pond_c, :pond_p, :pond_i,:pond_a,:capa,'1','1')";
                $result = $this->_db->prepare($sql);
                $result -> bindParam(':contenidos',$contenidos,PDO::PARAM_STR);
                $result -> bindParam(':estra',$estra,PDO::PARAM_STR);
                $result -> bindParam(':ind',$ind,PDO::PARAM_STR);
                $result -> bindParam(':proc_es',$proc_es,PDO::PARAM_STR);
                $result -> bindParam(':proc_oral',$proc_oral,PDO::PARAM_STR);
                $result -> bindParam(':proc_obs',$proc_obs,PDO::PARAM_STR);
                $result -> bindParam(':proc_otros',$proc_otros,PDO::PARAM_STR);
                $result -> bindParam(':instr_c',$instr_c,PDO::PARAM_STR);
                $result -> bindParam(':instr_ru',$instr_ru,PDO::PARAM_STR);
                $result -> bindParam(':instr_fi',$instr_fi,PDO::PARAM_STR);
                $result -> bindParam(':instr_otros',$instr_otros,PDO::PARAM_STR);
                $result -> bindParam(':pond_c',$pond_c,PDO::PARAM_INT);
                $result -> bindParam(':pond_p',$pond_p,PDO::PARAM_INT);
                $result -> bindParam(':pond_i',$pond_i,PDO::PARAM_INT);
                $result -> bindParam(':pond_a',$pond_a,PDO::PARAM_INT);
                $result -> bindParam(':capa',$capa,PDO::PARAM_INT);
                // $result -> bindParam(':e',1,PDO::PARAM_INT);
                // $result -> bindParam(':s',1,PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_competencia_por_id_asistencia($dato)
    {
        try{

            $sql = "SELECT * FROM competencias WHERE Sil_Idasistencia=:dato";
            $result = $this->_db->prepare($sql);
            $result -> bindParam(':dato',$dato,PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function obtener_asistencia($dato)
    {
        try{

            $sql = "SELECT * FROM asistencia WHERE Sil_Idasistencia=:dato";
            $result = $this->_db->prepare($sql);
            $result -> bindParam(':dato',$dato,PDO::PARAM_STR);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function registrar_actitud_semana($capa,$contenidos,$estra)
    {
        try {             
                $sql = "INSERT INTO actitud_semanas VALUES ('',:capa,:contenidos,:estra)";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':capa',$capa,PDO::PARAM_STR);
                $result -> bindParam(':contenidos',$contenidos,PDO::PARAM_STR);
                $result -> bindParam(':estra',$estra,PDO::PARAM_STR);
                
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function registrar_capa_semana($nombre,$asistencia)
    {
        try {             
                $sql = "INSERT INTO capacidad_semana VALUES ('',:nombre,:asistencia,'1','1')";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':nombre',$nombre,PDO::PARAM_STR);
                $result -> bindParam(':asistencia',$asistencia,PDO::PARAM_STR);
                
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function registrar_asistencia5($id,$estado,$calif,$destino)
    {
        try {             
                $sql = "UPDATE asistencia SET Sil_Bibliiografia=:estado, Sil_Califacion=:calif, Sil_url_img=:destino WHERE Sil_Idasistencia=:id_persona";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':id_persona',$id,PDO::PARAM_STR);
                $result -> bindParam(':estado',$estado,PDO::PARAM_STR);
                $result -> bindParam(':calif',$calif,PDO::PARAM_STR);
                $result -> bindParam(':destino',$destino,PDO::PARAM_STR);
                
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_proc_asistencia($condicion)
    {
        try{

            $sql = "SELECT * FROM proceso_aprendizaje p INNER JOIN capacidades c ON p.Cap_IdCapacidades=c.Cap_IdCapacidades
                INNER JOIN competencias co ON c.Com_IdCompetencias=co.Com_IdCompetencias $condicion";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_semana_actitud($id,$semana)
    {
        try{

            $sql = "SELECT * FROM actitud_semanas WHERE Sil_Idasistencia = :id and Acs_Actitud=:semana";
            $result = $this->_db->prepare($sql);
            $result -> bindParam(':id',$id,PDO::PARAM_STR);
            $result -> bindParam(':semana',$semana,PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function listar_semana_capacidad($id)
    {
        try{

            $sql = "SELECT * FROM capacidad_semana cs INNER JOIN capacidades c ON cs.Cap_IdCapacidad=c.Cap_IdCapacidades
                    INNER JOIN competencias co ON c.Com_IdCompetencias=co.Com_IdCompetencias WHERE co.Sil_Idasistencia=  :id";
            $result = $this->_db->prepare($sql);
            $result -> bindParam(':id',$id,PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

     public function obtener_datos_asistencia($dato)
    {
        try{

            $sql = "SELECT * FROM asistencia s  INNER JOIN carga_academica caa ON caa.Sil_Idasistencia=s.Sil_Idasistencia 
            INNER JOIN usuario_rol ur ON caa.Usr_IdUsuarioRol=ur.Usr_IdUsuarioRol
            INNER JOIN usuario u ON ur.Usu_IdUsuario=u.Usu_IdUsuario 
            INNER JOIN curso c ON c.Cur_IdCurso=caa.Cur_IdCurso 
                WHERE s.Sil_Idasistencia=:dato";
             $result = $this->_db->prepare($sql);
            $result -> bindParam(':dato',$dato,PDO::PARAM_STR);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUltimoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function actualizar_asistencia($id,$asistencia,$sumilla,$act1,$act2,$act3,$fecha)
    {
        try {             
                $sql = "UPDATE asistencia SET Sil_CompetenciaGeneral=:asistencia,Sil_Sumilla=:sumilla,Sil_Actitud1=:act1,Sil_Actitud2=:act2,Sil_Actitud3=:act3,Sil_Fecha=:fecha WHERE Sil_Idasistencia=:id";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':id',$id,PDO::PARAM_STR);
                $result -> bindParam(':asistencia',$asistencia,PDO::PARAM_STR);
                $result -> bindParam(':sumilla',$sumilla,PDO::PARAM_STR);
                $result -> bindParam(':act1',$act1,PDO::PARAM_STR);
                $result -> bindParam(':act2',$act2,PDO::PARAM_STR);
                $result -> bindParam(':act3',$act3,PDO::PARAM_STR);
                $result -> bindParam(':fecha',$fecha,PDO::PARAM_STR);
                
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function actualizar_asistencia_comp($nombre,$condicion)
    {
        try {             
                $sql = "UPDATE competencias SET Com_Descripcion=:nombre $condicion ";
                $result = $this->_db->prepare($sql);
                $result -> bindParam(':nombre',$nombre,PDO::PARAM_STR);
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function registrar_proceso_ultima_cap()
    {
        try {             
                $sql = "INSERT proceso_aprendizaje VALUES('','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,(SELECT c.Cap_IdCapacidades FROM capacidades c ORDER BY c.Cap_IdCapacidades DESC LIMIT 1),1,1)";
                $result = $this->_db->prepare($sql);           
                $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function validar_editarasistencia2($condicion)
    {
        try {             
                $sql = "SELECT * FROM proceso_aprendizaje pa INNER JOIN capacidades c ON pa.Cap_IdCapacidades=c.Cap_IdCapacidades
                        INNER JOIN competencias co ON c.Com_IdCompetencias=co.Com_IdCompetencias $condicion";
                $result = $this->_db->prepare($sql);           
                $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


     public function actualizar_capacidad($id,$descripcion,$pond)
    {
        try {             
                $sql = "UPDATE capacidades c SET c.Cap_Descripcion=:descripcion WHERE c.Cap_IdCapacidades=:id ";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':id',$id,PDO::PARAM_STR);
                $result -> bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
                $result -> bindParam(':pond',$pond,PDO::PARAM_STR);
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function actualizar_asistencia3($capa,$contenidos,$estra,$ind,$proc_es,$proc_oral,$proc_obs,$proc_otros,$instr_c ,$instr_ru,$instr_fi,$instr_otros,$pond_c, $pond_p, $pond_i,$pond_a)
    {
        $resultado=$this->listar_existe_cap_proceso_id_cap($capa);
        if($resultado==''){
            return $this->registrar_asistencia3($capa,$contenidos,$estra,$ind,$proc_es,$proc_oral,$proc_obs,$proc_otros,$instr_c ,$instr_ru,$instr_fi,$instr_otros,$pond_c, $pond_p, $pond_i,$pond_a);
        }

        else{

        try {             
                $sql = "UPDATE proceso_aprendizaje pa SET pa.Pra_Contenidos=:contenidos,
pa.Pra_Estrategias=:estra,pa.Pra_Indicadores=:ind, pa.Pra_Proc_escrito=:proc_es, pa.Pra_Proc_oral=:proc_oral, pa.Pra_Proc_observacion=:proc_obs, pa.Pra_Proc_otros=:proc_otros, pa.Pra_Inst_cuestionario=:instr_c,pa.Pra_Inst_rubrica=:instr_ru,pa.Pra_Inst_ficha=:instr_fi,pa.Pra_Inst_otros=:instr_otros,pa.Pra_Pond_Conceptual=:pond_c,pa.Pra_Pond_Procedimental=:pond_p,pa.Pra_Pond_Investigacion=:pond_i,
pa.Pra_Pond_Actitudinal=:pond_a WHERE pa.Cap_IdCapacidades=:capa";
                $result = $this->_db->prepare($sql);
                $result -> bindParam(':contenidos',$contenidos,PDO::PARAM_STR);
                $result -> bindParam(':estra',$estra,PDO::PARAM_STR);
                $result -> bindParam(':ind',$ind,PDO::PARAM_STR);
                $result -> bindParam(':proc_es',$proc_es,PDO::PARAM_STR);
                $result -> bindParam(':proc_oral',$proc_oral,PDO::PARAM_STR);
                $result -> bindParam(':proc_obs',$proc_obs,PDO::PARAM_STR);
                $result -> bindParam(':proc_otros',$proc_otros,PDO::PARAM_STR);
                $result -> bindParam(':instr_c',$instr_c,PDO::PARAM_STR);
                $result -> bindParam(':instr_ru',$instr_ru,PDO::PARAM_STR);
                $result -> bindParam(':instr_fi',$instr_fi,PDO::PARAM_STR);
                $result -> bindParam(':instr_otros',$instr_otros,PDO::PARAM_STR);
                $result -> bindParam(':pond_c',$pond_c,PDO::PARAM_INT);
                $result -> bindParam(':pond_p',$pond_p,PDO::PARAM_INT);
                $result -> bindParam(':pond_i',$pond_i,PDO::PARAM_INT);
                $result -> bindParam(':pond_a',$pond_a,PDO::PARAM_INT);
                $result -> bindParam(':capa',$capa,PDO::PARAM_INT);
                // $result -> bindParam(':e',1,PDO::PARAM_INT);
                // $result -> bindParam(':s',1,PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia3", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
        }
    }

    public function eliminar_actitudes_semanas($id)
    {
        try {             
                $sql = "DELETE FROM actitud_semanas WHERE Sil_Idasistencia=:id ";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':id',$id,PDO::PARAM_STR);
                
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

     public function eliminar_capacidades($id)
    {
        try {             
                $sql = "DELETE FROM proceso_aprendizaje WHERE Cap_IdCapacidades=:id ";
                $result = $this->_db->prepare($sql);
                $result -> bindParam(':id',$id,PDO::PARAM_STR);        
                $result->execute();

                $sql2 = "DELETE FROM capacidad_semana WHERE Cap_IdCapacidad=:id ";
                $result2 = $this->_db->prepare($sql2);
                $result2 -> bindParam(':id',$id,PDO::PARAM_STR);        
                $result2->execute();

                $sql3 = "DELETE FROM capacidades WHERE Cap_IdCapacidades=:id ";
                $result3 = $this->_db->prepare($sql3);
                $result3 -> bindParam(':id',$id,PDO::PARAM_STR);        
                $result3->execute();


            return $result3->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }



    public function eliminar_capacidades_semanas($id)
    {
        try {             
                $sql = "SELECT * FROM capacidad_semana cs INNER JOIN capacidades c ON  cs.Cap_IdCapacidad=c.Cap_IdCapacidades INNER JOIN competencias co ON c.Com_IdCompetencias=co.Com_IdCompetencias WHERE co.Sil_Idasistencia=:id ";
                $result = $this->_db->prepare($sql);
                
                $result -> bindParam(':id',$id,PDO::PARAM_STR);
                
           
            $result->execute();
            $ids=($result->fetchAll());

            for($i=0;$i<count($ids);$i++){
                $sql2 = "DELETE FROM capacidad_semana WHERE Cas_IdCapacidadSemana=:id ";
                $result2 = $this->_db->prepare($sql2);
                
                $result2 -> bindParam(':id',$ids[$i]["Cas_IdCapacidadSemana"],PDO::PARAM_STR);
                
                $result2->execute();
            }
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "registrar_asistencia_competencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    
    //Util_Permiso Jhon Martinez
    public function getCursos($condicion = "")
    {
        try{
            // $sql = "SELECT * FROM curso WHERE curso_id=:dato";
            //     // $sentencia = $conexion ->prepare($sql);
            //     // $sentencia -> bindParam (':dato',$dato,PDO::PARAM_STR);
            //     // $sentencia ->  execute();
            //     $resultado = $sentencia -> fetch();


            $sql = " SELECT * FROM curso  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function getPermisosCondicion($pagina,$registrosXPagina,$condicion = "")
    {
        try{
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;                
            }
            $sql = " SELECT p.*, m.Mod_Nombre FROM permisos p
                LEFT JOIN modulo m ON p.Mod_IdModulo = m.Mod_IdModulo  $condicion 
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function cambiarEstadoPermisos($Per_IdPermiso, $Per_Estado)
    {
        try{
            if($Per_Estado==0)
            {

                $sql = "call s_u_cambiar_estado_permiso(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Per_IdPermiso, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Per_Estado==1)
            {

                $sql = "call s_u_cambiar_estado_permiso(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Per_IdPermiso, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "cambiarEstadoPermisos", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function editarPermiso($Per_IdPermiso, $Per_Nombre, $Per_Ckey, $Mod_IdModulo) {
        try{
            $permiso = $this->_db->query(
                " UPDATE permisos SET Per_Nombre = '$Per_Nombre', Per_Ckey = '$Per_Ckey', Mod_IdModulo = '$Mod_IdModulo' WHERE Per_IdPermiso = $Per_IdPermiso"
            );
            return $permiso->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

     public function cambiarEstadoasistencia($Sil_Idasistencia, $Sil_Estado)
    {
        try{
            if($Sil_Estado==0)
            {
                $sql = "call s_u_cambiar_estado_asistencia(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Sil_Estado==1)
            {
                $sql = "call s_u_cambiar_estado_asistencia(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "cambiarEstadoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util_Permiso Jhon Martinez
    public function getModulos(){
        try{
            $sql = "call s_s_listar_modulos()";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getModulos", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function verificarPermiso($permiso)
    {
        try{
            $permiso = $this->_db->query("SELECT * FROM permisos WHERE Per_Nombre = '$permiso'");
            return $permiso->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "verificarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso_Rol Jhon Martinez
    public function verificarPermisoRol($Per_IdPermiso)
    {
        try{
            $permiso = $this->_db->query("SELECT * FROM permisos_rol WHERE Per_IdPermiso = '$Per_IdPermiso' and Per_Valor = 1");
            return $permiso->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "verificarPermisoRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso_Usuario Jhon Martinez
    public function verificarPermisoUsuario($Per_IdPermiso)
    {
        try{
            $permiso = $this->_db->query("SELECT * FROM permisos_usuario WHERE Per_IdPermiso = '$Per_IdPermiso' and Peu_Valor = 1");
            return $permiso->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "verificarPermisoUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function verificarKey($ckey)
    {
        try{
            $ckey = $this->_db->query(" SELECT * FROM permisos WHERE Per_Ckey = '$ckey' ");
            return $ckey->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "verificarKey", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso_Rol Jhon Martinez
    public function verificarRol($Rol_Nombre)
    {
        try{
            $rol = $this->_db->query("SELECT * FROM rol WHERE Rol_Nombre = '$Rol_Nombre' ");
            return $rol->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "verificarRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function eliminarHabilitarPermiso($Per_IdPermiso = 0,$Row_Estado = 0)
    {
        try{

            $permiso = $this->_db->query(
                " UPDATE permisos SET Row_Estado = $Row_Estado WHERE Per_IdPermiso = $Per_IdPermiso "               
                );
            return $permiso->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util_Permiso Jhon Martinez
    public function getPermisosRol($Rol_IdRol)
    {
        $data = array();
        try{
            $permisos = $this->_db->query(
                    " SELECT * FROM permisos_rol WHERE Rol_IdRol = {$Rol_IdRol} "
                    );

            $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);

            for($i = 0; $i < count($permisos); $i++){
                $key = $this->getPermisoKey($permisos[$i]['Per_IdPermiso']);

                if($key == ''){continue;}
                if($permisos[$i]['Per_Valor'] == 1){
                    $v = true;
                }
                else{
                    $v = false;
                }

                $data[$key] = array(
                    'key' => $key,
                    'valor' => $v,
                    'nombre' => $this->getPermisoNombre($permisos[$i]['Per_IdPermiso']),
                    'id' => $permisos[$i]['Per_IdPermiso']
                );
            }

            $todos = $this->getPermisosAll();
            $data = array_merge($todos, $data);
        
            return $data;
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util_Permiso Jhon Martinez
    public function getPermisoNombre($Per_IdPermiso)
    {
        $Per_IdPermiso = (int) $Per_IdPermiso;
        try{
            $key = $this->_db->query(
                    " SELECT Per_Nombre FROM permisos WHERE Per_IdPermiso = $Per_IdPermiso "
                    );

            $key = $key->fetch();
            return $key['Per_Nombre'];
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisoNombre", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Permiso Jhon Martinez
    public function insertarPermiso($iPer_Nombre = "", $iPer_Ckey = "", $iMod_Modulo = "", $iIdi_IdIdioma="")
    {
        echo " iPer_Nombre:" . $iPer_Nombre ." iPer_Ckey:". $iPer_Ckey . "iMod_Modulo:" . $iMod_Modulo . "iIdi_IdIdioma:" . $iIdi_IdIdioma;
        try {             
            $sql = "call s_i_permisos(?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iPer_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iPer_Ckey, PDO::PARAM_STR);
            $result->bindParam(3, empty($iMod_Modulo) ? NULL : $iMod_Modulo,  PDO::PARAM_INT);            
            $result->bindParam(4, empty($iIdi_IdIdioma) ? NULL : $iIdi_IdIdioma,  PDO::PARAM_STR);
           
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util_Permiso_Rol Jhon Martinez
    // public function eliminarPermisosRol($permisoID)
    // {
    //     try{
    //         $permiso = $this->_db->query(
    //             " UPDATE permisos_rol SET Rol_Valor = 0  WHERE Per_IdPermiso = {$permisoID} "
    //             );
    //         return $permiso->rowCount(PDO::FETCH_ASSOC);
    //     } catch (PDOException $exception) {
    //         $this->registrarBitacora("acl(indexModel)", "eliminarPermisosRol", "Error Model", $exception);
    //         return $exception->getTraceAsString();
    //     }
    // }


    /*----------------------------------------*Roles*------------------------------------*/    

    //Util_Rol Jhon Martinez
    public function getRolesCompleto( $condicion = "")
    {
        try{
            $permiso = $this->_db->query(
                " SELECT r.* FROM rol r $condicion "               
                );
            return $permiso->rowCount(PDO::FETCH_ASSOC);

            // $sql = "call s_s_listar_roles_completo()";
            // $result = $this->_db->prepare($sql);
            // $result->execute();
            // return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getRolesPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try{
            $sql = "call s_s_listar_roles_con_modulo(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function getRolesRowCount($condicion = "")
    {
        try{
            $sql = " SELECT COUNT(r.Rol_IdRol) AS CantidadRegistros FROM rol r 
                    LEFT JOIN modulo m ON r.Mod_IdModulo = m.Mod_IdModulo  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function getRolesCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try{
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;                
            }
            $sql = " SELECT r.*, m.Mod_Nombre FROM rol r
                LEFT JOIN modulo m ON r.Mod_IdModulo = m.Mod_IdModulo  $condicion 
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function cambiarEstadoRol($Rol_IdRol, $Rol_Estado)
    {
        try{
            if($Rol_Estado==0)
            {
                $sql = "call s_u_cambiar_estado_rol(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Rol_IdRol, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Rol_Estado==1)
            {
                $sql = "call s_u_cambiar_estado_rol(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Rol_IdRol, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "cambiarEstadoRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function editarRol($Rol_IdRol, $Rol_Nombre) {
        try{
            $sql = "call s_u_cambiar_nombre_rol(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Rol_IdRol, PDO::PARAM_INT);
            $result->bindParam(2, $Rol_Nombre, PDO::PARAM_STR);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);  
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function eliminarPermisoRol($Rol_IdRol = 0, $Per_IdPermiso = 0)
    {
        try{
            $sql = "call s_d_eliminar_permisos_rol(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Rol_IdRol, PDO::PARAM_INT);
            $result->bindParam(2, $Per_IdPermiso, PDO::PARAM_INT);
            $result->execute();
            // return $result->rowCount(PDO::FETCH_ASSOC);  
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarPermisoRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    //Util_Rol Jhon Martinez
    public function editarPermisoRol($Rol_IdRol = 0, $Per_IdPermiso = 0, $valor = 0)
    {
        echo $Rol_IdRol.$Per_IdPermiso.$valor; 
        try{
            $sql = "call s_u_reemplazar_todo_permisos_rol(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Rol_IdRol, PDO::PARAM_INT);
            $result->bindParam(2, $Per_IdPermiso, PDO::PARAM_INT);
            $result->bindParam(3, $valor, PDO::PARAM_INT);
            $result->execute();
            // return $result->rowCount(PDO::FETCH_ASSOC);  
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarPermisoRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function eliminarHabilitarRol($iRol_IdRol = 0, $iRow_Estado = 0)
    {
        try{
            $sql = "call s_u_habilitar_deshabilitar_rol(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iRol_IdRol, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            
            return $result->rowCount(PDO::FETCH_ASSOC); 

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function getUsuarioRol($Rol_IdRol) {
        try{
            $roles = $this->_db->query(" SELECT ur.* FROM ( SELECT DISTINCT(Rol_IdRol) FROM usuario_rol ) ur WHERE ur.Rol_IdRol = $Rol_IdRol ");        
            return $roles->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getUsuarioRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util_Rol Jhon Martinez
    public function getRol($Rol_IdRol)
    {
        try{
            $Rol_IdRol = (int) $Rol_IdRol;        
            $rol = $this->_db->query(" SELECT * FROM rol WHERE Rol_IdRol = {$Rol_IdRol}");
            return $rol->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    



    public function getRolTraducido($Rol_IdRol,$Idi_IdIdioma)
    {
        try{
            $Rol_IdRol = (int) $Rol_IdRol;        
            $role = $this->_db->query(
                    "SELECT "
                    . "Rol_IdRol,"
                    . "fn_TraducirContenido('rol','Rol_Nombre',Rol_IdRol,'$Idi_IdIdioma',Rol_Nombre) Rol_Nombre,"
                    . "fn_devolverIdioma('rol',Rol_IdRol,'$Idi_IdIdioma',Idi_IdIdioma) Idi_IdIdioma"
                    . " FROM rol WHERE Rol_IdRol = {$Rol_IdRol}");
            return $role->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolTraducido", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    
    
    public function editarTraduccion($Rol_IdRol, $Rol_Nombre, $Idi_IdIdioma) {

        $ContTradNombre = $this->buscarCampoTraducido('rol', $Rol_IdRol, 'Rol_Nombre', $Idi_IdIdioma);
       
        $idContTradNombre = $ContTradNombre['Cot_IdContenidoTraducido'];
        
        if (isset($idContTradNombre)) {
            try{
                $rol = $this->_db->query(
                    "UPDATE contenido_traducido SET Cot_Traduccion = '$Rol_Nombre' WHERE Cot_IdContenidoTraducido = $idContTradNombre"
                );
                return $rol->rowCount();
            } catch (PDOException $exception) {
                $this->registrarBitacora("acl(indexModel)", "editarTraduccion", "Error Model", $exception);
                return $exception->getTraceAsString();
            }
        } else {
            try{
                $rol = $this->_db->prepare(
                        "INSERT INTO contenido_traducido VALUES (null, 'rol', :Cot_IdRegistro, 'Rol_Nombre' , :Idi_IdIdioma, :Cot_Traduccion)"
                    )
                    ->execute(array(
                        ':Cot_IdRegistro' => $Rol_IdRol,
                        ':Idi_IdIdioma' => $Idi_IdIdioma,
                        ':Cot_Traduccion' => $Rol_Nombre
                ));
                return $rol->rowCount();
            } catch (PDOException $exception) {
                $this->registrarBitacora("acl(indexModel)", "editarTraduccion", "Error Model", $exception);
                return $exception->getTraceAsString();
            }            
        }
    }
    
    public function buscarCampoTraducido($tabla, $Rol_IdRol, $columna, $Idi_IdIdioma) {
        try{
            $post = $this->_db->query(
                    "SELECT * FROM contenido_traducido WHERE Cot_Tabla = '$tabla' AND Cot_IdRegistro =  $Rol_IdRol AND  Cot_Columna = '$columna' AND Idi_IdIdioma= '$Idi_IdIdioma'");
            return $post->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "buscarCampoTraducido", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    
    public function getPermisosUsuario()
    {
        try{
            $permisos = $this->_db->query(" SELECT * FROM permisos_usuario ");        
            return $permisos->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    


    public function getPermiso($Per_IdPermiso)
    {
        try{
            $Per_IdPermiso = (int) $Per_IdPermiso;
            $key = $this->_db->query(
                    "SELECT * FROM permisos WHERE Per_IdPermiso = $Per_IdPermiso"
                    );
            return $key->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getPermisoKey($Per_IdPermiso)
    {
        $Per_IdPermiso = (int) $Per_IdPermiso;
        try{
            $key = $this->_db->query(
                    "SELECT Per_Ckey as 'key' FROM permisos WHERE Per_IdPermiso = $Per_IdPermiso"
                    );

            $key = $key->fetch();
            return $key['key'];
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisoKey", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    
    
    public function getPermisosAll()
    {
        try{
            $permisos = $this->_db->query(
                    "SELECT * FROM permisos"
                    );

            $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);

            for($i = 0; $i < count($permisos); $i++){
                $data[$permisos[$i]['Per_Ckey']] = array(
                    'key' => $permisos[$i]['Per_Ckey'],
                    'valor' => 'x',
                    'nombre' => $permisos[$i]['Per_Nombre'],
                    'id' => $permisos[$i]['Per_IdPermiso']
                );
            }

            return $data;
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosAll", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    
    public function insertarRol($iRol_Nombre, $iIdi_IdIdioma="", $iRol_Estado=1)
    {
        try {            
            $sql = "call s_i_rol(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iRol_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, empty($iIdi_IdIdioma) ?  null: $iIdi_IdIdioma, PDO::PARAM_NULL | PDO::PARAM_STR);
            $result->bindParam(3, $iRol_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    


    public function eliminarPermisosUsuario($permisoID)
    {
        try{
            $permiso = $this->_db->query(
                "DELETE FROM permisos_usuario " . 
                "WHERE Per_IdPermiso = {$permisoID} " .
                "AND Usu_Valor = 0 "               
                );
            return $permiso->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarPermisosUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function eliminarRole($roleID)
    {
        try{
            $this->_db->query(
                " DELETE FROM rol WHERE Rol_IdRol = $roleID "               
                );
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarRole", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }    
    
    public function getIdiomas() {
        try {
            $idiomas = $this->_db->query("SELECT * FROM idioma");
            return $idiomas->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getIdiomas", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }



    // asistencias
    //Util Jhon Martinez
    public function getasistenciasRowCount($condicion = "")
    {
        try{
            $sql = "SELECT COUNT(caa.Caa_IdCargaAcademica) AS CantidadRegistros FROM carga_academica caa INNER JOIN usuario_rol ur ON caa.Usr_IdUsuarioRol=ur.Usr_IdUsuarioRol
            INNER JOIN usuario u ON ur.Usu_IdUsuario=u.Usu_IdUsuario 
            INNER JOIN curso c ON c.Cur_IdCurso=caa.Cur_IdCurso $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistenciasRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getalumnosRowCount($condicion = "")
    {
        try{
            $sql = "SELECT COUNT(mca.Mca_IdMatriculaCargaAcademica) AS CantidadRegistros FROM matricula_carga_academica mca 
INNER JOIN matricula mat ON mca.Mat_IdMatricula=mca.Mat_IdMatricula
INNER JOIN usuario_rol ur ON mat.Usr_IdUsuarioRol=ur.Usr_IdUsuarioRol
INNER JOIN usuario u ON ur.Usu_IdUsuario=u.Usu_IdUsuario $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistenciasRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    //Util Jhon Martinez
    public function getasistenciasPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try{
            $sql = "call s_s_listar_miscursos(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistenciasPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }    

     public function getalumnosPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1, $carga = 0)
    {
        try{
            $sql = "call s_s_listar_alumnos(?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $carga, PDO::PARAM_INT);
            $result->bindParam(4, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistenciasPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }    
    //Util Jhon Martinez
    public function verificarasistencia($Fac_Nombre)
    {
        try{
            $result = $this->_db->query("SELECT * FROM asistencia WHERE Fac_Nombre = '$Fac_Nombre' ");
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "verificarasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    /*

    public function insertarasistencia($iFac_Nombre, $iFac_Direccion = "", $iFac_Telefono = "", $iFac_Estado = 1, $iRow_Estado = 1)
    {
        try {            
            $sql = "call s_i_asistencia(?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iFac_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iFac_Direccion, PDO::PARAM_STR);
            $result->bindParam(3, $iFac_Telefono, PDO::PARAM_STR);
            $result->bindParam(4, $iFac_Estado, PDO::PARAM_INT);
            $result->bindParam(5, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "insertarasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }   

    */ 
    //Util Jhon Martinez
    /*
    public function cambiarEstadoasistencia($Sil_Idasistencia, $Sil_Estado)
    {
        try{
            if($Fac_Estado==0)
            {
                $sql = "call s_u_cambiar_estado_asistencia(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);                
            }
            if($Fac_Estado==1)
            {
                $sql = "call s_u_cambiar_estado_asistencia(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "cambiarEstadoasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    */
    //Util Jhon Martinez
    public function getasistenciasCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try{
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;                
            }
            $sql = " SELECT * FROM carga_academica caa  
            INNER JOIN usuario_rol ur ON caa.Usr_IdUsuarioRol=ur.Usr_IdUsuarioRol
            INNER JOIN usuario u ON ur.Usu_IdUsuario=u.Usu_IdUsuario 
            INNER JOIN curso c ON c.Cur_IdCurso=caa.Cur_IdCurso $condicion 
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistenciasCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    /*
    //Util Jhon Martinez
    public function editarasistencia($Sil_Idasistencia, $Fac_Nombre, $Fac_Direccion, $Fac_Telefono ) {
        try{
            $sql = "call s_u_editar_asistencia(?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
            $result->bindParam(2, $Fac_Nombre , PDO::PARAM_STR);
            $result->bindParam(3, $Fac_Direccion , PDO::PARAM_STR);
            $result->bindParam(4, $Fac_Telefono , PDO::PARAM_STR);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);  
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "editarasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    // Util Jhon Martinez
    public function getEscuelaasistencia($Sil_Idasistencia) {
        try{
            $result = $this->_db->query(" SELECT Sil_Idasistencia FROM escuela WHERE Sil_Idasistencia = $Sil_Idasistencia ");        
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getEscuelaasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    */

    //Util Jhon Martinez
    // public function eliminarPermisoasistencia($Sil_Idasistencia = 0, $Per_IdPermiso = 0)
    // {
    //     try{
    //         $sql = "call s_d_eliminar_permisos_asistencia(?,?)";
    //         $result = $this->_db->prepare($sql);
    //         $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
    //         $result->bindParam(2, $Per_IdPermiso, PDO::PARAM_INT);
    //         $result->execute();
    //         // return $result->rowCount(PDO::FETCH_ASSOC);  
    //     } catch (PDOException $exception) {
    //         $this->registrarBitacora("asistencia(indexModel)", "eliminarPermisoRol", "Error Model", $exception);
    //         return $exception->getTraceAsString();
    //     }
    // }
    //Util Jhon Martinez
    // public function editarPermisoasistencia($Sil_Idasistencia = 0, $Per_IdPermiso = 0, $valor = 0)
    // {
    //     echo $Sil_Idasistencia.$Per_IdPermiso.$valor; 
    //     try{
    //         $sql = "call s_u_reemplazar_todo_permisos_asistencia(?,?,?)";
    //         $result = $this->_db->prepare($sql);
    //         $result->bindParam(1, $Sil_Idasistencia, PDO::PARAM_INT);
    //         $result->bindParam(2, $Per_IdPermiso, PDO::PARAM_INT);
    //         $result->bindParam(3, $valor, PDO::PARAM_INT);
    //         $result->execute();
    //         // return $result->rowCount(PDO::FETCH_ASSOC);  
    //     } catch (PDOException $exception) {
    //         $this->registrarBitacora("asistencia(indexModel)", "editarPermisoRol", "Error Model", $exception);
    //         return $exception->getTraceAsString();
    //     }
    // }
    //Util Jhon Martinez
    public function getasistencias($condicion = "")
    {
        try{     
            $result = $this->_db->query(" SELECT * FROM carga_academica ca  
            INNER JOIN usuario_rol ur ON ca.Usr_IdUsuarioRol=ur.Usr_IdUsuarioRol
            INNER JOIN usuario u ON ur.Usu_IdUsuario=u.Usu_IdUsuario 
            INNER JOIN curso c ON c.Cur_IdCurso=ca.Cur_IdCurso $condicion ");
            return $result->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistencias", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getasistencia($Sil_Idasistencia)
    {
        try{
            $Sil_Idasistencia = (int) $Sil_Idasistencia;
            $key = $this->_db->query(
                    "SELECT * FROM asistencia WHERE Sil_Idasistencia = $Sil_Idasistencia"
                    );
            return $key->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "getasistencia", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util Jhon Martinez
    public function eliminarHabilitarasistencia($iFac_IdRol = 0, $iRow_Estado = 0)
    {
        try{
            $sql = "call s_u_habilitar_deshabilitar_asistencia(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iFac_IdRol, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            
            return $result->rowCount(PDO::FETCH_ASSOC); 

        } catch (PDOException $exception) {
            $this->registrarBitacora("asistencia(indexModel)", "eliminarHabilitarRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
}

?>
