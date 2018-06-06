<?php

class indexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

//-----------------------------*Presmisos*-----------------------------------------
    //     //Util_Permiso Jhon Martinez
    //     public function getPermisos($pagina = 1, $registrosXPagina = 1, $activos = 1)
    //     {
    //         try{
    //             $sql = "call s_s_listar_permisos_con_modulo(?,?,?)";
    //             $result = $this->_db->prepare($sql);
    //             $result->bindParam(1, $pagina, PDO::PARAM_INT);
    //             $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
    //             $result->bindParam(3, $activos, PDO::PARAM_INT);
    //             $result->execute();
    //             return $result->fetchAll(PDO::FETCH_ASSOC);
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "getPermisos", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }

//     //Util_Permiso Jhon Martinez
    //     public function getPermisosRowCount($condicion = "")
    //     {
    //         try{
    //             $sql = " SELECT COUNT(p.Per_IdPermiso) AS CantidadRegistros FROM permisos p LEFT JOIN modulo m ON p.Mod_IdModulo = m.Mod_IdModulo  $condicion ";
    //             $result = $this->_db->prepare($sql);
    //             $result->execute();
    //             return $result->fetch(PDO::FETCH_ASSOC);
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "getPermisosRowCount", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function getPermisosCondicion($pagina,$registrosXPagina,$condicion = "")
    //     {
    //         try{
    //             $registroInicio = 0;
    //             if ($pagina > 0) {
    //                 $registroInicio = ($pagina - 1) * $registrosXPagina;
    //             }
    //             $sql = " SELECT p.*, m.Mod_Nombre FROM permisos p
    //                 LEFT JOIN modulo m ON p.Mod_IdModulo = m.Mod_IdModulo  $condicion
    //                 LIMIT $registroInicio, $registrosXPagina ";
    //             $result = $this->_db->query($sql);
    //             return $result->fetchAll(PDO::FETCH_ASSOC);
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "getPermisosCondicion", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function cambiarEstadoPermisos($Per_IdPermiso, $Per_Estado)
    //     {
    //         try{
    //             if($Per_Estado==0)
    //             {

//                 $sql = "call s_u_cambiar_estado_permiso(?,1)";
    //                 $result = $this->_db->prepare($sql);
    //                 $result->bindParam(1, $Per_IdPermiso, PDO::PARAM_INT);
    //                 $result->execute();

//                 return $result->rowCount(PDO::FETCH_ASSOC);
    //             }
    //             if($Per_Estado==1)
    //             {

//                 $sql = "call s_u_cambiar_estado_permiso(?,0)";
    //                 $result = $this->_db->prepare($sql);
    //                 $result->bindParam(1, $Per_IdPermiso, PDO::PARAM_INT);
    //                 $result->execute();

//                 return $result->rowCount(PDO::FETCH_ASSOC);
    //             }

//         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "cambiarEstadoPermisos", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function editarPermiso($Per_IdPermiso, $Per_Nombre, $Per_Ckey, $Mod_IdModulo) {
    //         try{
    //             $permiso = $this->_db->query(
    //                 " UPDATE permisos SET Per_Nombre = '$Per_Nombre', Per_Ckey = '$Per_Ckey', Mod_IdModulo = '$Mod_IdModulo' WHERE Per_IdPermiso = $Per_IdPermiso"
    //             );
    //             return $permiso->rowCount(PDO::FETCH_ASSOC);
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "editarPermiso", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function getModulos(){
    //         try{
    //             $sql = "call s_s_listar_modulos()";
    //             $result = $this->_db->prepare($sql);
    //             $result->execute();
    //             return $result->fetchAll(PDO::FETCH_ASSOC);
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "getModulos", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function verificarPermiso($permiso)
    //     {
    //         try{
    //             $permiso = $this->_db->query("SELECT * FROM permisos WHERE Per_Nombre = '$permiso'");
    //             return $permiso->fetch();
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "verificarPermiso", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso_facultad Jhon Martinez
    //     public function verificarPermisoFacultad($Per_IdPermiso)
    //     {
    //         try{
    //             $permiso = $this->_db->query("SELECT * FROM permisos_facultad WHERE Per_IdPermiso = '$Per_IdPermiso' and Per_Valor = 1");
    //             return $permiso->fetchAll();
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "verificarPermisoRol", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso_Usuario Jhon Martinez
    //     public function verificarPermisoUsuario($Per_IdPermiso)
    //     {
    //         try{
    //             $permiso = $this->_db->query("SELECT * FROM permisos_usuario WHERE Per_IdPermiso = '$Per_IdPermiso' and Peu_Valor = 1");
    //             return $permiso->fetchAll();
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "verificarPermisoUsuario", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function verificarKey($ckey)
    //     {
    //         try{
    //             $ckey = $this->_db->query(" SELECT * FROM permisos WHERE Per_Ckey = '$ckey' ");
    //             return $ckey->fetch();
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "verificarKey", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }

//     //Util_Permiso Jhon Martinez
    //     public function eliminarHabilitarPermiso($Per_IdPermiso = 0,$Row_Estado = 0)
    //     {
    //         try{

//             $permiso = $this->_db->query(
    //                 " UPDATE permisos SET Row_Estado = $Row_Estado WHERE Per_IdPermiso = $Per_IdPermiso "
    //                 );
    //             return $permiso->rowCount(PDO::FETCH_ASSOC);
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "eliminarHabilitarPermiso", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }

//     //Util_Permiso Jhon Martinez
    //     public function getPermisosFacultad($Fac_IdFacultad)
    //     {
    //         $data = array();
    //         try{
    //             $permisos = $this->_db->query(
    //                     " SELECT * FROM permisos_facultad WHERE Rol_IdRol = {$Fac_IdFacultad} "
    //                     );

//             $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);

//             for($i = 0; $i < count($permisos); $i++){
    //                 $key = $this->getPermisoKey($permisos[$i]['Per_IdPermiso']);

//                 if($key == ''){continue;}
    //                 if($permisos[$i]['Per_Valor'] == 1){
    //                     $v = true;
    //                 }
    //                 else{
    //                     $v = false;
    //                 }

//                 $data[$key] = array(
    //                     'key' => $key,
    //                     'valor' => $v,
    //                     'nombre' => $this->getPermisoNombre($permisos[$i]['Per_IdPermiso']),
    //                     'id' => $permisos[$i]['Per_IdPermiso']
    //                 );
    //             }

//             $todos = $this->getPermisosAll();
    //             $data = array_merge($todos, $data);

//             return $data;
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "getPermisosRol", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }

//     //Util_Permiso Jhon Martinez
    //     public function getPermisoNombre($Per_IdPermiso)
    //     {
    //         $Per_IdPermiso = (int) $Per_IdPermiso;
    //         try{
    //             $key = $this->_db->query(
    //                     " SELECT Per_Nombre FROM permisos WHERE Per_IdPermiso = $Per_IdPermiso "
    //                     );

//             $key = $key->fetch();
    //             return $key['Per_Nombre'];
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "getPermisoNombre", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }
    //     //Util_Permiso Jhon Martinez
    //     public function insertarPermiso($iPer_Nombre = "", $iPer_Ckey = "", $iMod_Modulo = "", $iIdi_IdIdioma="")
    //     {
    //         echo " iPer_Nombre:" . $iPer_Nombre ." iPer_Ckey:". $iPer_Ckey . "iMod_Modulo:" . $iMod_Modulo . "iIdi_IdIdioma:" . $iIdi_IdIdioma;
    //         try {
    //             $sql = "call s_i_permisos(?,?,?,?)";
    //             $result = $this->_db->prepare($sql);
    //             $result->bindParam(1, $iPer_Nombre, PDO::PARAM_STR);
    //             $result->bindParam(2, $iPer_Ckey, PDO::PARAM_STR);
    //             $result->bindParam(3, empty($iMod_Modulo) ? NULL : $iMod_Modulo,  PDO::PARAM_INT);
    //             $result->bindParam(4, empty($iIdi_IdIdioma) ? NULL : $iIdi_IdIdioma,  PDO::PARAM_STR);

//             $result->execute();
    //             return $result->fetch();
    //         } catch (PDOException $exception) {
    //             $this->registrarBitacora("carga_academica(indexModel)", "insertarPermiso", "Error Model", $exception);
    //             return $exception->getTraceAsString();
    //         }
    //     }

//     //Util_Permiso_facultad Jhon Martinez
    //     // public function eliminarPermisosFacultad($permisoID)
    //     // {
    //     //     try{
    //     //         $permiso = $this->_db->query(
    //     //             " UPDATE permisos_facultad SET Rol_Valor = 0  WHERE Per_IdPermiso = {$permisoID} "
    //     //             );
    //     //         return $permiso->rowCount(PDO::FETCH_ASSOC);
    //     //     } catch (PDOException $exception) {
    //     //         $this->registrarBitacora("carga_academica(indexModel)", "eliminarPermisosRol", "Error Model", $exception);
    //     //         return $exception->getTraceAsString();
    //     //     }
    //     // }

//     /*----------------------------------------*Roles*------------------------------------*/

//     //Util_Cursos Jhon Martinez
    //     // public function getRolesCompleto( $condicion = "")
    //     // {
    //     //     try{
    //     //         $permiso = $this->_db->query(
    //     //             " SELECT r.* FROM rol r $condicion "
    //     //             );
    //     //         return $permiso->rowCount(PDO::FETCH_ASSOC);

//     //         // $sql = "call s_s_listar_facultades_completo()";
    //     //         // $result = $this->_db->prepare($sql);
    //     //         // $result->execute();
    //     //         // return $result->fetchAll(PDO::FETCH_ASSOC);
    //     //     } catch (PDOException $exception) {
    //     //         $this->registrarBitacora("carga_academica(indexModel)", "getRolesCompleto", "Error Model", $exception);
    //     //         return $exception->getTraceAsString();
    //     //     }
    //     // }

// CARGA ACADEMICA
    //Util Jhon Martinez
    public function getCargasAcademicasRowCount($condicion = "")
    {
        try {
            $sql    = " SELECT COUNT(ca.Caa_IdCargaAcademica) AS CantidadRegistros FROM carga_academica ca $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCargasAcademicasRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getCargasAcademicasPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_cargas_academicas(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCargasAcademicasPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getEscuelaXUsuarioRol($Usu_IdUsuario = '')
    {
        try {
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
    //Util Jhon Martinez
    public function getCurriculasXEscuelaID($Esc_IdEscuela = '')
    {
        try {
            $result = $this->_db->query(
                "  SELECT Cui_IdCurricula, Cui_Nombre, Cui_Codigo FROM curricula WHERE Esc_IdEscuela = $Esc_IdEscuela"
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCurriculasXEscuelaID", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getCursoXCurriculaID($Cui_IdCurricula = '')
    {
        try {
            $result = $this->_db->query(
                "  SELECT cur.Cur_IdCurso, cur.Cur_Nombre FROM curso cur
                INNER JOIN ciclo_curricula ciu ON cur.Ciu_IdCicloCurricula = ciu.Ciu_IdCicloCurricula
                WHERE cur.Cur_Estado = 1 AND ciu.Cui_IdCurricula = $Cui_IdCurricula "
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCursoXCurriculaID", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getDocentes()
    {
        try {
            $result = $this->_db->query(
                "  SELECT usr.Usr_IdUsuarioRol, usu.Usu_IdUsuario, usu.Usu_Nombre, usu.Usu_Apellidos FROM usuario usu
                INNER JOIN usuario_rol usr ON usu.Usu_IdUsuario = usr.Usu_IdUsuario
                WHERE usr.Usr_Valor = 1 AND usr.Rol_IdRol = 13 "
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getDocentes", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getSemestres()
    {
        try {
            $result = $this->_db->query(
                "  SELECT Sem_IdSemestre, Sem_Ano, Sem_Numero FROM semestre "
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getSemestres", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getAmbientes()
    {
        try {
            $result = $this->_db->query(
                "  SELECT * FROM ambiente "
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getAmbientes", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function verificarCargaAcademica($Cur_IdCurso, $Usr_IdUsuarioRol, $Sem_IdSemestre)
    {
        try {
            $result = $this->_db->query(" SELECT Caa_IdCargaAcademica FROM carga_academica WHERE Cur_IdCurso = $Cur_IdCurso AND Usr_IdUsuarioRol = $Usr_IdUsuarioRol AND Sem_IdSemestre = $Sem_IdSemestre ");
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "verificarCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function insertarCargaAcademica($Caa_Grupo, $Caa_Tipo = 0, $Caa_Vacantes = 0, $Cur_IdCurso, $Usr_IdUsuarioRol, $Sem_IdSemestre, $Caa_Estado = 1, $Row_Estado = 1)
    {
        try {
            $sql    = "call s_i_carga_academica(?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Caa_Grupo, PDO::PARAM_INT);
            $result->bindParam(2, $Caa_Tipo, PDO::PARAM_INT);
            $result->bindParam(3, $Caa_Vacantes, PDO::PARAM_INT);
            $result->bindParam(4, $Cur_IdCurso, PDO::PARAM_INT);
            $result->bindParam(5, $Sem_IdSemestre, PDO::PARAM_INT);
            $result->bindParam(6, $Usr_IdUsuarioRol, PDO::PARAM_INT);
            $result->bindParam(7, $Caa_Estado, PDO::PARAM_INT);
            $result->bindParam(8, $Row_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getCargaAcademicaCurso($Caa_IdCargaAcademica)
    {
        try {
            $result = $this->_db->query(" SELECT * FROM carga_academica caa
                INNER JOIN curso cur ON caa.Cur_IdCurso = cur.Cur_IdCurso
                INNER JOIN ciclo_curricula ciu ON cur.Ciu_IdCicloCurricula = ciu.Ciu_IdCicloCurricula
                WHERE Caa_IdCargaAcademica = $Caa_IdCargaAcademica ");
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function editarCargaAcademica($Caa_IdCargaAcademica, $Caa_Grupo, $Caa_Tipo, $Caa_Vacantes, $Cur_IdCurso, $Usr_IdUsuarioRol, $Sem_IdSemestre)
    {
        try {
            $sql    = "call s_u_editar_carga_academica(?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Caa_IdCargaAcademica, PDO::PARAM_INT);
            $result->bindParam(2, $Caa_Grupo, PDO::PARAM_INT);
            $result->bindParam(3, $Caa_Tipo, PDO::PARAM_INT);
            $result->bindParam(4, $Caa_Vacantes, PDO::PARAM_INT);
            $result->bindParam(5, $Cur_IdCurso, PDO::PARAM_INT);
            $result->bindParam(6, $Sem_IdSemestre, PDO::PARAM_INT);
            $result->bindParam(7, $Usr_IdUsuarioRol, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "editarCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getHorariosXIdCargaAcademica($Caa_IdCargaAcademica)
    {
        try {
            $result = $this->_db->query(" SELECT hor.*, amb.Amb_Nombre, amb.Amb_Direccion FROM horario hor
                INNER JOIN horario_carga_academica hca ON hor.Hor_IdHorario = hca.Hor_IdHorario
                INNER JOIN ambiente amb ON hor.Amb_IdAmbiente = amb.Amb_IdAmbiente
                WHERE hca.Caa_IdCargaAcademica = $Caa_IdCargaAcademica ");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getHorariosXIdCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function registrarHorario($Caa_IdCargaAcademica, $Hor_Dia, $Hor_Inicio, $Hor_Fin, $Hor_Tipo, $Amb_IdAmbiente, $Hor_Estado = 1, $Row_Estado = 1)
    {
        try {
            $sql    = "call s_i_horario(?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Hor_Dia, PDO::PARAM_STR);
            $result->bindParam(2, $Hor_Tipo, PDO::PARAM_INT);
            $result->bindParam(3, $Hor_Inicio, PDO::PARAM_STR);
            $result->bindParam(4, $Hor_Fin, PDO::PARAM_STR);
            $result->bindParam(5, $Amb_IdAmbiente, PDO::PARAM_INT);
            $result->bindParam(6, $Hor_Estado, PDO::PARAM_INT);
            $result->bindParam(7, $Row_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function agregarHorarioCargaAcademica($Caa_IdCargaAcademica, $Hor_IdHorario)
    {
        try {
            $sql    = "call s_i_horario_carga_academica(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Caa_IdCargaAcademica, PDO::PARAM_INT);
            $result->bindParam(2, $Hor_IdHorario, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarCargaAcademica", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

// CURSOS X JOSE
    public function getCursoRowCount($condicion = "")
    {
        try {
            $sql = " SELECT COUNT(cic.Cic_Nombre) AS CantidadRegistros FROM
                     curricula cui INNER JOIN ciclo_curricula ciu
                     ON ciu.Cui_IdCurricula=cui.Cui_IdCurricula
                     INNER JOIN curso cur ON cur.Ciu_IdCicloCurricula=Ciu.Ciu_IdCicloCurricula
                     INNER JOIN escuela esc ON esc.Esc_IdEscuela=cui.Esc_IdEscuela
                     INNER JOIN ciclo cic ON cic.Cic_IdCiclo=ciu.Cic_IdCiclo
                     $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getCursoPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_curso(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getCurriculas($condicion = '')
    {
        try {
            $permiso = $this->_db->query(
                "SELECT * FROM curricula" . $condicion
            );
            return $permiso->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getCicloCurricula($condicion = '')
    {
        try {
            // $permiso = $this->_db->query("SELECT ciu.Ciu_IdCicloCurricula ,cic.Cic_Nombre FROM ciclo cic INNER JOIN ciclo_curricula ciu ON cic.Cic_IdCiclo = ciu.Cic_IdCiclo INNER JOIN curricula cur ON ciu.Cui_IdCurricula = cur.Cui_IdCurricula".$condicion);
            $permiso = $this->_db->query("SELECT ciu.Ciu_IdCicloCurricula ,cic.Cic_Nombre FROM ciclo cic INNER JOIN ciclo_curricula ciu ON cic.Cic_IdCiclo = ciu.Cic_IdCiclo INNER JOIN curricula cur ON ciu.Cui_IdCurricula = cur.Cui_IdCurricula WHERE ciu.Cui_IdCurricula =" . $condicion);
            // WHERE ciu.Cui_IdCurricula".$condicion);
            //.$condicion);
            /*"SELECT ciu.* FROM ciclo_curricula ciu".$condicion );*/
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getCur_Requisito($condicion = '')
    {
        try {
            $permiso = $this->_db->query("SELECT cur.Cur_IdCurso,cur.Cur_Nombre,cur.Cur_Codigo FROM curso cur INNER JOIN ciclo_curricula ciu ON cur.Ciu_IdCicloCurricula = ciu.Ciu_IdCicloCurricula WHERE ciu.Cui_IdCurricula =" . $condicion);
            // WHERE ciu.Cui_IdCurricula".$condicion);
            //.$condicion);
            /*"SELECT ciu.* FROM ciclo_curricula ciu".$condicion );*/
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //////////// funcion para insertar datos en la primera tabla ////////////////
    public function insertarCurso($iCur_Nombre,
        $iCur_Codigo,
        $iCur_Creditos,
        $iCur_HorasTeoria,
        $iCur_HorasPractica,
        $iCur_Semanas,
        $iCur_Tipo,
        $iCiu_IdCicloCurricula,
        //$icursopre,
        $iCur_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_i_curso(?,?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCur_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iCur_Codigo, PDO::PARAM_STR);
            $result->bindParam(3, $iCur_Creditos, PDO::PARAM_INT);
            $result->bindParam(4, $iCur_HorasTeoria, PDO::PARAM_INT);
            $result->bindParam(5, $iCur_HorasPractica, PDO::PARAM_INT);
            $result->bindParam(6, $iCur_Semanas, PDO::PARAM_INT);
            $result->bindParam(7, $iCur_Tipo, PDO::PARAM_STR);
            $result->bindParam(8, $iCiu_IdCicloCurricula, PDO::PARAM_INT);
            $result->bindParam(9, $iCur_Estado, PDO::PARAM_INT);
            $result->bindParam(10, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            $ultimoid = $result->fetch();
            return $ultimoid;

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarCurso($iCur_IdCurso,
        $iCur_Nombre,
        $iCur_Codigo,
        $iCur_Creditos,
        $iCur_HorasTeoria,
        $iCur_HorasPractica,
        $iCur_Semanas,
        $iCur_Tipo,
        $iCiu_IdCicloCurricula,
        //$icursopre,
        $iCur_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_u_cambiar_curso(?,?,?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCur_IdCurso, PDO::PARAM_INT);
            $result->bindParam(2, $iCur_Nombre, PDO::PARAM_STR);
            $result->bindParam(3, $iCur_Codigo, PDO::PARAM_STR);
            $result->bindParam(4, $iCur_Creditos, PDO::PARAM_INT);
            $result->bindParam(5, $iCur_HorasTeoria, PDO::PARAM_INT);
            $result->bindParam(6, $iCur_HorasPractica, PDO::PARAM_INT);
            $result->bindParam(7, $iCur_Semanas, PDO::PARAM_INT);
            $result->bindParam(8, $iCur_Tipo, PDO::PARAM_STR);
            $result->bindParam(9, $iCiu_IdCicloCurricula, PDO::PARAM_INT);
            $result->bindParam(10, $iCur_Estado, PDO::PARAM_INT);
            $result->bindParam(11, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarciclo($iCiclo_IdCiclo,
        $iCic_Nombre,
        $iCic_Numero,
        $iCic_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_u_cambiar_ciclo(?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCiclo_IdCiclo, PDO::PARAM_INT);
            $result->bindParam(2, $iCic_Nombre, PDO::PARAM_STR);
            $result->bindParam(3, $iCic_Numero, PDO::PARAM_INT);
            $result->bindParam(4, $iCur_Estado, PDO::PARAM_INT);
            $result->bindParam(5, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getciclo($Cic_IdCiclo)
    {
        try {
            $Cic_IdCiclo = (int) $Cic_IdCiclo;
            $key         = $this->_db->query(
                "SELECT * FROM ciclo WHERE Cic_IdCiclo = $Cic_IdCiclo"
            );
            return $key->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getciclo", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertarCursoRequisito($iCur_IdCursoPrincipal, $iCur_IdRequisito)
    {
        // print_r($iCur_IdCursoPrincipal, $iCur_IdRequisito);
        // exit();
        $iCur_IdCursoPrincipal = (int) $iCur_IdCursoPrincipal;
        $iCur_IdRequisito      = (int) $iCur_IdRequisito;

        try {
            $sql    = "call s_i_curso_requisito(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCur_IdCursoPrincipal, PDO::PARAM_INT);
            $result->bindParam(2, $iCur_IdRequisito, PDO::PARAM_INT);
            $result->execute();
            $respuesta = $result->fetch();
            return $respuesta;
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCursoRequisito", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function update_curso_requisito($idcurso, $idrequisito)
    {
        try {
            $idcurso     = (int) $idcurso;
            $idrequisito = (int) $idrequisito;
            $cur         = $this->_db->query("UPDATE `curso_requisito` SET `Cue_IdRequisito`=$idrequisito WHERE `Cue_IdCursoPrincipal`=$idcurso");
            return $cur->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCurso($Cur_IdCurso)
    {
        try {

            $Cur_IdCurso = (int) $Cur_IdCurso;
            $Cur_IdCurso = $this->_db->query("SELECT Cur.*, Esc.Esc_IdEscuela,Cui.Cui_IdCurricula,Cue.Cue_IdRequisito
                                          FROM ciclo Cic INNER JOIN ciclo_curricula ciu ON Cic.Cic_IdCiclo = Ciu.Cic_IdCiclo
                                          INNER JOIN curso Cur ON Ciu.Ciu_IdCicloCurricula = Cur.Ciu_IdCicloCurricula
                                          INNER JOIN curricula Cui ON Ciu.Cui_IdCurricula = Cui.Cui_IdCurricula
                                          INNER JOIN escuela Esc ON Cui.Esc_IdEscuela = Esc.Esc_IdEscuela
                                          LEFT JOIN curso_requisito Cue ON Cur.Cur_IdCurso=Cue.Cue_IdCursoPrincipal
                                          WHERE Cur.Cur_IdCurso = $Cur_IdCurso");

            /*"SELECT * FROM curso WHERE Cur_IdCurso = $Cur_IdCurso"
            //WHERE cur.Cur_IdCurso = $condicion)*/

            return $Cur_IdCurso->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCursoCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try {
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;
            }
            $sql = " SELECT cur.*, esc.Esc_Nombre,cui.Cui_Resolucion,cic.Cic_Nombre FROM
                     curricula cui INNER JOIN ciclo_curricula ciu
                     ON ciu.Cui_IdCurricula=cui.Cui_IdCurricula
                     INNER JOIN curso cur ON cur.Ciu_IdCicloCurricula=Ciu.Ciu_IdCicloCurricula
                     INNER JOIN escuela esc ON esc.Esc_IdEscuela=cui.Esc_IdEscuela
                     INNER JOIN ciclo cic ON cic.Cic_IdCiclo=ciu.Cic_IdCiclo $condicion
                     LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCur_Requisito_uno($condicion)
    {
        try {
            $permiso = $this->_db->query("SELECT Cur_IdRequisito  FROM `curso_requisito` WHERE Cur_IdCursoPrincipal = " . $condicion);
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

// FACULTADES
    //Util Jhon Martinez
    public function getFacultadesRowCount($condicion = "")
    {
        try {
            $sql    = " SELECT COUNT(f.Fac_IdFacultad) AS CantidadRegistros FROM facultad f $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getFacultadesRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getFacultadesPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_facultades(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getFacultadesPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function verificarFacultad($Fac_Nombre)
    {
        try {
            $result = $this->_db->query("SELECT * FROM facultad WHERE Fac_Nombre = '$Fac_Nombre' ");
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "verificarFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function insertarFacultad($iFac_Nombre, $iFac_Direccion = "", $iFac_Telefono = "", $iFac_Estado = 1, $iRow_Estado = 1)
    {
        try {
            $sql    = "call s_i_facultad(?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iFac_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iFac_Direccion, PDO::PARAM_STR);
            $result->bindParam(3, $iFac_Telefono, PDO::PARAM_STR);
            $result->bindParam(4, $iFac_Estado, PDO::PARAM_INT);
            $result->bindParam(5, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function cambiarEstadoFacultad($Fac_IdFacultad, $Fac_Estado)
    {
        try {
            if ($Fac_Estado == 0) {
                $sql    = "call s_u_cambiar_estado_facultad(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Fac_IdFacultad, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
            if ($Fac_Estado == 1) {
                $sql    = "call s_u_cambiar_estado_facultad(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Fac_IdFacultad, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "cambiarEstadoFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

//Util Jhon Martinez
    public function getFacultadesCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try {
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;
            }
            $sql = " SELECT f.* FROM facultad f $condicion
                LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getFacultadesCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function editarFacultad($Fac_IdFacultad, $Fac_Nombre, $Fac_Direccion, $Fac_Telefono)
    {
        try {
            $sql    = "call s_u_editar_facultad(?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Fac_IdFacultad, PDO::PARAM_INT);
            $result->bindParam(2, $Fac_Nombre, PDO::PARAM_STR);
            $result->bindParam(3, $Fac_Direccion, PDO::PARAM_STR);
            $result->bindParam(4, $Fac_Telefono, PDO::PARAM_STR);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "editarFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
// Util Jhon Martinez
    public function getEscuelaFacultad($Fac_IdFacultad)
    {
        try {
            $result = $this->_db->query(" SELECT Fac_IdFacultad FROM escuela WHERE Fac_IdFacultad = $Fac_IdFacultad ");
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuelaFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

//Util Jhon Martinez
    // public function eliminarPermisoFacultad($Fac_IdFacultad = 0, $Per_IdPermiso = 0)
    // {
    //     try{
    //         $sql = "call s_d_eliminar_permisos_facultad(?,?)";
    //         $result = $this->_db->prepare($sql);
    //         $result->bindParam(1, $Fac_IdFacultad, PDO::PARAM_INT);
    //         $result->bindParam(2, $Per_IdPermiso, PDO::PARAM_INT);
    //         $result->execute();
    //         // return $result->rowCount(PDO::FETCH_ASSOC);
    //     } catch (PDOException $exception) {
    //         $this->registrarBitacora("carga_academica(indexModel)", "eliminarPermisoRol", "Error Model", $exception);
    //         return $exception->getTraceAsString();
    //     }
    // }
    //Util Jhon Martinez
    // public function editarPermisoFacultad($Fac_IdFacultad = 0, $Per_IdPermiso = 0, $valor = 0)
    // {
    //     echo $Fac_IdFacultad.$Per_IdPermiso.$valor;
    //     try{
    //         $sql = "call s_u_reemplazar_todo_permisos_facultad(?,?,?)";
    //         $result = $this->_db->prepare($sql);
    //         $result->bindParam(1, $Fac_IdFacultad, PDO::PARAM_INT);
    //         $result->bindParam(2, $Per_IdPermiso, PDO::PARAM_INT);
    //         $result->bindParam(3, $valor, PDO::PARAM_INT);
    //         $result->execute();
    //         // return $result->rowCount(PDO::FETCH_ASSOC);
    //     } catch (PDOException $exception) {
    //         $this->registrarBitacora("carga_academica(indexModel)", "editarPermisoRol", "Error Model", $exception);
    //         return $exception->getTraceAsString();
    //     }
    // }
    //Util Jhon Martinez
    public function getFacultades($condicion = "")
    {
        try {
            $result = $this->_db->query(" SELECT * FROM facultad $condicion ");
            return $result->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getFacultades", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getFacultad($Fac_IdFacultad)
    {
        try {
            $Fac_IdFacultad = (int) $Fac_IdFacultad;
            $key            = $this->_db->query(
                "SELECT * FROM facultad WHERE Fac_IdFacultad = $Fac_IdFacultad"
            );
            return $key->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

//Util Jhon Martinez
    public function eliminarHabilitarFacultad($iFac_IdRol = 0, $iRow_Estado = 0)
    {
        try {
            $sql    = "call s_u_habilitar_deshabilitar_facultad(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iFac_IdRol, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "eliminarHabilitarRol", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

// ESCUELA
    public function getEscuelas($condicion = '')
    {
        try {

            $result = $this->_db->query(
                "  SELECT e.*, f.Fac_Nombre FROM escuela e INNER JOIN facultad f ON e.Fac_IdFacultad = f.Fac_IdFacultad " . $condicion
            );
            return $result->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuelas", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function getEscuela($condicion = '')
    {
        try {
            $result = $this->_db->query(
                "  SELECT * FROM escuela " . $condicion
            );
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function insertarEscuela($iEsc_Nombre, $iEsc_Descripcion = "", $iEsc_Direccion = "", $iEsc_Telefono = "-", $iFac_IdFacultad = 0, $iEsc_Estado = 1, $iRow_Estado = 1)
    {
        try {
            $sql    = "call s_i_escuela(?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iEsc_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iEsc_Descripcion, PDO::PARAM_STR);
            $result->bindParam(3, $iEsc_Direccion, PDO::PARAM_STR);
            $result->bindParam(4, $iEsc_Telefono, PDO::PARAM_STR);
            $result->bindParam(5, $iFac_IdFacultad, PDO::PARAM_INT);
            $result->bindParam(6, $iEsc_Estado, PDO::PARAM_INT);
            $result->bindParam(7, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function editarEscuela($Esc_IdEscuela, $iEsc_Nombre, $iEsc_Descripcion, $iEsc_Direccion, $iEsc_Telefono, $iFac_IdFacultad)
    {
        try {
            $result = $this->_db->query(
                "UPDATE escuela SET Esc_Nombre = '$iEsc_Nombre', Esc_Descripcion = '$iEsc_Descripcion', Esc_Direccion = '$iEsc_Direccion', Esc_Telefono = '$iEsc_Telefono', Fac_IdFacultad = $iFac_IdFacultad, Esc_Nombre = '$iEsc_Nombre' where Esc_IdEscuela = $Esc_IdEscuela"
            );
            return $result->rowCount();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "editarEscuela", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function cambiarEstadoEscuela($Esc_IdEscuela, $estado)
    {
        try {
            if ($estado == 0) {
                $usuarios = $this->_db->query(
                    "UPDATE escuela SET Esc_Estado = 1 where Esc_IdEscuela = $Esc_IdEscuela"
                );
            }
            if ($estado == 1) {
                $usuarios = $this->_db->query(
                    "UPDATE escuela SET Esc_Estado = 0 where Esc_IdEscuela = $Esc_IdEscuela"
                );
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "cambiarEstadoReino", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

// CURRICULAS
    //Util Jhon Martinez
    public function getCurriculasRowCount($condicion = "")
    {
        try {
            $sql    = " SELECT COUNT(c.Cui_IdCurricula) AS CantidadRegistros FROM curricula c $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCurriculaRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getCurriculasPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_curriculas(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCurriculasPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function verificarCurricula($Cui_Nombre, $Cui_Codigo, $Cui_Resolucion)
    {
        try {
            $result = $this->_db->query("SELECT * FROM curricula WHERE Cui_Nombre = '$Cui_Nombre' OR  Cui_Codigo = '$Cui_Codigo' OR Cui_Codigo = '$Cui_Codigo' ");
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "verificarCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function insertarCurricula($iCui_Nombre, $iCui_Descripcion = "", $iCui_Codigo = "", $iCui_Resolucion = "", $iEsc_IdEscuela, $iCui_Estado = 1, $iRow_Estado = 1)
    {
        try {
            $sql    = "call s_i_curricula(?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCui_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iCui_Descripcion, PDO::PARAM_STR);
            $result->bindParam(3, $iCui_Codigo, PDO::PARAM_STR);
            $result->bindParam(4, $iCui_Resolucion, PDO::PARAM_STR);
            $result->bindParam(5, empty($iEsc_IdEscuela) ? null : $iEsc_IdEscuela, PDO::PARAM_NULL | PDO::PARAM_INT);
            $result->bindParam(6, $iCui_Estado, PDO::PARAM_INT);
            $result->bindParam(7, $iRow_Estado, PDO::PARAM_INT);
            // $result->bindParam(2, empty($iIdi_IdIdioma) ?  null: $iIdi_IdIdioma, PDO::PARAM_NULL | PDO::PARAM_STR);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getCurriculasCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try {
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;
            }
            $sql = "    SELECT c.*, e.Esc_Nombre FROM curricula c
                        INNER JOIN escuela e ON c.Esc_IdEscuela = e.Esc_IdEscuela $condicion
                        LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCurriculasCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function cambiarEstadoCurricula($IdRegistro, $EstadoRegistro)
    {
        try {
            if ($EstadoRegistro == 0) {
                $sql    = "call s_u_cambiar_estado_curricula(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $IdRegistro, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
            if ($EstadoRegistro == 1) {
                $sql    = "call s_u_cambiar_estado_curricula(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $IdRegistro, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "cambiarEstadoCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function editarCurricula($Cui_IdCurricula, $Cui_Nombre, $Cui_Descripcion, $Cui_Codigo, $Cui_Resolucion, $Esc_IdEscuela)
    {
        try {
            $sql    = "call s_u_editar_curricula(?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $Cui_IdCurricula, PDO::PARAM_INT);
            $result->bindParam(2, $Cui_Nombre, PDO::PARAM_STR);
            $result->bindParam(3, $Cui_Descripcion, PDO::PARAM_STR);
            $result->bindParam(4, $Cui_Codigo, PDO::PARAM_STR);
            $result->bindParam(5, $Cui_Resolucion, PDO::PARAM_STR);
            $result->bindParam(6, $Esc_IdEscuela, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "editarCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function eliminarHabilitarCurricula($IdRegistro = 0, $Row_Estado = 0)
    {
        try {
            $sql    = "call s_u_habilitar_deshabilitar_curricula(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $IdRegistro, PDO::PARAM_INT);
            $result->bindParam(2, $Row_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getCurricula($Cui_IdCurricula = '')
    {
        try {
            $result = $this->_db->query(
                "  SELECT * FROM curricula WHERE Cui_IdCurricula = '$Cui_IdCurricula' "
            );
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

// CICLOS
    //Util Jhon Martinez
    public function getCiclosRowCount($condicion = "")
    {
        try {
            $sql    = " SELECT COUNT(c.Cic_IdCiclo) AS CantidadRegistros FROM ciclo c $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCiclosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getCiclosPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_ciclo(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCiclosPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function verificarCiclo($Cic_Nombre)
    {
        try {
            $result = $this->_db->query("SELECT * FROM ciclo WHERE Cic_Nombre = '$Cic_Nombre' ");
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "verificarCurricula", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function insertarCiclo($iCic_Nombre, $iCic_Numero = "", $iCic_Estado = 1, $iRow_Estado = 1)
    {
        try {
            $sql    = "call s_i_ciclo(?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCic_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iCic_Numero, PDO::PARAM_STR);
            $result->bindParam(3, $iCic_Estado, PDO::PARAM_INT);
            $result->bindParam(4, $iRow_Estado, PDO::PARAM_INT);
            // $result->bindParam(2, empty($iIdi_IdIdioma) ?  null: $iIdi_IdIdioma, PDO::PARAM_NULL | PDO::PARAM_STR);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "insertarCiclo", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function getCiclosCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try {
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;
            }
            $sql = "    SELECT c.* FROM ciclo c  $condicion
                        LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getCiclosCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function cambiarEstadoCiclo($IdRegistro, $EstadoRegistro)
    {
        try {
            if ($EstadoRegistro == 0) {
                $sql    = "call s_u_cambiar_estado_ciclo(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $IdRegistro, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
            if ($EstadoRegistro == 1) {
                $sql    = "call s_u_cambiar_estado_ciclo(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $IdRegistro, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "cambiarEstadoCiclo", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
//Util Jhon Martinez
    public function eliminarHabilitarCiclo($IdRegistro = 0, $Row_Estado = 0)
    {
        try {
            $sql    = "call s_u_habilitar_deshabilitar_ciclo(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $IdRegistro, PDO::PARAM_INT);
            $result->bindParam(2, $Row_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "eliminarHabilitarCiclo", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

// HORARIOS

//Util Jhon Martinez
    public function getHorariosRowCount($condicion = "")
    {
        try {
            $sql    = " SELECT COUNT(h.Hor_IdHorario) AS CantidadRegistros FROM horario h $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getHorariosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

//Util Jhon Martinez
    public function getHorariosPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_horarios(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getHorariosPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

}
