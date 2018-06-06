<?php

class usuarioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /////////////////////////////////////////7 CODIGO DE   JOSE //////////////////////////////////////////////////

    public function getMaestro()
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

    public function getDocenteBusqueda($condicion = '')
    {
        try {

            $result = $this->_db->query(
                //  "  SELECT e.*, f.Fac_Nombre FROM escuela e INNER JOIN facultad f ON e.Fac_IdFacultad = f.Fac_IdFacultad " . $condicion
                "SELECT Ded.*,Usr.Usr_IdUsuarioRol,Usu.Usu_Nombre,Usu.Usu_Apellidos,Esc.Esc_Nombre
                FROM usuario Usu INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario
                INNER JOIN detalle_docente Ded ON Usr.Usr_IdUsuarioRol=Ded.Usr_IdUsuarioRol
                INNER JOIN escuela Esc ON Ded.Esc_IdEscuela=Esc.Esc_IdEscuela " . $condicion
                // WHERE Usu.Usu_Nombre='Juan Manuel'
            );
            return $result->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuelas", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getAlumnoBusqueda($condicion = '')
    {
        try {

            $result = $this->_db->query(
                "SELECT Dea.*, Usr.Usr_IdUsuarioRol,Usu.Usu_Nombre,Usu.Usu_Apellidos,Cui.Cui_Nombre,Cui.Cui_Resolucion
                 FROM usuario Usu
                 INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario
                 INNER JOIN detalle_alumno Dea ON Usr.Usr_IdUsuarioRol=Dea.Usr_IdUsuarioRol
                 INNER JOIN curricula Cui ON Dea.Cui_IdCurricula=Cui.Cui_IdCurricula" . $condicion
                //WHERE Usu.Usu_Nombre='Lelis'
            );
            return $result->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getEscuelas", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getDocenteDetalle($Ded_IdDetalleDocente)
    {
        try {
            $Ded_IdDetalleDocente = (int) $Ded_IdDetalleDocente;
            $key                  = $this->_db->query(
                "SELECT * FROM detalle_docente  WHERE Ded_IdDetalleDocente = $Ded_IdDetalleDocente"
            );
            return $key->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(usuarioModel)", "getDocenteDetalle", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getAlumnoDetalle($Dea_IdDetalleAlumno)
    {
        try {
            $Dea_IdDetalleAlumno = (int) $Dea_IdDetalleAlumno;
            $key                 = $this->_db->query(
                // "SELECT * FROM detalle_alumno  WHERE Dea_IdDetalleAlumno = $Dea_IdDetalleAlumno "
                "SELECT dea.*, Esc.Esc_IdEscuela FROM usuario Usu INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario INNER JOIN detalle_alumno dea ON Usr.Usr_IdUsuarioRol=dea.Usr_IdUsuarioRol INNER JOIN curricula Cui ON dea.Cui_IdCurricula=Cui.Cui_IdCurricula INNER JOIN escuela Esc ON cui.Esc_IdEscuela=esc.Esc_IdEscuela WHERE Dea_IdDetalleAlumno = $Dea_IdDetalleAlumno"
            );
            return $key->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(usuarioModel)", "getAlumnoDetalle", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getDocentePaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_usudocente(?,?,?)";
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

    public function getDocenteCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try {
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;
            }
            $sql = "SELECT Ded.*,Usr.Usr_IdUsuarioRol,Usu.Usu_Nombre,Usu.Usu_Apellidos,Esc.Esc_Nombre
        FROM usuario Usu INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario
        INNER JOIN detalle_docente Ded ON Usr.Usr_IdUsuarioRol=Ded.Usr_IdUsuarioRol
        INNER JOIN escuela Esc ON Ded.Esc_IdEscuela=Esc.Esc_IdEscuela
                    LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getDocenteRowCount($condicion = "")
    {
        try {
            $sql = "SELECT COUNT(Usr.Usr_IdUsuarioRol) AS CantidadRegistros FROM usuario Usu
                INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario
                INNER JOIN detalle_docente Ded on Usr.Usr_IdUsuarioRol=Ded.Usr_IdUsuarioRol
                INNER JOIN escuela Esc on Ded.Esc_IdEscuela=Esc.Esc_IdEscuela $condicion";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getAlumnoRowCount($condicion = "")
    {
        try {
            $sql = "SELECT COUNT(Usr.Usr_IdUsuarioRol) AS CantidadRegistros FROM usuario Usu
                    INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario
                    INNER JOIN detalle_alumno Dea ON Usr.Usr_IdUsuarioRol=Dea.Usr_IdUsuarioRol
                    INNER JOIN curricula Cui on Dea.Cui_IdCurricula=Cui.Cui_IdCurricula $condicion";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getAlumnoPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try {
            $sql    = "call s_s_listar_usualumno(?,?,?)";
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

    public function getAlumnoCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try {
            $registroInicio = 0;
            if ($pagina > 0) {
                $registroInicio = ($pagina - 1) * $registrosXPagina;
            }
            $sql = "SELECT Dea.*, Usr.Usr_IdUsuarioRol,Usu.Usu_Nombre,Usu.Usu_Apellidos,Cui.Cui_Nombre,Cui.Cui_Resolucion
                    FROM usuario Usu
                    INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario
                    INNER JOIN detalle_alumno Dea ON Usr.Usr_IdUsuarioRol=Dea.Usr_IdUsuarioRol
                    INNER JOIN curricula Cui ON Dea.Cui_IdCurricula=Cui.Cui_IdCurricula
                    LIMIT $registroInicio, $registrosXPagina ";
            $result = $this->_db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getescuela()
    {
        try {
            $permiso = $this->_db->query("SELECT Esc_IdEscuela,Esc_Nombre FROM escuela");
            return $permiso->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();{}
        }
    }

    public function getcurricula($condicion = '')
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

    public function getEstudiante()
    {
        try {
            $result = $this->_db->query(
                "  SELECT Usr.Usr_IdUsuarioRol,Usu.Usu_Nombre,Usu.Usu_Apellidos FROM usuario Usu
                   INNER JOIN usuario_rol Usr ON usu.Usu_IdUsuario=Usr.Usu_IdUsuario WHERE Usr.Rol_IdRol=6 "
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "getDocentes", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertardetalledocente(
        $iDed_GradoAcademico,
        $iDed_Condicion,
        $iDed_Dedicacion,
        $iDed_Categoria,
        $iDed_Cargo,
        $iUsr_IdUsuarioRol,
        $iEsc_IdEscuela,
        $iDed_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_i_detalle_docente(?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iDed_GradoAcademico, PDO::PARAM_STR);
            $result->bindParam(2, $iDed_Condicion, PDO::PARAM_STR);
            $result->bindParam(3, $iDed_Dedicacion, PDO::PARAM_STR);
            $result->bindParam(4, $iDed_Categoria, PDO::PARAM_STR);
            $result->bindParam(5, $iDed_Cargo, PDO::PARAM_STR);
            $result->bindParam(6, $iUsr_IdUsuarioRol, PDO::PARAM_INT);
            $result->bindParam(7, $iEsc_IdEscuela, PDO::PARAM_INT);
            $result->bindParam(8, $iDed_Estado, PDO::PARAM_INT);
            $result->bindParam(9, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertar_detale_docente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertardetallealumno(
        $iDea_CodigoUniversitario,
        $iCui_IdCurricula,
        $iUsr_IdUsuarioRol,
        $iDea_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_i_detalle_alumno(?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iDea_CodigoUniversitario, PDO::PARAM_INT);
            $result->bindParam(2, $iCui_IdCurricula, PDO::PARAM_INT);
            $result->bindParam(3, $iUsr_IdUsuarioRol, PDO::PARAM_INT);
            $result->bindParam(4, $iDea_Estado, PDO::PARAM_INT);
            $result->bindParam(5, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertar_detalle_alumno", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarDocente($iDed_IdDetalleDocente,
        $iDed_GradoAcademico,
        $iDed_Condicion,
        $iDed_Dedicacion,
        $iDed_Categoria,
        $iDed_Cargo,
        $iUsr_IdUsuarioRol,
        $iEsc_IdEscuela,
        $iDed_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_u_editar_detalledocente(?,?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iDed_IdDetalleDocente, PDO::PARAM_INT);
            $result->bindParam(2, $iDed_GradoAcademico, PDO::PARAM_STR);
            $result->bindParam(3, $iDed_Condicion, PDO::PARAM_STR);
            $result->bindParam(4, $iDed_Dedicacion, PDO::PARAM_STR);
            $result->bindParam(5, $iDed_Categoria, PDO::PARAM_STR);
            $result->bindParam(6, $iDed_Cargo, PDO::PARAM_STR);
            $result->bindParam(7, $iUsr_IdUsuarioRol, PDO::PARAM_INT);
            $result->bindParam(8, $iEsc_IdEscuela, PDO::PARAM_INT);
            $result->bindParam(9, $iDed_Estado, PDO::PARAM_INT);
            $result->bindParam(10, $iRow_Estado, PDO::PARAM_INT);

            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("carga_academica(indexModel)", "editarFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarAlumno($iDea_IdDetalleAlumno,
        $iDea_CodigoUniversitario,
        $iCui_IdCurricula,
        $iUsr_IdUsuarioRol,
        $iDea_Estado,
        $iRow_Estado) {
        try {
            $sql    = "call s_u_editar_detallealumno(?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iDea_IdDetalleAlumno, PDO::PARAM_INT);
            $result->bindParam(2, $iDea_CodigoUniversitario, PDO::PARAM_INT);
            $result->bindParam(3, $iCui_IdCurricula, PDO::PARAM_INT);
            $result->bindParam(4, $iUsr_IdUsuarioRol, PDO::PARAM_INT);
            $result->bindParam(5, $iDea_Estado, PDO::PARAM_INT);
            $result->bindParam(6, $iRow_Estado, PDO::PARAM_INT);

            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuarios(indexModel)", "editarFacultad", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function cambiarEstadoDocente($Ded_IdDetalleDocente, $Ded_Estado)
    {
        try {
            if ($Ded_Estado == 0) {
                $sql    = "call s_u_cambiar_estado_docente(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Ded_IdDetalleDocente, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
            if ($Ded_Estado == 1) {
                $sql    = "call s_u_cambiar_estado_docente(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Ded_IdDetalleDocente, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuarios(indexModel)", "cambiarestadoDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function cambiarEstadoAlumno($Dea_IdDetalleAlumno, $Dea_Estado)
    {
        try {
            if ($Dea_Estado == 0) {
                $sql    = "call s_u_cambiar_estado_alumno(?,1)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Dea_IdDetalleAlumno, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
            if ($Dea_Estado == 1) {
                $sql    = "call s_u_cambiar_estado_alumno(?,0)";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $Dea_IdDetalleAlumno, PDO::PARAM_INT);
                $result->execute();

                return $result->rowCount(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuarios(indexModel)", "cambiarestadoAlumno", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function eliminarHabilitarDocente($iDed_IdDetalleDocente = 0, $iRow_Estado = 0)
    {
        try {
            $sql    = "call s_u_habilitar_deshabilitar_docente(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iDed_IdDetalleDocente, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("usuarios(indexModel)", "eliminarHabilitarDocente", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function eliminarHabilitarAlumno($iDea_IdDetalleAlumno = 0, $iRow_Estado = 0)
    {
        try {
            $sql    = "call s_u_habilitar_deshabilitar_alumno(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iDea_IdDetalleAlumno, PDO::PARAM_INT);
            $result->bindParam(2, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("usuarios(indexModel)", "eliminarHabilitarAlumno", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    /////////////////////////// CODIGO DE JOSE /////////////////////////////////////////////////////////////////////77

    //Util Jhon Martinez
    public function getUsuariosPaginado($condicion = '')
    {
        try {
            $listaUsuarios = $this->_db->query(
                " SELECT u.* from usuario u $condicion "
            );
            $listaUsuarios = $listaUsuarios->fetchAll();

            for ($i = 0; $i < count($listaUsuarios); $i++) {
                if (!empty($listaUsuarios[$i]['Usu_IdUsuario'])) {
                    $listaUsuarios[$i]['Roles'] = $this->getUsuariosRoles($listaUsuarios[$i]['Usu_IdUsuario']);
                }
            }

            return $listaUsuarios;
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "getUsuariosPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getUsuariosRowCount($condicion = '')
    {
        try {
            $usuarios = $this->_db->query(
                " SELECT COUNT(u.Usu_IdUsuario) AS CantidadRegistros from usuario u $condicion "
            );
            return $usuarios->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "getUsuariosRowCount", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util Jhon Martinez
    public function getUsuariosRoles($Usu_IdUsuario = '')
    {
        try {
            $rol = $this->_db->query(
                " SELECT r.* from usuario_rol ur, rol r WHERE ur.Rol_IdRol = r.Rol_IdRol AND ur.Usu_IdUsuario = $Usu_IdUsuario "
            );
            return $rol->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "getUsuariosRoles", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getUsuarios($condicion = '')
    {
        try {
            $usuarios = $this->_db->query(
                "select u.*,r.Rol_Nombre from usuario u, rol r " .
                "where u.Rol_IdRol = r.Rol_IdRol $condicion"
            );
            return $usuarios->fetchAll();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "getUsuarios", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //util JM
    public function getUsuario($usuarioID)
    {
        try {
            $usuarios = $this->_db->query(
                " SELECT u.* FROM usuario u  WHERE u.Usu_IdUsuario = $usuarioID"
            );
            return $usuarios->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "getUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function eliminarUsuario($Usu_IdUsuario)
    {
        try {
            $usu = $this->_db->query(
                "delete from usuario where Usu_IdUsuario = $Usu_IdUsuario "
            );
            return $usu->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "eliminarUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getRoles()
    {
        try {
            $roles = $this->_db->query(
                " SELECT * FROM rol WHERE Rol_Estado = 1 AND Row_Estado = 1");
            return $roles->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "getRoles", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    //Util JM
    public function getPermisosUsuario($usuarioID)
    {
        $acl = new ACL($usuarioID);
        return $acl->getPermisos();
    }
    //Util JM
    public function getPermisosRoles($usuarioID)
    {
        $acl = new ACL($usuarioID);
        return $acl->getPermisosRoles();
    }

    //Util JM
    public function replaceRolUsuario($Usu_IdUsuario, $Rol_IdRol)
    {
        try {
            $usu = $this->_db->query(
                " REPLACE usuario_rol SET Usu_IdUsuario = $Usu_IdUsuario, Rol_IdRol = $Rol_IdRol, Usr_Valor = 1 "
            );
            return $usu->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "replaceRolUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util JM
    public function eliminarPermiso($usuarioID, $permisoID)
    {
        try {
            $per = $this->_db->query(
                " DELETE FROM permisos_usuario WHERE Usu_IdUsuario = $usuarioID AND Per_IdPermiso = $permisoID "
            );
            return $per->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "eliminarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    //Util JM
    public function editarPermiso($usuarioID, $permisoID, $valor)
    {
        try {
            $per = $this->_db->query(
                " REPLACE INTO permisos_usuario SET Usu_IdUsuario = $usuarioID, Per_IdPermiso = $permisoID, Peu_Valor = '$valor'"
            );
            return $per->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "editarPermiso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function verificarUsuario($usuario)
    {
        try {
            $id = $this->_db->query(
                "select Usu_IdUsuario, Usu_Codigo from usuario where Usu_Usuario = '$usuario'"
            );
            return $id->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "verificarUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function verificarEmail($email)
    {
        try {
            $id = $this->_db->query(
                "select Usu_IdUsuario, Usu_Codigo, Usu_Usuario, Usu_Email from usuario where Usu_Email = '$email'"
            );
            return $id->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "verificarUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function verificarEmailCodigo($email, $codigo)
    {
        try {
            $id = $this->_db->query(
                "select Usu_IdUsuario, Usu_Codigo, Usu_Email, Usu_Usuario, Usu_RecuperarPass from usuario where Usu_Email = '$email' and Usu_Codigo = '$codigo' "
            );
            return $id->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "verificarEmailCodigo", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function registrarUsuario($iUsu_Nombre = "", $iUsu_Apellidos = "",
        $iUsu_DocumentoIdentidad = 0, $iUsu_Direccion = "",
        $iUsu_Telefono = "", $iUsu_InstitucionLaboral = "",
        $iUsu_Cargo = "", $iUsu_Usuario = "", $iUsu_Password = "",
        $iUsu_Email = "", $iUsu_Estado = 0, $iUsu_Codigo = 0) {
        $iUsu_Password = Hash::getHash('sha1', $iUsu_Password, HASH_KEY);
        try {
            $sql    = "call s_i_usuario(?,?,?,?,?,?,?,?,?,?,now(),now(),?,?,1)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iUsu_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iUsu_Apellidos, PDO::PARAM_STR);
            $result->bindParam(3, $iUsu_DocumentoIdentidad, PDO::PARAM_INT);
            $result->bindParam(4, $iUsu_Direccion, PDO::PARAM_STR);
            $result->bindParam(5, $iUsu_Telefono, PDO::PARAM_STR);
            $result->bindParam(6, $iUsu_InstitucionLaboral, PDO::PARAM_STR);
            $result->bindParam(7, $iUsu_Cargo, PDO::PARAM_STR);
            $result->bindParam(8, $iUsu_Usuario, PDO::PARAM_STR);
            $result->bindParam(9, $iUsu_Password, PDO::PARAM_STR);
            $result->bindParam(10, $iUsu_Email, PDO::PARAM_STR);
            // $result->bindParam(11, $iRol_IdRol, PDO::PARAM_INT);
            //            $result->bindParam(12, $iUsu_Fecha, PDO::PARAM_STR);
            $result->bindParam(11, $iUsu_Estado, PDO::PARAM_STR);
            $result->bindParam(12, $iUsu_Codigo, PDO::PARAM_STR);

            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "registrarUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function insertarUsuarioLogin($iUsu_Nombre = "", $iUsu_Apellidos = "", $iUsu_Usuario = "", $iUsu_Password = "", $iUsu_Email = "", $iRol_Ckey = "", $iUsu_Estado = 0, $iUsu_Codigo = 0)
    {
        if ($iUsu_Password == "") {
            // echo("arg1");
            try {
                $sql    = " call s_i_usuario_login_gmail(?,?,?,?,now(),now(),1,?,1) ";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $iUsu_Nombre, PDO::PARAM_STR);
                $result->bindParam(2, $iUsu_Apellidos, PDO::PARAM_STR);
                $result->bindParam(3, $iUsu_Usuario, PDO::PARAM_STR);
                // $result->bindParam(4, $iUsu_Password, PDO::PARAM_STR);
                $result->bindParam(4, $iUsu_Email, PDO::PARAM_STR);
                // $result->bindParam(11, $iRol_IdRol, PDO::PARAM_INT);
                //            $result->bindParam(12, $iUsu_Fecha, PDO::PARAM_STR);
                // $result->bindParam(5, $iUsu_Estado, PDO::PARAM_INT);
                $result->bindParam(5, $iUsu_Codigo, PDO::PARAM_STR);

                $result->execute();

                $result = $result->fetch();
                // return $result;
                // print_r($result);exit;

            } catch (PDOException $exception) {
                $this->registrarBitacora("usuario(indexModel)", "insertarUsuarioLogin1", "Error Model", $exception);
                return $exception->getTraceAsString();
            }
        } else {

            $iUsu_Password = Hash::getHash('sha1', $iUsu_Password, HASH_KEY);
            // echo($iUsu_Password.$iUsu_Nombre.$iUsu_Apellidos.$iUsu_Usuario.$iUsu_Password.$iUsu_Email.$iRol_Ckey.$iUsu_Estado.$iUsu_Codigo);
            try {
                $sql    = " call s_i_usuario_login(?,?,?,?,?,now(),now(),?,?,1) ";
                $result = $this->_db->prepare($sql);
                $result->bindParam(1, $iUsu_Nombre, PDO::PARAM_STR);
                $result->bindParam(2, $iUsu_Apellidos, PDO::PARAM_STR);
                $result->bindParam(3, $iUsu_Usuario, PDO::PARAM_STR);
                $result->bindParam(4, $iUsu_Password, PDO::PARAM_STR);
                $result->bindParam(5, $iUsu_Email, PDO::PARAM_STR);
                // $result->bindParam(11, $iRol_IdRol, PDO::PARAM_INT);
                //            $result->bindParam(12, $iUsu_Fecha, PDO::PARAM_STR);
                $result->bindParam(6, $iUsu_Estado, PDO::PARAM_INT);
                $result->bindParam(7, $iUsu_Codigo, PDO::PARAM_STR);

                $result->execute();

                $result = $result->fetch();
                // return $result;
                // print_r($result);exit;

            } catch (PDOException $exception) {
                $this->registrarBitacora("usuario(indexModel)", "insertarUsuarioLogin2", "Error Model", $exception);
                return $exception->getTraceAsString();
            }
        }

        if ($iRol_Ckey == "" || !$iRol_Ckey) {
            return $result;
        } else {
            $condicionRol = " WHERE Rol_Ckey = '$iRol_Ckey' ";

            $Rol = $this->getIdRolCondicion($condicionRol);

            if (is_array($Rol) && $Rol["Rol_IdRol"] > 0) {
                $rowCount = $this->replaceRolUsuario($result[0], $Rol["Rol_IdRol"]);

                if ($rowCount > 0) {
                    return $result;
                } else {
                    return $rowCount;
                }
            } else {
                return $Rol;
            }
        }

    }
    //Util_Rol Jhon Martinez
    public function getIdRolCondicion($Condicion = "")
    {
        try {
            $rol = $this->_db->query(" SELECT Rol_IdRol FROM rol $Condicion ");
            return $rol->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(usuarioModel)", "getIdRolCondicion", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    public function editarUsuario($iUsu_Nombre, $iUsu_Apellidos, $iUsu_DocumentoIdentidad, $iUsu_Direccion, $iUsu_Telefono, $iUsu_InstitucionLaboral, $iUsu_Cargo, $iUsu_Email, $iUsu_IdUsuario)
    {
        try {
            $sql    = "call s_u_usuario(?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iUsu_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iUsu_Apellidos, PDO::PARAM_STR);
            $result->bindParam(3, $iUsu_DocumentoIdentidad, PDO::PARAM_INT);
            $result->bindParam(4, $iUsu_Direccion, PDO::PARAM_STR);
            $result->bindParam(5, $iUsu_Telefono, PDO::PARAM_STR);
            $result->bindParam(6, $iUsu_InstitucionLaboral, PDO::PARAM_STR);
            $result->bindParam(7, $iUsu_Cargo, PDO::PARAM_STR);
//            $result->bindParam(8, $iUsu_Usuario, PDO::PARAM_STR);
            //            $result->bindParam(9, $iUsu_Password, PDO::PARAM_STR);
            $result->bindParam(8, $iUsu_Email, PDO::PARAM_STR);
            // $result->bindParam(9, $iRol_IdRol, PDO::PARAM_INT);
            //            $result->bindParam(12, $iUsu_Fecha, PDO::PARAM_STR);
            //            $result->bindParam(12, $iUsu_Estado, PDO::PARAM_INT);
            //$result->bindParam(13, $iUsu_Codigo, PDO::PARAM_STR);
            $result->bindParam(9, $iUsu_IdUsuario, PDO::PARAM_INT);

            $result->execute();
            return $result->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "editarUsuario", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function editarUsuarioClave($Usu_Password, $Usu_IdUsuario)
    {
        $Usu_Password = Hash::getHash('sha1', $Usu_Password, HASH_KEY);
        try {
            $result = $this->_db->query(
                "update usuario set Usu_Password = '$Usu_Password' " .
                "where Usu_IdUsuario = $Usu_IdUsuario "
            );
            return $result->rowCount();
        } catch (PDOException $exception) {
            $this->registrarBitacora("usuario(indexModel)", "editarUsuarioClave", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function cambiarEstadoUsuario($idUsuario, $estado)
    {
        if ($estado == 0) {
            $usuarios = $this->_db->query(
                "UPDATE usuario SET Usu_Estado = 1 where Usu_IdUsuario = $idUsuario"
            );
        }
        if ($estado == 1) {
            $usuarios = $this->_db->query(
                "UPDATE usuario SET Usu_Estado = 0 where Usu_IdUsuario = $idUsuario"
            );
        }
        if ($estado == 3) {
            $usuarios = $this->_db->query(
                "UPDATE usuario SET Usu_Estado = 1 where Usu_IdUsuario = $idUsuario"
            );
        }
        return $usuarios->rowCount(PDO::FETCH_ASSOC);
    }

    public function recuperarPass($idUsuario, $estadoLink)
    {
        $usuarios = $this->_db->query(
            "UPDATE usuario SET Usu_RecuperarPass = $estadoLink where Usu_IdUsuario = $idUsuario"
        );
        return $usuarios->rowCount(PDO::FETCH_ASSOC);
    }

    public function getUsuario1($id, $codigo)
    {
        $usuario = $this->_db->query(
            "select * from usuario where Usu_IdUsuario = $id and Usu_Codigo = '$codigo'"
        );
        return $usuario->fetch();
    }

    public function insertarRol($iRol_role, $iIdi_IdIdioma = "", $iRol_Estado = 1)
    {
        try {
            $sql    = "call s_i_rol(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iRol_role, PDO::PARAM_STR);
            $result->bindParam(2, empty($iIdi_IdIdioma) ? null : $iIdi_IdIdioma, PDO::PARAM_NULL | PDO::PARAM_STR);
            $result->bindParam(3, $iRol_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    public function activarUsuario($id, $codigo)
    {
        $this->_db->query(
            "update usuario set Usu_Estado = 1 " .
            "where Usu_IdUsuario = $id and Usu_Codigo = '$codigo'"
        );
    }
}
