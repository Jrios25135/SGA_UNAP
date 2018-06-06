<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">{$lenguaje.roles_label_titulo}</h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>Silabos</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="{$lenguaje.text_buscar_rol}" style="width: 150px; float: left; margin: 0px 10px;" name="palabraRol" id="palabraRol">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscar"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>{$lenguaje.roles_buscar_tabla_titulo}</b></h4>
            <div id="listarRoles" >
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >{$lenguaje.label_rol}</th>
                                <th >{$lenguaje.label_modulo} </th>
                                <th style=" text-align: center">{$lenguaje.label_estado}</th>
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                            </tr>
                            {foreach item=rl from=$cursos}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rl.Cur_Nombre}</td>
                                    <td>{$rl.Usu_Nombre}</td>
                                    <td>{$rl.Caa_Semestre}</td>
                                    <td style=" text-align: center">
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="{$lenguaje.tabla_opcion_editar_rol}" href="{$_layoutParams.root}silabos/index/registrarSilabo/{$rl.Caa_IdCargaAcademica}"></a>
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="{$lenguaje.tabla_opcion_editar_rol}" href="{$_layoutParams.root}acl/index/editarRol/{$rl.Rol_IdRol}"></a>

                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="{$lenguaje.tabla_opcion_editar_permisos}" href="{$_layoutParams.root}acl/index/permisos_role/{$rl.Rol_IdRol}"></a>

                                        <a   
                                        {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-rol" title="{$lenguaje.label_habilitar}" 
                                        {else}
                                            data-book-id="{$rl.Rol_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_rol="{$rl.Rol_IdRol}" data-placement="bottom" > </a>

                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}               
            </div>
        </div>
    </div>
</div>