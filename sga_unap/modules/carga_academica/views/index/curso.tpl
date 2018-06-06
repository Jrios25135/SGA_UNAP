{literal}
<style>
    .select2-container{
    width:100% !important;
}
</style>
{/literal}
<div class="container-fluid">
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h3 style="width: 80%;  margin: 0px auto; text-align: center;">
            Administrar Cursos
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
                    NUEVO CURSO
                </strong>
            </h3>
        </div>
        <div aria-expanded="false" class="panel-collapse collapse" id="collapse3" style="height: 0px;">
            <div class="panel-body" id="nuevo_curso" style="width: 90%; margin: 0px auto">
                <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                    <div class="form-group">
                        {if isset($escuelas) && count($escuelas)}
                        <label class="col-lg-2 control-label">
                            Escuela :
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="selEscuela" name="selEscuela">
                                <option value="">
                                    Seleccionar Escuela
                                </option>
                                {foreach item=r from=$escuelas }
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
                        <label class="col-lg-2 control-label">
                            Curricula :
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="selCurricula" name="selCurricula">
                                <option value="">
                                    Seleccionar Escuela
                                </option>
                                {if isset($curricula) && count($curricula)}
                                        {foreach item=r from=$curricula }
                                <option value="{$r.Cui_IdCurricula|default:0}">
                                    {$r.Cui_Resolucion|default:"Seleccionar"}
                                </option>
                                {/foreach}
                                        {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Codigo del Curso:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="codigo_curso" maxlength="9" name="codigo_curso" placeholder="Codigo del Curso" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Nombre del Curso:
                        </label>
                        <div class="col-lg-5">
                            <input class="form-control" id="nombre_curso" maxlength="60" name="nombre_curso" placeholder="Nombre Curso" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Tipo de Curso:
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="tipo_curso" name="tipo_curso">
                                <option>
                                    Seleccione
                                </option>
                                <option value="Obligatorio">
                                    Obligatorio
                                </option>
                                <option value="Electivo">
                                    Electivo
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Creditos del Curso:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="credito_curso" maxlength="2" name="credito_curso" onkeypress="return justNumbers(event);" placeholder="Creditos del Curso" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Horas Teoria:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="hora_teoria" maxlength="2" name="hora_teoria" placeholder="Horas de Teoria" required="" type="text">
                            </input>
                        </div>
                        <div class="col-lg-2">
                            <label class="col-lg-2 control-label">
                                Horas
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Horas Practica:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="hora_practica" maxlength="2" name="hora_practica" placeholder="Horas de Practica" type="text">
                            </input>
                        </div>
                        <div class="col-lg-2">
                            <label class="col-lg-2 control-label">
                                Horas
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Duracion del Curso:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="dura_curso" name="dura_curso" placeholder="Duracion del Curso" required="" type="text"/>
                        </div>
                        <div class="col-lg-2">
                            <label class="col-lg-2 control-label">
                                Semanas
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Ciclo:
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="selciclo_curricula" name="selciclo_curricula">
                                <option value="">
                                    Seleccionar Curricula
                                </option>
                                {if isset($ciclo_curricula) && count($ciclo_curricula)}
                            {foreach item=r from=ciclo_curricula}
                                <option value="{$r.Ciu_IdCicloCurricula|default:0}">
                                    {$r.Cic_Nombre|default:"Seleccionar"}
                                </option>
                                {/foreach}
                            {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Curso Pre-Requisito
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control js-example-basic-multiple" id="cursor[]" name="cursor[]" multiple="multiple" name="cursopre">
                                <option value="">
                                    Seleccione
                                </option>
                                {if isset($cursor) && count($cursor)}
                                {foreach item=r from=$cursor}
                                <option value="{$r.Cur_IdCurso|default:0}">
                                    {$r.Cur_Codigo}  {$r.Cur_Nombre|default:"Seleccionar"}
                                </option>
                                {/foreach}
                            {/if}
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button class="btn btn-success" id="bt_guardarCurso" name="bt_guardarCurso" type="submit">
                                <i class="glyphicon glyphicon-floppy-disk">
                                </i>
                                Guardar
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
                    BUSCAR CURSO
                </strong>
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" id="palabraCurso" name="palabraCurso" placeholder="Buscar curso" style="width: 150px; float: left; margin: 0px 10px;">
                        <button class="btn btn-success" id="buscar" name="buscar" style=" float: left" type="button">
                            <i class="glyphicon glyphicon-search">
                            </i>
                        </button>
                    </input>
                </div>
                <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title">
                <b>
                    Lista de Cursos
                </b>
            </h4>
            <div id="listarCurso">
                {if isset($curso) && count($curso)}
                <div class="table-responsive">
                    <table class="table" style="  margin: 20px auto">
                        <tr>
                            <th style=" text-align: center">
                                {$lenguaje.label_n}
                            </th>
                            <th>
                                Codigo / Nombre de curso
                            </th>
                            <th style=" text-align: center">
                                Creditos
                            </th>
                            <th style=" text-align: center">
                                Horas Teoria
                            </th>
                            <th style=" text-align: center">
                                Horas Practica
                            </th>
                            <th style=" text-align: center">
                                Duracion del Curso/Semanas
                            </th>
                            <th style=" text-align: center">
                                Ciclo
                            </th>
                            <th style=" text-align: center">
                                Tipo de Curso
                            </th>
                            <th style=" text-align: center">
                                Escuela Profesional
                            </th>
                            <th style=" text-align: center">
                                Plan de Estudios
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
                        {foreach item=rl from=$curso}
                        <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                            <td style=" text-align: center">
                                {$numeropagina++}
                            </td>
                            <td>
                                {$rl.Cur_Codigo} - {$rl.Cur_Nombre}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Cur_Creditos}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Cur_HorasTeoria}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Cur_HorasPractica}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Cur_Semanas}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Cic_Nombre}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Cur_Tipo}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Esc_Nombre}
                            </td>
                            <th style=" text-align: center">
                                {$rl.Cui_Resolucion}
                            </th>
                            <td style=" text-align: center">
                                {if $rl.Cur_Estado==0}
                                <p class="glyphicon glyphicon-remove-sign" data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;">
                                </p>
                                {/if}
                                            {if $rl.Cur_Estado==1}
                                <p class="glyphicon glyphicon-ok-sign" data-placement="bottom" data-toggle="tooltip" style="color: #088A08;">
                                </p>
                                {/if}
                            </td>
                            {if $_acl->permiso("editar_rol")}
                            <td style=" text-align: center">
                                <a class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-rol" data-placement="bottom" data-toggle="tooltip" estado="{$rl.Cur_Estado}" id_rol="{$rl.Cur_IdCurso}" title="{$lenguaje.tabla_opcion_cambiar_est}">
                                </a>
                                <a class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}carga_academica/index/editarCurso/{$rl.Cur_IdCurso}" title="editar">
                                </a>
                                <!--   <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="{$lenguaje.tabla_opcion_editar_permisos}" href="{$_layoutParams.root}acl/index/permisos_role/{$rl.Rol_IdRol}"></a> -->
                                <a {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-rol" title="{$lenguaje.label_habilitar}  " 
                                        {else}
                                            data-book-id="{$rl.Cur_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_rol="{$rl.Cur_IdCurso}" data-placement="bottom">
                                </a>
                            </td>
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
                <a class="btn btn-danger danger eliminar_rol" data-dismiss="modal" style="cursor:pointer">
                    Eliminar
                </a>
            </div>
        </div>
    </div>
</div>
