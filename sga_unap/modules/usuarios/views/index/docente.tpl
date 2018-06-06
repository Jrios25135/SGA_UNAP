<div class="container-fluid">
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h3 style="width: 80%;  margin: 0px auto; text-align: center;">
            Administrar Docente
        </h3>
    </div>
    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" class="panel-title collapsed" data-toggle="collapse" href="#collapse3">
                <i class="fa fa-ellipsis-v" style="float:right">
                </i>
                <i class="fa fa-user-secret">
                </i>
                <strong>
                    Resgistrar Docente
                </strong>
            </h3>
        </div>
        <div aria-expanded="false" class="panel-collapse collapse" id="collapse3" style="height: 0px;">
            <div class="panel-body" id="nuevo_docente" style="width: 90%; margin: 0px auto">
                <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                    <div class="form-group">
                        {if isset($escue) && count($escue)}
                        <label class="col-lg-2 control-label">
                            Escuela :
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="selescuela" name="selescuela">
                                <option value="">
                                    Seleccionar Escuela
                                </option>
                                {foreach item=r from=$escue }
                                <option value="{$r.Esc_IdEscuela|default:0}">
                                    {$r.Esc_Nombre|default:"Seleccionar"}
                                </option>
                                {/foreach}
                            </select>
                        </div>
                        {else} No hay datos para mostrar
                             {/if}
                    </div>
                    <div class="form-group">
                        {if isset($maestro) && count($maestro)}
                        <label class="col-lg-2 control-label">
                            Docente :
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="seldocente" name="seldocente">
                                <option value="">
                                    Seleccionar Docente
                                </option>
                                {foreach item=r from=$maestro }
                                <option value="{$r.Usr_IdUsuarioRol|default:0}">
                                    {$r.Usu_Nombre}   {$r.Usu_Apellidos|default:"Seleccionar"}
                                </option>
                                {/foreach}
                            </select>
                        </div>
                        {else} No hay datos para mostrar
                             {/if}
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Grado Academico:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="gradoacademico"  name="gradoacademico" placeholder="Grado Academico" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Condicion:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="condicion"  name="condicion" placeholder="Condicion" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Dedicacion:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="dedicacion" name="dedicacion" placeholder="Dedicacion" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Categoria:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="categoria" name="categoria"  placeholder="Categoria" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Cargo:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="cargo" name="cargo" placeholder="Cargo" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button class="btn btn-success" id="bt_guardardocente" name="bt_guardardocente"  type="submit">
                                <i class="glyphicon glyphicon-floppy-disk">
                                </i>
                                Guardar Docente
                            </button>
                        </div>
                    </div>
                </form>
                <script>
                    function justNumbers(e) {
                var keynum = window.event ? window.event.keyCode : e.which;
                if ((keynum == 8) || (keynum == 46))
                    return true;
                return /\d/.test(String.fromCharCode(keynum));
            };
            function sololetras(){
                if (event.keyCode >45 && event.keyCode  <57) event.returnValue = false;
            }
            function chk_keys(forma){
                if(event.keyCode==17){
                    alert('**Esta desactivada la opción Ctrl**');
                    forma.focus();
                }
            }
                </script>
            </div>
        </div>
    </div>
    {/if}
<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-list-alt">
                </i>
                <strong>
                    LISTA DE DOCENTES
                </strong>
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" id="palabra" name="palabra" placeholder="Buscar Docente" style="width: 150px; float: left; margin: 0px 10px;">
                        <button class="btn btn-success" id="buscarDocente" name="buscarDocente" style=" float: left" type="button">
                            <i class="glyphicon glyphicon-search">
                            </i>
                        </button>
                    </input>
                </div>
                <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title">
                <b>
                    Lista
                </b>
            </h4>
            <div id="listardocente">
                {if isset($docentes) && count($docentes)}
                <div class="table-responsive">
                    <table class="table" style="  margin: 20px auto">
                        <tr>
                            <th style=" text-align: center">
                                {$lenguaje.label_n}
                            </th>

                            <th style=" text-align: center">
                                Nombres / Apellido
                            </th>
                            <th style=" text-align: center">
                                Grado Academico
                            </th>
                            <th style=" text-align: center">
                                Condicion
                            </th>
                            <th style=" text-align: center">
                                Dedicacion
                            </th>
                            <th style=" text-align: center">
                                Categoria
                            </th>
                            <th style=" text-align: center">
                                Cargo
                            </th>
                            <th style=" text-align: center">
                                Escuela Profesional
                            </th>
                            <th style=" text-align: center">
                                Estado
                            </th>
                            {if $_acl->permiso("editar_rol")}
                            <th style=" text-align: center">
                                {$lenguaje.label_opciones}
                            </th>
                            {/if}
                        </tr>
                        {foreach item=rl from=$docentes}
                        <tr{if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                            <td style=" text-align: center">
                                {$numeropagina++}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Usu_Nombre}   {$rl.Usu_Apellidos}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_GradoAcademico}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_Condicion}
                            </td>
                             <td style=" text-align: center">
                                {$rl.Ded_Dedicacion}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_Categoria}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_Cargo}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Esc_Nombre}
                            </td>
                            <td style=" text-align: center">
                                {if $rl.Ded_Estado==0}
                                <p class="glyphicon glyphicon-remove-sign" data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;">
                                </p>
                                {/if}
                                {if $rl.Ded_Estado==1}
                                <p class="glyphicon glyphicon-ok-sign" data-placement="bottom" data-toggle="tooltip" style="color: #088A08;">
                                </p>
                                {/if}
                            </td>
                            {if $_acl->permiso("editar_rol")}
                            <td style=" text-align: center">
                                <a data-toggle="tooltip"  data-placement="bottom"  class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-docente"   title="cambiar estado " id_detalledocente="{$rl.Ded_IdDetalleDocente}" estado="{$rl.Ded_Estado}">
                                </a>
                                <a class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}usuarios/index/editardocente/{$rl.Ded_IdDetalleDocente}" title="editar">
                                </a>
                             <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="Seguro de Eliminar?" href="{$_layoutParams.root}acl/index/permisos_role/{$rl.Rol_IdRol}"></a> 

                                <a {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-docente" title="Habilitar " 
                                        {else}
                                            data-book-id="{$rl.Ded_GradoAcademico}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-docente" title="Eliminar "
                                        {/if} 
                                        id_detalledocente="{$rl.Ded_IdDetalleDocente}" data-placement="bottom">
                                </a>
                            </td>
                            {/if}
                        </tr>
                        {/foreach}
                    </table>
                </div>
                {$paginacion|default:""}
                {else}
                    No hay Registros
                {/if}
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal " id="confirm-delete" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Confirmación de Eliminación
                </h4>
            </div>
            <div class="modal-body">
                <p>
                    Estás a punto de borrar un item, este procedimiento es irreversible
                </p>
                <p>
                    ¿Deseas Continuar?
                </p>
                <p>
                    Eliminar:
                    <strong class="nombre-es">
                        Rol
                    </strong>
                </p>
                <label id="texto_" name="texto_">
                </label>
                <!-- <input type='text' class='form-control' name='codigo' id='validate-number' placeholder='Codigo' required> -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Cancelar
                </button>
                <a class="btn btn-danger danger eliminar_docente" data-dismiss="modal" style="cursor:pointer">
                    Eliminar
                </a>
            </div>
        </div>
    </div>
</div>