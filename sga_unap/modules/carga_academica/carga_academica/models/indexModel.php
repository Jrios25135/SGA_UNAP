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
            $this->registrarBitacora("acl(indexModel)", "getPermisos", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }
    
    //Util_Permiso Jhon Martinez
    public function getPermisosRowCount($condicion = "")
    {
        try{
            $sql = " SELECT COUNT(p.Per_IdPermiso) AS CantidadRegistros FROM permisos p LEFT JOIN modulo m ON p.Mod_IdModulo = m.Mod_IdModulo  $condicion ";
            $result = $this->_db->prepare($sql);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getPermisosRowCount", "Error Model", $exception);
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

/*---------------------------------CODIGO INSERTADO POR JOSE RIOS PIINEDO-----------------------------------------*/
  /*     public function getFacultades( $condicion = "")
    {
        try{
            $permiso = $this->_db->query(
                "SELECT f.* FROM facultad f $condicion"               
                );
            return $permiso->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }*/

   public function getEscuelas($condicion='')
   {
        try{
            $permiso = $this->_db->query( 
               "SELECT e.* FROM escuela e".$condicion            
                );
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
 
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCurriculas($condicion='')
    {
        try{
            $permiso = $this->_db->query(   
               "SELECT * FROM curricula".$condicion            
                );
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
 
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCicloCurricula($condicion=''){        
        try{
            // $permiso = $this->_db->query("SELECT ciu.Ciu_IdCicloCurricula ,cic.Cic_Nombre FROM ciclo cic INNER JOIN ciclo_curricula ciu ON cic.Cic_IdCiclo = ciu.Cic_IdCiclo INNER JOIN curricula cur ON ciu.Cui_IdCurricula = cur.Cui_IdCurricula".$condicion);
            $permiso = $this->_db->query("SELECT ciu.Ciu_IdCicloCurricula ,cic.Cic_Nombre FROM ciclo cic INNER JOIN ciclo_curricula ciu ON cic.Cic_IdCiclo = ciu.Cic_IdCiclo INNER JOIN curricula cur ON ciu.Cui_IdCurricula = cur.Cui_IdCurricula WHERE ciu.Cui_IdCurricula =".$condicion);
              // WHERE ciu.Cui_IdCurricula".$condicion);
                //.$condicion);
                   /*"SELECT ciu.* FROM ciclo_curricula ciu".$condicion );*/          
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCur_Requisito($condicion=''){        
        try{
            // $permiso = $this->_db->query("SELECT ciu.Ciu_IdCicloCurricula ,cic.Cic_Nombre FROM ciclo cic INNER JOIN ciclo_curricula ciu ON cic.Cic_IdCiclo = ciu.Cic_IdCiclo INNER JOIN curricula cur ON ciu.Cui_IdCurricula = cur.Cui_IdCurricula".$condicion);
            $permiso = $this->_db->query("SELECT cur.Cur_IdCurso,cur.Cur_Nombre,cur.Cur_Codigo FROM curso cur INNER JOIN ciclo_curricula ciu ON cur.Ciu_IdCicloCurricula = ciu.Ciu_IdCicloCurricula WHERE ciu.Cui_IdCurricula =".$condicion);
              // WHERE ciu.Cui_IdCurricula".$condicion);
                //.$condicion);
                   /*"SELECT ciu.* FROM ciclo_curricula ciu".$condicion );*/          
            return $permiso->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getRolesCompleto", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


      public function insertarciclo( $iCic_IdCiclo,
                                     $iCic_Nombre,
                                     $iCic_Numero,
                                     $iCic_Estado,
                                     $iRow_Estado)
    {
        try {            
            $sql = "call s_i_ciclo(?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCic_IdCiclo, PDO::PARAM_INT);
            $result->bindParam(2, $iCic_Nombre,  PDO::PARAM_STR);
            $result->bindParam(3, $iCic_Numero,  PDO::PARAM_INT);
            $result->bindParam(4, $iCur_Estado,  PDO::PARAM_INT);
            $result->bindParam(5, $iRow_Estado, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertarCurso($iCur_Nombre,
                                $iCur_Codigo,
                                $iCur_Creditos,
                                $iCur_HorasTeoria,
                                $iCur_HorasPractica,
                                $iCur_Semanas,
                                $iCur_Tipo,
                                $iCiu_IdCicloCurricula,
                                $iCur_Estado,
                                $iRow_Estado)
    {
        try {            
            $sql = "call s_i_curso(?,?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCur_Nombre, PDO::PARAM_STR);
            $result->bindParam(2, $iCur_Codigo,PDO::PARAM_STR);
            $result->bindParam(3, $iCur_Creditos, PDO::PARAM_INT);
            $result->bindParam(4, $iCur_HorasTeoria, PDO::PARAM_INT);
            $result->bindParam(5, $iCur_HorasPractica, PDO::PARAM_INT);
            $result->bindParam(6, $iCur_Semanas, PDO::PARAM_INT);
            $result->bindParam(7, $iCur_Tipo,PDO::PARAM_STR);
            $result->bindParam(8, $iCiu_IdCicloCurricula, PDO::PARAM_INT);
            $result->bindParam(9, $iCur_Estado, PDO::PARAM_INT);
            $result->bindParam(10,$iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function insertarCursoRequisito($iCur_IdCursoPrincipal,$iCur_IdRequisito)
    {
        //echo " iCur_IdCursoPrincipal:" . $iCur_IdCursoPrincipal ." iCur_IdRequisito:". $iCur_IdRequisito;
        try {             
            $sql = "call s_i_curso_requisito(?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCur_IdCursoPrincipal, PDO::PARAM_INT);
            $result->bindParam(2, $iCur_IdRequisito, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "insertarCursoRequisito", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }




    public function getCurso($Cur_IdCurso)
    {
        try{
            $Cur_IdCurso = (int) $Cur_IdCurso;        
            $cur = $this->_db->query("SELECT * FROM curso WHERE Cur_IdCurso = {$Cur_IdCurso}");
            return $cur->fetch();
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCurso", "Error Model", $exception);
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
                             $iCur_Estado,
                             $iRow_Estado) 
    {
        try{
            $sql = "call s_u_cambiar_curso(?,?,?,?,?,?,?,?,?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $iCur_IdCurso, PDO::PARAM_INT);
            $result->bindParam(2, $iCur_Nombre, PDO::PARAM_STR);
            $result->bindParam(3, $iCur_Codigo,PDO::PARAM_STR);
            $result->bindParam(4, $iCur_Creditos, PDO::PARAM_INT);
            $result->bindParam(5, $iCur_HorasTeoria, PDO::PARAM_INT);
            $result->bindParam(6, $iCur_HorasPractica, PDO::PARAM_INT);
            $result->bindParam(7, $iCur_Semanas, PDO::PARAM_INT);
            $result->bindParam(8, $iCur_Tipo,PDO::PARAM_STR);
            $result->bindParam(9, $iCiu_IdCicloCurricula, PDO::PARAM_INT);
            $result->bindParam(10, $iCur_Estado, PDO::PARAM_INT);
            $result->bindParam(11,$iRow_Estado, PDO::PARAM_INT);
            $result->execute();

            return $result->rowCount(PDO::FETCH_ASSOC);  
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "editarCurso", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }


    public function getCursoPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try{
            $sql = "call s_s_listar_curso(?,?,?)";
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
      public function getCicloPaginado($pagina = 1, $registrosXPagina = 1, $activos = 1)
    {
        try{
            $sql = "call s_s_listar_ciclo(?,?,?)";
            $result = $this->_db->prepare($sql);
            $result->bindParam(1, $pagina, PDO::PARAM_INT);
            $result->bindParam(2, $registrosXPagina, PDO::PARAM_INT);
            $result->bindParam(3, $activos, PDO::PARAM_INT);
            $result->execute();
        return $roles->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->registrarBitacora("acl(indexModel)", "getCursoPaginado", "Error Model", $exception);
            return $exception->getTraceAsString();
        }
    }

    public function getCursoCondicion($pagina, $registrosXPagina, $condicion = "")
    {
        try{
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

    public function getCursoRowCount($condicion = "")
    {
        try{
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

 











/*---------------------------------------------------------------------------------------------*////


  
    //Util_Rol Jhon Martinez
   
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
}

?>
