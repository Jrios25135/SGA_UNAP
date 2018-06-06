<?php

class indexController extends silabosController
{
    private $_aclm;
    
    public function __construct($lang,$url) 
    {
        parent::__construct($lang,$url);
        $this->_aclm = $this->loadModel('index');        
    }
    
    public function index()
    {       
        $this->_acl->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->assign('titulo', 'Listas de acceso');

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        
        $paginador = new Paginador();
        
        $condicion = " WHERE Cur_IdCurso = 1";
        $cursos = $this->_aclm->listar_carga_por_id_curso();
        $paginador->paginar( $totalRegistros,"listarRoles", "", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('cursos', $cursos);
        $this->_view->renderizar('index');
    }

    /*silabos*/
    //Modificado por Jhon Martinez
    public function silabos()
    {
        // echo $id ." ////// ". $nombre;
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        $this->_view->setJs(array('index'));
        // $this->_view->setCss(array('base','layout'));

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        $usuario= Session::get('id_usuario');

        /*        
        if ($this->botonPress("bt_guardarFacultad")) 
        {
              $this->nuevo_facultad();                
        }
        */

        //Filtro por Activos/Eliminados
        $condicion = " ORDER BY s.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE s.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount = $this->_aclm->getSilabosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador = new Paginador();
        $formulario = "Silabos";
        $this->_view->assign('listaDatos', $this->_aclm->getSilabosPaginado($pagina,CANT_REG_PAG,$soloActivos));

        $paginador->paginar( $totalRegistros,"listar" . $formulario, "", $pagina, CANT_REG_PAG, true);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('usuario', $usuario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de silabos');
        $this->_view->renderizar($formulario);
    }    
    
    //Modificado por Jhon Martinez
    public function _buscarSilabos() 
    {        
        //Variables de Ajax_JavaScript
        $txtBuscar = $this->getSql('palabra');
        $formulario = $this->getSql('formulario');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');

        // Para Busqueda
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE c.Cur_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND s.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY s.Row_Estado DESC ";
            }
            
        } else {
            $condicion = " ORDER BY s.Row_Estado DESC ";
            //Filtro por Activos/Eliminados  
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE s.Row_Estado = $soloActivos  ";
            }
        }  

        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getSilabosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar'.$formulario; 
        $paginador->paginar($totalRegistros, $nombreLista, "$txtBuscar", $pagina,CANT_REG_PAG, true);

        $usuario= Session::get('id_usuario');
        $this->_view->assign('usuario', $usuario);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_aclm->getSilabosCondicion($pagina,CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _paginacion_listarSilabos($txtBuscar = false) 
    {
        //$this->validarUrlIdioma();
        // $pagina = $this->getInt('pagina');
        //$registros = $this->getInt('registros');

        // $nombre = $this->getSql('nombre');
        // if ($nombre) {
        //     $condicion .= " where Fac_Nombre liKe '%$nombre%' ";
        // }

        //Variables de Ajax_JavaScript
        $pagina = $this->getInt('pagina');
        $nombreLista = $this->getSql('nombrelista');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');

        $formulario = $this->getSql('formulario');

        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE c.Cur_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND s.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY s.Row_Estado DESC ";
            }
            
        } else {
            $condicion = " ORDER BY s.Row_Estado DESC ";
            //Filtro por Activos/Eliminados  
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE s.Row_Estado = $soloActivos  ";
            }
        }  

        $paginador = new Paginador();

        // $this->_view->assign('silabos', $paginador->paginar($this->_aclm->getsilabos($condicion), "listarsilabos", "$nombre", $pagina, 25));

        $paginador->paginar( $totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);
        $usuario= Session::get('id_usuario');
        $this->_view->assign('usuario', $usuario);
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_aclm->getSilabosCondicion($pagina,$filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/' . $nombreLista, false, true);
    }
    //Modificado por Jhon Martinez
    public function _cambiarEstadoSilabos()
    {
        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje = "error";
        $contenido = "";
        //Variables de Ajax_JavaScript
        $txtBuscar = $this->getSql('palabra');
        $formulario = $this->getSql('formulario');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $IdRegistro = $this->getInt('_IdRegistro');
        $EstadoRegistro = $this->getInt('_EstadoRegistro');
        
        if(!$IdRegistro){            
            $this->_view->assign('_error', 'Error parametro ID ..!!');  
            $this->_view->renderizar('index');
            exit;          
        } else {
            //Actualizacion de estado en la BD
            // echo $IdRegistro.$EstadoRegistro;exit;
            $rowCountEstado = $this->_aclm->cambiarEstadoSilabo($IdRegistro, $EstadoRegistro);
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
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE c.Cur_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND s.Row_Estado = $soloActivos ";
            }
            
        } else {
            //Filtro por Activos/Eliminados     
            $condicion = " ORDER BY s.Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE s.Row_Estado = $soloActivos  ";
            }
        }  


        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getSilabosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        // echo($totalRegistros);
        // print_r($arrayRowCount); echo($condicion);exit;

        $nombreLista = 'listar'.$formulario; 
        $paginador->paginar( $totalRegistros,$nombreLista, "$txtBuscar", $pagina, $filas, true);
        $usuario= Session::get('id_usuario');

        $this->_view->assign('listaDatos', $this->_aclm->getSilabosCondicion($pagina,$filas, $condicion));
        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('usuario', $usuario);
        $this->_view->renderizar('ajax/listar' . $formulario, false, true);
    }   

    public function _eliminarSilabos(){
        //Variables Ajax_Javascript
        $IdRegistro = $this->getInt('_IdRegistro');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar = $this->getSql('palabra');
        $formulario = $this->getSql('formulario');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');       
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if(!$IdRegistro)
            {            
                $contenido = 'Error parametro ID ..!!'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));          
            } else {
                $relacion = $this->_indexModel->getEscuelaFacultad($IdRegistro);
                // print_r($facultade);
                if ($relacion <= 0)
                {                   
                    $rowCount = $this->_indexModel->eliminarHabilitarFacultad($IdRegistro,$Row_Estado);
                    // echo $rowCount3;//exit;
                    if($rowCount && $rowCount > 0)
                    {
                        $contenido = 'La Facultad fue eliminado correctamente...!!!'; 
                        $mensaje = "ok";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido));  
                    } else {
                        $contenido = 'No se pudo eliminar Facultad, error de consulta...!!!'; 
                        $mensaje = "error";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                    }
                    
                } else {
                    $contenido = 'No se pudo eliminar Facultad asignado a escuela...!!!'; 
                    $mensaje = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                }  
                // echo $error;exit;        
            }
        } else {
            $rowCount = $this->_indexModel->eliminarHabilitarFacultad($IdRegistro,$Row_Estado);          
            
            if($rowCount && $rowCount > 0)
            {
                $contenido = 'La Facultad fue activado correctamente...!!!'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar Facultad, error en consulta...!!! id='.$IdRegistro."/".$Row_Estado; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }

        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        // Para la busqueda
        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
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
                $condicion = " WHERE f.Row_Estado = $soloActivos  ";
            }
        }  
        // Para la busqueda

        $paginador = new Paginador();

        $arrayRowCount = $this->_indexModel->getSilabosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $nombreLista = 'listar'.$formulario; 
        $paginador->paginar( $totalRegistros, $nombreLista, "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('formulario', $formulario);
        $this->_view->assign('listaDatos', $this->_indexModel->getSilabosCondicion($pagina,$filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/'.$nombreLista, false, true);
    }
    //Mi código XD

    public function verSilabo($dato)
    {       
        $this->_acl->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->assign('titulo', 'Listas de acceso');

        $condicion = " WHERE Cur_IdCurso = 1";
        $silabo = $this->_aclm->detallar_silabo($dato);
        $comp = $this->_aclm->listar_competencia_por_id_silabo($dato);
        $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$dato." AND co.Com_Nro=1");
        $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$dato." AND co.Com_Nro=2");
        $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$dato." AND co.Com_Nro=3");
        $proc = $this->_aclm->listar_proc_silabo("WHERE co.Sil_IdSilabo=".$dato);
        $act1 = $this->_aclm->listar_semana_actitud($dato,"actitud1");
        $act2 = $this->_aclm->listar_semana_actitud($dato,"actitud2");
        $act3 = $this->_aclm->listar_semana_actitud($dato,"actitud3");
        $capsem = $this->_aclm->listar_semana_capacidad($dato);

        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('silabo', $silabo);
        $this->_view->assign('comp', $comp);
        $this->_view->assign('cap1', $cap1);
        $this->_view->assign('cap2', $cap2[0]);
        $this->_view->assign('cap3', $cap3[0]);
        $this->_view->assign('caps2', $cap2);
        $this->_view->assign('caps3', $cap3);
        $this->_view->assign('proc', $proc);
        $this->_view->assign('act1', $act1);
        $this->_view->assign('act2', $act2);
        $this->_view->assign('act3', $act3);
        $this->_view->assign('capsem', $capsem);
        $this->_view->renderizar('ver_silabos');
    }

    public function registrarSilabo($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->assign('titulo', 'Listas de acceso');

        $nombre = $this->getSql('nombre');        
        
        $condicion = "ca.Caa_IdCargaAcademica=".$id;
        $cursos = $this->_aclm->detallar_curso();

        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('cursos', $cursos);

        if($this->botonPress('enviar')){

            $this->_aclm->registrar_silabo(
                $this->getSql('competencia_general'),
                $this->getSql('sumilla'),
                $this->getSql('act1'),
                $this->getSql('act2'),
                $this->getSql('act3'), 
                '24-05-2018',
                $id
                );

            $silabo_id=$this->_aclm->listar_ultimo_silabo();
            $this->_aclm->registrar_silabo_comp($this->getSql('cap1'),$silabo_id['Sil_IdSilabo'],'1');
            $this->_aclm->registrar_silabo_comp($this->getSql('cap2'),$silabo_id['Sil_IdSilabo'],'2');
            $this->_aclm->registrar_silabo_comp($this->getSql('cap3'),$silabo_id['Sil_IdSilabo'],'3');

            $id=$silabo_id['Sil_IdSilabo'];

            $this->_view->setJs(array('modal'));
                $this->_view->assign('mensaje', 'Se ha registrado correctamente la primera parte del silabo');
             
            $this->redireccionar("silabos/index/registrarSilabo2/".$id);
        }        
        $this->_view->renderizar('agregar_silabos');
    }


    public function registrarSilabo2($id)
    {       
        // //$this->_aclm->autenticado();
        // $this->validarUrlIdioma();
        // $this->_view->getLenguaje("index_inicio");
        // //$this->_view->assign('titulo', 'Listas de acceso');

        // $comp = $this->_aclm->listar_competencia_por_id_silabo($id);
        // $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
        // $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=2");
        // $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=3");

        // $this->_view->assign('cap1', $cap1);
        // $this->_view->assign('cap2', $cap2);
        // $this->_view->assign('cap3', $cap3);
        // $this->_view->assign('titulo', 'Administración de roles');
        // $this->_view->assign('compe', $comp);

        // if($this->botonPress('guardar')){ 

        //     $id2=$this->getInt('compete');

        //     $compCont =$this->_aclm->listar_cap_comp("WHERE co.Com_IdCompetencias=".$id2." AND (co.Com_Nro=2 OR co.Com_Nro=3)");   

        //     if(count($compCont)!=0){
                
        //     }       

        //     else{
        //     $this->_aclm->registrar_silabo2(
        //         $this->getSql('cap'),
        //         $this->getInt('compete')
        //         );

        //     $this->redireccionar('silabos/index/registrarSilabo2/'.$id);
        //     }
        // }   

        // if($this->botonPress('enviar')){

        //     $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
        //     $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=2");
        //     $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=3");

        //     if(count($cap1)==0 || count($cap2)==0 || count($cap3)==0){

        //     }
            
        //     else{
        //         $this->redireccionar('silabos/index/registrarSilabo3/'.$id);
        //     }
        // }          
        // $this->_view->renderizar('agregar_silabos2');

         $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        //$this->_view->assign('titulo', 'Listas de acceso');

        $this->_view->setJs(array('modal'));
        $this->_view->assign('mensaje', 'Se ha registrado correctamente la primera parte del sílabo');
        
        $comp = $this->_aclm->listar_competencia_por_id_silabo($id);
        $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
        $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=2");
        $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=3");
        //$paginador->paginar( $totalRegistros,"listarRoles", "", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('comp', $comp);
        $this->_view->assign('cap1', $cap1);
        $this->_view->assign('cap2', $cap2);
        $this->_view->assign('cap3', $cap3);

        if($this->botonPress('guardar')){ 

            $id2=$this->getInt('compete');

            $compCont =$this->_aclm->listar_cap_comp("WHERE co.Com_IdCompetencias=".$id2." AND (co.Com_Nro=2 OR co.Com_Nro=3)");   

            if(count($compCont)!=0){
                
            }       

            else{
            $this->_aclm->registrar_silabo2(
                $this->getSql('cap'),
                $this->getInt('compete')
                );

            $this->redireccionar('silabos/index/editarSilabo2/'.$id);
            }
        }    

        if($this->botonPress('editar')){
            
            $this->_aclm->actualizar_capacidad(
                $this->getSql('idcap'),
                $this->getSql('texto_editar')
                );
            
            $this->redireccionar('silabos/index/registrarSilabo2/'.$id);
        }

        if($this->botonPress('eliminar')){
            
            $this->_aclm->eliminar_capacidades(
                $this->getSql('idcap')
                );
            
            $this->redireccionar('silabos/index/registrarSilabo2/'.$id);
        }  

        if($this->botonPress('enviar')){

            $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
            $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=2");
            $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=3");

            if(count($cap1)==0 || count($cap2)==0 || count($cap3)==0){

            }
            
            else{
                $this->redireccionar('silabos/index/registrarSilabo3/'.$id);
            }
        }          
        $this->_view->renderizar('editar_silabos2');
    }

    public function registrarSilabo3($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        //$this->_view->assign('titulo', 'Listas de acceso');

        $nombre = $this->getSql('nombre');
        
        $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
        $cont=0;
        $capS=array();
        for ($i=0; $i < count($cap); $i++) { 
            if(empty($this->_aclm->listar_existe_cap_proceso_id_cap($cap[$i]["Cap_IdCapacidades"])))
            {
                $capS[$cont]=$cap[$i];
                $cont++;
            }

        }

        $array=array(
                                "Cap_IdCapacidades"=>"",
                                "Pra_Contenidos"=>"",
                                "Pra_Estrategias"=>"",
                                "Pra_Indicadores"=>"",
                                "Pra_Proc_escrito"=>null,
                                "Pra_Proc_oral"=>null,
                                "Pra_Proc_observacion"=>null,
                                "Pra_Proc_otros"=>null,
                                "Pra_Inst_cuestionario"=>null,
                                "Pra_Inst_rubrica"=>null,
                                "Pra_Inst_ficha"=>null,
                                "Pra_Inst_otros"=>null,
                                "Pra_Pond_Conceptual"=>"",
                                "Pra_Pond_Procedimental"=>"",
                                "Pra_Pond_Investigacion"=>"",
                                "Pra_Pond_Actitudinal"=>"");

                            $this->_view->assign('proceso', $array);

        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('cont', $cont);
        $this->_view->assign('cap', $capS);

        if($this->botonPress('guardar')){
            
            
            // $this->_aclm->registrar_silabo3(
            //     $this->getInt('capa'),
            //     $this->getSql('contenidos'),
            //     $this->getSql('estra'),
            //     $this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
            //     $this->getSql('proescrito'),
            //     $this->getSql('prooral'),
            //     $this->getSql('proobservacion'),
            //     $this->getSql('prootros'),
            //     $this->getSql('instrcuestionario'),
            //     $this->getSql('instrrubrica'),
            //     $this->getSql('instrobservacion'),
            //     $this->getSql('instrotros'),
            //     $this->getSql('ponc'),
            //     $this->getSql('ponp'),
            //     $this->getSql('poni'),
            //     $this->getSql('pona')
            //     );

            // // for(){
            // //     $this->_aclm->listar_cap_id_comp($comp["Com_IdCompetencias"]);
            // // }
            
            // $this->redireccionar('silabos/index/registrarSilabo3/'.$id);

            if(($this->getSql('proescrito'))!==null ||
               ($this->getSql('prooral'))!==null ||
               ($this->getSql('proobservacion'))!==null ||
               ($this->getSql('prootros'))!==null){

                if(($this->getSql('instrcuestionario'))!==null ||
                   ($this->getSql('instrrubrica'))!==null ||
                   ($this->getSql('instrobservacion'))!==null ||
                   ($this->getSql('instrotros'))!==null)

                {
                    if((($this->getInt('ponc'))+($this->getInt('ponp'))+($this->getInt('poni')) +($this->getInt('pona')))==100)

                    {$this->_aclm->registrar_silabo3(
                                $this->getInt('capa'),
                                $this->getSql('contenidos'),
                                $this->getSql('estra'),
                                $this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                $this->getSql('proescrito'),
                                $this->getSql('prooral'),
                                $this->getSql('proobservacion'),
                                $this->getSql('prootros'),
                                $this->getSql('instrcuestionario'),
                                $this->getSql('instrrubrica'),
                                $this->getSql('instrobservacion'),
                                $this->getSql('instrotros'),
                                $this->getInt('ponc'),
                                $this->getInt('ponp'),
                                $this->getInt('poni'),
                                $this->getInt('pona'));
                                                            
                    $this->redireccionar('silabos/index/registrarSilabo3/'.$id);
                    }

                    else{
                            $array=array(
                                "Cap_IdCapacidades"=>$this->getInt('capa'),
                                "Pra_Contenidos"=>$this->getSql('contenidos'),
                                "Pra_Estrategias"=>$this->getSql('estra'),
                                "Pra_Indicadores"=>$this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                "Pra_Proc_escrito"=>$this->getSql('proescrito'),
                                "Pra_Proc_oral"=>$this->getSql('prooral'),
                                "Pra_Proc_observacion"=>$this->getSql('proobservacion'),
                                "Pra_Proc_otros"=>$this->getSql('prootros'),
                                "Pra_Inst_cuestionario"=>$this->getSql('instrcuestionario'),
                                "Pra_Inst_rubrica"=>$this->getSql('instrrubrica'),
                                "Pra_Inst_ficha"=>$this->getSql('instrobservacion'),
                                "Pra_Inst_otros"=>$this->getSql('instrotros'),
                                "Pra_Pond_Conceptual"=>"",
                                "Pra_Pond_Procedimental"=>"",
                                "Pra_Pond_Investigacion"=>"",
                                "Pra_Pond_Actitudinal"=>"");

                            $this->_view->assign('proceso', $array);
                            $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
                            $this->_view->assign('cap', $cap);
                    }
                }

                else{
                    $array=array(
                                "Cap_IdCapacidades"=>$this->getInt('capa'),
                                "Pra_Contenidos"=>$this->getSql('contenidos'),
                                "Pra_Estrategias"=>$this->getSql('estra'),
                                "Pra_Indicadores"=>$this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                "Pra_Proc_escrito"=>$this->getSql('proescrito'),
                                "Pra_Proc_oral"=>$this->getSql('prooral'),
                                "Pra_Proc_observacion"=>$this->getSql('proobservacion'),
                                "Pra_Proc_otros"=>$this->getSql('prootros'),
                                "Pra_Inst_cuestionario"=>$this->getSql('instrcuestionario'),
                                "Pra_Inst_rubrica"=>$this->getSql('instrrubrica'),
                                "Pra_Inst_ficha"=>$this->getSql('instrobservacion'),
                                "Pra_Inst_otros"=>$this->getSql('instrotros'),
                                "Pra_Pond_Conceptual"=>$this->getSql('ponc'),
                                "Pra_Pond_Procedimental"=>$this->getSql('ponp'),
                                "Pra_Pond_Investigacion"=>$this->getSql('poni'),
                                "Pra_Pond_Actitudinal"=>$this->getSql('pona'));
                                

                            $this->_view->assign('proceso', $array);
                            $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
                            $this->_view->assign('cap', $cap);
                }
            }
            else{
                    $array=array(
                                "Cap_IdCapacidades"=>$this->getInt('capa'),
                                "Pra_Contenidos"=>$this->getSql('contenidos'),
                                "Pra_Estrategias"=>$this->getSql('estra'),
                                "Pra_Indicadores"=>$this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                "Pra_Proc_escrito"=>$this->getSql('proescrito'),
                                "Pra_Proc_oral"=>$this->getSql('prooral'),
                                "Pra_Proc_observacion"=>$this->getSql('proobservacion'),
                                "Pra_Proc_otros"=>$this->getSql('prootros'),
                                "Pra_Inst_cuestionario"=>$this->getSql('instrcuestionario'),
                                "Pra_Inst_rubrica"=>$this->getSql('instrrubrica'),
                                "Pra_Inst_ficha"=>$this->getSql('instrobservacion'),
                                "Pra_Inst_otros"=>$this->getSql('instrotros'),
                                "Pra_Pond_Conceptual"=>$this->getSql('ponc'),
                                "Pra_Pond_Procedimental"=>$this->getSql('ponp'),
                                "Pra_Pond_Investigacion"=>$this->getSql('poni'),
                                "Pra_Pond_Actitudinal"=>$this->getSql('pona'));

                            $this->_view->assign('proceso', $array);
                            $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
                            $this->_view->assign('cap', $cap);
                }
        }   

        if($this->botonPress('enviar')){
            
            $this->redireccionar('silabos/index/registrarSilabo4/'.$id);
        }          
        $this->_view->renderizar('agregar_silabos3');
    }


    public function registrarSilabo4($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        //$this->_view->assign('titulo', 'Listas de acceso');

        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        
        $paginador = new Paginador();
        
        $sil = $this->_aclm->obtener_silabo($id);
        $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id);
        
        //$paginador->paginar( $totalRegistros,"listarRoles", "", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('sil', $sil);
        $this->_view->assign('cap', $cap);

        if($this->botonPress('enviar')){

            $this->_aclm->eliminar_actitudes_semanas($id);
            $this->_aclm->eliminar_capacidades_semanas($id);

            for($j=0;$j<4;$j++){
             for ($i=0;$i<18;$i++){
                    $variable = 'ct'.$j.'semana'.$i;
                    if(null !==$this->getSql($variable )){
                        $variable = $this->getSql($variable );

                        $this->_aclm->registrar_actitud_semana('actitud'.$j,$variable,$id);
                    }
                }
            }

            for ($j=0;$j<count($cap);$j++){
            for ($i=0;$i<18;$i++){
                $variable = 'ct'.($j+4).'semana'.$i;
                if(null !==$this->getSql($variable )){
                    $variable = $this->getSql($variable );

                        $this->_aclm->registrar_capa_semana($variable,$cap[$j]['Cap_IdCapacidades']);
                }
            }
        }
            
            $this->redireccionar('silabos/index/registrarSilabo5/'.$id);
        }          
        $this->_view->renderizar('agregar_silabos4');
    }


    public function registrarSilabo5($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        if($this->botonPress('enviar')){

            $tipo_doc=$_FILES['img']['type'];
            if($tipo_doc!=="image/jpg" && $tipo_doc!=="image/jpeg" && $tipo_doc!=="image/png"){
                echo ("<script type='text/javascript'>");
                echo ("parent.alert('Formato de Archivo Incorrecto. Solo se admiten png, jpg o jgep. Vuelva a Intentarlo' );");
                echo ("parent.location.href='agregar_silabos4.php';");
                echo ("</script>");
            }else{
                $carpeta = "modules/silabos/views/index/images/";
                opendir($carpeta);
                $destino = $carpeta.$_FILES["img"]["name"];
                copy($_FILES["img"]["tmp_name"],$destino);
                $this->_aclm->registrar_silabo5($id,$this->getSql('bib'),$this->getSql('calif'),$destino);
            }

            $this->redireccionar('silabos/index/silabos');
        }          
        $this->_view->renderizar('agregar_silabos5');
    }


    public function editarSilabo($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->assign('titulo', 'Listas de acceso');
        
        $silabo = $this->_aclm->obtener_datos_silabo($id);
        $comp = $this->_aclm->listar_competencia_por_id_silabo($id);

        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('silabo', $silabo);
        $this->_view->assign('comp', $comp);

        if($this->botonPress('enviar')){

            $this->_aclm->actualizar_silabo($id,
                $this->getSql('competencia_general'),
                $this->getSql('sumilla'),
                $this->getSql('act1'),
                $this->getSql('act2'),
                $this->getSql('act3'), 
                '24-05-2018'                
                );

            $this->_aclm->actualizar_silabo_comp($this->getSql('cap1'),"WHERE Sil_IdSilabo=".$id." AND Com_Nro=1");
            $this->_aclm->actualizar_silabo_comp($this->getSql('cap2'),"WHERE Sil_IdSilabo=".$id." AND Com_Nro=2");
            $this->_aclm->actualizar_silabo_comp($this->getSql('cap3'),"WHERE Sil_IdSilabo=".$id." AND Com_Nro=3");
            
            $this->redireccionar("silabos/index/editarSilabo2/".$id);
        }        
        $this->_view->renderizar('editar_silabos');
    }


    public function editarSilabo2($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        //$this->_view->assign('titulo', 'Listas de acceso');
        
        $comp = $this->_aclm->listar_competencia_por_id_silabo($id);
        $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
        $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=2");
        $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=3");
        //$paginador->paginar( $totalRegistros,"listarRoles", "", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('comp', $comp);
        $this->_view->assign('cap1', $cap1);
        $this->_view->assign('cap2', $cap2);
        $this->_view->assign('cap3', $cap3);

        if($this->botonPress('guardar')){ 

            $id2=$this->getInt('compete');

            $compCont =$this->_aclm->listar_cap_comp("WHERE co.Com_IdCompetencias=".$id2." AND (co.Com_Nro=2 OR co.Com_Nro=3)");   

            if(count($compCont)!=0){
                
            }       

            else{
            $this->_aclm->registrar_silabo2(
                $this->getSql('cap'),
                $this->getInt('compete')
                );

            $this->redireccionar('silabos/index/editarSilabo2/'.$id);
            }
        }    

        if($this->botonPress('editar')){
            
            $this->_aclm->actualizar_capacidad(
                $this->getSql('idcap'),
                $this->getSql('texto_editar')
                );
            
            $this->redireccionar('silabos/index/editarSilabo2/'.$id);
        }

        if($this->botonPress('eliminar')){
            
            $this->_aclm->eliminar_capacidades(
                $this->getSql('idcap')
                );
            
            $this->redireccionar('silabos/index/editarSilabo2/'.$id);
        }  

        if($this->botonPress('enviar')){

            $cap1 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
            $cap2 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=2");
            $cap3 = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=3");

            if(count($cap1)==0 || count($cap2)==0 || count($cap3)==0){

            }
            
            else{
                $this->redireccionar('silabos/index/editarSilabo3/'.$id);
            }
        }          
        $this->_view->renderizar('editar_silabos2');
    }


     public function editarSilabo3($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        //$this->_view->assign('titulo', 'Listas de acceso');
        
        $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
        $this->_view->assign('proceso', $this->_aclm->listar_existe_cap_proceso_id_cap($cap[0]['Cap_IdCapacidades']));
       
        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('cap', $cap);


        if($this->botonPress('guardar')){

            if(($this->getSql('proescrito'))!==null ||
               ($this->getSql('prooral'))!==null ||
               ($this->getSql('proobservacion'))!==null ||
               ($this->getSql('prootros'))!==null){

                if(($this->getSql('instrcuestionario'))!==null ||
                   ($this->getSql('instrrubrica'))!==null ||
                   ($this->getSql('instrobservacion'))!==null ||
                   ($this->getSql('instrotros'))!==null)

                {
                    if((($this->getInt('ponc'))+($this->getInt('ponp'))+($this->getInt('poni')) +($this->getInt('pona')))==100)

                    {$this->_aclm->actualizar_silabo3(
                                $this->getInt('capa'),
                                $this->getSql('contenidos'),
                                $this->getSql('estra'),
                                $this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                $this->getSql('proescrito'),
                                $this->getSql('prooral'),
                                $this->getSql('proobservacion'),
                                $this->getSql('prootros'),
                                $this->getSql('instrcuestionario'),
                                $this->getSql('instrrubrica'),
                                $this->getSql('instrobservacion'),
                                $this->getSql('instrotros'),
                                $this->getInt('ponc'),
                                $this->getInt('ponp'),
                                $this->getInt('poni'),
                                $this->getInt('pona'));
                                                            
                    $this->redireccionar('silabos/index/editarSilabo3/'.$id);
                    }

                    else{
                            $array=array(
                                "Cap_IdCapacidades"=>$this->getInt('capa'),
                                "Pra_Contenidos"=>$this->getSql('contenidos'),
                                "Pra_Estrategias"=>$this->getSql('estra'),
                                "Pra_Indicadores"=>$this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                "Pra_Proc_escrito"=>$this->getSql('proescrito'),
                                "Pra_Proc_oral"=>$this->getSql('prooral'),
                                "Pra_Proc_observacion"=>$this->getSql('proobservacion'),
                                "Pra_Proc_otros"=>$this->getSql('prootros'),
                                "Pra_Inst_cuestionario"=>$this->getSql('instrcuestionario'),
                                "Pra_Inst_rubrica"=>$this->getSql('instrrubrica'),
                                "Pra_Inst_ficha"=>$this->getSql('instrobservacion'),
                                "Pra_Inst_otros"=>$this->getSql('instrotros'),
                                "Pra_Pond_Conceptual"=>$this->getSql('ponc'),
                                "Pra_Pond_Procedimental"=>$this->getSql('ponp'),
                                "Pra_Pond_Investigacion"=>$this->getSql('poni'),
                                "Pra_Pond_Actitudinal"=>$this->getSql('pona'));

                            $this->_view->assign('proceso', $array);
                            $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
                            $this->_view->assign('cap', $cap);
                    }
                }

                else{
                    $array=array(
                                "Cap_IdCapacidades"=>$this->getInt('capa'),
                                "Pra_Contenidos"=>$this->getSql('contenidos'),
                                "Pra_Estrategias"=>$this->getSql('estra'),
                                "Pra_Indicadores"=>$this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                "Pra_Proc_escrito"=>$this->getSql('proescrito'),
                                "Pra_Proc_oral"=>$this->getSql('prooral'),
                                "Pra_Proc_observacion"=>$this->getSql('proobservacion'),
                                "Pra_Proc_otros"=>$this->getSql('prootros'),
                                "Pra_Inst_cuestionario"=>$this->getSql('instrcuestionario'),
                                "Pra_Inst_rubrica"=>$this->getSql('instrrubrica'),
                                "Pra_Inst_ficha"=>$this->getSql('instrobservacion'),
                                "Pra_Inst_otros"=>$this->getSql('instrotros'),
                                "Pra_Pond_Conceptual"=>"",
                                "Pra_Pond_Procedimental"=>"",
                                "Pra_Pond_Investigacion"=>"",
                                "Pra_Pond_Actitudinal"=>"");

                            $this->_view->assign('proceso', $array);
                            $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
                            $this->_view->assign('cap', $cap);
                }
            }
            else{
                    $array=array(
                                "Cap_IdCapacidades"=>$this->getInt('capa'),
                                "Pra_Contenidos"=>$this->getSql('contenidos'),
                                "Pra_Estrategias"=>$this->getSql('estra'),
                                "Pra_Indicadores"=>$this->getSql('indc').'/'.$this->getSql('indp').'/'.$this->getSql('inda'),
                                "Pra_Proc_escrito"=>$this->getSql('proescrito'),
                                "Pra_Proc_oral"=>$this->getSql('prooral'),
                                "Pra_Proc_observacion"=>$this->getSql('proobservacion'),
                                "Pra_Proc_otros"=>$this->getSql('prootros'),
                                "Pra_Inst_cuestionario"=>$this->getSql('instrcuestionario'),
                                "Pra_Inst_rubrica"=>$this->getSql('instrrubrica'),
                                "Pra_Inst_ficha"=>$this->getSql('instrobservacion'),
                                "Pra_Inst_otros"=>$this->getSql('instrotros'),
                                "Pra_Pond_Conceptual"=>$this->getSql('ponc'),
                                "Pra_Pond_Procedimental"=>$this->getSql('ponp'),
                                "Pra_Pond_Investigacion"=>$this->getSql('poni'),
                                "Pra_Pond_Actitudinal"=>$this->getSql('pona'));

                            $this->_view->assign('proceso', $array);
                            $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id." AND co.Com_Nro=1");
                            $this->_view->assign('cap', $cap);
                }
        }  


        if($this->botonPress('enviar')){
 
            $cont=$this->_aclm->validar_editarsilabo2("WHERE co.Sil_IdSilabo=".$id." AND pa.Pra_Contenidos=''");

            if($cont=='')
            $this->redireccionar('silabos/index/editarSilabo4/'.$id);
        }  

        $cont=$this->_aclm->validar_editarsilabo2("WHERE co.Sil_IdSilabo=".$id);

            if($cont=='')            
            $this->redireccionar('silabos/index/registrarSilabo3/'.$id);    

            else    
            $this->_view->renderizar('editar_silabos3');
    }

    public function actualizarProceso(){
        $id = $this->getInt('idcapa');
         
        $this->_view->assign('proceso', $this->_aclm->listar_existe_cap_proceso_id_cap($id));
                
        $this->_view->renderizar('ajax/Cap_IdCapacidades', false, true);
    }

    public function editarSilabo4($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        
        $sil = $this->_aclm->obtener_silabo($id);
        $cap = $this->_aclm->listar_cap_comp("WHERE co.Sil_IdSilabo=".$id);
        $act1 = $this->_aclm->listar_semana_actitud($id,"actitud1");
        $act2 = $this->_aclm->listar_semana_actitud($id,"actitud2");
        $act3 = $this->_aclm->listar_semana_actitud($id,"actitud3");
        $capsem = $this->_aclm->listar_semana_capacidad($id);

        $this->_view->assign('capsem', $capsem);
        $this->_view->assign('act1', $act1);
        $this->_view->assign('act2', $act2);
        $this->_view->assign('act3', $act3);
        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('sil', $sil);
        $this->_view->assign('cap', $cap);

        if($this->botonPress('enviar')){

            $this->_aclm->eliminar_actitudes_semanas($id);
            $this->_aclm->eliminar_capacidades_semanas($id);

            for($j=0;$j<4;$j++){
             for ($i=0;$i<18;$i++){
                    $variable = 'ct'.$j.'semana'.$i;
                    if(null !==$this->getSql($variable )){
                        $variable = $this->getSql($variable );

                        $this->_aclm->registrar_actitud_semana('actitud'.$j,$variable,$id);
                    }
                }
            }

            for ($j=0;$j<count($cap);$j++){
            for ($i=0;$i<18;$i++){
                $variable = 'ct'.($j+4).'semana'.$i;
                if(null !==$this->getSql($variable )){
                    $variable = $this->getSql($variable );

                        $this->_aclm->registrar_capa_semana($variable,$cap[$j]['Cap_IdCapacidades']);
                }
            }
        }
            
            $this->redireccionar('silabos/index/editarSilabo5/'.$id);
        }          
        $this->_view->renderizar('editar_silabos4');
    }


    public function editarSilabo5($id)
    {       
        //$this->_aclm->autenticado();
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");

        $sil = $this->_aclm->obtener_silabo($id);
        $this->_view->assign('sil', $sil);

        if($this->botonPress('enviar')){

            $tipo_doc=$_FILES['img']['type'];
            if($tipo_doc!=="image/jpg" && $tipo_doc!=="image/jpeg" && $tipo_doc!=="image/png"){
                echo ("<script type='text/javascript'>");
                echo ("parent.alert('Formato de Archivo Incorrecto. Solo se admiten png, jpg o jgep. Vuelva a Intentarlo' );");
                echo ("parent.location.href='agregar_silabos4.php';");
                echo ("</script>");
            }else{
                $carpeta = "modules/silabos/views/index/images/";
                opendir($carpeta);
                $destino = $carpeta.$_FILES["img"]["name"];
                copy($_FILES["img"]["tmp_name"],$destino);
                $this->_aclm->registrar_silabo5($id,$this->getSql('bib'),$this->getSql('calif'),$destino);
            }

            $this->redireccionar('silabos/index/silabos');
        }          
        $this->_view->renderizar('editar_silabos5');
    }

    
    /*Roles*/
    //Modificado por Jhon Martinez
    public function editarsilabono($d)
    {
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $nombre = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');
        
        $paginador = new Paginador();
        if ($this->botonPress("bt_guardarRol")) 
        {
              $this->nuevo_role();                
        }

        //Filtro por Activos/Eliminados
        $condicion = " ORDER BY r.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE r.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $arrayRowCount = $this->_aclm->getRolesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        // $this->_view->assign('roles', $paginador->paginar($this->_aclm->getRoles(), "listarRoles", "$nombre", $pagina, 25));

        $this->_view->assign('modulos', $this->_aclm->getModulos(0,0));
        $this->_view->assign('roles', $this->_aclm->getRolesPaginado($pagina,CANT_REG_PAG,$soloActivos));

        $paginador->paginar( $totalRegistros,"listarRoles", "", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->renderizar('roles');
    }    
    //Modificado por Jhon Martinez
    public function nuevo_role($usu=false)
    {
        $this->_acl->acceso('agregar_rol');
        if(!$this->getSql('nuevoRol'))
        {
            if(!$usu)
            {                
                $this->_view->assign('_error','Debe llenar el campo Rol.');
                $this->_view->renderizar('ajax/nuevo_rol', false, true);
            }
        }
        if($this->_aclm->verificarRol($this->getSql('nuevoRol')))
        {
            $this->_view->assign('_error', 'El rol <b style="font-size: 1.15em;">'.$this->getSql('nuevoRol').'</b> ya existe');
        }
        else
        {            
            $idRol = $this->_aclm->insertarRol(
                $this->getSql('nuevoRol'),'',1                
            );  
            if (is_array($idRol)) 
            {
                if ($idRol[0] > 0) 
                {
                    $this->_view->assign('_mensaje', 'Registro Completado..!!');
                } 
                else 
                {
                    $this->_view->assign('_error', 'Error al registrar la Usuario');
                }
            }
            else 
            {
               $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }
        } 

        if($usu)
        {
            $this->_view->renderizar('ajax/nuevo_rol', false, true);
        }
    }
    //Modificado por Jhon Martinez
    public function _cambiarEstadoRol()
    {
        $this->_acl->acceso('editar_rol');
        //Para Mensajes
        $resultado = array();
        $mensaje = "error";
        $contenido = "";
        //Variables de Ajax_JavaScript
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $Rol_IdRol = $this->getInt('_Rol_IdRol');
        $Rol_Estado = $this->getInt('_Rol_Estado');
        
        if(!$Rol_IdRol){            
            $this->_view->assign('_error', 'Error parametro ID ..!!');  
            $this->_view->renderizar('index');
            exit;          
        } else {
            //Actualizacion de estado en la BD
            $rowCountEstado = $this->_aclm->cambiarEstadoRol($Rol_IdRol, $Rol_Estado);
            //Mensaje de Actualizacion
            if ($rowCountEstado > 0) {
                if ($Rol_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';              
                }
                if ($Rol_Estado == 0) {
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
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE Rol_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND r.Row_Estado = $soloActivos ";
            }
            
        } else {
            //Filtro por Activos/Eliminados     
            $condicion = " ORDER BY r.Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE r.Row_Estado = $soloActivos  ";
            }
        }  

        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getRolesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        // echo($totalRegistros);
        // print_r($arrayRowCount); echo($condicion);exit;
        $this->_view->assign('roles', $this->_aclm->getRolesCondicion($pagina,$filas, $condicion));

        $paginador->paginar( $totalRegistros ,"listarRoles", "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarRoles', false, true);
    }
    //Modificado por Jhon Martinez
    public function _paginacion_listarRoles($txtBuscar = false) 
    {
        //$this->validarUrlIdioma();
        // $pagina = $this->getInt('pagina');
        //$registros = $this->getInt('registros');

        // $nombre = $this->getSql('nombre');
        // if ($nombre) {
        //     $condicion .= " where Rol_Nombre liKe '%$nombre%' ";
        // }

        //Variables de Ajax_JavaScript
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');

        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE Rol_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND r.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY r.Row_Estado DESC ";
            }
            
        } else {
            $condicion = " ORDER BY r.Row_Estado DESC ";
            //Filtro por Activos/Eliminados  
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE r.Row_Estado = $soloActivos  ";
            }
        }  

        $paginador = new Paginador();

        // $this->_view->assign('roles', $paginador->paginar($this->_aclm->getRoles($condicion), "listarRoles", "$nombre", $pagina, 25));

        $paginador->paginar( $totalRegistros,"listarRoles", "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('roles', $this->_aclm->getRolesCondicion($pagina,$filas, $condicion));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarRoles', false, true);
    }
    //Modificado por Jhon Martinez
    public function _buscarRol() 
    {
        //$this->validarUrlIdioma();
        // $nombre = $this->getSql('palabra');
        // $condicion = "";

        // if ($nombre) {
        //     $condicion .= " where Rol_role liKe '%$nombre%' ";
        // }

        //Variables de Ajax_JavaScript
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        
        $totalRegistros = $this->getInt('total_registros');

        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE Rol_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND r.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY r.Row_Estado DESC ";
            }
            
        } else {
            $condicion = " ORDER BY r.Row_Estado DESC ";
            //Filtro por Activos/Eliminados  
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE r.Row_Estado = $soloActivos  ";
            }
        }  

        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getRolesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador->paginar( $totalRegistros,"listarRoles", "$txtBuscar", $pagina,CANT_REG_PAG, true);

        $this->_view->assign('roles', $this->_aclm->getRolesCondicion($pagina,CANT_REG_PAG, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarRoles', false, true);
    }
    //Modificado por Jhon Martinez
    public function editarRol($Rol_IdRol = false)
    {
        $this->_acl->acceso('editar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        $rol = $this->_aclm->getRol($this->filtrarInt($Rol_IdRol));

        if ($this->botonPress("bt_cancelarEditarRol")) {
            $this->redireccionar('acl/index/roles');
        }

        if ($this->botonPress("bt_editarRol")) 
        {            
            if($this->getSql('idIdiomaSeleccionado') == $rol['Idi_IdIdioma'])
            {
                $id = $this->_aclm->editarRol($this->filtrarInt($Rol_IdRol), $this->getSql('Rol_Nombre'));
                if($id)
                {
                    $this->_view->assign('_mensaje', 'Rol editado Correctamente');
                    $rol = $this->_aclm->getRol($this->filtrarInt($Rol_IdRol));
                }  
                else 
                {
                    $this->_view->assign('_error', 'Error al editar Rol');
                }
            } else {
                $id = $this->_aclm->editarTraduccion($this->filtrarInt($Rol_IdRol), $this->getSql('Rol_Nombre'), $this->getSql('idIdiomaSeleccionado'));
                if($id)
                {
                    $this->_view->assign('_mensaje', 'Traducción de Rol editado Correctamente');
                }  
                else 
                {
                    $this->_view->assign('_error', 'Error al editar Rol');
                }
            }
            //$this->redireccionar('acl/index/roles');
            //exit;
        }        
        $this->_view->assign('idiomas',$this->_aclm->getIdiomas());        
        $this->_view->assign('datos',$rol);
        $this->_view->renderizar('ajax/editarRol','editarRol');
    }

    
    public function gestion_idiomas_rol() 
    {
        $this->_view->getLenguaje('template_backend');
        $Idi_IdIdioma =  $this->getPostParam('idIdioma');        
        $Rol_IdRol = $this->getPostParam('idrol');
                   
        $datos = $this->_aclm->getRolTraducido($Rol_IdRol, $Idi_IdIdioma);

        $this->_view->assign('idiomas',$this->_aclm->getIdiomas());
        if ($datos["Idi_IdIdioma"]==$Idi_IdIdioma) 
        {
            $this->_view->assign('datos',$datos);    
        }
        else
        {
            $datos["Rol_role"]="";
            $datos["Idi_IdIdioma"]=$Idi_IdIdioma;
            $this->_view->assign('datos',$datos);  
        }            
        //$this->_view->assign('IdiomaOriginal',$this->getPostParam('idIdiomaOriginal'));        
        $this->_view->renderizar('ajax/gestion_idiomas_rol', false, true);
    }

    //Modificado por Jhon Martinez
    public function _eliminarRol()
    {
        $this->_acl->acceso('editar_rol');
                
        //Variables Ajax_Javascript
        $Rol_IdRol = $this->getInt('_Rol_IdRol');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');       
        // echo $Per_IdPermiso."//".$Row_Estado;
        //Para Mensajes
        $resultado = array();
        $mensaje = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if(!$Rol_IdRol)
            {            
                $contenido = 'Error parametro ID ..!!'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));          
            } else {
                $usu = $this->_aclm->getUsuarioRol($Rol_IdRol);
                // print_r($role);
                if ($usu <= 0)
                {                   
                    $rowCount = $this->_aclm->eliminarHabilitarRol($Rol_IdRol,$Row_Estado);
                    // echo $rowCount3;//exit;
                    if($rowCount && $rowCount > 0)
                    {
                        $contenido = 'El rol fue elimnado correctamente...!!!'; 
                        $mensaje = "ok";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido));  
                    } else {
                        $contenido = 'No se pudo eliminar rol, error de consulta...!!!'; 
                        $mensaje = "error";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                    }
                    
                } else {
                    $contenido = 'No se pudo eliminar rol asignado a usuario...!!!'; 
                    $mensaje = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
                }  
                // echo $error;exit;        
            }
        } else {
            $rowCount = $this->_aclm->eliminarHabilitarRol($Rol_IdRol,$Row_Estado);            
            if($rowCount)
            {
                $contenido = 'El rol fue activado correctamente...!!!'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar rol error en consulta...!!!'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }

        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE Rol_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND r.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY r.Row_Estado DESC ";
            }
            
        } else {
            $condicion = " ORDER BY r.Row_Estado DESC ";
            //Filtro por Activos/Eliminados  
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE r.Row_Estado = $soloActivos  ";
            }
        }  

        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getRolesRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];

        $paginador->paginar( $totalRegistros,"listarRoles", "$txtBuscar", $pagina,$filas, true);

        $this->_view->assign('roles', $this->_aclm->getRolesCondicion($pagina, $filas, $condicion));

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacion', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarRoles', false, true);
    }
    
    /*Permisos*/
    //Modificado por Jhon Martinez
    public function permisos($error = "")
    {
        $this->_acl->acceso('listar_usuarios');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));

        // if($error!="")
        // {
        //     if($error == 1)
        //     {
        //         $this->_view->assign('_mensaje', 'El permiso fue elimnado correctamente...!!!');
        //     }  
        //     else 
        //     {
        //         $this->_view->assign('_error', $error);
        //     }            
        // }
        // $txtBuscar = $this->getSql('nombre');
        $pagina = $this->getInt('pagina');

        //Filtro por Activos/Eliminados
        $condicion = " ORDER BY p.Row_Estado DESC ";
        $soloActivos = 0;
        if (!$this->_acl->permiso('ver_eliminados')) {
            $soloActivos = 1;
            $condicion = " WHERE p.Row_Estado = $soloActivos ";
        }
        //Filtro por Activos/Eliminados

        $paginador = new Paginador();
        
        if ($this->botonPress("bt_guardarPermiso")) 
        {
              $this->nuevo_permiso();                
        }

        $arrayRowCount = $this->_aclm->getPermisosRowCount($condicion);
        $this->_view->assign('modulos', $this->_aclm->getModulos(0,0));
        $this->_view->assign('permisos', $this->_aclm->getPermisos($pagina,CANT_REG_PAG,$soloActivos));

        $paginador->paginar( $arrayRowCount['CantidadRegistros'],"listarPermisos", "", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacionPermisos', $paginador->getView('paginacion_ajax_s_filas'));
        
        $this->_view->assign('titulo', 'Administracion de permisos');
        $this->_view->renderizar('permisos', 'acl');
    }    
    //Modificado por Jhon Martinez
    public function _cambiarEstadoPermisos(){
        $this->_acl->acceso('agregar_rol');
        // $this->_view->setJs(array(array(BASE_URL . 'public/js/util.js',true)));

        //Para Mensajes
        $resultado = array();
        $mensaje = "error";
        $contenido = "";
        //Para mensajes

        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $Per_IdPermiso = $this->getInt('_Per_IdPermiso');
        $Per_Estado = $this->getInt('_Per_Estado');
        // echo $Per_Estado."//".$Per_IdPermiso; exit;

        if(!$Per_IdPermiso){            
            $contenido = 'Error parametro ID ..!!'; 
            $mensaje = "error";
            array_push($resultado, array(0 => $mensaje, 1 => $contenido));            
        } else {
            $rowCountEstado = $this->_aclm->cambiarEstadoPermisos($Per_IdPermiso, $Per_Estado);
            if ($rowCountEstado > 0) {
                if ($Per_Estado == 1) {
                    $contenido = ' Se cambio de estado correctamente a <b>Deshabilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" title="Deshabilitado" style="background: #FFF; color: #DD4B39; padding: 2px;"/> ...!! ';              
                }
                if ($Per_Estado == 0) {
                     $contenido = ' Se cambio de estado correctamente a <b>Habilitado</b> <i data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" title="Habilitado" style=" background: #FFF;  color: #088A08; padding: 2px;"/> ...!! ';
                }     
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));       
            } else {
                $contenido = 'Error de variable(s) en consulta..!!'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido)); 
            }        

        }
        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE Per_Nombre liKe '%$txtBuscar%' ";
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND p.Row_Estado = $soloActivos ";
            }
            $condicion .= " ORDER BY p.Row_Estado DESC  ";
        } else {
            //Filtro por Activos/Eliminados     
            $condicion = " ORDER BY p.Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE p.Row_Estado = $soloActivos  ";
            }

            //Filtro por Activos/Eliminados
        }  

        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getPermisosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        // echo($totalRegistros);
        // print_r($arrayRowCount); echo($condicion);exit;
        $this->_view->assign('permisos', $this->_aclm->getPermisosCondicion($pagina,$filas, $condicion));

        $paginador->paginar( $totalRegistros ,"listarPermisos", "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacionPermisos', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarPermisos', false, true);
    }
    //Modificado por Jhon Martinez
    public function editarPermiso($Per_IdPermiso = false){
        $this->_acl->acceso('agregar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $this->_view->setJs(array('index'));
        if ($this->botonPress("bt_editarPermiso")) {
            $id = $this->_aclm->editarPermiso($this->filtrarInt($Per_IdPermiso), $this->getSql('permiso_nombre'), $this->getSql('key_'), $this->getInt('modulo_'));
            if($id){
                $this->_view->assign('_mensaje', 'Permiso <b>'.$this->getSql('permiso_nombre').'</b> editado Correctamente...');
            }  else {
                $this->_view->assign('_error', 'Error al editar Permiso');
            }            
            // $this->redireccionar('acl/index/permisos');
            // exit;
        }
        if ($this->botonPress("bt_cancelarEditarPermiso")) {
            $this->redireccionar('acl/index/permisos');
        }
        
        $permiso = $this->_aclm->getPermiso($this->filtrarInt($Per_IdPermiso)); 
        
        $this->_view->assign('datos',$permiso);
        $this->_view->assign('modulos', $this->_aclm->getModulos(0,0));
        $this->_view->renderizar('ajax/editarPermiso');
    }
    
    public function gestion_idiomas_permisos() {
        $this->_view->getLenguaje('template_backend');
        $Idi_IdIdioma =  $this->getPostParam('idIdioma');        
        $Per_IdPermiso = $this->getPostParam('idpermisos');
                   
        $datos = $this->_aclm->getPermisoTraducido($Per_IdPermiso, $Idi_IdIdioma);
        print_r($datos);
        $this->_view->assign('idiomas',$this->_aclm->getIdiomas());
        if ($datos["Idi_IdIdioma"]==$Idi_IdIdioma) {
            $this->_view->assign('datos',$datos);    
        }else{
            $datos["Per_Permiso"]="";
            $datos["Per_Ckey"]="";
            $datos["Idi_IdIdioma"]=$Idi_IdIdioma;
            $this->_view->assign('datos',$datos);  
        }            
        //$this->_view->assign('IdiomaOriginal',$this->getPostParam('idIdiomaOriginal'));        
        $this->_view->renderizar('ajax/gestion_idiomas_permisos', false, true);
    }
    //Modificado por Jhon Martinez
    public function _paginacion_listarPermisos($txtBuscar = false) 
    {
        //$this->validarUrlIdioma();
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');
        $totalRegistros = $this->getInt('total_registros');

        $condicion = " ";
        $soloActivos = 0;
        // $nombre = $this->getSql('palabra');
        if ($txtBuscar) 
        {
            $condicion = " WHERE Per_Nombre liKe '%$txtBuscar%' ";
            //Filtro por Activos/Eliminados
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND p.Row_Estado = $soloActivos ";
            } else {
                $condicion .= " ORDER BY p.Row_Estado DESC  ";
            }
        } else {
            //Filtro por Activos/Eliminados     
            $condicion = " ORDER BY p.Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE p.Row_Estado = $soloActivos  ";
            }
        }         


        $paginador = new Paginador();
        // $arrayRowCount = $this->_aclm->getPermisosRowCount$arrayRowCount = 0,($condicion);

        $paginador->paginar( $totalRegistros,"listarPermisos", "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('permisos', $this->_aclm->getPermisosCondicion($pagina,$filas, $condicion));
        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        //$this->_view->assign('cantidadporpagina',$registros);
        $this->_view->assign('paginacionPermisos', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarPermisos', false, true);
    }
    //Modificado por Jhon Martinez
    public function _buscarPermiso() 
    {
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $condicion = "";

        $soloActivos = 0;
        // $nombre = $this->getSql('palabra');
        if ($txtBuscar) 
        {
            $condicion = " WHERE Per_Nombre liKe '%$txtBuscar%' ";
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND p.Row_Estado = $soloActivos ";
            }
            $condicion .= " ORDER BY p.Row_Estado DESC  ";
        } else {
            //Filtro por Activos/Eliminados     
            $condicion = " ORDER BY p.Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE p.Row_Estado = $soloActivos  ";
            }

            //Filtro por Activos/Eliminados
        }        


        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getPermisosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        // echo($totalRegistros);
        // print_r($arrayRowCount); echo($condicion);exit;
        $this->_view->assign('permisos', $this->_aclm->getPermisosCondicion($pagina,CANT_REG_PAG, $condicion));

        $paginador->paginar( $totalRegistros ,"listarPermisos", "$txtBuscar", $pagina, CANT_REG_PAG, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacionPermisos', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarPermisos', false, true);
    }
    //Modificado por Jhon Martinez
    public function nuevo_permiso()
    {
        $this->_acl->acceso('agregar_rol');
        $i=0;
        $error = ""; $error1 = ""; $error2 = "";
        
        if($this->_aclm->verificarPermiso($this->getSql('permiso_')))
        {
            $error = ' Permiso <b style="font-size: 1.15em;"> '. $this->getSql('permiso_').' </b> ya Existe.';
            $i=1;
        }
        
        if($this->_aclm->verificarKey($this->getAlphaNum('key_')))
        {
            if($i!=0) 
            {
                $error1 = '<br> Key <b style="font-size: 1.15em;">'. $this->getAlphaNum('key_') .' </b> ya existe.';
            }
            else
            {
                $error1 = ' Key <b style="font-size: 1.15em;">'. $this->getAlphaNum('key_') .' </b> ya existe. ';
            }

            $i=2;
        }
        
        if($i==0)
        {
            $idPermiso = $this->_aclm->insertarPermiso(
                $this->getSql('permiso_'), 
                $this->getAlphaNum('key_'),
                $this->getInt('modulo_'), 'es'
                );
        }
            
        if (is_array($idPermiso)) 
        {
            if ($idPermiso  [0] > 0) 
            {
                $this->_view->assign('_mensaje', 'Se registró correctamente el Permiso <b style="font-size: 1.15em;">'. $this->getSql('permiso_').'</b> ');
            } 
            else 
            {
                $this->_view->assign('_error', 'Error al registrar el Permiso');
            }
        }
        else 
        {
            if($i!=0)
            {
                $this->_view->assign('_error', $error . $error1 );
            }
            else
            {
                $this->_view->assign('_error', 'Ocurrio un error al Registrar los datos');
            }            
        }            
    }    
    //Modificado por Jhon Martinez
    public function _eliminarPermiso()
    {
        $this->_acl->acceso('agregar_rol');
        //Variables Ajax_Javascript
        $Per_IdPermiso = $this->getInt('_Per_IdPermiso');
        $Row_Estado = $this->getInt('_Row_Estado');
        $txtBuscar = $this->getSql('palabra');
        $pagina = $this->getInt('pagina');
        $filas=$this->getInt('filas');        

        //Para Mensajes
        $resultado = array();
        $mensaje = "error";
        $contenido = "";
        //Para mensajes

        if ($Row_Estado == 0) {
            if(!$Per_IdPermiso)
            {            
                $contenido = 'Error parametro ID ..!!'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));          
            } else {
                $role = $this->_aclm->verificarPermisoRol($Per_IdPermiso);
                // print_r($role);
                if (!$role)
                {
                    $usuario = $this->_aclm->verificarPermisoUsuario($Per_IdPermiso);
                    if(!$usuario){
                        $rowCount = $this->_aclm->eliminarHabilitarPermiso($Per_IdPermiso,$Row_Estado);
                        if($rowCount)
                        {
                            $contenido = 'El permiso fue elimnado correctamente...!!!'; 
                            $mensaje = "ok";
                            array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                        } else {
                            $contenido = 'No se pudo eliminar permiso error en consulta...!!!'; 
                            $mensaje = "error";
                            array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                        }
                    } else {
                        $contenido = 'No se pudo eliminar permiso asignado a usuario...!!!'; 
                        $mensaje = "error";
                        array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                    }
                    
                } else {
                    $contenido = 'No se pudo eliminar permiso asignado a rol...!!!'; 
                    $mensaje = "error";
                    array_push($resultado, array(0 => $mensaje, 1 => $contenido));
                }        
            }
        } else {
            $rowCount = $this->_aclm->eliminarHabilitarPermiso($Per_IdPermiso,$Row_Estado);
            
            if($rowCount)
            {
                $contenido = 'El permiso fue activado correctamente...!!!'; 
                $mensaje = "ok";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            } else {
                $contenido = 'No se pudo activar permiso, error en variable(s) de consulta...!!!'; 
                $mensaje = "error";
                array_push($resultado, array(0 => $mensaje, 1 => $contenido));
            }
        }

        
        $mensaje_json = json_encode($resultado);
        // echo($mensaje_json); exit();
        $this->_view->assign('_mensaje_json', $mensaje_json);

        $soloActivos = 0;
        $condicion = "";
        if ($txtBuscar) 
        {
            $condicion = " WHERE Per_Nombre liKe '%$txtBuscar%' ";
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion .= " AND p.Row_Estado = $soloActivos ";
            }
            $condicion .= " ORDER BY p.Row_Estado DESC  ";
        } else {
            //Filtro por Activos/Eliminados     
            $condicion = " ORDER BY p.Row_Estado DESC ";   
            if (!$this->_acl->permiso('ver_eliminados')) {
                $soloActivos = 1;
                $condicion = " WHERE p.Row_Estado = $soloActivos  ";
            }

            //Filtro por Activos/Eliminados
        }  

        $paginador = new Paginador();

        $arrayRowCount = $this->_aclm->getPermisosRowCount($condicion);
        $totalRegistros = $arrayRowCount['CantidadRegistros'];
        // echo($totalRegistros);
        // print_r($arrayRowCount); echo($condicion);exit;
        $this->_view->assign('permisos', $this->_aclm->getPermisosCondicion($pagina,$filas, $condicion));

        $paginador->paginar( $totalRegistros ,"listarPermisos", "$txtBuscar", $pagina, $filas, true);

        $this->_view->assign('numeropagina', $paginador->getNumeroPagina());
        $this->_view->assign('paginacionPermisos', $paginador->getView('paginacion_ajax_s_filas'));
        $this->_view->renderizar('ajax/listarPermisos', false, true);
        //$this->permisos($error);
    }
    //Modificado por Jhon Martinez
    public function permisos_role($Rol_IdRol)
    {
        $this->_acl->acceso('agregar_rol');
        $this->validarUrlIdioma();
        $this->_view->getLenguaje("index_inicio");
        $Rol_IdRol = $this->filtrarInt($Rol_IdRol);
        
        if(!$Rol_IdRol)
        {
            $this->redireccionar('acl/roles');
        }        
        $row = $this->_aclm->getRol($Rol_IdRol);        
        if(!$row)
        {
            $this->redireccionar('acl/roles');
        }
        if ($this->botonPress("bt_cancelarEditarRol")) {
            $this->redireccionar('acl/index/roles');
        }
        
        $this->_view->assign('titulo', 'Administracion de permisos rol');
        
        if($this->getInt('guardar') == 1)
        {
            $values = array_keys($_POST);
            $replace = array();
            $eliminar = array();
            
            for($i = 0; $i < count($values); $i++)
            {
                if(substr($values[$i],0,5) == 'perm_')
                {
                    $permiso = (strlen($values[$i]) - 5);
                    
                    if($_POST[$values[$i]] == 'x')
                    {
                        $eliminar[] = array(
                            'role' => $Rol_IdRol,
                            'permiso' => substr($values[$i], -$permiso)
                        );
                    }
                    else
                    {
                        if($_POST[$values[$i]] == 1)
                        {
                            $v = 1;
                        }
                        else
                        {
                            $v = 0;
                        }
                        
                        $replace[] = array(
                            'role' => $Rol_IdRol,
                            'permiso' => substr($values[$i], -$permiso),
                            'valor' => $v
                        );
                    }
                }
            }
            
            for($i = 0; $i < count($eliminar); $i++)
            {
                $this->_aclm->eliminarPermisoRol(
                        $eliminar[$i]['role'],
                        $eliminar[$i]['permiso']);
            }
            
            for($i = 0; $i < count($replace); $i++)
            {
                $this->_aclm->editarPermisoRol(
                        $replace[$i]['role'],
                        $replace[$i]['permiso'],
                        $replace[$i]['valor']);
            }
        }
        
        $this->_view->assign('role', $row);
        $this->_view->assign('permisos', $this->_aclm->getPermisosRol($Rol_IdRol));
        $this->_view->renderizar('permisos_role');
    }
}
?>