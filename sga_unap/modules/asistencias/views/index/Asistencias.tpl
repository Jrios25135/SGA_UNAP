<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRACIÓN DE ASISTENCIAS</h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BUSCAR CURSOS</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="{$lenguaje.text_buscar_rol}" style="width: 150px; float: left; margin: 0px 10px;" name="palabraBusqueda" id="palabraBusqueda">
                    <button class="btn btn-success" style=" float: left" type="button" id="btnBuscarRegistros"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}carga_academica/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>MIS CURSOS</b></h4>
            <input type="hidden" name="formulario" id="formulario" value="{$formulario}">
            <div id="listar{$formulario}" >
                {if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th style=" text-align: center">Código </th>
                                <th >Curso </th>
                                <th style=" text-align: center">Grupo</th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$listaDatos}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    {if $rl.Usu_IdUsuario==$usuario}
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td style=" text-align: center">{$rl.Cur_Codigo}</td>
                                    <td>{$rl.Cur_Nombre}</td>
                                    <td style=" text-align: center">{$rl.Caa_Grupo}</td> 
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">                                     
                                        
                                        <a data-toggle="tooltip" data-placement="bottom"  class="btn btn-default btn-sm glyphicon glyphicon-edit"  title="Registrar Asistencia" href="{$_layoutParams.root}asistencias/index/registrarAsistencia/{$rl.Caa_IdCargaAcademica}"></a>

                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-eye-open"  title="Ver Asistencias" href="{$_layoutParams.root}asistencias/index/verAsistencia/{$rl.Caa_IdCargaAcademica}"></a>
                                    </td>
                                    {/if}
                                    {/if}
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}
                {else}
                    {$lenguaje.no_registros}
                {/if}                
            </div>
        </div>
    </div>
</div>